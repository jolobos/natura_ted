	<?php
$nivel=1;
require_once('../verifica_session.php');
	error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

require_once ('../database.php');

$id = $_GET['id_produto'];
$sql= 'SELECT * FROM produtos WHERE id_produto= ?';
$consulta = $conexao->prepare($sql);
$consulta->execute(array($id));
$dado = $consulta->fetch(PDO::FETCH_ASSOC);

if(!empty($_POST) ){
$cod_prod = $_POST['cod_prod'];
$produto = $_POST['produto'];
$valor = $_POST['valor'];
$descricao = $_POST['descricao'];
$id = $_POST['id_produto'];
		$sql ='UPDATE produtos SET cod_prod=?, produto=?,valor=?,descricao=?
		WHERE id_produto=?';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($cod_prod,$produto,$valor,$descricao,$id));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exce��es
		$ok= False; 
			
		}
			if ($ok){
				$msg= '<p class="alert alert-success" > produto alterado com sucesso.  </p>';
				}else{
					$msg='<p class="alert alert-danger" > produto  nao alterado. Erro.'.$r->getMessage().'</p>';
			}
			header('location:listagem_p.php?mensagem='.$msg);//redireciona para local especificado
	
		}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Altera produtos</title>
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
			<h1 class="text-info"> Altera Produtos</h1>	
		</br>
            
            <div align="left" class="form-group">
            <a class="btn btn-danger" href="../tela_principal.php">Tela Principal</a> </br></br>

<a href="../sair.php" class="btn btn-danger">Sair</a>
</div>            
            
            
            
            
			<form class="form-horizontal" action= "alterar.php" method="post">
				<fieldset>
					<legend class="text-primary">Cadastro de Produtos</legend>
					<div class="form-group" style="max-width: 500px;margin: auto;" >
						<label class="col-md-4 control-label" >Codigo produto: </label>
						<div>
							<input type = "text" name="cod_prod" value="<?php echo $dado['cod_prod']; ?>" class="form-control input-md"/>
						</div>
					</div>
					           
					<div class="form-group" style="max-width: 500px;margin: auto;" >
						<label class="col-md-4 control-label" >Produto: </label>
						<div>
							<input type = "text" name="produto" value="<?php echo $dado['produto']; ?>" class="form-control input-md"/>
						</div>
					</div>
					
					<div class="form-group" style="max-width: 500px;margin: auto;" >
						<label class="col-md-4 control-label">Valor: </label>
						<div>
							<input type = "text" name="valor" value="<?php echo $dado['valor']; ?>"  class="form-control input-md"/>
						</div>
					</div>
					<div class="form-group" style="max-width: 500px;margin: auto;" >
						<label class="col-md-4 control-label" >Descrição: </label>
						<div>
							<input type = "text" name="descricao" value="<?php echo $dado['descricao']; ?>"  class="form-control input-md"/>
						</div>
					</div>
					
							<input type = "hidden" name="id_produto" value="<?php echo $dado['id_produto'] ;?>" />
					
					<div class="form-group text-center mt-2">
						<div>
							<button type=submit class="btn btn-primary ">Gravar </button> 
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
