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
                    <form id='form1' action="<?php echo site_url('report/student_category_report') ?>"  method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">

                                


                                <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('category'); ?></label><span class="req"> *</span>
                                    <select name="category" required class="form-control" >
                                        <option value="">Select Category</option>

                                        <?php
                                        foreach($category as $cat) {
                                        ?>

                            <option value="<?php  echo $cat['id']; ?>"><?php  echo $cat['category']; ?></option>
                                    <?php } ?>
                                    

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
                               <?php echo $this->lang->line('student') ?> <?php echo $this->lang->line('category') ?></h3>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="download_label"><?php echo $this->lang->line('daily_attendance_report'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr> 

                                        <td>First Name</td>
                                        <td>Admission No</td>
                                        <td>Class</td>
                                        <td>Section</td>
                                        <td>Mobile No</td>
                                        <td>Email</td>

                                        <td>Address</td>
                                        <td>Blood Group</td>


                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                   

                                        foreach ($staff_category as $ky) {
                                            ?>
                                            <tr>
                                                <td><?php echo $ky['firstname'] ?></td>
                                                <td><?php echo $ky['admission_no'] ?></td>
  <td><?php echo $ky['class'] ?></td>
    <td><?php echo $ky['section'] ?></td>

                                                <td><?php echo $ky['mobileno'] ?></td>
                                                <td><?php echo $ky['email'] ?></td>
                                                <td><?php echo $ky['current_address'] ?></td>
                                                <td><?php echo $ky['blood_group'] ?></td>
                                                
                                                

                                                
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                      
                                </tbody>
                                  

                                    
                            </table>
                        </div>
                    </div>

                </div>
            </div> 
    </section>
</div>


