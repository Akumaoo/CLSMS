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

		global $deptID;

		if($date_today<$sub_date)
		{
			$c_SY=date('Y',strtotime('-1 year',strtotime($date_today))).'-'.$c_year;
		}
		else
		{
			$c_SY=$c_year.'-'.date('Y',strtotime('+1 year',strtotime($date_today)));
		}
	    // Logo
	    
	    // Arial bold 15
	    $this->AddFont('Candara','B','Candara Bold.php');  
        $this->SetFont('Candara','B',15); 
	    // Move to the right
	    // Title
	    $this->Cell(189,5,'University of Saint Louis Tuguegarao',0,1,'C');

	    $this->AddFont('Candara','','Candara.php'); 
	    $this->SetFont('Candara','',12);
	    $this->Cell(189,5,'University Libraries',0,1,'C');
	    $this->Cell(189,4,'Office of the Collection Development',0,0,'C');
	    $this->Ln(6);

	    $this->SetFont('Times','B',13);
	    $this->Cell(189,6,'USAGE STATISTICS OF '.strtoupper($deptID).' DEPARTMENT',0,1,'C');

	    $this->SetFont('Arial','',12);
	    $this->Cell(189,6,'SY ['.$c_SY.']',0,0,'C');
	    // Line break
	    $this->Ln(10);
	}

	// Page footer
	function Footer()
	{
		date_default_timezone_set('Asia/Singapore');
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',9);
        // Page number
        $date = date("m/d/ Y");
        $time = date("g:i a");
        $this->Cell(0, 10, 'Report generated on '.$date .' at ' .$time, 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(0,10,'Page '.$this->PageNo().'	   Total pages: {nb}',0,0,'R');
	}

	function checkType($dept)
	{
		require('../../php_codes/db.php');
		$sql="Select Count(*) as rows from Department Inner Join Organization On Department.DepartmentID=Organization.DepartmentID Where Department.DepartmentID=?";
		$query=sqlsrv_query($conn,$sql,array($dept));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num_rows=$row['rows'];

		if($num_rows>0)
		{
			$type='Multiple';
		}
		else
		{
			$type='Single';
		}

		return $type;
	}
	// Load data
	function LoadData($dept,$emp_stud)
	{
		require('../../php_codes/db.php');

		$inc=0;
		$type=$this->checkType($dept);

		if($type=='Multiple')
		{
			if($emp_stud=='Student')
			{
				$col='Usage_Stat_Student_Prog';
				$col_tag_mag='Student_Magazine';
				$col_tag_jour='Student_Journal';
			}
			else
			{
				$col='Usage_Stat_Employee_Prog';
				$col_tag_mag='Employee_Magazine';
				$col_tag_jour='Employee_Journal';
			}
	  	 $sql="
			Select 
			(CASE
				WHEN asd.ProgramID IS NULL
				THEN dsa.ProgramID 
				ELSE asd.ProgramID
				END
			) as Program,
			(CASE
				WHEN ".$col_tag_jour." IS NULL
				THEN 0
				ELSE ".$col_tag_jour."
				END
			) as ".$col_tag_jour.",
			(CASE
				WHEN ".$col_tag_mag." IS NULL
				THEN 0
				ELSE ".$col_tag_mag."
				END
			)as ".$col_tag_mag."
			 from 
				(Select ProgramID,SUM(".$col.") as ".$col_tag_mag." from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID
				 Inner Join Category_Serials_Program On Subscription.SubscriptionID=Category_Serials_Program.SubscriptionID
				WHERE (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR Subscription.Status='OnGoing') AND (Subscription.Remove IS NULL AND Subscription.Archive IS NULL)
				AND TypeName='Magazine' Group By ProgramID) as asd
				Full Join 
			(Select ProgramID,SUM(".$col.") as ".$col_tag_jour." from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID
				 Inner Join Category_Serials_Program On Subscription.SubscriptionID=Category_Serials_Program.SubscriptionID
				WHERE (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR Subscription.Status='OnGoing') AND (Subscription.Remove IS NULL AND Subscription.Archive IS NULL)
				AND TypeName='Journal' Group By ProgramID) as dsa On asd.ProgramID=dsa.ProgramID";

			$query=sqlsrv_query($conn,$sql,array());
			 while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			 {
			   		$data[$inc][0]=$rows['Program'];
			   		$data[$inc][1]=$rows[$col_tag_jour];
			   		$data[$inc][2]=$rows[$col_tag_mag];
			   		$inc++;
			 }
			 
		}
		else
		{
			if($emp_stud=='Student')
			{
				$col='Usage_Stat_Student';
				$col_tag_mag='Student_Magazine';
				$col_tag_jour='Student_Journal';
			}
			else
			{
				$col='Usage_Stat_Employee';
				$col_tag_mag='Employee_Magazine';
				$col_tag_jour='Employee_Journal';
			}

	  	 $sql="
			Select 
			(CASE
				WHEN asd.DepartmentID IS NULL
				THEN dsa.DepartmentID
				ELSE asd.DepartmentID
				END
			)as Department,
			(CASE
				WHEN ".$col_tag_mag." IS NULL
				THEN 0
				ELSE ".$col_tag_mag."
				END
			) as ".$col_tag_mag.",
			(CASE
				WHEN ".$col_tag_jour." IS NULL
				THEN 0
				ELSE ".$col_tag_jour."
				END
			)as ".$col_tag_jour."
			 from 
			(Select DepartmentID,SUM(".$col.") as ".$col_tag_mag." from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID
			Inner Join Categorize_Serials On Subscription.SubscriptionID=Categorize_Serials.SubscriptionID
			WHERE (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR Subscription.Status='OnGoing') AND (Subscription.Remove IS NULL AND Subscription.Archive IS NULL)
				AND TypeName='Magazine' Group By DepartmentID) as asd	
			FULL JOIN
			(Select DepartmentID,SUM(".$col.") as ".$col_tag_jour." from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID
			Inner Join Categorize_Serials On Subscription.SubscriptionID=Categorize_Serials.SubscriptionID
			WHERE (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR Subscription.Status='OnGoing') AND (Subscription.Remove IS NULL AND Subscription.Archive IS NULL)
				AND TypeName='Journal' Group By DepartmentID) as dsa ON asd.DepartmentID=dsa.DepartmentID WHERE asd.DepartmentID=?
				";

			$query=sqlsrv_query($conn,$sql,array($dept));
			 while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			 {
			   		$data[$inc][0]=$rows[$col_tag_jour];
			   		$data[$inc][1]=$rows[$col_tag_mag];
			   		$inc++;
			 }
			 
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
$type=$pdf->checkType($deptID);
$pdf->AddPage();
if($type=='Multiple')
{
	$header = array('Program','Journal','Magazine');
	$pdf->SetWidths(array('65','65','65'));
}
else
{
	$header = array('Journal','Magazine');
	$pdf->SetWidths(array('65','65'));
}

// Data loading STUDENT
$pdf->SetFont('Arial','B',12);
$pdf->Cell(203,20,'[STUDENT DATA]',0,1,'C');
$data=$pdf->LoadData($deptID,'Student');

if($type=='Single')
{$pdf->Cell(35);}

$pdf->FancyTableHeader($header);

if($type=='Single')
{$pdf->Cell(35);}

$fill = false;
for($x=0;$x<count($data);$x++)
{
	$pdf->Row($fill,$data[$x]);
	$fill = !$fill;
}

$pdf->LN(15);

// Data loading EMPLOYEE
$pdf->SetFont('Arial','B',12);
$pdf->Cell(203,20,'[EMPLOYEE DATA]',0,1,'C');
$data=$pdf->LoadData($deptID,'Employee');

if($type=='Single')
{$pdf->Cell(35);}

$pdf->FancyTableHeader($header);

if($type=='Single')
{$pdf->Cell(35);}

$fill = false;
for($x=0;$x<count($data);$x++)
{
	$pdf->Row($fill,$data[$x]);
	$fill = !$fill;
}
$pdf->Output();

}
?>