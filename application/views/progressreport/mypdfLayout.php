        <!DOCTYPE html>
        <html>
        <head>
        <link href='https://fonts.googleapis.com/css?family=Noto Sans Malayalam' rel='stylesheet'>
        <style type="text/css">
        @media print {
        .pagebreak {
        clear: both;
        page-break-after: always;
        }
        }
        }
        </style>
        <style>
        @page 
        {
        /*size: 21cm 29.7cm;*/
        /*margin: 5mm 5mm 5mm 5mm;*/
        
        }
        
        @media print {
        body
        {
        width: 21cm;
        height: 29.7cm;
        margin: 30mm 40mm 60mm 40mm; 
        
        /* change the margins as you want them to be. */
        } 
        }
        
        
        
        
        
        body
        {
        padding: 0;  font-family: arial; color: #000; font-size: 13px; line-height: 8px;
        }
        /*.tableone{}*/
        /*.tableone td{border:1px solid #000; padding: 5px 0}*/
        /*.denifittable th{border-top: 1px solid #999;}*/
        /*.denifittable th,*/
        /*.denifittable td {border-bottom: 1px solid #999;*/
        
        /* border-collapse: collapse;border-left: 1px solid #999;}*/
        /*.denifittable tr th {padding: 3px 3px; font-weight: normal;}*/
        /*.denifittable tr td {padding: 3px 3px; font-weight: normal;}*/
        
        
        .tcmybg 
        {
        background:top center;
        background-size: 100% 100%;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 1;
        width: 100%;
        height: 100%;
        }
        
        .tablemain{
        }
        
        .subtable
        {
        z-index: 1;
        border:2px solid #000; height: 30px;
        width:700px; 
        
        }
        
        
        
        .subtablesec
        {
        border:2px solid #000; height: 1050px;
        width:750px; 
        
        }
        
        
        
        *{
        box-sizing: border-box;
        }
        
        .tableclas
        {
        border: 1px black solid; 
        width:50%;
        line-height:13px;
        }
        
        .row {
        margin-left:-5px;
        margin-right:-5px;
        }
        
        .column 
        {
        float: left;
        width: 50%;
        padding: 5px;
        }
        
        .columnn {
        float: left;
        width: 50%;
        padding: 5px;
        }
        
        
        .colm
        {
        width:100px;
        }
        /* Clearfix (clear floats) */
        .row::after {
        content: "";
        clear: both;
        display: table;
        
        }
        
        
        
        /* Clearfix (clear floats) */
        .roww::after {
        content: "";
        clear: both;
        display: table;
        }
        
        
        /*table*/
        .tab
        {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        /*border: 1px solid #ddd;*/
        }
        
        
        .tabclss
        {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 0px solid #00000;
        }
        
        .taclss
        {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 0px solid #00000;
        text-align:center;
        }
        
        .center
        {
        margin-left: auto;
        margin-right: auto;  
        }
        
        
        
        th, td {
        text-align: left;
        padding: 6px;
        line-height:10px;
        font-size:13px;
        }
        
        tr:nth-child(even)
        {
        /*background-color: #f2f2f2;*/
        }
        
        
        .first_td
        {
        width:80px !important;
        line-height:10px;
        }
        
        
        
        
        .second_td
        {
        width:2px;
        line-height:normal;
        }
        
        .third_td
        {
        width:40px;
        text-align:left;
        line-height:10px;
        }
        
        .sub
        {
        width:100%;
        }
        
        
        
        hr.hrcls
        {
        border-top: 1px solid #8c8b8b;
        }
        
        .cent
        {
        text-align:center;
        padding:10px 10px 10px 10px;
        }
        </style>
        
        
        <style >
   
    .header {
/*margin-top: 1px 2px 2px 1px;*/


text-align: center;
background: #545ee7;
color: black;
font-size: 15px;
font-family: 'Roboto',Helvetica,Sans-Serif;
color: #fff;
border-radius: 7px 7px 7px 7px;
}


                .breakhere {
                page-break-after: always;
                display: block;
                clear: both;
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
        
        
        
        <div class="container"> 
        <div class="row" >
        <div class="col-md-12">
        <!--<img src="<?php echo base_url();?>backend/pdf_report_images/sunni_pdf_heaading.png" width="100%">-->
        
        
        <img src="<?php echo base_url();?>backend/pdf_layout/<?php echo $layout['progress_card_logo']; ?>" width="100%; ">
        
        
        </div>
        </div>



        
        <table class="styled-table" style="width:100%; ">
        <thead>
        </thead>
        <tbody>
        <tr>
            <td class="active-row">Name </td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['firstname'];?></td>
        </tr>
        <tr>
            <td class="active-row">Roll No:</td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['roll_no'];?></td>
        </tr>



        <tr>
            <td class="active-row">Name Of Father:</td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['father_name'];?></td>
        </tr>



        <tr>
            <td class="active-row">Contact No:</td><td class="active-secondrow">:</td>
            <td class="active-entryrow"><?php  echo $student['mobileno'];?></td>
        </tr>


        <tr>
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



<div class="row">
            <div class="col-md-12">
            <!--<img src="<?php echo base_url();?>backend/pdf_report_images/footer1.png" width="100%">-->

            <img src="<?php echo base_url();?>backend/pdf_layout/<?php echo $layout['progress_card_footer1'];   ?>" width="100%;height:200px;">
            </div>
            </div> 
            
            
   <?php
   $exsl=1;
   
    foreach($examgroup as $exam)
    { 
   
   ?>
        
     <div class="row">
            <div class="col-md-12">
            <div class="header">
            <h1>
            <?php echo $exam['exam'];?></h1>
            </div>
            </div>
            </div>


            <div class="row" style="height: 570px;">
            <div class="col-md-12" >

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


   $maxtotal=0;
   $total=0;

    foreach($halfyearly as $haf)
    {

    if($haf['exm_id']==$exam['id'])
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

echo $res;
        //$hsum+= $haf['maxmark'];
        //$htotachieved+= $haf['marks'];
         $maxtotal+= $haf['maxmark'];
         $total+= $haf['marks'];
   ?>    
                
   </td>
  <td class="tdcls"  >
    <?php echo $haf['teacher_remark']; ?>
      
  </td>     
</tr>


<?php
}
?> 

<?php 

$hsum+= $haf['maxmark'];
$htotachieved+= $haf['marks']; 
}


$hper=($htotachieved/$hsum)*100;

$hpercentage= number_format((float)$hper, 2, '.', '');
?>


<tr>
<td class="tdcls" align="center">Total</td>
<td class="tdcls" ><?php echo number_format((float)$maxtotal, 2, '.', ''); ?></td>
<td class="tdcls"><?php echo number_format((float)$total, 2, '.', ''); ?></td>
<td class="tdcls"></td>   
</tr>

</table>
</div>
</div> 
        
<?php } ?>    
            
                
                
                </head>
                <body>
                    
                    
                    
                    
                    
                    
<?php /* ?>

<!DOCTYPE html>
<html>
  <head>
    <title>MARKS SHEET</title>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Keywords" content="html, css, html tables, table">
    <meta name="Description" content="html table">
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <!-- add icon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
       
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

   </head>


   <style >
   
    .header {



text-align: center;
background: #545ee7;
color: black;
font-size: 15px;
font-family: 'Roboto',Helvetica,Sans-Serif;
color: #fff;
border-radius: 7px 7px 7px 7px;
}


                .breakhere {
                page-break-after: always;
                display: block;
                clear: both;
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
<div class="row" >
<div class="col-md-12">
<!--<img src="<?php echo base_url();?>backend/pdf_report_images/sunni_pdf_heaading.png" width="100%">-->


<img src="<?php echo base_url();?>backend/pdf_layout/<?php echo $layout['progress_card_logo']; ?>" width="100%; height:400px;">


</div>
</div>


<div class="row" >
<div class="col-md-12">
<table class="styled-table" style="width:100%; ">
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
</div>

            <div class="row">
            <div class="col-md-12">
            <!--<img src="<?php echo base_url();?>backend/pdf_report_images/footer1.png" width="100%">-->

            <img src="<?php echo base_url();?>backend/pdf_layout/<?php echo $layout['progress_card_footer1'];   ?>" width="100%;height:200px;">
            </div>
            </div>           
             
            <br>           


    <?php
   $exsl=1;

    foreach($examgroup as $exam)
    { 

    ?>

            <div class="row">
            <div class="col-md-12">
            <div class="header">
            <h1>
            <?php echo $exam['exam'];?></h1>
            </div>
            </div>
            </div>


            <div class="row" style="height: 570px;">
            <div class="col-md-12" >

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


   $maxtotal=0;
   $total=0;

    foreach($halfyearly as $haf)
    {

    if($haf['exm_id']==$exam['id'])
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

echo $res;
        //$hsum+= $haf['maxmark'];
        //$htotachieved+= $haf['marks'];
         $maxtotal+= $haf['maxmark'];
         $total+= $haf['marks'];
   ?>    
                
   </td>
  <td class="tdcls"  >
    <?php echo $haf['teacher_remark']; ?>
      
  </td>     
</tr>


<?php
}
?> 

<?php 

$hsum+= $haf['maxmark'];
$htotachieved+= $haf['marks']; 
}


$hper=($htotachieved/$hsum)*100;

$hpercentage= number_format((float)$hper, 2, '.', '');
?>


<tr>
    <td class="tdcls" align="center">Total</td>
    <td class="tdcls" ><?php echo number_format((float)$maxtotal, 2, '.', ''); ?></td>
    <td class="tdcls"><?php echo number_format((float)$total, 2, '.', ''); ?></td>
    <td class="tdcls"></td>   
</tr>

</table>
</div>
</div>






   <div class="row" style="height:15%">
   <div class="col-md-12">

    <table style="width:100%" class="tab">
    <tr>
    <td class="tdcls" colspan="9" align ="center">GRADE
    
    </td>
    </tr>
        <tr>
<!--90 TO 100---->
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

      <!--80 TO BELOW 90---->  

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

  <!--70 TO BELOW 80----> 



       <td class="tdcls">B+ <?php if($hpercentage<80 && $hpercentage>=70)
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

          <!--60 TO BELOW 70----> 


        <td class="tdcls">B <?php if($hpercentage<70 && $hpercentage>=60)
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
        <!--50 TO BELOW 60----> 
        
        <td class="tdcls">C+ <?php if($hpercentage<60 && $hpercentage>=50)
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

         <!--40 TO BELOW 50----> 


        <td class="tdcls">C <?php if($hpercentage<50 && $hpercentage>=40)
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

        <!--30 TO BELOW 40----> 
        <td class="tdcls">D+ <?php if($hpercentage<40 && $hpercentage>=30)
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

        
        <!--20 TO BELOW 30---->
        
        
        <td class="tdcls">D <?php if($hpercentage<30 && $hpercentage>=20)
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




        <td class="tdcls">F <?php if($hpercentage<20)
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
        <td class="tdcls"  colspan="9" align ="center">SIGNATURES</td>
        </tr>


        <tr>
        <td class="tdcls" colspan="4" align ="center">Class Teacher</td>
        <td class="tdcls" colspan="5" align ="center"  >Parent</td>
        </tr>


        <tr>
        <td class="tdcls" colspan="4" align ="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="tdcls"   colspan="4" align ="center"  >&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
  </table>  


</div>
<br>




 


<?php





if($exsl=='1')
{
    
    
?>

<div class="row">
<div class="col-md-12">
   
<!--<img src="<?php echo base_url();?>backend/pdf_report_images/footer3.png" width="100%">-->

<img src="<?php echo base_url();?>backend/pdf_layout/<?php echo $layout['progress_card_footer2'];   ?>" width="100%;height:120px;">
</div>
</div>
<?php

}
elseif($exsl=='2')
{
?>
<div class="row">
<div class="col-md-12">
   
<!--<img src="<?php echo base_url();?>backend/pdf_report_images/footer3.png" width="100%">-->

<img src="<?php echo base_url();?>backend/pdf_layout/<?php echo $layout['progress_card_footer3'];   ?>" width="100%;height:120px;">
</div>
</div>
<?php
}
else
{
?>

<div class="row">
<div class="col-md-12">
   
<!--<img src="<?php echo base_url();?>backend/pdf_report_images/footer3.png" width="100%">-->

<img src="<?php echo base_url();?>backend/pdf_layout/<?php echo $layout['progress_card_footer3'];   ?>" width="100%;height:120px;">
</div>
</div>


<?php
}
?>
<div class="breakhere">
</div>
<?php
$exsl++;
} 
?>

</div>
</div>



</body>
</html>
                    
     <?php */ ?>               
                    
                    
                    
                    
                    
                    
                    
                    
                    