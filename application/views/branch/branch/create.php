                <style type="text/css">
                @media print
                {
                .no-print, .no-print *
                {
                display: none !important;
                }
                }
                </style>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <h1>
                <i class="fa fa-building-o"></i> <?php echo $this->lang->line('hostel'); ?>
                </h1>
                </section>
                <!-- Main content -->
                <section class="content">
                <div class="row">
                <?php if ($this->rbac->hasPrivilege('branch', 'can_add')) { ?>
                <div class="col-md-4">
                
                <!-- Horizontal Form -->
                <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $this->lang->line('add').'&nbsp'.$this->lang->line('update').'&nbsp;'.$this->lang->line('branch'); ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="form1" action="<?php echo site_url('branch/branch/create') ?>"  id="branchform" name="branchform" method="post" accept-charset="utf-8">
                    <div class="box-body">
                        <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>
                        <?php
                        if (isset($error_message)) {
                            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                        }
                        ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('branch').'&nbsp;'.$this->lang->line('name'); ?></label>
                            <input id="branch_name" name="branch_name"  placeholder="Enter Branch Name" type="text" class="form-control"  value="<?php echo set_value('branch_name'); ?>" />
                            
                            <input id="branch_id" name="branch_id"  placeholder="Branch Id" type="hidden" class="form-control"   />
                            <span class="text-danger"><?php echo form_error('branch_name'); ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('branch').'&nbsp;'.$this->lang->line('code'); ?></label>
                            <input id="branch_code" name="branch_code" placeholder="Enter Branch Code" type="text" class="form-control"  value="<?php echo set_value('branch_code'); ?>" />
                            <span class="text-danger"><?php echo form_error('branch_code'); ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('affiliation').'&nbsp;'.$this->lang->line('number'); ?></label>
                            <input id="affiliation" name="affiliation" placeholder="Enter Affilitaion" type="text" class="form-control"  value="<?php echo set_value('affiliation'); ?>" />
                            <span class="text-danger"><?php echo form_error('affiliation'); ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('school').'&nbsp;'.$this->lang->line('name'); ?></label>
                            <input id="school_name" name="school_name" placeholder="Enter School Name" type="text" class="form-control"  value="<?php echo set_value('school_name'); ?>" />
                            <span class="text-danger"><?php echo form_error('school_name'); ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('email'); ?></label>
                            <input id="email" name="email" placeholder="Enter Email" type="email" class="form-control"  value="<?php echo set_value('email'); ?>" />
                            <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </div>
                            
                             <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('password'); ?></label>
                            <input id="password" name="password" placeholder="Enter Password" type="password" class="form-control"  value="<?php echo set_value('password'); ?>" />
                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                            </div>
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('mobile_no'); ?></label>
                            <input id="mobile_no" name="mobile_no" placeholder="Enter Mobile No" type="text" class="form-control"  value="<?php echo set_value('mobile_no'); ?>" />
                            <span class="text-danger"><?php echo form_error('mobile_no'); ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('city'); ?></label>
                            <input id="city" name="city" placeholder="Enter City" type="text" class="form-control"  value="<?php echo set_value('city'); ?>" />
                            <span class="text-danger"><?php echo form_error('city'); ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('state'); ?></label>
                            <input id="state" name="state" placeholder="Enter State" type="text" class="form-control"  value="<?php echo set_value('state'); ?>" />
                            <span class="text-danger"><?php echo form_error('state'); ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('country'); ?></label>
                            <input id="country" name="country" placeholder="Enter Country" type="text" class="form-control"  value="<?php echo set_value('Country'); ?>" />
                            <span class="text-danger"><?php echo form_error('country'); ?></span>
                            </div>
                            
                            
                            <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('address'); ?></label>
                            <textarea class="form-control" id="address" name="address" placeholder="" rows="3" placeholder="Enter Address"><?php echo set_value('address'); ?></textarea>
                            <span class="text-danger"><?php echo form_error('address'); ?></span>
                            </div>
                            
                            
                    </div>
                    <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                    </div>
                    
                    
                </form>
                </div>
                
                </div><!--/.col (right) -->
                <!-- left column -->
                <?php } ?>
                <div class="col-md-<?php
                if ($this->rbac->hasPrivilege('branch', 'can_add')) {
                echo "8";
                } else {
                echo "12";
                }
                ?>">
                <!-- general form elements -->
                <div class="box box-primary" id="holist">
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"><?php echo $this->lang->line('branch').'&nbsp;'.$this->lang->line('list') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="mailbox-controls">
                    <div class="pull-right">
                    </div><!-- /.pull-right -->
                </div>
                <div class="mailbox-messages table-responsive">
                    <div class="download_label"><?php echo $this->lang->line('hostel_list'); ?></div>
                    <table class="table table-striped table-bordered table-hover example">
                            <thead>
                            <tr>
                            <th><?php echo $this->lang->line('slno'); ?></th>
                            <th><?php echo $this->lang->line('type'); ?></th>
                            <th><?php echo $this->lang->line('branch').'&nbsp;'.$this->lang->line('name'); ?></th>
                            <th><?php echo $this->lang->line('branch').'&nbsp;'.$this->lang->line('code'); ?></th>
                            <th><?php echo $this->lang->line('affiliation'); ?></th>
                            <th><?php echo $this->lang->line('email'); ?></th>
                            <th class="text-right no-print">
                            <?php echo $this->lang->line('action'); ?>
                            </th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php if (empty($branch_list)) {
                                ?>
                
                                <?php
                            } else {
                                $count = 1;
                                
                                foreach ($branch_list as $list) {
                                    ?>
                                    <tr>
                                    <td class="mailbox-name"> <?php echo $count; ?></td> 
                                    <td class="mailbox-name"> <?php echo $list['type'] ?></td>
                                    <td><a  data-toggle="popover" class="detail_popover"><?php echo $list['branch_name'] ?></a></td>
                                    <td class="mailbox-name"> <?php echo $list['branch_code'] ?></td>
                                    <td class="mailbox-name"> <?php echo $list['address'] ?></td>
                                    <td class="mailbox-name"> <?php echo $list['affiliation'] ?></td>
                                    
                                    
                                    <td class="mailbox-date pull-right no-print">
                                    
                                    <a data-placement="left" href="#" class="btn btn-default btn-xs edit-btn" data-id="<?php echo $list['branch_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                    <i class="fa fa-pencil"></i>
                                    </a>
                                    
                                    
                                    <?php
                                    if($list['type']=="Branch")
                                    {
                                    ?>
                                    <a data-placement="left"  class="btn btn-default btn-xs delete-btn" data-id="<?php echo $list['branch_id']; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                    <i class="fa fa-remove" style="color:#d43f3f;"></i>
                                    </a>
                                    <?php } ?>
                                    <?php  ?>
                                    </td>
                                    </tr>
                                    <?php
                                     $count++;
                                }
                               
                            }
                            ?>
                        </tbody>
                    </table><!-- /.table -->
                </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                </div>
                </div><!--/.col (left) -->
                
                </div>
                <div class="row">
                <div class="col-md-12">
                </div><!--/.col (right) -->
                </div>   <!-- /.row -->
                </section><!-- /.content -->
                </div><!-- /.content-wrapper -->
                
                <script type="text/javascript">
                
                $(document).ready(function() {
                $('.edit-btn').click(function(e) 
                {
                e.preventDefault();
                var branchId = $(this).data('id');
                $.ajax({
                url: '<?php echo base_url(); ?>branch/branch/get_data/' + branchId,
                type: 'GET',
                dataType: 'json',
                success: function(response) 
                {
                $('#branch_name').val(response.branch_name);
                $('#branch_code').val(response.branch_code);
                $('#school_name').val(response.school_name);
                // $('#password').val(response.password);
                // $('#email').val(response.contact_email);
                $('#mobile_no').val(response.contact);
                $('#city').val(response.city);
                $('#state').val(response.state_province);
                $('#address').val(response.address);
                $('#affiliation').val(response.affiliation);
                $('#branch_id').val(response.branch_id);
                $('#country').val(response.country);
                },
                error: function(xhr, status, error) {
                // Handle error
                console.error(error);
                }
                });
                });
                
                
                
                
                $('.delete-btn').click(function(e) 
                {
                e.preventDefault();
                var confirmDelete = confirm('Are you sure you want to delete this branch?');
                if (confirmDelete) 
                {
                var branchId = $(this).data('id');
                $.ajax({
                url: '<?php echo base_url(); ?>branch/branch/delete_data/' + branchId,
                type: 'GET',
                dataType: 'json',
                success: function(response)
                {
                if (response.hasOwnProperty('message')) {
                alert(response.message);
                } else if (response.hasOwnProperty('error')) {
                
                alert(response.error);
                } else {
                
                alert('Unexpected response from server');
                }
                location.reload();
                },
                error: function(xhr, status, error) {
                // Handle error
                console.error(error);
                }
                });
                }
                });
                });
                
                
                
                
                
                
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
                <script>
                $(document).ready(function () {
                $('.detail_popover').popover({
                placement: 'right',
                trigger: 'hover',
                container: 'body',
                html: true,
                content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
                }
                });
                });
                </script>