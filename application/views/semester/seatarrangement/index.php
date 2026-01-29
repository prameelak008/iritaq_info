
                <style>

                /* * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                }

                body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                padding: 20px;
                min-height: 100vh;
                }



                .container {
                max-width: 1400px;
                margin: 0 auto;
                background: white;
                border-radius: 20px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
                overflow: hidden;
                } 

                .header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 30px;
                text-align: center;
                }

                .header h1 {
                font-size: 2.5rem;
                margin-bottom: 10px;
                }

                .header p {
                font-size: 1.1rem;
                opacity: 0.9;
                }

                .content {
                padding: 30px;
                }
                */
                .form-section {
                background: #f8f9fa;
                padding: 25px;
                border-radius: 15px;
                margin-bottom: 30px;
                }

                .form-section h2 {
                color: #667eea;
                margin-bottom: 20px;
                font-size: 1.5rem;
                display: flex;
                align-items: center;
                gap: 10px;
                }

                .form-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                }

                .form-group {
                display: flex;
                flex-direction: column;
                }

                label {
                font-weight: 600;
                margin-bottom: 8px;
                color: #333;
                font-size: 0.95rem;
                }


                label .required {
                color: #e74c3c;
                }

                /* select, input {
                padding: 12px 15px;
                border: 2px solid #e0e0e0;
                border-radius: 10px;
                font-size: 1rem;
                transition: all 0.3s;
                background: white;
                }

                select:focus, input:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                }

                .btn-group {
                display: flex;
                gap: 15px;
                margin-top: 20px;
                flex-wrap: wrap;
                }

                .btn {
                padding: 14px 30px;
                border: none;
                border-radius: 10px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s;
                display: inline-flex;
                align-items: center;
                gap: 8px;
                }

                .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                }

                .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
                }

                .btn-success {
                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                color: white;
                }

                .btn-success:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(17, 153, 142, 0.4);
                }

                .btn-secondary {
                background: #e0e0e0;
                color: #333;
                }

                .btn-secondary:hover {
                background: #d0d0d0;
                }

                .allocation-section {
                display: none;
                margin-top: 30px;
                }

                .allocation-section.active {
                display: block;
                animation: fadeIn 0.5s;
                } */



                @keyframes fadeIn {
                from {
                opacity: 0;
                transform: translateY(20px);
                }
                to {
                opacity: 1;
                transform: translateY(0);
                }
                }

                .info-cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 15px;
                margin-bottom: 30px;
                }

                .info-card {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 20px;
                border-radius: 15px;
                text-align: center;
                }

                .info-card .label {
                font-size: 0.9rem;
                opacity: 0.9;
                margin-bottom: 8px;
                }

                .info-card .value {
                font-size: 1.8rem;
                font-weight: 700;
                }

                .allocation-grid {
                display: grid;
                grid-template-columns: 2fr 1fr;
                gap: 30px;
                margin-top: 30px;
                }

                .room-layout {
                background: #f8f9fa;
                padding: 25px;
                border-radius: 15px;
                }

                .room-layout h3 {
                color: #667eea;
                margin-bottom: 20px;
                font-size: 1.3rem;
                }

                .legend {
                display: flex;
                gap: 20px;
                margin-bottom: 20px;
                flex-wrap: wrap;
                }

                .legend-item {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 0.9rem;
                }

                .legend-box {
                width: 25px;
                height: 25px;
                border-radius: 5px;
                border: 2px solid;
                }

                .seat-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
                gap: 12px;
                margin-top: 20px;
                }

                .seat {
                aspect-ratio: 1;
                border: 3px solid #ddd;
                border-radius: 10px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s;
                font-weight: 600;
                font-size: 0.85rem;
                position: relative;
                padding: 5px;
                }

                .seat.available {
                background: #e8f5e9;
                border-color: #4caf50;
                color: #2e7d32;
                }

                .seat.available:hover {
                transform: scale(1.1);
                box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
                }

                .seat.assigned {
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

                .seat .seat-label {
                font-size: 1rem;
                font-weight: 700;
                }

                .seat .seat-subject {
                font-size: 0.65rem;
                margin-top: 2px;
                opacity: 0.8;
                }

                .students-panel {
                background: #f8f9fa;
                padding: 25px;
                border-radius: 15px;
                max-height: 600px;
                overflow-y: auto;
                }

                .students-panel h3 {
                color: #667eea;
                margin-bottom: 20px;
                font-size: 1.3rem;
                position: sticky;
                top: 0;
                background: #f8f9fa;
                padding-bottom: 10px;
                }

                .subject-group {
                margin-bottom: 25px;
                }

                .subject-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 12px 15px;
                border-radius: 10px;
                margin-bottom: 10px;
                font-weight: 600;
                font-size: 0.95rem;
                }

                .student-item {
                padding: 12px 15px;
                margin-bottom: 8px;
                background: white;
                border-radius: 10px;
                cursor: pointer;
                transition: all 0.3s;
                border-left: 4px solid transparent;
                display: flex;
                justify-content: space-between;
                align-items: center;
                }

                .student-item:hover {
                transform: translateX(5px);
                box-shadow: 0 3px 10px rgba(0,0,0,0.1);
                }

                .student-item.selected {
                background: #667eea;
                color: white;
                border-left-color: #764ba2;
                }

                .student-item.assigned {
                background: #e8f5e9;
                border-left-color: #4caf50;
                }

                .student-name {
                font-weight: 600;
                }

                .student-roll {
                font-size: 0.85rem;
                opacity: 0.8;
                }

                .seat-badge {
                background: #4caf50;
                color: white;
                padding: 4px 10px;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 600;
                }

                .alert {
                padding: 15px 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                gap: 10px;
                }

                .alert-info {
                background: #e3f2fd;
                color: #1565c0;
                border-left: 4px solid #2196f3;
                }

                .alert-success {
                background: #e8f5e9;
                color: #2e7d32;
                border-left: 4px solid #4caf50;
                }

                .subject-color-1 { border-color: #e74c3c !important; }
                .subject-color-2 { border-color: #3498db !important; }
                .subject-color-3 { border-color: #2ecc71 !important; }
                .subject-color-4 { border-color: #f39c12 !important; }
                .subject-color-5 { border-color: #9b59b6 !important; }

                @media (max-width: 768px) {
                .allocation-grid {
                grid-template-columns: 1fr;
                }

                .seat-grid {
                grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
                }
                }

                .stats-bar {
                display: flex;
                gap: 15px;
                margin-top: 20px;
                padding: 15px;
                background: white;
                border-radius: 10px;
                flex-wrap: wrap;
                }

                .stat-item {
                flex: 1;
                min-width: 150px;
                text-align: center;
                padding: 10px;
                border-radius: 8px;
                }

                .stat-item .stat-value {
                font-size: 1.5rem;
                font-weight: 700;
                color: #667eea;
                }

                .stat-item .stat-label {
                font-size: 0.85rem;
                color: #666;
                margin-top: 5px;
                } 
                </style>





                <div class="content-wrapper"> 
                <section class="content-header">

                </section>          

                <!-- Main content -->
                <section class="content">
                <div class="col-md-12">
                <?php
                $this->load->view('layout/topbar'); ?>
                </div>
                &nbsp;


                <div class="row">     

                <div class="col-md-12">

                <!-- Horizontal Form -->

                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"> Multi-Class Seat Allocation System</h3>
                <p>Allocate multiple programs and subjects in one examination hall</p>
                </div>    


                <div class="">
                <!-- Form Section -->
                <div class="form-section">

                <h2>📋 Allocation Details</h2>

                <div class="form-grid">

<!--                 
                <div class="form-group">           
                <?= dropdownlist(
                $programs,
                set_value('program')
                ); ?>
                <span class="text-danger"><?= form_error('program'); ?></span>
                </div>  -->





                <div class="form-group">
                <label>Program <small class="req">*</small></label>
                <select id="program" name="program" class="form-control" multiple>
                <option value="">-- Select Program --</option>
                <?php foreach($programee_list as $prog): ?>
                <option value="<?php echo $prog['id']; ?>" 
                <?php echo set_value('program') == $prog['id'] ? 'selected="selected"' : ''; ?>>
                <?php echo htmlspecialchars($prog['p_name'] . ' - ' . $prog['p_code']); ?>
                </option>
                <?php endforeach; ?>
                </select>
                <span class="text-danger"><?= form_error('program_id'); ?></span>
                </div>

                

                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="batchtype_id" name="batchtype_id" class="form-control">
                <option value="">-- Select Batch --</option>
                </select>
                <span class="text-danger"><?= form_error('batchtype_id'); ?></span>
                </div> 


                <div class="form-group">
                <label>Semester Term <small class="req">*</small></label>
                <select id="semester_term" name="semester_term" class="form-control" >
                <option value="">-- Select Batch First --</option>
                </select>
                <span class="text-danger"><?= form_error('semester_term'); ?></span>
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





                <!-- <div class="form-group">
                <label>Program / Degree <span class="required">*</span></label>
                <select id="program" multiple size="4">
                <option value="bsc-maths">BSc Mathematics</option>
                <option value="bsc-physics">BSc Physics</option>
                <option value="bsc-chemistry">BSc Chemistry</option>
                <option value="bcom">B.Com</option>
                <option value="ba-english">BA English</option>
                </select>
                </div> -->

                <!-- <div class="form-group">
                <label>Semester / Batch <span class="required">*</span></label>
                <select id="semester">
                <option value="">-- Select Semester --</option>
                <option value="regular-sem1-2023">Regular - Semester 1 - 2023</option>
                <option value="regular-sem2-2023">Regular - Semester 2 - 2023</option>
                <option value="regular-sem3-2023">Regular - Semester 3 - 2023</option>
                <option value="regular-sem4-2023">Regular - Semester 4 - 2023</option>
                <option value="regular-sem5-2023">Regular - Semester 5 - 2023</option>
                <option value="regular-sem6-2023">Regular - Semester 6 - 2023</option>
                </select>
                </div> -->

                <!-- <div class="form-group">
                <label>Room / Examination Hall <span class="required">*</span></label>
                <select id="room">
                <option value="">-- Select Room --</option>
                <option value="room1" data-capacity="60">First Floor - A-10 (Exam Hall / Single Bench) - Capacity: 60</option>
                <option value="room2" data-capacity="80">Second Floor - B-20 (Exam Hall / Double Bench) - Capacity: 80</option>
                <option value="room3" data-capacity="100">Ground Floor - C-01 (Main Hall / Single Bench) - Capacity: 100</option>
                <option value="room4" data-capacity="50">First Floor - A-15 (Classroom / Single Bench) - Capacity: 50</option>
                </select>
                </div> -->




                <div class="form-group">
                <label>Date</label>
                <input type="date" id="examDate" class="form-control">
                </div>
                </div>




                <div class="btn-group">
                <button class="btn btn-primary" onclick="loadStudents()">
                📚 Load Students & Room
                </button>
                <button class="btn btn-primary" onclick="autoAllocate()">
                ⚡ Auto Allocate Seats
                </button>
                <button class="btn btn-secondary" onclick="resetForm()">
                🔄 Reset
                </button>
                </div>
                </div>

                <!-- Allocation Section -->
                <div id="allocationSection" class="allocation-section">
                <!-- Info Cards -->
                <div class="info-cards">
                <div class="info-card">
                <div class="label">Room Capacity</div>
                <div class="value" id="roomCapacity">0</div>
                </div>
                <div class="info-card">
                <div class="label">Total Students</div>
                <div class="value" id="totalStudents">0</div>
                </div>
                <div class="info-card">
                <div class="label">Allocated</div>
                <div class="value" id="allocatedCount">0</div>
                </div>
                <div class="info-card">
                <div class="label">Available Seats</div>
                <div class="value" id="availableSeats">0</div>
                </div>
                </div>

                <div class="alert alert-info">
                ℹ️ <strong>Instructions:</strong> Select a student from the list, then click on an available seat to assign. Click assigned seat to remove allocation.
                </div>

                <!-- Allocation Grid -->
                <div class="allocation-grid">
                <!-- Room Layout -->
                <div class="room-layout">
                <h3>🏛️ Room Layout - <span id="roomName">Exam Hall</span></h3>

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

                <div class="seat-grid" id="seatGrid">
                <!-- Seats will be generated here -->
                </div>
                </div>

                <!-- Students Panel -->
                <div class="students-panel">
                <h3>👥 Students List</h3>
                <div id="studentsList">
                <!-- Students will be grouped by subject here -->
                </div>
                </div>
                </div>

                <div class="btn-group">
                <button class="btn btn-success" onclick="saveAllocations()">
                💾 Save Allocations
                </button>
                <button class="btn btn-primary" onclick="printAllocations()">
                🖨️ Print Allocation
                </button>
                <button class="btn btn-secondary" onclick="exportToExcel()">
                📊 Export to Excel
                </button>
                </div>
                </div>
                </div>



                </div>

                </div><!--/.col (right) -->

                <?php //} ?>


                </div>

                </section><!-- /.content -->
                </div>











                <script>
                // Sample data structure
                const studentsData = {
                'bsc-maths': {
                subject: 'Mathematics - Calculus I',
                color: 'subject-color-1',
                students: [
                { id: 1, name: 'Arjun Kumar', roll: 'BSCM001', program: 'BSc Maths' },
                { id: 2, name: 'Priya Sharma', roll: 'BSCM002', program: 'BSc Maths' },
                { id: 3, name: 'Rahul Verma', roll: 'BSCM003', program: 'BSc Maths' },
                { id: 4, name: 'Sneha Patel', roll: 'BSCM004', program: 'BSc Maths' },
                { id: 5, name: 'Amit Singh', roll: 'BSCM005', program: 'BSc Maths' },
                ]
                },
                'bsc-physics': {
                subject: 'Physics - Mechanics',
                color: 'subject-color-2',
                students: [
                { id: 6, name: 'Raj Malhotra', roll: 'BSCP001', program: 'BSc Physics' },
                { id: 7, name: 'Kavya Reddy', roll: 'BSCP002', program: 'BSc Physics' },
                { id: 8, name: 'Vikram Rao', roll: 'BSCP003', program: 'BSc Physics' },
                { id: 9, name: 'Anjali Gupta', roll: 'BSCP004', program: 'BSc Physics' },
                ]
                },
                'bsc-chemistry': {
                subject: 'Chemistry - Organic Chemistry',
                color: 'subject-color-3',
                students: [
                { id: 10, name: 'Sanjay Nair', roll: 'BSCC001', program: 'BSc Chemistry' },
                { id: 11, name: 'Neha Iyer', roll: 'BSCC002', program: 'BSc Chemistry' },
                { id: 12, name: 'Karthik Menon', roll: 'BSCC003', program: 'BSc Chemistry' },
                ]
                },
                'bcom': {
                subject: 'Commerce - Financial Accounting',
                color: 'subject-color-4',
                students: [
                { id: 13, name: 'Deepak Jain', roll: 'BCOM001', program: 'B.Com' },
                { id: 14, name: 'Pooja Agarwal', roll: 'BCOM002', program: 'B.Com' },
                { id: 15, name: 'Rohit Mehta', roll: 'BCOM003', program: 'B.Com' },
                { id: 16, name: 'Simran Kaur', roll: 'BCOM004', program: 'B.Com' },
                ]
                },
                'ba-english': {
                subject: 'English - British Literature',
                color: 'subject-color-5',
                students: [
                { id: 17, name: 'Aditya Bose', roll: 'BAE001', program: 'BA English' },
                { id: 18, name: 'Meera Das', roll: 'BAE002', program: 'BA English' },
                { id: 19, name: 'Aryan Chatterjee', roll: 'BAE003', program: 'BA English' },
                ]
                }
                };

                let selectedStudent = null;
                let seatAssignments = {};
                let seatToStudent = {};
                let allStudents = [];
                let roomCapacity = 0;




                //   function loadStudents()
                //    {
                //       const programSelect = document.getElementById('program');
                //       const roomSelect = document.getElementById('room');
                //       const semesterSelect = document.getElementById('semester');

                //       if (!roomSelect.value || !semesterSelect.value || programSelect.selectedOptions.length === 0) {
                //           alert('Please select program(s), semester, and room');
                //           return;
                //       }

                //       // Get selected programs
                //       const selectedPrograms = Array.from(programSelect.selectedOptions).map(opt => opt.value);

                //       // Get room capacity
                //       const selectedOption = roomSelect.options[roomSelect.selectedIndex];
                //       roomCapacity = parseInt(selectedOption.dataset.capacity);
                //       const roomName = selectedOption.text;

                //       // Clear previous data
                //       allStudents = [];
                //       seatAssignments = {};
                //       seatToStudent = {};

                //       // Collect students from selected programs
                //       selectedPrograms.forEach(program => {
                //           if (studentsData[program]) {
                //               allStudents.push({
                //                   program: program,
                //                   subject: studentsData[program].subject,
                //                   color: studentsData[program].color,
                //                   students: studentsData[program].students
                //               });
                //           }
                //       });

                //       // Calculate totals
                //       const totalStudents = allStudents.reduce((sum, group) => sum + group.students.length, 0);

                //       // Update info cards
                //       document.getElementById('roomCapacity').textContent = roomCapacity;
                //       document.getElementById('totalStudents').textContent = totalStudents;
                //       document.getElementById('allocatedCount').textContent = 0;
                //       document.getElementById('availableSeats').textContent = roomCapacity;
                //       document.getElementById('roomName').textContent = roomName.split('-')[1].trim();

                //       // Generate seats
                //       generateSeats();

                //       // Display students
                //       displayStudents();

                //       // Show allocation section
                //       document.getElementById('allocationSection').classList.add('active');
                //   }






                function loadStudents()
                {                   

                const program   = document.getElementById('program');
                const room      = document.getElementById('seat_select');
                const semester  = document.getElementById('semester_term');
                const batchtype = document.getElementById('batchtype_id');              

                const programSelect     = program.value;
                const roomSelect        = room.value;
                const semesterSelect    = semester.value;
                const batchtype_id      = batchtype.value;
            
             

                if (!programSelect || !roomSelect || !semesterSelect || !batchtype_id)
                {
                console.error('One or more elements not found!');
                return;
                }

                // Get selected programs
                const selectedPrograms = Array.from(programSelect.selectedOptions).map(opt => opt.value);

                alert(selectedPrograms)

                // Get room capacity
                const selectedOption = roomSelect.options[roomSelect.selectedIndex];
                roomCapacity = parseInt(selectedOption.dataset.capacity);
                const roomName = selectedOption.text;

                // Clear previous data
                allStudents = [];
                seatAssignments = {};
                seatToStudent = {};

                // Collect students from selected programs
                selectedPrograms.forEach(program => {
                if (studentsData[program]) {
                allStudents.push({
                program: program,
                subject: studentsData[program].subject,
                color: studentsData[program].color,
                students: studentsData[program].students
                });
                }
                });

                // Calculate totals
                const totalStudents = allStudents.reduce((sum, group) => sum + group.students.length, 0);

                // Update info cards
                document.getElementById('roomCapacity').textContent = roomCapacity;
                document.getElementById('totalStudents').textContent = totalStudents;
                document.getElementById('allocatedCount').textContent = 0;
                document.getElementById('availableSeats').textContent = roomCapacity;
                document.getElementById('roomName').textContent = roomName.split('-')[1].trim();

                // Generate seats
                generateSeats();

                // Display students
                displayStudents();

                // Show allocation section
                document.getElementById('allocationSection').classList.add('active');
                }



                function generateSeats() {
                const seatGrid = document.getElementById('seatGrid');
                seatGrid.innerHTML = '';

                for (let i = 1; i <= roomCapacity; i++) {
                const seat = document.createElement('div');
                seat.className = 'seat available';
                seat.dataset.seat = 'A' + i;
                seat.onclick = () => assignSeat(seat);

                const label = document.createElement('div');
                label.className = 'seat-label';
                label.textContent = 'A' + i;

                seat.appendChild(label);
                seatGrid.appendChild(seat);
                }
                }

                function displayStudents() {
                const studentsList = document.getElementById('studentsList');
                studentsList.innerHTML = '';

                allStudents.forEach((group, groupIndex) => {
                const subjectGroup = document.createElement('div');
                subjectGroup.className = 'subject-group';

                const subjectHeader = document.createElement('div');
                subjectHeader.className = 'subject-header';
                subjectHeader.textContent = `${group.subject} (${group.students.length} students)`;
                subjectGroup.appendChild(subjectHeader);

                group.students.forEach((student, index) => {
                const studentItem = document.createElement('div');
                studentItem.className = 'student-item';
                studentItem.dataset.studentId = student.id;
                studentItem.dataset.groupIndex = groupIndex;
                studentItem.dataset.studentIndex = index;
                studentItem.dataset.color = group.color;
                studentItem.onclick = () => selectStudent(studentItem);

                const info = document.createElement('div');
                info.innerHTML = `
                <div class="student-name">${student.name}</div>
                <div class="student-roll">${student.roll}</div>
                `;

                const badge = document.createElement('div');
                badge.className = 'seat-badge';
                badge.style.display = 'none';
                badge.id = 'badge-' + student.id;

                studentItem.appendChild(info);
                studentItem.appendChild(badge);
                subjectGroup.appendChild(studentItem);
                });

                studentsList.appendChild(subjectGroup);
                });
                }

                function selectStudent(studentItem) {
                document.querySelectorAll('.student-item').forEach(s => s.classList.remove('selected'));
                studentItem.classList.add('selected');

                selectedStudent = {
                id: studentItem.dataset.studentId,
                element: studentItem,
                color: studentItem.dataset.color
                };
                }

                function assignSeat(seatDiv) {
                const seatLabel = seatDiv.dataset.seat;

                // If seat is assigned, remove assignment
                if (seatDiv.classList.contains('assigned')) {
                const studentId = seatToStudent[seatLabel];
                delete seatAssignments[studentId];
                delete seatToStudent[seatLabel];

                seatDiv.className = 'seat available';
                seatDiv.innerHTML = `<div class="seat-label">${seatLabel}</div>`;


                // Update student badge
                const badge = document.getElementById('badge-' + studentId);
                if (badge) {
                badge.style.display = 'none';
                badge.textContent = '';
                }

                const studentItem = document.querySelector(`[data-student-id="${studentId}"]`);
                if (studentItem) studentItem.classList.remove('assigned');

                updateStats();
                return;
                }

                // If no student selected
                if (!selectedStudent) {
                alert('Please select a student first!');
                return;
                }

                const studentId = selectedStudent.id;

                // If student already has a seat, free it
                if (seatAssignments[studentId]) {
                const oldSeat = document.querySelector(`[data-seat="${seatAssignments[studentId]}"]`);
                if (oldSeat) {
                oldSeat.className = 'seat available';
                oldSeat.innerHTML = `<div class="seat-label">${oldSeat.dataset.seat}</div>`;
                }
                delete seatToStudent[seatAssignments[studentId]];
                }

                // Assign new seat
                seatAssignments[studentId] = seatLabel;
                seatToStudent[seatLabel] = studentId;

                seatDiv.className = 'seat assigned ' + selectedStudent.color;
                const studentItem = document.querySelector(`[data-student-id="${studentId}"]`);
                const studentName = studentItem.querySelector('.student-name').textContent;

                seatDiv.innerHTML = `
                <div class="seat-label">${seatLabel}</div>
                <div class="seat-subject">${studentName.split(' ')[0]}</div>
                `;

                // Update student badge
                const badge = document.getElementById('badge-' + studentId);
                if (badge) {
                badge.style.display = 'block';
                badge.textContent = seatLabel;
                }

                studentItem.classList.add('assigned');

                // Clear selection
                selectedStudent = null;
                document.querySelectorAll('.student-item').forEach(s => s.classList.remove('selected'));

                updateStats();
                }

                function autoAllocate() {
                if (allStudents.length === 0) {
                alert('Please load students first!');
                return;
                }

                // Clear existing allocations
                seatAssignments = {};
                seatToStudent = {};

                let seatIndex = 1;
                let allocated = 0;

                // Allocate seats to all students from all programs
                for (const group of allStudents) {
                for (const student of group.students) {
                if (seatIndex > roomCapacity) break;

                const seatLabel = 'A' + seatIndex;
                seatAssignments[student.id] = seatLabel;
                seatToStudent[seatLabel] = student.id;

                // Update seat visual
                const seatDiv = document.querySelector(`[data-seat="${seatLabel}"]`);
                if (seatDiv) {
                seatDiv.className = 'seat assigned ' + group.color;
                seatDiv.innerHTML = `
                <div class="seat-label">${seatLabel}</div>
                <div class="seat-subject">${student.name.split(' ')[0]}</div>
                `;
                }

                // Update student badge
                const badge = document.getElementById('badge-' + student.id);
                if (badge) {
                badge.style.display = 'block';
                badge.textContent = seatLabel;
                }

                const studentItem = document.querySelector(`[data-student-id="${student.id}"]`);
                if (studentItem) studentItem.classList.add('assigned');

                seatIndex++;
                allocated++;
                }
                if (seatIndex > roomCapacity) break;
                }

                updateStats();

                if (allocated < allStudents.reduce((sum, g) => sum + g.students.length, 0)) {
                alert(`⚠️ Only ${allocated} students allocated. Room capacity exceeded!`);
                } else {
                alert(`✅ Successfully allocated ${allocated} students!`);
                }
                }

                function updateStats() {
                const allocated = Object.keys(seatAssignments).length;
                document.getElementById('allocatedCount').textContent = allocated;
                document.getElementById('availableSeats').textContent = roomCapacity - allocated;
                }

                function saveAllocations() {
                if (Object.keys(seatAssignments).length === 0) {
                alert('No allocations to save!');
                return;
                }

                const data = {
                allocations: seatAssignments,
                room: document.getElementById('room').value,
                semester: document.getElementById('semester').value,
                examDate: document.getElementById('examDate').value,
                timestamp: new Date().toISOString()
                };

                console.log('Saving allocations:', data);
                alert('✅ Allocations saved successfully!\n\nAllocated: ' + Object.keys(seatAssignments).length + ' students');
                }

                function printAllocations() {
                window.print();
                }

                function exportToExcel() {
                let csv = 'Seat Number,Student Name,Roll Number,Program,Subject\n';

                allStudents.forEach(group => {
                group.students.forEach(student => {
                const seat = seatAssignments[student.id] || 'Not Allocated';
                csv += `${seat},"${student.name}",${student.roll},${student.program},"${group.subject}"\n`;
                });
                });

                const blob = new Blob([csv], { type: 'text/csv' });
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'seat_allocation_' + new Date().getTime() + '.csv';
                a.click();
                }

                function resetForm() {
                document.getElementById('program').selectedIndex = -1;
                document.getElementById('semester').selectedIndex = 0;
                document.getElementById('room').selectedIndex = 0;
                document.getElementById('examDate').value = '';
                document.getElementById('allocationSection').classList.remove('active');
                allStudents = [];
                seatAssignments = {};
                seatToStudent = {};
                }
                </script>
