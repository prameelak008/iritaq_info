<?php

// $dbname="a1634kby_online_madarsa";

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


date_default_timezone_set('Asia/Calcutta'); 


$sql_current="SELECT `session_id` FROM `sch_settings` ";
$result_current= $conn->query($sql_current);


if($result_current->num_rows >0)
{
while($row = $result_current ->fetch_assoc()){

 $db_data[]= $row;
}
}

echo json_encode($db_data);
return;

$conn->close();
header('Content-Type:application/json');


?>