
  <style>
  body { background: #f5f6f8; }
  .arrange-card { background:#fff; border-radius:10px; box-shadow: 0 1px 3px rgba(0,0,0,.08); padding:16px; }

            .tabs {
            display: flex;
            background: #f5f5f5;
            border-bottom: 2px solid #ddd;
            }

            .tab {
            flex: 1;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            background: #f5f5f5;
            border: none;
            /* font-size: 1.1rem; */
            font-weight: 600;
            color: #666;
            transition: all 0.3s;
            }

            .tab.active {
            background: white;
            color: #667eea;
            border-bottom: 3px solid #667eea;
            }

            .tab:hover {
            background: #e8e8e8;
            }

            .tab-content {
            display: none;
            padding: 30px;
            }

            .tab-content.active {
            display: block;
            }

            .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
            }

            .form-group {
            display: flex;
            flex-direction: column;
            }

            label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            }

            select, input {
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            /* font-size: 1rem; */
            transition: border 0.3s;
            }

            select:focus, input:focus {
            outline: none;
            border-color: #667eea;
            }

            .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            /* font-size: 1rem; */
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-right: 10px;
            }

            .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            }

            .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            }

            .btn-secondary {
            background: #f0f0f0;
            color: #333;
            }

            .btn-secondary:hover {
            background: #e0e0e0;
            }

            .allocation-result {
            margin-top: 30px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            display: none;
            }

            .allocation-result.show {
            display: block;
            }

            .seat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
            gap: 10px;
            margin-top: 20px;
            }

            .seat {
            aspect-ratio: 1;
            border: 2px solid #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
            /* font-size: 0.9rem; */
            }

            .seat.available {
            background: #e8f5e9;
            border-color: #4caf50;
            color: #2e7d32;
            }

            .seat.assigned, .seat.occupied {
            background: #fff3e0;
            border-color: #ff9800;
            color: #e65100;
            }

            .seat.selected {
            background: #667eea;
            border-color: #667eea;
            color: white;
            transform: scale(1.1);
            }

            .seat.blocked {
            background: #ffebee;
            border-color: #f44336;
            color: #c62828;
            cursor: not-allowed;
            }

            .legend {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
            }

            .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            }

            .legend-box {
            width: 30px;
            height: 30px;
            border-radius: 5px;
            border: 2px solid;
            }

            .info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            }

            .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
            }

            .info-item {
            background: rgba(255,255,255,0.2);
            padding: 15px;
            border-radius: 8px;
            }

            .info-label {
            /* font-size: 0.9rem; */
            opacity: 0.9;
            }

            .info-value {
            /* font-size: 1.3rem; */
            font-weight: 700;
            margin-top: 5px;
            }

            .student-list {
            max-height: 400px;
            overflow-y: auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            }

            .student-item {
            padding: 10px;
            margin-bottom: 10px;
            /* background: #f5f5f5; */
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
            }

            .student-item.assigned {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
            }

            /* Selected item styling to match legend color */
            .student-item.selected {
            background: #667eea;
            color: #ffffff;
            border-left: 4px solid #667eea;
            }
            .student-item.selected .seat-number,
            .student-item.selected strong { color: #ffffff; }

            .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            }

            .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border-left: 4px solid #4caf50;
            }

            .alert-warning {
            background: #fff3e0;
            color: #e65100;
            border-left: 4px solid #ff9800;
            }



            .seat-btn { 
            display:flex; align-items:center; justify-content:center;
            border:2px solid #ddd; border-radius:6px; aspect-ratio:1;
            font-weight:600; font-size:0.75rem; cursor:pointer;
            }
            .seat-btn.assigned { background:#fff3e0; border-color:#ff9800; color:#e65100; }
            .seat-btn.selected  { background:#667eea; border-color:#667eea; color:#fff; }


            .student-seat { display: none; }

            .student-info strong { flex: 1 1 auto; min-width: 0; }
            .seat-number { flex: 0 0 auto; }
            </style>




            <div class="content-wrapper">

            <section class="content-header">
            <h1>
            <i class="fa fa-usd"></i> <?php echo  $this->lang->line('add').'&nbsp;'.$this->lang->line('semester'); ?></h1>
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="col-md-12">
            <?php
            $this->load->view('layout/topbar'); ?>
            </div>
            &nbsp;


            <div class="row">
            <div class="">
            <header>
            <h1>🎓 Seat Allocation System</h1>
            <p>Automatic & Manual Seat Assignment</p>
            </header>

            <div class="tabs">
            <button class="tab active" onclick="switchTab('automatic')">⚡ Automatic Allocation</button>
            <button class="tab" onclick="switchTab('manual')">✋ Manual Allocation</button>
            </div>

            <!-- Automatic Allocation Tab -->
            <div id="automatic" class="tab-content active">
            <h2 style="margin-bottom: 20px; color: #667eea;">⚡ Automatic Seat Allocation</h2>


            <div class="form-grid">               
   
            <!-- <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label>
            <select name="program_type_auto" id="program_type_auto"  >
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


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?></label>
            <select name="programe_auto" id="programe_auto" >
            <option></option>
            </select> 
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('batch_group'); ?><small class="req"> *</small></label>        

            <select name="batch_group_auto" id="batch_group_auto" >
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



            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?><small class="req"> *</small></label>
          

            <select name="semester_semtype_auto" id="semester_semtype_auto"  >
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
            </div> -->




          <div class="form-group">
          <label>Program Type / Program <small class="req">*</small></label> 
          <?php echo render_program_dropdown($program_types, $programs, set_value('program')); ?>
          <span class="text-danger"><?php echo form_error('program'); ?></span>
          </div>

        
          <div class="form-group">
          <label>Semester / Batch / Term <small class="req">*</small></label>      
          <?php
          echo render_semester_dropdown($semesters_batches, set_value('semester'));
          ?>
          </div> 


            <div class="form-group">
            <label>Group</label>
            <select id="auto-group">
            <option value="">Select Group</option>
            </select>
            </div> 

            <div class="form-group">
            <label>Term</label>
            <select id="auto-term" onchange="loadSubjects('auto')">
            <option value="">Select Term</option>
            <option value="1">Mid Term 1</option>
            <option value="2">Mid Term 2</option>
            <option value="3">End Semester</option>
            </select>
            </div>


            <div class="form-group">
            <label>Subject</label>
            <select id="auto-subject" onchange="loadRooms('auto')">
            <option value="">Select Subject</option>
            </select>
            </div>


            <div class="form-group">
            <label>Building</label>
            <select id="auto-building" onchange="loadFloors('auto')">
            <option value="">Select Building</option>
            <option value="1">Main Block</option>
            <option value="2">Science Block</option>
            <option value="3">Admin Block</option>
            </select>
            </div>

            <div class="form-group">
            <label>Floor</label>
            <select id="auto-floor" onchange="loadRoomsByFloor('auto')">
            <option value="">Select Floor</option>
            </select>
            </div>

            <div class="form-group">
            <label>Room Type</label>
            <select id="auto-roomtype">
            <option value="">All Room Types</option>
            <option value="1">Single Bench</option>
            <option value="2">Normal Hall</option>
            <option value="3">Lab</option>
            <option value="4">Auditorium</option>
            </select>
            </div>

            <div class="form-group">
            <label>Exam Date</label>
            <input type="date" id="auto-date">
            </div>
            </div>

            <div style="margin-top: 20px;">
            <button class="btn btn-primary" onclick="autoAllocate()">⚡ Auto Allocate Seats</button>
            <button class="btn btn-secondary" onclick="resetForm('auto')">🔄 Reset</button>
            </div>

            <div id="auto-result" class="allocation-result">
            <!-- Results will be shown here -->
            </div>
            </div>

            <!-- Manual Allocation Tab -->
            <div id="manual" class="tab-content">
            <h2 style="margin-bottom: 20px; color: #667eea;">✋ Manual Seat Allocation</h2>

            <form id="form" action="<?php echo site_url('semester/set_seatingarrangement') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">

          <div class="form-grid">
        
          <div class="form-group">
          <label>Program Type / Program <small class="req">*</small></label> 
          <?php echo render_program_dropdown($program_types, $programs, set_value('program')); ?>
          <span class="text-danger"><?php echo form_error('program'); ?></span>
          </div>

        
          <div class="form-group">
          <label>Semester / Batch / Term <small class="req">*</small></label>      
          <?php
          echo render_semester_dropdown($semesters_batches, set_value('semester'));
          ?>
          </div>
          <input type="hidden" name="sem_group_id" id="sem_group_id" value="<?php echo set_value('sem_group_id', isset($sem_group_id) ? $sem_group_id : ''); ?>" class="form-control" >


            <?php /* ?>
            <div class="form-group">             

            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee_type'); ?></label>
            <select name="program_type" id="program_type" >
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



            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('programee'); ?></label>
            <select name="programe" id="programe" >
            <option></option>
            </select> 
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('batch'); ?></label>
            <select name="batch_group" id="batch_group"  >
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



            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?><small class="req"> *</small></label>
            <select name="semester_semtype" id="semester_semtype"  >
            <option value=""><?php echo $this->lang->line('semester_type'); ?></option>
            <?php
            foreach($semestertype_list as $sem_type)
            {
            ?>
            <option value="<?php  echo $sem_type['st_id'];  ?>"

            <?php
            if(set_value('semester_semtype')==$sem_type['st_id'])
            {
            echo "selected=selected";
            }
            ?>
            ><?php  echo $sem_type['st_name'];  ?></option>
            <?php } ?>
            </select>
            </div>


            <input type="hidden" name="sem_group_id" id="sem_group_id" value="<?php echo set_value('sem_group_id', isset($sem_group_id) ? $sem_group_id : ''); ?>" class="form-control" >



            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('semester'); ?></label>
            <select name="semester_term" id="semester_term" >
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

            <?php */ ?>





            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('subjects'); ?></label>
            <select name="subjects" id="subjects" class="form-control"  >
            <option value="">Select Subjects</option>                      
            </select>
            </div>


            <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $this->lang->line('room'); ?></label>
            <select name="seat_select" id="seat_select" class="form-control"  required>
            <option value="">-- Select Seat / Room --</option>
            <?php 
            $current_building = '';
            foreach ($get_seat_list as $seat) {
            // When the building name changes, close the previous optgroup and start a new one
            if ($current_building != $seat['build_name']) {
            if ($current_building != '') {
            echo '</optgroup>';
            }
            echo '<optgroup label="' . htmlspecialchars($seat['build_name']) . '">';
            $current_building = $seat['build_name'];
            }

            $label = $seat['floor_name'] . ' - ' .
            $seat['cl_cap_room_number'] . ' (' .
            $seat['cls_roomtype_name'] . ' / ' .
            $seat['roomtype_name'] . ') - Capacity: ' .
            $seat['cl_cap_capacity'];
            ?>
            <?php 
            $prevRoom = set_value('seat_select', isset($seat_select) ? (string)$seat_select : '');
            $isSelected = ((string)$prevRoom === (string)$seat['cl_cap_id']) ? ' selected="selected"' : '';
            ?>
            <option value="<?php echo $seat['cl_cap_id']; ?>"
            data-roomtype="<?php echo htmlspecialchars($seat['cls_roomtype_name']); ?>"<?php echo $isSelected; ?>>
            <?php echo $label; ?>
            </option>
            <?php } 
            if ($current_building != '') {
            echo '</optgroup>';
            }
            ?>
            </select>
            </div>          
            </div>


            <div style="margin-top: 20px;">                
            <button  type="submit" name="submit" class="btn btn-primary" onclick="stayOnManualTab()" >📋 Load Room Layout</button>
            <button class="btn btn-secondary" onclick="resetForm('manual')">🔄 Reset</button>                
            </div>
            </form>
            <br>
            <?php

            $capacity = $get_seat_count['cl_cap_capacity']; 

            if(!empty($capacity))
            {

            ?>

            <div id="manual-result001" class="allocation-result001">
            <!-- Manual allocation interface will be shown here -->

            <div class="alert alert-warning">
            <i class="fa fa-exclamation"></i> Click on seats to assign students. Selected student: <strong id="current-student">Student Name</strong>
            </div>


            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">


            <div>
            <h3>Room Layout - Room 101</h3>


            <div class="legend">
            <div class="legend-item">
            <div class="legend-box available" style="background: #e8f5e9; border-color: #4caf50;"></div>
            <span>Available</span>
            </div>
            <div class="legend-item">
            <div class="legend-box assigned" style="background: #fff3e0; border-color: #ff9800;"></div>
            <span>Assigned</span>
            </div>
            <div class="legend-item">
            <div class="legend-box selected" style="background: #667eea; border-color: #667eea;"></div>
            <span>Selected</span>
            </div>
            </div>


            <div class="seat-grid">
            <?php
            $capacity = $get_seat_count['cl_cap_capacity']; 
            for ($i = 1; $i <= $capacity; $i++) {
            $seat_label = 'A' . $i;
            echo '<div class="seat available" data-seat="'.$seat_label.'" onclick="assignSeat(this)">'.
            $seat_label.'</div>';
            }
            ?>
            </div>
            </div>

            <?php } else { echo "No Seats Found";} ?>

            <div>
            <h3>Students List</h3>

            <div class="student-list"> 

            <div class="student-item assigned">
            <?php 
            if (!empty($students)) {
            $idx = 0;
            foreach ($students as $stud) { ?>
            <div class="student-item"
            data-student-index="<?php echo $idx; ?>"
            data-student-id="<?php echo htmlspecialchars($stud['id']); ?>"
            onclick="selectStudent(<?php echo $idx; ?>)">
            <div class="student-info">
            <strong><?php echo $stud['firstname'].' '.$stud['middlename'].' '.$stud['lastname']; ?></strong>
            <span class="seat-number" id="student-seat-<?php echo $idx; ?>"> - </span>
            </div>
            </div>
            <?php $idx++; } } ?>
            </div>
            </div>
            </div>


            </div>
            <br>

            <button type="button" class="btn btn-success" onclick="saveAllocations()">💾 Save Allocations</button>
            <!-- <button class="btn btn-primary" style="width: 100%; margin-top: 15px;" onclick="saveManualAllocation()">💾 Save Allocation</button> -->
            </div>
            </div>
            </div>
            </div>
            </div>
            
            <script>


            // let selectedSeats = [];
            // let currentStudentIndex = 0;

            // function switchTab(tabName) {
            // document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            // document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

            // event.target.classList.add('active');
            // document.getElementById(tabName).classList.add('active');                
            // } 



            function switchTab(tabName)
             {
            // Remove active class from all tabs and contents
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

            // Activate the selected tab
            event.target.classList.add('active');
            document.getElementById(tabName).classList.add('active');

            // Save the active tab in localStorage
            localStorage.setItem('activeTab', tabName);
            }

            // Restore the active tab when the page reloads
            window.addEventListener('DOMContentLoaded', () => {
            const activeTab = localStorage.getItem('activeTab') || 'automatic'; // default tab
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

            document.querySelector(`.tab[onclick*="${activeTab}"]`)?.classList.add('active');
            document.getElementById(activeTab)?.classList.add('active');
            });

            // Optional: ensure we stay on Manual tab after submit
            function stayOnManualTab() {
            localStorage.setItem('activeTab', 'manual');
            }

            function resetForm(mode) 
            {
            document.querySelectorAll(`#${mode} select`).forEach(select => {
            select.selectedIndex = 0;
            });
            document.querySelectorAll(`#${mode} input`).forEach(input => {
            input.value = '';
            });
            document.getElementById(`${mode}-result`).classList.remove('show');
            currentStudentIndex = 0;
            }



            $(document).ready(function() 
            { 
            $('#program, #semester').change(function() 
            {  

                    $('#sem_group_id').val('');

                    var program_id = $('#program').val();      // e.g. 2
                    var semester_value = $('#semester').val(); // e.g. 16|1|1

                    if (!program_id || !semester_value) {
                    return;
                    }

                    // Split semester value
                    var parts = semester_value.split('|');
                    var semester_type_id = parts[0]; // 16
                    var batch_id         = parts[1]; // 1
                    var semester_term_id = parts[2]; // 1



            if( program_id && semester_value ) {                           
            $.ajax({
            url: '<?php echo site_url('semester_activities/teacher_subject_assignments/get_sem_group_id'); ?>',
            type: 'POST',
            data: { 
            prog     : program_id,
            bat      : batch_id,
            sem      : semester_type_id,
            sem_term : semester_term_id},

            success: function(response) 
            {
            var res = JSON.parse(response);  // Convert string to object
            console.log(res.sem_group_id);   // Should log "42"
            $('#sem_group_id').val(res.sem_group_id); 
            var sem_group_id = $('#sem_group_id').val();
            var sel_data     = '<option value=""><?php echo $this->lang->line('select'); ?></option>';  

            $.ajax({
            url: '<?php echo site_url('semester/set_seatingarrangement/get_assigned_subjects'); ?>',
            type: 'POST',
            data: { sem_group_id: sem_group_id },
            
            success: function(response2) {
              
            console.log("Raw response:", response2);

            // Check if sem_group_id is empty or invalid BEFORE clearing
            if (!sem_group_id || (typeof sem_group_id === 'string' && sem_group_id.trim() === '')) {
              console.warn("⚠️ sem_group_id is empty — not changing subject list");
              return; // keep current list visible; do not clear
            }

            // Now clear and reset dropdown
            $('#subjects').empty().append('<option value="">Select Subjects</option>');

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

            // Restore previously selected subject (from POST or controller)
            const prevSubject = "<?php echo set_value('subjects', isset($subject_id) ? (string)$subject_id : ''); ?>";
            if (prevSubject) {
              $('#subjects').val(prevSubject).trigger('change');
            }
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
            
            
            /*

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

            // Check if sem_group_id is empty or invalid BEFORE clearing
            if (!sem_group_id || (typeof sem_group_id === 'string' && sem_group_id.trim() === '')) {
              console.warn("⚠️ sem_group_id is empty — not changing subject list");
              return; // keep current list visible; do not clear
            }

            // Now clear and reset dropdown
            $('#subjects').empty().append('<option value="">Select Subjects</option>');

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

            // Restore previously selected subject (from POST or controller)
            const prevSubject = "<?php echo set_value('subjects', isset($subject_id) ? (string)$subject_id : ''); ?>";
            if (prevSubject) {
              $('#subjects').val(prevSubject).trigger('change');
            }
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
            */




          /*
            var old_program_type  = "<?php echo set_value('program_type'); ?>";
            var old_programe      = "<?php echo set_value('programe'); ?>";

            $(document).ready(function()
            {
            function loadProgrames(prog_type_id, selected_programe = '') {
            if(prog_type_id != '') {
            $.ajax({
            url: "<?php echo base_url('semester/Assignsubjects/getpgm_by_pgmtype'); ?>",
            method: "POST",
            data: { prog_type_id: prog_type_id },
            dataType: "json",
            success: function(data) { 
            $('#programe').empty();
            $('#programe').append('<option value=""><?php echo $this->lang->line("select"); ?></option>');
            $.each(data, function(key, value) { 
            var selected = (value.id == selected_programe) ? 'selected' : '';
            $('#programe').append('<option value="'+ value.id +'" '+selected+'>'+ value.p_name +'</option>');
            });
            }
            });
            } else {
            $('#programe').html('<option value=""><?php echo $this->lang->line("select"); ?></option>');
            }
            }

            // On page load: populate programe if old_program_type exists
            if(old_program_type != '') {
            $('#program_type').val(old_program_type);
            loadProgrames(old_program_type, old_programe);
            }
            // On change: load programe dynamically
            $('#program_type').change(function() {
            var prog_type_id = $(this).val();
            loadProgrames(prog_type_id);
            });
            });
            */






            
            let selectedStudent = null;
            let seatAssignments = {}; // student_id => seat_label
            let seatToStudent = {};   // seat_label => student_id  (reverse lookup)

            // Preload existing allocations from backend and mark UI
            (function preloadExistingAllocations(){
              try {
                const existingAllocations = <?php echo json_encode(isset($existing_allocations) ? $existing_allocations : []); ?>;
                if (Array.isArray(existingAllocations)) {
                  existingAllocations.forEach(function(row){
                    const studentId = String(row.studallot_stud_id);
                    const seatLabel = String(row.studallot_seat_label);

                    // Populate maps
                    seatAssignments[studentId] = seatLabel;
                    seatToStudent[seatLabel] = studentId;

                    // Mark seat as occupied with a tick
                    const seatDiv = document.querySelector('.seat[data-seat="' + seatLabel + '"]');
                    if (seatDiv) {
                      seatDiv.classList.remove('available');
                      seatDiv.classList.add('occupied');
                      seatDiv.textContent = seatLabel + ' ✅';
                    }

                    // Update student list badge if the student is present in the list
                    const studentDiv = document.querySelector('.student-item[data-student-id="' + studentId + '"]');
                    if (studentDiv) {
                      const idx = studentDiv.dataset.studentIndex;
                      const seatSpan = document.getElementById('student-seat-' + idx);
                      if (seatSpan) seatSpan.innerText = seatLabel;
                      studentDiv.classList.add('assigned');
                    }
                  });
                }
              } catch (e) {
                console.error('Failed to preload existing allocations', e);
              }
            })();



            function selectStudent(index) {
            // Highlight selected student
            document.querySelectorAll('.student-item').forEach(s => s.classList.remove('selected'));
            const studentDiv = document.querySelector(`[data-student-index="${index}"]`);
            studentDiv.classList.add('selected');

            // Update the "Selected student" label from clicked student's name
            const nameEl = studentDiv.querySelector('.student-info strong');
            if (nameEl) {
              const labelEl = document.getElementById('current-student');
              if (labelEl) labelEl.textContent = nameEl.textContent;
            }

            selectedStudent = {
            id: studentDiv.dataset.studentId,
            index: index
            };
            }

            function assignSeat(seatDiv) {
            const seatLabel = seatDiv.dataset.seat;

            // ✅ If the seat is already occupied → remove assignment
            if (seatDiv.classList.contains('occupied')) {
            const existingStudentId = seatToStudent[seatLabel];

            // Remove from seatAssignments
            delete seatAssignments[existingStudentId];
            delete seatToStudent[seatLabel];

            // Restore seat display
            seatDiv.classList.remove('occupied');
            seatDiv.classList.add('available');
            seatDiv.textContent = seatLabel;

            // Remove from student list
            const studentIndex = document.querySelector(
            `[data-student-id="${existingStudentId}"]`
            )?.dataset.studentIndex;

            if (studentIndex) {
            document.getElementById('student-seat-' + studentIndex).innerText = ' - ';
            }

            return; // stop here (we’re done removing)
            }

            // ✅ If no student selected, just alert
            if (!selectedStudent) {
            alert('Please select a student first!');
            return;
            }

            const studentId = selectedStudent.id;

            // If the student already has a seat → free the old seat
            if (seatAssignments[studentId]) {
            const oldSeatLabel = seatAssignments[studentId];
            const oldSeatDiv = document.querySelector(`[data-seat="${oldSeatLabel}"]`);
            if (oldSeatDiv) {
            oldSeatDiv.classList.remove('occupied');
            oldSeatDiv.classList.add('available');
            oldSeatDiv.textContent = oldSeatLabel;
            delete seatToStudent[oldSeatLabel];
            }
            }

            // ✅ Assign new seat
            seatAssignments[studentId] = seatLabel;
            seatToStudent[seatLabel] = studentId;

            seatDiv.classList.remove('available');
            seatDiv.classList.add('occupied');
            seatDiv.textContent = seatLabel + ' ✅';

            // Show on student list
            document.getElementById('student-seat-' + selectedStudent.index).innerText = seatLabel;

            // Deselect student after assigning
            selectedStudent = null;
            document.querySelectorAll('.student-item').forEach(s => s.classList.remove('selected'));
            }



            function saveAllocations() {
            if (Object.keys(seatAssignments).length === 0) {
            alert('No seat assignments yet!');
            return;
            }

            const bodyData = {
            allocations: seatAssignments,
            room_id: "<?php echo $get_seat_count['cl_cap_id']; ?>",
            sem_group_id: document.getElementById("sem_group_id").value,
            subject_id: "<?php echo $subject_id; ?>",
            term_id: "<?php echo $term_id; ?>"
            };

            // ✅ Log the data before sending
            console.log("Sending data to backend:", bodyData);
            // Send data to backend
            fetch("<?php echo site_url('semester/set_seatingarrangement/save_seat_allocation'); ?>", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(bodyData)
            })
            .then(res => res.json())
            .then(data => {
            if (data.status === "success") {
            alert("Seat allocations saved successfully!");
            } else {
            alert("Error: " + data.message);
            }
            })
            .catch(err => {
            console.error(err);
            alert("Something went wrong!");
            });
            }
            </script>












