<?php
require('../staff_verify.php');
require('../fpdf.php');
require('../../php_codes/db.php');

// $_POST['dept']="ELEM";
// $BP_size="A4";
if(isset($_POST['Dept']))
{

function sanitize($str)
{
	$sanitize_str=htmlentities(str_replace("'","", str_replace('"', '', $str)));

	return $sanitize_str;
}

$deptID=sanitize($_POST['Dept']);
$BP_size=sanitize($_POST['BP_size']);
if(!empty($_POST['progs']))
{
	$prog_list=$_POST['progs'];
	$prog_string="";
	for($a=0;$a<count($prog_list);$a++)
	{
		if($a==0)
		{
			$prog_string.=" ProgramID='".sanitize($prog_list[$a])."'";
		}
		else
		{
			$prog_string.="OR ProgramID='".sanitize($prog_list[$a])."'";
		}
		
	}
	
}
else
{
	$prog_string="";
}

$SD=sanitize($_POST['SD']);
$ED=sanitize($_POST['ED']);

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
	    $this->Cell(189,6,'LIST OF TITLES RECEIVED BY '.strtoupper($deptID).' DEPARTMENT',0,1,'C');

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
	function LoadData($dept)
	{
		require('../../php_codes/db.php');

		$inc=0;
		$type=$this->checkType($dept);

		global $deptID;
		global $SD;
		global $ED;
		global $prog_string;

		if($type=='Single')
		{
			$ext_Dept=" AND asd.DepartmentID='".$deptID."'";
		}
		else
		{
			if($prog_string!="")
			{
				$ext_Dept=" AND asd.DepartmentID='".$deptID."' AND (".$prog_string.")";
			}
			else
			{
				$ext_Dept=" AND asd.DepartmentID='".$deptID."'";
			}
		}

		if($SD!="" AND $ED!="")
		{
			$ext_date=" 
					AND (CASE
						WHEN ProgramID IS NULl
						THEN DateReceiveNotif_Receive
						ELSE DateReceiveNotif_Receive_Prog
						END) BETWEEN '".$SD."' AND '".$ED."'
			";
		}
		else
		{
			$ext_date="";
		}

		$f_ext=$ext_Dept.$ext_date;

  	 $sql="Select ReceivedSerialID,asd.DepartmentID,dsa.ReceiveSerialID_Program,dsa.ProgramID,
	(CASE
		WHEN dsa.ProgramID IS NULL
		THEN asd.ControlNumber
		ELSE
			dsa.ControlNumber_Prog
		END
	)as ControlNumber,asd.SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue,
	(CASE
		WHEN dsa.ProgramID IS NULL
		THEN asd.Staff_Comment
		ELSE 
			dsa.Staff_Comment_Prog
		END
	)as Staff_Comment,
	(CASE
		WHEN dsa.ProgramID IS NULL
		THEN DateReceiveNotif_Receive
		ELSE DateReceiveNotif_Receive_Prog
		END) as Date_Received from
		(Select DateReceiveNotif_Receive,ReceivedSerialID,ReceiveSerial.DepartmentID,ControlNumber,SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue,Staff_Comment,ReceiveSerial.Remove,ReceiveSerial.Status,Subscription.Status as subs_stat,DateReceiveNotif_Give from Delivery Inner Join Delivery_Subs On Delivery.DeliveryID=Delivery_Subs.DeliveryID  Inner Join Subscription On Delivery_Subs.SubscriptionID=Subscription.SubscriptionID Inner JOin Serial On Subscription.SerialID=Serial.SerialID Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
		Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID WHERE (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR Subscription.Status='OnGoing') AND Receive_Date=DateReceiveNotif_Give) as asd
		Left Join
		(Select DateReceiveNotif_Receive_Prog,Organization.DepartmentID,ReceiveSerialID_Program,ReceiveSerial_Program.ProgramID,SerialName,Staff_Comment_Prog,ControlNumber_Prog,Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove from Serial Inner JOin ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
		Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID 
		Inner JOin Organization on Program.OrganizationID=Organization.OrganizationID) as dsa ON asd.DepartmentID=dsa.DepartmentID 
		WHERE (asd.SerialName=dsa.SerialName OR (asd.SerialName IS NOT NULL AND dsa.SerialName IS NULL)) AND (asd.DateReceiveNotif_Give=dsa.DateReceiveNotif_Give_Prog OR (asd.DateReceiveNotif_Give IS NOT NULL AND dsa.DateReceiveNotif_Give_Prog IS NULL)) AND (asd.Remove IS NULL AND dsa.Remove IS NULL) AND (asd.Status='Received' OR dsa.Status_Prog='Received') ".$f_ext;

		$query=sqlsrv_query($conn,$sql,array());
		if($type=='Single')
	 	{
	 		 while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			 {		

			   		$data[$inc][0]=$rows['ControlNumber'];
			   		$data[$inc][1]=$rows['SerialName'];
			   		$data[$inc][2]=$rows['VolumeNumber'];
			   		$data[$inc][3]=$rows['IssueNumber'];
			   		if(isset($rows['DateofIssue']))
			   		{
			   			$data[$inc][4]=$rows['DateofIssue']->format('Y-m-d');
			   		}
			   		else
			   		{
			   			$data[$inc][4]=$rows['DateofIssue'];
			   		}
			   		$data[$inc][5]=$rows['Date_Received']->format('Y-m-d');
			   		$inc++;
			 }
	 	}
	 	else
	 	{
	 		 while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			 {		

			   		$data[$inc][0]=$rows['ProgramID'];
			   		$data[$inc][1]=$rows['ControlNumber'];
			   		$data[$inc][2]=$rows['SerialName'];
			   		$data[$inc][3]=$rows['VolumeNumber'];
			   		$data[$inc][4]=$rows['IssueNumber'];
			   		if(isset($rows['DateofIssue']))
			   		{
			   			$data[$inc][5]=$rows['DateofIssue']->format('Y-m-d');
			   		}
			   		else
			   		{
			   			$data[$inc][5]=$rows['DateofIssue'];
			   		}
			   		$data[$inc][6]=$rows['Date_Received']->format('Y-m-d');
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
	$header = array('Program','Control#','Title','Vol#','Issue#','DateOfIssue','ReceivedDate');
	$pdf->SetWidths(array('30','25','35','15','20','35','35'));
}
else
{
	$header = array('Control#','Title','Vol#','Issue#','DateOfIssue','Received Date');
	$pdf->SetWidths(array('25','35','15','20','35','35'));
}

// Data loading STUDENT
$data=$pdf->LoadData($deptID);

if($type=='Single')
{$pdf->Cell(17);}

$pdf->FancyTableHeader($header);

$fill = false;
for($x=0;$x<count($data);$x++)
{
	if($type=='Single')
	{$pdf->Cell(17);}
	$pdf->Row($fill,$data[$x]);
	$fill = !$fill;
}
$pdf->Output();

}
?>