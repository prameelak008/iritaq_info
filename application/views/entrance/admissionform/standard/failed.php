
        <style>
        
        
        .error-template {padding: 40px 15px;text-align: center;}
        .error-actions {margin-top:15px;margin-bottom:15px;}
        .error-actions .btn { margin-right:10px; }
        
        .card {
        background: white;
        /*padding: 300px;*/
        border-radius: 4px;
        
        
        border: 2px solid;
        padding: 10px;
        box-shadow: 5px 10px  6px 6px #888888;
        
        display: inline-block;
        margin: 0 auto;
        height:600px;
        text-align:center;  
        width:100%;
        }
        
        
        .error-actions a
        {
        width:200px;
        height:35px;
        color:#fff;
        border-radius:30px;
        padding:5px 10px;
        background:rgba(255,102,0,1);
        transition:all ease-in-out 0.3s;
        }
        
        .error-actions a:hover
        {
        text-decoration:none;
        background:#000;
        }
        
        </style>
        
        
            <div class="col-md-12" >
            <label style="" ></label>
            </div>
	        <div class="container-xxl py-5" style="height:1000px;">
            <div class="container">
            <div class="col-md-6" style="float:none;margin:auto;" >
            <div class="wow fadeInUp" data-wow-delay="0.2s">
            <div class="row g-3">

            <div class="col-md-12">
            <div class="form-floating">
            <div class="card">
            <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <img src="<?php echo base_url();?>entrance/payment_code/failed.png" style="width:100%; height:60%">
            
            <div class="error-template">
            
            
                <br>
                
                <h1 style="color:red;"> Failed!</h1>
                
                <p>Application For <b><?php  echo $applicantcourse['entranceexam_course_name'];  ?></b>is Failed  </p>
                
                <br>
                
                <h5> <a href="<?php  echo site_url('entrance/entranceexam/login');  ?>">Login And Try Again</a>
                <br>
                
                
                </h5>
                
                
                <br>
                
                
                
                Sorry, an error has occured, !
                
                
                
                
                <br>
                
             
               
                
                <h5> <a href="<?php echo site_url('entrance/Entranceexam/ui_tables');    ?>">Take Me Home Page</a>
                <br>
                
                
                </h5>
                
              
                
                </div>
                </div>
                
                </div>
                </div>
                
                <br>
                <br>


            
            </div>
           

            </div>
            </div>
            </div>
            </div>
	   </div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


