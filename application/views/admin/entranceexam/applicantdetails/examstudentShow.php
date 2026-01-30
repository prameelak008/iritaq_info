        <?php
        $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
        ?>
        <style type="text/css">
        /*.table td:last-child, th:last-child {float: none;text-align: start;}*/
        </style>
        <div class="content-wrapper">
        <div class="row">
        <div class="col-md-12">
        <section class="content-header" style="padding-right: 0;">
        <h1>
        <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>
        
        </section>
        </div>
        <!-- /.control-sidebar -->
        </div>
        
        <section class="content">
        <div class="row">
        <div class="col-md-12">
        
        <div class="box box-primary">
        <div class="box-body box-profile">
        <?php
        $count=0;
        foreach ($admissionlist as $adlist) {
        if (empty($adlist["admission_photo"])) {
        $image = "uploads/student_images/default_male.jpg";
        } else {
        $image = "entrance/admissionphoto/".$adlist['admission_photo'];
        }
        ?>
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $image; ?>" alt="User profile picture"> <br>
        
        <h3 class="profile-username text-center" style="text-transform: uppercase;"><?php echo $adlist['admission_name']; ?></h3>
        <br>
        <ul class="list-group list-group-unbordered">
        
        <div class="col-md-6">
        <li class="list-group-item listnoback">
        <b><?php echo ('Name: '); ?></b> <a class="pull-right "><?php echo $adlist['admission_name']; ?></a>
        </li>
        
        <li class="list-group-item listnoback">
        <b>User Name</b> <a class="pull-right "><?php echo $adlist['entrance_reg_username']; ?></a>
        </li>
        
        
        
        <li class="list-group-item listnoback">
        <b>Password</b> <a class="pull-right "><?php echo $adlist['entrance_reg_password']; ?></a>
        </li>
        
        <li class="list-group-item listnoback">
        <b><?php echo ('Selected Course: '); ?></b> <span class="pull-right "><?php echo $adlist['entranceexam_course_name']; ?></span>
        </li>
        
        
        
        
        <li class="list-group-item listnoback">
        <b><?php echo ('Mobile: '); ?></b> <a class="pull-right "><?php echo $adlist['admission_mobile']; ?></a>
        </li>
        
        <!-- <li class="list-group-item listnoback">
        <b><?php echo ('Admission For'); ?></b> <a class="pull-right "><?php echo $adlist['admission_for']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('For Secondary'); ?></b> <a class="pull-right "><?php echo $adlist['admission_for_secondary']; ?></a>
        </li> -->
        
        <li class="list-group-item listnoback">
        <b><?php echo ('Father Name'); ?></b> <a class="pull-right "><?php echo $adlist['admission_fathername']; ?></a>
        </li>
        
        <li class="list-group-item listnoback">
        <b><?php echo ('Housename'); ?></b> <a class="pull-right "><?php echo $adlist['admission_housename']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Father Occupation:'); ?></b> <a class="pull-right "><?php echo $adlist['admission_fatheroccupation']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Mother Name'); ?></b> <a class="pull-right "><?php echo ('Mother Name'); ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Mother Housename: '); ?></b> <a class="pull-right "><?php echo $adlist['admission_motherhousename']; ?></a>
        </li>
        
        <li class="list-group-item listnoback">
        <b><?php echo ('Address'); ?></b> <a class="pull-right "><?php echo $adlist['admission_address']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Adhaar no: '); ?></b> <a class="pull-right "><?php echo $adlist['admission_adharno']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo $this->lang->line('date_of_birth'); ?></b> <a class="pull-right "><?php echo $adlist['admission_dob']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('State'); ?></b> <a class="pull-right "><?php echo $adlist['state_name']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('District'); ?></b> <a class="pull-right "><?php echo $adlist['district_name']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Taluk'); ?></b> <a class="pull-right "><?php echo $adlist['admission_thaluk']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Village'); ?></b> <a class="pull-right "><?php echo $adlist['admission_village']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Mahal'); ?></b> <a class="pull-right "><?php echo $adlist['admission_mahallu']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('If Orphan'); ?></b> <a class="pull-right "><?php echo $adlist['admission_iforphan']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Guardian'); ?></b> <a class="pull-right "><?php echo $adlist['admission_guardian']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Guardian Address'); ?></b> <a class="pull-right "><?php echo $adlist['admission_guardianaddress']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Relationship'); ?></b> <a class="pull-right "><?php echo $adlist['admission_relationship']; ?></a>
        </li>
        </div>
        <div class="col-md-6">
        <li class="list-group-item listnoback">
        <b><?php echo ('Phone no'); ?></b> <a class="pull-right "><?php echo $adlist['admission_phoneno']; ?></a>
        </li>
        
        <?php
        
        if($adlist['admission_application_selectedcourse']==3)
        {
        ?>   
        <li class="list-group-item listnoback">
        <b>Last Studied Institute</b> <a class="pull-right "><?php echo $check_address['last_studied_institute'];?></a>
        </li> 
        <li class="list-group-item listnoback">
        <b>Years Completed</b> <a class="pull-right "><?php echo $check_address['years_completed'];?></a>
        </li> 
        
        
        <li class="list-group-item listnoback">
        <b>Name Of Prominent Teacher</b> <a class="pull-right "><?php echo $check_address['Name_Prominent_Teacher'];?></a>
        </li> 
        
        <li class="list-group-item listnoback">
        <b>Repitition Completed</b> <a class="pull-right "><?php echo $check_address['Repitition_Completed'];?></a>
        </li> 
        
        <li class="list-group-item listnoback">
        <b>General Education</b> <a class="pull-right "><?php echo $check_address['General_Education'];?></a>
        </li> 
        
        <li class="list-group-item listnoback">
        <b>Place Of Institution</b> <a class="pull-right "><?php echo $check_address['PlaceOf_Institution'];?></a>
        </li> 
        
        
        <?php  }
        elseif($adlist['admission_application_selectedcourse']==5)
        {
        ?>
        
        <li class="list-group-item listnoback">
        <b>Last Studied Institute</b> <a class="pull-right "><?php echo $check_address['last_studied_institute'];?></a>
        </li> 
        
        
        <li class="list-group-item listnoback">
        <b>Years Completed</b> <a class="pull-right "><?php echo $check_address['years_completed'];?></a>
        </li>
        
        <li class="list-group-item listnoback">
        <b>Name Of Prominent Teacher</b> <a class="pull-right "><?php echo $check_address['Name_Prominent_Teacher'];?></a>
        </li>
        
        
        <li class="list-group-item listnoback">
        <b>Major Books Studied</b> <a class="pull-right "><?php echo $check_address['Major_Books_Studied'];?></a>
        </li>
        
        <li class="list-group-item listnoback">
        <b>General Education</b> <a class="pull-right "><?php echo $check_address['General_Education_mutawal'];?></a>
        </li> 
        
        <li class="list-group-item listnoback">
        <b>Place Of Institution</b> <a class="pull-right "><?php echo $check_address['PlaceOf_Institution'];?></a>
        </li>
        <?php    
        }
        else
        {
        ?>
        <li class="list-group-item listnoback">
        <b><?php echo ('Last studied madrasa'); ?></b> <a class="pull-right "><?php echo $adlist['admission_laststudiedmadarsa']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Name of madrasa'); ?></b> <a class="pull-right "><?php echo $adlist['admission_nameofmadarsa']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Register No '); ?></b> <a class="pull-right "><?php echo $adlist['admission_range']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Last studied'); ?></b> <a class="pull-right "><?php echo $adlist['admission_laststudied']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('School Name'); ?></b> <a class="pull-right "><?php echo $adlist['admission_schoolname']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Medium'); ?></b> <a class="pull-right "><?php echo $adlist['admission_medium']; ?></a>
        </li>
        <?php } ?>
        
        <li class="list-group-item listnoback">
        <b><?php echo ('Identification Mark'); ?></b> <a class="pull-right "><?php echo $adlist['admission_identification']; ?></a>
        </li>
        <!-- <li class="list-group-item listnoback">
        <b><?php echo ('Payment'); ?></b> <a class="pull-right "><?php echo $adlist['admission_payment']; ?></a>
        </li> -->
        <li class="list-group-item listnoback">
        <b><?php echo ('Date'); ?></b> <a class="pull-right "><?php echo $adlist['admission_date']; ?></a>
        </li>
        
        <li class="list-group-item listnoback">
        <b><?php echo ('Date Time'); ?></b> <a class="pull-right "><?php echo $adlist['admission_datetime']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Registered Name'); ?></b> <a class="pull-right "><?php echo $adlist['entrance_reg_name']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Registered Email'); ?></b> <a class="pull-right "><?php echo $adlist['entrance_reg_email']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Registered Phone no:'); ?></b> <a class="pull-right "><?php echo $adlist['entrance_reg_phone']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Application no'); ?></b> <a class="pull-right "><?php echo $adlist['admission_application_no']; ?></a>
        </li>
        <!--<li class="list-group-item listnoback">-->
        <!--    <b><?php echo ('Register Id: '); ?></b> <a class="pull-right "><?php echo $adlist['admission_application_registerid']; ?></a>-->
        <!--</li>-->
        <li class="list-group-item listnoback">
        <b><?php echo ('Institute Option One'); ?></b> <a class="pull-right "><?php echo $adlist['admission_institute_optionone']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Institute Option Two'); ?></b> <a class="pull-right "><?php echo $adlist['admission_institute_optiontwo']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Institute Option Three'); ?></b> <a class="pull-right "><?php echo $adlist['admission_institute_optionthree']; ?></a>
        </li>
        <li class="list-group-item listnoback">
        <b><?php echo ('Exam Center: '); ?></b> <a class="pull-right "><?php echo $adlist['admission_institute_examcenter']; ?></a>
        </li>
        
        <li>
        
        </li>
        
        
        
        <li class="list-group-item listnoback">
        <b>Payment Status</b> <a class="pull-right ">
        <?php echo $adlist['admission_payment']; ?>
        <br>
        </a>
        
        <span style="background-color:blue;"><a href="<?php  echo site_url();  ?>EntranceExam/feedetails/<?php echo $adlist['admission_application_registerid']; ?>   ">
        <b style="color:#ff892c;"> VIEW DETAILS</b></a></span>
        </li>
        </div>
        </ul>
        <?php
        }
        $count++;
        ?>
        </div>
        </div>
        
        
        </div>
        
        </div>
        </section>
        </div>
