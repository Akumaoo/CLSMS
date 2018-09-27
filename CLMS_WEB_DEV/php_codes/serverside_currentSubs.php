<?php 

$table='"Select [Distributor].[DistributorName],[Serial].[SerialName],[Subscription].[Orders],[Subscription].[Cost],[Subscription].[NumberOfItemReceived],[Subscription].[Status] From [Distributor] Inner Join [Subscription] ON [Distributor].[DistributorID]=[Subscription].[DistributorID] Inner Join [Serial] ON [Subscription].[SerialID]=[Serial].[SerialID]';

$primary_key='SerialID';

$colums=array(

	array('db'=>'[Distributor].[DistributorName]','dt'=>0),
	array('db'=>'[Serial].[SerialName]','dt'=>1),
	array('db'=>'[Subscription].[Orders]','dt'=>2),
	array('db'=>'[Subscription].[Cost]','dt'=>3),
	array('db'=>'[Subscription].[NumberOfItemReceived]','dt'=>4),
	array('db'=>'[Subscription].[Status]','dt'=>5)

);


$sql_details=array(
	'db'=>'CLSMS',
	'host'=>'DESKTOP-QERUPN0\SQLEXPRESS'
);

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primary_key, $columns )
);


 ?>