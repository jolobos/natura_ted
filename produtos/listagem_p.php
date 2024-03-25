<?php
$nivel=1;
require_once('../verifica_session.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');
require_once('../database.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Lista de Produtos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
     <script type="text/javascript" src="func_pr.js"></script>
</head>

<body>
			<div class="container">
				<h1 class="text-info">
					Lista de Produtos
				</h1>
			

<div align="left" class="form-group">
            <a class="btn btn-danger" href="../tela_principal.php">Tela Principal</a> </br></br>

<a href="../sair.php" class="btn btn-danger">Sair</a>
</div>      <h4>Buscar: <input type="text" id="busca"  onKeyUp="buscarprodutos(this.value)" />
</h4></br>
  <div id="resultado">      



<?php
if(!empty($_GET['mensagem'])){
	echo $_GET['mensagem'];
}
?>


<?php

 if (!empty($erro)){
	 echo '<p> houve um problema no acesso ao banco de dados contate o administrador e diga que ocorreu o erro <b>'.$erro.'</b></p>';
 }
  
  $sql = 'SELECT * FROM produtos LIMIT 0,15';
  $consulta = $conexao->query($sql);
  $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);
  echo '<div class="form-group"><a class="btn btn-warning" href="insere.php">inserir</a></div></br>';
  
  
  echo '<table  border="3" class="table table-striped" >';
  echo '<thead>';
  echo '<tr>';
  
  echo '<th>codigo do produto</th><th>Produto</th><th>Valor</th><th>Descriçao</th><th>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
  foreach($dados as $d){
	  echo '<tr><td>'.$d['cod_prod'].'</td><td>'.$d['produto'].'</td><td>$ '.$d['valor'].'</td><td>'.$d['descricao'].
	  '</td><td><a class="btn btn-success me-2" href = "ver.php?id_produto='.$d['id_produto'].'">ver</a><a class="btn btn-primary me-2" href = "alterar.php?id_produto='.$d['id_produto'].'"> alterar</a><a class="btn btn-danger" href = "deletar.php?id_produto='.$d['id_produto'].'"> deletar</a></td></tr>';
  }
  
  echo '</tbody>';
   echo '</table>';
  
  
  ?>
  
  </div>
  <hr/>
		<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
				
		</div>
	
	
	</div>
</body>
</html>
