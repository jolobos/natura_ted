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
<a href="../vendas.php" class="btn btn-danger">Voltar</a>
</br>
</br>
<div>
<h3 class="text-info">Vendas do dia:</h3>

<?php 

	
	$dia = date('Y/m/d');
	$dia_a = date_format(new DateTime($dia), "d/m/Y");
	$dt_inicio = date_format(new DateTime($dia." 00:00:01"), "Y/m/d H:i:s");
	$dt_final = date_format(new DateTime($dia." 23:59:59"), "Y/m/d H:i:s");

	$sql = "SELECT * FROM vendas WHERE data BETWEEN '".$dt_inicio."' and '".$dt_final."'";
$consulta = $conexao->query($sql);
$lr2 = $consulta->fetchALL(PDO::FETCH_ASSOC);

if(empty($lr2)){
	echo '<table  border="3" class="table table-striped">
<tr><th class="bg-dark text-white-50 text-center" colspan="4">Vendas de '.$dia_a.'</th></tr>
<tr><th align="center" class="alert-danger" colspan="4">Nenhuma venda efetuada nesse periodo</th></tr>
</table>
';
	
	
}else{
echo '
<h3 class="text-primary">Vendas de '.$dia_a.'</h3>
<table  border="3" class="table table-striped">
<tr><th class="bg-dark text-white-50 text-center" colspan="4">Vendas de '.$dia_a.'</th></tr>
<tr>
    <th scope="col">Nome do cliente</th>
    <th scope="col">Data da Compra</th>
    <th scope="col">nome do vendedor</th>
    <th scope="col">Ações</th>
    
</tr>';
foreach($lr2 as $lr){
	$id3 = $lr['id_usuario'] ;
	$id2 = $lr['id_cliente'];
	
	$sql2 = "SELECT * FROM clientes WHERE id_clientes = ?";
		$consulta2 = $conexao->prepare($sql2);
        $consulta2->execute(array($id2));
		$dados_cl = $consulta2->fetch(PDO::FETCH_ASSOC);	
		$cliente = $dados_cl['nome'];
		
		$sql4 = "SELECT * FROM usuarios WHERE id_user = ?";
		$consulta4 = $conexao->prepare($sql4);
        $consulta4->execute(array($id3));
		$dados_us = $consulta4->fetch(PDO::FETCH_ASSOC);	
	
	echo '<tr><td>'.$cliente.'</td><td>'.date_format(new DateTime($lr['data']), "d/m/Y H:i:s").'</td>
	<td>'.$dados_us['usuario'].'</td><td><form action="../gera_pdf.php" method="post" target="_blank">
	<input type="hidden" name="id_venda" value="'.$lr['id_venda'].'"/>
	<input class="btn btn-success" type="submit" value="Visualizar"/></form></td></tr>';}
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