
      <script type="text/javascript">
      function selectStudent(student) {
      // Show the TC form
      document.getElementById("tcFormContainer").style.display = "block";

      // Fill selected student details
      document.getElementById("selectedStudentName").innerText =
      student.firstname + " " + student.lastname + " (Adm No: " + student.admission_no + ")";

      // Set hidden input for backend
      document.getElementById("studentId").value = student.id;
      }
      </script>
        
        <style>          
        /* .search-section {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 30px;
        }

        .search-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: 15px;
        align-items: end;
        } */

      .form-group { 
        display: flex;
        flex-direction: column;
        } 

        label {
        margin-bottom: 8px;
        color: #333;
        font-weight: 600;
        font-size: 14px;
        }

        input, select {
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 16px;
        transition: all 0.3s;
        }

        input:focus, select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* .students-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .students-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        }
        */  

        .tc-form-section {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 12px;
        margin-top: 30px;
        display: none;
        }

        .tc-form-section.active {
        display: block;
        }

        .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 20px;
        }

        .form-group-full {
        grid-column: 1 / -1;
        }

        textarea {
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 16px;
        font-family: inherit;
        resize: vertical;
        min-height: 100px;
        }

        textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }



        .info-box {
        background: #e3f2fd;
        border-left: 4px solid #2196f3;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        }

        .info-box h3 {
        color: #1976d2;
        font-size: 16px;
        margin-bottom: 5px;
        }

        .info-box p {
        color: #555;
        font-size: 14px;
        }

        @media (max-width: 768px) {
        .search-row {
        grid-template-columns: 1fr;
        }

        .form-grid {
        grid-template-columns: 1fr;
        }
        }
        </style>

        <?php
        $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
        ?>
        <div class="content-wrapper">
        <section class="content-header">
        <h1>
        <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> 
        <small><?php echo $this->lang->line('student1'); ?></small>
        </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="col-md-12">
        <?php $this->load->view('layout/topbar_enrollment'); ?>
        </div>
        &nbsp;

        <div class="row">
        <div class="col-md-12">
        <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">
        <i class="fa fa-search"></i> <?php echo  $this->lang->line('transfer_certificate'); ?>
        </h3>
        </div>

        <div class="box-body">
        <form role="form" action="<?php echo site_url('semester_enrollment/enroll/transfer_certificate') ?>" method="post" class="class_search_form">
        <div class="promotion-grid">
        <!-- Selection Section -->
        <div class="section-card">
        <div class="section-title"> <?php echo  $this->lang->line('transfer_certificate'); ?></div>

        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
        <label><?php echo $this->lang->line('programee_type'); ?><small class="req">*</small></label>
        <select id="program" name="program" class="form-control">
        <option value="">-- Select Program --</option>
        <?php 
        $programs_by_type = [];
        foreach ($programs as $p) {
        $tid = isset($p['prog_type_id']) ? $p['prog_type_id'] : null;
        if ($tid === null) continue;
        if (!isset($programs_by_type[$tid])) $programs_by_type[$tid] = [];
        $programs_by_type[$tid][] = $p;
        }
        foreach ($program_types as $type) {
        echo '<optgroup label="'.htmlspecialchars($type['prog_type_name']).'">';
        $list = isset($programs_by_type[$type['prog_type_id']]) ? $programs_by_type[$type['prog_type_id']] : [];
        if (!empty($list)) {
        foreach ($list as $prog) {
        echo '<option value="'.$prog['p_id'].'" '.set_select('program', $prog['p_id']).'>'
        .htmlspecialchars($prog['p_name']).'</option>';
        }
        } else {
        echo '<option value="" disabled>-</option>';
        }
        echo '</optgroup>';
        }
        ?>
        </select>
        <span class="text-danger"><?php echo form_error('program'); ?></span>
        </div>
        </div>


        <!-- Semester / Batch / Term -->
        <div class="col-md-6">
        <div class="form-group">
        <label>Semester / Batch / Term <small class="req">*</small></label>
        <select id="semester" name="semester" class="form-control">
        <option value="">-- Select Semester / Term / Batch --</option>
        <?php 
        $current_type = '';
        foreach ($semesters_batches as $sem): 
        if ($current_type != $sem['st_name']) {
        if ($current_type != '') echo '</optgroup>';
        echo '<optgroup label="' . htmlspecialchars($sem['st_name']) . '">';
        $current_type = $sem['st_name'];
        }
        $value = $sem['sem_group_semester'] . '|' . $sem['sem_group_batchgroup'] . '|' . $sem['sem_group_semester_term'];
        ?>
        <option value="<?php echo $value; ?>" <?php echo set_select('semester', $value); ?>>
        <?php echo $sem['stm_name'] . ' - ' . $sem['batch_group_year']; ?>
        </option>
        <?php endforeach; ?>
        <?php if ($current_type != '') echo '</optgroup>'; ?>
        </select>
        <span class="text-danger"><?php echo form_error('semester'); ?></span>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="row">
        <div class="col-sm-12">
        <div class="">
        <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right ">
        <i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?>
        </button>
        </div>
        </div>
        </div>
        </div> 
        </form>
        </div>
        </div>

        <?php  
        if (isset($students)) 
        {
        ?>
        <input type="hidden" name="sem_group_id"  id="sem_group_id" value="<?php echo $sem_groups['sem_group_id']; ?>">
        <div class="nav-tabs-custom border0 navnoshadow">
        <div class="box-header with-border">
        <h3 class="box-title">
        <i class="fa fa-search"></i> <?php echo  $this->lang->line('student_list'); ?>
        </h3>
        </div>

        <div class="box-body">
        <div class="table-responsive mailbox-messages">        
        <table class="table table-striped table-bordered table-hover example">           
        <thead>
        <tr>          
        <th><?php echo $this->lang->line('admission_no'); ?></th>
        <th><?php echo $this->lang->line('roll_no'); ?></th>
        <th><?php echo $this->lang->line('student_name'); ?></th>
        <th><?php echo $this->lang->line('gender'); ?></th>
        <th><?php echo $this->lang->line('father_name'); ?></th>
        <th><?php echo $this->lang->line('current_address'); ?></th>
        <th><?php echo $this->lang->line('date_of_birth'); ?></th>
        <th><?php echo $this->lang->line('action'); ?></th>
        </tr>
        </thead>
        <tbody>


    <?php foreach($students as $stud): ?>
    <tr>
    <td><?php echo $stud['admission_no']; ?></td>
    <td><?php echo $stud['roll_no']; ?></td>
    <td><?php echo $stud['firstname']; ?></td>
    <td><?php echo $stud['gender']; ?></td>
    <td><?php echo $stud['father_name']; ?></td>
    <td><?php echo $stud['current_address']; ?></td>
    <td><?php echo $stud['dob']; ?></td>
    <td>
        <?php
        $student_id       = $stud['id'];

        if(isset($tc_same_sem[$student_id])){
            // Same semester → Generate / Update
            $button_class = 'btn-success generate-tc-btn';
            $button_text  = $this->lang->line('generate');
        } elseif(isset($tc_other_sem[$student_id])){
            // Exists in another semester → Print only
            $button_class = 'btn-primary print-tc-btn';
            $button_text  = 'Print TC';
            // Add data attributes for print functionality
            $print_data = [
                'id' => $student_id,
                'name' => $stud['firstname'] . ' ' . $stud['lastname'],
                'adm' => $stud['admission_no']
            ];
            $print_attrs = '';
            foreach ($print_data as $key => $value) {
                $print_attrs .= ' data-' . $key . '="' . htmlspecialchars($value, ENT_QUOTES) . '"';
            }
        }
        else
        {
            // Student does not exist in TC → Generate
            $button_class = 'btn-success generate-tc-btn';
            $button_text  = $this->lang->line('generate');
        }
        ?>
        <button class="btn btn-sm <?php echo $button_class; ?>" data-id="<?php echo $student_id; ?>" data-name="<?php echo $stud['firstname'] . ' ' . $stud['lastname']; ?>" data-adm="<?php echo $stud['admission_no']; ?>"<?php echo isset($print_attrs) ? $print_attrs : ''; ?>>
        <?php echo $button_text; ?>
        </button>        
    </td>
</tr>


<?php endforeach; ?>
</tbody>        
        </table>

        <div id="tcFormContainer" style="display:none; margin-top:20px;">
        <div class="info-box">
        <h3>Selected Student</h3>
        <p id="selectedStudentInfo">Name: Admission No</p>
        </div>

        <h2 style="margin-bottom: 20px; color: #333; font-size: 20px;">Generate Transfer Certificate</h2>

        <form id="tcForm">
        <div class="form-grid">
        <div class="form-group">
        <label for="tcReason">Reason for TC *</label>
        <select id="tcReason" required>
        <option value="">Select Reason</option>
        <option value="completed">After completing course/year</option>
        <option value="leaving">Leaving school in the middle</option>
        <option value="transfer">Transferring to another institution</option>
        </select>
        </div>

        <div class="form-group">
        <label for="tcDate">TC Issue Date *</label>
        <input type="date" id="tcDate" required>
        </div>

        <div class="form-group">
        <label for="lastAttendance">Last Attendance Date *</label>
        <input type="date" id="lastAttendance" required>
        </div>

        <div class="form-group">
        <label for="conduct">Conduct</label>
        <select id="conduct">
        <option value="excellent">Excellent</option>
        <option value="good">Good</option>
        <option value="satisfactory">Satisfactory</option>
        </select>
        </div>

        <div class="form-group form-group-full">
        <label for="remarks">Remarks (Optional)</label>
        <textarea id="remarks" placeholder="Enter any additional remarks"></textarea>
        </div>
        </div>



        <div class="action-buttons">
        <button type="submit" value="generate" class="btn btn-success"><?php echo  $this->lang->line('generate'); ?></button>&nbsp;&nbsp;
        <button type="button" class="btn btn-danger" onclick="cancelTC()">Cancel</button>
        </div>


        </form>
        </div>
        </div>
        </div>

        </div><!--./box box-primary -->
        <?php
        }
        ?>
        </div>
        </div>
        </section>
        </div>




    <script> 
     $(document).on("click", ".generate-tc-btn", function () {
    let studentId = $(this).data("id");
    let name      = $(this).data("name");
    let adm       = $(this).data("adm");
    let sem_group_id = $("#sem_group_id").val();

    // Update selected student text
    $("#selectedStudentInfo").text(name + " (" + adm + ")");

    // Store selected student globally
    selectedStudent = { id: studentId, name: name, adm: adm };

    // Check if TC exists for this student + sem group
    $.ajax({
        url: base_url + "semester_enrollment/enroll/get_tc_data",
        type: "POST",
        dataType: "JSON",
        data: {
            student_id: studentId,
            sem_group_id: sem_group_id
        },
        success: function (res) {

            if (res.status == 1) {
                // EXISTING DATA → PREFILL FORM
                $("#tcReason").val(res.data.reason);
                $("#tcDate").val(res.data.issue_date);
                $("#lastAttendance").val(res.data.last_attendance);
                $("#conduct").val(res.data.conduct);
                $("#remarks").val(res.data.remarks);
            } 
            else {
                // No record → Reset form
                $("#tcForm")[0].reset();
            }

            // Finally, show the form
            $("#tcFormContainer").slideDown();
        }
    });
});

    
let selectedStudent = {}; // already set from your Generate TC button

// $("#tcForm").submit(function (e) { 

//     e.preventDefault();
//     // Prepare the data object
//     const data = {
//         sem_group_id: $("#sem_group_id").val(),
//         studentId: selectedStudent.id,
//         studentName: selectedStudent.name,
//         admNo: selectedStudent.adm,
//         reason: $("#tcReason").val(),
//         issueDate: $("#tcDate").val(),
//         lastDate: $("#lastAttendance").val(),
//         conduct: $("#conduct").val(),
//         remarks: $("#remarks").val(),
//     }; 
 
//     $.ajax({
//         url: base_url + "semester_enrollment/enroll/print_data",
//         type: "POST",
//         dataType: "JSON",
//         data: data, // use the prepared object
//         success: function (res) {
//             if (res.status == 1) {
//                 Popup(res.page);   // YOUR POPUP FUNCTION
//             }
//         }
//     });
// });

$("#tcForm").submit(function (e) { 

    e.preventDefault();

    const data = {
        sem_group_id: $("#sem_group_id").val(),
        studentId: selectedStudent.id,
        studentName: selectedStudent.name,
        admNo: selectedStudent.adm,
        reason: $("#tcReason").val(),
        issueDate: $("#tcDate").val(),
        lastDate: $("#lastAttendance").val(),
        conduct: $("#conduct").val(),
        remarks: $("#remarks").val(),
    };

    // WARNING MESSAGE BEFORE UPDATE + PRINT
    let warningMessage = 
        "⚠️ BEWARE!\n\n" +
        "Saving & Printing will UPDATE the TC data.\n" +
        "If any details are wrong, you cannot undo this.\n\n" +
        "Do you want to continue?";

    if (!confirm(warningMessage)) {
        return false; // STOP here
    }

    // If confirmed → update + print
    $.ajax({
        url: base_url + "semester_enrollment/enroll/print_data",
        type: "POST",
        dataType: "JSON",
        data: data,
        success: function (res) {
            if (res.status == 1) {
                Popup(res.page);
            }
        }
    });

});

var base_url = '<?php echo base_url() ?>';
function Popup(data)
{
    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({"position": "absolute", "top": "-1000000px"});
    $("body").append(frame1);

    var frameDoc = frame1[0].contentWindow 
        ? frame1[0].contentWindow 
        : frame1[0].contentDocument.document 
        ? frame1[0].contentDocument.document 
        : frame1[0].contentDocument;

    frameDoc.document.open();
    frameDoc.document.write('<html><head>');
    frameDoc.document.write('<title>Transfer Certificate</title>');
    frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css" />');
    frameDoc.document.write('</head><body>');
    frameDoc.document.write(data);
    frameDoc.document.write('</body></html>');
    frameDoc.document.close();

    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
    }, 500);

    return true;
}

// Cancel button
function cancelTC() {
    $("#tcFormContainer").slideUp();
}


$(document).on("click", ".print-tc-btn", function (e) {
    e.preventDefault();   // now safe

    let student_id = $(this).data("id");
    alert(student_id);

    if (!student_id) {
        alert("Invalid student!");
        return;
    }
    const data = {
        sem_group_id: $("#sem_group_id").val(),
        studentId: student_id,  // use the correct id
                
    };     
      
    $.ajax({
        url: base_url + "semester_enrollment/enroll/print_tc",
        type: "POST",
        dataType: "JSON",
        data: data,
        success: function (res) {
            console.log(res)
            if (res.status == 1) {
                Popup(res.page);
            }
        }
    });

});

</script>


     
    