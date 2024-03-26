<?php
require_once('../verifica_session.php');
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
</head>
<body>

<div class="container">

<h1 class="text-info">Relatórios</h1>
<a href="../tela_principal.php" class="btn btn-danger">Tela principal</a>
<a href="../sair.php" class="btn btn-danger">Sair</a>
<a href="index.php" class="btn btn-danger">Voltar</a>

<a href="venda/v_anuais.php" class="btn btn-warning">Vendas anuais</a>
<a href="venda/v_mensais.php" class="btn btn-warning">Vendas mensais</a>
<a href="venda/v_dia.php" class="btn btn-warning">Vendas do dia</a>
<a href="venda/pes_venda.php" class="btn btn-warning">Pesquisar venda</a>

<h3 class="text-primary">Digite a data que você deseja pesquisar:</h3>
<?php
	header("Content-Type: text/html; charset=utf-8",true);



echo '<form  action="vendas.php" method="post">
<div class="row">
<div class="col-sm-2">
<input type="date" name="dt_inicio" class="form-control"/></div>
<div class="col-sm-1 mt-2" align="center">
<h5> até </h5></div>
<div class="col-sm-2">
<input type="date" name="dt_final" class="form-control"/></div>
<div class="col">
<input type="submit" class="btn btn-success" value="pesquisar"/></div>

';
echo "</form>";



echo '<h3 class="text-primary">Resultado:</h3></br>';

if(empty($_POST['dt_inicio'])){
	
	echo '<a class="alert alert-danger">nenhuma data selecionada!</a>';
	
}else{
	
$dt_inicio = date_format(new DateTime($_POST['dt_inicio']), "Y/m/d H:i:s");
$dt_final = date_format(new DateTime($_POST['dt_final']."23:59:59" ), "Y/m/d H:i:s");

$sql = "SELECT * FROM vendas WHERE data BETWEEN '".$dt_inicio."' and '".$dt_final."'";
$consulta = $conexao->query($sql);


echo '

<table  border="3" class="table table-striped" >
<tr>
    <th scope="col">Nome do cliente</th>
    <th scope="col">Data da Compra</th>
    <th scope="col">nome do vendedor</th>
    <th scope="col">Ações</th>
    
</tr>';
while($lr = $consulta->fetch(PDO::FETCH_ASSOC)){
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
	<td>'.$dados_us['usuario'].'</td><td><form action="gera_pdf.php" method="post" target="_blank">
	<input type="hidden" name="id_venda" value="'.$lr['id_venda'].'"/>
	<input class="btn btn-success" type="submit" value="Visualizar"/></form></td></tr>';}
	echo '</table></hr>';

}
	
?>

		
</div><div class="container"></br><hr/>
<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div></div>
</body>