<?
use app\models\Firma;

//$path1 = Yii::getAlias("@vendor/setasign/fpdf/fpdf.php");
$path2 = Yii::getAlias("@vendor/setasign/fpdf/rotation.php");

//require_once($path1);
require_once($path2);



class PDF extends PDF_Rotate
{
  public $estado;
  function RotatedText($x,$y,$txt,$angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}

// Cabecera de página
function Header()
{
    ///////////////////MARCA DE AGUA//////////////////////
      if ($this->estado =='PENDIENTE'){
        $this->SetFont('Arial','B',50);
        $this->SetTextColor(255,192,203);
        $this->RotatedText(35,215,'INFORME PENDIENTE',35);
      }
    /////////////////////////////////////////////////////
  $this->SetTextColor(245,245,245);
  $this->Image('http://localhost/patologiahaz/web/img/hospitalzatti.png',47,25,18);
  $this->SetFont('Arial','',6);
  $this->SetTextColor(0,0,0);
  // $this->Cell(0,5,'Documento Generado el '.date("d/m/Y - H:i"),0,0,'R');
  $this->Ln(20);
  $this->SetFont('Times','B',17);
  $this->Cell(215,5,'HOSPITAL ARTEMIDES ZATTI',0,0,'C');
  $this->Ln(6);
  $this->SetFont('Times','I',17);
  $this->Cell(0,5,'Area Programa Viedma',0,0,'C');


  $this->Ln(11);
}

// Pie de página
function Footer()
{
  // Posición: a 1,5 cm del final
        //  $this->SetY(-15);
          // Arial italic 8
        //  $this->SetFont('Arial','I',8);
          /* Cell(ancho, alto, txt, border, ln, alineacion)
           * ancho=0, extiende el ancho de celda hasta el margen de la derecha
           * alto=10, altura de la celda a 10
           * txt= Texto a ser impreso dentro de la celda
           * border=T Pone margen en la posición Top (arriba) de la celda
           * ln=0 Indica dónde sigue el texto después de llamada a Cell(), en este caso con 0, enseguida de nuestro texto
           * alineación=C Texto alineado al centro
           */
        //  $this->Cell(0,10,utf8_decode ('Hospital "Artémides ZATTI" - Rivadavia 391 - (8500) Viedma - Río Negro'),'T',0,'C');


        //Posici�n: a 3,5 cm del final
        $this->SetY(-20);
        //Arial italic 7
        $this->SetFont('Arial','',7);
        //N�mero de p�gina
        $this->Ln(2);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().' de {nb}',0,0,'C');
        $this->Ln(4);
        $this->SetFont('Arial','',7);
        $this->Cell(0,10,utf8_decode('Hospital "Artémides ZATTI" - Rivadavia 391 - (8500) Viedma - Río Negro'),0,0,'C');
        $this->Ln(3);
        $this->Cell(0,10,'Tel. 02920 - 427843 | Fax 02920 - 429916 / 423780',0,0,'C');
 


}
}

// Creación del objeto de la clase heredada
$pdf = new PDF('P','mm','A4'); 

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times','',12);

$pdf->SetFont('Courier','B',8);
//$pdf->SetTextColor(0,0,0);
// $pdf->SetFillColor(255,255,255);
// $pdf->Cell(0,36,'',1,1,'L',1);
$pdf->Line(68, 25, 68, 45); 
$Inicio = 80;
$pdf->SetFont('Times','',21);
$pdf->Text(17,$Inicio,utf8_decode("Certifico que ".$model->nombre." ".$model->apellido));
$Inicio=$Inicio +13;
$pdf->Text(17,$Inicio, "DNI ".$model->dni.", debe permanecer en aislamiento social");
$Inicio=$Inicio +13;
$pdf->Text(17,$Inicio,"preventivo por ser caso positivo de COVID-19 desde la fecha");
$Inicio=$Inicio +13;
$pdf->Text(17,$Inicio,utf8_decode("hasta el alta médica."));
$Inicio=$Inicio +110;
$pdf->Text(17,$Inicio,"Viedma, ".$model->inicia_aislamiento);


$pdf->SetFont('Times','',10);
// $pdf->Text(35,$Inicio,$model->nombre.' '.$model->apellido);
// $pdf->SetFont('Times','B',10);
// $pdf->Text(120,$Inicio,"FECHA:");

;

$modelo= new Firma();
$firma= $modelo::findOne(1);

// $pdf->Image($firma->path,148,$Inicio - 8,34 );
$carpeta = Yii::getAlias("@app/");

$Inicio = 200;
$pdf->Image($carpeta.$firma->path,105,$Inicio - 35,75 );

$pdf->Ln();

$Inicio = 49;

$x = 100;
$y = 200;
$s = 50;
$background = array(250,250,250);
$color = array(0,0,0);
// $qrcode->displayFPDF($pdf, $x, $y, $s, $background, $color);

$pdf->Output();


exit;
?>
