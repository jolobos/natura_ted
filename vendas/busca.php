<?php

require_once("../database.php");

 

$valor = $_GET['valor'];
 


  $sql = "SELECT * FROM produtos WHERE produto LIKE '%".$valor."%'"
;
  $consulta = $conexao->query($sql);
  
  
echo '    <table border="3" class="table table-striped" >

<tr>
    <th scope="col">cod. prod</th>
    <th scope="col">produto</th>
    <th scope="col">qtd</th>
    <th scope="col">valor</th>
     <th scope="col">Acoes</th>
  </tr>	';
  
  while($lr = $consulta->fetch(PDO::FETCH_ASSOC)){
	if($lr['status'] > 0 && $lr['quantidade'] > 0){
	echo '<tr><td>'.$lr['cod_prod'].'</td><td> Nome: '.$lr['produto'].'</td>
	<td> '.$lr['quantidade'].' </td>
	<td>R$ '.$lr['valor'].' </td><td><a class="btn btn-success" href="venda_usuario.php?acao=add&id='.$lr['id_produto'].'">Adicionar</a></td></tr>';}
		
	}
	  
		
	header("Content-Type: text/html; charset=utf8",true);
?>