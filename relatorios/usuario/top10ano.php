<?php
require_once('../../verifica_session.php');
require_once('../../database.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
$nivel=1;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Relatórios do usuário</title>
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

<h1 class="text-info">Relatórios de Vendas</h1>

<a href="../../tela_principal.php" class="btn btn-danger">Tela principal</a>
<a href="../../sair.php" class="btn btn-danger">Sair</a>
<a href="../usuario/usuarios.php" class="btn btn-danger">Voltar</a>
</br>
</br>
<div>
<form action="top10ano.php" method="post">

<div class="row">
    <div class="col-sm-1">
<select name="ano" class="label-success form-control">
<option value="">ANO</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
</select>    </div>
    <div class="col-sm-2">
<input type="submit" class="btn btn-success" value="pesquisar"/>
    </div></div></form>

<h3 class="text-info">Resultado:</h3>
</br>

<?php 




	if(empty($_POST['ano'])){
		
		echo '<a class="alert alert-danger">nenhuma data selecionada!</a>';
		
	}else{
	
	$ano = $_POST['ano'];
	
	$dt_inicio = date_format(new DateTime($ano."-01-01 "), "Y/m/d H:i:s");
	$dt_final = date_format(new DateTime($ano."-12-31 "), "Y/m/d H:i:s");
	
		$sql = "SELECT data FROM vendas WHERE data BETWEEN '".$dt_inicio."' and '".$dt_final."' ";
	$consulta = $conexao->prepare($sql);
	$consulta->execute(array());
	$lr200 = $consulta->fetch(PDO::FETCH_ASSOC);
		
if(empty($lr200)){
	echo '<table border="3" class="table table-striped" style="width:500px;margin:auto;">
<tr><th class="text-center bg-dark text-white-50">Vendas de '.$ano.'</th></tr>
<tr><th align="center" class="alert-danger">Nenhuma venda efetuada nesse periodo</th></tr>
</table>
';
	
	
}else{
echo '
<h3 class="text-primary">Vendas de '.$ano.'</h3>
<table border="3" class="table table-striped" style="width:500px;margin:auto;">
<tr><th class="text-center bg-dark text-white-50" colspan="2">Ranking dos Vendedores!!!!</th></tr>
<tr>
    <th scope="col">Nome do vendedor</th>
    <th scope="col">numero de vendas no ano</th>
    
    
</tr>';

	$sql = "SELECT id_usuario, COUNT(id_usuario) AS q FROM vendas WHERE data BETWEEN '".$dt_inicio."' and '".$dt_final." '
	GROUP BY id_usuario ORDER BY q DESC ";
	$consulta = $conexao->prepare($sql);
	$consulta->execute(array());
	$lr2 = $consulta->fetchALL(PDO::FETCH_ASSOC);
	
	foreach($lr2 as $l){
			
		$sql4 = "SELECT * FROM usuarios WHERE id_user = ? ";
		$consulta4 = $conexao->prepare($sql4);
        $consulta4->execute(array($l['id_usuario']));
		$dados_us = $consulta4->fetch(PDO::FETCH_ASSOC);
		
	if($l['q'] >0){	
	
	echo '<tr><td>'.$dados_us['usuario'].'</td><td>'.$l['q'].'</td></tr>'	;
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