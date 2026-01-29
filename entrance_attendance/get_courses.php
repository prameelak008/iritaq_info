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


$sql_course=" SELECT entranceexam_course_id,entranceexam_course_name FROM entranceexam_course";
$result_course= $conn->query($sql_course);


if($result_course->num_rows >0)
{
while($row = $result_course ->fetch_assoc()){

 $db_data[]= $row;
}
}

echo json_encode($db_data);
return;

$conn->close();
header('Content-Type:application/json');


?>