<?php
session_start();


error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

require_once('database.php');
if(empty($_POST)){
	$msg = 'campos do formulario estao vazios!';
	} else{
		
		if($_POST['usuario']!='' and $_POST['senha']!='' and isset($_POST['usuario']) and isset($_POST['senha'])){
			$usuario = $_POST['usuario'];
			
			
			
			$sql = 'SELECT * FROM usuarios WHERE usuario=?';
			$consulta = $conexao->prepare($sql);
			$consulta->execute(array($usuario));
			$dado = $consulta->fetch(PDO::FETCH_ASSOC);
			$res = $consulta->rowCount();
			$senha = md5($_POST['senha']);
			
			if($res==1){
				if($senha==$dado['senha']){
				$msg= 'Bem vindo!';
				$_SESSION['usuario'] = $dado['usuario'];
				$_SESSION['id_usuario'] = $dado['id_user'];
				$_SESSION['vida'] = 1000								; //segundos
				$_SESSION['decorrido'] = time();
				$_SESSION['nivel'] = $dado['nivel'];

				header('location:tela_principal.php?mens='.$msg);
				}else{
					$msg='Nome de usuario ou senha invalidos.';
				header('location:index.php?mens='.$msg);

					}
			}else{
				$msg= 'Nome de usuario ou senha invalidos.';
			header('location:index.php?mens='.$msg);
			
			}
		
		
		}
	}



/*
dados persistentes(autenticação)
cookies= sao criados no servidor e enviados para o navegador. são arquivos 
que contem dados sobre o usuario(criptografados ou nao).

sessoes(session)= sao criados e armazenados no servidor. sao arquivos que contem dados( criptografados ou nao) dos usuarios.


*/
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_login.css">
    <title>Login</title>
</head>
<body>
    <div class="main-login">
        <div class="left-login">
            <h1>Faça login <br> E tenha acesso aos seus serviços</h1>
            <img src="img/codeInJS.svg" alt="" class="image-login">
        </div>
        <form action="index.php" method="post">
        <div class="rigth-login">
            <div class="card-login">
                <h1>LOGIN</h1>
                <div class="textfield">
                    <label for="usuario">Usuário</label>
                    <input type="text" name="usuario" placeholder="Usuário">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <input class="btn-login" type="submit" value="Entrar">
                </form>
               
            </div>
        </div>

    </div>
</body>
</html>