            
                <div class=" " style="height:500px; margin-top:20px;">
                <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <!--<h6 class="section-title text-center text-primary text-uppercase">Login</h6>-->
                </div>
                <div class="col-md-12 " style="float:none;margin:auto;">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    
                    
            <?php
            if(isset($msg))
            {
            $ms= $msg; 
            }
            else
            {
            $ms="";
            }
            
            ?>
            
            
            <div class="col-md-6" style="height:auto; float:none; margin:auto; border: 2px solid #e9e9e9; border-radius:10px; position: relative; box-shadow: 3px 5px #e3e6eb;" >
            <form  name="frm" method="POST" action="<?php  echo site_url('entrance/entranceexam/login');   ?>" >
            <div class="row g-3 " id="wrp" >
            <div class="col-md-12">
            <h6 class=" text-center  text-uppercase fontstyle" >Login</h6>   
                
            <div class="form-floating">
            <span><label for="name">User Name<span style="color:red;">*</span></label>
            <input type="text" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>"   autocomplete="off" class="form-control" required>
            </div>
            <br>
            
            <div class="form-floating">
            <span><label for="name">Password<span style="color:red;">*</span></label>
            <input type="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>"  autocomplete="off" class="form-control" required><br>
            
            </div>
            <div class="form-floating loginForm" style="text-align:center;">
                
                <span style="color:red; font-size:15px;"><?php echo $ms; ?></span><br>
            <input type="submit"  class="btn btn-primary split" style="background-color:#00C3CB !important; border:none; " value="Login"> 
            </div>
            </div>
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>
            </div>
            
            
            <script>
            $(document).ready(function() {
            $('#wrp').show();
            $('html, body').animate({
            scrollTop: $('#wrp').offset().top
            }, 'slow');
            });
            </script>     
            