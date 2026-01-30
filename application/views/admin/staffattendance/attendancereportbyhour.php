<style type="text/css">
@media print
{
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>



<div class="content-wrapper" style="min-height: 946px;">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-sitemap"></i> <?php echo $this->lang->line('human_resource'); ?></h1>
</section>


<section class="content">
    <?php $this->load->view('reports/_attendance'); ?>
    <div class="row">   
        <div class="col-md-12">
            <div class="box removeboxmius">
                <div class="box-header ptbnull"></div>
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                </div>
                <form id='form1' action="<?php echo site_url('admin/staffattendance/attendancereportbyhour') ?>"  method="post" accept-charset="utf-8">
                    <div class="box-body">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('role'); ?></label>
                                    <select  id="role" name="role" class="form-control" >
                                        <option value="select"><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($role as $role_key => $value) {
                                            ?>
                                            <option value="<?php echo $value["type"] ?>" <?php
                                            if ($role_selected == $value["type"]) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $value["type"]; ?></option>
                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('role'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('month'); ?></label><small class="req"> *</small>
                                    <select  id="month" name="month" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($monthlist as $m_key => $month) {
                                            ?>
                                            <option value="<?php echo $m_key ?>" <?php
                                            if ($month_selected == $m_key) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $month; ?></option>
                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('month'); ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('year'); ?></label>
                                    <select  id="year" name="year" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php
                                        foreach ($yearlist as $y_key => $year) {
                                            ?>
                                            <option value="<?php echo $year["year"] ?>" <?php
                                            if ($year["year"] == date("Y")) {
                                                echo "selected";
                                            }
                                            ?> ><?php echo $year["year"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('year'); ?></span>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group"> 

               <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>

                                </div>  
                            </div>   
                        </div>
                    </div>

                </form>

                <?php
                if (isset($resultlist)) {
                    ?>
                    <div class="" id="attendencelist">
                        <div class="box-header ptbnull"></div>
                        <div class="box-header with-border" >
                            <div class="row">


                                <div class="col-md-4 col-sm-4">
                                    <h3 class="box-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('staff'); ?> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('report'); ?></h3>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <div class="pull-right">
                                        <?php
                                        foreach ($attendencetypeslist as $key_type) 
                                        {

                                            
                                            
                                         ?>
                                            &nbsp;&nbsp;
                                            <b>
                                                <?php
                                                
                                                echo $key_type['type'];
                                                
                                                ?>
                                            </b>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive">


                            <?php
                            if (!empty($resultlist)) {
                                ?>
                                <div class="mailbox-controls">
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <div class="download_label"><?php echo $this->lang->line('staff'); ?> <?php echo $this->lang->line('attendance'); ?> <?php echo $this->lang->line('report') ?></div>  <div> <?php echo 
                        $this->customlib->get_postmessage();
                                ?></div>
                                <table class="table table-striped table-bordered table-hover example xyz">
                                    <thead>
                                        <tr>
                                            <th>
    <?php echo $this->lang->line('staff'); ?> / <?php echo $this->lang->line('date'); ?>
                                            </th>
                                     

                                            <?php
                                            
                                                foreach ($leavetypes_result as $leavetype_result ) {
                                                    ?>
                                                    <th colspan="" ><br/>

                                                        <span data-toggle="tooltip" title="<?php echo $key['type']; ?>">
                                                            <?php echo $leavetype_result['type']; ?>

                                                        </span>

                                                        <?php
                                                
                                                
                                                
                                                ?>

                                                    </th>

                                                    <?php
                                                }
                                            
                                       



                                            
                                            
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($student_array)) {
                                            ?>
                                            <tr>
                                                <td colspan="32" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                            </tr>
                                            <?php
                                        } else {
                                            $row_count = 1;
                                            $i = 0;
                                            foreach ($student_array as $student_key => $student_value)
                                             {                                        



                                                ?>
                                                <tr>

                                <th class="tdclsname"><span data-toggle="popover" class="detail_popover" data-original-title="" title=""><a href="#" style="color:#333"><?php echo $student_value['name'] . " " . $student_value['surname']; ?></a></span>
                                    <div class="fee_detail_popover" style="display: none">
                                        <?php echo $this->lang->line('staff_id'); ?>: <?php echo $student_value['employee_id']; ?></div>
                                </th>                              
                                

                               <?php

                            




////echo $numberatt_date;
            //echo $att_date;


                           
                               
                                foreach ($leavetypes_result as $leavetype_result)
                                { 



								

                $query = $this->db->query("SELECT slr.leave_type_id,slr.leave_from,slr.leave_to, 
                slr.leave_fromtime, slr.leave_totime FROM staff_leave_request slr 
                WHERE slr.status = 'approve' AND slr.staff_id =". $student_value['id'] ." AND slr.leave_type_id =". $leavetype_result['id']." AND  slr.leave_from >=   " . $this->db->escape($att_date) . "  AND slr.leave_to <= " . $this->db->escape($numberatt_date) . " "); 



            

                                $leave_results=  $query->result_array();

                                $leave_from_day = '';
                                $leave_to_day = '';
                                $hours_difference = 0;


                                            foreach ($leave_results as $leave_result) {
                                   

                                            $leave_from_day = date_format(date_create($leave_result['leave_from'].$leave_result['leave_fromtime']),"Y-m-d H:i");
                                            $leave_to_day = date_format(date_create($leave_result['leave_to'].$leave_result['leave_totime']),"Y-m-d H:i");
                                            $differences = differenceInHours($leave_from_day,$leave_to_day);
                                            $hours_difference = $hours_difference + $differences;
                                            }

                                            if($hours_difference) 
                                            {
                                            echo '<td>' . $hours_difference . ' hours</td>';
                                            } 
                                            else
                                            {
                                            echo '<td></td>';
                                            }



                               


                                }



?>

                                




                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-info">
                                <?php echo $this->lang->line('no_attendance_prepare'); ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }



                function differenceInHours($startdate,$enddate){
    $starttimestamp = strtotime($startdate);
    $endtimestamp = strtotime($enddate);
    $difference = abs($endtimestamp - $starttimestamp)/3600;
    return $difference;
}
                ?>
            </div><!--./box box-primary-->
        </div>
    </div>
</section>
</div>


<script type="text/javascript">
var base_url = '<?php echo base_url() ?>';
function printDiv(elem) {
    Popup(jQuery(elem).html());
}
function Popup(data)
{
    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({"position": "absolute", "top": "-1000000px"});
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
    frameDoc.document.open();
    //Create a new HTML document.
    frameDoc.document.write('<html>');
    frameDoc.document.write('<head>');
    frameDoc.document.write('<title></title>');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
    frameDoc.document.write('</head>');
    frameDoc.document.write('<body>');
    frameDoc.document.write(data);
    frameDoc.document.write('</body>');
    frameDoc.document.write('</html>');
    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
    }, 500);


    return true;
}
</script>