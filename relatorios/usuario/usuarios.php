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
    <script src="func_cl.js"></script>
</head>
<body>

<div class="container">

<h1 class="text-info">Relatórios</h1>

<a href="../../tela_principal.php" class="btn btn-danger">Tela principal</a>
<a href="../../sair.php" class="btn btn-danger">Sair</a>
<a href="../index.php" class="btn btn-danger">voltar</a>
<a href="top10dia.php" class="btn btn-warning">Ranking diario</a>
<a href="top10mes.php" class="btn btn-warning">Ranking mensal</a>
<a href="top10ano.php" class="btn btn-warning">Ranking anual</a>

</br>
</br>

<h3 class="text-primary"> Selecione um usuário:</h3>
<p>Buscar: 
<input type="text" id="busca"  onKeyUp="buscar_cliente(this.value)" /></p>
</br>
<div id="resultado">

<?php
$sql1 = "SELECT * FROM usuarios ";
		$consulta = $conexao->query($sql1);
		
		echo '
<table  border="3" class="table table-striped" style="width: 500px;margin:auto;">
<tr>
    
    <th scope="col">nome do usuario </th>
    <th scope="col">nivel</th>
    
	<th scope="col">Ações</th>
</tr>';
		
	while($d = $consulta->fetch(PDO::FETCH_ASSOC)){  echo '<tr><td>'.$d['usuario'].'</td><td>'.$d['nivel'].'</td><td>
	<form action="p_usuario.php" method="post">
	  <input type="hidden" name="id_usuarios" class="btn btn-success" value="'.$d['id_user'].'"/>
	  <input type="submit" class="btn btn-success" value="Pesquisar"/></form></td></tr>';
	}
  
  echo '</tbody>';
   echo '</table>';
  

		
?></div>
</div><div class="container"><hr/>
<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
		</div></div>

</body>