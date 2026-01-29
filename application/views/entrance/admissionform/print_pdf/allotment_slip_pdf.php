        <!DOCTYPE html>
        <html>
        <head>

        <!--<link href='https://fonts.googleapis.com/css?family=Noto Sans Malayalam' rel='stylesheet'>-->
        <style type="text/css">
        @media print {
        .pagebreak { page-break-before: always;
        } 
        }
        </style>
        <style>
        /*@page{padding: 0; margin:5px;}*/
        body
        {
        padding-top:2px; margin:2px 2px 3px 1px; font-family: Arial, Helvetica, sans-serif; color: #000; font-size: 12px; line-height: 10px;}
        .tableone{}
        .tableone td{border:1px solid #000; padding: 5px 0}
        .denifittable th{border-top: 1px solid #999;}
        .denifittable th,
        .denifittable td {border-bottom: 1px solid #999;
        border-collapse: collapse;border-left: 1px solid #999;}
        .denifittable tr th {padding: 4px 4px; font-weight: normal; font-size:12px; border:1px solid #000;}
        .denifittable tr td {padding: 4px 4px; font-weight: normal;font-size:12px; border:1px solid #000;}
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
        height:20px;
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

        .stylelist
        {
        list-style-type: circle;
        line-height: 35px;
        }
        </style>
        </head>


        <body>            
        <div class="tablemain"  style="height:900px;">
        <div class="submain">
        <div class="sub" style=" height:80px;">
        <p style="text-align:center;">

        <!-- <img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['header_image'];?>" width="90%" height="95px"> -->
        <img src="<?php echo FCPATH.'entrance/payment_code/'.$pdfimage['header_image']; ?>" width="580px" height="90px">


        </p>
        <hr style="border: none;  height: 1px;  color: #c1c2c2;  background-color: #c1c2c2; "></hr>
        </div>
        <br>
        <br>
        <br>
        <div class="sub" style=" height:10px;">
        <h2 style="text-align:center;">CENTRALIZED ALLOTMENT</h2>
        <h3  style="text-align:center;">ALLOTMENT SLIP</h3>
        </div>
        <div class="sub" style="padding-top:30px;">
        <div class="row">
        <table style="width:100%;" >
        <tr>
        <td style="width:50%; text-align:left;"></td>
        </tr>
        <tr><td >
        Slip No:<?php echo $allotmentstatus['entranceexam_allotment_id'];   ?></td><td style="text-align:right;">Date :<?php echo date('d-F-Y');  ?></td></tr>
        </table>

        <table  style="height:110px;   width:100%" class="denifittable">
        <tr>
        <td width="25%" class="first_td" style="text-align: left;padding:5px;">APPLICATION NO</td>
        <td class="third_td" style="text-align: left;"><b><?php echo $admissionlist['admission_application_no']; ?></b></td>
        </tr>
        <tr>
        <td width="25%" class="first_td" style="text-align: left;padding:5px;">APPLIED DATE & TIME</td>
        <td  class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_datetime']; ?></td>
        </tr>
        <tr>
        <td class="first_td" width="25%" style="text-align: left;padding:5px;">CANDIDATE NAME</td>
        <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_name']; ?></td>
        </tr>
        <tr>
        <td  class="first_td" width="25%" style="text-align: left;padding:5px;">DATE OF BIRTH</td>
        <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_dob']; ?></td>
        </tr>
        <tr>
        <td class="first_td" width="25%" style="text-align: left;padding:5px;">NAME OF FATHER</td>
        <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_fathername']; ?></td>
        </tr>
        <tr>
        <td class="first_td" width="25%" style="text-align: left;padding:5px;">ADDRESS</td>
        <td class="third_td" style="text-align: left;"><?php echo $admissionlist['admission_address']; ?></td>
        </tr>
        </table>
        </div>
        </div>
        <div class="sub" style=" height:50px; padding-top:30px;">
        <hr style="border: none;  height: 1px;  color: #c1c2c2;  background-color: #c1c2c2; "></hr>
        </div>

        <div class="sub">
        <div class="row">
        <?php
        if($allotmentstatus['entranceexam_insitutename']==$applicant['admission_institute_optionone'])
        {
        $status="1";
        }

        elseif ($allotmentstatus['entranceexam_insitutename']==$applicant['admission_institute_optiontwo'])
        {
        $status="2";  
        }

        elseif ($allotmentstatus['entranceexam_insitutename']==$applicant['admission_institute_optionththree'])
        {
        $status="3";  
        }
        ?> 

        <table  style="height:110px;   width:100%" class="denifittable">
        <tr>
        <td width="25%" class="first_td" style="text-align: left;padding:4px;">ALLOTED INSTITUTE </td>
        <td class="third_td" style="text-align: left;left;padding:4px;"><b><?php echo $allotmentstatus['entranceexam_insitutename'];  ?></b></td>
        </tr>

        <tr>
        <td width="25%" class="first_td" style="text-align: left;padding:4px;">ALLOTED COURSE</td>
        <td  class="third_td" style="text-align: left;left;padding:4px;"><?php echo $allotmentstatus['entranceexam_course_name'];  ?></td>
        </tr>
        <tr>
        <td class="first_td" width="25%" style="text-align: left;padding:4px;">OPTION NO</td>
        <td class="third_td" style="text-align: left;left;padding:4px;"><?php echo $status; ?></td>
        </tr>

        <tr>	
        <td  class="first_td" width="25%" style="text-align: left;padding:4px;">SEAT NO</td>
        <td class="third_td" style="text-align: left;left;padding:4px;"><?php echo $allotmentstatus['entranceexam_allotment_seatno']; ?></td>
        </tr>
        </table>
        </div>
        </div>


        <div class="sub"  style="height:110px; width:100%; position: absolute;bottom: 40px;  ">
        <div class="row">
        <table style="height:110px; width:100%;" >
        <tr>
        <td style="width:50%; text-align:left;"><img src="<?php echo $alloted_details['admission_qrcode']; ?>" height="80px; width:80px;"/></td>
        <td style="width:50%;  text-align:right;"><img src="<?php echo $alloted_details['entranceexam_allotment_barcode']; ?>" height="60px; width:300px;" title="abcd"/></td>
        </tr>
        <tr><td colspan="2" style="text-align:center;"> Please Read the instructions Carefully On the Next Page</td></tr>
        </table>

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
        <div class="sub">
        <div class="row">
        <?php  echo $instruction['set_allotment_instruction'];  ?>
        </div>
        </div>
        </div>
        </div>

        </body>
        </html>





