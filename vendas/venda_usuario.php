<?php
$nivel=0;
require_once('../verifica_session.php');
require_once('../database.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

//$_SESSION['list_prod'];

if(!isset($_SESSION['list_prod'])){
	$_SESSION['list_prod'] = array();
	}
	
	if(isset($_GET['acao'])){
		if($_GET['acao']== 'del1'){
		  
		  $id = intval($_GET['id']);
                  if(!isset($_SESSION['list_prod'][$id])){
		  $_SESSION['list_prod'][$id]=1;
		  }else{
			  $_SESSION['list_prod'][$id] -=1;
			  }
			
			}}
	
	if(isset($_GET['acao'])){
		if($_GET['acao']== 'add'){
		  
		  $id = intval($_GET['id']);
		  if(!isset($_SESSION['list_prod'][$id])){
		  $_SESSION['list_prod'][$id]=1;
		  }else{
			  $_SESSION['list_prod'][$id] +=1;
			  }
			
			}
			
				
			
			if($_GET['acao']== 'del'){
		  
		  $id = intval($_GET['id']);
		  if(isset($_SESSION['list_prod'][$id])){
		  unset($_SESSION['list_prod'][$id]);
		  }
			}
			
			if($_GET['acao'] == 'up'){
				if(is_array($_POST['prod'])){
					foreach($_POST['prod'] as $id => $qtd){
						$id = intval($id);
						$qtd = intval($qtd);
						if(!empty($qtd) || $qtd <> 0 ){
						$_SESSION['list_prod'][$id] = $qtd;
							}else{
						unset($_SESSION['list_prod'][$id]);	
								}
							}}}
		
		}
?>
<!DOCTYPE html>
<html lang="pt-br">
 <head>
<meta charset="utf-8">
  <title>Venda dos produtos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="funcs.js"></script>
</head>
<body>

<div class="container"  >
<h1 class="text-info">Vendas</h1>

<br />
 <div class="form-group">
            <a class="btn btn-danger" href="../tela_principal.php">Tela Principal</a> 
</br>
</br>
<a href="../sair.php" class="btn btn-danger">Sair</a>
</div>
<h2 class="text-success">Cliente:</h2>

<?php
$id1=$_SESSION['list_cl'];
foreach($_SESSION['list_cl'] as $i){
		$sql1 = "SELECT * FROM clientes WHERE id_clientes = ?";
		$consulta = $conexao->prepare($sql1);
                $consulta->execute(array($i));
		$dados_cl= $consulta->fetch(PDO::FETCH_ASSOC);
		$nome = $dados_cl['nome'];
		$CPF = $dados_cl['CPF'];
		echo '<h3>'.$nome.'</h3>';
		
		}

?>
</div>
    <div class="container">
        
        
<h1 class="text-primary">Lista de Produtos</h1>
<strong>Buscar produtos:</strong><br />
<input type="text" id="busca"  onKeyUp="buscarprodutos(this.value)" />
</br>
</br>
<div class="row">
<div  id="resultado" class="col">
            
    <table border="3" class="table table-striped" >
<tr>
    <th scope="col">cod. prod</th>
    <th scope="col">produto</th>
    <th scope="col">qtd</th>
    <th scope="col">valor</th>
     <th scope="col">Acoes</th>
  </tr>	
  
 
  
<?php
$sql = "SELECT * FROM produtos LIMIT 0,10";
        $consulta = $conexao->prepare($sql);
        $consulta->execute(array());


		while($lr = $consulta->fetch(PDO::FETCH_ASSOC)){
			if($lr['status'] > 0 && $lr['quantidade'] > 0){
	echo '<tr><td>'.$lr['cod_prod'].'</td><td> Nome: '.$lr['produto'].'</td>
	<td>'.$lr['quantidade'].' </td>
	<td>R$ '.$lr['valor'].' </td><td><a class="btn btn-success" href="venda_usuario.php?acao=add&id='.$lr['id_produto'].'">Adicionar</a></td></tr>';}
		}
		
		?>	
        
    </table>
</div>    
            
    <div class="col">         

<form action="?acao=up" method="post">

<table align="right"  border="3" class="table table-bordered" >

<tr>
    <td align="center" colspan="6" class="bg-info"><p>Relação de produtos<p></td>
</tr>



  <tr>
    <th scope="col">cod. prod</th>
    <th scope="col">produto</th>
    <th scope="col">quant</th>
    <th scope="col">valor</th>
     <th scope="col">vlr soma</th>
      <th scope="col">Acoes</th>
  </tr>
  <?php
  $total=0;
  if(count($_SESSION['list_prod'])==0){
	  echo '<tr><td align="center" class="alert alert-success" colspan="6">nenhum produto selecionado</td></tr>';
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
    <td><input type="text" size="3" name="prod['.$id.']" value="'.$qtd.'"/></td>
    <td>'.$valor.'</td>
    <td>'.number_format($v_somado,2).'</td>
	<td><a class="btn btn-success me-2"href="venda_usuario.php?acao=add&id='.$ln['id_produto'].'">+1</a>'
                        /*. '<a class="btn btn-warning me-2"href="venda_usuario.php?acao=del1&id='.$ln['id_produto'].'">-1</a>'
                        */. '<a class="btn btn-danger"href="venda_usuario.php?acao=del&id='.$ln['id_produto']
                        .'">Remover</a></td>
  </tr>';
               
	  }
	  
	  }
	  
  
  
 
  echo'<tr><td align="right" colspan="6">Total R$: '.$total.'</td></tr>'
  
  ?>
  


  </table>

</br>


</form>
</div>
    <div class="container">  
</br>
<div align="center" class="container">
<form   action="conclui_venda.php" method="post">
<input type="submit" class="btn btn-primary" name="enviar" value="finalizar pedido" />

</form>


</div>
</div>


<div class="container">
<hr/>
		<div class= "foot well">
		<P>&copy; 2016 -Josias Santos de Azevedo </P>
			
		</div></div>
</body>
</html>