<?php

require_once("../database.php");

 

$valor = $_GET['valor'];
 


  $sql = "SELECT * FROM usuarios WHERE usuario LIKE '%".$valor."%'"
;
  $consulta = $conexao->query($sql);
    $dados = $consulta->fetchALL(PDO::FETCH_ASSOC);

  
 
  
  echo ' 

  <table border="3" class = "table table-striped">';
  echo '<thead>';
  echo '<tr>';
  
  echo '<th>Usuario</th><th>Nivel de Usuario</th><th>Açoes</th>';
  
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  
  foreach($dados as $d){
	  echo '<tr><td >'.$d['usuario'].'</td><td>'.$d['nivel'].'</td><td><a class="btn btn-success me-2" href="ver.php?id_user='.$d['id_user'].'">ver</a><a class="btn btn-primary me-2" href = "alterar.php?id_user='.$d['id_user'].'"> alterar</a><a class="btn btn-danger"href = "deletar.php?id_user='.$d['id_user'].'"> deletar</a></td></tr>';
  }
  
  echo '</tbody>';
   echo '</table> ';
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>