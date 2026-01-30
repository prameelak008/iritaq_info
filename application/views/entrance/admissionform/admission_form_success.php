
<style type="text/css">
	.payment
	{
		border:1px solid #f2f2f2;
		height:280px;
        border-radius:20px;
        background:#fff;
	}
   .payment_header
   {
	   background:rgba(84 120 104);
	   padding:20px;
       border-radius:20px 20px 0px 0px;
	   
   }
   
   .check
   {
	   margin:0px auto;
	   width:50px;
	   height:50px;
	   border-radius:100%;
	   background:#fff;
	   text-align:center;
   }
   
   .check i
   {
	   vertical-align:middle;
	   line-height:50px;
	   font-size:30px;
   }

    .content 
    {
        text-align:center;
    }

    .content  h1
    {
        font-size:25px;
        padding-top:25px;
    }

    .content a
    {
        width:200px;
        height:35px;
        color:#fff;
        border-radius:30px;
        padding:5px 10px;
        background:rgba(84 120 104);
        transition:all ease-in-out 0.3s;
    }

    .content a:hover
    {
        text-decoration:none;
        background:#000;
    }
   
</style>




        
        <div class="container-xxl py-5" style="height:500px;">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                
               
            </div>
           
                
        
        
                <div class="col-md-6" style="float:none;margin:auto;">
                    <div class="wow fadeInUp" data-wow-delay="0.2s"> 
                    <div class="check"><img src="<?php echo base_url();  ?>entrance/payment_code/payment_success.jpg" style="height:40px; width:40px;"></div>
           <h1>Completed</h1>
           <br>
           <p>Thank you for filling our form. We will keep your information safe. </p>
           <a href="#">Go to Home</a>
           <a href="<?php echo site_url('entrance/home/admission_form_pdf');  ?>"><i class="fa fa-download"></i>Download Pdf</a>                      
        
                   
                </div>
            </div>
        </div>
        </div>