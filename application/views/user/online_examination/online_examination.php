            
            <style>    
            font-size:20px !important;
            </style>
            <style type="text/css">
            .tableone td{border:1px solid #000; padding:3px 0}
            .denifittable th{}
            .denifittable th,
            .denifittable td {border: 1px solid #000;
            border-collapse: collapse;border-left: 1px solid #999;}
            
            /*.denifittable tr th {padding: 10px 0px; font-weight: normal;}
            
            .denifittable tr td {padding: 10px 0px; font-weight: normal; font-size: 12px}
            */
            
            .denifittable tr th {padding: 8px 0px;  font-size: 12px}
            
            .denifittable tr td {padding: 8px 0px; font-weight: normal; font-size: 12px}
            
            
            
            .tcmybg {
            background:top center;
            background-size: 100% 100%;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1;
            width: 100%;height: 100%;
            }
            
            .tablemain1
            {
            position: relative;
            z-index: 1;
            /*border:1px solid #000; */
            padding: 3px;
            min-height: 940px;
            
            }
            
            
            .trstyle
            {
            height:3mm;
            } 
            
            
            
            .tdstylelabel
            {
            width:45%;
            padding-left: 12px;
            font-size:14px;
            
            }
            
            
            .tdstyledot
            {
            width:5%;
            text-transform: uppercase;
            }
            
            .tdstyle
            {
            width:50%; 
            font-size:14px;
            
            }
            
            
            .headerclass
            {
            
            text-align: center;
            font-weight:bold ;
            }
            
            </style>
            
            
            
            <div class="content-wrapper" style="min-height: 946px;">
            <section class="content-header">
            <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('examinations'); ?> <small></small>  </h1>
            </section>
            <!-- Main content -->
            <section class="content">
            <div class="row">
            <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('onlineExamination'); ?></h3>
            </div>
            <div class="box-body"> 
            
            
            <form role="form" action="<?php echo site_url('user/user/onlineExamination') ?>" method="post" class="row">                 
            
            <?php echo $this->customlib->getCSRF(); ?>
            
            <div class="col-sm-6 col-lg-4 col-md-4">
            <div class="form-group">
            <label ><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
            <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control" >
            
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            
            <?php
            foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
            ?>
            <option value="<?php echo $ex_group_value->id ?>" <?php
            if (set_value('exam_group_id') == $ex_group_value->id) {
            echo "selected=selected";
            }
            ?>><?php echo $ex_group_value->name; ?></option>
            <?php
            }
            ?>
            </select>
            
            
            <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
            </div>  
            </div>
            
            
            
            
            <div class="col-sm-6 col-lg-4 col-md-4">
            <div class="form-group">  
            <label><?php echo $this->lang->line('exam'); ?><small class="req"> *</small></label>
            <select  id="exam_id" name="exam_id" class="form-control" onchange="getsubjectid()" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>  
            </div>
            
            
            <div class="col-sm-12">
            <div class="form-group">
            <button type="submit"  onclick="return checkvalue();" name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
            </div>
            </div>
            
            </form> 
            </div>
            
            <div  class="" >
            <div class="box-header ptbnull"></div> 
            <div class="box-header ptbnull">
            <h3 class="box-title titlefix"><i class="fa fa-users"></i>
            </h3>
            
            
            </div>
            <div class="box-body">                                  
            
            <div style="width:100%;" id="">
            
            <div id="mod">
            
            <style>    
            font-size:20px !important;
            </style>
            
            <style type="text/css">
            .tableone td{border:1px solid #000; padding:3px 0}
            .denifittable th{}
            .denifittable th,
            .denifittable td {border: 1px solid #000;
            border-collapse: collapse;border-left: 1px solid #999;}
            
            /*.denifittable tr th {padding: 10px 0px; font-weight: normal;}
            
            .denifittable tr td {padding: 10px 0px; font-weight: normal; font-size: 12px}
            */
            
            .denifittable tr th {padding: 8px 0px;  font-size: 12px}
            
            .denifittable tr td {padding: 8px 0px; font-weight: normal; font-size: 12px}
            
            
            
            .tcmybg {
            background:top center;
            background-size: 100% 100%;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1;
            width: 100%;height: 100%;
            }
            
            .tablemain1
            {
            position: relative;
            z-index: 1;
            /*border:1px solid #000; */
            padding: 3px;
            min-height: 940px;
            
            }
            
            
            .trstyle
            {
            height:3mm;
            } 
            
            
            
            .tdstylelabel
            {
            width:45%;
            padding-left: 12px;
            font-size:14px;
            
            }
            
            
            .tdstyledot
            {
            width:5%;
            text-transform: uppercase;
            }
            
            .tdstyle
            {
            width:50%; 
            font-size:14px;
            
            }
            
            
            .headerclass
            {
            
            text-align: center;
            font-weight:bold ;
            }
            
            </style>
            
            <div id="instruction">
            <?php
            $studid=$online_exam_accept['online_examination_student_id'];
            $groupid=$online_exam_accept['online_examination_examgroup'];
            $exambatchid=$online_exam_accept['online_examination_exam'];
            if (!empty($instruction))
            {
            if(empty($feepayment))
            {
            ?>
            <table>
            
            <?php
            $online_examination_subject=array();       
            ?>    
            
            </table>
            
            
            <input type="hidden" id="studid" name="studid" value="<?php echo $studid; ?>">
            <br>
            <br>
            <p style="font-size:16px"><b><?php echo $instruction['online_examination_heading'];  ?>:</b></p>
            <span class="styleclass"><?php echo $instruction['online_examination_last_date_fee_withoutfine'];  ?><br>
            <?php echo $instruction['online_examination_last_date_fee_withfine'];  ?><br>
            <?php echo $instruction['online_examination_class_leave_for_studying'];  ?><br>
            <?php echo $instruction['online_examination_Examcommencement'];  ?><br>
            
            <p><?php echo $instruction['online_examination_fee_details'];  ?></p>
            <p><?php echo $instruction['online_examination_mode_of_payment'];  ?></p>
            
            <br>
            <br>
            
            
            
                <?php
                $totalhalf=$getstudent_halfdays/2;
                $totalpresent=$getstudent_presentdays+$getstudent_latedays+$totalhalf; 
             
                $count1=$totalpresent/$getstudent_workingdays;
                $count2=$count1*100;
           
                
                //echo number_format((float)$count2, 2, '.', '');
                
                if($count2>=$attendence_settings['online_examination_attendencepercentage'])
                
                {
                //$eligiblestatus="Eligible";
                ?>
                
                <input type="checkbox" id="checkterms"   name="declartion" required="required" style="background:#000; color:#fff;" >
                <span class="styleclass"><?php echo $instruction['online_examination_declaration'];  ?></span>
                <br>
                <br>
                <input type="button" name="submit" value="PROCEED" class="btn btn-default" onclick="proceedtonext()">
                <?php
                }
                else
                {
                $eligiblestatus=$attendence_settings['online_examination_ineligible_msg'];
                }
                echo  $eligiblestatus;
                ?>
                
                
            <?php 
            }
            else
            {
            ?>
            <p>
            <?php echo $instruction['online_examination_remarksafterpayment'];  ?>
            </p>
            <a href="<?php echo site_url();?>user/user/confirmView/<?php echo  $groupid.'/'. $exambatchid  ?>" class="btn btn-primary" />View  Details</a>
            <?php
            }
            }
            ?>
            </div>
            
            
            
            <div id="proceedwithsubject">
            
            <?php
            
            if (!empty($instruction))
            {
            ?>
            <span style="font-weight:bold;"></b>Apply Subject  For Examination :<b></span>
            <br>
            
            </b>
            <form name="m" method="POST" action="<?php echo site_url('user/user/add_dat_ex'); ?>">
            
            <table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
            <thead>
            
            <tr>
            <th rowspan="2" class="" style="padding-left:10px;" ><input type="checkbox" onclick="toggle(this);" /></th>
            <th  class="headerclass" >Sl.No</th>
            
            <th  class="headerclass" colspan="2" ><b>Course Code</b></th>
            <th  class="headerclass"  ><b>Subjects</b></th>
            </tr>
            </thead>
            
            
            
            
            <?php
            
            $online_examination_subject=array();                                   
            $total_max_marks = 0;
            $total_obtain_marks = 0;
            $total_points = 0;
            $total_hours = 0;
            $total_quality_point = 0;
            $grandtotal=0;
            $obtainedtotal=0;
            $maxtotal=0;
            $grandmaxtotal=0;
            $singlepercentage=0;
            $grandobtainedtotal=0;
            $percentage=0;
            $perc=0;                                    
            $total_min_marks=0;
            
            $clas="";
            $res="";
            $fgde="";
            
            $mincmarks=0;
            $minmarks=0;
            $get_cmarks=0;
            $get_marks=0;
            $array_push=array();
            $sl=1;
            
            
            
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
            <td class="styleclass" style="padding-left:10px;">
            
            <input class="checkbox" type="checkbox" <?php echo $checked; ?>   name="check[]" value="<?php echo $sub['subjectid']; ?>">
            
            <?php// echo $sub['subjectid']; ?>
            
            
            <input type="hidden" value="<?php echo $sub['subjectid']; ?>" name="subjectid[]"/>
            <input type="hidden" name="examgroup[]" value="<?php echo $sub['grpidd']; ?>">
            <input type="hidden" name="examgroupbatch[]" value="<?php echo $sub['grpid']; ?>">
            
            <input type="hidden" id="class_id" name="class_id[]" value="<?php echo $sub['class_id']; ?>">
            <input type="hidden"  id="section_id" name="section_id[]" value="<?php echo $sub['section_id']; ?>">
            
            
            
            <input type="hidden" id="groupid" name="examgroupp" value="<?php echo $sub['grpidd']; ?>">
            <input type="hidden"  id="exambatchid" name="examgroupbatchh" value="<?php echo $sub['grpid']; ?>">
            
            <input type="hidden" id="class_id" name="class_idd" value="<?php echo $sub['class_id']; ?>">
            <input type="hidden"  id="section_id" name="section_idd" value="<?php echo $sub['section_id']; ?>">
            </td>
            <td>
            <?php   echo $sl; ?>
            
            </td>
            
            <td>
            <?php
            $su=explode('-',$sub['subcode']); 
            echo $su[0];
            ?>                
            </td> 
            
            
            <td>
            <?php
            $su=explode('-',$sub['subcode']); 
            echo $su[1];
            ?>                
            </td> 
            
            
            <td class="styleclass">
            <input type="hidden" name="subcode[]" value="<?php echo  $su[1]; ?>">
            <?php  echo $sub['subject']; ?>
            </td>
            
            
            </tr>
            <?php 
            $sl++;
            }
            ?>
            
            </table>
            <br>
            
            
            <span>
            
            <?php
            if( $online_exam_accept['online_examination_subject_status']=="")
            {
            ?> 
            <input type="checkbox" required="required" name="proccedpayementcheck" id="proccedpayementcheck" >
            By clicking Proceed to Payment you are agreeing to the <a  style="display: inline-block;height: 15px;" target="_blank" href="https://iritaq.info/termsandcondition.html">Terms and Conditions</a> and declare that the particulars given above are correct to the best of my knowledge.</span>
            <?php }?>
            
            <br>
            <br>
            <?php
            $studid     =$online_exam_accept['online_examination_student_id'];
            $groupid    =$online_exam_accept['online_examination_examgroup'];
            $exambatchid=$online_exam_accept['online_examination_exam'];
            ?>
            <input type="hidden" id="studid" name="studid" value="<?php echo $studid; ?>">
            
            <input type="submit" name="submit" id="savebtn" value="SUBMIT & PROCEED" class="btn btn-default" >
            
            </form>
            
            
            
            
            
            
            
            <?php 
            } 
            else
            {
            
            
            echo "<table width='100%'><tr><td style='text-align:center; font-size:15px; color:#d83939;'>No  Exam Found</td></tr></table>";
            
            }
            
            
            ?>
            </div>
            
            </div> 
            
            </div>                                                         
            </div>
            
            
            </div>
            
            
            <?php
            //}
            ?>
            </div>
            
            </div>
            
            </section>
            </div>
            
            
            
            <script type="text/javascript">
            
            
            var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
            var class_id = '<?php echo set_value('class_id') ?>';
            var section_id = '<?php echo set_value('section_id') ?>';
            var session_id = '<?php echo set_value('session_id') ?>';
            var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
            var exam_id = '<?php echo set_value('exam_id') ?>';
            getSectionByClass(class_id, section_id);
            getExamByExamgroup(exam_group_id, exam_id);
            
            $(document).on('change', '#exam_group_id', function (e)
            {
            
            // $('#mod').hide();
            
            
            
            $('#exam_id').html("");
            var exam_group_id = $(this).val();
            getExamByExamgroup(exam_group_id, 0);
            });
            
            $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            getSectionByClass(class_id, 0);
            });
            
            
            
            function getSectionByClass(class_id, section_id)
            {
            
            
            
            if (class_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            //var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            
            $.ajax({
            type: "GET",
            url: base_url + "user/user/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            beforeSend: function () {
            $('#section_id').addClass('dropdownloading');
            },
            success: function (data) {
            $.each(data, function (i, obj)
            {
            var sel = "";
            if (section_id == obj.section_id) {
            sel = "selected";
            }
            div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
            });
            $('#section_id').append(div_data);
            },
            complete: function () {
            $('#section_id').removeClass('dropdownloading');
            }
            });
            }
            } 
            
            
            
            
            
            function getExamByExamgroup(exam_group_id, exam_id) 
            { 
            
            if (exam_group_id != "")
            {
            $('#exam_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            
            $.ajax({
            type: "POST",
            url: base_url + "user/user/getExamByExamgroup",
            data: {'exam_group_id': exam_group_id},
            dataType: "json",
            beforeSend: function () {
            $('#exam_id').addClass('dropdownloading');
            },
            success: function (data) {
            $.each(data, function (i, obj)
            {
            var sel = "";
            if (exam_id == obj.id) {
            sel = "selected";
            }
            div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
            });
            $('#exam_id').append(div_data);
            },
            complete: function () {
            $('#exam_id').removeClass('dropdownloading');
            }
            });
            }
            }
            
            </script>
            
            
            
            <script>
            $(document).ready(function()
            {
            $("#instruction").show();
            $("#proceedwithsubject").hide();
            });
            function btnViewExamDetails()
            {
            $("#instruction").hide();
            $("#proceedwithsubject").show();
            }
            function proceedtonext()
            {
            var checkterms = document.getElementById("checkterms");
            if (checkterms.checked) 
            {
            $("#instruction").hide();
            $("#proceedwithsubject").show();
            } 
            else
            {
            alert('Please agree our terms and condition');
            }
            } 
            
            
            
            
            
            
            
            
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
            
            
            
            function toggle(source)
            {
            var checkboxes = document.querySelectorAll('input[class="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
            }
            }
            
            </script>