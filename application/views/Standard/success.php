
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
	   background:rgba(255,102,0,1);
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
        background:rgba(255,102,0,1);
        transition:all ease-in-out 0.3s;
    }

    .content a:hover
    {
        text-decoration:none;
        background:#000;
    }
   
</style>

 <div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <section class="content-header">
                <h1>
                    <i class="fa fa-money"></i><small> Success</small></h1>
            </section>
        </div>
    </div>	
	
	
	<div class="row">
      <div class="col-md-12">
         <div class="payment">
		 
		 <div class="payment_header">
               
            </div>
            
            <div class="content">
			<div class="check">
			<!--<i class="fa fa-check" aria-hidden="true"></i>-->
			<img src="<?php echo base_url();?>entrance/payment_code/check_correct.gif" style="width:100%; height:90%">
			
			</div>
			
               <h1>Payment Success !</h1>
               <p>Thank You . </p>
             
            </div>
            
         </div>
      </div>
   </div>
	
	
	</div>
