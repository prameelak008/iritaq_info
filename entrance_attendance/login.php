<?php
include ('./config.php');

$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
   die ("Connection failed :" .$conn->connect_error);
}
//$emailid='shahulmanikkaparambath@gmail.com';
// //$pass='$2y$10$4EaXJoSMuNRSdH3xnSeBZuJZ8T.FO0WHoMW71foMfDj2JptfP3UG.';
//$pass='Shahul178@';

//$hashppass=0;
$emailid=$_POST['username'];
$pass=$_POST['password'];


$staffRole=[];
$err=array();
$hashppass="";



$sql_pass="SELECT password FROM staff WHERE email='$emailid'";
$resultpass=$conn->query($sql_pass);


if($resultpass->num_rows >0)
{
    while($rowpass = $resultpass ->fetch_assoc()){
       
        $hashppass=$rowpass['password'];
        $hashppassw= "valid Password";

    }
   }

  //echo $hashppassw ;


$testpass = password_verify($pass, $hashppass);


   
   if($testpass == true) 
   {
   
   
$sql_staffId="SELECT id FROM staff WHERE email='$emailid' AND password='$hashppass'";
$result_staffId = $conn->query($sql_staffId);


//$response=array();

if ( $result_staffId->num_rows > 0) {

//if($result->num_rows > 0)
//{
    
    while($row_staffId = $result_staffId ->fetch_assoc())
    {
        //array_push($response,$row);
        $staffId = $row_staffId['id'];
    }

    //echo $staffId ;

    $sql_staffRole="SELECT `role_id` FROM `staff_roles` WHERE `staff_id`=$staffId";
    $result_staffRole = $conn->query($sql_staffRole);
    
    
    //$response=array();
    
    if ( $result_staffRole->num_rows > 0) {
    
    //if($result->num_rows > 0)
    //{
        
        while($row_staffRole = $result_staffRole ->fetch_assoc())
        {
            //array_push($response,$row);
            $staffRole[]= $row_staffRole;
        }
       

   
    echo json_encode($staffRole);
    }
    
    
    
   }
   
   }
   else
    {

    echo json_encode("error");

    }

   return;
   
    

$conn->close();
header('Content-Type:application/json');

?>