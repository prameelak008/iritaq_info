<div id="mod">
    
    <style>
        
    font-size:20px !important;
    </style>


<?php

$date       = date('d-m-Y');

$lastdate   = $instruction['online_examination_lasdate_of_exam'];

if(strtotime($date)<=strtotime($lastdate))
//if(strtotime($lastdate)<=strtotime($date))
{
?>




    <form name="m" method="POST" action="<?php echo site_url('user/user/add_dat_ex'); ?>">
    <table >
        <?php


       $online_examination_subject=array();
       
       ?>
       <tr>
           
       <td>&nbsp; <b><?php echo "Please  Select Subject  :"; ?> &nbsp; &nbsp;</b></td>
       
       </tr>
       
       <tr><td>&nbsp;</td></tr>
       
       
       
       <?php
       
       foreach($getst as $gt) 
        {

        $online_examination_subject[]=$gt['online_examination_subject'];

        }


        foreach($getsubjectid as $sub) 
        {
           if(in_array($sub['subjectid'], $online_examination_subject))
           {
            $checked="checked";
           }
           else
           {
           $checked="";
           }
        ?>

        <tr style="width:20px">
        <td class="styleclass">
            <input type="checkbox" <?php echo $checked; ?>   name="check[]" value="<?php echo $sub['subjectid']; ?>">
            <input type="hidden" name="examgroup[]" value="<?php echo $sub['grpidd']; ?>">
            <input type="hidden" name="examgroupbatch[]" value="<?php echo $sub['grpid']; ?>">
            
            <input type="hidden" id="groupid" name="examgroupp" value="<?php echo $sub['grpidd']; ?>">
            <input type="hidden"  id="exambatchid" name="examgroupbatchh" value="<?php echo $sub['grpid']; ?>">



           


        </td>
        
       
        
        <td class="styleclass">
        <?php  echo $sub['subject']; ?>
        </td>
        
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        
        <td><?php  echo $sub['subcode']; ?></td>
        </tr>

    <?php }  ?>

    </table>


<?php
$studid=$online_exam_accept['online_examination_student_id'];
$groupid=$online_exam_accept['online_examination_examgroup'];
$exambatchid=$online_exam_accept['online_examination_exam'];
?>
 <input type="hidden" id="studid" name="studid" value="<?php echo $studid; ?>">

<?php
if($online_exam_accept['online_examination_subject_status']=="1")
{
?>

<span class="styleclass" style="font-size:16px;color:red; text-align:center; "><?php echo "Pending......."; ?>

<a title="Delete Pdf" onclick="return doconfirm();" href="<?php echo site_url();?>user/user/delete_appliedpdf/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>" style="background-color: #4CAF50;  border: none;  color: white;  padding: 5px 5px;  text-align: center;  text-decoration: none;  display: inline-block;  font-size: 12px;  margin: 2px 2px;  cursor: pointer;">

  Cancel Pdf</a>

</span>




<input type="button" value="Generate" id="btnPrint" />

<?php 
}

elseif($online_exam_accept['online_examination_subject_status']=="3")
{
?>
<span class="styleclass" style="font-size:16px;color:red; text-align:center; "><?php echo "Rejected"; ?>
<!--<a style="font-size: 15px;" href="<?php echo site_url();?>user/user/viewStudentsubjectpdf/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>" title="View Pdf"><i class="fa fa-file-pdf-o"></i></a>
-->

</span>
<br>

<input type="button" value="Generate" id="btnPrint" />
<?php }
elseif($online_exam_accept['online_examination_subject_status']=="2")
{
?>
<span class="styleclass" style="font-size:15px;color:green;text-align:center; "><?php echo "Accepted"; ?>

<!--
<a style="font-size: 15px;" href="<?php echo site_url();?>user/user/viewStudentsubjectpdf/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>" title="View Pdf"><i class="fa fa-file-pdf-o"></i></a></span>

-->
</span>
<br>



<input type="button" value="Generate" id="btnPrint" />

<?php }



else
{
?>

<br>
<br>




<!--

<p style="font-size:16px"><b>Instructions  :</b></p>



<span class="styleclass">Last date for fee remittance without fine  21.09.2022<br>
With a fine of Rs.100/  23.09.2022<br>
Class leave for studying    24.09.2021 – 27.09.2022<br>
Date of Commencement of Examination 28.09.2022 – 07.10.2022<br>

<b>Fee Details PG</b><br> 
a.  Application fee : Rs.50/- <br>
b.  Each KEC paper : <br>
a.  First appearance : Rs.15/- <br>
c.  Mark list fee: Rs.40/-<br> 
d.  Evaluation Camp fee: Rs.75/- (for first appearance/subsequent appearances irrespective of the number of papers appearing for). 
<b>Fee Details UG</b><br>
a.  Application fee : Rs.50/- <br>
b.  Each KEC paper : <br>
a.  First appearance : Rs.10/- <br>
c.  Mark list fee: Rs.40/- <br>
d.  Evaluation Camp fee: Rs.60/- (for first appearance/subsequent appearances irrespective of the number of papers appearing for). <br>

<b>Mode of payment</b> – The fee has to be paid as liquid cash at Jamia Jalaliyya Academic office. No other mode of payment is acceptable.</span>
<br>
<br>


<input type="checkbox"   name="declartion" required="required" style="background:#000; color:#fff;" >
/*I hereby declare that the information provided is true and correct.*/
<span class="styleclass"><b>I solemnly declare that the particulars given above are correct to the best of my knowledge.<br>
Yours faithfully
</b></span>

<br>

<br>

-->




<p style="font-size:16px"><b><?php echo $instruction['online_examination_heading'];  ?>:</b></p>



<span class="styleclass"><?php echo $instruction['online_examination_last_date_fee_withoutfine'];  ?><br>
<?php echo $instruction['online_examination_last_date_fee_withfine'];  ?><br>
<?php echo $instruction['online_examination_class_leave_for_studying'];  ?><br>
<?php echo $instruction['online_examination_Examcommencement'];  ?><br>

<p><?php echo $instruction['online_examination_fee_details'];  ?></p>
<p><?php echo $instruction['online_examination_mode_of_payment'];  ?></p>

<br>
<br>


<input type="checkbox"   name="declartion" required="required" style="background:#000; color:#fff;" >

<span class="styleclass"><?php echo $instruction['online_examination_declaration'];  ?></span>

<br>

<br>



<input type="submit" name="submit" value="PROCEED" class="btn btn-default">



<?php
}
?>

</form>

<?php 
} 
else
{


echo "<table width='100%'><tr><td style='text-align:center; font-size:15px; color:#d83939;'>No  Exam Found</td></tr></table>";

}

?>






</div>

<script>
        $("#btnPrint").on("click", function() 
        {

        var studid      = $("#studid").val();
        var group     = $("#groupid").val();
        var exambatchid = $("#exambatchid").val();





    $.ajax({
        type : "POST",

        url: base_url + "user/user/viewsubjectpdf_printer",
       
       data: {studid:studid,group:group,exambatchid:exambatchid},       
        datatype : 'JSON',      

        success:function(data)
        {

           // $("#print_content").html(data);

            var ht = $(window).height();
            var wt = $(window).width();



            var divContents = $("#print_content").html();
            var printWindow = window.open('', '', 'height=' + ht + 'px,width=' + wt + 'px');
            printWindow.document.write('<html><head><title><?php  echo $this->customlib->getAppName(); ?>  </title>');
            printWindow.document.write('<link href="<?=base_url()?>web_assets/css/bootstrap.css" rel="stylesheet" media="screen">  <link href="<?=base_url()?>web_assets/css/custom.css" rel="stylesheet" media="screen">');
            printWindow.document.write('</head><body>');
            printWindow.document.write(data);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print(); 
            
        },
    
});
           
           
        });


    </script>



     




<script type="text/javascript">


function doconfirm()
{

job=confirm("Are you sure to cancel this Exam Application?");
if(job!=true)
{
return false;
}
else
{

alert('Cancelled');
return true;
}

}

</script>


