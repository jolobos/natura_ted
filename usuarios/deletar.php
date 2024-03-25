<?php
$nivel=2;
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

require_once('../database.php');
if(!empty($_GET)){
	$id = $_GET['id_user'];
$sql= 'SELECT * FROM usuarios WHERE id_user= ?';
$consulta = $conexao->prepare($sql);
$consulta->execute(array($id));
$dado = $consulta->fetch(PDO::FETCH_ASSOC);
}
if(!empty($_POST) ){
$id = $_POST['id_user'];
		$sql ='DELETE FROM usuarios 
		WHERE id_user=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($id));
		}catch(PDOException $r){
			$ok = False;
		}catch (Exception $r){
		$ok= False; 
			
		}
			if ($ok){
				$msg= '<p class="alert alert-success" > usuario deletado com sucesso.  </p>';
				}else{
					$msg='<p class="alert alert-danger" > usuario não deletado. Erro.'.$r->getMessage().'</p>';
			}
			header('location:listagem.php?mensagem='.$msg);
		}

?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Deleta Usuario</title>
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
					Deletar Usuario
				</h1>
<div align="left" class="form-group">
            <a class="btn btn-danger" href="../tela_principal.php">Tela Principal</a> 
</br></br>
<a href="../sair.php" class="btn btn-danger">Sair</a>
</div>            
                            </br>
<p class="alert alert-danger">Tem certeza? Este registro sera deletado.</p>

<form action="deletar.php" method="post">
<h4 class="text-primary">Usuario:</h4>

<p>Usuario: <?php echo $dado['usuario'];?> </p>
<p>Administrador: <?php echo $dado['nivel'];?> </p>
<p>Senha: <?php echo $dado['senha'];?> </p>
<input type="hidden" name="id_user" value="<?php echo $dado['id_user'];?>"/>
<input type ="submit" value="Deletar" class="btn btn-danger"/>
<a href = "listagem.php" class="btn btn-success">voltar</a>

</form>
<hr/>
		<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div>
		</div>
		
</body>
</html>
