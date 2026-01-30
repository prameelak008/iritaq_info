<?php
include ('./config.php');

// $servername="localhost";
// $username="root";
// $password="";
// $dbname="iritaq_db";




$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
   die ("Connection failed :" .$conn->connect_error);
}

//$admission=$_POST['admission_no'];
//echo $admission;
//$emailid=$_POST['email'];
//echo $emailid;
//$morpickplace=$_POST['mor_pickup_place'];
//echo $place;

//  $admission='10977';
//  $emailid="testdriver@gmail.com";
//  $morpickplace="kannur";
date_default_timezone_set('Asia/Calcutta'); 
$date = date('Y-m-d');
$picktime=date('h:i:s');
$st_id="";
//$picktime=time();

//echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';


//$db_admission = array();



$sql_session=" SELECT id,session FROM `sessions`";
$result_session= $conn->query($sql_session);


if($result_session->num_rows >0)
{
while($row = $result_session ->fetch_assoc()){

 $db_data[]= $row;
}
}

echo json_encode($db_data);
return;

$conn->close();
header('Content-Type:application/json');


?>