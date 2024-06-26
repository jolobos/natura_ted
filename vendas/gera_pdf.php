
<?php
$nivel=0;

require_once('../relatorios/pdf/fpdf.php');
require_once('../verifica_session.php');
require_once('../database.php');
error_reporting(E_ALL);
ini_set('display_errors','on');
date_default_timezone_set('America/Sao_Paulo');

$data=date("d/m/Y");

foreach($_SESSION['list_cl'] as $i){
		$sql1 = "SELECT * FROM clientes WHERE id_clientes = ?";
		$consulta = $conexao->prepare($sql1);
        $consulta->execute(array($i));
		$dados_cl= $consulta->fetch(PDO::FETCH_ASSOC);
		$cliente = $dados_cl['nome'];
		$CPF = $dados_cl['CPF'];
		
		}

		$user = $_SESSION['usuario'];
		

	
$doc = new FPDF("p", "mm", "A4");

$doc-> SetTitle("Comprovante");
$doc-> SetSubject("Vendas");
$doc->SetY("-1");
$doc->SetFont('arial','bi',20);


$cont="Criado por Josias Santos";
$texto=$data;
$doc-> Cell(0,12,"Comprovante de Venda",0,1,"C");
$doc->SetFont('arial','bi',12);
$doc-> Cell(0,8,"data: ".$data."",0,1,"L");
$doc-> Cell(0,8,"Vendedor: ".$user."",0,1,"L");
$doc-> Cell(0,8,'Cliente: '.$cliente.' CPF: '.$CPF,0,1,"L");

$doc->Cell(0,0,'',1,1,'L');
$doc-> Cell(0,10,"Produtos Vendidos ",0,1,"C");

$doc->Cell(0,1,"",0,1,"L");


$doc-> SetFont('Arial','',12);

$doc->ln();
$doc->Cell(40,7,'cod. prd.');
$doc->SetX(40);
$doc->Cell(40,7,'produto');
$doc->SetX(120);
$doc->Cell(40,7,'quantidade');
$doc->SetX(145);
$doc->Cell(40,7,'valor unid.');
$doc->SetX(170);
$doc->Cell(40,7,'valor somado');
$doc->SetX("0");
$doc->ln();

$doc->Cell(0,0,'',1,1,'L');
$doc->ln();
$doc->ln();
$doc->ln();	


$total=0;
foreach($_SESSION['list_prod'] as $id_p => $quantidade){
	
  $sql2 = "SELECT * FROM produtos WHERE id_produto = ?";
  $consulta2 = $conexao->prepare($sql2);
  $consulta2->execute(array($id_p));
  $ls =$consulta2->fetch(PDO::FETCH_ASSOC); 
  
  $cod_prod = $ls['cod_prod'];
  $produto = $ls['produto'];
  $vl_prod = $ls['valor'];
  $descricao = $ls['descricao'];
  
  $v_somado = $vl_prod * $quantidade;
  $total += $v_somado;
  
  
    $doc->ln();	
    $doc->Cell(40, 10, $cod_prod); 
    $doc->SetX(40);
    $doc->Cell(40, 10,$produto); 
    $doc->SetX(125);
    $doc->Cell(40, 10,$quantidade);  
    $doc->SetX(145);
    $doc->Cell(40, 10,'R$ '. $vl_prod);   
    $doc->SetX(170);
    $doc->Cell(40, 10,'R$ '.number_format($v_somado,2));  
    $doc->SetX(175);
}
$doc->SetY("21");
$doc->SetX("30");
$doc->SetY("250");
$doc->Cell(0,0,'',1,1,'L');
$doc->Cell(0,10,'Total:',0,0,'L');
$doc->Cell(0,10,'R$ '.number_format($total,2),0,1,'R');
$doc->SetY("270");
$doc->SetFont('arial','',12);
$doc->Cell(0,0,'',1,1,'L');
$doc->Cell(0,5,$cont,0,0,'L');
$doc->Cell(0,5,$texto,0,1,'R');
$doc->Output("".$cliente." ".$data.".pdf","I");

	

	

?>