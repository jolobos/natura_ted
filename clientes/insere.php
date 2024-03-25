<?php
	$nivel=0;
require_once('../verifica_session.php');
if(!empty($_POST) ){
$nome = $_POST['nome'];
$CPF = $_POST['CPF'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];
require_once ('../database.php');
		$sql ='INSERT INTO clientes(nome,CPF,telefone,email,endereco) values(?,?,?,?,?)';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($nome,$CPF,$telefone,$email,$endereco));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exceções
		$ok= False; 
			
		}
			if ($ok){
				$msg= '<p class="alert alert-success" > cliente inserido com sucesso.  </p>';
				}else{
					$msg='<p class="alert alert-danger" > cliente  não inserido. Erro.'.$r->getMessage().'</p>';
			}
			header('location:listagem.php?mensagem='.$msg);//redireciona para local especificado
	
		}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Insere Clientes</title>
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
                            <div class="container">
			<h1 class="text-info"> Inserir Clientes</h1>	
			
			<form class="form-horizontal" action= "insere.php" method="post">
                           <fieldset >
					<legend class="text-primary">Cadastro de Clientes</legend>
			
					<div class="form-group" style="max-width: 500px;margin: auto;" >
						<label class="col-md-4 control-label"  >Nome: </label>
						<div>
							<input type = "text" name="nome" class="form-control input-md"/>
						</div>
					</div>
                                        <div class="form-group" style="max-width: 500px;margin: auto;" >
						<label class="col-md-4 control-label"  >CPF: </label>
						<div>
							<input type = "text" name="CPF" class="form-control input-md"/>
						</div>
					</div>
                                        <div class="form-group" style="max-width: 500px;margin: auto;" >
						<label class="col-md-4 control-label" >Telefone: </label>
						<div>
							<input type = "text" name="telefone" class="form-control input-md"/>
						</div>
					</div>
                                        <div class="form-group" style="max-width: 500px;margin: auto;" >
						<label class="col-md-4 control-label">E-mail: </label>
						<div>
							<input type = "text" name="email" class="form-control input-md"/>
						</div>
					</div>
                                        <div class="form-group" style="max-width: 500px;margin: auto;" >
						<label class="col-md-4 control-label" >Endereco: </label>
						<div>
							<input type = "text" name="endereco" class="form-control input-md"/>
						</div>
					</div>
                                        <div class="form-group" style="max-width: 500px;margin: auto;" >
						<div class="mt-2" align="center">
							<button type=submit class="btn btn-primary">Gravar </button> 
                            <a class="btn btn-success" href="listagem.php">voltar</a>
						</div>
					</div>		
				</fieldset>
                                 
			</form> 
                            </div>	
		<hr/>
		<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div>
	</div>

</body>
</html>
