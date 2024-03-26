	<?php
//require_once('../../verifica_session.php');
require_once('../database.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
$nivel=1;

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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="func_rl.js"></script>
</head>
<body>

<div class="container">

<h1 class="text-info">Relatórios de Vendas</h1>

<a href="../tela_principal.php" class="btn btn-danger">Tela principal</a>
<a href="../sair.php" class="btn btn-danger">Sair</a>
<a href="valores_diarios.php" class="btn btn-danger">Voltar</a>
</br>
</br>
<h3 class="text-info">Digite a data que você deseja pesquisar :</h3>
<form action="valores_diarios_dt_a.php" method="post" >
    <div class="row">
        <div class="col-sm-1">
        <select class="form-control" name="ano" class="label-success">
<option value="">ANO</option>
<option value="2023">2023</option>
<option value="2024">2024</option>
<option value="2025">2025</option>
</select>    
        </div>
        <div class="col">
            <input type="submit" class="btn btn-success" value="pesquisar"/>
        </div>
    </div>
</form>
<h3 class="text-info">Totais de vendas por dia	:</h3>
<div id="resultado">
<?php
	
if(empty($_POST['ano'])){
		
		echo '</br><a class="alert alert-danger">nenhuma data selecionada!</a>';
		
	}else{
	
	$ano = $_POST['ano'];

		$dt_inicio = date_format(new DateTime($ano."-01-01"), "Y/m/d H:i:s");
	$dt_final = date_format(new DateTime($ano."-12-31"), "Y/m/d H:i:s");
	
	
	$sql = "	SELECT month(data) AS mes,SUM(total) AS total 
	from vendas WHERE data BETWEEN '".$dt_inicio."' and '".$dt_final."' 
	GROUP BY MONTH(data)";
$consulta = $conexao->query($sql);

$lr2 = $consulta->fetchALL(PDO::FETCH_ASSOC);

if(empty($lr2)){
echo'	<table  border="3" class="table table-striped">
<tr><th  class="bg-dark text-white-50 text-center">Vendas de '.date_format(new DateTime($dt_inicio), "d/m/Y").' até '.date_format(new DateTime($dt_final), "d/m/Y").'</th></tr>
<tr><th align="center" class="alert-danger">Nenhuma venda efetuada nesse periodo</th></tr>
</table>
';
	
	
}else{
	
echo'	<table  border="3" class="table table-striped">
<tr><th align="center" class="alert-success" colspan="5">valores arrecadados !!!!</th></tr>
<tr>
    
    <th scope="col">datas pesquisadas </th>
    <th scope="col">totais mensais</th>
    <th scope="col">totais acumulados</th>
    <th scope="col">percentual</th>
    <th scope="col">percentual acumulado</th>

</tr>';
	$sql1 = "SELECT month(data) AS mes,SUM(total) AS total1 
	from vendas WHERE data BETWEEN '".$dt_inicio."' and '".$dt_final."' 
	GROUP BY MONTH(data)";
$consulta1 = $conexao->prepare($sql1);
$consulta1->execute(array());
$lr1 = $consulta1->fetchALL(PDO::FETCH_ASSOC);
$vl_somado=0;
$vl_somado1 =0;
$vl_ss = 0;
$vl_perc = 0;
$vl_perc_ac=0;
foreach($lr1 as $l1){
	$vl_somado1 += $l1['total1'];
	
}
foreach($lr1 as $l){
	$vl_somado += $l['total1'];
	$vl_ss = $l['total1']/$vl_somado1;
	$vl_perc = $vl_ss * 100;
	$vl_perc_ac += $vl_perc;
	echo '<tr><td >'.$l['mes'].'/'.$ano.'</td>
	<td >$ '.$l['total1'].'</td>
	<td >$ '.$vl_somado.'</td>
		<td >'.number_format($vl_perc,2).'%</td>
		<td >'.number_format($vl_perc_ac,2).'%</td></tr>';
	
}

echo '<tr><td colspan="5" align="right">TOTAL: $ '.$vl_somado.'</td></tr>
</table>';
}}









?>
</div>
</div><div class="container"><hr/>
<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
		
		</div></div>

</body>	