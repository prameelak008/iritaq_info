<?php
/*
?>

<style>
    .student-profile-card {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
    }

    .student-profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }

    .profile-image-wrapper {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        border: 4px solid #f7fafc;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-placeholder {
        font-size: 48px;
        color: #fff;
        font-weight: 700;
    }

    .student-name {
        font-size: 22px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        margin: 0 auto 20px;
        border-radius: 2px;
    }

    .student-details {
        text-align: left;
        padding-top: 10px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 14px;
    }

    .info-value {
        color: #718096;
        font-size: 14px;
        text-align: right;
    }

    .badge-custom {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        background: #e6fffa;
        color: #047857;
        margin-top: 15px;
    }
</style>

<style>
    .tabs-card {
        background: #fff;
        border-radius: 15px;
        padding: 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .tabs-header {
        display: flex;
        background: #f7fafc;
        border-bottom: 2px solid #e2e8f0;
    }

    .tab-btn {
        flex: 1;
        padding: 15px 20px;
        background: transparent;
        border: none;
        color: #718096;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .tab-btn:hover {
        background: #edf2f7;
        color: #4a5568;
    }

    .tab-btn.active {
        color: #667eea;
        background: #fff;
    }

    .tab-btn.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    .tabs-content {
        padding: 25px;
        min-height: 300px;
    }

    .tab-pane {
        display: none;
        animation: fadeIn 0.3s ease;
    }

    .tab-pane.active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .detail-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #4a5568;
        min-width: 140px;
        font-size: 14px;
    }

    .detail-value {
        color: #718096;
        font-size: 14px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
    }
</style>
 
 
 
 <main class="main-content" id="mainContent">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col">
                <h2 class="mb-1">Dashboard</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- ADD THIS ROW WRAPPER -->
        <div class="row">
            <!-- Profile Card -->
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="student-profile-card">
                    <!-- Profile Image -->
                    <div class="profile-image-wrapper">
                        <?php if(!empty($student->image)): ?>
                            <img src="<?php echo $student->image; ?>" alt="Profile" class="profile-image">
                        <?php else: ?>
                            <div class="profile-placeholder">
                                <?php echo strtoupper(substr($student->firstname, 0, 1)); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Student Name -->
                    <h3 class="student-name">
                        <?php echo $student->firstname . ' ' . $student->lastname; ?>
                    </h3>

                    <!-- Divider -->
                    <div class="divider"></div>

                    <!-- Student Details List -->
                    <div class="student-details">
                       
                        
                        <div class="info-item">
                            <span class="info-label">Admission No</span>
                            <span class="info-value"><?php echo $student->admission_no; ?></span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Roll No</span>
                            <span class="info-value"><?php echo $student->roll_no; ?></span>
                        </div>

                         <div class="info-item">
                            <span class="info-label">Program</span>
                            <span class="info-value"><?php echo $student->p_name; ?></span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Semester</span>
                            <span class="info-value"><?php echo $student->stm_name; ?></span>
                        </div>

                        

                        <div class="info-item">
                            <span class="info-label">Batch</span>
                            <span class="info-value"><?php echo $student->batch_group_name .'&nbsp;'. $student->batch_group_year; ?></span>
                        </div>
                        
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value"><?php echo $student->email; ?></span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Mobile</span>
                            <span class="info-value"><?php echo $student->mobileno; ?></span>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div>
                        <span class="badge-custom">
                            <?php echo $student->st_name; ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tabs Card -->
            <div class="col-12 col-md-6 col-lg-8 mb-4">
                <div class="tabs-card">
                    <!-- Tabs Header -->
                    <div class="tabs-header">
                        <button class="tab-btn active" onclick="openTab(event, 'personal')">Profile</button>
                        <button class="tab-btn" onclick="openTab(event, 'academic')">Fees</button>
                        <button class="tab-btn" onclick="openTab(event, 'guardian')">Exam</button>
                        <button class="tab-btn" onclick="openTab(event, 'other')">Documents</button>
                        <button class="tab-btn" onclick="openTab(event, 'timeline')">Timeline</button>
                    </div>

                    <!-- Tabs Content -->
                    <div class="tabs-content">
            <!-- Personal Info Tab -->
            <div id="personal" class="tab-pane active">
                <h5 class="section-title">Personal Information</h5>
                <div class="detail-row">
                    <span class="detail-label">Full Name:</span>
                    <span class="detail-value"><?php echo $student->firstname . ' ' . $student->middlename . ' ' . $student->lastname; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Gender:</span>
                    <span class="detail-value"><?php echo $student->gender; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Date of Birth:</span>
                    <span class="detail-value"><?php echo date('d-m-Y', strtotime($student->dob)); ?></span>
                </div>                


                <div class="detail-row">
                    <span class="detail-label">Blood Group:</span>
                    <span class="detail-value"><?php echo !empty($student->blood_group) ? $student->blood_group : 'N/A'; ?></span>
                </div>


                <div class="detail-row">
                    <span class="detail-label">Religion:</span>
                    <span class="detail-value"><?php echo !empty($student->religion) ? $student->religion : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Caste:</span>
                    <span class="detail-value"><?php echo !empty($student->cast) ? $student->cast : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Current Address:</span>
                    <span class="detail-value"><?php echo $student->current_address; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Permanent Address:</span>
                    <span class="detail-value"><?php echo $student->permanent_address; ?></span>
                </div>
            </div>

            <!-- Academic Info Tab -->
            <div id="academic" class="tab-pane">
                <h5 class="section-title">Academic Information</h5>
                <div class="detail-row">
                    <span class="detail-label">Program:</span>
                    <span class="detail-value"><?php echo $student->p_name; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Semester:</span>
                    <span class="detail-value"><?php echo $student->stm_name; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Batch:</span>
                    <span class="detail-value"><?php echo $student->batch_group_name . ' (' . $student->batch_group_year . ')'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Admission Date:</span>
                    <span class="detail-value"><?php echo date('d-m-Y', strtotime($student->admission_date)); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Previous School:</span>
                    <span class="detail-value"><?php echo !empty($student->previous_school) ? $student->previous_school : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Last Studied Class:</span>
                    <span class="detail-value"><?php echo !empty($student->last_studied_class) ? $student->last_studied_class : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Previous Medium:</span>
                    <span class="detail-value"><?php echo !empty($student->previous_medium) ? $student->previous_medium : 'N/A'; ?></span>
                </div>
            </div>

            <!-- Guardian Info Tab -->
            <div id="guardian" class="tab-pane">
                <h5 class="section-title">Guardian Information</h5>
                <div class="detail-row">
                    <span class="detail-label">Father's Name:</span>
                    <span class="detail-value"><?php echo $student->father_name; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Father's Phone:</span>
                    <span class="detail-value"><?php echo !empty($student->father_phone) ? $student->father_phone : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Father's Occupation:</span>
                    <span class="detail-value"><?php echo !empty($student->father_occupation) ? $student->father_occupation : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Mother's Name:</span>
                    <span class="detail-value"><?php echo $student->mother_name; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Mother's Phone:</span>
                    <span class="detail-value"><?php echo !empty($student->mother_phone) ? $student->mother_phone : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Mother's Occupation:</span>
                    <span class="detail-value"><?php echo !empty($student->mother_occupation) ? $student->mother_occupation : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Guardian Name:</span>
                    <span class="detail-value"><?php echo $student->guardian_name; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Guardian Relation:</span>
                    <span class="detail-value"><?php echo $student->guardian_relation; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Guardian Address:</span>
                    <span class="detail-value"><?php echo $student->guardian_address; ?></span>
                </div>
            </div>

            <!-- Other Details Tab -->
            <div id="other" class="tab-pane">
                <h5 class="section-title">Other Details</h5>
                <div class="detail-row">
                    <span class="detail-label">Aadhar No:</span>
                    <span class="detail-value"><?php echo !empty($student->adhar_no) ? $student->adhar_no : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Bank Account No:</span>
                    <span class="detail-value"><?php echo !empty($student->bank_account_no) ? $student->bank_account_no : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Bank Name:</span>
                    <span class="detail-value"><?php echo !empty($student->bank_name) ? $student->bank_name : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">IFSC Code:</span>
                    <span class="detail-value"><?php echo !empty($student->ifsc_code) ? $student->ifsc_code : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Height:</span>
                    <span class="detail-value"><?php echo !empty($student->height) ? $student->height : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Weight:</span>
                    <span class="detail-value"><?php echo !empty($student->weight) ? $student->weight : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Created At:</span>
                    <span class="detail-value"><?php echo date('d-m-Y h:i A', strtotime($student->created_at)); ?></span>
                </div>
            </div>


             <!-- Other Details Tab -->
            <div id="timeline" class="tab-pane">
                <h5 class="section-title">Timeline Details</h5>
                <div class="detail-row">
                    <span class="detail-label">Aadhar No:</span>
                    <span class="detail-value"><?php echo !empty($student->adhar_no) ? $student->adhar_no : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Bank Account No:</span>
                    <span class="detail-value"><?php echo !empty($student->bank_account_no) ? $student->bank_account_no : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Bank Name:</span>
                    <span class="detail-value"><?php echo !empty($student->bank_name) ? $student->bank_name : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">IFSC Code:</span>
                    <span class="detail-value"><?php echo !empty($student->ifsc_code) ? $student->ifsc_code : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Height:</span>
                    <span class="detail-value"><?php echo !empty($student->height) ? $student->height : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Weight:</span>
                    <span class="detail-value"><?php echo !empty($student->weight) ? $student->weight : 'N/A'; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Created At:</span>
                    <span class="detail-value"><?php echo date('d-m-Y h:i A', strtotime($student->created_at)); ?></span>
                </div>
            </div>





        </div>
                </div>
            </div>
        </div>
        <!-- END ROW WRAPPER -->

    </div>
</main>
<?php */ ?>



<!--------------------------------------------------->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <!-- <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user4-128x128.jpg"
                       alt="User profile picture"> -->

                    <?php if(!empty($student->image)): ?>
                    <img src="<?php echo $student->image; ?>" alt="Profile" class="profile-image">
                    <?php else: ?>
                    <div class="profile-placeholder">
                    <?php echo strtoupper(substr($student->firstname, 0, 1)); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <h3 class="profile-username text-center"><?php echo $student->firstname . ' ' . $student->lastname; ?></h3>

                <p class="text-muted text-center"><?php echo $student->batch_group_name .'&nbsp;'. $student->batch_group_year; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Admission No</b> <a class="float-right"><?php echo $student->admission_no; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Roll No</b> <a class="float-right"><?php echo $student->roll_no; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Program</b> <a class="float-right"><?php echo $student->p_name; ?></a>
                  </li>

                    <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?php echo $student->email; ?></a>
                    </li>

                     <li class="list-group-item">
                    <b>Mobile</b> <a class="float-right"><?php echo $student->mobileno; ?></a>
                    </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About </h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-user"></i> Mother Name</strong>

                <p class="text-muted">
                  <?php echo $student->mother_name; ?>
                </p>

                <hr>

                <strong><i class="fas fa-user mr-1"></i> Father Name</strong>

                <p class="text-muted"><?php  echo $student->father_name; ?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>
                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#academic" data-toggle="tab">Fees</a></li>
                  <li class="nav-item"><a class="nav-link" href="#exam" data-toggle="tab">Exam</a></li>
                  <li class="nav-item"><a class="nav-link" href="#documents" data-toggle="tab">Documents</a></li>
                   <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="personal">


                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" value="<?php echo $student->firstname . ' ' . $student->lastname; ?>" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $student->firstname . ' ' . $student->lastname; ?>"  >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"><?php echo $student->firstname . ' ' . $student->lastname; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills" value="<?php echo $student->firstname . ' ' . $student->lastname; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    
             
                    
                  </div>



                  <!-- /.tab-pane -->
                   <!--aceadimc---------------------->
                  <div class="tab-pane" id="academic">

                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
<!--Exam------------------------->
                  <div class="tab-pane" id="exam">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>



                  <!------------Documents--------------------------------->
                    <div class="tab-pane" id="documents">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
   <!------------Documents--------------------------------->



   <!--------------------------Documents--------------------------------->
                       <div class="tab-pane" id="timeline">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
   <!------------Documents--------------------------------->






                  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>




      


       
        

         




    <script>
function openTab(evt, tabName) {
    // Hide all tab panes
    var tabPanes = document.getElementsByClassName('tab-pane');
    for (var i = 0; i < tabPanes.length; i++) {
        tabPanes[i].classList.remove('active');
    }
    
    // Remove active class from all buttons
    var tabBtns = document.getElementsByClassName('tab-btn');
    for (var i = 0; i < tabBtns.length; i++) {
        tabBtns[i].classList.remove('active');
    }
    
    // Show current tab and mark button as active
    document.getElementById(tabName).classList.add('active');
    evt.currentTarget.classList.add('active');
}
</script>