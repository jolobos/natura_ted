<?php
$nivel=0;
require_once('../verifica_session.php');
require_once('../database.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Conclusão da venda</title>
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
<h1 class="text-info">Vendas</h1>

<br />
 <div  class="form-group">
            <a class="btn btn-danger" href="../tela_principal.php">Tela Principal</a> 
</br></br>
<a href="../sair.php" class="btn btn-danger">Sair</a>
</br></br>
<a  class="btn btn-secondary" href="venda_usuario.php" >vender mais...</a></div></br> 


<h3 align="center" class="alert alert-success">Tem certeza que deseja vender esses itens?</h3>




<table style=" width:800px" border="3" class="table table-bordered" align="center">

<tr>
<td align="center" colspan="5" class="text-white-50 bg-dark"> Produtos Selecionados</td>
</tr>



  <tr>
    <th scope="col">codigo do produto</th>
    <th scope="col">produto</th>
    <th scope="col">quantidade</th>
    <th scope="col">valor</th>
     <th scope="col">vlr somado</th>
      
  </tr>
  <?php
  $total=0;
  if(count($_SESSION['list_prod'])==0){
	  echo '<tr><td align="center" class="alert-danger" colspan="6">Selecione algum produto por favor!!!</td></tr>';
	  }else{
	  foreach($_SESSION['list_prod'] as $id => $qtd){
		  
		  
		  
		$sql = "SELECT * FROM produtos WHERE id_produto= ?";
		$consulta = $conexao->prepare($sql);
                $consulta->execute(array($id));
                $ln =$consulta->fetch(PDO::FETCH_ASSOC);
		
		$cod_prod = $ln['cod_prod'];
		$produto = $ln['produto'] ;
		$valor = $ln['valor'];
		$v_somado = $ln['valor'] * $qtd;
		$total += $v_somado;
		
		echo' <tr>
    <td>'.$cod_prod.'</td>
    <td>'.$produto.'</td>
    <td>'.$qtd.'</td>
    <td>'.$valor.'</td>
    <td>'.number_format($v_somado,2).'</td>
  </tr>';
	  }
	  
	  }
	  
  
  
 
  echo'<tr><td align="right" colspan="5">Total R$: '.number_format($total,2).'</td></tr>';



  ?>
  </table>

</br>

<?php
echo '<div align="center"><form  action="pos_venda.php" method="post">

<input type="hidden" name="total" value="'.$total.'"/>
<input class="btn btn-success" type="submit" value="Concluir Venda"/>
</form></div>';?>
<hr/>
		<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div></div>


</body>