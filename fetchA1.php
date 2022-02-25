<?php
//create connection to  database
$conn = mysqli_connect('localhost', 'root', '', 'estimate');


//fetch data from table
if(isset($_REQUEST['page']))
  $idPage=$_REQUEST['page'];

$order='';
if(isset($_REQUEST['order']))
{
	$strOrder=$_REQUEST['order'];

	if(strcmp($strOrder,"id")==0)
		$order='id';
	if(strcmp($strOrder,"todaysdate")==0)
		$order='todaysdate';
	if(strcmp($strOrder,"containerid")==0)
		$order='containerid';
	if(strcmp($strOrder,"plusorminus")==0)
		$order='plusorminus';

	if($_REQUEST['orderType']==1)
		$order.=' ASC';
	else
		$order.=' DESC';
	$order=' ORDER BY '.$order;
}

$search=' WHERE (1=1) ';
if(isset($_REQUEST['id']))
	$search.='AND (id LIKE "%'.$_REQUEST['id'].'%") ';
if(isset($_REQUEST['todaysdate']))
	$search.='AND (todaysdate LIKE "%'.$_REQUEST['todaysdate'].'%") ';
if(isset($_REQUEST['containerid']))
	$search.='AND (containerid LIKE "%'.$_REQUEST['containerid'].'%")';
if(isset($_REQUEST['plusorminus']))
	$search.='AND (plusorminus LIKE "%'.$_REQUEST['plusorminus'].'%") ';
$offset=$_REQUEST['page']*$_REQUEST['pageSize'];
$limit=' LIMIT '.$offset.','.$_REQUEST['pageSize'];

$sql = mysqli_query($conn, "SELECT * FROM zoneA1 ".$search.$order.$limit);

//store data in result VARIABLE
$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

exit(json_encode($result));

?>
