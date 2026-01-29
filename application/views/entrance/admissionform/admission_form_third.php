        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>  
        
        
        <div class="container-xxl py-5" style="height:1400px;">
        <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        
        
        </div>
        
        
        
        
        <div class="col-md-6" style=" float:none;margin:auto;">
        <div class="wow fadeInUp" data-wow-delay="0.2s">                          
        
        <div class="form-group"> 
        
        <label style="background-color:#47519a; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" >APPLICATION  FOR &nbsp; <?php echo $getcourse['entranceexam_course_name']; ?></label>
        </div>
        
        <br>
        <br>
        
        <form action="<?php echo site_url('entrance/home/admission_form_third'); ?>" method="POST">
        <div class="form-group">
        <label for="email">Adhaar No :<span style="color:red;">*</span></label>
        <input type="text"  maxlength="12" class="form-control" required id="adharno" name="adharno" value="<?php echo $getstud['admission_adharno']; ?>">
        <span id="rchars" style="color:#cb4a4a;">12</span><span style="color:#cb4a4a;"> Max Characters</span>
        <span class="text-danger"><?php echo form_error('adharno'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Date of Birth:<span style="color:red;">*</span>
        </label>
        <input type="date" class="form-control" id="dob" name="dob" max='2017-12-31' value="<?php echo $getstud['admission_dob']; ?>">
        <span class="text-danger"><?php echo form_error('dob'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="pwd">State:<span style="color:red;">*</span>
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
        
        
        <div class="form-group">
        <label for="pwd">District:<span style="color:red;">*</span>
        </label>
        <select name="district" id="district" class="form-control">
        </select>
        <span class="text-danger"><?php echo form_error('district'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Thaluk:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="thaluk" name="thaluk" value="<?php echo $getstud['admission_thaluk']; ?>">
        <span class="text-danger"><?php echo form_error('thaluk'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Village:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="village" name="village" value="<?php echo $getstud['admission_village']; ?>">
        
        <span class="text-danger"><?php echo form_error('village'); ?></span>
        </div>
        
        
        
        <div class="form-group">
        <label for="pwd">Mahallu:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="mahallu" name="mahallu" value="<?php echo $getstud['admission_mahallu']; ?>">
        <span class="text-danger"><?php echo form_error('mahallu'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Are you an Orphan? Yes/No:<span style="color:red;">*</span>
        </label>
        <br>
        Yes<input type="radio" name="iforphan" value="Yes"> No<input type="radio" name="iforphan" value="No">
        <span class="text-danger"><?php echo form_error('iforphan'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Name of Guardian:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="guardian" name="guardian" value="<?php echo $getstud['admission_guardian']; ?>">
        <span class="text-danger"><?php echo form_error('guardian'); ?></span>
        </div>
        
        <input type="hidden" class="form-control" id="admission_address" name="admission_address" value="<?php echo $getstud['admission_address']; ?>">
        
        <div class="form-group">
        <label for="pwd">Address Of Guardian:<span style="color:red;">*</span>
        <br><input type="checkbox" name="sameasabove" id="sameasabove"/><span style="color:#aea1a8;">Same as Above</span>
        </label>
        
        <textarea class="form-control" name="guardianaddress" id="guardianaddress"><?php echo $getstud['admission_guardianaddress']; ?></textarea>
        <span class="text-danger"><?php echo form_error('guardianaddress'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="pwd">Relationship with Student:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="relationship" name="relationship" value="<?php echo $getstud['admission_relationship']; ?>">
        <span class="text-danger"><?php echo form_error('relationship'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="pwd">Phone No:<span style="color:red;">*</span>
        </label>
        <input type="text" class="form-control" id="phoneno" name="phoneno" value="<?php echo $getstud['admission_phoneno']; ?>">
        <span class="text-danger"><?php echo form_error('phoneno'); ?></span>
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Save & Next</button>
        </form>
    </div>
    </div>
    </div>
    </div>
    
   

    <script type="text/javascript">
    $('#sameasabove').on('click',function()
    {
    var same = document.getElementById('sameasabove');
    if (same.checked) 
    {
    var admission_address=$('#admission_address').val();
    var guardianaddress  = $('#guardianaddress').val();
    $('#guardianaddress').val(admission_address);
    } 
    else
    {
    $('#guardianaddress').val(guardianaddress);
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
    
    
    


    
    
var maxLength = 12;
$('#adharno').keyup(function() 
{
    var textlen = maxLength - $(this).val().length;
  $('#rchars').text(textlen);
});
    </script>


   
           
          
      

