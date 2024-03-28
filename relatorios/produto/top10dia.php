<?php
$nivel=1;
require_once('../../verifica_session.php');
require_once('../../database.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Relatórios de produtos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</head>
<body>

<div class="container">

<h1 class="text-info">Relatórios de Produtos</h1>

<a href="../../tela_principal.php" class="btn btn-danger">Tela principal</a>
<a href="../../sair.php" class="btn btn-danger">Sair</a>
<a href="produtos.php" class="btn btn-danger">Voltar</a>
</br>
</br>
<div>
<form action="top10dia.php" method="post">
<div class="row">
<div class="col-sm-2">
<input type="date" name="data_d" class="form-control" />
</div>
<div class="col-sm-2">
<input type="submit" class="btn btn-success" value="pesquisar"/>
</div>
</div>
</form>

<h3 class="text-info">Resultado:</h3>
</br>

<?php 




	if(empty($_POST['data_d'])){
		
		echo '<a class="alert alert-danger">nenhuma data selecionada!</a>';
		
	}else{
	
	$ano = $_POST['data_d'];
	$dt_inicio = date_format(new DateTime($ano." 00:00:01"), "Y/m/d H:i:s");
	$dt_final = date_format(new DateTime($ano." 23:59:59"), "Y/m/d H:i:s");
	$dt_inicio2 = date_format(new DateTime($ano), "d/m/Y");
		$sql = "SELECT id_venda FROM vendas WHERE data BETWEEN '".$dt_inicio."' and '".$dt_final."' ";
	$consulta = $conexao->prepare($sql);
	$consulta->execute(array());
	$lr200 = $consulta->fetchALL(PDO::FETCH_ASSOC);
		
if(empty($lr200)){
	echo '<table class="table table-striped" border="3">
<tr><th class="text-center bg-dark text-white-50">Vendas de '.$dt_inicio2.'</th></tr>
<tr><th align="center" class="alert-danger">Nenhuma venda efetuada nesse periodo</th></tr>
</table>
';
	
	
}else{
	
	
	
echo '<h3 class="text-primary">Vendas de '.$dt_inicio2.' </h3>
<table class="table table-striped" border="3">
<tr><th class="text-center bg-dark text-white-50" colspan="7">Ranking de produtos do dia!!!!</th></tr>
<tr>
    <th scope="col">Nome do produto</th>
    <th scope="col">quantidade vendida</th>
        <th scope="col">Valor do produto</th>
		    <th scope="col">Valor somado</th>
		    <th scope="col">Valor acumulado</th>
		    <th scope="col">Percentual</th>
			<th scope="col">Perc. acumulado</th>


    
</tr>';

	$sql1 = "SELECT p.produto,p.valor,COUNT(iv.id_produto) AS quan,SUM(iv.quantidade) AS q,
	(p.valor * SUM(iv.quantidade)) AS r
FROM itens_venda iv
left join produtos p
on p.id_produto = iv.id_produto
WHERE data_prod BETWEEN '".$dt_inicio."' and '".$dt_final."'
GROUP BY iv.id_produto ORDER BY q DESC ";
	$consulta1 = $conexao->prepare($sql1);
	$consulta1->execute(array());
	$lr2 = $consulta1->fetchALL(PDO::FETCH_ASSOC);
	
$soma_total=0;
$soma_total1=0;
$valor_acumulado3=0;
foreach($lr2 as $l12){
$soma_total1 +=$l12['r'];


}
foreach($lr2 as $l1){

	$vlr_somado = $l1['valor'] * $l1['q'];

	$soma_total +=$l1['r'];
	
	$valor_acumulado = $vlr_somado/$soma_total1;
	$valor_acumulado2 = $valor_acumulado * 100;
	$valor_acumulado3 += $valor_acumulado2; 
	
			echo '<tr><td>'.$l1['produto']	.'</td><td>'.$l1['q'].'</td>
			<td>$ '.number_format($l1['valor'],2).'</td><td>$ '.number_format($vlr_somado,2).'</td>
			<td>$ '.number_format($soma_total,2).'</td>
			<td>'.number_format($valor_acumulado2,2,".",",").'%</td>
			<td>'.number_format($valor_acumulado3,2,".",",").'%</td></tr>';

	
	 
	}}
if(!empty($lr200)){
		echo '<tr><td colspan="7" align="right"> TOTAL: $ '.number_format($soma_total,2).'</td></tr>';
		}
	

		echo '</table>';

	}
	
	

?>

</div>
</div>
<div class="container"><hr/>
<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div></div>
</body>