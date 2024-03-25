<?php
require_once('../relatorios/vendor/autoload.php');
require_once('../verifica_session.php');
require_once('../database.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
$nivel=0;

$data=date("Y/m/d H:i:s");
$data_per = date("Y/m/d");
foreach($_SESSION['list_cl'] as $i){
		$sql1 = "SELECT * FROM clientes WHERE id_clientes = ?";
		$consulta = $conexao->prepare($sql1);
        $consulta->execute(array($i));
		$dados_cl= $consulta->fetch(PDO::FETCH_ASSOC);
		$cliente = $dados_cl['nome'];
		$CPF = $dados_cl['CPF'];
		$id_cl = $dados_cl['id_clientes'];
		}
		
if(!empty($_SESSION['list_prod']) ){
	
$total = $_POST['total'];	
$id_us	= $_SESSION['id_usuario'];
	
		$sql ='INSERT INTO vendas(data,id_cliente,id_usuario,total,data_periodo) values(?,?,?,?,?)';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($data,$id_cl,$id_us,$total,$data_per));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exce��es
		$ok= False; 
		}
				
		$sql = "SELECT id_venda FROM vendas ORDER BY id_venda DESC LIMIT 1";
		$consulta = $conexao->prepare($sql);
                $consulta->execute(array());
		$lr = $consulta->fetch(PDO::FETCH_ASSOC);
		$id_venda = $lr['id_venda'];


	
foreach($_SESSION['list_prod'] as $id => $qtd){
		  
		$sql ='INSERT INTO itens_venda(id_venda,id_produto,quantidade,data_prod) values(?,?,?,?)';
		try {
		$insercao = $conexao->prepare($sql);
		$ok = $insercao->execute(array ($id_venda,$id,$qtd,$data));
		}catch(PDOException $r){
			//$msg= 'Problemas com o SGBD.'.$r->getMessage();
			$ok = False;
		}catch (Exception $r){//todos as exce��es
		$ok= False; 
			
		}
			
}
			}

			
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Pós Venda</title>
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

<div class="container"  >
<h1 class="text-info">Venda Concluida!!!</h1>
<br />
<h3 class="alert alert-success" align="center">Venda conluida com sucesso!!!! Escolha uma das opções abaixo por favor.</h3>
<br /><div align="center">
<form action="gera_pdf.php" method="post" target="_blank">

<input type="submit"  class="btn btn-success" value="Gerar Comprovante" />
</br>
</br>
</form>
<a class="btn btn-primary" href="esc_cl.php">Nova Venda</a>
</br>
</br><a class="btn btn-danger" href="../tela_principal.php">Tela Principal</a>
</br>
</br><a class="btn btn-danger" href="../sair.php">Sair</a>
</br>
</br></div>

		<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div></div>


</body>			
