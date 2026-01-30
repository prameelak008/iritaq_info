          <!DOCTYPE html>
          <html lang="en">
          <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta name="theme-color" content="#424242" />
          <title>Login : <?php echo $name; ?></title>
          <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/<?php $this->setting_model->getAdminsmalllogo();?>" rel="shortcut icon" type="image/x-icon">
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
          <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/form-elements.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/jquery.mCustomScrollbar.min.css">
          <style type="text/css">
          body{background:linear-gradient(to right,#676767 0,#dadada 100%);}
          /*.loginbg {background: #455a64;}*/
          .top-content{position: relative;}
          .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
          background: rgb(53, 170, 71);}
          .bgoffsetbgno{background: transparent; border-right:0 !important; box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.29); border-radius: 4px;}

          .loginradius{border-radius: 4px;}

          </style>


          <style>
          * {box-sizing: border-box}

          .bold
          {
          font-weight: 500;
          }

          .pclass
          {
          line-height: 30px;   
          }
          </style>




          </head>

          <body>
          <!-- Top content -->
          <div class="top-content">

          <div class="inner-bg">

          <div class="container">
          <div class="row">
          <?php
          $empty_notice = 0;
          $offset       = "";
          $bgoffsetbg   = "bgoffsetbg";
          $bgoffsetbgno = "";
          if (empty($notice)) {
          $empty_notice = 1;
          $offset       = "col-md-offset-4";
          $bgoffsetbg   = "";
          $bgoffsetbgno = "bgoffsetbgno";
          }
          ?>
          <div class="<?php echo $bgoffsetbg; ?>">

          <div class="col-lg-4 col-md-4 col-sm-12 nopadding <?php echo $bgoffsetbgno; ?> <?php echo $offset; ?>">
          <div class="loginbg loginradius login390">
          <div class="form-top">
          <div class="form-top-left logowidth">
          <img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php $this->setting_model->getAdminlogo();?>" />
          </div>
          </div>


          <div class="form-bottom">
          <h3 class="font-white"><?php echo $this->lang->line('user_login'); ?></h3>


          <?php
          if (isset($error_message)) 
          {
          echo "<div class='alert alert-danger'>" . $error_message . "</div>";
          }
          ?>
          <?php
          if ($this->session->flashdata('message')) {
          echo "<div class='alert alert-success'>" . $this->session->flashdata('message') . "</div>";
          }
          ;
          ?>


         <form action="<?php echo site_url('semesterauth/login'); ?>" method="post">
          <?php echo $this->customlib->getCSRF(); ?>
          <div class="form-group ">
          <label class="sr-only" for="form-username">
          <?php echo $this->lang->line('username'); ?></label>
          <input type="text" name="username" value="<?php echo set_value("username"); ?>" placeholder="<?php echo $this->lang->line('username'); ?>" class="form-username form-control" id="email">
          <span class="fa fa-envelope form-control-feedback"></span>
          <span class="text-danger"><?php echo form_error('username'); ?></span>
          </div>

          
          <div class="form-group ">
          <input type="password" name="password" value="<?php echo set_value("password"); ?>" placeholder="<?php echo $this->lang->line('password'); ?>" class="form-password form-control" id="password">
          <span class="fa fa-lock form-control-feedback"></span>
          <span class="text-danger"><?php echo form_error('password'); ?></span>
          </div>


          <!-- <?php if ($is_captcha) {?>
          <div class="form-group row">
          <div class='col-lg-7 col-md-12 col-sm-6'>
              <span id="captcha_image"><?php echo $captcha_image; ?></span>
              <span class="fa fa-refresh catpcha" title='Refresh Catpcha' onclick="refreshCaptcha()"></span>
          </div>
          <div class='col-lg-5 col-md-12 col-sm-6'>
              <input type="text" name="captcha" placeholder="<?php echo $this->lang->line('captcha'); ?>" autocomplete="off" class=" form-control" id="captcha">
              <span class="text-danger"><?php echo form_error('captcha'); ?></span>
          </div>
          </div>
          <?php }?> -->
          <button type="submit" class="btn">
          <?php echo $this->lang->line('sign_in'); ?></button>
          </form>



          <p><a href="<?php echo site_url('site/ufpassword') ?>" class="forgot"> <i class="fa fa-key"></i> <?php echo $this->lang->line('forgot_password'); ?></a> </p>



          <br>
          <br>

          <p style="text-align:center;font-size:14px;" ><?php echo strtoupper($this->lang->line('termsandcondition')); ?></p>


          <table class="table" style="border:0px; ">
          <thead>
          <tr>
          <td ><span style="font-size:11px;text-align:center" data-toggle="modal" data-target=".bd-example-modal-lg"><?php echo strtoupper("DISCLAIMER POLICIES");?></span></td>
          <td ><span style="font-size:11px;" data-toggle="modal" data-target=".bd-example-modal-lg_privacy"><?php echo strtoupper("PRIVACY POLICY"); ?></span></td>
          <td ><span style="font-size:11px;" data-toggle="modal" data-target=".bd-example-modal-lg_refund"><?php echo strtoupper("REFUND POLICY");?></span></td>
          </tr>
          </thead>

          </table>


          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title">Terms And Condition</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">


          <div class="kode_contact_service">
          <p class="pclass">
          <h4 style="text-align:center;"><span class="bold"><?php echo strtoupper("DISCLAIMER POLICIES");?></span></h4>
          <span class="bold">Disclaimer policy</span><br>
          </p>



          <p class="pclass">

          IRITAQ hereby grants you access to https://www.iritaq.info/. ("The Website") . Definitions and key terms To help explain things as clearly as possible in this Disclaimer, every time any of these terms are referenced, are strictly defined as: • Cookie: small amount of data generated by a website and saved by your web browser. It is used to identify your browser, provide analytics, and remember information about you such as your language preference or login information. • Company: when this policy mentions "Company," "we," "us," or "our," it refers to IRITAQ that is responsible for your information under this Disclaimer. • Service: refers to the service provided by IRITAQ as described in the relative terms (if available) and on this platform. • Website: IRITAQ's site, which can be accessed via this URL: https://www.iritaq.info/ • You: a person or entity that is registered with IRITAQ to use the Services.</p>


          <p class="pclass">


          <span class="bold">Errors and Omissions Disclaimer </span><br>
          </p>

          <p class="pclass">
          We are not responsible for any content, code or any other imprecision. We reserve the right to make additions, deletions, or modifications to the contents on the Service at any time without prior notice.</p>

          <p class="pclass"> 
          <span class="bold">General Disclaimer</span><br><br>


          The IRITAQ Service and its contents are provided "as is" and "as available" without any warranty or representations of any kind, whether express or implied. as such, IRITAQ exercises editorial control over content and makes no warranty or representation as to the accuracy, reliability or currency of any information, content, service or merchandise provided through or accessible via the IRITAQ Service. Without limiting the foregoing, IRITAQ specifically disclaims all warranties and representations in any content transmitted on or in connection with the IRITAQ Service or on sites that may appear as links on the IRITAQ institution or in the activities provided as a part of, or otherwise in connection with, the IRITAQ Service, including without limitation any warranties of merchantability, fitness for a particular purpose or non-infringement of third party rights. No oral advice or written information given by IRITAQ or any of its affiliates, employees, officers, directors, agents, or the like will create a warranty. Price and availability information is subject to change without notice. Without limiting the foregoing, IRITAQ does not warrant that the IRITAQ Service will be uninterrupted, uncorrupted, timely, or error-free. Educational Disclosure Any Information provided by IRITAQ is for educational purposes only, and is not to be interpreted as a recommendation for a specific treatment plan, product, or course of action. We are a distributor and not a publisher of the content supplied by third parties, as such, We exercise no editorial control over such content and makes no warranty or representation as to the accuracy, reliability or currency of any information or educational content provided through or accessible via IRITAQ. Without limiting the foregoing, We specifically disclaim all warranties and representations in any content transmitted on or in connection with us or on sites that may appear as links on our platform, or in the products provided as a part of, or otherwise in connection with us. No oral advice or written information given by us or any of its affiliates, employees, officers, directors, agents, or the like will create a warranty. Your Consent We've updated our Disclaimer to provide you with complete transparency into what is being set when you visit our site and how it's being used. By using our service, registering an account, or making a purchase, you hereby consent to our Disclaimer and agree to its terms.
          </p>
          <p class="pclass">
          <span class="bold">Changes To Our Disclaimer </span><br>
          </p>
          <p class="pclass">
          Should we update, amend or make any changes to this document so that they accurately reflect our Service and policies. Unless otherwise required by law, those changes will be prominently posted here. Then, if you continue to use the Service, you will be bound by the updated Disclaimer. If you do not want to agree to this or any updated Disclaimer, you can delete your account. Contact Us Don't hesitate to contact us if you have any questions.<br>
          • Via Email: https://www.iritaq.info/# <br>
          • Via Phone Number: 9847232786 <br>
          • Via this Link: https://www.iritaq.info/<br>
          </p>

          </div>

          </div>
          <div class="modal-footer">

          </div>
          </div>
          </div>
          </div>







          <div class="modal fade bd-example-modal-lg_refund" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg_refund">
          <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title">Terms And Condition</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">


          <div class="kode_contact_service">
          <div  style="text-align:left;">

          <p class="pclass">
          <h4 style="text-align:center;"><span class="bold"><?php echo strtoupper("REFUND POLICY"); ?></span></h4>
          </p>

          <p class="pclass"><h4 style="text-align:left;"><span class="bold">Refund policy</span></h4></p>
          <p class="pclass">
          The institution has a few options for ending a programme and getting your money back, as detailed in the Refund PC.
          The reimbursement sum will be electronically paid to the credit/debit/net be account used make the payment.</p><p class="pclass">

          <span class="bold">Registration Fee, Admission Cancellation, and Fee Refund</span><br><br>
          1.  If no other details are stated, a non-refundable registration fee of Rs. 100 will also be imposed.<br>
          2.  At the time of admission, there is a first semester/year programme cost.<br>
          3.  If a student requests cancellation of admission and a return of fees, the request shall be assessed in accordance with the following institution policy:<br>
          4.  Before the deadline for submitting an application, the fee will be reimbursed less a fee of Rs. 100. Within 15 days of the deadline for submitting an application,<br>
          5.  The payment will be refunded within 15 days of the deadline for submitting the admission form, less a deduction of Rs. 150.<br>
          6.  No refunds will be granted after 30 days have passed since the last date was closed.
          </p>
          </div>

          </div>

          </div>
          <div class="modal-footer">

          </div>
          </div>
          </div>
          </div>




          <div class="modal fade bd-example-modal-lg_privacy" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title">Terms And Condition</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">

          <p>
          <h4 style="text-align:center;"><span class="bold">PRIVACY POLICY</h4>
          </span>
          </h4>
          </p>

          <p class="pclass"><span class="bold">SUMMARY OF KEY POINTS</span>
          </p>
          <p class="pclass">

          This summary provides key points from our privacy notice, but you can find out more details about any of these topics by clicking the link following each key point or by using our table of contents below to find the section you are looking for. You can also click here to go directly to our table of contents.</p><p>
          What personal information do we process? When you visit, use, or navigate our Services, we may process personal information depending on how you interact with https://www.iritaq.info/ and the Services, the choices you make, and the products and features you use. Click here to learn more.</p><p>
          Do we process any sensitive personal information? We do not process sensitive personal information.</p><p>
          Do we receive any information from third parties? We do not receive any information from third parties.</p><p>
          How do we process your information? We process your information to provide,</p><p>
          improve, and administer our Services, communicate with you, for security and fraud prevention, and to comply with law. We may also process your information for other purposes with your consent. We process your information only when we have a valid legal reason to do so. Click here to learn more.</p><p>
          In what situations and with which parties do we share personal information?</p><p>
          We may share information in specific situations and with specific third parties. Click here to learn more.</p><p>
          What are your rights? Depending on where you are located geographically, the applicable privacy law may mean you have certain rights regarding your personal information. Click here to learn more.</p><p>
          How do you exercise your rights? The easiest way to exercise your rights is by Filling out our data subject request form available here or by contacting us. We will consider and act upon any request in accordance with appliCcaobmlepdllaitaance Checklist</p><p class="pclass">

          <span class="bold">TABLE OF CONTENTS</span></p><p class="pclass">
          1.  WHAT INFORMATION DO WE COLLECT?<br>
          2.  HOW DO WE PROCESS YOUR INFORMATION?<br>
          3.  WHEN AND WITH WHOM DO WE SHARE YOUR PERSONAL INFORMATION?<br>
          4.  DO WE USE COOKIES AND OTHER TRACKING TECHNOLOGIES?<br>
          5.  HOW LONG DO WE KEEP YOUR INFORMATION?<br>
          6.  HOW CAN YOU REVIEW, UPDATE, OR DELETE THE DATA WE COLLECT FROM YOU?<br>

          </p>
          <p class="pclass">

          1.  WHAT INFORMATION DO WE COLLECT?<br></p>
          <p class="pclass">
          Personal information you disclose to us
          In Short: We collect personal information that you provide to us.
          We collect personal information that you voluntarily provide to us when you express an interest in obtaining information about us or our products and Services, when you participate in activities on the Services, or otherwise when you contact us.Personal Information Provided by You. The personal information that we collect depends on the context of your interactions with us and the Services, the choices you make, and the products and features you use. The personal information we collect
          may include the following:</p>
          <p class="pclass">
          <br>
          names:<br><br>
          phone numbers:<br><br>
          billing addresses:<br><br>
          contact or authentication data:<br><br>
          contact preferences:<br><br>
          passwords:<br><br>
          job titles:<br><br>
          mailing addresses:<br><br>
          email addresses:<br><br>
          usernames:<br><br>
          Sensitive Information. We do not process sensitive information.<br><br>
          </p>
          <p class="pclass">

          Payment Data. We may collect data necessary to process your payment if you make payment, such as your payment instrument number (such as a credit card number), and the security code associated with your payment instrument. All payment data is stored by 
          </p><p class="pclass">

          . You may find their privacy notice link(s) here:
          </p><p class="pclass">
          All personal information that you provide to us must be true, complete, and accurate, and you must notify us of any changes to such personal information.
          </p><p class="pclass">
          2.  HOW DO WE PROCESS YOUR INFORMATION?<br></p><p class="pclass">

          In Short: We process your information to provide, improve, and administer our Services, communicate with you, for security and fraud prevention, and to comply</p><p class="pclass">
          with law. We may also process your information for other purposes with your consent.</p><p>

          We process your personal information for a variety of reasons, deCCpeonmdipnllgiaonnce Checklist</p><p>
          how you interact with our Services, including:</p><p class="pclass">
          To send administrative  information to you. We may process your information to send you details about our products and services, changes to our terms and policies, and other similar information.</p><p>
          To enable user-to-user communications. We may process your information if you choose to use any of our offerings that allow for communication with another user.</p><p class="pclass">
          To request feedback. We may process your information when necessary to request feedback and to contact you about your use of our Services.</p><p class="pclass">
          To administer prize draws and competitions. We may process your information to administer prize draws and competitions.</p>

          3.  WHEN AND WITH WHOM DO WE SHARE YOUR PERSONAL INFORMATION?<br></p><p class="pclass">

          In Short: We may not any share information in any situations with a third party or with other entity.</p><p class="pclass">

          4.  DO WE USE COOKIES AND OTHER TRACKING TECHNOLOGIES?<br></p><p class="pclass">

          In Short: We may use cookies and other tracking technologies to collect and store your information.</p><p class="pclass">
          We may use cookies and similar tracking technologies (like web beacons and pixels) to access or store information. Specific information about how we use such technologies and how you can refuse certain cookies is set out in our Cookie Notice.</p><p>
          5.  HOW LONG DO WE KEEP YOUR INFORMATION?<br></p><p class="pclass">

          In Short: We keep your information for as long as necessary to fulfil the purposes outlined in this privacy notice unless otherwise required by law. We will only keep your personal information for as long as it is necessary for the purposes set out in this privacy notice, unless a longer retention period is required or permitted by law (such as tax, accounting, or other legal requirements).</p><p class="pclass">

          6.  DO WE COLLECT INFORMATION FROM MINORS?<br></p><p class="pclass">

          In Short: We do not knowingly collect data from or market to children under 18 years of age.
          We do not knowingly solicit data from or market to children under 18 years of age. By using the Services, you represent that you are at least 18 or that you are the parent or guardian of such a minor and consent to such minor dependent’s use of the Services. If we learn that personal information from users less than 18 years of age has been collected, we will deactivate the account and take reasonable measures to promptly delete such data from our records. If you become aware of any data we may have collected from children under age 18, please contact us.
          </p> 

          </div>
          </div>
          </div>
          </div>


          <script>
          function openPage(pageName,elmnt,color) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablink");
          for (i = 0; i < tablinks.length; i++) {
          tablinks[i].style.backgroundColor = "";
          }
          document.getElementById(pageName).style.display = "block";
          elmnt.style.backgroundColor = color;
          }

          // Get the element with id="defaultOpen" and click on it
          document.getElementById("defaultOpen").click();
          </script>


          </div>
          </div>
          </div>
          <?php
          if (!$empty_notice) {
          ?>

          <div class="col-lg-8 col-md-8 col-sm-12">
          <h3 class="h3"><?php echo $this->lang->line('what_is_new_in'); ?> <?php echo $school['name']; ?></h3>
          <div class="loginright mCustomScrollbar">
          <div class="messages">

          <?php
          foreach ($notice as $notice_key => $notice_value) {
          ?>
          <h4><?php echo $notice_value['title']; ?></h4>

          <?php
          $string = ($notice_value['description']);
          $string = strip_tags($string);
          if (strlen($string) > 100) {

          // truncate string
          $stringCut = substr($string, 0, 100);
          $endPoint  = strrpos($stringCut, ' ');

          //if the string doesn't contain any space then it will cut without word basis.
          $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
          $string .= '... <a class=more href="' . site_url('read/' . $notice_value['slug']) . '" target="_blank">Read More</a>';
          }
          echo '<p>' . $string . '</p>';
          ?>
          <div class="logdivider"></div>
          <?php
          }
          ?>




          </div>
          </div>
          </div><!--./col-lg-6-->
          <?php
          }
          ?>


          </div>
          </div>
          </div>
          </div>
          </div>
          <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
          <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
          <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
          <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
          <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>
          </body>
          </html>


          <script type="text/javascript">
          $(document).ready(function () {
          $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
          $(this).removeClass('input-error');
          });
          $('.login-form').on('submit', function (e) {
          $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
          if ($(this).val() == "") {
          e.preventDefault();
          $(this).addClass('input-error');
          } else {
          $(this).removeClass('input-error');
          }
          });
          });
          });
          </script>


          <script type="text/javascript">
          function refreshCaptcha(){
          $.ajax({
          type: "POST",
          url: "<?php echo base_url('site/refreshCaptcha'); ?>",
          data: {},
          success: function(captcha){
          $("#captcha_image").html(captcha);
          }
          });
          }
          </script>