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

<a href="../../tela_principal.php" class="btn btn-danger">Tela principal</a>
<a href="../sair.php" class="btn btn-danger">Sair</a>
<a href="index.php" class="btn btn-danger">Voltar</a>
<a href="valores_diarios_dt.php" class="btn btn-warning">valores mensais</a>
<a href="valores_diarios_dt_a.php" class="btn btn-warning">valores anuais</a>
</br>
</br>
<h3 class="text-info">Digite a data que você deseja pesquisar :</h3>
<form action="valores_diarios.php" method="post" >
<input type="date" name="dt_inicio"/>
<a>até</a>
<input type="date" name="dt_final"/>
<input type="submit" class="btn btn-success" value="pesquisar"/>
</form>
<h3 class="text-info">Totais de vendas por dia	:</h3>
<div id="resultado">
<?php
	
if(empty($_POST['dt_inicio']) or empty($_POST['dt_final'])){
		
		echo '</br><a class="alert alert-danger">nenhuma data selecionada!</a>';
		
	}else{
	
	$dt_inicio = $_POST['dt_inicio'];
	$dt_final = $_POST['dt_final'];
	
	$sql = "SELECT * FROM vendas WHERE data_periodo BETWEEN '".$dt_inicio."' and '".$dt_final."'";
        $consulta = $conexao->query($sql);

        $lr2 = $consulta->fetchALL(PDO::FETCH_ASSOC);

if(empty($lr2)){
echo'	<table  border="3" class="table table-striped">
<tr><th class="bg-dark text-white-50 text-center">Vendas de '.date_format(new DateTime($dt_inicio), "d/m/Y").' até '.date_format(new DateTime($dt_final), "d/m/Y").'</th></tr>
<tr><th align="center" class="alert-danger">Nenhuma venda efetuada nesse periodo</th></tr>
</table>
';
	
	
}else{
	
echo'	<table  border="3" class="table table-striped">
<tr><th class="bg-dark text-white-50 text-center" colspan="5">Valores Arrecadados !!!!</th></tr>
<tr>
    
    <th scope="col">datas pesquisadas </th>
    <th scope="col">totais diarios</th>
    <th scope="col">totais acumulados</th>
    <th scope="col">percentual</th>
    <th scope="col">percentual acumulado</th>

</tr>';
$sql = "SELECT data,data_periodo,SUM(total) AS q FROM vendas WHERE data_periodo BETWEEN '".$dt_inicio."' and '".$dt_final."' GROUP BY data ";
$consulta = $conexao->prepare($sql);
$consulta->execute(array());
$lr1 = $consulta->fetchALL(PDO::FETCH_ASSOC);
$vl_somado=0;
$vl_somado1 =0;
$vl_ss = 0;
$vl_perc = 0;
$vl_perc_ac=0;
foreach($lr1 as $l1){
	$vl_somado1 += $l1['q'];
}
foreach($lr1 as $l){
	$vl_somado += $l['q'];
	$vl_ss = $l['q']/$vl_somado1;
	$vl_perc = $vl_ss * 100;
	$vl_perc_ac += $vl_perc;
	echo '<tr><td>'.date_format(new DateTime($l['data']), "d/m/Y").'</td>
	<td >$ '.$l['q'].'</td>
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