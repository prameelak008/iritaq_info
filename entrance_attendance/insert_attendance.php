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



$admission=$_POST['admission_no'];
$selectedCourse=$_POST['selectedCourse'];
$selectedSession=$_POST['selectedSession'];
$selectedSubject=$_POST['selectedSubject'];
$userId=$_POST['userId'];
$note=$_POST['note'];

$regId="";
 
// $admission=142;
// $selectedCourse=20;
// $selectedSession=16;
// $selectedSubject=20;
// $userId=1;
// $note='qq';




date_default_timezone_set('Asia/Calcutta'); 
$date = date('Y-m-d h:i:s');

$sql_regId="SELECT admission_application_registerid FROM admission_form_tbl WHERE admission_id='$admission'";
$result_regId= $conn->query($sql_regId);


if($result_regId->num_rows >0)
{
while($row = $result_regId ->fetch_assoc()){

 $regId= $row['admission_application_registerid'];;
}



$sql_insert = "INSERT INTO entranceexam_attend ( entranceexam_attendance_applicant, 
entranceexam_attendance_subject, entranceexam_attendance_attendence, entranceexam_attendance_session, 
entranceexam_attendance_createddate,
 entranceexam_attendance_status, entranceexam_attendance_notes,entranceexam_attendance_updatedby) 
 VALUES ('$regId','$selectedSubject','Present','$selectedSession','$date','1','$note','$userId')";
$result_in= $conn->query($sql_insert);

if($result_in){
echo json_encode("success");

}

else{
echo json_encode("failed");
}

}

return;


$conn->close();
header('Content-Type:application/json');

?>