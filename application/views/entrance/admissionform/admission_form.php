            <style>
            .title {
            position: absolute;
            top: -20px; 
            left: 50%;
            transform: translateX(-50%);
            background-color: white; 
            padding: 0 10px; 
            }
            
            
            
            </style> 
            
            <div class="col-md-12" >
            <label style="background-color:#00C3CB; color:white; text-align:center;"  class="form-control" >APPLICATION  FOR &nbsp;<?php echo $getcourse['entranceexam_course_name']; ?></label>
            </div>
            
            <div class="container-xxl py-5"> 
            <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            </div>
            
            <div class="col-md-12" style="height:auto; float:none;margin:auto; " >
            <div class="wow fadeInUp" data-wow-delay="0.2s">
            <br>
            <br>
            <br>
            <br>
            
            
            
            <form action="<?php echo site_url('entrance/home/admission_form'); ?>" method="POST" enctype="multipart/form-data">
            
            <div class="col-md-12" style="height:auto; float:none; margin:auto; border: 1px solid #b8b9bc; border-radius:30px; position: relative; box-shadow: 3px 5px #e3e6eb;" id="wrp">
            <span class="title"><b>Primary Details</b></span>
            <p style="padding:10px"></p>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group"> 
            <label for="uname">Name of Applicant with Initial (In Block Letter) <span style="color:red;">*</span>:</label>
            <input type="text" class="form-control input" id="uname" name="uname" placeholder="വിദ്യാര്‍ത്ഥിയുടെ മുഴുവന്‍ പേര്" value="<?php echo set_value('uname', $getstud['admission_name']); ?>" />
            <span class="text-danger"><?php echo form_error('uname'); ?></span>
            </div> 
            
            
            <div class="form-group">
            <label for="pwd">Date of Birth:
            <span style="color:red;">*</span>
            </label>
            
            <input type="date" onchange="calculateAge(this.value)" class="form-control" placeholder="ജനന തിയ്യതി" id="dob" name="dob" max="2017-12-31" value="<?php echo set_value('dob', date('Y-m-d', strtotime($getstud['admission_dob']))); ?>" />
            
            <span id="age" style="color:green"></span>
            <span class="text-danger"><?php echo form_error('dob'); ?></span>
            </div>
            </div>
            </div>
            
            
            <div class="row">
            <div class="col-md-6">
            <div class="form-group"> 
            <label for="email">Mobile No: 
            <span style="color:red;">*</span></label>
            <input type="text" class="form-control input" placeholder="മൊബൈല്‍ നമ്പര്‍" name="mobile" value="<?php echo set_value('mobile', $getstud['admission_mobile']); ?>" /> 
            <span class="text-danger"><?php echo form_error('mobile'); ?></span>
            </div>
            <div class="form-group">
            <label for="email">Name of Father :
            <span style="color:red;">*</span></label>
            <input type="text" class="form-control" id="fathername" name="fathername" placeholder="പിതാവിന്റെ പേര്"  value="<?php echo set_value('fathername', $getstud['admission_fathername']); ?>" />           
            <span class="text-danger"><?php echo form_error('fathername'); ?></span>
            </div>
            <div class="form-group">
            <label for="pwd">House Name:
            <span style="color:red;">*</span>
            </label>
            <input type="text" class="form-control" id="housename" name="housename" placeholder="വീട്ടുപേര്"  value="<?php echo set_value('housename', $getstud['admission_housename']); ?>" /> 
            <span class="text-danger"><?php echo form_error('housename'); ?></span>
            </div>
            <div class="form-group">
            <label for="pwd">Address:
            <span style="color:red;">*</span>
            </label>
            <textarea class="form-control"  placeholder="വിദ്യാര്‍ത്ഥിയുടെ വിലാസം"  name="address"> <?php echo set_value('address', $getstud['admission_address']); ?> </textarea>
            <span class="text-danger"><?php echo form_error('address'); ?></span>
            </div> 
            </div>
            
            
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">Occupation of Father:
            <span style="color:red;">*</span>
            </label>
            <input type="text" class="form-control" id="fatheroccupation" name="fatheroccupation" placeholder="പിതാവിന്റെ ജോലി"  value="<?php echo set_value('fatheroccupation', $getstud['admission_fatheroccupation']); ?>" />    
            <span class="text-danger"><?php echo form_error('fatheroccupation'); ?></span>
            </div>
            <div class="form-group">
            <label for="pwd">Name of Mother:
            <span style="color:red;">*</span>
            </label>
            <input type="text" class="form-control" id="mothername" name="mothername" placeholder="മാതാവിന്റെ പേര്"   value="<?php echo set_value('mothername', $getstud['admission_mothername']); ?>" />  
            <span class="text-danger"><?php echo form_error('mothername'); ?></span>
            </div>
            
            <div class="form-group">
            <label for="pwd">Mother House Name:
            <span style="color:red;">*</span>
            </label>
            <input type="text"  placeholder="മാതാവിന്റെ വീട്ടു പേര്"  class="form-control" id="motherhousename" name="motherhousename"    value="<?php echo set_value('motherhousename', $getstud['admission_motherhousename']); ?>" /> 
            <span class="text-danger"><?php echo form_error('motherhousename'); ?></span>
            </div>
            
            
            <div class="form-group">
            <label for="email">Photo  :
            <span style="color:red;">*</span></label>
            <br>
            <input type="file"  class="form-control" id="photo"  name="photo" required  >
            </div>
            </div>
            </div>
            </div>
            <br>
            
            
            
            
            <div class="col-md-12" style="height:auto; float:none; margin:auto; border: 1px solid #b8b9bc; border-radius:30px; position: relative; box-shadow: 3px 5px #e3e6eb;">
            <span class="title"><b>Secondary Details</b></span>
            <p style="padding:10px"></p>
            <div class="col-md-12">
            <div class="form-group">
            <label for="email">Adhaar No :
            <span style="color:red;">*</span></label>
            <input type="text"  maxlength="12" class="form-control"  placeholder="ആധാർ നമ്പർ" required id="adharno" name="adharno"  value="<?php echo set_value('adharno', $getstud['admission_adharno']); ?>" />     
            <span id="rchars" style="color:#cb4a4a;">12</span><span style="color:#cb4a4a;"> Max Characters</span>
            <span class="text-danger"><?php echo form_error('adharno'); ?></span>
            </div>
            </div>
            
            
            
            <div class="col-md-12">
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">State:
            <span style="color:red;">*</span>
            </label>
            
            
            <select name="state" id="state" class="form-control" onchange="getdist(this.value)">
            <option value="">Choose State</option>
            <?php
            foreach($statelist as $sta)
            {
            ?>
            <option value="<?php  echo $sta['state_id']  ?>"><?php  echo $sta['state_name']  ?></option>
            <?php
            }
            ?>
            </select>
            
            <span class="text-danger"><?php echo form_error('state'); ?></span>
            </div>
            </div>
            
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">District:
            <span style="color:red;">*</span>
            </label>
            <select name="district" id="district" class="form-control">
            </select>
            <span class="text-danger"><?php echo form_error('district'); ?></span>
            </div>
            </div>
            
            </div>    
            
            
            <div class="col-md-12" >
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">Thaluk:
            <span style="color:red;">*</span>
            </label>
            <input type="text" class="form-control" placeholder="താലൂക്ക്" id="thaluk" name="thaluk" value="<?php echo set_value('thaluk', isset($getstud['admission_thaluk']) ? $getstud['admission_thaluk'] : ''); ?>" />
            <span class="text-danger"><?php echo form_error('thaluk'); ?></span>
            </div>
            </div>
            
            
            
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">Village:
            <span style="color:red;">*</span>
            </label>
            <input type="text" class="form-control" placeholder="വില്ലേജ്" id="village" name="village"  value="<?php echo set_value('village', $getstud['admission_village']); ?>" />      
            
            <span class="text-danger"><?php echo form_error('village'); ?></span>
            </div> 
            <br>
            </div>
            </div> 
            
            <div class="col-md-12" >
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">Mahallu:
            <span style="color:red;">*</span>
            </label>
            <input type="text" class="form-control" placeholder="മഹല്ല്" id="mahallu" name="mahallu" value="<?php echo set_value('mahallu', $getstud['admission_mahallu']); ?>" />       
            <span class="text-danger"><?php echo form_error('mahallu'); ?></span>
            </div>  
            
            </div>
            </div>
            
            
            <div class="col-md-12" >
            
            
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">Name of Guardian:
            <span style="color:red;">*</span>
            </label>
            <input type="text" placeholder="രക്ഷിതാവിന്റെ പേര്" class="form-control" id="guardian" name="guardian" value="<?php echo set_value('guardian', $getstud['admission_guardian']); ?>" />
            
            <span class="text-danger"><?php echo form_error('guardian'); ?></span>
            </div>
            
            
            <div class="form-group">
            <label for="pwd">Relationship with Student:<span style="color:red;">*</span>
            </label>
            <input type="text" class="form-control" id="relationship" name="relationship"       placeholder="വിദ്യാർത്ഥിയോടുള്ള ബന്ധം"           value="<?php echo $getstud['admission_relationship']; ?>">
            <span class="text-danger"><?php echo form_error('relationship'); ?></span>
            </div>
            
            <div class="form-group">
            <label for="pwd">Phone No:
            <span style="color:red;">*</span>
            </label>
            <input type="text" class="form-control" id="phoneno" name="phoneno" value="<?php echo set_value('phoneno', $getstud['admission_phoneno']); ?>" />
            <span class="text-danger"><?php echo form_error('phoneno'); ?></span>
            </div>
            
            
            </div>
            
            
            <div class="col-md-6">
            <input type="hidden" class="form-control" id="admission_address" name="admission_address"  value="<?php echo set_value('admission_address', $getstud['admission_address']); ?>" />      
            
            <div class="form-group">
            <label for="pwd">Address Of Guardian:
            <span style="color:red;">*</span>
            <br>
            <input type="checkbox" name="sameasabove" id="sameasabove" value="1" <?php echo ($check_address['ad_check_address'] == 1) ? 'checked' : ''; ?> />
            <span style="color:#aea1a8;">Same as Above</span>
            </label>
            <textarea class="form-control"  placeholder="രക്ഷിതാവിന്റെ വിലാസം" name="guardianaddress" id="guardianaddress"><?php echo $getstud['admission_guardianaddress']; ?></textarea>
            <span class="text-danger"><?php echo form_error('guardianaddress'); ?></span>
            </div>
            
            
            </div>
            
            </div>
            
            
            <div class="col-md-12">
            
            <p style="padding:10px"></p>
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">Are you an Orphan? Yes/No:
            <span style="color:red;">*</span>
            </label><br>
            Yes <input type="radio" name="iforphan" value="Yes"<?php echo ($getstud['admission_iforphan'] == 'Yes') ? ' checked' : ''; ?>>
            No <input type="radio" name="iforphan" value="No"<?php echo ($getstud['admission_iforphan'] == 'No') ? ' checked' : ''; ?>>
            <span class="text-danger"><?php echo form_error('admission_iforphan'); ?></span>
            </div>
            </div>
            
            
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">Identification Mark:
            <span style="color:red;">*</span>
            </label>
            <textarea class="form-control" placeholder="തിരിച്ചറിയല്‍ അടയാളം"              name= "identification"><?php echo set_value('identification', $getstud['admission_identification']); ?></textarea>
            <span class="text-danger"><?php echo form_error('identification'); ?></span>
            </div>
            
            </div>
            </div>
            
            
            <div class="form-group">
            <label for="pwd">
            
            <span style="color:red;">&nbsp;</span>
            
            </label><br>
            
            
            
            <span class="text-danger">&nbsp;</span>
            <span class="text-danger">&nbsp;</span>
            </div>
            
            </div>
            </div>
            <br>
            
            
            <div class="col-md-12" id="previous" name="previous"  style="height:auto; float:none; margin:auto; border: 1px solid #b8b9bc; border-radius:30px; position: relative; box-shadow: 3px 5px #e3e6eb;">
            <span class="title"><b>Previous Study Details</b></span>
            <p style="padding:10px"></p>
            <div class="col-md-6">
            <div class="form-group">
            <label for="email">Last Studied Madrassa Class :
            <span style="color:red;">*</span></label>
            <input type="text" class="form-control" id="laststudiedmadarsa" name="laststudiedmadarsa"  placeholder="അവസാനം പഠിച്ച  മദ്രാസ ക്ലാസ്"             value="<?php echo set_value('laststudiedmadarsa', $getstud['admission_laststudiedmadarsa']); ?>" /> 
            <!--<span class="text-danger"><?php echo form_error('laststudiedmadarsa'); ?></span>-->
            </div>
            
            
            <div class="form-group">
            <label for="email">Name of Madrassa :
            <span style="color:red;">*</span></label>
            <input type="text" placeholder="മദ്റസയുടെ പേര്" class="form-control" id="madarsaname" name="madarsaname"  value="<?php echo set_value('madarsaname', $getstud['admission_nameofmadarsa']); ?>" /> 
            <!--<span class="text-danger"><?php echo form_error('madarsaname'); ?></span>-->
            </div>
            
            
            <div class="form-group">
            <label for="pwd">Register No :
            <span style="color:red;">*</span>
            </label>
            <input type="text" class="form-control" id="admission_range" name="admission_range" placeholder="മദ്‌റസ രജിട്രേഷന്‍ നമ്പര്‍" value="<?php echo set_value('admission_range', $getstud['admission_range']); ?>" />
            
            <!--<span class="text-danger"><?php echo form_error('admission_range'); ?></span>-->
            </div>
            </div>
            
            
            
            
            <div class="col-md-6">
            <div class="form-group">
            <label for="pwd">Last Studied School Class:
            <span style="color:red;">*</span>
            </label>
            <input type="text" placeholder="അവസാനം പഠിച്ച സ്കൂൾ ക്ലാസ്" class="form-control" id="laststudied" name="laststudied" value="<?php echo set_value('laststudied', $getstud['admission_laststudied']); ?>" />     
            <!--<span class="text-danger"><?php echo form_error('laststudied'); ?></span>-->
            </div>
            
            
            <div class="form-group">
            <label for="pwd">Name of School:
            <span style="color:red;">*</span>
            </label>
            <input type="text" placeholder="സ്‌കൂളിന്റെ പേര്‌" class="form-control" id="schoolname" name="schoolname"  value="<?php echo set_value('schoolname', $getstud['admission_schoolname']); ?>" />        
            <!--<span class="text-danger"><?php echo form_error('schoolname'); ?></span>-->
            </div>
            
            <div class="form-group">
            <label for="pwd">Medium of School:
            <span style="color:red;">*</span>
            </label>
            <select name="medium" class="form-control" id="medium" placeholder=""/>
            <option value="">Select Medium</option>
            <option value="English">English</option>
            <option value="Malayalam">Malayalam</option>
            </select>
            <!--<span class="text-danger"><?php echo form_error('medium'); ?></span>-->
            </div>
            
            
            <div class="form-group">
            </div>
            </div>
            
            
            
            <div class="col-md-12">
            
            <div class="col-md-6"> 
            
            <div class="form-group">
            <label for="pwd">Medium of Question Paper for Entrance Examination:
            <span style="color:red;">*</span>
            </label>
            <select name="Medium_of_questionpaper" class="form-control" id="Medium_of_questionpaper" placeholder=""/>
            <option value="">Select Medium</option>
            <option value="English">English</option>
            <option value="Malayalam">Malayalam</option>
            </select>
            <!--<span class="text-danger"><?php echo form_error('medium'); ?></span>-->
            </div>
            </div>
            
            </div>
            
            <div class="form-group">
            <label for="name">Examination Center <br>
            പരീക്ഷാ സ്ഥലം തിരഞ്ഞെടുക്കുക
            <span style="color:red;">*</span>
            </label>
            
            
            <select  name="examcenter"  id="examcenter" class="form-control">
            
            <option value="">Select Examination Center</option>
            <?php 
            foreach($centerlist_bysession as $cen)
            {
            ?>
            <optgroup label="<?php echo $cen['sel_entranceexam_centreseat']; ?>">
            <option value="<?php echo $cen['entranceexam_centrename'];   ?>"><?php echo $cen['entranceexam_centrename'].'('.	$cen['sel_entranceexam_centreseat'].')';   ?></option>
            </optgroup >
            
            <?php } ?>
            </select>
            <!--<span class="text-danger"><?php echo form_error('examcenter'); ?></span>-->
            </div>
            
            
            </div>
            <br>
            <div class="col-md-12"  id="main_previous" style="height:auto; float:none; margin:auto; border: 1px solid #b8b9bc; border-radius:30px; position: relative; box-shadow: 3px 5px #e3e6eb;">
            <span class="title"><b>Previous Study Details</b></span>
            <p style="padding:10px"></p>
            
            <div class="col-md-6">
            <div class="form-group">
            <label for="email">Last Studied Institute :
            <span style="color:red;">*</span></label>
            <input type="text" class="form-control" id="last_studied_institute" name="last_studied_institute" value="<?php echo set_value('last_studied_institute', $check_address['last_studied_institute']); ?>" /> 
            <!--<span class="text-danger"><?php echo form_error('last_studied_institute'); ?></span>-->
            </div>
            
            
            <div class="form-group">
            <label for="email">Years Completed :
            <span style="color:red;">*</span></label>
            <input type="text" placeholder="" class="form-control" id="years_completed" name="years_completed"  value="<?php echo set_value('years_completed', $check_address['years_completed']); ?>" /> 
            <span class="text-danger"><?php echo form_error('years_completed'); ?></span>
            </div>
            
            
            <div class="form-group">
            <label for="pwd">Name of Prominent Teacher
            <span style="color:red;">*</span>
            </label>
            <input type="text" placeholder="" class="form-control" id="Name_Prominent_Teacher" name="Name_Prominent_Teacher"  value="<?php echo set_value('Name_Prominent_Teacher', $check_address['Name_Prominent_Teacher']); ?>" /> 
            <span class="text-danger"><?php echo form_error('Name_Prominent_Teacher'); ?></span>
            </div>
            
            
            
            
            </div>
            
            
            <div class="col-md-6" >
            <div class="form-group" id="Major_Books_Studied_ajx">
            <label for="pwd">Major Books Studied
            <span style="color:red;">*</span>
            </label>
            <input type="text" placeholder="" class="form-control" id="Major_Books_Studied" name="Major_Books_Studied" value="<?php echo set_value('Major_Books_Studied', $check_address['Major_Books_Studied']); ?>" />     
            <!--<span class="text-danger"><?php echo form_error('Major_Books_Studied'); ?></span>-->
            </div>
            
            
            
            <div class="form-group" id="Repitition_Completed_ajx">
            <label for="pwd">Repitition Completed
            <span style="color:red;">*</span>
            </label>
            <input type="text" placeholder="പൂര്‍ത്തീകരിച്ച ദൗറകളുടെ എണ്ണം " class="form-control" id="Repitition_Completed" name="Repitition_Completed"  value="<?php echo set_value('Repitition_Completed', $check_address['Repitition_Completed']); ?>" />        
            <!--<span class="text-danger"><?php echo form_error('Repitition_Completed'); ?></span>-->
            </div>
            
            
            
            <div class="form-group" id="general_education_mutajx" >
            <label for="pwd">General Education
            <span style="color:red;">*</span>
            </label>
            <!--<input type="text" placeholder="" class="form-control" id="General_Education" name="General_Education"  value="<?php echo set_value('General_Education', $check_address['General_Education']); ?>" />        -->
            
            <select name="General_Education_mutawal" name="General_Education_mutawal" class="form-control">
            <option value="">Select General Education</option>
            <option vlaue="UNDER SSLC">Under SSLC</option>
            <option vlaue="SSLC"> SSLC</option>
            <option vlaue="PLUS TWO"> PLUS TWO</option>
            <option vlaue="DEGREE">Degree</option>
            <option vlaue="PG">PG</option>
            </select>
            
            </div>
            
            
            <div class="form-group" id="general_education_huffaz_ajx" >
            <label for="pwd">General Education
            <span style="color:red;">*</span>
            </label>
            <select name="General_Education" name="General_Education" class="form-control">
            <option value="">Select General Education</option>
            
            <?php
            for($i=1;$i<=10;$i++)
            {
            ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            
            <?php } ?>
            
            </select>
            
            </div>
            
            
            
            
            <div class="form-group">Place of Institution
            <span style="color:red;">*</span>
            </label>
            <input type="text" placeholder="" class="form-control" id="PlaceOf_Institution" name="PlaceOf_Institution"  value="<?php echo set_value('PlaceOf_Institution', $check_address['PlaceOf_Institution']); ?>" />        
            <span class="text-danger"><?php echo form_error('PlaceOf_Institution'); ?></span>
            </div>
            </div>
            <br>
            <br>
            
            
            
            <div class="form-group">
            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
            </div>
            </div>
            <br>
            <input type="hidden" name="coursename_ajx" id="coursename_ajx" value="<?php echo $getcourse['entranceexam_course_name']; ?>" />
            <input type="hidden" name="is_previous_ajx" id="is_previous_ajx" value="<?php echo $getcourse['entranceexam_course_is_previous']; ?>" />
            
            <div class="col-md-12" style="text-align:center;">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <button type="button" onclick="window.location.href = '<?php echo site_url();?>entrance/Entranceexam/termsandcondition';" class="btn btn-warning">Back</button>
            </div>
            <br>
            <br>
            <br>
            <br>
            </div>
            </div>
            <br>
            <br>
            </form>
            </div>
            </div>
            </div>
            </div>
            
            
            <script type="text/javascript">
            $(document).ready(function()
            {
            var is_previous_ajx= $('#is_previous_ajx').val();  
            
            // var coursename_ajx= $('#coursename_ajx').val();
            
            // if(coursename_ajx=="MUTHAWWAL")
            // {
            // $('#previous').hide();   
            // $('#main_previous').show();   
            // $('#Major_Books_Studied_ajx').show(); 
            // $('#general_education_mutajx').show(); 
            // $('#general_education_huffaz_ajx').hide(); 
            // $('#Repitition_Completed_ajx').hide(); 
            // }
            // else if(coursename_ajx=="THAJLIYATHUL HUFFAZ")
            // {
            // $('#previous').hide();     
            // $('#main_previous').show();  
            // $('#Major_Books_Studied_ajx').hide();  
            // $('#Repitition_Completed_ajx').show(); 
            // $('#general_education_mutajx').hide();
            // $('#general_education_huffaz_ajx').show(); 
            // }
            // else
            // {
            // $('#main_previous').hide();   
            // $('#previous').show();
            // }
            
            if(is_previous_ajx=="2")
            {
            $('#previous').hide();   
            $('#main_previous').show();   
            $('#Major_Books_Studied_ajx').show(); 
            $('#general_education_mutajx').show(); 
            $('#general_education_huffaz_ajx').hide(); 
            $('#Repitition_Completed_ajx').hide(); 
            }
            else if(is_previous_ajx=="1")
            {
            $('#previous').hide();     
            $('#main_previous').show();  
            $('#Major_Books_Studied_ajx').hide();  
            $('#Repitition_Completed_ajx').show(); 
            $('#general_education_mutajx').hide();
            $('#general_education_huffaz_ajx').show(); 
            }
            else
            {
            $('#main_previous').hide();   
            $('#previous').show();
            }
            });
            
            
            function getdist()
            {
            var state         =   $('#state').val();
            var district      =   $('#district').val();
            $.ajax({
            type: "POST", 
            data: {state: state},  
            url: "<?php echo site_url('entrance/home/dist');?>",
            success:function(result)
            {
            $('#district').empty();
            var jsondata= JSON.parse(result);
            $('#district').html('<option value=""></option>');
            $.each(jsondata, function(key, value) 
            {
            $('select[name="district"]').append('<option value="'+ value.district_id +'">'+ value.district_name  +'</option>');
            });
            },
            }); 
            }
            
            $(document).ready(function()
            {
            $('#sameasabove').on('click', function() {
            var isChecked = $(this).prop('checked');
            if (isChecked) {
            
            $('textarea[name="guardianaddress"]').val($('textarea[name="address"]').val());
            } else {
            
            $('textarea[name="guardianaddress"]').val('');
            }
            });
            });
            
            
            var maxLength = 12;
            $('#adharno').keyup(function() 
            {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
            });
            
            function calculateAge(selectedDate)
            {
            var dob = new Date(selectedDate);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var monthDiff = today.getMonth() - dob.getMonth();
            
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
            }
            
            document.getElementById("age").innerText = "Age: " + age;
            }
            </script>
            
            
