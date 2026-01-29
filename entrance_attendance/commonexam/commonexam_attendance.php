
<?php
include ('../config.php');


// $servername="localhost";
// $username="root";
// $password="";
// $dbname="iritaq_db";



$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
   die ("Connection failed :" .$conn->connect_error);
}



// $student_id='6399';
// $exam_id='78';
// $sessionId='18';


// $student_id='6275';
// $exam_id='79';
// $sessionId='18';


$student_id=$_POST['student_id'];
$exam_id=$_POST['exam_id'];
$sessionId=$_POST['sessionId'];




//$subjectId="";
 
// $admission=142;
// $selectedCourse=20;
// $selectedSession=16;
// $selectedSubject=20;
// $userId=1;
// $note='qq';




date_default_timezone_set('Asia/Calcutta'); 
$date = date('Y-m-d');
$current_time = date('H:i:s');
$created_date=date('Y-m-d H:i:s');



// $sql_studentId="SELECT s.id FROM exam_group_class_batch_exam_students s
// INNER JOIN student_session ss on s.student_session_id=ss.id
// WHERE s.exam_group_class_batch_exam_id='$exam_id' and s.student_id='$student_id' and ss.session_id='$sessionId'";
// $result_studentId= $conn->query($sql_studentId);

$sql_studentId="SELECT s.id  FROM exam_group_class_batch_exam_students s
INNER JOIN student_session ss on s.student_session_id=ss.id
WHERE s.exam_group_class_batch_exam_id='$exam_id' and ss.id='$student_id' and ss.session_id='$sessionId'";
$result_studentId= $conn->query($sql_studentId);


if($result_studentId->num_rows >0)
{
while($row_studentId = $result_studentId ->fetch_assoc()){

 $studentexamId= $row_studentId['id'];
}


$sql_subjectId="SELECT subject_id,exam_group_class_batch_exam_subjects.id as id
FROM exam_group_class_batch_exam_subjects
WHERE exam_group_class_batch_exams_id = '$exam_id' AND date_from = '$date' AND TIME('$current_time') BETWEEN SUBTIME(time_from, '00:30:00') AND ADDTIME(time_from, duration)";
$result_subjectId= $conn->query($sql_subjectId);


if($result_subjectId->num_rows >0)
{
while($row_subjectId = $result_subjectId ->fetch_assoc()){

 $subjectId        = $row_subjectId['subject_id'];
 $subid            = $row_subjectId['id'];
    $sql_check_exists = "SELECT * FROM exam_group_exam_results 
        WHERE exam_group_class_batch_exam_student_id = '$studentexamId'
        AND exam_group_class_batch_exam_subject_id = '$subid'";
    $result_check_exists = $conn->query($sql_check_exists);
    
     if ($result_check_exists->num_rows == 0) 
     {
         
$sql_insert = "INSERT INTO `exam_group_exam_results`( `exam_group_class_batch_exam_student_id`,
 `exam_group_class_batch_exam_subject_id`, `attendence`,  `created_at`, `isQR`)
 VALUES ('$studentexamId','$subid','Present','$created_date','Yes')";
$result_in= $conn->query($sql_insert);


        if ($result_in === TRUE) 
        {
        $message = "Success";   
        echo json_encode($message);
        }
        else
        {
        $message = "Failed";    
        echo json_encode($message);
        }
        }
        else 
        {
        $message = "Student has already been marked.";
        echo json_encode($message);
        }
        


// if($result_in){
// echo json_encode("success");


// }

// else{
// echo json_encode("failed");
}

}
else{
$message = "Failed";  
echo json_encode($message);
}
}


else{
$message = "Failed";  
echo json_encode($message);
}
return;

$conn->close();
header('Content-Type:application/json');

?>