        
        <div class="container-xxl py-5" style="height:1000px;">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    
                   
                </div>
               
                    


                    <div class="col-md-6" style="float:none;margin:auto;">
                        <div class="wow fadeInUp" data-wow-delay="0.2s"> 
                        
                        
                        
<div class="form-group"> 

<label style="background-color:#47519a; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" >APPLICATION  FOR &nbsp; <?php echo $getcourse['entranceexam_course_name']; ?></label>
</div>

<br>
<br>                    

<form action="<?php echo site_url('entrance/home/admission_form_second'); ?>" method="POST">
                                    

  <div class="form-group">
    <label for="email">Name of Father :<span style="color:red;">*</span></label>
    <input type="text" class="form-control" id="fathername" name="fathername" value="<?php echo $getstud['admission_fathername']; ?>">
    <span class="text-danger"><?php echo form_error('fathername'); ?></span>
  </div>


  <div class="form-group">
    <label for="pwd">House Name:<span style="color:red;">*</span>
</label>
    <input type="text" class="form-control" id="housename" name="housename" value="<?php echo $getstud['admission_housename']; ?>">
    <span class="text-danger"><?php echo form_error('housename'); ?></span>
  </div>



  <div class="form-group">
    <label for="pwd">Occupation of Father:<span style="color:red;">*</span>
</label>
    <input type="text" class="form-control" id="fatheroccupation" name="fatheroccupation" value="<?php echo $getstud['admission_fatheroccupation']; ?>">
    <span class="text-danger"><?php echo form_error('fatheroccupation'); ?></span>
  </div>


  <div class="form-group">
    <label for="pwd">Name of Mother:<span style="color:red;">*</span>
</label>
    <input type="text" class="form-control" id="mothername" name="mothername" value="<?php echo $getstud['admission_mothername']; ?>">
    <span class="text-danger"><?php echo form_error('mothername'); ?></span>
  </div>


   <div class="form-group">
    <label for="pwd">Mother House Name:<span style="color:red;">*</span>
</label>
    <input type="text" class="form-control" id="motherhousename" name="motherhousename" value="<?php echo $getstud['admission_motherhousename']; ?>">
    <span class="text-danger"><?php echo form_error('motherhousename'); ?></span>
  </div>


  <div class="form-group">
    <label for="pwd">Address:<span style="color:red;">*</span>
</label>
    
   <textarea class="form-control" name="address"><?php echo $getstud['admission_address']; ?></textarea>
    <span class="text-danger"><?php echo form_error('address'); ?></span>
  </div>
  
  
  
  
  
  

<br>
<br>




  <button type="submit" class="btn btn-success">Save & Next</button>
</form>

   
                           

                       
                    </div>
                </div>
            </div>
        </div>