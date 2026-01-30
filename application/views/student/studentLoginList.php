
                <?php
                $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
                ?>

                <div class="content-wrapper" style="min-height: 946px;">   

                <!-- Main content -->
                <section class="content">
                <div class="row">
                <div class="col-md-12">             
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Student And Parent Login Details</h3>



                <br>

                <form name="frm"  id="myform" class="common-reset-form" method="POST" action="<?php echo site_url('student/downloadExcellist');?>">
                <div class="col-md-2">  
                <select  autofocus="" id="class_id"  name="class_id" class="form-control"  >


                <option value=""><?php echo $this->lang->line('select'); ?></option>                                                    
                <?php


                $count = 0;
                foreach ($classlist as $class) {
                ?>
                <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) {
                echo "selected=selected";
                }
                ?>><?php echo $class['class'] ?>
                </option>
                <?php
                $count++;
                }
                ?>
                </select>



                </div>
                <div class="col-md-2">  
                <select  id="section_id" name="section_id"  class="form-control" onchange="getnamelist()"       >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
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
                <th>Class</th>
                <th>Section</th>
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
                <td><?php echo $login['class'];?></td>
                <td><?php echo $login['section'];?></td>
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
               
                function getSectionByClass(class_id, section_id) {
                if (class_id != "" && section_id != "") {
                $('#section_id').html("");
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
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
                }
                });
                }
                }








                $(document).ready(function () {
                var class_id = $('#class_id').val();
                var section_id = '<?php echo set_value('section_id') ?>';
                getSectionByClass(class_id, section_id);
                $(document).on('change', '#class_id', function (e) {
                $('#section_id').html("");
                var class_id = $(this).val();
                var base_url = '<?php echo base_url() ?>';
                var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                $.each(data, function (i, obj)
                {
                div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                });
                $('#section_id').append(div_data);
                }
                });
                });
                });
                </script>              



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
                function getsub()
                {  

                var class_id             =   $('#class_id').val();   
                var section_id           =   $('#section_id').val(); 
                var namelist             =   $('#namelist').val();


                $.ajax({
                type: "POST",   
                data: {class_id: class_id,section_id:section_id,namelist:namelist},  
                url: "<?php echo site_url('student/Loginsearchvalidation');?>",
                success:function(result)
                {


                $('#clsId').html(result);                        

                }
                });             

                }


                function getnamelist()
                {  
                var class_id             =   $('#class_id').val();   
                var section_id           =   $('#section_id').val(); 
                var namelist             =   $('#namelist').val(); 

                $.ajax({
                type: "POST",   
                data: {class_id: class_id,section_id:section_id}, 

                url: "<?php echo site_url('student/getNameClass');?>",
                success:function(result)
                { 
                $('#namelist').empty(); 
                var jsondata= JSON.parse(result);
                $('#namelist').html('<option value=""></option>');						  
                $.each(jsondata, function(key, value) 
                {

                $('select[name="namelist"]').append('<option value="'+ value.student_id +'">'+ value.firstname +'</option>');

                });



                }
                });             

                }
                </script>