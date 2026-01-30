            <!DOCTYPE html>
            <html>
            <head>
            <style type="text/css">
            @media print {
            .pagebreak { page-break-before: always; } 
            }
            </style>
            <style>
            body
            {
            padding-top:2px; margin:2px 2px 3px 1px; font-family: arial; color: #000; font-size: 12px; line-height: 10px;}
            .tableone{}
            .tableone td{border:1px solid #000; padding: 5px 0}
            
            .denifittable th{border-top: 1px solid #999;}
            .denifittable th,
            .denifittable td {border-bottom: 1px solid #999;
            
            border-collapse: collapse;border-left: 1px solid #999;}
            .denifittable tr th {padding: 4px 4px; font-weight: normal; font-size:12px;}
            .denifittable tr td {padding: 4px 4px; font-weight: normal;font-size:12px;}
            
            
            .tcmybg {
            background:top center;
            position: fixed;
            top: 10%;
            left: 20%;
            bottom: 0;
            z-index: -9999;
            opacity:0.15;
            text-align:center;
            
            }
            
            .tablemain{position: relative;z-index: 1;border:1px solid #000; padding: 20px;height:auto;}
            
            *{
            box-sizing: border-box;
            
            }
            
            .tableclas
            {
            border: 1px black solid; 
            width:50%;
            line-height:3px;
            }
            
            .row {
            margin-left:-5px;
            margin-right:-5px;
            }
            
            .column {
            float: left;
            width: 75%;
            padding: 5px;
            }
            
            
            
            .columnn {
            float: left;
            width: 75%;
            padding: 5px;
            }
            
            
            
            .column_inst {
            float: left;
            width: 50%;
            padding: 5px;
            }
            
            .column_tag
            {
            float: left;
            width: 70%;
            padding: 5px;  
            }
            
            /* Clearfix (clear floats) */
            .row::after {
            content: "";
            clear: both;
            display: table;
            }
            
            table
            {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            /*border: 1px solid #ddd;*/
            }
            
            th, td {
            text-align: left;
            padding: 10px;
            line-height:normal;
            }
            
            tr:nth-child(even) {
            /*background-color: #f2f2f2;*/
            }
            
            .first_td
            {
            width:40px;
            line-height:2px;
            padding-left:5px;
            font-size:12px;
            }
            
            .third_td
            {
            width:60px;
            }
            
            .sub
            {
            width:100%;
            height:auto;
            
            }
            
            hr.hrcls
            {
            border-top: 1px solid #8c8b8b;
            }
            
          
            
            </style>
            </head>
            <body>
        
            <div class="tablemain">
                
            <div class="submain">
            <div class="sub" style=" height:80px;">
            <p style="text-align:center;">
                
            <!-- <img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['header_image'];?>" width="80%" height="80px"> -->
        
             <img src="<?php echo FCPATH.'entrance/payment_code/'.$pdfimage['header_image']; ?>" width="580" height="90">
        </p>
            
            <hr style="	border: 1px solid #c1c2c2;"></hr>
            </div>
            
            
            <div class="sub" style=" height:10px;">
                <br>
            <h4 style="text-align:center;">ADMIT CARD</h4>
            <!--<h4  style="text-align:center;">ENTRANCE EXAMINATION 2023-24</h4>-->
            
            <h4  style="text-align:center;"><?php echo $admit_title; ?></h4>
            
            </div>
            <br>
            <br>
            
            <div class="sub"  >
            <div class="row">
            <div class="column">
                   
                
                <table style="border:1px solid;" border="1" style="height:110px;   width:750px" class="denifittable">
                     
                <tr>
                <td width="25%" class="first_td" style="text-align: left;padding:4px;">APPLICATION NO</td>
                <td class="third_td" style="text-align: left;"><b><?php echo $admissionlist['admission_application_no']; ?></b></td>
                </tr>
                <!--<tr>-->
                <!--    <td width="25%" class="first_td" style="text-align: left;padding:4px;">APPLIED DATE & TIME</td>-->
                <!--    <td  class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_datetime']; ?></td>-->
                <!--</tr>-->
                <tr>
                    <td class="first_td" width="25%" style="text-align: left;padding:4px;">CANDIDATE NAME</td>
                    <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_name']; ?>&nbsp;</td>
                </tr>
                <tr>
                    <td  class="first_td" width="25%" style="text-align: left;padding:4px;">DATE OF BIRTH</td>
                    <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_dob']; ?>&nbsp;</td>
                </tr>
                 <tr>
                    <td class="first_td" width="25%" style="text-align: left;padding:4px;">NAME OF FATHER</td>
                    <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_fathername']; ?>&nbsp;</td>
                </tr>
                <tr>
                    <td class="first_td" width="25%" style="text-align: left;padding:4px;">ADDRESS</td>
                    <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_address']; ?>&nbsp;</td>
                </tr>
                 <tr>
                    <td  class="first_td" width="25%" style="text-align: left;padding:4px;">APPLIED COURSE</td>
                    <td class="third_td" style="text-align: left;"><b><?php echo $admissionlist['entranceexam_course_name']; ?>&nbsp;</b></td>
                </tr>
                <tr>
                    <td  class="first_td" width="25%" style="text-align: left;padding:4px;">EXAM CENTER</td>
                    <td class="third_td" style="text-align: left;"><b><?php echo $admissionlist['admission_institute_examcenter']; ?>&nbsp;</b></td>
                </tr>
            </table>
            </div>
            
            <div class="columnn">
                <br>
            
            <table class="">
            <tr>
            <td style="text-align:left">
                
                
             <?php
                                
            if (empty($admission["admission_photo"]))
            {
            $image = FCPATH . "entrance/payment_code/default_male.jpg";
            } else {
            $image = FCPATH . "entrance/admissionphoto/".$admission['admission_photo'];
            }
            ?>
                                                
                
            <img src="<?php echo  $image; ?>" style="height:120px; width:100px; margin-top:2px;" >
            <br>
            <img src="<?php echo FCPATH. $admission['admission_qrcode'];?>" class="content-img" alt="<?php echo $admission['admission_qrcode'];?>"  style="height:100px; width:100px; margin-top:2px;" > 
        
        
        </td>
            </tr>
            </table>
            </div>
            </div>
            </div>
            
            
            
            
                <div class="sub">
                <div class="row">
                <h4 class="text-left"><b>Examination Details: </b></h4>
                <table style="border:1px solid;" border="1" style="height:80px;  width:100%;" class="denifittable">
                 <!-- <img src="<?php echo base_url('entrance/payment_code/backgroundadmitcard.jpg'); ?>" class="tcmybg" width="40%" height="30%" style="padding:80px 20px 20px 20px;" />   -->
                
                <img src="<?php echo FCPATH . 'entrance/payment_code/backgroundadmitcard.jpg'; ?>" class="tcmybg" width="40%" height="30%" style="padding:80px 20px 20px 20px;" />

                 <tr>
                <th style="text-align: center;"><b>SL. NO</b></th>
                <th style="text-align: center;"><b>DATE & TIME</b></th>
                <th style="text-align: center;"><b>DESCRIPTION</b></th>
                <th style="text-align: center;"><b>SIGN OF INVIGILATOR</b></th>
                </tr>
                <?php
                $count=1;
                foreach ($examdetails as $exdetails) { ?>    
                <tr>
                <td style="text-align: center;"><?php echo $count++; ?></td>
                <td style="text-align: center;"><?php echo $exdetails['entrance_admitcarddate_time']; ?></td>
                <td style="text-align: center;"><?php echo $exdetails['entrance_admitcarddescription']; ?></td>
                <td></td>
                </tr>
                <?php
                }
                $count++;
                ?>
                </table>
                </div>
                </div>
                
               
               
                
                     <div class="sub">
                     <div class="row">
                        <br>
                     <h5 class="text-left" ><b>Signature of the Candidate...................................</b></h5>
                     <h5 class="text-left" ><b>(To be signed in the Presence of Identifying Officer)</b></h5>
                   
                     </div>
                     </div>
                     
                     
                
                            <div class="sub" style="margin-top:3px;">
                            <div class="row">
                            <div class="column_tag">
                            <span>Mundkkulam, Muthuparamba Post<br>
                            Kondotty, Malappuram, Kerala, 673 638<br>
                            <!--www.shamsululama.org<br>-->
                            <!--smichrd@gmail.com</span>-->
                            
                            
                            www.jamiajalaliyya.com<br>
                           jamiajalaliyya@gmail.com</span>
                            
                            </div>
                            
                            <div class="column_tag" >
                          <!-- <img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['admicard_sign'];?>" style="width:150px; height:30px; opacity:3.0"> -->
                        
        
<?php
// Full server path using FCPATH
$imagePath = FCPATH . 'entrance/payment_code/' . $pdfimage['admicard_sign'];
?>
<img src="<?php echo $imagePath; ?>" style="width:150px; height:30px; opacity:1;" alt="Admin Card Sign">

                        
                        
                          <br>
                        
                            <h4 class="text-right"><b>Controller of Examinations</b></h4>
                            <h5 class="text-right"><b>JAMIA JALALIYYA MUNDKKULAM</b></h5>
                            </div>
                            </div>
                            </div>
                            
                            <div class="sub">
                            <div class="row">
                            <h4 style="text-align:center;"><b>*** COMMUNICATION DEVICES ARE STRICTLY PROHIBITED INSIDE EXAMINATION HALL ***</b></h4>
                          
                            
                             </div>
                            </div>
                          
                            
                            
                            <div class="sub">
                            <div class="row">
                                
                            <div class="column_inst" >
                            <div  style="border:1px solid;text-align: center;height:10px; padding: 6px 0px 6px 0px">
                           Please read the instructions of examination at back side
                            </div>
                            </div>
                            
                            <div class="column_inst">
                            </div>
                            </div>
                            </div> 
            
            </div> 
             </div>           
            
            <div class="pagebreak"></div>
            
            <br>
            <br>
              <br>
            <br>      
          
         
                
                <div class="" style="padding-top:20px;" >
                
                
                <div class="submain">
               <!-- <div class="sub">
                <div class="row">
                <img src="<?php echo base_url('entrance/payment_code/admitcard_instruction.png'); ?>"  width="700px" height="400px" /> 
                </div>
                </div>-->
                
                
                
                            <div class="sub">
                            <div class="row">
                            <div class="column_inst" >
                            <img src="<?php echo FCPATH . 'entrance/payment_code/malayalam.png'; ?>"   /> 
                            </div>
                            
                            <div class="column_inst">
                                
                            <img src="<?php echo FCPATH . 'entrance/payment_code/instruction.png'; ?>"   /> 
                            </div>
                            </div>
                            </div>
                           
                </div>
                </div>
               
                
                
                
            
            </body>
            
            </html>
            
            
            
            
            
