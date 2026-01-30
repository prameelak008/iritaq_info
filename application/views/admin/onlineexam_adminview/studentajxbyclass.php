<div class="mailbox-controls" id="clsId">



<?php
$result    = $this->customlib->getUserData();
$role      = $result["user_type"];
?>



	<form method="post" action="<?php echo site_url('admin/Onlineexam_list/bulkdelete_student_online_exam'); ?>">				
<table  class="table table-striped table-bordered table-hover student-list" data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">
                         <thead>
						 <tr>
						 <th>sl.No</th>
						 <th>Admission No</th>
						 <th>Roll No</th>
						 <th>Name</th>
						 <th>Class</th>
						 <th>Section</th>
						 <th>Mobile</th>
             <th>PDF</th>

             <?php
             if($role =="Super Admin")
             {

              ?>
             <th>Delete</th>


					
						<th>
							<button type="submit" style="font-size:12px; background-color:red;" class="btn btn-success" name="save"><i class="fa fa-trash" title="Select & Delete"></i></button>


              </th>
            <?php } ?>



							<th>
 <!--<button  class="btn btn-info btn-sm printSelected pull-right" type="submit" name="generate" title="generate multiple certificate"><?php echo $this->lang->line('generate'); ?></button>-->
							
						    </th>
						
						 </tr>
						 </thead>
						 
						 
						 <?php

						// print_r($logindetails);
						
						 $sl=1;
						 foreach($logindetails as $login)
						 {
						 ?>
						 <tr>
						 <td><?php echo  $sl;?></td>
						 <td><?php echo $login['admission_no'];?></td>
						 <td><?php echo $login['roll_no'];?></td>
						 <td><?php echo $login['firstname'].'&nbsp;'.$login['middlename'].''.$login['lastname'];?></td>
					     <td><?php echo $login['class'];?></td>
					     <td><?php echo $login['section'];?></td>
						 
						 <td>
						 <?php echo $login['mobileno'];					 	

						 $student			= $login['student_id'];
						 $class_id			= $login['class_id'];
						 $section_id		= $login['section_id'];




						?>
						 <input type="hidden" name="studid" id="studid<?php echo $sl; ?>" value="<?php echo $login['student_id'];?>">
						 <input type="hidden" name="group" id="group<?php echo $sl; ?>" value="<?php echo $login['online_examination_examgroup']; ?>">
						 <input type="hidden" name="exambatchid" id="exambatchid<?php echo $sl; ?>" value="<?php echo $login['online_examination_exam']; ?>">

						 
						 </td>

             <td>
              <input type="button" value="View Pdf" id="btnPrint" onclick="getpdf(<?php echo $sl; ?>)"  />
              </td>	



<?php
if($role =="Super Admin")
{

?>

<td>
  
  <a  href="<?php echo site_url();?>/admin/onlineexam_list/delete_student_online_exam/<?php echo  $student; ?>/<?php echo  $class_id; ?>/<?php echo  $section_id; ?>" style="color:red; font-size:20px;"><i class="fa fa-remove"></i></a>
</td>



							 
						
						  <td>

						  
<input type="checkbox" id="checkItem" name="check[]" value="<?php echo $student; ?>">

						  </td>
            <?php } ?>

						 
						 </tr>
						 
						 <?php $sl++; } ?>

						 </table>
						 </form>





		<!--<script>      

        function getpdf(row)
        { 

        var studid      = $("#studid"+row).val();
        var group     = $("#group"+row).val();
        var exambatchid = $("#exambatchid"+row).val();

        $.ajax({
        type : "POST",
        url: base_url + "admin/onlineexam_list/viewsubjectpdf_printer",
       
       data: {studid:studid,group:group,exambatchid:exambatchid},       
        datatype : 'JSON',      

        success:function(data)
        {

            $("#print_content").html(data);

            var ht = $(window).height();
            var wt = $(window).width();


            var divContents = $("#print_content").html();
            var printWindow = window.open('', '', 'height=' + ht + 'px,width=' + wt + 'px');
            printWindow.document.write('<html><head><title><?php  echo $this->customlib->getAppName(); ?>  </title>');
            printWindow.document.write('<link href="#"');
            printWindow.document.write('</head><body>');
            printWindow.document.write(data);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print(); 
            
        },
    
});
           
           
        }



    </script>	





     <div id="print_content" style="visibility:hidden;" >
    


   <!doctype html>
<html lang="en">
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/png" href="assets/img/s-favican.png">
        <meta http-equiv="X-UA-Compatible" content="" />

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="theme-color" content="" />
    <?php echo $this->customlib->getCSRF(); ?>   
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">





        
<style>

body 
{ 
/*font-family: Almarai, sans-serif;  direction: ltr;
font-family:Arial;  direction: ltr;



font-family: DejaVu Sans, sans-serif;  direction: ltr;*/
    
}





.container
{
  width: 100%;
  border-top: 2px solid black;
  border-bottom: 2px solid black;
  border-left: 2px dotted black;
  border-right: 2px dotted black; 



}

.tablesubject
 {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #000;

 
}

.th_tablesubject
{
  border: 1px solid #000;
  text-align:left;

}


.first_td
{
  width:50%;
  font-size:12px; 
 


}

.second_td
{
  width:5%;
}

.third_td
{
  width:50%;
  margin-left: 0px;
   font-size:12px; 
}

.headertext
{
 font-size:15px;
 font-weight: bold; 
 
}

.div30
{
 width:30%; 
}

.div10
{
 width:10%; 
}

.div40
{
 width:40%; 
}

.div20
{
 width:20%; 
}


.div50
{
 width:50%; 
}

.line
{
   border-top: 1px dotted black;
}

.row
{
  margin-left: 20px;
  margin-right: 20px;

}

.declaration
{
  font-size: 13px;
}
.declaration_text
{
   font-size: 14px;

}
.th_tablesubject
{
  font-size: 13px;

}


#div_tablesubject
{
  min-height: 2000px;
}

</style>

</head>

<body class="body">
<div class="container">

<div class="row">



  <div id="" style="width:100%; height:auto;" >
  <table>
  <tr>
  <td><img src="<?php echo base_url();?>uploads/log/logo_pdf.png" width="100%">
  </td>
  </tr>
  </table>
  </div>

  <br>



  <div style="width: 100%; display: table;">

    <div style="width: 70%; float:left;">

 <table>
  <tr>
  <td style="text-align: center; ">
    <span class="headertext" style="font-weight:bold; font-size:17px;">
        <b>Application Form for 1st Semester Post‐Graduation Examination <br> 
(Faculty of Islamic & Contemporary Studies)
<br>


</b></span></td>

  </tr>
  </table>


  <table  float="left">
      
      
       <tr>

        <td class="first_td">1.&nbsp;&nbsp;Institution Id </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studidd['admission_no']; ?></td>
        
      </tr>
      
      <tr>
        <td class="first_td">2.&nbsp;&nbsp;Name of the applicant (in block letters) </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studidd['firstname']; ?></td>
      </tr>
      
      
       <tr>
        <td class="first_td">3.&nbsp;&nbsp;Register No </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studidd['roll_no']; ?></td>
      </tr>
      
      


      <tr>
        <td class="first_td">4.&nbsp;&nbsp;Age & date of birth</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studidd['dob']; ?></td>
      </tr>
      <tr>
        <td class="first_td">5.&nbsp;&nbsp;Name of the guardian</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studid['guardian_name']; ?></td>
      </tr>

      

      <tr>
        <td class="first_td">6.&nbsp;&nbsp;Address of communication </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studidd['current_address']; ?></td>
      </tr>

        <tr>
        <td class="first_td">7.&nbsp;&nbsp;Name of the paper attending for the examination</td>
        <td class="second_td"></td>
        <td class="third_td"></td>
      </tr>

     

    </table>





      </div>


      <div style="width: 30%; float:left;">

        <table width="30%" float="left">
            <tr style="text-align: right;"> 

<td >

<?php

if($studid['image']=="")
{
?>
<img src="<?php echo base_url();?>/backend/default_format/copy_photo.png" style="width:150px; height:200px;" >

<?php
}
else
{
?> 

<img src="<?php echo base_url();?>/<?php echo $studid['image']; ?>"  style="width:150px; height:200px;">

<?php } ?>

</td>
</tr>
</table>
</div>

</div>




    
    
    
<br>
 


    <div  style="height:auto;min-height:240px !important; ">
    <table class="tablesubject">

    <tr>
    <th class="th_tablesubject">S.No</th>
    <th colspan="2" class="th_tablesubject">Course code</th>
    <th class="th_tablesubject">Subject</th>
    <th class="th_tablesubject">Paper</th>
    </tr> 


    <?php
    $sl=1;

  


    foreach($subjects as $sub)
    {    
    
    ?>
    <tr>
      <td class="th_tablesubject">
        <?php echo $sl; ?>
      </td>
      
      <?php $subjectcode= $sub['subjectcode'];
      
      $arr = explode('-', trim($subjectcode));
      ?>
      <td class="th_tablesubject"><?php echo $arr[0]; ?></td>
      <td class="th_tablesubject"><?php echo $arr[1]; ?></td>
      
  
    
    
    
  <td class="th_tablesubject"><?php echo $sub['subject']; ?></td>
    
    
    
      <td class="th_tablesubject"></td>
    </tr>


    <?php 
$sl++;
  } 
  ?>   
      

    </table>
  </div>

   <div style="width: 70%; display: table;">

    


    <table width="100%">     
    
      <tr>

        <td class="first_td">8.&nbsp;&nbsp;Number of working days </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php  echo $getstudent_workingdays; ?></td>
      </tr>

      <tr>
        <td class="first_td">9.&nbsp;&nbsp;Number of attending days</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php  

        $totalhalf=$getstudent_halfdays/2;



        echo $totalpresent=$getstudent_presentdays+$totalhalf; ?></td>
      </tr>
      <tr>
        <td class="first_td">10.&nbsp;&nbsp;Percentage of attendance</td>

<?php
$count1=$totalpresent/$getstudent_workingdays;
$count2=$count1*100;
?>





        <td class="second_td">:</td>
        <td class="third_td"><?php  echo number_format((float)$count2, 2, '.', ''); ?>%</td>       
        
      </tr>

    </table>
  </div>

    <br>



<div class="footer" style="width:100%; ">

<div class="declaration" style="text-align:center; "><span style="font-weight:bold;font-size:16px;"><b style="font-weight:bold">Attendance Declaration </b></span>(to be filled by class teacher)</div>
<br>

<div class="declaration_text" style="text-align: left; margin-left:5px;">It Is stated here that …………………………….……..s/o……………………………….of…………..std, has attended <br>the
class ………………working days and he is eligible /conditionally eligible for writing the examination by<br>
securing 90% of attendance during the academic year 2022 <?php echo '-'; ?> &nbsp;23  </div>
</div>



   

    <div style="width: 100%; display: table;">

<table  style="width:100% !important;">
    <tr>

        <td class="" style="width:30% !important;">Name of Class Teacher :</td>
        
    <td class="" style="width:40%">: </td>

         <td class="" style="width:30% !important;">Date :</td>

         
        
      </tr>
      
      <tr>

        

         <td class="" style="width:30% !important;">Signature </td>
        
    <td class="" style="width:40%">: </td>

         <td class="" style="width:30% !important;">Place :</td>
        
        
      </tr>



      <tr>

        

         <td class="" style="width:30% !important;">Signature of Vice Principal  :</td>
        
    <td class="" style="width:40%">: </td>

         <td class="" style="width:30% !important;">&nbsp;</td>
        
        
      </tr>

</table>
</div>



   


 




<div class="footer" style="width:100%; ">

<div class="declaration" style="text-align:left; ">
</div>

<hr class="line"></hr>
<br>

<div class="declaration_text" style="">I hereby declare that the aforesaid information is correct to my knowledge and bear the responsibility for
the correctness of mentioned particular. </div>
</div>









<div style="width: 100%; display: table;">

  <table  style="width:100% !important;">
      
      
       <tr>

        <td class="" style="width:30%">Name of Student</td>
        
    <td class="" style="width:40%">: </td>

         <td class="" style="width:30%">Date :</td>

         
        
      </tr>
      
      <tr>

        

         <td class="" style="width:30%">Signature </td>
        
    <td class="" style="width:40%">: </td>

         <td class="" style="width:30%">Place :</td>
      </tr> 

    </table>
  </div>
    <br>
    <br>

    </div>-->
    </div>					 
                          
						  
                        </div>