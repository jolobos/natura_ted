	<?php
$nivel=2;
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

require_once ('../database.php');

$id = $_GET['id_user'];
$sql= 'SELECT * FROM usuarios WHERE id_user= ?';
$consulta = $conexao->prepare($sql);
$consulta->execute(array($id));
$dado = $consulta->fetch(PDO::FETCH_ASSOC);

if(!empty($_POST) ){
$usuario = $_POST['usuario'];
$nivel = $_POST['nivel'];
$senha = md5($_POST['senha']);
$id = $_POST['id_user'];
		$sql ='UPDATE usuarios SET usuario=?,nivel=?,senha=?
		WHERE id_user=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($usuario,$nivel,$senha,$id));
		}catch(PDOException $r){
			$ok = False;
		}catch (Exception $r){
		$ok= False; 
			
		}
			if ($ok){
				$msg= '<p class="alert alert-success" > usuario alterado com sucesso.  </p>';
				}else{
					$msg='<p class="alert alert-danger" > usuario  nao alterado. Erro.'.$r->getMessage().'</p>';
			}
			header('location:listagem.php?mensagem='.$msg);
		}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>altera usuario</title>
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
			<h1 class="text-info"> Altera Usuarios</h1>	
		    <div align="left" class="form-group">
            <a class="btn btn-danger" href="../tela_principal.php">Tela Principal</a> 
</br></br>

<a href="../sair.php" class="btn btn-danger">Sair</a>
</div>            
            
			<form class="form-horizontal" action= "alterar.php" method="post">
				<fieldset>
					<legend class="text_primary">Cadastro de Usuarios</legend>
			
                                        <div class="form-group" style="max-width: 500px;margin: auto;">
						<label class="col-md-4 control-label">Usuario: </label>
						<div>
							<input type = "text" name="usuario" value="<?php echo $dado['usuario']; ?>" class="form-control input-md"/>
						</div>
					</div>
                                        <div class="form-group" style="max-width: 500px;margin: auto;">
						<label class="col-md-4 control-label">Nivel de Usuario: </label>
						<div>
							<input type = "text" name="nivel" value="<?php echo $dado['nivel']; ?>"  class="form-control input-md"/>
						</div>
					</div>
                                        <div class="form-group" style="max-width: 500px;margin: auto;">
						<label class="col-md-4 control-label">Senha: </label>
						<div>
							<input type = "text" name="senha" placeholder="senha"  class="form-control input-md"/>
						</div>
					</div>
						<input type = "hidden" name="id_user" value="<?php echo $dado['id_user'] ;?>" />
					
					<div class="form-group text-center mt-2">
						<div>
							<button type=submit class="btn btn-primary">Gravar </button> 
						</div>
					</div>		
				</fieldset>
			</form> 
				
		<hr/>
		<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div>
	</div>

</body>
</html>
