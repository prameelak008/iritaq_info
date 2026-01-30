        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">     
        <style>
        .designborder
        {
        border:none !important;
        }
        
        .title {
        position: absolute;
        top: -20px; 
        left: 50%;
        transform: translateX(-50%);
        background-color: white; 
        padding: 0 10px; 
        }
        </style>
        
        
        
        <div class="container-xxl py-5"> 
        <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s"></div>
        
        <div class="col-md-12" style="height:auto; float:none;margin:auto;" >
        <div class="wow fadeInUp" data-wow-delay="0.2s">
        <div class="form-group"> 
        <label style="background-color:#00C3CB; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" >APPLICATION  FOR &nbsp; <?php echo $getcourse['entranceexam_course_name']; ?></label>
        </div>
        <br>
        <br>
        
        
        
        <form name="form" method="POST" action="<?php echo site_url('entrance/home/edit_application');  ?>" enctype="multipart/form-data">
        
        <div class="col-md-12" style="height:auto; float:none; margin:auto; border: 1px solid #b8b9bc; border-radius:30px; position: relative; box-shadow: 3px 5px #e3e6eb;">
        <span class="title"><b>Primary Details</b></span>
        <p style="padding:10px"></p>
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
        <label for="email">Name of Applicant  with Initial
        (In Block Letter) <span style="color:red;">*</span></label>
        <input type="text" class="form-control"  id="admission_name"  placeholder="വിദ്യാര്‍ത്ഥിയുടെ മുഴുവന്‍ പേര്"  name="admission_name" value="<?php echo set_value ( admission_name,$admission['admission_name']);?>">
        <span class="text-danger"><?php echo form_error('admission_name'); ?></span>
        </div> 
        
        
        
        <div class="form-group">
        <label for="email">Date of Birth<span style="color:red;">*</span></label>
        
        <?php
        
        $formatted_date = date('Y-m-d', strtotime($admission['admission_dob']));
        ?>
        <input type="date" onchange="calculateAge(this.value)" class="form-control" placeholder="ജനന തിയ്യതി" id="admission_dob" name="admission_dob" value="<?php echo $formatted_date; ?>">
        <!--<input type="date"  onchange="calculateAge(this.value)" class="form-control"  placeholder="ജനന തിയ്യതി" id="admission_dob" name="admission_dob" value="<?php echo $admission['admission_dob'];?>">-->
        <span id="age" style="color:green"></span>
        <span class="text-danger"><?php echo form_error('admission_dob'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="email">Address :<span style="color:red;">*</span></label>
        <textarea class="form-control"  placeholder="വിദ്യാര്‍ത്ഥിയുടെ വിലാസം"    name="admission_address"><?php echo $admission['admission_address'];?></textarea>
        <span class="text-danger"><?php echo form_error('admission_address'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="email">House Name  :<span style="color:red;">*</span></label>
        <textarea class="form-control" placeholder="വീട്ടുപേര"     name="admission_housename">
        <?php echo set_value (admission_housename,$admission['admission_housename']);?>
        </textarea>
        <span class="text-danger"><?php echo form_error('admission_housename'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="email">Name of Father :<span style="color:red;">*</span></label>
        <input type="text" class="form-control"  id="admission_fathername" name="admission_fathername"  placeholder="പിതാവിന്റെ പേര്"       value="<?php echo $admission['admission_fathername'];?>">
        <span class="text-danger"><?php echo form_error('admission_fathername'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="email">Occupation of Father: :<span style="color:red;">*</span></label>
        <input type="text" class="form-control " id="admission_fatheroccupation" name="admission_fatheroccupation"  placeholder="പിതാവിന്റെ ജോലി"        value="<?php echo $admission['admission_fatheroccupation'];?>"  placeholder="പിതാവിന്റെ ജോലി"  va   >
        <span class="text-danger"><?php echo form_error('admission_fatheroccupation'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="pwd">Name of Guardian:
        <span style="color:red;">*</span>
        </label>
        <input type="text" placeholder="രക്ഷിതാവിന്റെ പേര്" class="form-control" id="guardian" name="guardian" value="<?php echo set_value('guardian', $admission['admission_guardian']); ?>" />
        
        <span class="text-danger"><?php echo form_error('guardian'); ?></span>
        
        </div>
        
        
        
        
        <div class="form-group">
        <label for="pwd">Address Of Guardian:
        <span style="color:red;">*</span>
        <br>
        <input type="checkbox" name="sameasabove" id="sameasabove" value="1" <?php echo ($check_address['ad_check_address'] == 1) ? 'checked' : ''; ?> />
        <span style="color:#aea1a8;">Same as Above</span>
        </label>
        <textarea class="form-control" placeholder="രക്ഷിതാവിന്റെ വിലാസം" name="admission_guardianaddress" id="admission_guardianaddress"><?php echo htmlspecialchars($getstud['admission_guardianaddress']); ?></textarea>
        
        <span class="text-danger"><?php echo form_error('admission_guardianaddress'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Relationship with Applicant:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="relationship" name="relationship" value="<?php echo set_value('relationship', $admission['admission_relationship']); ?>" />       
        <span class="text-danger"><?php echo form_error('relationship'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Phone No:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="phoneno" name="phoneno" value="<?php echo set_value('phoneno', $admission['admission_phoneno']); ?>" />       
        <span class="text-danger"><?php echo form_error('phoneno'); ?></span>
        </div>
        
        </div>
        
        
        
        
        <div class="col-md-6">
        <div class="form-group">
        <label for="email">Name of Mother :<span style="color:red;">*</span></label>
        <input type="text" class="form-control " id="admission_mothername"  placeholder="മാതാവിന്റെ പേര്" name="admission_mothername" value="<?php echo $admission['admission_mothername'];?>">
        <span class="text-danger"><?php echo form_error('admission_mothername'); ?></span>
        </div> 
        
        
        
        <div class="form-group">
        <label for="email">House Name Of Mother<span style="color:red;">*</span></label>
        <input type="text" class="form-control" placeholder="മാതാവിന്റെ വീട്ടു പേര്"   id="admission_motherhousename" name="admission_motherhousename" value="<?php echo $admission['admission_motherhousename'];?>">
        <span class="text-danger"><?php echo form_error('admission_motherhousename'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="email">Photo<span style="color:red;">*</span></label>
        <br>
        <img src="<?php echo base_url();?>entrance/admissionphoto/<?php echo $admission['admission_photo'];?>" style="height:160px; width:140px;" >
        <input type="hidden" name="pict"  value="<?php echo $admission['admission_photo']; ?>" class="form-control">
        <input type="file" class="btn  btn-secondary"  name="photo" >
        <!--<span class="text-danger"><?php echo form_error('admission_photo'); ?></span>-->
        </div>
        </div>
        
        
        
        </div>
        </div>
        
        <br>
        
        
        
        <div class="col-md-12" style="height:auto; float:none; margin:auto; border: 1px solid #b8b9bc; border-radius:30px; position: relative; box-shadow: 3px 5px #e3e6eb;">
        <span class="title"><b>Secondary Details</b></span>
        <p style="padding:10px"></p>
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
        <label for="email">Adhaar No :<span style="color:red;">*</span></label>
        <input type="text" class="form-control"  placeholder="ആധാർ നമ്പർ" id="admission_adharno" name="admission_adharno" value="<?php echo $admission['admission_adharno'];?>">
        <span class="text-danger"><?php echo form_error('admission_adharno'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="email">Thaluk :<span style="color:red;">*</span></label>
        <input type="text" value="<?php echo $admission['admission_thaluk'];?>" class="form-control" name="admission_thaluk" id="admission_thaluk" >
        <span class="text-danger"><?php echo form_error('admission_thaluk'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="email">Village :<span style="color:red;">*</span></label>
        <input type="text" class="form-control" id="admission_village" placeholder="വില്ലേജ്" name="admission_village" value="<?php echo $admission['admission_village'];?>">
        <span class="text-danger"><?php echo form_error('admission_village'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="email">Mahallu :<span style="color:red;">*</span></label>
        <input type="text" class="form-control" id="admission_mahallu" placeholder="മഹല്ല്" name="admission_mahallu" value="<?php echo $admission['admission_mahallu'];?>">
        <span class="text-danger"><?php echo form_error('admission_mahallu'); ?></span>
        </div>
        </div> 
        
        
        
        
        <div class="col-md-6">
        <div class="form-group">
        <label for="email">State :<span style="color:red;">*</span></label>
        <input type="hidden" class="form-control" id="admission_state" name="admission_state" value="<?php echo $admission['admission_state'];?>">
        <select name="state" id="state" class="form-control" onchange="getdist(this.value)">
        
        <option value="<?php echo $admission['state_id'];?>"><?php echo $admission['state_name'];?> </option>
        
        <?php
        foreach($statelist as $sta)
        {
        ?>
        <option value="<?php  echo $sta['state_id']  ?>"><?php  echo $sta['state_name']  ?></option>
        <?php
        }
        ?>
        </select>
        <span class="text-danger"><?php echo form_error('admission_state'); ?></span>
        </div> 
        
        
        <div class="form-group">
        <label for="email">District :<span style="color:red;">*</span></label>
        <select name="district" id="district" class="form-control">
        <option value="<?php echo $admission['district_id'];?>"><?php echo $admission['district_name'];?></option>
        </select>
        <span class="text-danger"><?php echo form_error('district'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="pwd">Are you an Orphan? Yes/No:
        <span style="color:red;">*</span>
        </label><br>
        Yes <input type="radio" name="admission_iforphan" value="Yes"<?php echo ($admission['admission_iforphan'] == 'Yes') ? ' checked' : ''; ?>>
        No <input type="radio" name="admission_iforphan" value="No"<?php echo ($admission['admission_iforphan'] == 'No') ? ' checked' : ''; ?>>
        <span class="text-danger"><?php echo form_error('admission_iforphan'); ?></span>
        </div>
        
        
        
        
        
        <div class="form-group">
        <label for="email">Identification Markbn :<span style="color:red;">*</span></label>
        <input type="text"   placeholder="തിരിച്ചറിയല്‍ അടയാളം"       class="form-control" id="admission_identification" name="admission_identification" value="<?php echo $admission['admission_identification'];?>">
        <span class="text-danger"><?php echo form_error('admission_identification'); ?></span>
        </div>
        </div>
        </div>   
        </div> 
        
        <br>
        
        
        
        <div class="col-md-12" id="previous" style="height:auto; float:none; margin:auto; border: 1px solid #b8b9bc; border-radius:30px; position: relative; box-shadow: 3px 5px #e3e6eb;">
        <span class="title"><b>Previous Studied Details </b></span>
        <p style="padding:10px"></p>
        <div class="row">
        <div class="col-md-6">
        <div class="form-group">
        <label for="email">Last Studied Madrassa :<span style="color:red;">*</span></label>
        <input type="text" class="form-control"   placeholder="അവസാനം പഠിച്ച  മദ്രാസ ക്ലാസ്"           id="admission_laststudiedmadarsa" name="admission_laststudiedmadarsa" value="<?php echo $admission['admission_laststudiedmadarsa'];?>">
        <span class="text-danger"><?php echo form_error('admission_laststudiedmadarsa'); ?></span>
        </div> 
        
        
        <div class="form-group">
        <label for="email">Register  No :<span style="color:red;">*</span></label>
        <input type="text" class="form-control" id="admission_range" name="admission_range" value="<?php echo $admission['admission_range'];?>">
        <!--<span class="text-danger"><?php echo form_error('admission_range'); ?></span>-->
        </div>
        
        
        
        <div class="form-group">
        <label for="email">Last Studied School Class:<span style="color:red;">*</span></label>
        <input type="text" class="form-control" id="admission_laststudied" name="admission_laststudied" value="<?php echo $admission['admission_laststudied'];?>">
        <!--<span class="text-danger"><?php echo form_error('admission_laststudied'); ?></span>-->
        </div>
        </div>
        
        
        <div class="col-md-6">
        <div class="form-group">
        <label for="email">Name of School :<span style="color:red;">*</span></label>
        <input type="text" class="form-control" id="admission_schoolname" name="admission_schoolname"     placeholder="സ്‌കൂളിന്റെ പേര്‌" value="<?php echo $admission['admission_schoolname'];?>">
        <!--<span class="text-danger"><?php echo form_error('admission_schoolname'); ?></span>-->
        </div>
        
        
        
        
        <div class="form-group">
        <label for="pwd">Medium Of School :
        <span style="color:red;">*</span>
        </label>
        <select name="admission_medium" class="form-control" id="admission_medium" value="<?php echo $admission['admission_medium'];?>">
        <option value="<?php echo $admission['admission_medium'];?>"><?php echo $admission['admission_medium'];?></option>
        <option value="English">English</option>
        <option value="Malayalam">Malayalam</option>
        </select>
        <!--<span class="text-danger"><?php echo form_error('admission_medium'); ?></span>-->
        </div>
        
        
        
        </div>
        </div>
        </div>
        
        <br>
        
        <div class="col-md-12"  id="main_previous" style="height:auto; float:none; margin:auto; border: 1px solid #b8b9bc; border-radius:30px; position: relative; box-shadow: 3px 5px #e3e6eb;">
        <span class="title"><b>Previous Studied Details</b></span>
        <p style="padding:10px"></p>
        <div class="col-md-6">
        <div class="form-group">
        <label for="email">Last Studied Institute :
        <span style="color:red;">*</span></label>
        <input type="text" class="form-control" id="last_studied_institute" placeholder="Last studied Institute" name="last_studied_institute" value="<?php echo set_value('laststudiedmadarsa', $check_address['last_studied_institute']); ?>" /> 
        <!--<span class="text-danger"><?php echo form_error('last_studied_institute'); ?></span>-->
        </div>
        
        
        <div class="form-group">
        <label for="email">Years Completed :
        <span style="color:red;">*</span></label>
        <input type="text" placeholder="Years Completed" class="form-control" id="years_completed"  name="years_completed"  value="<?php echo set_value('years_completed', $check_address['years_completed']); ?>" /> 
        <!--<span class="text-danger"><?php echo form_error('years_completed'); ?></span>-->
        </div>
        
        
        
        
        <div class="form-group">
        <label for="pwd">Name Of Prominent Teacher
        <span style="color:red;">*</span>
        </label>
        <input type="text" placeholder="Prominent Teacher" class="form-control" id="Name_Prominent_Teacher"  name="Name_Prominent_Teacher"  value="<?php echo set_value('Name_Prominent_Teacher', $check_address['Name_Prominent_Teacher']); ?>" /> 
        <!--<span class="text-danger"><?php echo form_error('Name_Prominent_Teacher'); ?></span>-->
        </div>
        
        
        </div>
        
        
        <div class="col-md-6">
        <div class="form-group" id="Major_Books_Studied_ajx">
        <label for="pwd">Major Books Studied
        <span style="color:red;">*</span>
        </label>
        <input type="text" placeholder="Major Books Studied" class="form-control" id="Major_Books_Studied"  name="Major_Books_Studied" value="<?php echo set_value('Major_Books_Studied', $check_address['Major_Books_Studied']); ?>" />     
        <!--<span class="text-danger"><?php echo form_error('Major_Books_Studied'); ?></span>-->
        </div>
        
        
        <div class="form-group" id="Repitition_Completed_ajx">
        <label for="pwd">Repitition Completed
        <span style="color:red;">*</span>
        </label>
        <input type="text" placeholder="Repitition Completed" class="form-control" id="Repitition_Completed" name="Repitition_Completed"  value="<?php echo set_value('Repitition_Completed', $check_address['Repitition_Completed']); ?>" />        
        <!--<span class="text-danger"><?php echo form_error('Repitition_Completed'); ?></span>-->
        </div>
        
        
        
        <!--<div class="form-group" id="General_Education_ajx">-->
        <!--<label for="pwd">General Education-->
        <!--<span style="color:red;">*</span>-->
        <!--</label>-->
        <!--<input type="text" placeholder="" class="form-control" id="General_Education" name="General_Education"  value="<?php echo set_value('General_Education', $check_address['General_Education']); ?>" />        -->
        <!--<span class="text-danger"><?php echo form_error('General_Education'); ?></span>-->
        <!--</div>-->
        
        
        <div class="form-group" id="general_education_mutajx" >
        <label for="pwd">General Education
        <span style="color:red;">*</span>
        </label>
        
        
        <select name="General_Education_mutawal" name="General_Education_mutawal" class="form-control">
        <option value="<?php echo $check_address['General_Education_mutawal'];  ?>"><?php echo $check_address['General_Education_mutawal'];  ?></option>
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
        <option value="<?php echo $check_address['General_Education'];  ?>"><?php echo $check_address['General_Education'];  ?></option>
        
        <?php
        for($i=1;$i<=10;$i++)
        {
        ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        
        <?php } ?>
        
        </select>
        
        </div>
        
        
        <div class="form-group">Place Of Institution  
        <span style="color:red;">*</span>
        </label>
        <input type="text" placeholder="Place of Institution" class="form-control" id="PlaceOf_Institution" name="PlaceOf_Institution"  value="<?php echo set_value('PlaceOf_Institution', $check_address['PlaceOf_Institution']); ?>" />        
        <span class="text-danger"><?php echo form_error('PlaceOf_Institution'); ?></span>
        </div>
        </div>
        
        
        <div class="form-group">
        <span style="color:red;">&nbsp;</span>
        </label>
        
        
        </div>
        
        
        
        
        </div>
        
        <br>
        
        <input type="hidden" name="coursename_ajx" id="coursename_ajx" value="<?php echo $getcourse['entranceexam_course_name']; ?>" />
        
        <br>
        
        
        
        <div class="col-md-12" style="height:auto; float:none; margin:auto; border: 1px solid #b8b9bc; border-radius:30px; position: relative; box-shadow: 3px 5px #e3e6eb;">
        <span class="title"><b> </b></span>
        <div class="row">
        <div class="col-md-12">
        
        <table width="100%">
        <tr><td> Exam Center&nbsp;&nbsp;:&nbsp;</td><td>
        
        <select  name="examcenter"  required="required" class="form-control">
        
        <option value="<?php echo $admission['admission_institute_examcenter'];?>"><?php echo $admission['admission_institute_examcenter'];?></option>
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
        </tr>
        
        
        <tr>
        <td >
        <!-- <img src="<?php echo base_url(); ?>entrance/payment_code/<?php echo $pdfimage['pledge'];?>" width="100%" height="180">-->
        
        
        Pledge<input type="checkbox" id="checkterms" name="checkterms" required />
        </td>
        
        <td class="fontstyle">
        
        ഞാന്‍  സമസ്ത കേരള ജംഇയ്യത്തുല്‍ ഉലമായുടെയും അതിന്റെ കീഴ്ഘടകങ്ങളുടെയും ആശയാദര്‍ശങ്ങളില്‍ അടി യുറച്ചു വിശ്വസിക്കുന്നവനും അതനുസരിച്ചു പ്രവര്‍ത്തിക്കുന്നവനുമാണ് . മേല്‍ കാണിച്ച വിവരങ്ങള്‍ സത്യമാണെന്നും എന്റെ കുട്ടിക്ക് അഡ്മിഷന്‍ ലഭിക്കുന്ന പക്ഷം സ്ഥാപനത്തിന്റെ 12 വര്‍ഷ കോഴ്‌സ് പൂര്‍ത്തിയാകുന്നത് വരെ സ്ഥാപനത്തില്‍ തന്നെ പഠിപ്പിക്കുമെന്നും , കുട്ടിയുടെ രക്ഷിതാവ് എന്ന നിലക്ക് കുട്ടിയുടെ അടിസ്ഥാന രേഖകള്‍ (SSLC, +2, Degree Certificates) മുഴുവനും കോഴ്‌സ് പൂര്‍ത്തിയാകുന്നത് വരെ സ്ഥാപനത്തിന്റെ ഉത്തരവാധിത്വത്തില്‍ ഏല്‍പിക്കുമെന്നും , കുട്ടിയുടെ വസ്ത്ര ധാരണയടക്കമുള്ള വേഷവിധാനങ്ങള്‍ മുതലായ മുഴുവന്‍ കാര്യങ്ങളിലും സ്ഥാപനത്തിന്റെ നിയമങ്ങള്‍ മുഴുവനും ഞാനും എന്റെ മകനും അംഗീകരിച്ചു നടപ്പില്‍ വരുത്തുമെന്നും, മേല്‍ പറഞ്ഞ കാര്യങ്ങള്‍ക്ക് വിരുദ്ധം വരു ത്തുന്ന പക്ഷം സ്ഥാപനം എടുക്കുന്ന എല്ലാ തീരുമാനങ്ങളും അംഗീകരിക്കാന്‍ ഞങ്ങള്‍ ബാധ്വസ്ഥരാണെന്നും ഇതിനാല്‍ സാക്ഷ്യപ്പെടുത്തുന്നു.
        
        
        </td>
        </tr>
        </table>
        <hr></hr>
        <table style="width: 100%; text-align:center;">
        <tr>
        <td style="width: 50%; font-size:20px;"><b>
        
        <button type="submit" id="submit" name="edit" class="btn btn-warning" ><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit</button> 
        <button type="submit" id="submit" name="editconfirm" class="btn btn-success" > <i class="fa fa-check"></i>&nbsp;&nbsp;Confirm</button>
        </td>
        </tr>
        </table>   
        
        </div>
        </div>
        </div>
        </form>
        
        <?php /* if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } */ ?>
        <?php
        if (isset($error_message)) {
        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
        }
        ?>
        
        </div>
        </div>
        
        </div>
        </div>
        
        
        <script type="text/javascript">
        $(document).ready(function()
        {
        var coursename_ajx= $('#coursename_ajx').val();
        if(coursename_ajx=="MUTHAWWAL")
        {
        $('#previous').hide();   
        $('#main_previous').show();   
        $('#Major_Books_Studied_ajx').show();
        $('#general_education_mutajx').show(); 
        $('#general_education_huffaz_ajx').hide(); 
        $('#Repitition_Completed_ajx').hide(); 
        }
        else if(coursename_ajx=="THAJLIYATHUL HUFFAZ")
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
        $('#sameasabove').on('click', function() 
        {
        var isChecked = $(this).prop('checked');
        if (isChecked) {
        $('textarea[name="admission_guardianaddress"]').val($('textarea[name="admission_address"]').val());
        } else {
        
        $('textarea[name="admission_guardianaddress"]').val('');
        }
        });
        });
        
        var maxLength = 12;
        $('#adharno').keyup(function() 
        {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
        });
        </script>
        
        
        <script>
        function calculateAge(selectedDate) {
        var dob = new Date(selectedDate);
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var monthDiff = today.getMonth() - dob.getMonth();
        
        // If the birth month is ahead of the current month or birth month is same but birth date is ahead of today's date
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
        }
        
        document.getElementById("age").innerText = "Age: " + age;
        }
        </script>
        
        
        
