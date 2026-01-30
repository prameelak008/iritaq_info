    <style type="text/css">
    optgroup {
    color: #e86464;
    font-size:17px;
    }
    
    option {
    color: black;
    font-size:15px;
    }
    </style>  
    
  
               
             
        <div class="col-md-12" >
        <label style="background-color:#00C3CB; color:white; text-align:center;"  class="form-control" >APPLICATION  FOR &nbsp;<?php echo $getcourse['entranceexam_course_name']; ?></label>
        </div>
        
        <div class="container-xxl py-5"> 
        <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <br>
        <br>ADMISSION OPTIONS (Maximum 3 Options)</label>
        </div>
        
        <div class="col-md-12" style="height:auto; float:none;margin:auto; " >
        <div class="wow fadeInUp" data-wow-delay="0.2s">
        <br>
        <br>
        <br>
        <br>
        
        
            <div class="col-md-12" style="height:auto; float:none; margin:auto; border: 2px solid #e9e9e9; border-radius:10px; position: relative; box-shadow: 3px 5px #e3e6eb; margin:10px 10px 10px 10px;" >
            
            <form name="frm" action="<?php echo site_url('entrance/home/update_center'); ?>" method="POST" enctype="multipart/form-data">
                
            <div class="form-group">
           <!--<label style="background-color:#47519a; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" ><b>APPLICATION  FOR &nbsp; <?php echo $getcourse['entranceexam_course_name']; ?></b>
            -->
            
            
            </div>
            <br>
            <br>
                
            <div class="form-group">
            <label for="email">Admission Option 1 :<br>
            ചേരാൻ ഉദ്ദേശിക്കുന്ന സ്ഥാപനം തിരഞ്ഞെടുക്കുക
            <span style="color:red;">*</span></label>
            
            <select  name="institute_optionone" class="form-control">
            <option value="">Admission Option 1</option>
            <?php 
            foreach($institute as $inst)
            {
            ?>
            <optgroup label="<?php echo $inst['entranceexam_insituteseats']; ?>">
            <option value="<?php echo $inst['entranceexam_insitutename'];   ?>"><?php echo $inst['entranceexam_insitutename'].'('.$inst['entranceexam_insituteseats'].')';   ?></option>
            </optgroup>
            <?php } ?>
            
            </select>
            <span class="text-danger"><?php echo form_error('institute_optionone'); ?></span>
            </div>
            
            
            
            
            <div class="form-group">
            <label for="name">Admission Option 2: <br>
            ചേരാൻ ഉദ്ദേശിക്കുന്ന സ്ഥാപനം തിരഞ്ഞെടുക്കുക
            <span style="color:red;">*</span>
            </label>
            <select  name="institute_optiontwo" class="form-control">
            <option value="">Admission Option 2</option>
            
            <?php 
            foreach($institute as $inst)
            {
            ?>
             <optgroup label="<?php echo $inst['entranceexam_insituteseats']; ?>">
            <option value="<?php echo $inst['entranceexam_insitutename'];   ?>"><?php echo $inst['entranceexam_insitutename'].'('.$inst['entranceexam_insituteseats'].')';   ?></option>
            </optgroup>
            
            <?php } ?>
            
            
            </select>
            <span class="text-danger"><?php echo form_error('institute_optiontwo'); ?></span>
            </div>
            
            <?php 
            $color="red";
            
            ?>
            
            <div class="form-group">
            <label for="name">Admission Option 3:  <br>
            ചേരാൻ ഉദ്ദേശിക്കുന്ന സ്ഥാപനം തിരഞ്ഞെടുക്കുക
            <span style="color:red;">*</span>
            </label>
            <select  name="institute_optionthree" id="institute_optionthree" class="form-control" >
            <option value="">Admission Option 3</option>
            
            <?php 
            foreach($institute as $inst)
            {
            ?>
            <optgroup label="<?php echo $inst['entranceexam_insituteseats']; ?>">
            <option value="<?php echo $inst['entranceexam_insitutename'];   ?>"   >
          <?php  echo $inst['entranceexam_insitutename'].'('.$inst['entranceexam_insituteseats'].')';  ?>
            
            <!--<?php  echo $inst['entranceexam_insitutename'];  ?>-->
            
           
            </option>
            </optgroup >
            <?php } ?>
            
            
            </select>
            
            <span class="text-danger"><?php echo form_error('institute_optionthree'); ?></span>
            </div>
            
            
            
           
           
            <!--
            
            <div class="form-group">
            <label for="name">Examination Center <br>
            
            പരീക്ഷാ സ്ഥലം തിരഞ്ഞെടുക്കുക
            <span style="color:red;">*</span>
            </label>
            
            
            <select  name="examcenter" class="form-control">
                
            <option value="">Select Examination Center</option>
            <?php 
            foreach($centre as $cen)
            {
            ?>
             <optgroup label="<?php echo $cen['entranceexam_centreseat']; ?>">
            <option value="<?php echo $cen['entranceexam_centrename'];   ?>"><?php echo $cen['entranceexam_centrename'].'('.	$cen['entranceexam_centreseat'].')';   ?></option>
             </optgroup >
            
            <?php } ?>
            </select>
            <span class="text-danger"><?php echo form_error('examcenter'); ?></span>
            </div>
            -->
            
            
            
            <br>
            <br>
            <button type="submit" class="btn btn-success">Submit </button>
            </form>
            
            <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>
            <?php
            if (isset($error_message)) {
            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
            }
            ?>
             </div>
            </div>
            </div>
            </div>
            </div>
            
           
      
            