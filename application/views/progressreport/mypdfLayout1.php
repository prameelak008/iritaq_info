<!DOCTYPE html>
<html>
  <head>
    <title>MARKS SHEET</title>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="html, css, html tables, table">
    <meta name="Description" content="html table">
    <!-- add icon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

   </head>


   <style >
    .header {
margin-top: 1px 2px 2px 1px;


text-align: center;
background: #545ee7;
color: black;
font-size: 16px;
font-family: 'Roboto',Helvetica,Sans-Serif;
color: #fff;
border-radius: 7px 7px 7px 7px;
}
.tab
{
border-collapse: collapse;
border-radius: 10px 4px 4px 4px;

}
.tdcls
{
     border: 1px solid #3336ab;
     color: #3b429c;
font-size: 16px;
font-family: 'Roboto',Helvetica,Sans-Serif;
font-weight: bold; 
padding :5px; 


}
.active-entryrow

{

font-size: 16px;
font-family: 'Roboto',Helvetica,Sans-Serif;

    
    text-decoration-color: black;  
text-decoration-thickness: 2px;

border-bottom: 2px solid black;

}

.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 8px ;
}


.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    /*background-color: #f3f3f3;*/
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}


.marktbl 
{
border:2px solid #3336ab; border-color:#3336ab;  
}

.active-row
{
font-weight: bold;    
color: #2b35c3;
font-size: 20px;
width: 30%;
}

.active-secondrow
{
font-weight: bold;
color: #2b35c3;
font-size: 20px;
width: 10%;

}

.active-thirdrow
{
font-weight: bold;    
color: #2b35c3;
font-size: 20px;
width: 50%;

}






</style>


<body>    
<div class="container"> 
<div class="row">
<div class="col-md-12">
<img src="<?php echo base_url();?>backend/pdf_report_images/sunni_pdf_heaading.png" width="100%">
</div>
</div>
<div class="row">
<div class="col-md-12">
<table class="styled-table" style="width:100%">
<thead>
       

    </thead>
    <tbody>
        <tr >
            <td class="active-row">Name </td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['firstname'];?></td>
        </tr>
        <tr >
            <td class="active-row">Roll No:</td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['roll_no'];?></td>
        </tr>



        <tr >
            <td class="active-row">Name Of Father:</td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['father_name'];?></td>
        </tr>



        <tr >
            <td class="active-row">Contact No:</td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['mobileno'];?></td>
        </tr>


        <tr >
            <td class="active-row">Standard</td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['class'];?></td>
        </tr>


            <tr >
            <td class="active-row">Academic Year</td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['session'];?></td>
        </tr>
        <!-- and so on... -->
    </tbody>

</table>
</div>

            <div class="row">
            <div class="col-md-12">
            <img src="<?php echo base_url();?>backend/pdf_report_images/footer1.png" width="100%">
            </div>
            </div>




            <div class="row">
            <div class="col-md-12">
            <div class="header">
            <h1>HALF YEARLY EXAMINATION</h1>
            </div>
            </div>
            </div>
             
            <br>
         




  <div class="row" style="height: 40%;">
            <div class="col-md-12">

            <table style="width:100%" class="tab">
                

    <tr> 
      <td rowspan ="2" class="tdcls" align="center">Subject</td>
      <td class="tdcls" colspan="2" align="center">Marks</td>
       <td rowspan ="2" class="tdcls" align="center">Remarks</td>
      

     
    </tr>
    <tr>
      <td class="tdcls" align="center">Total </td>
      <td class="tdcls" align="center">Achieved</td>
    </tr>


    <?php
         $hsum =0;
        $htotachieved=0;
    foreach($halfyearly as $haf)
    {
    ?>

    <tr>
      <td class="tdcls"><?php echo $haf['subname']; ?></td>
      <td class="tdcls"><?php echo $haf['maxmark']; ?></td>
      <td class="tdcls" >

         <?php 
if ($haf['attendence']=="absent") 
{
    $res="Absent";
}
else
{
  $res=$haf['marks'];  
}

            echo $res; ?>
       
                
      </td>
      <td class="tdcls" style="border:none; border-right: 1px solid #3336ab; border-color:#3336ab; " ></td>
     
    </tr>
    <?php 
        $hsum+= $haf['maxmark'];
        $htotachieved+= $haf['marks'];
    } ?>

<?php
$hper=($htotachieved/$hsum)*100;

$hpercentage= number_format((float)$hper, 2, '.', ''); 

 ?>

    <tr>
         <td class="tdcls" align="center">Total  
            
    


</td>
           <td class="tdcls"><?php echo number_format((float)$hsum, 2, '.', '');  ?></td>
           <td class="tdcls"><?php echo number_format((float)$htotachieved, 2, '.', '');  ?></td>
           <td class="tdcls"></td> 
    </tr>
    

  </table>
</div>
</div>

<br><br><br><br><br><br>


            <div class="row" style="height:15%">
            <div class="col-md-12">

              <table style="width:100%" class="tab">
                

    <tr>
    <td class="tdcls" colspan="8" align ="center">GRADE
    
    </td>
    </tr>
        <tr>

        <td class="tdcls "><span>A+</span>
        <?php if($hpercentage<=100 && $hpercentage>=90)
         {
         ?>
           <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <!--<input type="checkbox" class="form-control largerCheckbox" checked="checked" />-->
        <?php
        }
        else
        {
        ?>
   <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <!--<input type="checkbox" class="form-control largerCheckbox"  />-->
        <?php
        }
        ?>
        </td>

        <td class="tdcls">A <?php if($hpercentage<90 && $hpercentage>=80)
         {
         ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?>
       </td>


       <td class="tdcls">B+ <?php if($hpercentage<=79 && $hpercentage>=70)
         {
         ?>
        <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
        <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?></td>


        <td class="tdcls">B <?php if($hpercentage<=69 && $hpercentage>=60)
         {
         ?>
      <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
        <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?>
        </td>
        
        <td class="tdcls">C+ <?php if($hpercentage<59 && $hpercentage>=50)
         {
         ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?></td>


        <td class="tdcls">C <?php if($hpercentage<=49 && $hpercentage>=40)
         {

         ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
<img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?>
        </td>


        <td class="tdcls">D+ <?php if($hpercentage<30 && $hpercentage>=30)
         {
         ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
     <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png"/>
        <?php
        }
        ?>
        </td>

        
        
        
        
        <td class="tdcls">D <?php if($hpercentage<30)
         {
         ?>
        <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png"/>
        <?php
        }
        else
        {
        ?>
      <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png"  />
        <?php
        }
        ?>
        </td>
        </tr>

        
        <tr>
        <td class="tdcls"  colspan="8" align ="center">SIGNATURES</td>
        </tr>


        <tr>
        <td class="tdcls" colspan="4" align ="center">Class Teacher</td>
        <td class="tdcls" colspan="4" align ="center"  >Parent</td>
        </tr>


        <tr>
        <td class="tdcls" colspan="4" align ="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="tdcls"   colspan="4" align ="center"  >&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
  </table>   
           

            </div>
            </div>
            <br>
            <br>




            <div class="row">
            <div class="col-md-12">
            <img src="<?php echo base_url();?>backend/pdf_report_images/footer2.png" width="100%">
            </div>
            </div>





            <div class="row">
            <div class="col-md-12">


           <div class="header">
<h1>ANNUAL  EXAMINATION</h1>

</div>
  </div>
            </div>
             
            <br>
          




  <div class="row" style="height: 50%;">
            <div class="col-md-12">

            <table style="width:100%" class="tab">
                

    <tr> 
      <td rowspan ="2" class="tdcls" align="center">Subject</td>
      <td class="tdcls" colspan="2" align="center">Marks</td>
       <td rowspan ="2" class="tdcls" align="center">Remarks</td>
      

     
    </tr>
    <tr>
      <td class="tdcls" align="center">Total </td>
      <td class="tdcls" align="center">Achieved</td>
    </tr>


    <?php
        $sum =0;
        $totachieved=0;

    foreach($annual as $annu)
    {
    ?>

    <tr>
      <td class="tdcls"><?php echo $annu['subname']; ?></td>
      <td class="tdcls"><?php echo $annu['maxmark']; ?></td>
      <td class="tdcls">

         <?php 
if ($annu['attendence']=="absent") 
{
    $res="Absent";
}
else
{
  $res=$annu['marks'];  
}
echo $res;
 ?>
       
                
      </td>
      <td class="tdcls" style="border:none; border-right: 1px solid #3336ab; border-color:#3336ab; "><?php // echo $annu['teacherremarks']; ?></td>
    </tr>
    <?php 

        $sum+= $annu['maxmark'];
        $totachieved+= $annu['marks'];

     }
     

$per=($totachieved/$sum)*100;
$percentage= number_format((float)$per, 2, '.', ''); 

 ?>
    <tr>
         <td class="tdcls" align="center">Total</td>
          <td class="tdcls"><?php echo number_format((float)$sum, 2, '.', '');  ?></td>
           <td class="tdcls"><?php echo number_format((float)$totachieved, 2, '.', '');  ?></td>
           <td class="tdcls"></td> 
    </tr>
    

  </table>
</div>
</div>

<br><br>


            <div class="row" style="height:15%">
            <div class="col-md-12">

              <table style="width:100%" class="tab">
                

    <tr>
    <td class="tdcls" colspan="8" align ="center">GRADE</td>
    </tr>
        <tr>

        <td class="tdcls "><span>A+</span>
        <?php if($percentage<=100 && $percentage>=90)
         {
         ?>
           <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <!--<input type="checkbox" class="form-control largerCheckbox" checked="checked" />-->
        <?php
        }
        else
        {
        ?>
   <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <!--<input type="checkbox" class="form-control largerCheckbox"  />-->
        <?php
        }
        ?>
        </td>

        <td class="tdcls">A <?php if($percentage<90 && $percentage>=80)
         {
         ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?>
       </td>


       <td class="tdcls">B+ <?php if($percentage<=79 && $percentage>=70)
         {
         ?>
        <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
        <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?></td>


        <td class="tdcls">B <?php if($percentage<=69 && $percentage>=60)
         {
         ?>
      <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
        <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?>
        </td>
        
        <td class="tdcls">C+ <?php if($percentage<59 && $percentage>=50)
         {
         ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?></td>


        <td class="tdcls">C <?php if($percentage<=49 && $percentage>=40)
         {

         ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
<img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png" />
        <?php
        }
        ?>
        </td>


        <td class="tdcls">D+ <?php if($percentage<30 && $percentage>=30)
         {
         ?>
       <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png" />
        <?php
        }
        else
        {
        ?>
     <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png"/>
        <?php
        }
        ?>
        </td>

        
        
        
        
        <td class="tdcls">D <?php if($percentage<30)
         {
         ?>
        <img src="<?php  echo base_url(); ?>backend/check/downloadcheck.png"/>
        <?php
        }
        else
        {
        ?>
      <img src="<?php  echo base_url(); ?>backend/check/downloadnocheck.png"  />
        <?php
        }
        ?>
        </td>
        </tr>

        
        <tr>
        <td class="tdcls"  colspan="8" align ="center">SIGNATURES</td>
        </tr>


        <tr>
        <td class="tdcls" colspan="4" align ="center">Class Teacher</td>
        <td class="tdcls" colspan="4" align ="center"  >Parent</td>
        </tr>


        <tr>
        <td class="tdcls" colspan="4" align ="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="tdcls"   colspan="4" align ="center"  >&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
  </table>   
           

            </div>
            </div>
            <br>
            <br>




            <div class="row">
            <div class="col-md-12">
               
            <img src="<?php echo base_url();?>backend/pdf_report_images/footer3.png" width="100%">
            </div>
            </div>





            
            
            </div>
            </div>
            </div>

        </div>
  </body>
</html>