
                        <style>
                        /*

                        .main-card {
                        background: white;
                        border-radius: 10px;
                        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
                        overflow: hidden;
                        margin-bottom: 20px;
                        }
                        .header {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 25px;
                        text-align: center;
                        }
                        .header h2 {
                        font-size: 24px;
                        margin-bottom: 5px;
                        }
                        .content-wrapper {
                        display: grid;
                        grid-template-columns: 350px 1fr;
                        gap: 0;
                        }
                        .sidebar {
                        background: #f8f9fa;
                        padding: 25px;
                        border-right: 1px solid #e0e0e0;
                        max-height: 800px;
                        overflow-y: auto;
                        }
                        .form-group {
                        margin-bottom: 18px;
                        }
                        label {
                        display: block;
                        font-weight: 600;
                        color: #333;
                        margin-bottom: 8px;
                        font-size: 13px;
                        }
                        select, input[type="text"] {
                        width: 100%;
                        padding: 10px;
                        border: 2px solid #e0e0e0;
                        border-radius: 6px;
                        font-size: 13px;
                        transition: all 0.3s;
                        }
                        select:focus, input[type="text"]:focus {
                        outline: none;
                        border-color: #667eea;
                        }
                        .capacity-box {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 15px;
                        border-radius: 8px;
                        text-align: center;
                        margin: 15px 0;
                        }
                        .capacity-box strong {
                        font-size: 24px;
                        display: block;
                        margin-top: 5px;
                        }
                        .main-content {
                        padding: 25px;
                        background: white;
                        }
                        .allocation-grid {
                        display: grid;
                        grid-template-columns: 1fr 400px;
                        gap: 25px;
                        }
                        .seat-layout {
                        background: #f8f9fa;
                        padding: 20px;
                        border-radius: 8px;
                        border: 2px solid #e0e0e0;
                        }
                        .seat-layout h3 {
                        color: #333;
                        margin-bottom: 15px;
                        font-size: 16px;
                        }
                        .stage {
                        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
                        color: white;
                        padding: 15px;
                        text-align: center;
                        border-radius: 6px;
                        margin-bottom: 20px;
                        font-weight: 600;
                        }
                        .seats-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
                        gap: 10px;
                        margin-top: 10px;
                        }
                        .seat {
                        aspect-ratio: 1;
                        border: 2px solid #ddd;
                        border-radius: 8px;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        transition: all 0.3s;
                        font-size: 11px;
                        padding: 5px;
                        text-align: center;
                        background: white;
                        }
                        .seat:hover {
                        transform: scale(1.05);
                        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                        }
                        .seat.available {
                        background: #e8f5e9;
                        border-color: #4caf50;
                        }
                        .seat.occupied {
                        background: #ffebee;
                        border-color: #f44336;
                        cursor: not-allowed;
                        }
                        .seat.selected {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        border-color: #667eea;
                        color: white;
                        transform: scale(1.1);
                        }
                        .seat-number {
                        font-weight: bold;
                        font-size: 12px;
                        }
                        .seat-status {
                        font-size: 9px;
                        opacity: 0.8;
                        margin-top: 2px;
                        }
                        .students-panel {
                        background: #f8f9fa;
                        border-radius: 8px;
                        padding: 20px;
                        border: 2px solid #e0e0e0;
                        max-height: 600px;
                        overflow-y: auto;
                        }
                        .students-panel h3 {
                        color: #333;
                        margin-bottom: 15px;
                        font-size: 16px;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        }
                        .search-box {
                        margin-bottom: 15px;
                        }
                        .search-box input {
                        width: 100%;
                        padding: 10px;
                        border: 2px solid #e0e0e0;
                        border-radius: 6px;
                        font-size: 13px;
                        }
                        .student-item {
                        background: white;
                        padding: 12px;
                        margin-bottom: 10px;
                        border-radius: 6px;
                        border: 2px solid #e0e0e0;
                        cursor: pointer;
                        transition: all 0.3s;
                        }
                        .student-item:hover {
                        border-color: #667eea;
                        transform: translateX(5px);
                        }
                        .student-item.selected {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        border-color: #667eea;
                        }
                        .student-item.assigned {
                        background: #e8f5e9;
                        border-color: #4caf50;
                        opacity: 0.6;
                        }
                        .student-name {
                        font-weight: 600;
                        font-size: 14px;
                        margin-bottom: 4px;
                        }
                        .student-roll {
                        font-size: 12px;
                        opacity: 0.8;
                        }
                        .student-seat {
                        font-size: 11px;
                        margin-top: 4px;
                        color: #4caf50;
                        font-weight: 600;
                        }
                        .action-buttons {
                        display: flex;
                        gap: 10px;
                        margin-top: 20px;
                        }
                        .btn {
                        padding: 12px 24px;
                        border: none;
                        border-radius: 6px;
                        font-size: 14px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.3s;
                        }
                        .btn-primary {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        flex: 1;
                        }
                        .btn-success {
                        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                        color: white;
                        flex: 1;
                        }
                        .btn-danger {
                        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
                        color: white;
                        }
                        .btn:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                        }
                        .legend {
                        display: flex;
                        gap: 15px;
                        margin: 15px 0;
                        flex-wrap: wrap;
                        }
                        .legend-item {
                        display: flex;
                        align-items: center;
                        gap: 8px;
                        font-size: 12px;
                        }
                        .legend-color {
                        width: 20px;
                        height: 20px;
                        border-radius: 4px;
                        border: 2px solid #ddd;
                        }
                        .stats {
                        display: grid;
                        grid-template-columns: repeat(3, 1fr);
                        gap: 10px;
                        margin-bottom: 20px;
                        }
                        .stat-card {
                        background: white;
                        padding: 15px;
                        border-radius: 6px;
                        text-align: center;
                        border: 2px solid #e0e0e0;
                        }
                        .stat-value {
                        font-size: 24px;
                        font-weight: bold;
                        color: #667eea;
                        }
                        .stat-label {
                        font-size: 11px;
                        color: #666;
                        margin-top: 5px;
                        }
                        */


                        .stats {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 20px; /* space between cards */
                        margin-bottom: 30px; /* space below the stat section */
                        justify-content: space-between; /* spread cards nicely */
                        }

                        .stat-card {
                        flex: 1 1 calc(25% - 20px); /* 4 cards per row with gap */
                        background: white;
                        padding: 20px;
                        border-radius: 8px;
                        text-align: center;
                        border: 1px solid #e0e0e0;
                        }

                        .stat-value {
                        font-size: 28px;
                        font-weight: bold;
                        color: #667eea;
                        }

                        @media (max-width: 992px) {
                        .stat-card {
                        flex: 1 1 calc(50% - 20px); /* 2 cards per row on medium screens */
                        }
                        }

                        @media (max-width: 576px) {
                        .stat-card {
                        flex: 1 1 100%; /* 1 card per row on small screens */
                        }
                        }




                        .student-item {
                        background: white;
                        padding: 12px;
                        margin-bottom: 10px;
                        border-radius: 6px;
                        border: 2px solid #e0e0e0;
                        cursor: pointer;
                        transition: all 0.3s;
                        }
                        .student-item:hover {
                        border-color: #667eea;
                        transform: translateX(5px);
                        }
                        .student-item.selected {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        border-color: #667eea;
                        }
                        .student-item.assigned {
                        background: #e8f5e9;
                        border-color: #4caf50;
                        opacity: 0.6;
                        }
                        .student-name {
                        font-weight: 600;
                        font-size: 14px;
                        margin-bottom: 4px;
                        }


                        .action-buttons{
                        display: flex;
                        gap: 10px;
                        margin-top: 20px;
                        }
                        .btn {
                        padding: 12px 24px;
                        border: none;
                        border-radius: 6px;
                        font-size: 14px;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.3s;
                        }
                        .btn-primary {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        flex: 1;
                        }
                        .btn-success {
                        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                        color: white;
                        flex: 1;
                        }
                        .btn-danger {
                        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
                        color: white;
                        }
                        .btn:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                        }




                        </style>        


                        <div class="content-wrapper">
                        <section class="content-header">
                        <h1>
                        <i class="fa fa-mortar-board"></i> <?php echo $this->lang->line('select'); ?> <small></small></h1>
                        </section>

                        <form id="form" action="<?php echo site_url('semester/set_seatingarrangement/') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <section class="content">
                        <div class="row">

                        <div class="col-md-12">
                        <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        </div>

                        <div class="box-body">

                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="row">

                        <input id="cl_cap_id" name="cl_cap_id"  placeholder="Class Room Type Id" type="hidden" value="" class="form-control" />  


                        <div class="col-sm-6 col-lg-3 col-md-3 col20">
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('building'); ?></label>
                        <select name="sethall_cap_building" id="sethall_cap_building" class="form-control" onchange="get_floor(this.value)" >
                        <option value="">Select Building</option>
                        <?php
                        foreach($buildinglist as $build)
                        {
                        ?>
                        <option value="<?php echo  $build['build_id']; ?>"<?php if(set_value('sethall_cap_building')==$build['build_id']) { echo "selected=selected"; }        ?> ><?php echo  $build['build_name']; ?> </option>
                        <?php 
                        }
                        ?>
                        </select> 
                        </div>
                        </div>


                        <div class="col-sm-6 col-lg-3 col-md-3 col20">
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('floor'); ?></label>

                        <select name="sethall_build_floor" id="sethall_build_floor" class="form-control" onchange="get_classtype(this.value)"  >
                        <option></option>            
                        </select> 
                        </div>
                        </div>



                        <div class="col-sm-6 col-lg-3 col-md-3 col20">
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class').'&nbsp;'.$this->lang->line('type'); ?></label>

                        <select name="sethall_classroom_types" id="sethall_classroom_types" class="form-control" onchange="get_roomtype(this.value)" >
                        <option></option>            
                        </select> 
                        </div>
                        </div>



                        <div class="col-sm-6 col-lg-3 col-md-3 col20">
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('Room').'&nbsp;'.$this->lang->line('type'); ?></label>

                        <select name="sethall_room_types" id="sethall_room_types" class="form-control"  onchange="get_roomno()"  >
                        <option></option>            
                        </select>
                        </div>
                        </div>


                        <div class="col-sm-6 col-lg-3 col-md-3 col20">
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('room_no'); ?></label>

                        <select name="sethall_room_no" id="sethall_room_no" class="form-control"  >
                        <option></option>            
                        </select> 
                        </div>
                        </div>




                        <div class="stats row">
                        <div class="col-md-3 col-sm-6 mb-3 stat-card">
                        <div class="card shadow-sm">
                        <div class="card-body">
                        <h3 class="card-title mb-2 stat-value" id="total_capacity" name="total_capacity">0</h3>
                        <p class="card-text text-muted">Total Capacity</p>
                        </div>
                        </div>
                        </div>

                        <div class="col-md-3 col-sm-6 mb-3 stat-card">
                        <div class="card shadow-sm">
                        <div class="card-body">
                        <h3 class="card-title mb-2 stat-value" id="assignedCount">0</h3>
                        <p class="card-text text-muted">Assigned</p>
                        </div>
                        </div>
                        </div>

                        <div class="col-md-3 col-sm-6 mb-3 stat-card">
                        <div class="card shadow-sm">
                        <div class="card-body">
                        <h3 class="card-title mb-2 stat-value" id="availableCount">0</h3>
                        <p class="card-text text-muted">Available</p>
                        </div>
                        </div>
                        </div>

                        <div class="col-md-3 col-sm-6 mb-3 stat-card">
                        <div class="card shadow-sm">
                        <div class="card-body">
                        <h3 class="card-title mb-2 stat-value" id="studentCount"><?php echo isset($get_total_count) ? $get_total_count : 0; ?></h3>
                        <p class="card-text text-muted">Students</p>
                        </div>
                        </div>
                        </div>
                        </div>

                        <br>










                        <div class="box-body">

                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="row">


                        <div class="col-sm-6 col-lg-2 col-md-2 col15">
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label>
                        <select name="program_type" id="program_type" class="form-control" >
                        <option value=""><?php echo $this->lang->line('type'); ?></option>

                        <?php
                        foreach($Programmetype_list as $prog_type)
                        {
                        ?>
                        <option value="<?php echo  $prog_type['prog_type_id']; ?>"<?php if(set_value('program_type')==$prog_type['prog_type_id']) { echo "selected=selected"; }        ?> ><?php echo  $prog_type['prog_type_name']; ?> </option>
                        <?php 
                        }
                        ?>
                        </select>
                        </div>
                        </div>

                        <div class="col-sm-6 col-lg-2 col-md-2 col15">
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?></label>
                        <select name="programe" id="programe" class="form-control">
                        <option></option>
                        </select> 

                        <span class="text-danger"><?php echo form_error('programe'); ?></span>
                        </div>
                        </div>



                        <div class="col-sm-6 col-lg-2 col-md-2 col15">
                        <div class="form-group">
                        <label for="exampleInputEmail1">Batch Group</label> 

                        <select name="batch_group" id="batch_group" class="form-control" >
                        <option value="">Select Batch</option>

                        <?php
                        foreach($batch_group as $batch)
                        {
                        ?>
                        <option value="<?php echo  $batch['batch_group_id']; ?>"<?php if(set_value('batch_group')==$batch['batch_group_id']) { echo "selected=selected"; }        ?> ><?php echo  $batch['batch_group_name'].'&nbsp;&nbsp;'.$batch['batch_group_year']; ?> </option>
                        <?php 
                        }
                        ?>
                        </select> 
                        </div>
                        </div>


                        <div class="col-sm-6 col-lg-2 col-md-2 col15">
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?><small class="req"> *</small></label>

                        <select name="semester_semtype" id="semester_semtype" class="form-control" >
                        <option value=""><?php echo $this->lang->line('semester_type'); ?></option>
                        <?php
                        foreach($semestertype_list as $sem_type)
                        {
                        ?>
                        <option value="<?php  echo $sem_type['st_id'];  ?>"

                        <?php
                        if(set_value('semester_type')==$sem_type['st_id'])
                        {
                        echo "selected=selected";
                        }
                        ?>
                        ><?php  echo $sem_type['st_name'];  ?></option>
                        <?php } ?>
                        </select>
                        </div>
                        </div>

                        


                        <div class="col-sm-6 col-lg-2 col-md-2 col15">

                        <input type="text" name="sem_group_id" id="sem_group_id" value="" class="form-control" >
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?></label>

                        <select name="semester_term" id="semester_term" class="form-control" >
                        <option value="">Select Semester</option>

                        <?php
                        foreach($semester_term as $term)
                        {
                        ?>
                        <option value="<?php echo  $term['stm_id']; ?>"<?php if(set_value('semester_term')==$term['stm_id']) { echo "selected=selected"; }        ?> ><?php echo  $term['stm_name']; ?> </option>
                        <?php 
                        }
                        ?>
                        </select> 
                        </div>
                        </div> 



                        <div class="col-sm-6 col-lg-2 col-md-2 col15">                     
                        <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo $this->lang->line('subjects'); ?></label>
                        <select name="subjects" id="subjects" class="form-control" >
                        <option value="">Select Subjects</option>                      
                        </select>
                        </div>
                        </div> 


                        <br>
                        <br>
                        <br>


                        <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('search'); ?></button>
                        </div>


                        <div class="col-md-6">
                        <div class="students-panel">
                        <h3>
                        <span>👨‍🎓 Students List</span>

                        <!-- <span id="studentCountBadge" style="background: #667eea; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px;">0</span> -->
                        </h3>

                        <div class="action-buttons">
                        <input type="text" id="searchStudent" placeholder="🔍 Search student by name or roll number...">
                        </div>
                        <br> 


                        <div id="studentsList">
                        <?php if (!empty($students))
                        {
                        ?>       


                        <div class="action-buttons">
                        <button class="btn btn-primary" onclick="autoAssign()">🔄 Auto Assign</button>
                        </div>

                        <div class="action-buttons">
                        <button class="btn btn-success" onclick="saveAllocation()">💾 Save</button>
                        <button class="btn btn-danger" onclick="clearAll()">🗑️ Clear</button>
                        </div>
                        <br>
                        <br>
                        <?php

                        foreach ($students as $stud) { ?>
                        <div class="student-item">
                        <div class="student-name">
                        <?php echo $stud['firstname'] . ' ' . $stud['middlename'] . ' ' . $stud['lastname']; ?>
                        </div>
                        <div class="student-roll">
                        <?php echo $stud['admission_no']; ?>
                        </div>
                        </div>

                        <?php 
                        } 
                        } 
                        else 
                        { 
                        ?>
                        <p>No students found.</p>
                        <?php
                        }
                        ?>
                        </div>
                        </div>






                        </div>




                        </div>








                        </div>
                        </div> 
                        </div> 
                        </section>
                        </form>


                        <script>  
                        $(document).ready(function() 
                        { 
                        $('#programe, #batch_group, #semester_semtype,#semester_term').change(function() 
                        {                               
                        $('#sem_group_id').val('');    
                        var prog      = $('#programe').val();
                        var bat       = $('#batch_group').val();
                        var sem       = $('#semester_semtype').val(); 
                        var sem_term  = $('#semester_term').val();                 

                        if( prog && bat && sem && sem_term) {                           
                        $.ajax({
                        url: '<?php echo site_url('semester_activities/teacher_subject_assignments/get_sem_group_id'); ?>',
                        type: 'POST',
                        data: { 
                        prog     : prog,
                        bat      : bat,
                        sem      : sem,
                        sem_term : sem_term,

                        },
                        success: function(response) 
                        {
                        var res = JSON.parse(response);  // Convert string to object
                        console.log(res.sem_group_id);   // Should log "42"
                        $('#sem_group_id').val(res.sem_group_id); 
                        var sem_group_id = $('#sem_group_id').val();
                        var sel_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';                     



                        $.ajax({
  url: '<?php echo site_url('semester/set_seatingarrangement/get_assigned_subjects'); ?>',
  type: 'POST',
  data: { sem_group_id: sem_group_id },
  success: function(response2) {
    console.log("Raw response:", response2);

    // Clear and reset dropdown first
    $('#subjects').empty().append('<option value="">Select Subjects</option>');

    // Check if sem_group_id is empty or invalid
    if (!sem_group_id || sem_group_id.trim() === '') {
      console.warn("⚠️ sem_group_id is empty — clearing subject list");
      return; // Stop here — don't continue
    }

    // Parse JSON safely
    let res2;
    try {
      res2 = JSON.parse(response2);
    } catch (e) {
      console.error("JSON parse error:", e);
      alert("Invalid response format from server");
      return;
    }

    // If no subjects found, keep only the default option
    if (!res2 || res2.length === 0) {
      console.warn("⚠️ No subjects found for this sem_group_id");
      return;
    }

    // Build new options
    let sel_data = '';
    $.each(res2, function(i, obj) {
      sel_data += '<option value="' + obj.id + '">' + obj.name + '</option>';
    });

    // Append subjects
    $('#subjects').append(sel_data);
    alert("Subjects loaded successfully!");
  },
  error: function(xhr, status, error) {
    console.error("Second AJAX error:", error);
    $('#subjects').empty().append('<option value="">Select Subjects</option>');
  }
});



                         console.log("➡ Sending second AJAX with sem_group_id:", res.sem_group_id);
                        }
                        });                    

                                               
                        }
                        });
                        });                       

                        
                        
                        
                        


                        function get_floor(cl_building_id) 
                        { 
                        $('#sethall_build_floor').html("");
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                        url: "<?php echo base_url('semester/set_room_allocation/getFloorsByBuilding'); ?>", 
                        type: "POST",
                        data: {cl_building_id: cl_building_id},
                        dataType: 'json',
                        success: function(data) 
                        {        

                        $.each(data, function (i, obj)
                        {
                        div_data += "<option value=" + obj.floor_id + ">" + obj.floor_name + "</option>";
                        });

                        $('#sethall_build_floor').append(div_data);

                        }
                        });
                        }




                        function get_classtype(cl_floor_id)
                        { 
                        var building_bl   =   $('#sethall_cap_building').val();
                        $('#sethall_classroom_types').html("");
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                        url: "<?php echo base_url('semester/set_room_allocation/getclasstypeByFloor'); ?>", 
                        type: "POST",
                        data: {cl_floor_id: cl_floor_id,building_bl:building_bl},
                        dataType: 'json',
                        success: function(data) 
                        {        

                        $.each(data, function (i, obj)
                        {
                        div_data += "<option value=" + obj.cls_roomtype_id + ">" + obj.cls_roomtype_name + "</option>";
                        });

                        $('#sethall_classroom_types').append(div_data);

                        }
                        });
                        }


                        function get_roomtype(cl_clstype)
                        {
                        var sethall_build_floor    =   $('#sethall_build_floor').val();
                        var sethall_cap_building   =   $('#sethall_cap_building').val();

                        $('#sethall_room_types').html("");
                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                        url: "<?php echo base_url('semester/set_room_allocation/getroomtypeByclass'); ?>", 
                        type: "POST",
                        data: {cl_clstype: cl_clstype,sethall_cap_building:sethall_cap_building,sethall_build_floor:sethall_build_floor},
                        dataType: 'json',
                        success: function(data) 
                        { 
                        $.each(data, function (i, obj)
                        {
                        div_data += "<option value=" + obj.roomtype_id  + ">" + obj.roomtype_name + "</option>";
                        });

                        $('#sethall_room_types').append(div_data);
                        }
                        });
                        }


                        function get_roomno()
                        {
                        var pl_building         =   $('#sethall_cap_building').val();
                        var pl_build_floor      =   $('#sethall_build_floor').val();  
                        var pl_classroom_types  =   $('#sethall_classroom_types').val();
                        var pl_room_types       =   $('#sethall_room_types').val();

                        $('#sethall_room_no').html("");

                        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
                        $.ajax({
                        url: "<?php echo base_url('semester/set_room_allocation/fetchAllRooms'); ?>", 
                        type: "POST",
                        data: {pl_building:pl_building,pl_build_floor:pl_build_floor,pl_classroom_types:pl_classroom_types,pl_room_types:pl_room_types},
                        dataType: 'json',
                        success: function(data) 
                        {       

                        $.each(data, function (i, obj)
                        {
                        div_data += "<option value=" + obj.cl_cap_room_number  + ">" + obj.cl_cap_room_number + "</option>";
                        });

                        $('#sethall_room_no').append(div_data);
                        }
                        });
                        } 



                        $('#sethall_cap_building, #sethall_build_floor, #sethall_classroom_types, #sethall_room_types,#sethall_room_no').change(function() {
                        // Get selected values
                        var cl_cap_building    = $('#sethall_cap_building').val();
                        var cl_build_floor     = $('#sethall_build_floor').val();
                        var cl_classroom_types = $('#sethall_classroom_types').val();
                        var  cl_room_types     = $('#sethall_room_types').val(); 
                        var  sethall_room_no   = $('#sethall_room_no').val();              

                        // Make sure all dropdowns have values before sending
                        if (cl_cap_building && cl_room_types && cl_classroom_types && cl_build_floor && sethall_room_no) {
                        $.ajax({
                        url: '<?php echo base_url("semester/set_room_allocation/get_totalcapacity"); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                        cl_cap_building   : cl_cap_building,
                        cl_room_types     : cl_room_types,
                        cl_classroom_types: cl_classroom_types,
                        cl_build_floor    : cl_build_floor,
                        sethall_room_no   : sethall_room_no
                        },
                        success: function(response)
                        {
                        if (response) {
                        // Assuming your response contains capacity value
                        $('#total_capacity').text(response.cl_cap_capacity);
                        } else {
                        alert("No capacity found!");
                        $('#total_capacity').text('');
                        }

                        },
                        error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("Error fetching capacity.");
                        }
                        });
                        }
                        });  




                        $(document).ready(function()
                        {
                        $('#program_type').change(function()
                        { 
                        var prog_type_id = $(this).val();
                        if(prog_type_id != ''){
                        $.ajax({
                        url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
                        method: "POST",
                        data: { prog_type_id: prog_type_id },
                        dataType: "json",
                        success: function(data){
                        $('#programe').empty();
                        $('#programe').append('<option value=""><?php echo $this->lang->line("select"); ?></option>');
                        $.each(data, function(key, value){
                        $('#programe').append('<option value="'+ value.id +'">'+ value.p_name +'</option>');
                        });
                        }
                        });
                        } else {
                        $('#programe').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
                        }
                        });
                        });                        
                        </script>











