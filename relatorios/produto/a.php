<?php 
$nivel=1;
require_once('../../verifica_session.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Relatorios!</title>
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

	<?php error_reporting(E_ALL);
		ini_set('display_errors','on');
		require_once ('../../database.php');
		
	$dt_inicio = date_format(new DateTime($_POST['dt_inicio']), "Y/m/d H:i:s");
	$dt_final = date_format(new DateTime($_POST['dt_final']), "Y/m/d H:i:s");
	$dt_inicio2 = date_format(new DateTime($_POST['dt_inicio']), "d/m/Y");
	$dt_final2 = date_format(new DateTime($_POST['dt_final']), "d/m/Y");
			
		$sql ='select * from produtos';
		$sql1="SELECT p.produto,p.valor,COUNT(iv.id_produto) AS quan,SUM(iv.quantidade) AS q,
	(p.valor * SUM(iv.quantidade)) AS r
FROM itens_venda iv
left join produtos p
on p.id_produto = iv.id_produto
WHERE data_prod BETWEEN '".$dt_inicio."' and '".$dt_final."'
GROUP BY iv.id_produto ORDER BY r DESC LIMIT 0,10";
		$consulta1 = $conexao->prepare($sql1);
		$consulta1->execute();
		$d = $consulta1->fetchAll(PDO::FETCH_ASSOC);
		
		$dg = array();
		
		$soma_total=0;
$soma_total1=0;
$valor_acumulado3=0;
foreach($d as $l12){
$soma_total1 +=$l12['r'];
$desc = array();
}

foreach($d as $l1){
	
	
		$vlr_somado = $l1['valor'] * $l1['q'];

	$soma_total +=$l1['r'];
	
	$valor_acumulado = $vlr_somado/$soma_total1;
	$valor_acumulado2 = $valor_acumulado * 100;
	
	$valor_acumulado3 += $valor_acumulado2;

		
		
		
	$desc[] = array ("s"=>number_format($valor_acumulado2,2),"l"=>number_format($valor_acumulado3,2),"Lan"=>$l1['produto']);
			
		$dg[] = array("Lan"=>$l1['produto'], "2012"=>$valor_acumulado2,"2013"=>$valor_acumulado3);
		
				}
				
			rsort($desc);
		
			
		$dataText1= json_encode($dg);
	$dataText2= json_encode($desc);
	

		
	
		
		
		
		?>
			
			<h1 class="text-info">Relatórios de Produtos</h1>

<a href="../../tela_principal.php" class="btn btn-danger">Tela principal</a>
<a href="../../sair.php" class="btn btn-danger">Sair</a>
<a href="curvaABC.php" class="btn btn-danger">Voltar</a>
			<h1 class="text-primary"> Curva ABC</h1>
			<h3 class="text-primary">Gráfico de <?php echo $dt_inicio2.' até '.$dt_final2?></h3> 
			
			
			<div id ="myfirstchart" style="height:250px;"></div>
			
	
</div>
<script src="../../js/raphael.js" type="text/javascript"></script>
<script src="../../js/morris.js" type="text/javascript"></script>
<script type="text/javascript">
var dados= <?php echo $dataText2; ?>;
new Morris.Bar({
	element: 'myfirstchart',
	data: dados,
	xkey:['Lan'],
	ykeys: ['l','s'],
labels: ['porcentagem acumulada', 'porcentagem por produto']});
</script>



</body>
</html>
