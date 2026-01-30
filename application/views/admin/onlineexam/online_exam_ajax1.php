



<div id="mod">
<?php

$totalhalf=$getstudent_halfdays/2;

$getstudent_workingdays;
$totalpresent=$getstudent_presentdays+$totalhalf;;

$count1=$totalpresent/$getstudent_workingdays;
$count2=$count1*100;
?>

	<p>Present Days:<?php  echo number_format((float)$count2, 2, '.', ''); ?>%</p>
	<table width="100%" class="table table-hover">
		<thead>

		<tr>
		<th>Group Name</th>
		<th>Exam Name</th>
		
	
		</tr>

		 </thead>
  <tbody>
		

<?php

foreach($getsubject as $subject)
{
?>
<tr>
<td><b><?php echo $subject['groupname']; ?></b></td>

<td><b><?php echo $subject['examname']; ?></b></td>



<?php

$studid 	    = $subject['studid']; 

$groupid	    = $subject['groupid'];

$exambatchid	= $subject['exambatchid'];

?>

<td>
	<a style="font-size: 15px;" href="<?php echo site_url();?>admin/onlineexam/viewsubjectpdf/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>" title="View Pdf"><i class="fa fa-file-pdf-o"></i></a>
</td>







</tr>


<?php
$this->db->select('*');



$this->db->from('online_examination');
$this->db->join('exam_groups', 'exam_groups.id  = online_examination.online_examination_examgroup');

$this->db->join('exam_group_class_batch_exams', 'exam_group_class_batch_exams.id  = online_examination.online_examination_exam');
$this->db->join('subjects', 'subjects.id  = online_examination.online_examination_subject','left');

$this->db->where('online_examination.online_examination_student_id', $studid);

$this->db->where('online_examination.online_examination_examgroup',$groupid); 
$this->db->where('online_examination.online_examination_exam',$exambatchid); 

$query=$this->db->get();
$res= $query->result_array();
?>


<tr>
<td>
	



	<?php
foreach($res as $getsub)
{
?>

<tr>
	<td>&nbsp;</td>
	<td><?php echo $getsub['name'];  ?></td>
</tr>


<?php } ?>
</td>
</tr>








<?php


}

?>


<tr>
<td>


<?php
if($online_exam_accept['online_examination_subject_status']=="3")
{
?>
<span style="font-size:16px;color:red; text-align:center; "><?php echo "Rejected"; ?></span>
<?php 
}
elseif($online_exam_accept['online_examination_subject_status']=="2")
{
?>
<span style="font-size:15px;color:green;text-align:center; "><?php echo "Accepted"; ?></span>
<?php }
else
{
?><span style="font-size:15px;color:blue;text-align:center; "><?php echo "Pending........"; ?></span>
<?php 
}
?>
</td>
</tr>

<tr style="height:20px;"></tr>
<tr>






<td>
<a style="color:#fff; border-width: 2px; padding:4px 4px 4px 4px; background-color:green; " href="<?php echo site_url(); ?>/admin/onlineexam/accept_exam/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>">Accept</a>
</td>

 
<td>
<a  style="color:#fff; border-width: 2px; padding:4px 4px 4px 4px; background-color:#c43535; " href="<?php echo site_url(); ?>/admin/onlineexam/reject_exam/<?php echo $studid; ?>/<?php echo $groupid; ?>/<?php echo $exambatchid; ?>">Reject</a>
</td>
<td></td>




</tr>

</tbody>
</table>

<table>



</table>
</div>