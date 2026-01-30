<?php


include ('./config.php');

$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
   die ("Connection failed :" .$conn->connect_error);
}

$devieId=$_POST['devieId'];
//$devieId='TP1A.220624.014';

$sql_device=" SELECT * FROM `deviceid_info` WHERE devieId='$devieId' and isActive='Yes'";
$result_device= $conn->query($sql_device);


if ($result_device->num_rows > 0)
{
$db_data="Success";
}
else{
    $db_data="Failed"; 
}

echo json_encode($db_data);
return;

$conn->close();
header('Content-Type:application/json');

?>