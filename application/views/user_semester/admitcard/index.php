
            <?php
            /*
            ?>
            <div class="content-wrapper">
            <!-- Page Header -->
            <div class="page-header mb-4">
            <div class="row align-items-center">
            <div class="col-md-6">
            <h5 class="mb-0">
            <i class="fas fa-home text-primary"></i> Print Admit Card
            </h5>
            <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admit Card</li>
            </ol>
            </nav>
            </div>
            <div class="col-md-6 text-end">
            <small class="text-muted">
            <i class="far fa-calendar-alt"></i>&nbsp;<?php  echo date('d-M-Y'); ?>
            </small>
            </div>
            </div>
            </div>  


            <div class="row g-3 mb-4">
            <div class="col-12">
            <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
            <form id="admitcardFilter" method="post" action="<?php  echo site_url('semesterauth/admitcard'); ?>">
            <div class="row g-3">


            <!-- Exam Type -->
            <div class="col-md-3">
            <label for="exam_group_id" class="form-label">Exam Group <span class="text-danger">*</span></label>


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

            <!-- Programme Type -->
            <div class="col-md-3">
            <label for="exam_id" class="form-label">Exam</label>
            <select  id="exam_id" name="exam_id" class="form-control" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>            



            <!-- Submit -->
            <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Search</button>
            </div>
            </div>

            <!-- <input type="hidden" name="sem_group_id" id="sem_group_id"
            value="<?php echo set_value('sem_group_id'); ?>"> -->
            </form>

            </div>
            </div>
            </div>
            </div>

            <!-- Main Content Row -->
            <div class="row g-4">
            <!-- Recent Assignments -->
            <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-clipboard-list text-primary"></i> Print Admit Card</h5>




            <form method="post" action="<?php echo base_url('semesterAuth/printCard') ?>" id="printCard">
            <input type="hidden" name="exam_group_id" id="exam_group_id"
            value="<?php echo (isset($exam_group_id) && $exam_group_id !== '') ? $exam_group_id : 'null'; ?>">

            <input type="hidden" name="exam_id" id="exam_id"
            value="<?php echo (isset($exam_id) && $exam_id !== '') ? $exam_id : 'null'; ?>">

            <button type="submit" class="btn btn-primary">Generate</button>
            </form>

            </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">    

            <table class="table table-hover">
            <thead class="table-light">
            <tr>
            <th>Institution ID</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Date OF Birth</th>
            <th>Gender</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><span class=""><?php echo $students->firstname; ?></span></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td>

            </td>
            </tr>                                      
            </tbody>
            </table>
            </div>
            </div>
            </div>
            </div>


            </div>
            </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function () {

            var exam_group_id = '<?php echo set_value('exam_group_id'); ?>';
            var exam_id = '<?php echo set_value('exam_id'); ?>';
            getExamByExamgroup(exam_group_id, exam_id);

            $(document).on('change', '#exam_group_id', function (e) {
            var exam_group_id = $(this).val();
            alert('Exam group changed to: ' + exam_group_id); // ✅ test alert
            $('#exam_id').html("");
            getExamByExamgroup(exam_group_id, 0);
            });

            function getExamByExamgroup(exam_group_id, exam_id) {
            if (exam_group_id != "") {
            $('#exam_id').html("");
            var base_url = '<?php echo base_url(); ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
            type: "POST",
            url: base_url + "semesterauth/getExamByExamgroup",
            data: { 'exam_group_id': exam_group_id },
            dataType: "json",
            beforeSend: function () {
            $('#exam_id').addClass('dropdownloading');
            },
            success: function (data) {
            $.each(data, function (i, obj) {
            var sel = (exam_id == obj.id) ? "selected" : "";
            div_data += "<option value='" + obj.id + "' " + sel + ">" + obj.exam + "</option>";
            });
            $('#exam_id').append(div_data);
            },
            complete: function () {
            $('#exam_id').removeClass('dropdownloading');
            },
            error: function (xhr, status, error) {
            console.error("Error fetching exams:", error);
            }
            });
            } else {
            $('#exam_id').html('<option value=""><?php echo $this->lang->line('select'); ?></option>');
            }
            }

            });






            $(document).on('submit', 'form#printCard', function (e) {
            e.preventDefault();

            var form = $(this);
            var subsubmit_button = form.find(':submit');
            var formdata = form.serializeArray(); // this creates an array of key/value pairs

            $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: formdata, // okay for simple form fields
            dataType: "json", // lowercase is safer
            beforeSend: function () {
            subsubmit_button.prop('disabled', true); // safer alternative to .button('loading')
            },
            success: function (response) {
            if (response.page) {
            Popup(response.page);
            } else {
            alert("No page content received from server.");
            }
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            alert("Error occurred. Please try again.");
            },
            complete: function () {
            subsubmit_button.prop('disabled', false); // re-enable after request
            }
            });
            });




            </script>



            <script type="text/javascript">

            var base_url = '<?php echo base_url() ?>';
            function Popup(data)
            {
            var frame1      = $('<iframe />');
            frame1[0].name  = "frame1";

            $("body").append(frame1);
            var frameDoc    = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html>');
            frameDoc.document.write('<head>');
            frameDoc.document.write('<title></title>');
            // frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/idcard.css">');

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

            <?php */ 

            /*
            ?>





            <main class="main-content" id="mainContent">
            <div class="container-fluid">
            <!-- Page Header -->
            <div class="row mb-4">
            <div class="col">
            <h2 class="mb-1"><?php echo $this->lang->line('admitcard'); ?></h2>
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $this->lang->line('admitcard'); ?></li>
            </ol>
            </nav>
            </div>
            </div>

            <!-- Add User Form -->
            <div class="row mb-4">
            <div class="col-12">
            <div class="card">
            <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i><?php echo $this->lang->line('admitcard'); ?></h5>
            </div>
            <div class="card-body">



            <form id="admitcardFilter" method="post" action="<?php  echo site_url('semesterauth/admitcard'); ?>">
            <div class="row g-3">


            <!-- Exam Type -->
            <div class="col-md-3">
            <label for="exam_group_id" class="form-label">Exam Group <span class="text-danger">*</span></label>


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

            <!-- Programme Type -->
            <div class="col-md-3">
            <label for="exam_id" class="form-label">Exam</label>
            <select  id="exam_id" name="exam_id" class="form-control" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>            



            <!-- Submit -->
            <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Search</button>
            </div>
            </div>

            <!-- <input type="hidden" name="sem_group_id" id="sem_group_id"
            value="<?php echo set_value('sem_group_id'); ?>"> -->
            </form>

            </div>
            </div>
            </div>
            </div>

            <!-- Users Table -->
            <div class="row">
            <div class="col-12">
            <div class="card">


            <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i>Users List</h5>
            <div class="d-flex gap-2">
            <input type="search" class="form-control form-control-sm" placeholder="Search users..." style="width: 200px;">

            <form method="post" action="<?php echo base_url('semesterAuth/printCard') ?>" id="printCard">
            <input type="hidden" name="exam_group_id" id="exam_group_id"
            value="<?php echo (isset($exam_group_id) && $exam_group_id !== '') ? $exam_group_id : 'null'; ?>">

            <input type="hidden" name="exam_id" id="exam_id"
            value="<?php echo (isset($exam_id) && $exam_id !== '') ? $exam_id : 'null'; ?>">

            <button type="submit" class="btn btn-primary">Generate</button>
            </form>
            </div>
            </div>





            <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover">
            <thead class="table-light">
            <tr>
            <th>Institution ID</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Date OF Birth</th>
            <th>Gender</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><span class=""><?php echo $students->firstname; ?></span></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td>

            </td>
            </tr>                                      
            </tbody>
            </table>
            </div>
            <!-- Pagination -->
            <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end mb-0">
            <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#">Next</a>
            </li>
            </ul>
            </nav>
            </div>
            </div>
            </div>
            </div>
            </div>
            </main>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function () {

            var exam_group_id = '<?php echo set_value('exam_group_id'); ?>';
            var exam_id = '<?php echo set_value('exam_id'); ?>';
            getExamByExamgroup(exam_group_id, exam_id);

            $(document).on('change', '#exam_group_id', function (e) {
            var exam_group_id = $(this).val();
            alert('Exam group changed to: ' + exam_group_id); // ✅ test alert
            $('#exam_id').html("");
            getExamByExamgroup(exam_group_id, 0);
            });

            function getExamByExamgroup(exam_group_id, exam_id) {
            if (exam_group_id != "") {
            $('#exam_id').html("");
            var base_url = '<?php echo base_url(); ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
            type: "POST",
            url: base_url + "semesterauth/getExamByExamgroup",
            data: { 'exam_group_id': exam_group_id },
            dataType: "json",
            beforeSend: function () {
            $('#exam_id').addClass('dropdownloading');
            },
            success: function (data) {
            $.each(data, function (i, obj) {
            var sel = (exam_id == obj.id) ? "selected" : "";
            div_data += "<option value='" + obj.id + "' " + sel + ">" + obj.exam + "</option>";
            });
            $('#exam_id').append(div_data);
            },
            complete: function () {
            $('#exam_id').removeClass('dropdownloading');
            },
            error: function (xhr, status, error) {
            console.error("Error fetching exams:", error);
            }
            });
            } else {
            $('#exam_id').html('<option value=""><?php echo $this->lang->line('select'); ?></option>');
            }
            }

            });






            $(document).on('submit', 'form#printCard', function (e) {
            e.preventDefault();

            var form = $(this);
            var subsubmit_button = form.find(':submit');
            var formdata = form.serializeArray(); // this creates an array of key/value pairs

            $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: formdata, // okay for simple form fields
            dataType: "json", // lowercase is safer
            beforeSend: function () {
            subsubmit_button.prop('disabled', true); // safer alternative to .button('loading')
            },
            success: function (response) {
            if (response.page) {
            Popup(response.page);
            } else {
            alert("No page content received from server.");
            }
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            alert("Error occurred. Please try again.");
            },
            complete: function () {
            subsubmit_button.prop('disabled', false); // re-enable after request
            }
            });
            });




            </script>



            <script type="text/javascript">

            var base_url = '<?php echo base_url() ?>';
            function Popup(data)
            {
            var frame1      = $('<iframe />');
            frame1[0].name  = "frame1";

            $("body").append(frame1);
            var frameDoc    = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html>');
            frameDoc.document.write('<head>');
            frameDoc.document.write('<title></title>');
            // frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/idcard.css">');

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

            </php */  /*?>



            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Admit Card</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Admit Card</li>
            </ol>
            </div>
            </div>
            </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="container-fluid">
            <div class="row">
            <div class="col-12">
            <div class="card">
            <div class="card-header">
            <h3 class="card-title">Admit Card</h3>
            </div>


            <div class="card-body"> 
            <form id="admitcardFilter" method="post" action="<?php  echo site_url('semesterauth/admitcard'); ?>">
            <div class="row g-3">

            <!-- Exam Type -->
            <div class="col-md-3">
            <label for="exam_group_id" class="form-label">Exam Group <span class="text-danger">*</span></label>


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

            <!-- Programme Type -->

            <div class="col-md-3">
            <label for="exam_id" class="form-label">Exam</label>
            <select  id="exam_id" name="exam_id" class="form-control" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>            



            <!-- Submit -->
            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">Search</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('printCard').submit()">Generate</button>
            </div>
            </div>

            <!-- <input type="hidden" name="sem_group_id" id="sem_group_id"
            value="<?php echo set_value('sem_group_id'); ?>"> -->
            </form>

            <form method="post" action="<?php echo base_url('semesterAuth/printCard') ?>" id="printCard" style="display: none;">
                <input type="hidden" name="exam_group_id" id="exam_group_id"
                value="<?php echo (isset($exam_group_id) && $exam_group_id !== '') ? $exam_group_id : 'null'; ?>">
                <input type="hidden" name="exam_id" id="exam_id"
                value="<?php echo (isset($exam_id) && $exam_id !== '') ? $exam_id : 'null'; ?>">
            </form>

            <table class="table table-hover">
            <thead class="table-light">
            <tr>
            <th>Institution ID</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Date OF Birth</th>
            <th>Gender</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><span class=""><?php echo $students->firstname; ?></span></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>            
            </tr>                                      
            </tbody>
            </table>
            </div>
            <!-- /.card-body -->
            </div>
           
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            </div>

            <?php */ ?>





 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admit Card</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admit Card</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">    
        
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
            

              <!-- <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div> -->
              
              <!-- /.card-tools -->


            <form id="admitcardFilter" method="post" action="<?php  echo site_url('semesterauth/admitcard'); ?>">
            <div class="row g-3">

            <!-- Exam Type -->
            <div class="col-md-3">
            <label for="exam_group_id" class="form-label">Exam Group <span class="text-danger">*</span></label>


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

            <!-- Programme Type -->

            <div class="col-md-3">
            <label for="exam_id" class="form-label">Exam</label>
            <select  id="exam_id" name="exam_id" class="form-control" >
            <option value=""><?php echo $this->lang->line('select'); ?></option>
            </select>
            <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
            </div>            



            <!-- Submit -->
            <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-2">Search</button>            
            </div>
            </div>

            <!-- <input type="hidden" name="sem_group_id" id="sem_group_id"
            value="<?php echo set_value('sem_group_id'); ?>"> -->
            </form>



            </div>
            <!-- /.card-header -->
<br>

  <div class="col-12 d-flex justify-content-end">
              <form method="post" action="<?php echo base_url('semesterAuth/printCard') ?>" id="printCard">
                                <input type="hidden" name="exam_group_id" id="exam_group_id"
                                value="<?php echo (isset($exam_group_id) && $exam_group_id !== '') ? $exam_group_id : 'null'; ?>">

                                <input type="hidden" name="exam_id" id="exam_id"
                                value="<?php echo (isset($exam_id) && $exam_id !== '') ? $exam_id : 'null'; ?>">

                                <button type="submit" class="btn btn-primary">Generate</button>
                                </form>
        </div>
            <div class="card-body p-0"> 

            <div class="table-responsive mailbox-messages">
      
            <table class="table ">
            <thead class="table-light">
            <tr>
            <th>Institution ID</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>Date OF Birth</th>
            <th>Gender</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><span class=""><?php echo $students->firstname; ?></span></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td><?php echo $students->firstname; ?></td>
            <td>

            </td>
            </tr>                                      
            </tbody>
            </table>
            </div>
             
            </div>
        
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>



            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function () {

            var exam_group_id = '<?php echo set_value('exam_group_id'); ?>';
            var exam_id = '<?php echo set_value('exam_id'); ?>';
            getExamByExamgroup(exam_group_id, exam_id);

            $(document).on('change', '#exam_group_id', function (e) {
            var exam_group_id = $(this).val();
            alert('Exam group changed to: ' + exam_group_id); // ✅ test alert
            $('#exam_id').html("");
            getExamByExamgroup(exam_group_id, 0);
            });

            function getExamByExamgroup(exam_group_id, exam_id) {
            if (exam_group_id != "") {
            $('#exam_id').html("");
            var base_url = '<?php echo base_url(); ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

            $.ajax({
            type: "POST",
            url: base_url + "semesterauth/getExamByExamgroup",
            data: { 'exam_group_id': exam_group_id },
            dataType: "json",
            beforeSend: function () {
            $('#exam_id').addClass('dropdownloading');
            },
            success: function (data) {
            $.each(data, function (i, obj) {
            var sel = (exam_id == obj.id) ? "selected" : "";
            div_data += "<option value='" + obj.id + "' " + sel + ">" + obj.exam + "</option>";
            });
            $('#exam_id').append(div_data);
            },
            complete: function () {
            $('#exam_id').removeClass('dropdownloading');
            },
            error: function (xhr, status, error) {
            console.error("Error fetching exams:", error);
            }
            });
            } else {
            $('#exam_id').html('<option value=""><?php echo $this->lang->line('select'); ?></option>');
            }
            }
            });



            $(document).on('submit', 'form#printCard', function (e)
            {
            e.preventDefault();

            var form = $(this);
            var subsubmit_button = form.find(':submit');
            var formdata = form.serializeArray(); // this creates an array of key/value pairs

            $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: formdata, // okay for simple form fields
            dataType: "json", // lowercase is safer
            beforeSend: function () {
            subsubmit_button.prop('disabled', true); // safer alternative to .button('loading')
            },
            success: function (response) {
            if (response.page) {
            Popup(response.page);
            } else {
            alert("No page content received from server.");
            }
            },
            error: function (xhr, status, error) {
            console.log(xhr.responseText);
            alert("Error occurred. Please try again.");
            },
            complete: function () {
            subsubmit_button.prop('disabled', false); // re-enable after request
            }
            });
            });       


          
            var base_url = '<?php echo base_url() ?>';
            function Popup(data)
            {
            var frame1      = $('<iframe />');
            frame1[0].name  = "frame1";

            $("body").append(frame1);
            var frameDoc    = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html>');
            frameDoc.document.write('<head>');
            frameDoc.document.write('<title></title>');
            // frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/idcard.css">');

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