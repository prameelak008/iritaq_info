 <style type="text/css">
     @media print {
      .page-break { display: block; page-break-before: always; }

    }        
       *{ margin:0; padding: 0;}
            /*body{ font-family: 'arial'; margin:0; padding: 0;font-size: 12px; color: #000;}*/
            .tc-container{width: 100%;position: relative; text-align: center;}
            .tcmybg {
                background: top center;
                background-size: contain;
                position: absolute;
                left: 0;
                bottom: 10px;
                width: 200px;
                height: 200px;
                margin-left: auto;
                margin-right: auto;
                right: 0;
            }
            /*begin students id card*/
            .studentmain{background: #efefef;width: 100%; margin-bottom: 30px;}
            .studenttop img{width:30px;vertical-align: top;}
            .studenttop{background: <?php echo $idcard->header_color; ?>;padding:2px;color: #fff;overflow: hidden;
                        position: relative;z-index: 1;}
            .sttext1{font-size: 24px;font-weight: bold;line-height: 30px;}
            .stgray{background: #efefef;padding-top: 5px; padding-bottom: 10px;}
            .staddress{margin-bottom: 0; padding-top: 2px;}
            .stdivider{border-bottom: 2px solid #000;margin-top: 5px; margin-bottom: 5px;}
            .stlist{padding: 0; margin:0; list-style: none;}
            .stlist li{text-align: left;display: inline-block;width: 100%;padding: 0px 5px;}
            .stlist li span{width:65%;float: right;}
            .stimg{width: 80px;height: auto;}
            .stimg img{width: 100%;height: auto;border-radius: 2px;display: block;}
            .img-circles {border-radius: 8px !important;}
            .center-block {display: block;margin-right: auto;margin-left: auto;}
            .staround{padding:3px 10px 3px 0;position: relative;overflow: hidden;}
            .staround2{position: relative; z-index: 9;}
            .stbottom{background: #453278;height: 20px;width: 100%;clear: both;margin-bottom: 5px;}
            .principal{margin-top: -40px;margin-right:10px; float:right;}
            .stred{color: #000;}
            .spanlr{padding-left: 5px; padding-right: 5px;}
            .cardleft{width: 20%;float: left;}
            .cardright{width: 77%;float: right; }
            .signature{border:1px solid #ddd; display:block; text-align: center; padding: 5px 20px; margin-top: 20px;}
            .vertlist{padding: 0; margin:0; list-style: none;}
            .vertlist li{text-align: left;display: inline-block;width: 100%; padding-bottom: 5px;color: #000;}
            .vertlist li span{width:65%;float: right;}
            
    </style>




<style type="text/css">
.medical {
  /*border: 1px solid;*/
  padding: 10px;
  /*box-shadow: 5px 10px;*/
  /*width:65%;
  min-height: 200px;
  max-height: 200px;*/
  font-family: 'Roboto','Source Sans Pro',sans-serif;

  width:321.25px;
  height:200.31px;
  
  -moz-border-radius-topleft: 12px; 
  -moz-border-radius-topright:12px; 
  -moz-border-radius-bottomleft:12px; 
  -moz-border-radius-bottomright:12px; 
  -webkit-border-top-left-radius:12px; 
  -webkit-border-top-right-radius:12px; 
  -webkit-border-bottom-left-radius:12px;
  -webkit-border-bottom-right-radius:12px;
  border-top-left-radius:12px; 
  border-top-right-radius:12px; 
  border-bottom-left-radius:12px;
  border-bottom-right-radius:12px;
 /* background-color: #9dd0e3;*/
}




.medicalback {
  /*border: 1px solid;*/
  padding: 0px;
  /*box-shadow: 5px 10px;*/
  /*width:65%;
  min-height: 200px;
  max-height: 200px;*/

   width:321.25px;
  height:200.31px;

  -webkit-border-top-left-radius:12px; 
  -webkit-border-top-right-radius:12px; 
  -webkit-border-bottom-left-radius:12px;
  -webkit-border-bottom-right-radius:12px;
  border-top-left-radius:12px; 
  border-top-right-radius:12px; 
  border-bottom-left-radius:12px;
  border-bottom-right-radius:12px;
  /*background-color: #9dd0e3;*/
}

.medtitle {
  display: block;
  
  margin-left: -10px;
  margin-right: -10px;
  margin-top: -10px;
  padding: 4px;
  text-align:center;
  font-weight:bold;
  /*font-size:larger;*/
  font-size:12px;
  -moz-border-radius-topleft: 12px; 
  -moz-border-radius-topright:12px; 
  -webkit-border-top-left-radius:12px; 
  -webkit-border-top-right-radius:12px; 
  border-top-left-radius:12px; 
  border-top-right-radius:12px;

  /* border-style: solid;*/

  
}

.medtitle_back
{
    display: block;
  
  margin-left: -10px;
  margin-right: -10px;
  margin-top: -10px;
  padding: 4px;
  text-align:center;
  /*font-weight:bold;
  font-size:larger;*/
  font-size:15px;
  -moz-border-radius-topleft: 12px; 
  -moz-border-radius-topright:12px; 
  -webkit-border-top-left-radius:12px; 
  -webkit-border-top-right-radius:12px; 
  border-top-left-radius:12px; 
  border-top-right-radius:12px;

  /* border-style: solid;*/



}



.medtitlefooter {
  display: block;
  
 /* margin-left: 1px;
  margin-right: 1px;
  margin-top: -10px;*/
  padding: 4px;  
  font-weight: bold;
  font-size: 12px;
  font-family: Arial;
}

.zodiac {
  display: inline-block;
  position: absolute;
  top: -170px;
  right: 7em;
  clip-path: polygon(47% 58%, 53% 58%, 64% 100%, 35% 100%);
}

.zodiac:img {
  display: block;
  width: 70px;
}

.monkey {
  transform: rotate(15deg);
}

.goat {
  transform: rotate(45deg);
}

.horse {
  transform: rotate(75deg);
}

.snake {
  transform: rotate(105deg);
}

.dragon {
  transform: rotate(135deg);
}

.rabbit {
  transform: rotate(165deg);
}

.tiger {
  transform: rotate(195deg);
}

.ox {
  transform: rotate(225deg);
}

.rat {
  transform: rotate(255deg);
}

.cow {
  transform: rotate(285deg);
}

.dog {
  transform: rotate(315deg);
}

.rooster {
  transform: rotate(345deg);
}

.footer_title
{
    width:50%
    height:20px;
    background-color:green;
}

hr.new4 {
  border: 1px solid red;
}

.pbackclass
{
    font-size:10px;
   
    
   padding-left:0px;
     margin: 0px 0px 2px !important;
}
.back_footer_address
{

    font-size: 10px
}
.pclass
{
       margin: 0px 0px 2px !important;
       font-size: 12px
}
</style>




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



   <?php 
if($idcard->enable_vertical_card)
{
?>     

<div class="medical" style="background: <?php echo $idcard->background_color; ?>;" >
<h5 class="medtitle" style="background: <?php echo $idcard->header_color; ?>; border-bottom-color: <?php echo $idcard->layout_color; ?>;
  border-bottom: 5px solid <?php echo $idcard->layout_color; ?>;  "><img src="<?php echo base_url('uploads/student_id_card/logo/'.$idcard->logo); ?>" width="30" height="30"> <?php echo $idcard->school_name; ?>
<br>
<small><?php echo $idcard->school_address; ?></small>
</h5>


<img src="<?php echo base_url() . "uploads/student_images/no_image.png"; ?>" 
style="float: left; 
margin: 0px 0px 0px 0px; 
padding: 0px 0px 0px 0px; 
object-fit: cover; /*object-position: -40px -1%;*/ 
width: 100px; height: 60px;padding-right: 5px;" />



<?php
if ($idcard->enable_student_name == 1)
{
    ?>
 <p class="pclass">Name: S.Tudent</p>                                               
<?php 
}


?>
<?php
 if ($idcard->enable_admission_no == 1) {
    ?>
<p class="pclass">Reg No: 123456789</p>
<?php } ?>

 <?php
 if ($idcard->enable_class == 1) 
 {
    ?>
<p class="pclass">Grade: Class 6 - A </p>
<?php } ?>

<?php
 if ($idcard->enable_section == 1) 
 {
    ?>
<p class="pclass">Batch: Section</p>
<?php } ?>





<?php
 if ($idcard->enable_fathers_name == 1)
  {
?>
<p class="pclass">Father's Name: Father's Name </p>
<?php } ?>

<?php
 if ($idcard->enable_mothers_name == 1)
  {
?>
<p class="pclass">Mothers's Name: Mother's Name </p>

<?php } ?>


<?php
 if ($idcard->enable_address == 1)
  {
?>
<p class="pclass">Address: D.No.1 Street Name Address Line 2 Address Line 3</p>

<?php } ?>

<?php
 if ($idcard->enable_phone == 1)
  {
?>
<p class="pclass">Phone: 1234567890</p>

<?php } ?>

<?php
 if ($idcard->enable_dob == 1)
  {
?>
<p class="pclass">DOB: 25.06.2006</p>

<?php } ?>

<?php
 if ($idcard->enable_blood_group == 1)
  {
?>
<p class="pclass">Blood Group: A+</p>

<?php } ?>

<!--<br style="clear:both;">
Blood Type: B+<br>
Doner: Yes<br>-->


<br style="clear:both;">


<div class="medtitlefooter">
<span style="background-color:<?php echo $idcard->layout_color; ?>; border-radius: 2px 2px 75px 2px;">Bus no :ss-123 &nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp;   </span><span style=" border-radius: 2px 2px 75px 2px;">Academic Year:2021-22</span>

</div>
</div>


<?php } 

else 
{ 
?>


<div class="medicalback" style="background-color: <?php echo $idcard->background_color; ?>;" >
<h4 class="medtitle_back" >Vehicle Name <br>Student ID Card


</h4>


<?php
if ($idcard->enable_pickuparea == 1)
{
    ?>
 <p class="pbackclass">Pick Up Area :Pick Up </p>                                               
<?php 
}


if ($idcard->enable_dropofarea == 1)
{
    ?>
 <p class="pbackclass">Drop Of Area: Drop Of</p>                                               
<?php 
}

if ($idcard->enable_parentcontactno1 == 1)
{
    ?>
 <p class="pbackclass">Parent Contact No 1: 123456</p>                                               
<?php 
}


if ($idcard->enable_parentcontactno2 == 1)
{
    ?>
 <p class="pbackclass">Parent Contact No2 : </p>                                               
<?php 
}

?>


<p class="pbackclass">Pick Up Area :Pick Up </p> 
<p class="pbackclass">Drop Of Area: Drop Of</p>  
<p class="pbackclass">Parent Contact No 1: 123456</p>  
<p class="pbackclass">Parent Contact No2 : </p>  


<p style="width:85%;background-color:<?php echo $idcard->layout_color; ?>;color:#fff; font-weight:bold; font-size:15px; border-radius: 2px 2px 75px 2px;padding-right:15px;"><?php  echo $idcard->layout_title;  ?> </p>

<p class="back_footer_address" ><?php echo $idcard->footer_contents; ?><br>
   <small style="text-align:center">
    &nbsp; Tel:&nbsp;9900000000 &nbsp;www.testweb.com</small>
 </p>


<br style="clear:both;">


</div>




 <?php } ?>   




  
       