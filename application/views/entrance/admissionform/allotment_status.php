
        
        <style type="text/css">
        
        
        .tableclas
        {
        border: 1px black solid; 
        }
        
        .btnStack
        {
        font-family: Oswald;
        background-color: orange;
        color: white;
        text-decoration: none;
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.428571429;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
        }
        
        a.btnStack:hover {
        background-color: #000;
        }
        </style>
        
         <div class="col-md-12" >
        <label style="background-color:#00C3CB; color:white; text-align:center;"  class="form-control" >Allotment Status</label>
        </div>
        <br>
        <br>
                
            <div class="container-xxl py-5"> 
            <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            
            </div>
            <div class="col-md-6" style="height:auto; float:none;margin:auto;">
                
            <!--<div class="wow fadeInUp" data-wow-delay="0.2s">-->
            <!-- <label style="background-color:#47519a; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" >Allotment Status</label>  -->
            <!-- </div>-->
             <br>
             <?php
             if(!empty($allotmentstatus))
             {
             ?>
            
            <table style="width:100%; " class="tableclas" >
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; width:50%;" >Application No</td>
            <td  class="tableclas" style="padding-left:4px;  width:50%;"><?php echo $allotmentstatus['admission_application_no'];  ?></td>
            
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; width:50%; ">Name</td>
            <td  class="tableclas" style="padding-left:4px; width:50%;"><?php echo $allotmentstatus['admission_name'];  ?></td>
           
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; width:50%;">Mobile</td>
            <td  class="tableclas" style="padding-left:4px; width:50%;"><?php echo $allotmentstatus['admission_mobile'];  ?></td>
            </tr>
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; width:50%;">Father Name</td>
            <td  class="tableclas" style="padding-left:4px; width:50%;"><?php echo $allotmentstatus['admission_fathername'];  ?></td>
            </tr>
            </table>
            <p>
            <h3 style="color:green; text-align:center;">Congratulation!<br>
            You Got Allotment
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
            </h3>
            <h6 style="text-align:center;">You are  got allotment for your option No&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $status; ?></h6>
            
            </p>
            
            
            <br>
            <p  style="width:100%;"><b>Alloted Institute :</b><?php echo $allotmentstatus['entranceexam_insitutename'];  ?></p>
            <p  style="width:100%;"><b>Alloted Course:</b><?php echo $allotmentstatus['entranceexam_course_name'];  ?></p>
            
            
            <!--<p  style="width:100%;"><b><a href="<?php  echo site_url('entrance/Home');  ?>" class="btnStack">Print Slip</a></p>-->
            
            
            <?php 
            }  
            else
            { 
            ?>
            
            
            <table style="width:100%; " class="tableclas" >
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; width:50%;" >Application No</td>
            <td  class="tableclas" style="padding-left:4px;  width:50%;"><?php echo $applicant['admission_application_no'];  ?></td>
            
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; width:50%; ">Name</td>
            <td  class="tableclas" style="padding-left:4px; width:50%;"><?php echo $applicant['admission_name'];  ?></td>
           
            </tr>
            
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; width:50%;">Mobile</td>
            <td  class="tableclas" style="padding-left:4px; width:50%;"><?php echo $applicant['admission_mobile'];  ?></td>

            </tr>
            
            <tr  class="tableclas">
            <td  class="tableclas" style="padding-left:4px; width:50%;">Father Name</td>
            <td  class="tableclas" style="padding-left:4px; width:50%;"><?php echo $applicant['admission_fathername'];  ?></td>

            </tr>
            </table>
            
            
             <p ><h4 style="color:red; text-align:center;">Sorry !
             <br>Better Luck Next Time
             </h4>
            </p>
            <?php } ?>
            
            
             <div style="width:100%;">
             <div class="wow fadeInUp" data-wow-delay="0.2s" style="text-align:right;">
             <a href="<?php  echo site_url('entrance/home/allotment_slip'); ?>" target="_blank" class="btn btn-success"   >Download Slip</a>
             </div>
             </div>
             <br>
             <br>
             
             
             
            </div>
            </div>
        </div>
        </div>
        
