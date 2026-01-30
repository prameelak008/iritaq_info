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
        <h1>
            <i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('attendance'); ?> <small> <?php echo $this->lang->line('by_date1'); ?></small>        </h1>
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
                    <form id='form1' action="<?php echo site_url('report/daily_staffattendance_report') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label><span class="req"> *</span>
                                        <input type="text" name="date" value="<?php echo set_value('date', $date); ?>" class="form-control date">

                                        <span class="text-danger"><?php echo form_error('date'); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('role'); ?></label><span class="req"> *</span>
                                        <select name="role" required class="form-control" >

                                            <?php
                                            foreach($roles as $rol) {
                                            ?>

                                                <option value="<?php  echo $rol['id']; ?>"><?php  echo $rol['name']; ?></option>
                                        <?php } ?>
                                        

                                        </select>                                       
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('type'); ?></label><span class="req"> *</span>
                                        <select name="absenttype" required class="form-control" >
                                        <option value="">Select Name</option>
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        </select>                                       
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                    </div>  
                                </div>
                            </div>
                        </div>  
                    </form>



                    <div class="">
                        <div class="box-header ptbnull"></div>
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"><i class="fa fa-money"></i>
                                <?php echo $this->lang->line('daily_attendance_report') ?></h3>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('daily_attendance_report'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr> 

                                        <td>First Name</td>
                                        <td>mail</td>
                                        <td>Applied By</td>
                                        <td>Reason</td>
                                     


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                   

                                        foreach ($staff_absent_request as $ky) {
                                            ?>
                                            <tr>
                                                <td><?php echo $ky['name']; ?></td>
                                                <td><?php echo $ky['email']; ?></td>


<?php
 $query = $this->db->query("select * from staff_leave_request    where  '" . $dte_for . "'  between  staff_leave_request.leave_from and staff_leave_request.leave_to  and staff_leave_request.status='approve' and staff_leave_request.staff_id    = '".$ky['id']."'");
        $res= $query->row_array();                                                

    ?>
<td><?php echo $res['applied_by']; ?></td>
<td><?php echo $res['employee_remark']; ?></td> 



                                               

                                            </tr>
                                            <?php
                                        }
                                        ?>
                                      
                                </tbody>
                                  <tr style="font-weight: bold;">
                                            <td></td>

                                            <td><?php echo $all_present ?></td>
                                            <td><?php echo $all_absent ?></td>
                                            <td><?php echo $all_present_percent ?></td>
                                            <td><?php echo $all_absent_percent ?></td>
                                        </tr>
                                    
                            </table>
                        </div>
                    </div>

                </div>
            </div> 
    </section>
</div>


