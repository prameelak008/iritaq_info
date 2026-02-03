
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_theme.css"> 
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/sem_style.css">

<title>Complete Exam Attempt Management System</title>

<style>
.student-collapsible-wrapper {
    margin-bottom: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    overflow: hidden;
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.student-collapsible {
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 18px 20px;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
    font-size: 15px;
}

.student-collapsible:hover {
    background: linear-gradient(135deg, #5568d3 0%, #6a3f8f 100%);
}

.student-collapsible.active {
    background: linear-gradient(135deg, #5568d3 0%, #6a3f8f 100%);
}

.student-avatar {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    backdrop-filter: blur(10px);
}

.collapse-icon {
    font-size: 14px;
    transition: transform 0.3s ease;
    margin-left: 10px;
}

.student-collapsible.active .collapse-icon {
    transform: rotate(180deg);
}

.student-collapsible-wrapper .collapsible-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease;
    background: #f8f9fa;
}

.student-subjects-container {
    padding: 20px;
}

/* Nested subject collapsibles inside student */
.student-subjects-container .collapsible {
    background: white;
    border: 1px solid #e0e0e0;
    margin-bottom: 10px;
}

.student-subjects-container .collapsible:hover {
    background: #f8f9fa;
    border-color: #2196F3;
}

.student-subjects-container .collapsible.active {
    background: #e3f2fd;
    border-color: #2196F3;
}

</style>



        <style>    
        .header {
            background: linear-gradient(135deg, #e2e5e7, #e2e5e7);
            color: black;
            padding: 25px 30px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .tabs-container {
            border-bottom: 2px solid #e0e0e0;
            background: #fafafa;
            padding: 0 30px;
        }

        .tabs {
            display: flex;
            gap: 10px;
            overflow-x: auto;
        }

        .tab-btn {
            padding: 18px 25px;
            background: transparent;
            border: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            color: #666;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .tab-btn:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .tab-btn.active {
            color: #667eea;
            border-bottom-color: #667eea;
            background: white;
        }

        .tab-content {
            display: none;
            padding: 30px;
        }

        .tab-content.active {
            display: block;
        }

        .info-card {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 5px;
        }

        .info-card strong {
            color: #1976d2;
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .info-card ul {
            margin-left: 20px;
            color: #555;
            line-height: 1.8;
        }


        /*
        .form-section {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title .icon {
            font-size: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
        }

        .form-group label .required {
            color: #e74c3c;
            margin-left: 3px;
        }

        .form-control {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control:disabled {
            background: #f0f0f0;
            cursor: not-allowed;
        }
           

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover:not(:disabled) {
            background: #059669;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            padding: 8px 15px;
            font-size: 13px;
        }

        .btn-danger:hover:not(:disabled) {
            background: #dc2626;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover:not(:disabled) {
            background: #5a6268;
        }
        */

        .table-responsive {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background: #667eea;
            color: white;
        }

        thead th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        tbody tr {
            border-bottom: 1px solid #e0e0e0;
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        tbody td {
            padding: 15px;
            font-size: 14px;
            color: #555;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .attempt-input {
            width: 80px;
            text-align: center;
        }

        .btn-container {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e0e0e0;
        }

        .subject-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }

        .subject-card:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .subject-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .subject-name {
            font-weight: 600;
            font-size: 16px;
            color: #333;
        }

        .subject-code {
            color: #666;
            font-size: 13px;
        }

        .attempt-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .attempt-item {
            background: #f9f9f9;
            padding: 12px;
            border-radius: 5px;
            border-left: 3px solid #667eea;
        }

        .attempt-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }

        .attempt-value {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .status-allowed { background: #10b981; }
        .status-limited { background: #f59e0b; }
        .status-exhausted { background: #ef4444; }

        .student-info-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .student-info-box h3 {
            margin-bottom: 10px;
        }

        .student-info-box p {
            margin: 5px 0;
            opacity: 0.9;
        }

        .collapsible {
            background: #667eea;
            color: white;
            cursor: pointer;
            padding: 15px;
            border: none;
            text-align: left;
            outline: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            margin-bottom: 10px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .collapsible:hover {
            background: #5568d3;
        }

        .collapsible.active {
            background: #5568d3;
        }

        .collapsible-content {
            display: none;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .collapsible-content.active {
            display: block;
        }

        .search-box {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #999;
        }

        .filter-tags {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filter-tag {
            background: #e0e0e0;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-tag:hover {
            background: #667eea;
            color: white;
        }

        .filter-tag.active {
            background: #667eea;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
        }

        .help-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            font-style: italic;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            animation: fadeIn 0.3s;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            width: 90%;
            animation: slideIn 0.3s;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h3 {
            font-size: 20px;
            color: #333;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #999;
        }

        .close-modal:hover {
            color: #333;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: none;
            align-items: center;
            gap: 12px;
            z-index: 2000;
            animation: slideInRight 0.3s;
        }

        .notification.active {
            display: flex;
        }

        .notification.success {
            border-left: 4px solid #10b981;
        }

        .notification.error {
            border-left: 4px solid #ef4444;
        }

        .notification.warning {
            border-left: 4px solid #f59e0b;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .stat-card h4 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .stat-card .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        .student-search-results {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            max-height: 300px;
            overflow-y: auto;
            position: absolute;
            width: 100%;
            z-index: 100;
            display: none;
        }

        .student-search-results.active {
            display: block;
        }

        .student-result-item {
            padding: 12px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.2s;
        }

        .student-result-item:hover {
            background: #f8f9fa;
        }

        .student-result-item:last-child {
            border-bottom: none;
        }

        .loading-spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }           
    </style>


            <div class="content-wrapper"> 
            <section class="content-header">
            <h1>
            <i class="fa fa-usd"></i> <?php echo $this->lang->line('fee_charge'); ?>
            </h1>
            </section>    

            <section class="content">
            <div class="col-md-12">
            <?php $this->load->view('layout/topbar_exam'); ?>
            </div>
            &nbsp;

          



  <div class="row">
    <div class="box box-primary">
        <!-- Header -->
        <div class="header">
            <h1>📚 Complete Exam Attempt Management System</h1>
            <p>Track and manage attempts per Student → per Subject → per Exam Type</p>
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab(0)">
                    🎯 Common Limits (All Students)
                </button>
                <button class="tab-btn" onclick="switchTab(1)">
                    📊 Subject-wise Limits
                </button>
                <button class="tab-btn" onclick="switchTab(2)">
                    👤 Student-wise Tracking
                </button>
                <button class="tab-btn" onclick="switchTab(3)">
                    📈 View All Attempts
                </button>
                <button class="tab-btn" onclick="switchTab(4)">
                    ⚙️ Bulk Configuration
                </button>
            </div>
        </div>



        <!-- Tab 1: Common Limits (Program/Batch Level) -->

        <div class="tab-content active">
            <div class="info-card">
                <strong>ℹ️ Common Limits - Program & Batch Level</strong>
                <ul>
                    <li>Set default attempt limits for ALL students in a program/batch</li>
                    <li>Applied uniformly unless overridden at subject or student level</li>
                    <li>Example: "All students in Degree Economics Sem1-2023 get 3 Supplementary attempts"</li>
                </ul>
            </div>  


                <form  method="POST" name="form" action="<?php echo site_url('semester_exam/exam_attempt/');  ?>">
                <div class="form-section">

                <div class="section-title">         
                Select Program & Batch
                </div>

                <div class="form-row">

                <div class="form-group">           
                <?= dropdownlist_program(
                $programs,
                set_value('prog_id')
                ); ?>
                <span class="text-danger"><?= form_error('prog_id'); ?></span>
                </div> 


                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="sem_type" name="sem_type" class="form-control sem_type">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                <span class="text-danger"><?= form_error('sem_type'); ?></span>
                </div>

                </div>
                </div>


                <div class="form-section">
                <div class="section-title">
                <span class="icon">⚙️</span>
                Configure Attempt Limits (Applies to ALL subjects)
                </div>

                <div class="table-responsive">
                <table>
                <thead>
                <tr>
                <th>Exam Type</th>
                <th>Description</th>
                <th style="width: 150px;">Max Attempts</th>
                <!-- <th style="width: 120px;">Add</th> -->
                </tr>
                </thead>
                <tbody>

                <?php foreach ($examOptions as $key => $exam): 
                $slug = strtolower(str_replace(' ', '_', $exam));
                ?>
                <tr>
                <td><strong>📝 <?php echo strtoupper($exam); ?></strong></td>
                <td>
                <?php
                switch ($exam) {
                case 'Regular': echo 'Normal Semester Examination'; break;
                case 'Say Exam': echo 'Supplementary Examination'; break;
                case 'Revaluation': echo 'Rechecking of Exam papers'; break;
                case 'Improvement': echo 'Score Improvement Examination'; break;
                }
                ?>
                </td> 

                <td>
                <input type="number"
                name="attempts[<?php echo $key; ?>]"
                id="<?php echo $slug; ?>_common"
                class="form-control attempt-input"
                value="1"
                min="1"                
                >
                </td>

                <!-- <td>
                <input type="checkbox"              
                name="unlimited[<?php echo $key; ?>]"
                value="1"
                <?php echo ($key == 0) ? 'checked' : ''; ?>
                onchange="toggleUnlimited('<?php echo $slug; ?>_common', this)"                
                >
                <label style="margin-left:5px;">Yes</label>
                </td> -->


                </tr>
                <?php endforeach; ?>

                </tbody>
                </table>
                </div>

                <div class="help-text" style="margin-top: 15px;">
                💡 Tip: Check "Unlimited" to allow infinite attempts for an exam type
                </div>
                </div>

                <div class="btn-container">
                <button type="button" class="btn btn-secondary" onclick="resetCommonForm()">🔄 Reset</button>
                <button type="submit" class="btn btn-success">💾 Save Common Limits</button>
                </div>
                </form>
                </div>




        <!-- Tab 2: Subject-wise Limits -------------------------------------------------------->



        <div class="tab-content">
            <div class="info-card">
                <strong>ℹ️ Subject-wise Limits</strong>
                <ul>
                    <li>Override common limits for specific subjects</li>
                    <li>Example: "Mathematics can have 5 Supplementary attempts, but Physics only 2"</li>
                    <li>Applies to ALL students taking that subject</li>
                </ul>
            </div>            

                 <form  method="POST" name="form" action="<?php echo site_url('semester_exam/exam_attempt/add_subject_attempt');  ?>">
                <div class="form-section">
                <div class="section-title">            
                Select Program & Batch
                </div>

                <div class="form-row">
                <div class="form-group">           
                <?= dropdownlist_program(
                $programs,
                set_value('prog_id')
                ); ?>
                <span class="text-danger"><?= form_error('prog_id'); ?></span>
                </div>


                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="sem_type_subject" name="sem_type" class="form-control sem_type">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                <span class="text-danger"><?= form_error('sem_type'); ?></span>
                </div>


                <div class="form-group">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-primary" onclick="loadSubjects()">
                🔍 Load Subjects
                </button>
                </div>
                </div>
                </div>



                <div id="subjectsContainer" class="form-section" style="display: none;">
                <div class="section-title">
                <span class="icon">📚</span>
                Configure Attempts per Subject
                </div>

                <div class="info-card" style="background: #fff3cd; border-left-color: #ffc107;">
                <strong>💡 Common Limits (Default):</strong>
                <div style="display: flex; gap: 20px; margin-top: 10px; flex-wrap: wrap;">
                <span>Regular: <strong id="default_regular">Unlimited</strong></span>
                <span>Supplementary: <strong id="default_supp">3</strong></span>
                <span>Improvement: <strong id="default_imp">1</strong></span>
                <span>Revaluation: <strong id="default_reval">1</strong></span>
                </div>
                <p class="help-text">Leave blank to use common limits shown above</p>
                </div>

                <!-- Loading Spinner -->
                <div id="subjectsLoading" style="display: none;">
                <div class="loading-spinner"></div>
                <p style="text-align: center; color: #666;">Loading subjects...</p>
                </div>

                <!-- Subject Cards Container -->
                <div id="subjectCards"></div>
                </div>

                <div class="btn-container" id="subjectFormButtons" style="display: none;">
                <button type="button" class="btn btn-secondary" onclick="resetSubjectForm()">🔄 Reset</button>
                <button type="submit" class="btn btn-success">💾 Save Subject Limits</button>
                </div>
                </form>
                </div>



        <!-- Tab 3: Student-wise Tracking -->


        <div class="tab-content">
            <div class="info-card">
                <strong>ℹ️ Student-wise Attempt Tracking</strong>
                <ul>
                    <li>View and manage attempts for individual students</li>
                    <li>Track: Student → Subject → Exam Type → Attempts Used/Remaining</li>
                    <li>Override limits for special cases (medical, admin approval, etc.)</li>
                </ul>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <span class="icon">🔍</span>
                    Search Student
                </div>

                <div class="search-box">
                    <i>🔍</i>
                    <input type="text" 
                           id="student_search" 
                           placeholder="Search by student name, roll number, or ID..." 
                           onkeyup="searchStudent()"
                           autocomplete="off">
                    <div class="student-search-results" id="studentSearchResults"></div>
                </div>

                <div class="form-row">
                    <!-- <div class="form-group">
                        <label>Program</label>
                        <select id="student_program_filter" class="form-control" onchange="loadStudentBatches()">
                            <option value="">-- All Programs --</option>
                            <option value="1">Degree - Economics</option>
                            <option value="2">Degree - Mathematics</option>
                            <option value="3">Degree - Physics</option>
                            <option value="4">B.Tech - Computer Science</option>
                            <option value="5">MBA - Finance</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Batch & Semester</label>
                        <select id="student_batch_filter" class="form-control">
                            <option value="">-- All Batches --</option>
                        </select>
                    </div> -->


                <div class="form-group">           
                <?= dropdownlist_program(
                $programs,
                set_value('prog_id')
                ); ?>
                <span class="text-danger"><?= form_error('prog_id'); ?></span>
                </div> 

                <div class="form-group">
                <label><?php echo $this->lang->line('batch'); ?> <small class="req">*</small></label>
                <select id="sem_type_students" name="sem_type" class="form-control sem_type">
                <option value="">-- Select Batch & Semester --</option>
                </select>
                <span class="text-danger"><?= form_error('sem_type'); ?></span>
                </div>


                <div class="form-group">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-primary" onclick="loadStudentData()">
                📊 Load Student Data
                </button>
                </div>

                </div>
            </div>




                <div id="studentEmptyState" class="empty-state">
                <h3>👥 Select Batch to View Students</h3>
                <p>Choose a program and batch above to see enrolled students</p>
                </div>

                <div id="studentDetailsSection" style="display: none;">
                <div id="studentSubjectsContainer">
                <!-- Student collapsibles will be populated here -->
                </div>
                </div>




            <!-- Student Details Section -->
            <div id="studentDetailsSection" style="display: none;">
                <div class="student-info-box" id="studentInfoBox">
                    <!-- Student info will be populated here -->
                </div>

                <!-- Subject-wise Attempt Details -->
                <div class="form-section">
                    <div class="section-title">
                        <span class="icon">📊</span>
                        Subject-wise Attempt Status
                    </div>

                    <div id="studentSubjectsContainer">
                        <!-- Student subjects will be populated here -->
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div id="studentEmptyState" class="empty-state">
                <i>👤</i>
                <h3>No Student Selected</h3>
                <p>Search for a student or use filters to load student data</p>
            </div>


        </div>

        <!-- Tab 4: View All Attempts -->
        <div class="tab-content">
            <div class="info-card">
                <strong>📈 Complete Attempt Overview</strong>
                <p>View all configured limits and actual usage across students, subjects, and exam types</p>
            </div>

            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h4>Total Students</h4>
                    <div class="stat-value" id="totalStudents">0</div>
                </div>
                <div class="stat-card" style="border-left-color: #10b981;">
                    <h4>Active Attempts</h4>
                    <div class="stat-value" id="activeAttempts">0</div>
                </div>
                <div class="stat-card" style="border-left-color: #f59e0b;">
                    <h4>Exhausted Limits</h4>
                    <div class="stat-value" id="exhaustedLimits">0</div>
                </div>
                <div class="stat-card" style="border-left-color: #ef4444;">
                    <h4>Overrides</h4>
                    <div class="stat-value" id="totalOverrides">0</div>
                </div>
            </div>

            <div class="form-section">

                <div class="section-title">
                    <span class="icon">🔍</span>
                    Filters
                </div>

                <div class="filter-tags">
                    <div class="filter-tag active" data-filter="all" onclick="applyFilter(this, 'all')">All</div>
                    <div class="filter-tag" data-filter="regular" onclick="applyFilter(this, 'regular')">Regular</div>
                    <div class="filter-tag" data-filter="supplementary" onclick="applyFilter(this, 'supplementary')">Supplementary</div>
                    <div class="filter-tag" data-filter="improvement" onclick="applyFilter(this, 'improvement')">Improvement</div>
                    <div class="filter-tag" data-filter="revaluation" onclick="applyFilter(this, 'revaluation')">Revaluation</div>
                    <div class="filter-tag" data-filter="exhausted" onclick="applyFilter(this, 'exhausted')">Exhausted Only</div>
                    <div class="filter-tag" data-filter="available" onclick="applyFilter(this, 'available')">Available Only</div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Program</label>
                        <select class="form-control" id="viewAllProgram" onchange="filterViewAll()">
                            <option value="">All Programs</option>
                            <option value="1">Degree - Economics</option>
                            <option value="2">Degree - Mathematics</option>
                            <option value="3">Degree - Physics</option>
                            <option value="4">B.Tech - Computer Science</option>
                            <option value="5">MBA - Finance</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Batch</label>
                        <select class="form-control" id="viewAllBatch" onchange="filterViewAll()">
                            <option value="">All Batches</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <select class="form-control" id="viewAllSubject" onchange="filterViewAll()">
                            <option value="">All Subjects</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button class="btn btn-success" onclick="exportToCSV()">📥 Export CSV</button>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <span class="icon">📊</span>
                    Attempt Summary
                </div>

                <div class="table-responsive">
                    <table id="viewAllTable">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Exam Type</th>
                                <th>Max Allowed</th>
                                <th>Used</th>
                                <th>Remaining</th>
                                <th>Status</th>
                                <th>Last Attempt</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="viewAllTableBody">
                            <!-- Will be populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Tab 5: Bulk Configuration -->
        <div class="tab-content">
            <div class="info-card">
                <strong>⚙️ Bulk Configuration</strong>
                <ul>
                    <li>Set attempt limits for multiple subjects at once</li>
                    <li>Copy configuration from one batch to another</li>
                    <li>Import/Export configuration via CSV</li>
                </ul>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <span class="icon">📋</span>
                    Copy Configuration Between Batches
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Copy From (Source) <span class="required">*</span></label>
                        <select class="form-control" id="bulkCopyFrom" required>
                            <option value="">-- Select Source Batch --</option>
                            <option value="1">Degree Economics - Sem1-2023</option>
                            <option value="2">Degree Economics - Sem2-2023</option>
                            <option value="3">Degree Mathematics - Sem1-2023</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Copy To (Destination) <span class="required">*</span></label>
                        <select class="form-control" id="bulkCopyTo" required>
                            <option value="">-- Select Destination Batch --</option>
                            <option value="4">Degree Economics - Sem1-2024</option>
                            <option value="5">Degree Economics - Sem2-2024</option>
                            <option value="6">Degree Mathematics - Sem1-2024</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary" onclick="copyConfiguration()">📋 Copy Configuration</button>
                    </div>
                </div>

                <div class="help-text" style="margin-top: 10px;">
                    ⚠️ This will copy all common limits and subject-specific limits from source to destination
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <span class="icon">📄</span>
                    Import / Export
                </div>

                <div class="btn-container" style="justify-content: flex-start; border: none; padding: 0;">
                    <button class="btn btn-success" onclick="exportConfiguration()">📤 Export Configuration CSV</button>
                    <button class="btn btn-primary" onclick="document.getElementById('importFile').click()">📥 Import CSV</button>
                    <input type="file" id="importFile" accept=".csv" style="display: none;" onchange="importConfiguration(this)">
                    <button class="btn btn-secondary" onclick="downloadTemplate()">📄 Download Template</button>
                </div>

                <div class="help-text" style="margin-top: 10px;">
                    💡 Use template to prepare bulk uploads. Format: Program, Batch, Subject, ExamType, MaxAttempts
                </div>
            </div>

            <div class="form-section">
                <div class="section-title">
                    <span class="icon">🔧</span>
                    Bulk Update Attempts
                </div>


                <div class="info-card" style="background: #fee2e2; border-left-color: #ef4444;">
                    <strong>⚠️ Warning:</strong> This will update ALL students in the selected program/batch. Use with caution!
                </div>

                <form id="bulkUpdateForm" onsubmit="bulkUpdate(event)">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Program <span class="required">*</span></label>
                            <select class="form-control" id="bulkProgram" required onchange="loadBulkBatches()">
                                <option value="">-- Select Program --</option>
                                <option value="1">Degree - Economics</option>
                                <option value="2">Degree - Mathematics</option>
                                <option value="3">Degree - Physics</option>
                                <option value="4">B.Tech - Computer Science</option>
                                <option value="5">MBA - Finance</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Batch <span class="required">*</span></label>
                            <select class="form-control" id="bulkBatch" required>
                                <option value="">-- Select Batch --</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Exam Type <span class="required">*</span></label>
                            <select class="form-control" id="bulkExamType" required>
                                <option value="">-- Select Exam Type --</option>
                                <option value="regular">REGULAR</option>
                                <option value="supplementary">SUPPLEMENTARY</option>
                                <option value="improvement">IMPROVEMENT</option>
                                <option value="revaluation">REVALUATION</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Set Attempts To <span class="required">*</span></label>
                            <input type="number" class="form-control" id="bulkAttempts" placeholder="e.g., 3" min="1" required>
                        </div>

                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-danger">⚡ Apply Bulk Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Override Modal -->
    <div id="overrideModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Override Attempt Limit</h3>
                <button class="close-modal" onclick="closeModal()">&times;</button>
            </div>
            <form id="overrideForm" onsubmit="saveOverride(event)">
                <div class="form-group">
                    <label>Current Limit</label>
                    <input type="text" class="form-control" id="modalCurrentLimit" readonly>
                </div>
                <div class="form-group">
                    <label>New Limit <span class="required">*</span></label>
                    <input type="number" class="form-control" id="modalNewLimit" min="1" required>
                </div>
                <div class="form-group">
                    <label>Reason for Override <span class="required">*</span></label>
                    <textarea class="form-control" id="modalReason" rows="3" required placeholder="Medical emergency, Administrative approval, etc."></textarea>
                </div>
                <div class="btn-container" style="border: none;">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Override</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification" class="notification">
        <span id="notificationIcon"></span>
        <span id="notificationMessage"></span>
    </div>

    </div>



    </section>



    <script>
        // ==================== DATA STORAGE ====================
        let commonLimits = {};
        let subjectLimits = {};
        let studentAttempts = {};
        let currentFilter = 'all';
        let currentStudent = null;

        // Mock Data
        const mockStudents = [
            { id: 1, name: 'John Doe', rollNo: 'EC2023001', program: '1', batch: '1' },
            { id: 2, name: 'Jane Smith', rollNo: 'EC2023045', program: '1', batch: '1' },
            { id: 3, name: 'Mike Johnson', rollNo: 'MA2024012', program: '2', batch: '5' },
            { id: 4, name: 'Sarah Williams', rollNo: 'PH2023078', program: '3', batch: '3' },
            { id: 5, name: 'David Brown', rollNo: 'CS2024055', program: '4', batch: '7' }
        ];

        const mockSubjects = {
            '1': [
                { id: 1, name: 'Mathematics', code: 'MATH101', credits: 4, type: 'Core' },
                { id: 2, name: 'Physics', code: 'PHY101', credits: 4, type: 'Core' },
                { id: 3, name: 'Chemistry', code: 'CHEM101', credits: 4, type: 'Elective' },
                { id: 4, name: 'Economics', code: 'ECO101', credits: 3, type: 'Core' }
            ],
            '2': [
                { id: 5, name: 'Calculus', code: 'CALC201', credits: 5, type: 'Core' },
                { id: 6, name: 'Linear Algebra', code: 'LINA201', credits: 4, type: 'Core' },
                { id: 7, name: 'Statistics', code: 'STAT201', credits: 3, type: 'Elective' }
            ]
        };

        const batchData = {
            '1': [
                { id: 1, name: 'Regular - Sem 1 - 2023' },
                { id: 2, name: 'Regular - Sem 2 - 2023' },
                { id: 3, name: 'Regular - Sem 1 - 2024' },
                { id: 4, name: 'Regular - Sem 2 - 2024' }
            ],
            '2': [
                { id: 5, name: 'Regular - Sem 1 - 2024' },
                { id: 6, name: 'Regular - Sem 2 - 2024' }
            ],
            '3': [
                { id: 7, name: 'Regular - Sem 1 - 2023' },
                { id: 8, name: 'Regular - Sem 2 - 2023' }
            ],
            '4': [
                { id: 9, name: 'Regular - Sem 1 - 2024' },
                { id: 10, name: 'Regular - Sem 2 - 2024' }
            ],
            '5': [
                { id: 11, name: 'Regular - Sem 1 - 2024' },
                { id: 12, name: 'Regular - Sem 2 - 2024' }
            ]
        };

        // ==================== UTILITY FUNCTIONS ====================
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            const icon = document.getElementById('notificationIcon');
            const messageEl = document.getElementById('notificationMessage');

            const icons = {
                success: '✅',
                error: '❌',
                warning: '⚠️'
            };

            icon.textContent = icons[type] || '✅';
            messageEl.textContent = message;
            notification.className = `notification ${type} active`;

            setTimeout(() => {
                notification.classList.remove('active');
            }, 3000);
        }

        function switchTab(index) {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabButtons.forEach((btn, i) => {
                btn.classList.toggle('active', i === index);
            });

            tabContents.forEach((content, i) => {
                content.classList.toggle('active', i === index);
            });

            window.scrollTo({ top: 0, behavior: 'smooth' });

            // Load data for specific tabs
            if (index === 3) {
                loadViewAllData();
            }
        }

        // ==================== TAB 1: COMMON LIMITS ====================
        function loadCommonBatches() {
            const programId = document.getElementById('common_program').value;
            const batchSelect = document.getElementById('common_batch');
            
            batchSelect.innerHTML = '<option value="">-- Select Batch --</option>';
            
            if (programId && batchData[programId]) {
                batchData[programId].forEach(batch => {
                    const option = document.createElement('option');
                    option.value = batch.id;
                    option.textContent = batch.name;
                    batchSelect.appendChild(option);
                });
            }
        }



        function toggleUnlimited(inputId, checkbox)
         {
            const input = document.getElementById(inputId);
            if (checkbox.checked) {
                input.value = 1;
                input.disabled = true;
            } else {
                input.disabled = false;
                if (inputId.includes('regular')) input.value = 1;
                if (inputId.includes('supp')) input.value = 1;
                if (inputId.includes('imp')) input.value = 1;
                if (inputId.includes('reval')) input.value = 1;
            }
        }




        function resetCommonForm() {
            document.getElementById('commonLimitForm').reset();
            document.getElementById('regular_unlimited').checked = true;
            document.getElementById('regular_common').disabled = true;
            document.getElementById('regular_common').value = 999;
            showNotification('Form reset successfully', 'success');
        }

        document.getElementById('commonLimitForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const programId = document.getElementById('common_program').value;
            const batchId = document.getElementById('common_batch').value;

            if (!programId || !batchId) {
                showNotification('Please select both Program and Batch', 'error');
                return;
            }

            const limits = {
                regular: document.getElementById('regular_unlimited').checked ? 'unlimited' : document.getElementById('regular_common').value,
                supplementary: document.getElementById('supp_unlimited').checked ? 'unlimited' : document.getElementById('supp_common').value,
                improvement: document.getElementById('imp_unlimited').checked ? 'unlimited' : document.getElementById('imp_common').value,
                revaluation: document.getElementById('reval_unlimited').checked ? 'unlimited' : document.getElementById('reval_common').value
            };

            const key = `${programId}-${batchId}`;
            commonLimits[key] = limits;

            showNotification('✅ Common limits saved successfully!', 'success');
            console.log('Saved common limits:', commonLimits);
        });

        // ==================== TAB 2: SUBJECT-WISE LIMITS ====================
        function loadSubjectBatches() {
            const programId = document.getElementById('subject_program').value;
            const batchSelect = document.getElementById('subject_batch');
            
            batchSelect.innerHTML = '<option value="">-- Select Batch --</option>';
            
            if (programId && batchData[programId]) {
                batchData[programId].forEach(batch => {
                    const option = document.createElement('option');
                    option.value = batch.id;
                    option.textContent = batch.name;
                    batchSelect.appendChild(option);
                });
            }
        }



            function loadSubjects() 
            { 
            var sem_type = $('#sem_type_subject').val();

            if (!sem_type) {
            alert('Please select Batch & Semester first');
            return;
            }

            // Show loading
            $('#subjectsLoading').show();
            $('#subjectsContainer').show();
            $('#subjectCards').html('');
            $('#subjectFormButtons').hide();

            $.ajax({
            url: '<?php echo site_url('semester_exam/exam_attempt/getexam_subjects'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 
            sem_type: sem_type
            },
            success: function(response) 
            {

          

            $('#subjectsLoading').hide();

            if (response && response.length > 0) {
            let cardsHtml = '';

            response.forEach(function(subject) {
            cardsHtml += createSubjectCard(subject);
            });

            $('#subjectCards').html(cardsHtml);
            $('#subjectFormButtons').show();
            showNotification('Subjects loaded successfully', 'success');
            } else {
            $('#subjectCards').html('<p style="text-align:center; color:#999;">No subjects found for this batch.</p>');
            showNotification('No subjects found', 'warning');
            }
            },
            error: function(xhr, status, error) {
            $('#subjectsLoading').hide();
            console.error('Error loading subjects:', error);
            showNotification('Error loading subjects. Please try again.', 'error');
            }
            });
            }




            function createSubjectCard(subject) {
    const icons = {
        'Mathematics': '📐',
        'Physics': '⚛️',
        'Chemistry': '🧪',
        'Biology': '🧬',
        'Computer Science': '💻',
        'Economics': '💰',
        'English': '📖',
        'History': '📜',
        'Geography': '🗺️'
    };

    // Get icon based on subject name, default to 📚
    const icon = icons[subject.name] || '📚';
    
    // Badge color based on subject type
    const badgeClass = subject.type === 'Core' ? 'badge-info' : 
                       subject.type === 'Elective' ? 'badge-warning' : 
                       'badge-secondary';

    return `
        <div class="subject-card">
            <div class="subject-header">
                <div>
                    <div class="subject-name">${icon} ${subject.name}</div>
                    ${subject.arabic_name ? `<div class="subject-arabic" style="font-size: 14px; color: #666; direction: rtl;">${subject.arabic_name}</div>` : ''}
                    <div class="subject-code">Code: ${subject.code || 'N/A'}</div>
                </div>
                <span class="badge ${badgeClass}">${subject.type || 'General'}</span>
            </div>
            <div class="attempt-grid">
                <div class="attempt-item">
                    <div class="attempt-label">📝 Regular</div>
                    <input type="number" 
                           name="subject_attempts[${subject.id}][regular]" 
                           class="form-control attempt-input" 
                           placeholder="Default: Unlimited" 
                           min="1">
                </div>
                <div class="attempt-item">
                    <div class="attempt-label">📋 Supplementary</div>
                    <input type="number" 
                           name="subject_attempts[${subject.id}][say_exam]" 
                           class="form-control attempt-input" 
                           placeholder="Default: 3" 
                           min="1">
                </div>
                <div class="attempt-item">
                    <div class="attempt-label">📈 Improvement</div>
                    <input type="number" 
                           name="subject_attempts[${subject.id}][improvement]" 
                           class="form-control attempt-input" 
                           placeholder="Default: 1" 
                           min="1">
                </div>
                <div class="attempt-item">
                    <div class="attempt-label">🔍 Revaluation</div>
                    <input type="number" 
                           name="subject_attempts[${subject.id}][revaluation]" 
                           class="form-control attempt-input" 
                           placeholder="Default: 1" 
                           min="1">
                </div>
            </div>
        </div>
    `;
}

function showNotification(message, type) 
{
    // Simple alert for now - you can replace with better notification
    if (type === 'error') {
        alert('❌ ' + message);
    } else if (type === 'success') {
        alert('✅ ' + message);
    } else {
        alert('ℹ️ ' + message);
    }
}


        
        // function loadSubjects() 
        // { 
            
        // var sem_type = $('#sem_type_subject').val();
        // alert(sem_type)

        //             $.ajax({
        //             url: '<?php echo site_url('semester_exam/exam_attempt/getexam_subjects'); ?>',
        //             type: 'POST',
        //             data: { 
        //             sem_type: sem_type,                  
        //             },
        //             success: function(response) {
                     


        //             }
        //             });

           
            
        //     // const programId = document.getElementById('subject_program').value;
        //     // const batchId = document.getElementById('subject_batch').value;

        //     // if (!programId || !batchId) {
        //     //     showNotification('Please select both Program and Batch', 'error');
        //     //     return;
        //     // }

        //     // // Show loading
        //     // document.getElementById('subjectsLoading').style.display = 'block';
        //     // document.getElementById('subjectsContainer').style.display = 'block';
        //     // document.getElementById('subjectCards').innerHTML = '';

        //     // // Simulate API call
        //     // setTimeout(() => {
        //     //     document.getElementById('subjectsLoading').style.display = 'none';
                
        //     //     const subjects = mockSubjects[programId] || mockSubjects['1'];
        //     //     const cardsContainer = document.getElementById('subjectCards');
                
        //     //     subjects.forEach(subject => {
        //     //         const card = createSubjectCard(subject);
        //     //         cardsContainer.innerHTML += card;
        //     //     });

        //     //     document.getElementById('subjectFormButtons').style.display = 'flex';
        //     //     showNotification('Subjects loaded successfully', 'success');
        //     // }, 1000);


        // }



        // function createSubjectCard(subject) {
        //     const icons = {
        //         'Mathematics': '📐',
        //         'Physics': '⚛️',
        //         'Chemistry': '🧪',
        //         'Economics': '💰',
        //         'Calculus': '∫',
        //         'Linear Algebra': '📊',
        //         'Statistics': '📈'
        //     };

        //     const icon = icons[subject.name] || '📚';
        //     const badgeClass = subject.type === 'Core' ? 'badge-info' : 'badge-warning';

        //     return `
        //         <div class="subject-card">
        //             <div class="subject-header">
        //                 <div>
        //                     <div class="subject-name">${icon} ${subject.name}</div>
        //                     <div class="subject-code">Code: ${subject.code} | Credits: ${subject.credits}</div>
        //                 </div>
        //                 <span class="badge ${badgeClass}">${subject.type} Subject</span>
        //             </div>
        //             <div class="attempt-grid">
        //                 <div class="attempt-item">
        //                     <div class="attempt-label">Regular</div>
        //                     <input type="number" class="form-control attempt-input" 
        //                            data-subject="${subject.id}" data-type="regular"
        //                            placeholder="Default: Unlimited" min="1">
        //                 </div>
        //                 <div class="attempt-item">
        //                     <div class="attempt-label">Supplementary</div>
        //                     <input type="number" class="form-control attempt-input" 
        //                            data-subject="${subject.id}" data-type="supplementary"
        //                            placeholder="Default: 3" min="1">
        //                 </div>
        //                 <div class="attempt-item">
        //                     <div class="attempt-label">Improvement</div>
        //                     <input type="number" class="form-control attempt-input" 
        //                            data-subject="${subject.id}" data-type="improvement"
        //                            placeholder="Default: 1" min="1">
        //                 </div>
        //                 <div class="attempt-item">
        //                     <div class="attempt-label">Revaluation</div>
        //                     <input type="number" class="form-control attempt-input" 
        //                            data-subject="${subject.id}" data-type="revaluation"
        //                            placeholder="Default: 1" min="1">
        //                 </div>
        //             </div>
        //         </div>
        //     `;
        // }

        function resetSubjectForm() {
            document.getElementById('subjectLimitForm').reset();
            document.getElementById('subjectsContainer').style.display = 'none';
            document.getElementById('subjectFormButtons').style.display = 'none';
            showNotification('Form reset successfully', 'success');
        }

        document.getElementById('subjectLimitForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const inputs = document.querySelectorAll('.attempt-input[data-subject]');
            const limits = {};

            inputs.forEach(input => {
                if (input.value) {
                    const subjectId = input.dataset.subject;
                    const type = input.dataset.type;
                    
                    if (!limits[subjectId]) {
                        limits[subjectId] = {};
                    }
                    
                    limits[subjectId][type] = input.value;
                }
            });

            const programId = document.getElementById('subject_program').value;
            const batchId = document.getElementById('subject_batch').value;
            const key = `${programId}-${batchId}`;
            
            subjectLimits[key] = limits;

            showNotification('✅ Subject-wise limits saved successfully!', 'success');
            console.log('Saved subject limits:', subjectLimits);
        });

        // ==================== TAB 3: STUDENT TRACKING ====================
        function loadStudentBatches() {
            const programId = document.getElementById('student_program_filter').value;
            const batchSelect = document.getElementById('student_batch_filter');
            
            batchSelect.innerHTML = '<option value="">-- All Batches --</option>';
            
            if (programId && batchData[programId]) {
                batchData[programId].forEach(batch => {
                    const option = document.createElement('option');
                    option.value = batch.id;
                    option.textContent = batch.name;
                    batchSelect.appendChild(option);
                });
            }
        }

        function searchStudent() {
            const searchTerm = document.getElementById('student_search').value.toLowerCase();
            const resultsContainer = document.getElementById('studentSearchResults');
            
            if (searchTerm.length < 2) {
                resultsContainer.classList.remove('active');
                return;
            }

            const results = mockStudents.filter(student => 
                student.name.toLowerCase().includes(searchTerm) ||
                student.rollNo.toLowerCase().includes(searchTerm)
            );

            if (results.length > 0) {
                resultsContainer.innerHTML = results.map(student => `
                    <div class="student-result-item" onclick="selectStudent(${student.id})">
                        <strong>${student.name}</strong><br>
                        <small>${student.rollNo}</small>
                    </div>
                `).join('');
                resultsContainer.classList.add('active');
            } else {
                resultsContainer.innerHTML = '<div class="student-result-item">No students found</div>';
                resultsContainer.classList.add('active');
            }
        }

        function selectStudent(studentId) {
            const student = mockStudents.find(s => s.id === studentId);
            if (student) {
                currentStudent = student;
                document.getElementById('student_search').value = `${student.name} (${student.rollNo})`;
                document.getElementById('studentSearchResults').classList.remove('active');
                loadStudentData();
            }
        }





        function loadStudentData() 
        {
            var sem_type = $('#sem_type_students').val();
            
            if (!sem_type) {
                alert('Please select Batch & Semester first');
                return;
            }
            
            // Show loading
            $('#studentEmptyState').html('<p style="text-align: center;">Loading students...</p>').show();
            $('#studentDetailsSection').hide();
            
            $.ajax({
                url: '<?php echo site_url('semester_exam/exam_attempt/getexam_students'); ?>',
                type: 'POST',
                dataType: 'json',
                data: { 
                    sem_type: sem_type
                },
                success: function(response) {
                    console.log('Students loaded:', response);
                    
                    if (response && response.length > 0) {
                        displayStudentsCollapsible(response, sem_type);
                    } else {
                        $('#studentEmptyState').html(`
                            <div style="text-align: center; padding: 40px;">
                                <h3>👥 No Students Found</h3>
                                <p>No students enrolled in this batch.</p>
                            </div>
                        `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading students:', xhr.responseText);
                    alert('Error loading students');
                }
            });
        }




function displayStudentsCollapsible(students, sem_type) {
    $('#studentEmptyState').hide();
    $('#studentDetailsSection').show();
    
    let html = `
        <div class="info-card" style="background: #e3f2fd; border-left-color: #2196F3; margin-bottom: 20px;">
            <h4>👥 Students in this Batch: ${students.length}</h4>
            <p>Click on a student to view their exam attempt details</p>
        </div>
    `;
    
    students.forEach(function(student, index) {
        html += createStudentCollapsible(student, index, sem_type);
    });
    
    $('#studentSubjectsContainer').html(html);
}



function createStudentCollapsible(student, index, sem_type) {
    const studentName = `${student.firstname} ${student.lastname}`;
    const rollNo = student.roll_no || student.admission_no;
    
    return `
        <div class="student-collapsible-wrapper">
            <button class="collapsible student-collapsible" onclick="toggleStudentCollapsible(this, ${student.student_id}, ${sem_type})">
                <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                    <div class="student-avatar">👤</div>
                    <div style="text-align: left;">
                        <div style="font-size: 16px; font-weight: 600;">${studentName}</div>
                        <div style="font-size: 13px; color: #666; margin-top: 3px;">
                            Roll No: ${rollNo}
                        </div>
                    </div>
                </div>
                <span class="collapse-icon">▼</span>
            </button>
            <div class="collapsible-content" id="student-content-${student.student_id}">
                <div class="loading-placeholder" style="padding: 20px; text-align: center; color: #999;">
                    Click to load student details...
                </div>
            </div>
        </div>
    `;
}




function toggleCollapsible(button) 
{
    button.classList.toggle("active");
    const content = button.nextElementSibling;
    
    if (content.style.maxHeight) {
        content.style.maxHeight = null;
    } else {
        content.style.maxHeight = content.scrollHeight + "px";
        
        // Update parent student collapsible height
        const parentContent = button.closest('.student-collapsible-wrapper')?.querySelector('.collapsible-content');
        if (parentContent) {
            setTimeout(function() {
                parentContent.style.maxHeight = parentContent.scrollHeight + "px";
            }, 100);
        }
    }
}



function toggleStudentCollapsible(button, studentId, semType) 
{
    const content = document.getElementById(`student-content-${studentId}`);
    const isOpen = content.style.maxHeight;
    
    // Close all other student collapsibles
    document.querySelectorAll('.student-collapsible-wrapper .collapsible-content').forEach(function(item) {
        item.style.maxHeight = null;
        item.previousElementSibling.classList.remove('active');
    });
    
    // Toggle current
    if (isOpen) {
        content.style.maxHeight = null;
        button.classList.remove('active');
    } else {
        button.classList.add('active');
        
        // Load subjects if not already loaded
        if (content.querySelector('.loading-placeholder')) {
            loadStudentSubjectsInline(studentId, semType, content);
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    }
}




function loadStudentSubjectsInline(studentId, semType, contentElement) 
{
    // Show loading
    contentElement.innerHTML = '<p style="text-align: center; padding: 20px;">Loading subjects...</p>';
    contentElement.style.maxHeight = "100px";
    
    $.ajax({
        url: '<?php echo site_url('semester_exam/exam_attempt/get_student_subjects'); ?>',
        type: 'POST',
        dataType: 'json',
        data: {
            student_id: studentId,
            sem_type: semType
        },
        success: function(response) {
            console.log('Student subjects loaded:', response);
            
            if (response && response.length > 0) {
                let html = '<div class="student-subjects-container">';
                
                response.forEach(function(subject, index) {
                    html += createStudentSubjectCollapsible(subject, index);
                });
                
                html += '</div>';
                contentElement.innerHTML = html;
                
                // Animate to full height
                setTimeout(function() {
                    contentElement.style.maxHeight = contentElement.scrollHeight + "px";
                }, 100);
            } else {
                contentElement.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: #999;">
                        <h4>📚 No Subjects Found</h4>
                        <p>No subjects assigned to this student.</p>
                    </div>
                `;
                contentElement.style.maxHeight = "150px";
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading subjects:', xhr.responseText);
            contentElement.innerHTML = `
                <div style="text-align: center; padding: 40px; color: red;">
                    <h4>❌ Error Loading Subjects</h4>
                    <p>Please try again.</p>
                </div>
            `;
            contentElement.style.maxHeight = "150px";
        }
    });
}



// function displayStudentList(students, sem_type) {
//     // Hide empty state and show student list
//     $('#studentEmptyState').hide();
    
//     // Create student list HTML
//     let html = `
//         <div class="info-card" style="background: #e3f2fd; border-left-color: #2196F3; margin-bottom: 20px;">
//             <h4>👥 Students in this Batch: ${students.length}</h4>
//             <p>Click on a student to view their exam attempt details</p>
//         </div>
//         <div class="student-list">
//     `;
    
//     students.forEach(function(student) {
//         html += `
//             <div class="student-item" onclick="selectStudent(${student.student_id}, '${student.firstname}', '${student.lastname}', '${student.admission_no || ''}', '${student.roll_no || ''}', ${sem_type})">
//                 <div style="display: flex; align-items: center; gap: 10px;">
//                     <div class="student-avatar">👤</div>
//                     <div>
//                         <strong>${student.firstname} ${student.lastname}</strong>
//                         <br>
//                         <small style="color: #666;">
//                             ${student.roll_no ? 'Roll: ' + student.roll_no : 'Adm: ' + student.admission_no}
//                         </small>
//                     </div>
//                 </div>
//                 <div style="margin-top: 5px;">
//                     <span class="badge badge-info" style="font-size: 11px;">View Details →</span>
//                 </div>
//             </div>
//         `;
//     });
    
//     html += `
//         </div>
//     `;
    
//     // Insert before the details section
//     $('#studentEmptyState').html(html).show();
// }







            // function loadStudentData() 
            // {

            // var sem_type = $('#sem_type_students').val();
            // $.ajax({
            // url: '<?php echo site_url('semester_exam/exam_attempt/getexam_students'); ?>',
            // type: 'POST',
            // data: { 
            // sem_type: sem_type,
           
            // },
            // success: function(response)
            // {

            //     console.log(response)          
          
            // }
            // });


            // if (!currentStudent) {
            //     const programId = document.getElementById('student_program_filter').value;
            //     const batchId = document.getElementById('student_batch_filter').value;
                
            //     if (!programId || !batchId) {
            //         showNotification('Please select a student or use filters', 'warning');
            //         return;
            //     }
                
            //     // Use first student as demo
            //     currentStudent = mockStudents[0];
            // }

            // document.getElementById('studentEmptyState').style.display = 'none';
            // document.getElementById('studentDetailsSection').style.display = 'block';

            // // Populate student info
            // const infoBox = document.getElementById('studentInfoBox');
            // const programName = document.querySelector(`#student_program_filter option[value="${currentStudent.program}"]`)?.textContent || 'Degree - Economics';
            // const batchName = batchData[currentStudent.program]?.[0]?.name || 'Regular - Sem 1 - 2023';

            // infoBox.innerHTML = `
            //     <h3>👤 Student Information</h3>
            //     <p><strong>Name:</strong> ${currentStudent.name}</p>
            //     <p><strong>Roll Number:</strong> ${currentStudent.rollNo}</p>
            //     <p><strong>Program:</strong> ${programName}</p>
            //     <p><strong>Batch:</strong> ${batchName}</p>
            // `;         
            // loadStudentSubjects();


        // }



        function loadStudentSubjects()
         {
            const subjects = mockSubjects[currentStudent.program] || mockSubjects['1'];
            const container = document.getElementById('studentSubjectsContainer');
            
            container.innerHTML = subjects.map((subject, index) => 
                createStudentSubjectCollapsible(subject, index)
            ).join('');
        }

        function createStudentSubjectCollapsible(subject, index) {
            const icons = {
                'Mathematics': '📐',
                'Physics': '⚛️',
                'Chemistry': '🧪',
                'Economics': '💰'
            };

            const icon = icons[subject.name] || '📚';
            const attempts = generateMockAttempts(subject.name);

            return `
                <button class="collapsible" onclick="toggleCollapsible(this)">
                    <span>${icon} ${subject.name} (${subject.code})</span>
                    <span>▼</span>
                </button>
                <div class="collapsible-content">
                    ${createAttemptTable(attempts)}
                    ${createAttemptHistory(subject.name)}
                </div>
            `;
        }



        function generateMockAttempts(subjectName) {
            const templates = {
                'Mathematics': [
                    { type: 'REGULAR', max: 'Unlimited', used: 2, remaining: '∞', status: 'allowed', statusText: 'Allowed' },
                    { type: 'SUPPLEMENTARY', max: 3, used: 2, remaining: 1, status: 'limited', statusText: 'Limited' },
                    { type: 'IMPROVEMENT', max: 1, used: 1, remaining: 0, status: 'exhausted', statusText: 'Exhausted' },
                    { type: 'REVALUATION', max: 1, used: 0, remaining: 1, status: 'allowed', statusText: 'Available' }
                ],
                'Physics': [
                    { type: 'REGULAR', max: 'Unlimited', used: 1, remaining: '∞', status: 'allowed', statusText: 'Allowed' },
                    { type: 'SUPPLEMENTARY', max: 3, used: 0, remaining: 3, status: 'allowed', statusText: 'Available' },
                    { type: 'IMPROVEMENT', max: 1, used: 0, remaining: 1, status: 'allowed', statusText: 'Available' },
                    { type: 'REVALUATION', max: 1, used: 0, remaining: 1, status: 'allowed', statusText: 'Available' }
                ],
                'Chemistry': [
                    { type: 'REGULAR', max: 'Unlimited', used: 1, remaining: '∞', status: 'allowed', statusText: 'Allowed' },
                    { type: 'SUPPLEMENTARY', max: 3, used: 3, remaining: 0, status: 'exhausted', statusText: 'Exhausted' },
                    { type: 'IMPROVEMENT', max: 1, used: 0, remaining: 1, status: 'allowed', statusText: 'Available' },
                    { type: 'REVALUATION', max: 1, used: 1, remaining: 0, status: 'exhausted', statusText: 'Exhausted' }
                ]
            };

            return templates[subjectName] || templates['Physics'];
        }

        function createAttemptTable(attempts) {
            return `
                <table>
                    <thead>
                        <tr>
                            <th>Exam Type</th>
                            <th>Max Allowed</th>
                            <th>Used</th>
                            <th>Remaining</th>
                            <th>Status</th>
                            <th>Override</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${attempts.map(attempt => `
                            <tr>
                                <td><strong>📝 ${attempt.type}</strong></td>
                                <td>${typeof attempt.max === 'string' ? '<span class="badge badge-success">Unlimited</span>' : attempt.max}</td>
                                <td>${attempt.used}</td>
                                <td>${attempt.remaining}</td>
                                <td>
                                    <span class="status-indicator status-${attempt.status}"></span>
                                    ${attempt.statusText}
                                </td>
                                <td>
                                    <button class="btn ${attempt.status === 'exhausted' ? 'btn-danger' : 'btn-primary'}" 
                                            style="padding: 6px 12px; font-size: 12px;"
                                            onclick="openOverrideModal('${attempt.type}', ${attempt.max})">
                                        ${attempt.status === 'exhausted' ? '⚠️ Override' : '✏️ Edit'}
                                    </button>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
        }

        function createAttemptHistory(subjectName) {
            const histories = {
                'Mathematics': [
                    { date: 'Dec 2023', type: 'REGULAR', attempt: 1, marks: '35/100', status: 'Failed' },
                    { date: 'Mar 2024', type: 'SUPPLEMENTARY', attempt: 1, marks: '42/100', status: 'Failed' },
                    { date: 'Jun 2024', type: 'SUPPLEMENTARY', attempt: 2, marks: '55/100', status: 'Passed' },
                    { date: 'Aug 2024', type: 'IMPROVEMENT', attempt: 1, marks: '68/100', status: 'Improved' }
                ],
                'Physics': [
                    { date: 'Dec 2023', type: 'REGULAR', attempt: 1, marks: '72/100', status: 'Passed' }
                ],
                'Chemistry': [
                    { date: 'Dec 2023', type: 'REGULAR', attempt: 1, marks: '38/100', status: 'Failed' },
                    { date: 'Mar 2024', type: 'SUPPLEMENTARY', attempt: 1, marks: '45/100', status: 'Failed' },
                    { date: 'Jun 2024', type: 'SUPPLEMENTARY', attempt: 2, marks: '48/100', status: 'Failed' },
                    { date: 'Sep 2024', type: 'SUPPLEMENTARY', attempt: 3, marks: '49/100', status: 'Failed' },
                    { date: 'Nov 2024', type: 'REVALUATION', attempt: 1, marks: '49/100', status: 'No Change' }
                ]
            };

            const history = histories[subjectName] || histories['Physics'];

            return `
                <div style="margin-top: 20px;">
                    <h4 style="margin-bottom: 10px;">📜 Attempt History</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Exam Type</th>
                                <th>Attempt No.</th>
                                <th>Marks</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${history.map(h => `
                                <tr>
                                    <td>${h.date}</td>
                                    <td><span class="badge ${getBadgeClass(h.type)}">${h.type}</span></td>
                                    <td>${h.attempt}</td>
                                    <td>${h.marks}</td>
                                    <td><span class="badge ${h.status === 'Passed' || h.status === 'Improved' ? 'badge-success' : 'badge-danger'}">${h.status}</span></td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            `;
        }

        function getBadgeClass(type) {
            const classes = {
                'REGULAR': 'badge-success',
                'SUPPLEMENTARY': 'badge-warning',
                'IMPROVEMENT': 'badge-info',
                'REVALUATION': 'badge-danger'
            };
            return classes[type] || 'badge-info';
        }

        function toggleCollapsible(button) {
            button.classList.toggle('active');
            const content = button.nextElementSibling;
            content.classList.toggle('active');
            
            const icon = button.querySelector('span:last-child');
            icon.textContent = content.classList.contains('active') ? '▲' : '▼';
        }

        // ==================== TAB 4: VIEW ALL ATTEMPTS ====================
        function loadViewAllData() {
            // Update statistics
            document.getElementById('totalStudents').textContent = mockStudents.length;
            document.getElementById('activeAttempts').textContent = '47';
            document.getElementById('exhaustedLimits').textContent = '8';
            document.getElementById('totalOverrides').textContent = '3';

            // Load table data
            const tbody = document.getElementById('viewAllTableBody');
            tbody.innerHTML = `
                <tr data-filter="supplementary limited">
                    <td><strong>John Doe</strong><br><small>EC2023001</small></td>
                    <td>Mathematics</td>
                    <td><span class="badge badge-warning">SUPPLEMENTARY</span></td>
                    <td>3</td>
                    <td>2</td>
                    <td>1</td>
                    <td><span class="status-indicator status-limited"></span> Limited</td>
                    <td>Jun 2024</td>
                    <td><button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="viewStudentDetails(1)">👁️ View</button></td>
                </tr>
                <tr data-filter="improvement exhausted">
                    <td><strong>John Doe</strong><br><small>EC2023001</small></td>
                    <td>Mathematics</td>
                    <td><span class="badge badge-info">IMPROVEMENT</span></td>
                    <td>1</td>
                    <td>1</td>
                    <td>0</td>
                    <td><span class="status-indicator status-exhausted"></span> Exhausted</td>
                    <td>Aug 2024</td>
                    <td><button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="viewStudentDetails(1)">👁️ View</button></td>
                </tr>
                <tr data-filter="supplementary exhausted">
                    <td><strong>John Doe</strong><br><small>EC2023001</small></td>
                    <td>Chemistry</td>
                    <td><span class="badge badge-warning">SUPPLEMENTARY</span></td>
                    <td>3</td>
                    <td>3</td>
                    <td>0</td>
                    <td><span class="status-indicator status-exhausted"></span> Exhausted</td>
                    <td>Sep 2024</td>
                    <td><button class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="openOverrideModal('SUPPLEMENTARY', 3)">⚠️ Override</button></td>
                </tr>
                <tr data-filter="improvement available">
                    <td><strong>Jane Smith</strong><br><small>EC2023045</small></td>
                    <td>Physics</td>
                    <td><span class="badge badge-info">IMPROVEMENT</span></td>
                    <td>1</td>
                    <td>0</td>
                    <td>1</td>
                    <td><span class="status-indicator status-allowed"></span> Available</td>
                    <td>-</td>
                    <td><button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="viewStudentDetails(2)">👁️ View</button></td>
                </tr>
                <tr data-filter="supplementary available">
                    <td><strong>Mike Johnson</strong><br><small>MA2024012</small></td>
                    <td>Calculus</td>
                    <td><span class="badge badge-warning">SUPPLEMENTARY</span></td>
                    <td>5 <small>(Personal)</small></td>
                    <td>3</td>
                    <td>2</td>
                    <td><span class="status-indicator status-allowed"></span> Available</td>
                    <td>Aug 2024</td>
                    <td><button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="viewStudentDetails(3)">👁️ View</button></td>
                </tr>
            `;
        }

        function applyFilter(element, filter) {
            // Update active state
            document.querySelectorAll('.filter-tag').forEach(tag => tag.classList.remove('active'));
            element.classList.add('active');
            
            currentFilter = filter;
            filterViewAll();
        }

        function filterViewAll() {
            const rows = document.querySelectorAll('#viewAllTableBody tr');
            
            rows.forEach(row => {
                const rowFilters = row.dataset.filter || '';
                
                if (currentFilter === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = rowFilters.includes(currentFilter) ? '' : 'none';
                }
            });
        }

        function viewStudentDetails(studentId) {
            currentStudent = mockStudents.find(s => s.id === studentId);
            switchTab(2);
            loadStudentData();
        }

        function exportToCSV() {
            const rows = [
                ['Student Name', 'Roll Number', 'Subject', 'Exam Type', 'Max Allowed', 'Used', 'Remaining', 'Status', 'Last Attempt'],
                ['John Doe', 'EC2023001', 'Mathematics', 'SUPPLEMENTARY', '3', '2', '1', 'Limited', 'Jun 2024'],
                ['John Doe', 'EC2023001', 'Mathematics', 'IMPROVEMENT', '1', '1', '0', 'Exhausted', 'Aug 2024'],
                ['John Doe', 'EC2023001', 'Chemistry', 'SUPPLEMENTARY', '3', '3', '0', 'Exhausted', 'Sep 2024'],
                ['Jane Smith', 'EC2023045', 'Physics', 'IMPROVEMENT', '1', '0', '1', 'Available', '-'],
                ['Mike Johnson', 'MA2024012', 'Calculus', 'SUPPLEMENTARY', '5', '3', '2', 'Available', 'Aug 2024']
            ];

            const csvContent = rows.map(row => row.join(',')).join('\n');
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'exam_attempts_export.csv';
            a.click();
            
            showNotification('CSV exported successfully', 'success');
        }

        // ==================== TAB 5: BULK CONFIGURATION ====================
        function loadBulkBatches() {
            const programId = document.getElementById('bulkProgram').value;
            const batchSelect = document.getElementById('bulkBatch');
            
            batchSelect.innerHTML = '<option value="">-- Select Batch --</option>';
            
            if (programId && batchData[programId]) {
                batchData[programId].forEach(batch => {
                    const option = document.createElement('option');
                    option.value = batch.id;
                    option.textContent = batch.name;
                    batchSelect.appendChild(option);
                });
            }
        }

        function copyConfiguration() {
            const from = document.getElementById('bulkCopyFrom').value;
            const to = document.getElementById('bulkCopyTo').value;

            if (!from || !to) {
                showNotification('Please select both source and destination', 'error');
                return;
            }

            if (from === to) {
                showNotification('Source and destination cannot be the same', 'error');
                return;
            }

            showNotification('✅ Configuration copied successfully!', 'success');
            console.log(`Copied configuration from ${from} to ${to}`);
        }

        function exportConfiguration() {
            const config = [
                ['Program', 'Batch', 'Subject', 'Exam Type', 'Max Attempts'],
                ['Degree Economics', 'Sem1-2023', 'Mathematics', 'REGULAR', 'Unlimited'],
                ['Degree Economics', 'Sem1-2023', 'Mathematics', 'SUPPLEMENTARY', '3'],
                ['Degree Economics', 'Sem1-2023', 'Physics', 'REGULAR', 'Unlimited'],
                ['Degree Economics', 'Sem1-2023', 'Physics', 'SUPPLEMENTARY', '3']
            ];

            const csvContent = config.map(row => row.join(',')).join('\n');
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'configuration_export.csv';
            a.click();
            
            showNotification('Configuration exported successfully', 'success');
        }

        function importConfiguration(input) {
            const file = input.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const content = e.target.result;
                // Process CSV content here
                showNotification('✅ Configuration imported successfully!', 'success');
                console.log('Imported:', content);
            };
            reader.readAsText(file);
        }

        function downloadTemplate() {
            const template = [
                ['Program', 'Batch', 'Subject', 'Exam Type', 'Max Attempts'],
                ['Degree Economics', 'Sem1-2024', 'Mathematics', 'REGULAR', 'Unlimited'],
                ['Degree Economics', 'Sem1-2024', 'Mathematics', 'SUPPLEMENTARY', '3'],
                ['Degree Economics', 'Sem1-2024', 'Mathematics', 'IMPROVEMENT', '1'],
                ['Degree Economics', 'Sem1-2024', 'Mathematics', 'REVALUATION', '1']
            ];

            const csvContent = template.map(row => row.join(',')).join('\n');
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'configuration_template.csv';
            a.click();
            
            showNotification('Template downloaded successfully', 'success');
        }

        function bulkUpdate(event) {
            event.preventDefault();

            const program = document.getElementById('bulkProgram').value;
            const batch = document.getElementById('bulkBatch').value;
            const examType = document.getElementById('bulkExamType').value;
            const attempts = document.getElementById('bulkAttempts').value;

            if (!program || !batch || !examType || !attempts) {
                showNotification('Please fill all fields', 'error');
                return;
            }

            const confirmation = confirm(`Are you sure you want to update ${examType.toUpperCase()} attempts to ${attempts} for all students in this batch?`);
            
            if (confirmation) {
                showNotification('✅ Bulk update applied successfully!', 'success');
                console.log('Bulk update:', { program, batch, examType, attempts });
                document.getElementById('bulkUpdateForm').reset();
            }
        }

        // ==================== MODAL FUNCTIONS ====================
        function openOverrideModal(examType, currentLimit) {
            document.getElementById('modalCurrentLimit').value = `${examType}: ${currentLimit}`;
            document.getElementById('modalNewLimit').value = '';
            document.getElementById('modalReason').value = '';
            document.getElementById('overrideModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('overrideModal').classList.remove('active');
        }

        function saveOverride(event) {
            event.preventDefault();
            
            const newLimit = document.getElementById('modalNewLimit').value;
            const reason = document.getElementById('modalReason').value;

            showNotification('✅ Override saved successfully!', 'success');
            console.log('Override:', { newLimit, reason });
            
            closeModal();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('overrideModal');
            if (event.target === modal) {
                closeModal();
            }

            // Close search results when clicking outside
            const searchResults = document.getElementById('studentSearchResults');
            const searchBox = document.querySelector('.search-box');
            if (!searchBox.contains(event.target)) {
                searchResults.classList.remove('active');
            }
        }

        // ==================== INITIALIZATION ====================
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Exam Attempt Management System Initialized');
            
            // Set default values
            document.getElementById('regular_common').value = 999;
            document.getElementById('supp_common').value = 3;
            document.getElementById('imp_common').value = 1;
            document.getElementById('reval_common').value = 1;
        });
    </script>

