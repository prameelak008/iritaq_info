                <style type="text/css">
                /*radio button*/
                
                /*
                .donate-now {
                list-style-type: none;
                margin: 25px 0 0 0;
                padding: 0;
                }
                
                .donate-now li {
                float: left;
                margin: 0 5px 0 0;
                width: 150px;
                height: 40px;
                position: relative;
                font-size:12px;
                background-color:green;
                white-space: nowrap;
                color:white;
                }
                
                .donate-now label,
                .donate-now input {
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                }
                
                .donate-now input[type="radio"] {
                opacity: 0.01;
                z-index: 100;
                }
                
                .donate-now input[type="radio"]:checked+label,
                .Checked+label {
                background-color:#a9ceee;
                }
                
                .donate-now label {
                padding: 5px;
                border: 1px solid #CCC;
                cursor: pointer;
                z-index: 90;
                }
                
                .donate-now label:hover {
                background-color:#a9ceee;
                }
                */
                
                
                .fontstyle {
                font-size: calc(0.8vw + 8px);
                font-family: 'meera';
                }
                </style>
                <div class="form-group"> 
                <label style="background-color:#00C3CB; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" >APPLY FOR ENTRANCE EXAM </label>
                </div>
                
                
                <?php
                if(!empty($fee_details))
                {
                ?>
                <div class="container-xxl py-5" style="height:800px;">
                <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <label style="background-color:#47519a; color:white; padding:8px 8px 8px 8px; text-align:center; " class="form-control" >
                <b>ALREADY PAID</b><br>
                </div> 
                </div>
                </div>
                <?php 
                }
                else
                {
                ?>
                
                <div class="container-xxl py-5" style="height:800px;">
                <div class="container">
                    
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s" id="wrp">PLEASE SELECT YOUR COURSE
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.2s"> 
                <form action="<?php echo site_url('entrance/home/admission_form_termsandcondition'); ?>" method="POST">
                <div class="col-md-12" >
                <div class="kode_mosque_text" > </div></div>
                <br>
                <br>
                <div class="col-md-12">
                
                <div class="text-center" >
                <div style="display: flex; flex-wrap: wrap;">
                <?php foreach($course as $cou): ?>
                <div style="border: 1px solid #000; padding: 10px; margin-right: 10px; margin-bottom: 10px; width: calc(33.33% - 10px);">
                <input type="radio" class="form-control"  id="work_days_<?php echo $cou['entranceexam_course_id']; ?>" name="work_days" required="required" value="<?php echo $cou['entranceexam_course_id']; ?>" />
                
                
                <label  class="fontstyle" for="work_days_<?php echo $cou['entranceexam_course_id']; ?>"><?php echo $cou['entranceexam_course_name'].'&nbsp'.$cou['entranceexam_course_custom']; ?></label>
                </div>
                <?php endforeach; ?>
                </div>
                
                <br>
                <br>
                <br>
                <br>
                <button type="submit" class="btn btn-success" style="text-align:right;">Continue</button>
                </div> 
                               
                
                
                </div>
                </form>
                </div>
                </div>
                </div>
                </div>
                <?php } ?>
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
                
