<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat();?>
<style type="text/css">

.line {
  display: inline-block;
  width: 80%;
  height: 1px;
  background-color: #987;
  vertical-align: middle;
  border:1px solid #e8e8e8;
}

.mydiv
{
background-color:#000;
text-align:center;   
}



.footer-section
{
padding: 10px 40px;
}



.logo{
width: 50%;
}

.row{
display: flex;
flex-wrap: wrap;
}
.col-6{
width: 50%;
flex: 0 0 auto;
}
.text-white{
color: #fff;
}
.company-details{
float: right;
text-align: right;
}
.body-section{
padding: 20px;
border: 1px solid gray;
}
.heading{
font-size: 20px;
margin-bottom: 08px;
}


.Nametitle{
font-size: 15px;
margin-bottom: 08px;
}
.sub-heading{
color: #262626;
margin-bottom: 05px;
}


table{
background-color: #000;
width: 100%;
border-collapse: collapse;
}
table thead tr{
border: 1px solid #111;
background-color: #f2f2f2;
}
table td {
vertical-align: middle !important;
text-align: left;
padding-left: 10px !important;
}

table th, table td {
padding-top: 10px;
padding-bottom: 10px;
}
.table-bordered{
box-shadow: 0px 0px 5px 0.5px gray;
}
.table-bordered td, .table-bordered th {
border: 1px solid #dee2e6;
}
.text-right{
text-align: end;
}
.w-20{
width: 20%;
}

.w-40{
width: 40%;
}
.float-right{
float: right;
}

.text-black
{
color:#000;
font-size:18px;
/*text-align:center;*/
}

.text-heading
{
color:#000;
font-size:80px;
/*text-align:center;*/  
}

}

/*@media print 
{
@page
{
height: 10.5cm;
width: 14.8cm;  
}

}*/

.page-break { display: block; page-break-before: always; }
@media print {
.page-break { display: block; page-break-before: always; }
.col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
float: left;
}
.col-sm-12 {
width: 100%;
}
.col-sm-11 {
width: 91.66666667%;
}
.col-sm-10 {
width: 83.33333333%;
}
.col-sm-9 {
width: 75%;
}
.col-sm-8 {
width: 66.66666667%;
}
.col-sm-7 {
width: 58.33333333%;
}
.col-sm-6 {
width: 50%;

}
.col-sm-5 {
width: 41.66666667%;
}
.col-sm-4 {
width: 33.33333333%;
}
.col-sm-3 {
width: 25%;
}
.col-sm-2 {
width: 16.66666667%;
}
.col-sm-1 {
width: 8.33333333%;
}
.col-sm-pull-12 {
right: 100%;
}
.col-sm-pull-11 {
right: 91.66666667%;
}
.col-sm-pull-10 {
right: 83.33333333%;
}
.col-sm-pull-9 {
right: 75%;
}
.col-sm-pull-8 {
right: 66.66666667%;
}
.col-sm-pull-7 {
right: 58.33333333%;
}
.col-sm-pull-6 {
right: 50%;
}
.col-sm-pull-5 {
right: 41.66666667%;
}
.col-sm-pull-4 {
right: 33.33333333%;
}
.col-sm-pull-3 {
right: 25%;
}
.col-sm-pull-2 {
right: 16.66666667%;
}
.col-sm-pull-1 {
right: 8.33333333%;
}
.col-sm-pull-0 {
right: auto;
}
.col-sm-push-12 {
left: 100%;
}
.col-sm-push-11 {
left: 91.66666667%;
}
.col-sm-push-10 {
left: 83.33333333%;
}
.col-sm-push-9 {
left: 75%;
}
.col-sm-push-8 {
left: 66.66666667%;
}
.col-sm-push-7 {
left: 58.33333333%;
}
.col-sm-push-6 {
left: 50%;
}
.col-sm-push-5 {
left: 41.66666667%;
}
.col-sm-push-4 {
left: 33.33333333%;
}
.col-sm-push-3 {
left: 25%;
}
.col-sm-push-2 {
left: 16.66666667%;
}
.col-sm-push-1 {
left: 8.33333333%;
}
.col-sm-push-0 {
left: auto;
}
.col-sm-offset-12 {
margin-left: 100%;
}
.col-sm-offset-11 {
margin-left: 91.66666667%;
}
.col-sm-offset-10 {
margin-left: 83.33333333%;
}
.col-sm-offset-9 {
margin-left: 75%;
}
.col-sm-offset-8 {
margin-left: 66.66666667%;
}
.col-sm-offset-7 {
margin-left: 58.33333333%;
}
.col-sm-offset-6 {
margin-left: 50%;
}
.col-sm-offset-5 {
margin-left: 41.66666667%;
}
.col-sm-offset-4 {
margin-left: 33.33333333%;
}
.col-sm-offset-3 {
margin-left: 25%;
}
.col-sm-offset-2 {
margin-left: 16.66666667%;
}
.col-sm-offset-1 {
margin-left: 8.33333333%;
}
.col-sm-offset-0 {
margin-left: 0%;
}
.visible-xs {
display: none !important;
}
.hidden-xs {
display: block !important;
}
table.hidden-xs {
display: table;
}
tr.hidden-xs {
display: table-row !important;
}
th.hidden-xs,
td.hidden-xs {
display: table-cell !important;
}
.hidden-xs.hidden-print {
display: none !important;
}
.hidden-sm {
display: none !important;
}
.visible-sm {
display: block !important;
}
table.visible-sm {
display: table;
}
tr.visible-sm {
display: table-row !important;
}
th.visible-sm,
td.visible-sm {
display: table-cell !important;
}
.trbg{
text-align: center !important;
background-color: #008080 !important;
border-color:white !important;
}
.tbg{
text-align: center !important;
background-color: #D1D0CE !important;
border-color:white !important;
}
.trbody{
border-color:white !important;
}

}
th, td {
  padding: 5px !important;
}
.tdcls
{
    font-size:14px;
}

@media print {

html, body {
height:100%;
margin: 0 !important;
padding: 0 !important;
overflow: hidden;
}
</style>



<html lang="en">
<head>
<title><?php echo $this->lang->line('fees_receipt'); ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css">
</head>
<body>
<section class="content">
<div class="row">
<div class="col-sm-12">
<div class="">
        <div class="">
            <div class="col-sm-12">
            <img src="<?php echo base_url() ?>backend/default_format/exam_result_logo.jpg" style="height: 130px;width:100%" />
            <hr style="border-top: 1px solid #e8e8e8;"></hr>
            </div>
        
            <div class="col-sm-6" style="font-size:18px;">
            <?php 
            $autocl = substr($stulist->class, 0, 3);

            ?>
            
        <div class="text-left" ><b>APPLICATION NO &nbsp;: </b><?php echo $autocl.$leaveid; ?></div>
        </div>
        <div class="col-sm-6" style="font-size:18px;">
        <div class="text-right" style="padding-right:8px; font-size:18px;">DATE: <?php echo date('d-M-Y'); ?></div>
        </div>
        <div class="col-sm-9">
        <h5 class="text-center" style="text-transform: uppercase; ;font-size:18px;"><b>APPLICATION FOR LEAVE</b></h5>
        </div>

        <div class="col-sm-12" align="center">
        <div class="col-sm-9">
        <table style="font-size: 9pt;">
        <tr>
                        <?php
                        if (empty($stulist->image)) {
                        $image = "student_images/default_male.jpg";
                        } else {
                        $image = $stulist->image;
                        }
                        ?> 
                    <td width="50%" style="text-align: left;padding:1px;" class="tdcls">Institute Id</td>
                    <td width="1%" class="tdcls">:</td>
                    <td style="text-align: left;" class="tdcls"><b><?php echo $stulist->admission_no; ?></b></td>
                    </tr>
                
               
                
                
                <tr>
                    <td width="50%" style="text-align: left;padding:1px;" class="tdcls">Name of the applicant </td><td width="1%" class="tdcls">:</td>
                    <td style="text-align: left;" class="tdcls"><?php echo $stulist->namest; ?></td>
                </tr>
                
                <tr>
                    <td width="50%" style="text-align: left;padding:1px;" class="tdcls">Register No</td>
                    <td width="1%" class="tdcls">:</td>
                    <td style="text-align: left;" class="tdcls"><?php echo $stulist->admission_no; ?></td>
                </tr>
                <tr>
                    <td width="50%" style="text-align: left;padding:1px;" class="tdcls">Age & Date of Birth</td>
                    <td width="1%" class="tdcls">:</td>
                    <td style="text-align: left;" class="tdcls"><?php echo $stulist->dob; ?></td>
                </tr>
                
                 <tr>
                    <td width="50%" style="text-align: left;padding:1px;" class="tdcls">Class</td>
                    <td width="1%" class="tdcls">:</td>
                    <td style="text-align: left;" class="tdcls"><?php echo $stulist->class; ?></td>
                </tr>
                
                <tr>
                    <td width="50%" style="text-align: left;padding:1px;" class="tdcls">Section & Semester</td>
                    <td width="1%" class="tdcls">:</td>
                    <td style="text-align: left;" class="tdcls"><?php echo $stulist->section; ?></td>
                </tr>
                
                 <tr>
                    <td width="50%" style="text-align: left;padding:1px;" class="tdcls">Name of the guardian</td>
                    <td width="1%" class="tdcls">:</td>
                    <td style="text-align: left;" class="tdcls"><?php echo $stulist->guardian_name; ?></td>
                </tr>
                
                <!--<tr>-->
                <!--    <td width="50%" style="text-align: left;padding:1px;" class="tdcls">Address of Communication</td><td width="1%" class="tdcls">:</td>-->
                <!--    <td style="text-align: left;" class="tdcls"><?php echo $stulist->mobileno; ?></td>-->
                <!--</tr>-->
                
            </table>
        </div>
        
         <div class="col-sm-3">
        <img src="<?php echo base_url() . $image; ?>" alt="User profile picture" style="width: 130px;height:170px;margin-top: 0px"> 
        </div> 
        </div>
        
        
   
        <div class="col-sm-12">
            
            <?php
            $count = 1;
            $extractedLeaveDetails = [];
            $desiredRecordId = $leaveid;
            $desiredRecord = null;
            $sumLeaveHrDiff = 0;
            $sumLeaveDayDiff = 0;
            
            
            foreach ($totalleave as $totleave) {
            if ($totleave['lvid'] == $desiredRecordId) {
            $desiredRecord = $totleave;
            }
            $extractedLeaveDetails[] = $totleave;
            }
            ?>
            
            
            <table style="width:100%;">
                
            <!--<tr><td>-->
            <!--    <b>LEAVE DETAILS: </b></td><td colspan="2"><hr>-->
                
            <!--    </td></tr>-->
            <!--<tr>-->
            
            <tr>
                <td colspan="3"><b>LEAVE DETAILS&nbsp;:&nbsp;&nbsp;</b><span class="line"></span></td>
            </tr>
            
            <tr>
                <td><b>Date and Time</b></td>
            </tr>
            
            <tr>
                <td><b>Leave From: </b> <?php echo $tott_leave->fromdt; ?></td>
                <td><b>Leave To: </b> <?php echo $tott_leave->todt; ?></td>
                <td><b>Total Leave: </b> <?php /* echo $totleave->totalhours . " hrs"; */  echo $tott_leave->leavehrdiff; ?> </td>
            </tr>
            </table>

            <table style="border:1px solid;font-size: 10pt;" border="1" >
                
                <thead>
                <tr style="background-color: #e8e8e8 !important;" >
                <th style="text-align: center;" colspan="8">Attendance & Leave Record</th>
                </tr>
                
                
                    <tr>
                    <th style="text-align: center;" rowspan="2" ></th> 
                    <th style="text-align: center; " rowspan="2">Number of <br>Working Days</th>
                    <th style="text-align: center;" rowspan="2">Number of <br>Attending Days</th>
                    <th style="text-align: center;" rowspan="2">Percentage <br>of Attendance</th>
                    <th style="text-align: center;" colspan="2">Total Leaves</th>
                    <th style="text-align: center;" rowspan="2">Reporting Accuracy</th> 
                    <th style="text-align: center;" rowspan="2">Remarks</th> 
                    </tr>
                    
                    <tr> <td style="text-align: center;">Days</td> 
                    <td style="text-align: center;">Hours</td></tr>
                </thead>
                
                <tbody>
                    
                  <?php 
    // Display the extracted leave details with the sum of leavehrdiff and leavedaydiff
    foreach ($extractedLeaveDetails as $totleave) {
         if ($totleave['lvid'] == $desiredRecordId) {
            break;
        }
        $sumLeaveHrDiff += $totleave['leavehrdiff'];
        $sumLeaveDayDiff += $totleave['leavedaydiff'];
        }
        ?> 
                    <tr>
                    <td style="text-align: center;"  ><?php echo $worklist->clas; ?></td> 
                    <td style="text-align: center;"  ><?php echo $worklist->workingdays; ?></td> 
                    <td style="text-align: center;"  ><?php echo $att->attendingdays; ?></td> 
                    <td style="text-align: center;"  ><?php
                    $working = $worklist->workingdays;
                    $attending = $att->attendingdays;
                    $perofatt = $attending/$working * 100;
                    ?>
                    <?php echo round($perofatt,2); ?>%</td> 
                    <!--<td style="text-align: center;"  ><?php echo $totleave->leavedaydiff; ?></td> 
                    <td style="text-align: center;"  ><?php /* echo $totleave->leavehrdiff; */ echo $totleave->totalhours; ?></td> -->
                    
                    
                    <!--<td style="text-align: center;"><?php echo $sumLeaveDayDiff; ?></td>-->
                    
                    <td style="text-align: center;">
                    
                    <?php 
                    $days = $sumLeaveHrDiff/24;
                    echo number_format($days,2);
                    ?></td>
                    <td style="text-align: center;"><?php echo $sumLeaveHrDiff; ?></td>
                    <td style="text-align: center;"  >
                        
                    <?php 
                    
                    echo number_format($tott_leave->reporting_accuracy*100/$student_leavesession->totalhours,2);
                    ?>
                    
                    </td> 
                    <td style="text-align: center;"  ></td> 
                    </tr>
                    
                    
                <?php $count++; ?>
                
                </tbody>
            </table>
            &nbsp;
            
            <table style="border:1px solid;font-size: 9pt" >
            <tr style="height:40px"><td colspan="8" ><?php echo $tott_leave->reason; ?></td></tr>
            </table>
            
            </div>



        <div class="col-sm-12" style="margin-top: 3px;">
            <h5 class="text-center"><b>DECLARATION</b></h5>
        <p class="text-left" class="tdcls">I hereby declare that the aforesaid information is correct to my knowledge and bear the responsibility for the correctness of mentioned particular.</p>
        <div class="col-sm-8" style="margin-top: 3x;">
            </div>
            <div class="col-sm-4" style="margin-top: 3px;">
                <span style="text-align:right;">Name of Student: <?php echo $stulist->namest; ?>
                <br>
                Signature :
                </span>
            </div>
           &nbsp;
        <!--<p class="text-right">Name of Student :  <?php echo $stulist->namest; ?> </p>-->
        <!--<p class="text-left">Signature : </p>-->
        </div>
        <br>
        
        <div class="col-sm-12" style="margin-top: 7px;">
            
        <table style="font-size: 10pt; width:100%;" >
        <tr style="font-size: 10pt; ">
        <td class="text-left" style="width:60%;"><b>Verified By: </b></td>
        <td class="text-left" style="width:40%;"><b>Approved By: </b></td>
        </tr>
        
        
        <tr>
        <td class="text-left"  style="width:60%;">Class Teacher: <?php echo $classteacher->staffname; ?></td>
        <td class="text-left"  style="width:40%;">Academic Administrator </td>
        </tr>
        
        <tr>
        <td class="text-left"  style="width:60%;">Signature: </td>
        <td class="text-left"  style="width:40%;">Signature: </td>
        </tr>
        
        
        <tr>
        <td  colspan="2" style="text-align:right; padding-top:2px;" >
        <img src="<?php echo base_url();  ?>/<?php echo $stulist->barcode; ?>" width="200px" height="40px;" />
        </td>
        </tr>
        
        </table>
        </div> 
       
    </div>
</div>


</div>

</div>

 <div class="page-break"></div>
</section>
<div class="clearfix"></div>
<footer>
</footer>
</body>

</html>
