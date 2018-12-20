<?php 
require "../db.php";

$input=filter_input_array(INPUT_POST);
// $input['ret_list']=array(192);
// $input['action']='PRS';

	function getCava($UID)
	{
		require "../db.php";
		$sql="Select * from [User] Where UserID=?";
		$query=sqlsrv_query($conn,$sql,array($UID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$data=$row['Avatar'];

		return $data;
	}

	if($input["action"]==='retrieve')
	{
		$ret_list=$input['ret_list'];
		
		for($x=0;$x<count($ret_list);$x++)
		{
			$sqltxtdel="Update [User] SET Remove=?,Remove_Remarks=? Where UserID=?";
			$querydel=sqlsrv_query($conn,$sqltxtdel,array(NULL,NULL,$ret_list[$x]));
		}
		header('Content-type: application/json');
		echo json_encode($input);
	}
	else if($input["action"]==='PRS')
	{
		$ret_list=$input['ret_list'];
		
		for($x=0;$x<count($ret_list);$x++)
		{
			$c_img=getCava($ret_list[$x]);

			$sqltxtdel="Delete from [User] Where UserID=?";
			$querydel=sqlsrv_query($conn,$sqltxtdel,array($ret_list[$x]));

			if($querydel)
			{
				if($c_img!="no_image.png")
				{
					unlink('../../img/Avatars/'.$c_img);

				}
			}
		}
		header('Content-type: application/json');
		echo json_encode($input);
	}
 ?>