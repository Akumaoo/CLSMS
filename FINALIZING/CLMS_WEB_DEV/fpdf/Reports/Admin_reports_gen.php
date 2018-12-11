<?php
require('../admin_verify.php');
require('../fpdf.php');
require('../../php_codes/db.php');

// $deptID="ELEM";
// $BP_size="A4";
if(isset($_POST['s_f']))
{
$sort=$_POST['s_f'];
$sb=$_POST['sort_by'];
// DEPT/DISB
$tb=$_POST['tb'];
// COLLEGE DATA /DISB DATA
$dt=$_POST['dt'];
$org=$_POST['org'];
$prog=$_POST['prog'];
$type_report=$_POST['t_r'];
$BP_size=$_POST['BP_size'];
$checkpass=false;

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
		global $type_report;

	    $nb=0;
	    for($i=0;$i<count($data);$i++)
	        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	    $h=7*$nb;
	    //Issue a page break first if needed
	    $this->CheckPageBreak($h);
	    //Draw the cells of the row

 		$this->SetFillColor(210,210,210);
	    $this->SetTextColor(0);

	    if($type_report=='DT' || $type_report=="RT")
	    {
	    	$this->SetFont('Arial','','10');
	    }
	    else
	    {
	    	$this->SetFont('Arial','','11');
		}

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

		global $type_report;

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
	    if($type_report=='OS')
	    {
	    	$this->Cell(189,6,'LIST OF ONGOING SUBSCRIPTIONS',0,1,'C');
	    }
	    else if ($type_report=='FS')
	    {
	    	$this->Cell(189,6,'LIST OF FULFILLED SUBSCRIPTIONS',0,1,'C');
	    }
	    else if($type_report=='RT')
	    {
	    	$this->Cell(189,6,'LIST OF RECEIVED TITLES',0,1,'C');
	    }
	    else if($type_report=='DT')
	    {
	    	$this->Cell(189,6,'LIST OF DELIVERED TITLES',0,1,'C');
	    }
	    else if ($type_report=='Subscriptions')
	    {
	    	$this->Cell(189,6,'LIST OF CURRENT SUBSCRIPTIONS',0,1,'C');
	    }

	    

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

	function checkPassSubs()
	{
		require('../../php_codes/db.php');
		$sql="Select Count(*) as rows from Subscription Where
				Subscription_Date NOT BETWEEN CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) AND Subscription.Status=?";
		$query=sqlsrv_query($conn,$sql,array('OnGoing'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num_rows=$row['rows'];

		if($num_rows>0)
		{
			$type=true;
		}
		else
		{
			$type=false;
		}

		return $type;
	}
	// Load data
	function LoadData()
	{
		require('../../php_codes/db.php');

		$inc=0;
		// FILTER/SORT
		global $sort;
		// SORT BY ASC/DESC
		global $sb;
		// DEPT/DISB
		global $tb;
		// COLLEGE DATA /DISB DATA (DEPTS/DISB)
		global $dt;
		// ORGANIZATIONS
		global $org;
		// PROGRAMS
		global $prog;
		// TYPE OF REPORT OT BE GEN
		global $type_report;
		
		global $checkpass;




		$filter_sort="";

		if($sort=='Sort')
		{
			if($tb=='Department')
			{
				$filter_sort="Order By DepartmentID ".$sb.",ProgramID ".$sb;

			}
			else
			{
				$filter_sort="Order By DistributorName ".$sb;
			}
		}
		else
		{	
			if($tb=='Department')
			{
				if($this->checkType($dt)=='Multiple')
				{	
					$filter_sort="WHERE DepartmentID='".$dt."' AND ProgramID='".$prog."'";
				}
				else
				{
					$filter_sort="WHERE DepartmentID='".$dt."'";
				}
			}
			else
			{
				$filter_sort="WHERE DistributorName='".$dt."'";
			}
		}

		$final_ext=htmlentities($filter_sort);

		if($type_report=='RT' || $type_report=='DT')
		{
			if($type_report=='RT')
			{
				$condition="AND (asd.Status='Received' OR dsa.Status_Prog='Received')";
			}
			else
			{
				$condition="";
			}

			$sql="
				Select DistributorName,DepartmentID,ProgramID,SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue from
				(Select 
				asd.DistributorID,asd.DepartmentID,dsa.ProgramID,
				asd.SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue from
					(Select ReceivedSerialID,ReceiveSerial.DepartmentID,ControlNumber,SerialName,Subscription.DistributorID,TypeName,VolumeNumber,IssueNumber,DateofIssue,Staff_Comment,ReceiveSerial.Remove,ReceiveSerial.Status,Subscription.Status as subs_stat,DateReceiveNotif_Give from  Delivery Inner Join Delivery_Subs On Delivery.DeliveryID=Delivery_Subs.DeliveryID Inner Join Subscription On Delivery_Subs.SubscriptionID=Subscription.SubscriptionID Inner JOin Serial On Subscription.SerialID=Serial.SerialID Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
					Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID WHERE (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR Subscription.Status='OnGoing') AND Receive_Date=DateReceiveNotif_Give) as asd
					Left Join
					(Select Organization.DepartmentID,ReceiveSerialID_Program,ReceiveSerial_Program.ProgramID,SerialName,Staff_Comment_Prog,ControlNumber_Prog,Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove from Serial Inner JOin ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
					Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID 
					Inner JOin Organization on Program.OrganizationID=Organization.OrganizationID) as dsa ON asd.DepartmentID=dsa.DepartmentID 
					WHERE (asd.SerialName=dsa.SerialName OR (asd.SerialName IS NOT NULL AND dsa.SerialName IS NULL)) AND (asd.DateReceiveNotif_Give=dsa.DateReceiveNotif_Give_Prog OR (asd.DateReceiveNotif_Give IS NOT NULL AND dsa.DateReceiveNotif_Give_Prog IS NULL)) AND (asd.Remove IS NULL AND dsa.Remove IS NULL) ".$condition.")as T1
				Inner Join Distributor On T1.DistributorID=Distributor.DistributorID ".$final_ext;

			$query=sqlsrv_query($conn,$sql,array());
			 while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			 {
			   		$data[$inc][0]=$rows['DistributorName'];
			   		$data[$inc][1]=$rows['DepartmentID'];
			   		$data[$inc][2]=$rows['ProgramID'];
			   		$data[$inc][3]=$rows['SerialName'];
			   		$data[$inc][4]=$rows['TypeName'];
			   		$data[$inc][5]=$rows['VolumeNumber'];
			   		$data[$inc][6]=$rows['IssueNumber'];
			   		if(isset($rows['DateofIssue']))
			   		{
			   			$data[$inc][7]=$rows['DateofIssue']->format('m/d/Y');
			   		}
			   		else
			   		{
			   			$data[$inc][7]=$rows['DateofIssue'];
			   		}
			   		$inc++;
			 }
		}
		else if($type_report=='OS' || $type_report=='FS')
		{
			
			if($type_report=='OS')
			{
				$where_down=' Frequency!=(CASE
											WHEN ProgramID IS NULL
											THEN NumberOfItemReceived
											ELSE NumberofItemsReceived_Prog
											END	
											)';
			}
			else
			{
				$where_down=' Frequency=(CASE
											WHEN ProgramID IS NULL
											THEN NumberOfItemReceived
											ELSE NumberofItemsReceived_Prog
											END	
											)';
			}

			if($sort=='Sort')
			{
					$add_ext='WHERE '.$where_down.' '.$final_ext; 

			}
			else
			{
					$add_ext=$final_ext.' AND '.$where_down;
			}
			$sql="
				Select DepartmentID,ProgramID,DistributorName,SerialName,TypeName,
				CONCAT((CASE
					WHEN ProgramID IS NULL
					THEN  NumberOfItemReceived
					ELSE NumberofItemsReceived_Prog
					END
				),'/',Frequency) as Status from 
				(Select 
					asd.DistributorID,SerialName,TypeName,sub_stat,asd.DepartmentID,ProgramID,NumberOfItemReceived,NumberofItemsReceived_Prog,Frequency from
						(Select Serial.SerialID,CategoryID,Categorize_Serials.SubscriptionID,DistributorID,SerialName,TypeName,Serial.Origin,Subscription.Status as sub_stat,Archive,Subscription_Date,Frequency,Department.DepartmentID,NumberOfItemReceived,(Usage_Stat_Employee+Usage_Stat_Student) as Usage_Stat,Subscription.Remove from Serial Inner Join Subscription ON Serial.SerialID=Subscription.SerialID
						Inner Join Categorize_Serials On Subscription.SubscriptionID=Categorize_Serials.SubscriptionID
						Inner JOin Department On Categorize_Serials.DepartmentID=Department.DepartmentID) as asd
					Left JOin
						(Select Category_Serials_Program.SubscriptionID,CategoryID_Program,Category_Serials_Program.ProgramID,NumberofItemsReceived_Prog,DepartmentID,(Usage_Stat_Employee_Prog+Usage_Stat_Student_Prog) as Usage_stat_Prog from Subscription Inner Join Category_Serials_Program ON Subscription.SubscriptionID=Category_Serials_Program.SubscriptionID Inner Join Program ON Category_Serials_Program.ProgramID=Program.ProgramID 
						Inner Join Organization On Program.OrganizationID=Organization.OrganizationID) as dsa On asd.DepartmentID=dsa.DepartmentID
						Where (asd.SubscriptionID=dsa.SubscriptionID OR (asd.SubscriptionID IS NOT NULL AND dsa.SubscriptionID IS NULL)) AND (asd.Archive IS NULL AND asd.Remove IS NULL)  AND (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR sub_stat='OnGoing')) as T1
					Inner Join Distributor On T1.DistributorID=Distributor.DistributorID ".$add_ext;

			$query=sqlsrv_query($conn,$sql,array());
			 while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			 {
			   		$data[$inc][0]=$rows['DepartmentID'];
			   		$data[$inc][1]=$rows['ProgramID'];
			   		$data[$inc][2]=$rows['DistributorName'];
			   		$data[$inc][3]=$rows['SerialName'];
			   		$data[$inc][4]=$rows['TypeName'];
			   		$data[$inc][5]=$rows['Status'];
			   		$inc++;
			 }
		}
		else if($type_report=='Subscriptions')
		{
			$filter_end="";
			$filter_middle="";
			if($sort=='Sort')
			{
				if($tb=='Department')
				{
						$filter_end=" Order By Departments ".$sb;
				}
				else
				{
					$filter_end=" Order By DistributorName ".$sb;
				}
			}
			else
			{	
				if($tb=='Department')
				{
					if($this->checkType($dt)=='Multiple')
					{	
						$filter_middle=" AND (asd.DepartmentID='".$dt."' AND ProgramID='".$prog."')";
					}
					else
					{
						$filter_middle=" AND (asd.DepartmentID='".$dt."')";
					}
				}
				else
				{
					$filter_middle=" AND (asd.DistributorName='".$dt."')";
				}
			}


			if($checkpass)
			{
				$not_add='NOT';
				$con_add=" AND sub_stat='OnGoing'";
				$add_col_up=",(CASE
						WHEN Subscription_Date IS NOT NULL
						THEN
						(CASE
						WHEN DATEADD(month, DATEDIFF(month, 0, Subscription_Date), 0) BETWEEN DATEADD(month, DATEDIFF(month, 0, CONCAT(DATEPART(YYYY,Subscription_Date),'-08-01')), 0) AND DATEADD(month, DATEDIFF(month, 0, CONCAT(DATEPART(YYYY,DATEADD(year,1,Subscription_Date)),'-05-01')), 0)
						THEN CONCAT(DATEPART(YYYY,Subscription_Date),'-',DATEPART(YYYY,DATEADD(year,1,Subscription_Date)))
						ELSE
							CONCAT(DATEPART(YYYY,DATEADD(year,-1,Subscription_Date)),'-',DATEPART(YYYY,Subscription_Date))
						 END)
					END)
					 AS Subscription_Year	
				";
				$add_col_down=',Subscription_Date';
			}
			else
			{
				$not_add='';
				$con_add="";
				$add_col_up="";
				$add_col_down="";
			}
			$sql="
				Select DistributorName,SerialName,TypeName,
				STRING_AGG((CASE
					WHEN ProgramID IS NULL
					THEN DepartmentID
					ELSE ProgramID
					END
				),', ') as Departments,Frequency,sub_stat".$add_col_up." from 
				(Select 
					asd.DistributorID,SerialName,TypeName,sub_stat,asd.DepartmentID,ProgramID,NumberOfItemReceived,NumberofItemsReceived_Prog,Frequency,Subscription_Date from
						(Select subt.SerialID,CategoryID,subt.SubscriptionID,subt.DistributorID,SerialName,TypeName,subt.Origin,sub_stat as sub_stat,Archive,Subscription_Date,Frequency,subt.DepartmentID,NumberOfItemReceived,Usage_Stat,subt.Remove,DistributorName from 
						(Select Serial.SerialID,CategoryID,Categorize_Serials.SubscriptionID,DistributorID,SerialName,TypeName,Serial.Origin,Subscription.Status as sub_stat,Archive,Subscription_Date,Frequency,Department.DepartmentID,NumberOfItemReceived,(Usage_Stat_Employee+Usage_Stat_Student) as Usage_Stat,Subscription.Remove 
						from Serial Inner Join Subscription ON Serial.SerialID=Subscription.SerialID
						Inner Join Categorize_Serials On Subscription.SubscriptionID=Categorize_Serials.SubscriptionID
						Inner JOin Department On Categorize_Serials.DepartmentID=Department.DepartmentID) as subt
						Inner Join Distributor On subt.DistributorID=Distributor.DistributorID) as asd
					Left JOin
						(Select Category_Serials_Program.SubscriptionID,CategoryID_Program,Category_Serials_Program.ProgramID,NumberofItemsReceived_Prog,DepartmentID,(Usage_Stat_Employee_Prog+Usage_Stat_Student_Prog) as Usage_stat_Prog from Subscription Inner Join Category_Serials_Program ON Subscription.SubscriptionID=Category_Serials_Program.SubscriptionID Inner Join Program ON Category_Serials_Program.ProgramID=Program.ProgramID 
						Inner Join Organization On Program.OrganizationID=Organization.OrganizationID) as dsa On asd.DepartmentID=dsa.DepartmentID
						Where (asd.SubscriptionID=dsa.SubscriptionID OR (asd.SubscriptionID IS NOT NULL AND dsa.SubscriptionID IS NULL)) AND (asd.Archive IS NULL AND asd.Remove IS NULL)  AND (Subscription_Date ".$not_add." BETWEEN CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01'))) ".$filter_middle.$con_add." ) as T1
					Inner Join Distributor On T1.DistributorID=Distributor.DistributorID Group By DistributorName,SerialName,TypeName,Frequency,sub_stat".$add_col_down.$filter_end;

			$query=sqlsrv_query($conn,$sql,array());
			 while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			 {
			   		$data[$inc][0]=$rows['DistributorName'];
			   		$data[$inc][1]=$rows['SerialName'];
			   		$data[$inc][2]=$rows['TypeName'];
			   		$data[$inc][3]=$rows['Departments'];
			   		$data[$inc][4]=$rows['Frequency'];
 		
			   		if($checkpass)
			   		{
			   			$data[$inc][5]=$rows['Subscription_Year'];
			   		}
			   		else
			   		{
			   			$data[$inc][5]=$rows['sub_stat'];
			   		}
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
	    global $type_report;

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

		    if($type_report=='DT' || $type_report=="RT")
		    {
		    	$this->SetFont('Arial','B','11');
		    }
		    else
		    {
		    	 $this->SetFont('Arial','B','12');
			}
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
$pdf->AddPage();
if($type_report=='OS' || $type_report=='FS')
{
	$header = array('Department','Program','Distributor','Title','Type','Status');
	$pdf->SetWidths(array('35','35','35','35','30','25'));
}
else if($type_report=='RT' || $type_report=="DT")
{
	$header = array('Distributor','Department','Program','Title','Type','Vol #','Issue #','Date Of Issue');
	$pdf->SetWidths(array('25','25','25','30','25','18','18','31'));
}
else if($type_report=='Subscriptions')
{
	$header = array('Distributor','Title','Type','Departments','Freq','Status');
	$pdf->SetWidths(array('35','35','30','43','20','30'));
}

$pdf->FancyTableHeader($header);
$data=$pdf->LoadData();
$fill = false;
for($x=0;$x<count($data);$x++)
{
	$pdf->Row($fill,$data[$x]);
	$fill = !$fill;
}

if($type_report=='Subscriptions')
{
	$checkpass=$pdf->checkPassSubs();


	if($checkpass)
	{
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(203,20,'EXTENDED SUBSCRIPTIONS',0,1,'C');

		$header = array('Distributor','Title','Type','Departments','Freq','S.Y');
		$pdf->SetWidths(array('35','35','30','43','20','30'));

		$pdf->FancyTableHeader($header);
		$data=$pdf->LoadData();
		$fill = false;
		for($x=0;$x<count($data);$x++)
		{
			$pdf->Row($fill,$data[$x]);
			$fill = !$fill;
		}
	}

}

ob_end_clean();
$pdf->Output();

}
?>