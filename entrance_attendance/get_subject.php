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


date_default_timezone_set('Asia/Calcutta'); 


$sql_subject=" SELECT entrance_subtype_id,entrance_subtype_name FROM entrance_subjecttype";
$result_subject= $conn->query($sql_subject);


if($result_subject->num_rows >0)
{
while($row = $result_subject ->fetch_assoc()){

 $db_data[]= $row;
}
}

echo json_encode($db_data);
return;

$conn->close();
header('Content-Type:application/json');


?>