<?php
require('../staff_verify.php');
require('../fpdf.php');
require('../../php_codes/db.php');

// $deptID="ELEM";
// $BP_size="A4";
if(isset($_POST['Dept']))
{
$deptID=$_POST['Dept'];
$BP_size=$_POST['BP_size'];

class PDF extends FPDF
{	
	// FLEX TABLE
	var $widths;
	var $aligns;

	function SetWidths($w)
	{
	    //Set the array of column widths
	    $this->widths=$w;
	}

	function SetAligns($a)
	{
	    //Set the array of column alignments
	    $this->aligns=$a;
	}

	function Row($fill,$data)
	{
	    //Calculate the height of the row
	    $nb=0;
	    for($i=0;$i<count($data);$i++)
	        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	    $h=7*$nb;
	    //Issue a page break first if needed
	    $this->CheckPageBreak($h);
	    //Draw the cells of the row

 		$this->SetFillColor(210,210,210);
	    $this->SetTextColor(0);
	    $this->SetFont('Arial','','11');
	    for($i=0;$i<count($data);$i++)
	    {
	        $w=$this->widths[$i];
	        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
	        //Save the current position
	        $x=$this->GetX();
	        $y=$this->GetY();
	        //Draw the border
	        $this->Rect($x,$y,$w,$h);
	        //Print the text


	        $this->MultiCell($w,7,$data[$i],0,$a,false);
	        //Put the position to the right of the cell
	        $this->SetXY($x+$w,$y);
	    }
	    //Go to the next line
	    $this->Ln($h);
	    
	}

	function CheckPageBreak($h)
	{
	    //If the height h would cause an overflow, add a new page immediately
	    if($this->GetY()+$h>$this->PageBreakTrigger)
	        $this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
	    //Computes the number of lines a MultiCell of width w will take
	    $cw=&$this->CurrentFont['cw'];
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	    $s=str_replace("\r",'',$txt);
	    $nb=strlen($s);
	    if($nb>0 and $s[$nb-1]=="\n")
	        $nb--;
	    $sep=-1;
	    $i=0;
	    $j=0;
	    $l=0;
	    $nl=1;
	    while($i<$nb)
	    {
	        $c=$s[$i];
	        if($c=="\n")
	        {
	            $i++;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	            continue;
	        }
	        if($c==' ')
	            $sep=$i;
	        $l+=$cw[$c];
	        if($l>$wmax)
	        {
	            if($sep==-1)
	            {
	                if($i==$j)
	                    $i++;
	            }
	            else
	                $i=$sep+1;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	        }
	        else
	            $i++;
	    }
	    return $nl;
	}


	function Header()
	{
		// SY
		$date_today=date('Y-m-d');
		$c_year=date('Y');
		$sub_date=$c_year.'-08-01';
		if($date_today<$sub_date)
		{
			$c_SY=date('Y',strtotime('-1 year',strtotime($date_today))).'-'.$c_year;
		}
		else
		{
			$c_SY=$c_year.'-'.date('Y',strtotime('+1 year',strtotime($date_today)));
		}
	    // Logo
	    $this->Image('../../img/icon.png',10,11,25);
	    // Arial bold 15
	    $this->SetFont('Arial','',12);
	    // Move to the right
	    // Title
	    $this->Cell(185,6,'UNIVERSITY LIBRARIES',0,1,'R');
	    $this->Cell(185,6,'Office Of The Example Office~',0,0,'R');
	    $this->Ln(10);

	    $this->SetFont('Arial','B',13);
	    $this->Cell(185,6,'LIST OF SUBSCRIBED TITLES',0,1,'R');

	    $this->SetFont('Arial','',12);
	    $this->Cell(185,6,'SY ['.$c_SY.']',0,0,'R');
	    // Line break
	    $this->Ln(16);
	}

	// Page footer
	function Footer()
	{
		$date_today=date('M d,Y');
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,3,'Page '.$this->PageNo().'/{nb}',0,1,'C');

	    // Date
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,3,$date_today,0,0,'C');
	}
	// Load data
	function LoadData($dept)
	{
		require('../../php_codes/db.php');

		$inc=0;
	   $sql="Select SerialName,CONCAT(NumberOfItemReceived,'/',Frequency) as deliv_stat,Usage_Stat,Status,TypeName from Categorize_Serials Inner Join Subscription On Categorize_Serials.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID And DepartmentID=? Order By SerialName,Status ASC";
	   $query=sqlsrv_query($conn,$sql,array($dept));
	   while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	   {
	   		$data[$inc][0]=$rows['SerialName'];
	   		$data[$inc][1]=$rows['deliv_stat'];
	   		$data[$inc][2]=$rows['Usage_Stat'];
	   		$data[$inc][3]=$rows['Status'];
	   		$data[$inc][4]=$rows['TypeName'];
	   		$inc++;
	   }
	   return $data;
	}
	// Colored table
	function FancyTableHeader($header)
	{
	    
	    //Calculate the height of the row
	    $nb=0;
	    for($i=0;$i<count($header);$i++)
	        $nb=max($nb,$this->NbLines($this->widths[$i],$header[$i]));
	    $h=8*$nb;
	    //Issue a page break first if needed
	    $this->CheckPageBreak($h);
	    //Draw the cells of the row

	    for($i=0;$i<count($header);$i++)
	    {	

	        $w=$this->widths[$i];
	        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
	        //Save the current position
	        $x=$this->GetX();
	        $y=$this->GetY();
	        //Draw the border
	        $this->Rect($x,$y,$w,$h);
	        //Print the text

	        // Colors, line width and bold font
		    $this->SetFillColor(47,50,58);
		    $this->SetTextColor(255);
		    $this->SetDrawColor(37,38,41);
		    $this->SetFont('Arial','B','12');
	        $this->MultiCell($w,8,$header[$i],'LR',$a,true);
	        //Put the position to the right of the cell
	        $this->SetXY($x+$w,$y);
	    }   
	    $this->Ln(); 	
	    
	    // // Closing line
	    // $this->Cell(5);
	    // $this->Cell(array_sum($w),0,'','T');
	}
}

$pdf = new PDF('P','mm',$BP_size);
$pdf->AliasNbPages();
// Column headings
$header = array('Title','Title Received','Usage','Subscription Status','Type');
// Data loading
$data=$pdf->LoadData($deptID);
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->SetWidths(array('35','35','30','45','40'));

$pdf->FancyTableHeader($header);
$fill = false;
for($x=0;$x<count($data);$x++)
{
	$pdf->Row($fill,$data[$x]);
	$fill = !$fill;
}
// $pdf->Cell(array_sum($data),0,'','T');
$pdf->Output();

}
?>s