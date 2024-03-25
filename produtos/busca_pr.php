<?php

require_once("../database.php");

 

$valor = $_GET['valor'];
 


  $sql = "SELECT * FROM produtos WHERE produto LIKE '%".$valor."%'LIMIT 0,15"
;
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
	  echo '<tr><td>'.$d['cod_prod'].'</td><td>'.$d['produto'].'</td><td>'.$d['valor'].'</td><td>'.$d['descricao'].
	  '</td><td><a class="btn btn-success me-2" href = "ver.php?id_produto='.$d['id_produto'].'">ver</a><a class="btn btn-primary me-2" href = "alterar.php?id_produto='.$d['id_produto'].'"> alterar</a><a class="btn btn-danger" href = "deletar.php?id_produto='.$d['id_produto'].'"> deletar</a></td></tr>';
  }
  
  echo '</tbody>';
   echo '</table>';
  
  
header("Content-Type: text/html; charset=ISO-8859-1",true);
?>