           
            <?php
            $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
            ?>

            <div class="content-wrapper" style="min-height: 946px;">   

            <!-- Main content -->
            <section class="content">

            <div class="col-md-12">
            <?php
            $this->load->view('layout/topbar_enrollment'); ?>
            </div>
            &nbsp;  

            <div class="row">
            <div class="col-md-12">             
            <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Student And Parent Login Details</h3>
            <br>



            <form name="frm"  id="myform" class="common-reset-form" method="POST" action="<?php echo site_url('semester_enrollment/enroll/downloadExcellist');?>">

            <div class="col-md-2">                 
            <select id="program" name="program" class="form-control" onchange="getnamelist()">
            <option value="">-- Select Program --</option>
            <?php 
            // Build index of programs by type id for quick lookup
            $programs_by_type = [];
            foreach ($programs as $p) {
            $tid = isset($p['prog_type_id']) ? $p['prog_type_id'] : null;
            if ($tid === null) continue;
            if (!isset($programs_by_type[$tid])) $programs_by_type[$tid] = [];
            $programs_by_type[$tid][] = $p;
            }
            // Render all program types as optgroups, even if empty
            foreach ($program_types as $type) {
            echo '<optgroup label="'.htmlspecialchars($type['prog_type_name']).'">';
            $list = isset($programs_by_type[$type['prog_type_id']]) ? $programs_by_type[$type['prog_type_id']] : [];
            if (!empty($list)) {
            foreach ($list as $prog) {
            echo '<option value="'.$prog['p_id'].'" '.set_select('program', $prog['p_id']).'>'
            .htmlspecialchars($prog['p_name']).
            '</option>';
            }
            } else {
            echo '<option value="" disabled>-</option>';
            }
            echo '</optgroup>';
            }
            ?>
            </select>
            </div>

            
            <div class="col-md-2"> 

            <select id="semester" name="semester" class="form-control" onchange="getnamelist()">
            <option value="">-- Select Semester / Term / Batch --</option>
            <?php 
            $current_type = '';
            foreach ($semesters_batches as $sem): 
            if ($current_type != $sem['st_name']) {
            if ($current_type != '') echo '</optgroup>';
            echo '<optgroup label="' . htmlspecialchars($sem['st_name']) . '">';
            $current_type = $sem['st_name'];
            }

            // Only pass the individual IDs: semester | batch | term
            $value = $sem['sem_group_semester'] . '|' . $sem['sem_group_batchgroup'] . '|' . $sem['sem_group_semester_term'];
            ?>
            <option value="<?php echo $value; ?>" <?php echo set_select('semester', $value); ?>>
            <?php echo $sem['stm_name'] . ' - ' . $sem['batch_group_year']; ?>
            </option>
            <?php endforeach; ?>
            <?php if ($current_type != '') echo '</optgroup>'; ?>
            </select>

            </div>


            <div class="col-md-2">  
            <select  id="namelist" name="namelist"  class="form-control"    >
            <option value="">Select Name</option>
            </select>
            </div>

            <div class="col-md-2">  
            <button type="button" name="search" onclick="getsub()" value="Download Login List" class="btn btn-primary  btn-sm checkbox-toggle ">Search</button>    
            </div>

            <div class="col-md-2">
            <button type="button" id="resetBtn" class="btn btn-default btn-sm" >Reset</button>
            </div> 








            <button type="submit" name="search" value="Download Login List" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-download"></i>Download Login List</button>
            </form>                                     
            </div>
            <div class="box-body no-padding">

            </div>
            <div class="box-footer">

            <div class="mailbox-controls" id="clsId">


            <table  class="table table-striped table-bordered table-hover student-list" data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">
            <thead>
            <tr>
            <th>sl.No</th>
            <th>Admission No</th>
            <th>Roll No</th>
            <th>Name</th>                
            <th>Username</th>
            <th>Password</th>
            <th>Mobile</th>

            </tr>
            </thead>

            <tbody>
            <?php
            $s=1;
            foreach($logindetails as $login)
            {
            ?>
            <tr>
            <td><?php echo  $s;?></td>
            <td><?php echo $login['admission_no'];?></td>
            <td><?php echo $login['roll_no'];?></td>
            <td><?php echo $login['firstname'].'&nbsp;'.$login['middlename'].''.$login['lastname'];?></td>

            <td><?php echo $login['username'];?></td>
            <td><?php echo $login['password'];?></td>
            <td><?php echo $login['mobileno'];?></td>                        
            </tr>



            <?php $s++; } ?>
            </tbody>

            </table>                        


            </div>
            </div>
            </div>
            </div>
            </div>       
            </section>
            </div>





            <script type="text/javascript">

            $(document).ready(function()
            {
            $(document).on('submit','.class_search_form',function(e){
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var $this = $(this).find("button[type=submit]:focus");
            var form = $(this);
            var url = form.attr('action');
            var form_data = form.serializeArray();
            form_data.push({name: 'search_type', value: $this.attr('value')});
            $.ajax({
            url: url,
            type: "POST",
            dataType:'JSON',
            data: form_data, // serializes the form's elements.
            beforeSend: function () {
            $('[id^=error]').html("");
            $this.button('loading');

            resetFields($this.attr('value'));
            },
            success: function(response) { // your success handler

            if(!response.status){
            $.each(response.error, function(key, value) {
            $('#error_' + key).html(value);
            });
            }else{



            if ($.fn.DataTable.isDataTable('.student-list')) { // if exist datatable it will destrory first
            $('.student-list').DataTable().destroy();
            }
            table= $('.student-list').DataTable({
            // "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
            {
            extend:    'copy',
            text:      '<i class="fa fa-files-o"></i>',
            titleAttr: 'Copy',
            className: "btn-copy",
            title: $('.student-list').data("exportTitle"),
            exportOptions: {
            columns: ["thead th:not(.noExport)"]
            }
            },
            {
            extend:    'excel',
            text:      '<i class="fa fa-file-excel-o"></i>',
            titleAttr: 'Excel',
            className: "btn-excel",
            title: $('.student-list').data("exportTitle"),
            exportOptions: {
            columns: ["thead th:not(.noExport)"]
            }
            },
            {
            extend:    'csv',
            text:      '<i class="fa fa-file-text-o"></i>',
            titleAttr: 'CSV',
            className: "btn-csv",
            title: $('.student-list').data("exportTitle"),
            exportOptions: {
            columns: ["thead th:not(.noExport)"]
            }
            },
            {
            extend:    'pdf',
            text:      '<i class="fa fa-file-pdf-o"></i>',
            titleAttr: 'PDF',
            className: "btn-pdf",
            title: $('.student-list').data("exportTitle"),
            exportOptions: {
            columns: ["thead th:not(.noExport)"]
            },

            },
            {
            extend:    'print',
            text:      '<i class="fa fa-print"></i>',
            titleAttr: 'Print',
            className: "btn-print",
            title: $('.student-list').data("exportTitle"),
            customize: function ( win ) {

            $(win.document.body).find('th').addClass('display').css('text-align', 'center');
            $(win.document.body).find('table').addClass('display').css('font-size', '14px');     
            $(win.document.body).find('h1').css('text-align', 'center');
            },
            exportOptions: {
            columns: ["thead th:not(.noExport)"]

            }

            }
            ],


            "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span> '},
            "pageLength": 100,
            "processing": true,
            "serverSide": true,
            "ajax":{
            "url": baseurl+"student/dtstudentlist",
            "dataSrc": 'data',
            "type": "POST",
            'data': response.params,

            },"drawCallback": function(settings) {

            $('.detail_view_tab').html("").html(settings.json.student_detail_view);
            }

            });



            //=======================
            }
            },
            error: function() { // your error handler
            $this.button('reset');
            },
            complete: function() {
            $this.button('reset');
            }
            });

            });

            });
            </script>



            <script type="text/javascript">




            function getsub() {                
            var program_id = $('#program').val();   
            var semester_value = $('#semester').val(); 
            var namelist = $('#namelist').val();

            // Show loading state
            $('#clsId').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i><p>Loading...</p></div>');

            $.ajax({
            type: "POST",   
            url: "<?php echo site_url('semester_enrollment/enroll/Loginsearchvalidation'); ?>",
            data: {
            program_id: program_id,
            semester_value: semester_value,
            namelist: namelist
            },  
            dataType: 'html',  // Changed to html since we're getting HTML response
            success: function(html) {
            console.log('Raw HTML Response:', html);
            $('#clsId').html(html);
            },
            error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            $('#clsId').html('<div class="alert alert-danger">Error loading data. Please try again.</div>');
            }
            });             
            }




            function getnamelist()
            {

            var program_id          = $('#program').val();   
            var semester_value      = $('#semester').val();               

            $.ajax({
            type: "POST", 
            dataType: 'json', 
            data: { 
            program_id: program_id, 
            semester_value: semester_value 
            },

            url: "<?php echo site_url('semester_enrollment/enroll/getstudents');?>",
            success:function(result)
            {            

            $('#namelist').empty(); 
            $('#namelist').html('<option value=""></option>');	
            $.each(result, function(key, value) {
            $('#namelist').append(
            '<option value="'+ value.student_id +'">'+ value.firstname +'</option>'
            );
            });

            }
            });             

            }
            </script>