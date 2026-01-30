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

						
						
						
						            
                <div class=" " style="height:auto; margin-top:20px;">
                <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <!--<h6 class="section-title text-center text-primary text-uppercase">Login</h6>-->
                </div>
                <div class="col-md-12" style="float:none;margin:auto;">
                <div class="wow fadeInUp" data-wow-delay="0.2s" >
                   <!--<iframe src="<?php echo base_url(); ?>entrance/payment_code/Prospectus_2024-25.pdf" width="100%" height="600px" frameborder="0" id="regst"></iframe> -->
                    
             <embed src="<?php echo base_url(); ?>entrance/payment_code/Prospectus_2024-25.pdf" type="application/pdf" width="100%" height="600px" />
            
            
           
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
            
            
      
            
            
            
            