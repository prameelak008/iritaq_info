<div id="mod">
    
    <style>
        
        font-size:20px !important;
    </style>
    <form name="m" method="POST" action="<?php echo site_url('user/user/add_dat_ex'); ?>">
        
         


    <table >
        <?php


       $online_examination_subject=array();
       
       ?>
       <tr>
           
       <td>&nbsp; <?php echo "Please  Select Subject  :"; ?> &nbsp; &nbsp;</td>
       
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
            
            <input type="hidden" name="examgroupp" value="<?php echo $sub['grpidd']; ?>">
            <input type="hidden" name="examgroupbatchh" value="<?php echo $sub['grpid']; ?>">


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


if($online_exam_accept['online_examination_subject_status']=="1")
{
?>
<span class="styleclass" style="font-size:16px;color:red; text-align:center; "><?php echo "Pending......."; ?>
<a style="font-size: 15px;" href="<?php echo site_url();?>user/user/viewStudentsubjectpdf/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>" title="View Pdf"><i class="fa fa-file-pdf-o"></i></a></span>
<?php }


elseif($online_exam_accept['online_examination_subject_status']=="3")
{
?>
<span class="styleclass" style="font-size:16px;color:red; text-align:center; "><?php echo "Rejected"; ?>
<a style="font-size: 15px;" href="<?php echo site_url();?>user/user/viewStudentsubjectpdf/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>" title="View Pdf"><i class="fa fa-file-pdf-o"></i></a></span>
<?php }
elseif($online_exam_accept['online_examination_subject_status']=="2")
{
?>
<span class="styleclass" style="font-size:15px;color:green;text-align:center; "><?php echo "Accepted"; ?>
<a style="font-size: 15px;" href="<?php echo site_url();?>user/user/viewStudentsubjectpdf/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>" title="View Pdf"><i class="fa fa-file-pdf-o"></i></a></span>
<?php }



else
{
?>

<br>
<br>
<span class="styleclass">Last date for fee remittance without fine	21.09.2022<br>
With a fine of Rs.100/	23.09.2022<br>
Class leave for studying	24.09.2021 – 27.09.2022<br>
Date of Commencement of Examination	28.09.2022 – 07.10.2022<br>

Fee Details PG<br> 
a.	Application fee : Rs.50/- <br>
b.	Each KEC paper : <br>
a.	First appearance : Rs.15/- <br>
c.	Mark list fee: Rs.40/-<br> 
d.	Evaluation Camp fee: Rs.75/- (for first appearance/subsequent appearances irrespective of the number of papers appearing for). 
Fee Details UG<br>
a.	Application fee : Rs.50/- <br>
b.	Each KEC paper : <br>
a.	First appearance : Rs.10/- <br>
c.	Mark list fee: Rs.40/- <br>
d.	Evaluation Camp fee: Rs.60/- (for first appearance/subsequent appearances irrespective of the number of papers appearing for). <br>

Mode of payment – The fee has to be paid as liquid cash at Jamia Jalaliyya Academic office. No other mode of payment is acceptable.</span>
<br>
<br>


<input type="checkbox"   name="declartion" required="required" style="background:#000; color:#fff;" >
<!--I hereby declare that the information provided is true and correct. -->
<span class="styleclass"><b>I solemnly declare that the particulars given above are correct to the best of my knowledge.<br>
Yours faithfully
</b></span>

<br>

<br>


<input type="submit" name="submit" value="SUBMIT" class="btn btn-default">

<?php

}



?>

    



     </form>
</div>