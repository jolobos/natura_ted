<?php
	$nivel=0;
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

require_once('../database.php');
if(!empty($_GET)){
	$id = $_GET['id_clientes'];
$sql= 'SELECT * FROM clientes WHERE id_clientes= ?';
$consulta = $conexao->prepare($sql);
$consulta->execute(array($id));
$dado = $consulta->fetch(PDO::FETCH_ASSOC);
}
if(!empty($_POST) ){
$id = $_POST['id'];
		$sql ='DELETE FROM clientes 
		WHERE id_clientes=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($id));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$msg= '<p class="alert alert-success" > cliente deletado com sucesso.  </p>';
				}else{
					$msg='<p class="alert alert-danger" > cliente  não deletado. Erro.'.$r->getMessage().'</p>';
			}
			header('location:listagem.php?mensagem='.$msg);//redireciona para local especificado
	
		}

?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Deleta Clientes</title>
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
				<h1 class="text-info">
					Deleta Clientes
				</h1>

<div align="left" class="form-group">
  <a class="btn btn-danger" href="../tela_principal.php" >Tela principal</a></br></br>
<a href="../sair.php" class="btn btn-danger">Sair</a>
</div>
<p class="alert alert-danger mt-3">Tem certeza? Este cliente sera deletado.</p>

<form action="deletar.php" method="post">

<p>Nome: <?php echo $dado['nome'];?> </p>
<p>CPF: <?php echo $dado['CPF'];?> </p>
<p>Telefone: <?php echo $dado['telefone'];?> </p>
<p>E-mail: <?php echo $dado['email'];?> </p>
<p>Endereco: <?php echo $dado['endereco'];?> </p>
<input type="hidden" name="id" value="<?php echo $dado['id_clientes'];?>"/>
<input type ="submit" value="Deletar" class="btn btn-danger"/>
<a href = "listagem.php" class="btn btn-success">voltar</a>

</form>

<hr/>
		<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div></div>
</body>
</html>
