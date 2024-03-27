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

<h1 class="text-info">Relatórios</h1>

<a href="../../tela_principal.php" class="btn btn-danger">Tela principal</a>
<a href="../../sair.php" class="btn btn-danger">Sair</a>
<a href="usuarios.php" class="btn btn-danger">voltar</a>
</br>
</br>

<div>

<?php

$lr1 = $_POST['id_usuarios'];

	
		$sql2 = "SELECT * FROM vendas WHERE id_usuario = ?";
		$consulta2 = $conexao->prepare($sql2);
        $consulta2->execute(array($lr1));
	$lr2 = $consulta2->fetch(PDO::FETCH_ASSOC);

if(empty($lr2)){
	
	
echo '
</br>
<a class="alert alert-danger">Lamento mas seu usuario não possui nenhuma venda registrada.</a>';


	}else{
	
echo '<h3 class="text-primary"> Vendas efetuadas pelo usuario: </h3>
<table  border="3" class="table table-striped">
<tr>
    
    <th scope="col">nome do usuario </th>
    <th scope="col">data da venda</th>
    <th scope="col">nome do cliente</th>
	<th scope="col">Ações</th>
</tr>';
	while($lr = $consulta2->fetch(PDO::FETCH_ASSOC)){
	$id3 = $lr['id_usuario'];
	$id = $lr['id_cliente'];
		
		
		$sql = "SELECT * FROM clientes WHERE id_clientes = ?";
		$consulta = $conexao->prepare($sql);
        $consulta->execute(array($id));
		$d = $consulta->fetch(PDO::FETCH_ASSOC);	
	
	
		
		
		$sql4 = "SELECT * FROM usuarios WHERE id_user = ?";
		$consulta4 = $conexao->prepare($sql4);
        $consulta4->execute(array($id3));
		$dados_us = $consulta4->fetch(PDO::FETCH_ASSOC);	
	
		
	
	echo '<tr><td>'.$dados_us['usuario'].'</td><td>'.date_format(new DateTime($lr['data']), "d/m/Y H:i:s").'</td>
	<td>'.$d['nome'].'</td><td><form action="../gera_pdf.php" method="post" target="_blank">
	<input type="hidden" name="id_venda" value="'.$lr['id_venda'].'"/>
        <input class="btn btn-success" type="submit" value="Visualizar"/></form></td></tr>'; 

}

echo '</table>';}		

?>
</div>
</div>
<div class="container"><hr/>
<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div></div>
</body>