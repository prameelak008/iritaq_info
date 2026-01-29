<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>


<style type="text/css">
    
    #input-wrapper * {
  position: absolute;
}

#input-wrapper label {
  z-index: 99;
  line-height: 25px;
  padding: 2px;
  margin-left: 5px;

}

#input-wrapper input {
  height: 25px;
  text-indent: 35px;
}
    
</style>

    <?php if($this->session->flashdata('failed')): ?> 
						<script>
						swal.fire({
						  title: "USER NAME EXISTS",
						showConfirmButton: true,
						});
												
						
						</script>
						<?php
						endif; 
						?>



<?php if($this->session->flashdata('success')): ?> 
						<script>
						swal.fire({
						  title: "YOU ARE SUCCESSFULLY REGISTERED TO",
						showConfirmButton: false,
						  html:
    'JAMIA JALALIYYA MUNDAKULAM <br>Admission Portal <br></b> ' +
    '<a href="<?php  echo site_url('entrance/entranceexam/login');  ?>"><span class="btn btn-success">LOGIN & APPLY</a></a> ' +
    '',
						  icon: "success",
						});
												
						
						</script>
						<?php
						endif; 
						?>
						
						
						
						            
                <div class=" " style="height:auto; margin-top:20px;">
                <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <!--<h6 class="section-title text-center text-primary text-uppercase">Login</h6>-->
                </div>
                <div class="col-md-12" style="float:none;margin:auto;">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
            
            
            <div class="col-md-12" style="height:auto; float:none; margin:auto; border: 2px solid #e9e9e9; border-radius:10px; position: relative; box-shadow: 3px 5px #e3e6eb; margin:10px 10px 10px 10px;" >
            <form  name="frm" method="POST" action="<?php  echo site_url('entrance/Entranceexam/addregister');   ?>"  >
            <div class="row g-3" id="regst">
                
            <div class="col-md-6" style="float:none;margin:auto;">
            <h6 class=" text-center  text-uppercase fontstyle" >Register</h6>
            <div class="form-floating">
            <span>
            <label for="name">Name<span style="color:red;">*</span></label>
            <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo set_value('name'); ?>" />
             <span class="text-danger"><?php echo form_error('name'); ?></span>
            </div>
            <br>
            
            
            <div class="form-floating">
            <span><label for="name">Username<span style="color:red;">*</span></label>
            <input type="text" class="form-control" name="username" placeholder="User Name" value="<?php echo set_value('username'); ?>" />
            <span class="text-danger"><?php echo form_error('username'); ?></span>
            </div>
            <br>
        
            
            <div class="form-floating">
            <span><label for="name">Password<span style="color:red;">*</span></label>
            <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" />
            <span class="text-danger"><?php echo form_error('password'); ?></span>
            </div>
            <br>
            
            <div class="form-floating">
            <span><label for="name">Password<span style="color:red;">*</span></label>
            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" value="<?php echo set_value('confirmpassword'); ?>" />
            <span class="text-danger"><?php echo form_error('confirmpassword'); ?></span>
            </div>
            <br>
            
            <div class="form-floating">
            <span><label for="name">Email<span style="color:red;">*</span></label>
            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" />
            <span class="text-danger"><?php echo form_error('email'); ?></span>
            </div>
            <br>
            
            
            <div class="form-floating" >
            <span><label for="name">Phone<span style="color:red;">*</span></label>
            <div id="input-wrapper">
            <label for="number">91</label>
            <input id='number' style="width:80%;" onchange="this.value = '91' + this.value" type="number" name="phone"  class="form-control" value="<?php echo set_value('phone'); ?>" />
            </div>
            <br>
            <br>
            <span class="text-danger"><?php echo form_error('phone'); ?></span>
            </div>
            
            
            <div class="form-floating" style="text-align:center;" >
            <input type="submit"  class="btn btn-primary split" style="background-color:#00C3CB !important; border:none;" value="Register"> 
            <br>
            <br>
            </div>
            
            </div>
            
            <br>
            <br>
            
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>
            </div>
						
            <script>
            $(document).ready(function() {
            $('#regst').show();
            $('html, body').animate({
            scrollTop: $('#regst').offset().top
            }, 'slow');
            });
            </script>             
            
            
      
            
            
            
            