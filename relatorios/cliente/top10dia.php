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
  <title>Relatório de vendas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">

<h1 class="text-info">Relatórios de Vendas</h1>

<a href="../../tela_principal.php" class="btn btn-danger">Tela principal</a>
<a href="../../sair.php" class="btn btn-danger">Sair</a>
<a href="../cliente/clientes.php" class="btn btn-danger">Voltar</a>
</br>
</br>
<div>
<form action="top10dia.php" method="post">
    <div class="row">
        <div class="col-sm-2">
<input type="date" name="data_d" class="form-control"/>
        </div>
        <div class="col">
<input type="submit" class="btn btn-success" value="pesquisar"/>
        </div></div>
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
	
		$sql = "SELECT data FROM vendas WHERE data BETWEEN '".$dt_inicio."' and '".$dt_final."' ";
	$consulta = $conexao->prepare($sql);
	$consulta->execute(array());
	$lr200 = $consulta->fetch(PDO::FETCH_ASSOC);
	$ano_2 = date_format(new DateTime($ano),"d/m/Y");		

if(empty($lr200)){
	echo '<table  border="3" class="table table-striped">
<tr><th class="text-center bg-dark text-white-50" >Vendas de '.$ano_2.'</th></tr>
<tr><th align="center" class="alert-danger">Nenhuma venda efetuada nesse periodo</th></tr>
</table>
';
	
	
}else{
echo '
<h3 class="text-primary">Vendas de '.$ano_2.'</h3>
<table  border="3" class="table table-striped">
<tr><th class="text-center bg-dark text-white-50" colspan="2">Ranking de clientes no dia!!!!</th></tr>
<tr>
    <th scope="col">Nome do cliente</th>
    <th scope="col">numero de compras no dia</th>
    
    
</tr>';

	
	$sql = "SELECT id_cliente, COUNT(id_cliente) AS q FROM vendas WHERE data BETWEEN '".$dt_inicio."' and '".$dt_final." '
	GROUP BY id_cliente ORDER BY q DESC ";
	$consulta = $conexao->prepare($sql);
	$consulta->execute(array());
	$lr2 = $consulta->fetchALL(PDO::FETCH_ASSOC);
	
	foreach($lr2 as $l){
			
		$sql4 = "SELECT * FROM clientes WHERE id_clientes = ? ";
		$consulta4 = $conexao->prepare($sql4);
        $consulta4->execute(array($l['id_cliente']));
		$dados_us = $consulta4->fetch(PDO::FETCH_ASSOC);
	if($l['q'] >0){	
	
	echo '<tr><td>'.$dados_us['nome']	.'</td><td>'.$l['q'].'</td></tr>'	;
	}
	}
	echo '</table>';

}}

?>

</div>
</div>
<div class="container"><hr/>
<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
		
		</div></div>
</body>