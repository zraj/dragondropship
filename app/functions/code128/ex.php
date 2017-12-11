<?php
require('code128.php');

$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

//A set
$code='FML01S34';
$height = 12;
$rowoffset = 18;
/*$pdf->Code128(50,20,$code,80,20);
$pdf->SetXY(50,45);
$pdf->Write(5,$code);

$code='DDL01S45';
$pdf->Code128(50,70,$code,50,20);
$pdf->SetXY(50,95);
$pdf->Write(5,$code);*/

for($i=0;$i<15;$i++){
	/* $pdf->Code128(10,5 + ( $i * 35),$code,50,20);
	$pdf->SetXY(10,25 + ( $i * 35));
	$pdf->Write(5,$code);
	
	$pdf->Code128(70,5 + ( $i * 35),$code,50,20);
	$pdf->SetXY(70,25 + ( $i * 35));
	$pdf->Write(5,$code);
	
	$pdf->Code128(130,5 + ( $i * 35),$code,50,20);
	$pdf->SetXY(130,25 + ( $i * 35));
	$pdf->Write(5,$code); */
	
	$pdf->Code128(5,5 + ( $i * $rowoffset),$code,35,$height);
	$pdf->SetXY(5,17 + ( $i * $rowoffset));
	$pdf->Write(5,$code);
	
	$pdf->Code128(45,5 + ( $i * $rowoffset),$code,35,$height);
	$pdf->SetXY(45,17 + ( $i * $rowoffset));
	$pdf->Write(5,$code);
	
	$pdf->Code128(85,5 + ( $i * $rowoffset),$code,35,$height);
	$pdf->SetXY(85,17 + ( $i * $rowoffset));
	$pdf->Write(5,$code);
	
	$pdf->Code128(125,5 + ( $i * $rowoffset),$code,35,$height);
	$pdf->SetXY(125,17 + ( $i * $rowoffset));
	$pdf->Write(5,$code);
	
	$pdf->Code128(165,5 + ( $i * $rowoffset),$code,35,$height);
	$pdf->SetXY(165,17 + ( $i * $rowoffset));
	$pdf->Write(5,$code);
}
/* 
//B set
$code='Code 128';
$pdf->Code128(50,70,$code,80,20);
$pdf->SetXY(50,95);
$pdf->Write(5,'B set: "'.$code.'"');

//C set
$code='12345678901234567890';
$pdf->Code128(50,120,$code,110,20);
$pdf->SetXY(50,145);
$pdf->Write(5,'C set: "'.$code.'"');

//A,C,B sets
$code='ABCDEFG1234567890AbCdEf';
$pdf->Code128(50,170,$code,125,20);
$pdf->SetXY(50,195);
$pdf->Write(5,'ABC sets combined: "'.$code.'"');
 */
$pdf->Output();
?>
