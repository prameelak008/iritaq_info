       
        <div class="container-xxl py-5" style="height:800px;">
        <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        </div>
        
        <div class="col-md-6" style="float:none;margin:auto;">
        <div class="wow fadeInUp" data-wow-delay="0.2s">
            
            
            
        <div class="form-group"> 
        
        <label style="background-color:#47519a; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" >APPLIED  FOR &nbsp; <?php echo $getcourse['entranceexam_course_name']; ?></label>
        </div>
        
        <br>
        <br>   
            
            
        <form action="<?php echo site_url('entrance/home/admission_form_four'); ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="email">Last Studied Madrassa Class :<span style="color:red;">*</span></label>
        <input type="text" class="form-control" id="laststudiedmadarsa" name="laststudiedmadarsa" value="<?php echo $getstud['admission_laststudiedmadarsa']; ?>">
        <span class="text-danger"><?php echo form_error('laststudiedmadarsa'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="email">Name Of Madrassa :<span style="color:red;">*</span></label>
        <input type="text" class="form-control" id="madarsaname" name="madarsaname" value="<?php echo $getstud['admission_nameofmadarsa']; ?>">
        <span class="text-danger"><?php echo form_error('madarsaname'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Register No:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="range" name="range" value="<?php echo $getstud['admission_range']; ?>">
        <span class="text-danger"><?php echo form_error('range'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="pwd">Last Studied School Class:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="laststudied" name="laststudied" value="<?php echo $getstud['admission_laststudied']; ?>">
        <span class="text-danger"><?php echo form_error('laststudied'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Name of School:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="schoolname" name="schoolname" value="<?php echo $getstud['admission_schoolname']; ?>">
        <span class="text-danger"><?php echo form_error('schoolname'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Medium:<span style="color:red;">*</span>
        </label>
        <select name="medium" class="form-control" id="medium"/>
        <option value="English">English</option>
        <option value="Malayalam">Malayalam</option>
        </select>
        
        
        <span class="text-danger"><?php echo form_error('medium'); ?></span>
        </div>
        <div class="form-group">
        <label for="pwd">Identification Mark:<span style="color:red;">*</span>
        </label>
        
        <textarea class="form-control" name="identification"><?php echo $getstud['admission_identification']; ?></textarea>
        <span class="text-danger"><?php echo form_error('identification'); ?></span>
        </div>
        <div class="form-group">
        <label for="email">Photo  :<span style="color:red;">*</span></label>
        <br>
        <input type="file"  class="form-control" id="photo"  name="photo" required  >
        
        
        </div>
        <br>
        <br>
        
        <button type="submit" class="btn btn-success">Save & Next</button>
        </form>
        </div>
        </div>
        </div>
        </div>
        
        