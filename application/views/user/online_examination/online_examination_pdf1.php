<html >

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>





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
 font-size:12px; 
 
}

.line
{
   border-top: 1px dotted black;
}

.row
{
  margin-left: 8px;
  margin-right: 8px;
}

.declaration
{
  font-size: 12px;
}
.declaration_text
{
   font-size: 12px;

}
.th_tablesubject
{
  font-size: 12px;

}


#div_tablesubject
{
  min-height: 2000px;
}


body { font-family: DejaVu Sans, sans-serif; }

</style>
</head>
<body>





<div class="container">

  <div class="row">



    <div id="" style="width:100%; height:auto;" >






  <table>
  <tr>
  <td><img src="<?php echo base_url();?>uploads/log/logo.jpg" width="100%">

  


  </td>
  </tr>
  </table>
  <br>

  <table>
  <tr>
  <td style="text-align: center; ">
    <span class="headertext"><b>Application Form for 1st Semester Post‐Graduation Examination  
(Faculty of Islamic & Contemporary Studies)</b></span></td>
  </tr>
  </table>
<br>
</div>






      <table width="80%" float="left">
      <tr>

        <td class="first_td">1.&nbsp;&nbsp;Name of the applicant (in block letters) </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studid['firstname']; ?></td>
        <td colspan="7"><img src="<?php echo base_url();?><?php echo $studid['image']; ?>"></td>
      </tr>


      <tr>
        <td class="first_td">2.&nbsp;&nbsp;Age & date of birth</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studid['dob']; ?></td>
      </tr>
      <tr>
        <td class="first_td">3.&nbsp;&nbsp;Name of the guardian</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studid['guardian_name']; ?></td>
      </tr>

      

      <tr>
        <td class="first_td">4.&nbsp;&nbsp;Address of communication </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php echo $studid['current_address']; ?></td>
      </tr>

        <tr>
        <td class="first_td">5.&nbsp;&nbsp;Name of the paper attending for the examination</td>
        <td class="second_td"></td>
        <td class="third_td"></td>
      </tr>

       <tr>
        <td class="first_td">5.&nbsp;&nbsp;Name of the paper attending for the examination</td>
        <td class="second_td"></td>
        <td class="third_td">df</</td>
      </tr>




    </table>

     <table width="20%" float="left">
      <tr><td>jhjh</td></tr>
    </table>

  
<br>






 


  <div id="nee" style="height: 180px;min-height:180px !important;">
    <table class="tablesubject">

    <tr>
    <th class="th_tablesubject">S.No</th>
    <th class="th_tablesubject">Course code</th>
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
      <td class="th_tablesubject"></td>
      <td class="th_tablesubject"><?php echo $sub['subject']; ?></td>
      <td class="th_tablesubject"></td>
    </tr>


    <?php 
$sl++;
  } 
  ?>   
      

    </table>
  </div>
   

    <table width="100%">     
    
      <tr>

        <td class="first_td">6.&nbsp;&nbsp;Number of working days </td>
        <td class="second_td">:</td>
        <td class="third_td"><?php  echo $getstudent_workingdays; ?></td>
      </tr>

      <tr>
        <td class="first_td">7.&nbsp;&nbsp;Number of attending days</td>
        <td class="second_td">:</td>
        <td class="third_td"><?php  echo $getstudent_presentdays; ?></td>
      </tr>
      <tr>
        <td class="first_td">8.&nbsp;&nbsp;Percentage of attendance</td>

<?php

$count1=$getstudent_presentdays/$getstudent_workingdays;
$count2=$count1*100;
?>





        <td class="second_td">:</td>
        <td class="third_td"><?php  echo  $count2; ?></td>
      </tr>

    </table>

    <br>
    <br>



<div class="footer" style="width:100%">

<div class="declaration" style="text-align:center;"><b>Attendance Declaration </b>(to be filled by class teacher)</div>

<div class="declaration_text" style="">It Is Stated Here That …………………………….……..S/O……………………………….of…………..Std, Has Attended The
Class ………………Working Days And He Is Eligible /Conditionally Eligible For Writing The Examination By
Securing 90% Of Attendance During The Academic Year 2021‐22  </div>




    <table width="100%">
    <tr>
    <td class="first_td">Name of Class Teacher </td>
    <td class="second_td">:</td>
    <td class="third_td"></td>
    <td class="third_td">date</td>
    <td></td>

    </tr>

    <tr>
    <td class="first_td">Signature</td>
    <td class="second_td">:</td>
    <td class="third_td"></td>
    <td class="third_td">place</td>
    <td></td>
    </tr>
    

    </table>
    </div>


    <div class="footer" style="width:100%">

<div class="declaration" style="text-align:left;">Signature of vice‐principal  </div>
<hr class="line"></hr>

<div class="declaration_text" style="">I hereby declare that the aforesaid information is correct to my knowledge and bear the responsibility for
the correctness of mentioned particular</div>




    <table width="100%">
    <tr>
    <td class="first_td">Name of student</td>
    <td class="second_td">:</td>
    <td class="third_td"></td>
    <td class="third_td">date</td>
    <td></td>

    </tr>

    <tr>
    <td class="first_td">Signature</td>
    <td class="second_td">:</td>
    <td class="third_td"></td>
    <td class="third_td">place</td>
    <td></td>
    </tr>
  

    </table>
    </div>





    </div>

    </div>

  
  







