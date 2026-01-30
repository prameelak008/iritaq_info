
<?php
if(isset($this->session->userdata['logged_in']))
{
$session_studid  = $this->session->userdata['session_studid']; 
$username        = $this->session->userdata['username']; 
}                 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Entrance Exam</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    
    
    
   
    <link href="img/favicon.ico" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php  echo base_url();  ?>entrance/layout/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?php  echo base_url();  ?>entrance/layout/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php  echo base_url();  ?>entrance/layout/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php  echo base_url();  ?>entrance/layout/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php  echo base_url();  ?>entrance/layout/css/style.css" rel="stylesheet">
     </head>


<style>

    .container, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl
    {
    max-width: 100% !important;
    }
    
    body { 
    margin: 0;
    font-family: meera;
    }
    
    .header {
    overflow: hidden;
    background-color: #f1f1f1;
    padding: 8px 8px;
    padding-left:5px;
    background-color:#00C3CB !important;
    color:#ffffff !important;
    }
    
    .header a {
    float: left;
    color: #ffffff !important;
    text-align: center;
    padding: 12px;
    text-decoration: none;
    font-size: 18px; 
    line-height: 25px;
    border-radius: 4px;
    }
    
    /*.header a.logo {*/
    /*  font-size: 25px;*/
    /*  font-weight: bold;*/
    /*}*/
    
    .header-right {
    float: right;
    }
    
    @media screen and (max-width: 500px) {
    .header a {
    float: none;
    display: block;
    text-align: left;
    }
    
    .header-right {
    float: none;
    }
    }
    
    .column {
    float: left;
    width: 25%;
    padding: 10px;
    height: 300px; 
    }
    .row:after {
    content: "";
    display: table;
    clear: both;
    }
    .headstyle
    {
   margin:20px;   
    }
    
    .topnav 
    {
    background-color: #ffffff;
    overflow: hidden;
    margin:10px;
    }
    
    /* Style the links inside the navigation bar */
    .topnav a {
    float: left;
    color: #00000;
    text-align: center;
    /*padding: 14px 16px;*/
    text-decoration: none;
    font-size: 25px;
    }

    .topnav a:hover {
    background-color: #00C3CB;
    color: black;
    border-radius:30px;
    }
    
    .topnav a.split 
    {
    background-color: #00C3CB;
    color: white;
    padding:10px;
    float: right;
    }
    .topnav a.split:hover {
    background-color: #009298;
    border-radius:2px;
    }
    
    .tabstyle
    {
    color:#000000;
    text-align:center;
    }
    
    .fontstyle
    {
        color:#00C3CB !important;
    }
    
    
    
    

.footer-section {
  background: #151414;
  position: relative;
}
.footer-cta {
  border-bottom: 1px solid #373636;
}
.single-cta i {
  color: #ff5e14;
  font-size: 30px;
  float: left;
  margin-top: 8px;
}
.cta-text {
  padding-left: 15px;
  display: inline-block;
}
.cta-text h4 {
  color: #fff;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 2px;
}
.cta-text span {
  color: #757575;
  font-size: 15px;
}
.footer-content {
  position: relative;
  z-index: 2;
}
.footer-pattern img {
  position: absolute;
  top: 0;
  left: 0;
  height: 330px;
  background-size: cover;
  background-position: 100% 100%;
}
.footer-logo {
  margin-bottom: 30px;
}
.footer-logo img {
    max-width: 80%;
    margin:10px;
}
.footer-text p {
  margin-bottom: 14px;
  font-size: 14px;
      color: #7e7e7e;
  line-height: 28px;
  
}
.footer-social-icon span {
  color: #fff;
  display: block;
  font-size: 20px;
  font-weight: 700;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 20px;
}
.footer-social-icon a {
  color: #fff;
  font-size: 16px;
  margin-right: 15px;
}
.footer-social-icon i {
  height: 40px;
  width: 40px;
  text-align: center;
  line-height: 38px;
  border-radius: 50%;
}
.facebook-bg{
  background: #3B5998;
}
.twitter-bg{
  background: #55ACEE;
}
.google-bg{
  background: #DD4B39;
}
.footer-widget-heading h3 {
  color: #fff;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 40px;
  position: relative;
}
.footer-widget-heading h3::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -15px;
  height: 2px;
  width: 50px;
  background: #ff5e14;
}
.footer-widget ul li {
  display: inline-block;
  float: left;
  width: 50%;
  margin-bottom: 12px;
}
.footer-widget ul li a:hover{
  color: #ff5e14;
}
.footer-widget ul li a {
  color: #878787;
  text-transform: capitalize;
}
.subscribe-form {
  position: relative;
  overflow: hidden;
}
.subscribe-form input {
  width: 100%;
  padding: 14px 28px;
  background: #2E2E2E;
  border: 1px solid #2E2E2E;
  color: #fff;
}
.subscribe-form button {
    position: absolute;
    right: 0;
    background: #ff5e14;
    padding: 13px 20px;
    border: 1px solid #ff5e14;
    top: 0;
}
.subscribe-form button i {
  color: #fff;
  font-size: 22px;
  transform: rotate(-6deg);
}
.copyright-area{
  background: #202020;
  padding: 25px 0;
}
.copyright-text p {
  margin: 0;
  font-size: 14px;
  color: #878787;
}
.copyright-text p a{
  color: #ff5e14;
}
.footer-menu li {
  display: inline-block;
  margin-left: 20px;
}
.footer-menu li:hover a{
  color: #ff5e14;
}
.footer-menu li a {
  font-size: 14px;
  color: #878787;
}

.youtube-bg {
    background-color: #ff0000; 
   
    border-radius: 50%;
}

.youtube-bg:hover {
    background-color: #cc0000; /* Example background color on hover */
}


    </style>

                        <body>
    
                        <div class="header">
                        <a href="#default" class=""><i class="fa fa-envelope "></i>&nbsp;&nbsp;&nbsp;jamiajalaliyya@gmail.com</a>
                        <a href="#" class=""><i class="fa fa-phone-alt "></i>&nbsp;&nbsp;+91 9847232786</a>
                        <div class="header-right">
                        <a class="me-6" href="#"> <?php
                        if(isset($this->session->userdata['logged_in']))
                        {
                         ?><span class="">Welcome &nbsp;&nbsp;<?php echo $username; ?> </span>
                        <?php }
                        ?></a>
                        <a class="" href="https://www.facebook.com/jamiajalaliyya"><i class="fab fa-facebook-f"></i></a>
                        <a class="" href="https://twitter.com/SMundakullam"><i class="fab fa-twitter"></i></a>
                        <a class="" href="https://www.instagram.com/jamiajalaliyya"><i class="fab fa-instagram"></i></a>
                        <a class="" href="https://www.youtube.com/@jamiajalaliyya"><i class="fab fa-youtube"></i></a>
                        </div>
                        </div>
                        
                        
                        <div class="container" style="background-color:#ffffff">
                        <div class="row">
                        <div class="col-sm headstyle" >
                        <img src="<?php  echo base_url();?>entrance/css/images/logo.png" style="width:100%;" >
                        </div>
                        
                        <div class="col-sm headstyle">
                        <p>
                        <i class="fa fa-headphones">&nbsp;&nbsp;CALL US FOR MORE DETAILS</i>
                        </p>
                        <p>0483 2962786</p>
                        </div>
                        
                        <div class="col-sm headstyle">
                        <p>
                        <i class="fa fa-envelope">&nbsp;&nbsp; OUR EMAIL</i>
                        </p>
                        <p>jamiajalaliyya@gmail.com</p>
                        </div>
                        
                        
                        <div class="col-sm headstyle">
                        <p>
                        <i class="fa fa-map-marker">&nbsp;&nbsp; OUR LOCATION</i>
                        </p>
                        <p>Mundakkulam, Kondotty Malappuram, Kerala</p>
                        </div>
                        </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
       <div class="container-xxl bg-white p-0" >
        <div class="container-fluid  px-0">
               <div class="row gx-0">
                <div class="col-lg-3  d-none d-lg-block">
                    <a href="index.html" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                      <!--<img src="<?php  echo base_url();  ?>/entrance/layout/logojamia.jpg">-->
                    </a>
                </div>
                <div class="col-lg-12">
                    <!--  <div class="row gx-0 bg-white d-none d-lg-flex">
                      <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">jamiajalaliyya@gmail.com</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">+91 9847232786</p>
                            </div>
                        </div>
                        
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                            <?php
                            /*
                            if(isset($this->session->userdata['logged_in']))
                            {
                            ?>

                            <span class="nav-item nav-link">Welcome &nbsp;&nbsp;<?php echo $username; ?> </span>

                            <?php } 
                            */
                            ?>
                               
                                <a class="me-3" href="https://www.facebook.com/jamiajalaliyya"><i class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href="https://twitter.com/SMundakullam"><i class="fab fa-twitter"></i></a>
                                <a class="me-3" href="https://www.instagram.com/jamiajalaliyya"><i class="fab fa-instagram"></i></a>
                                <a class="me-3" href="https://www.youtube.com/@jamiajalaliyya"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
-->



<?php /*
                            <nav class="navbar navbar-expand-lg   p-3 p-lg-0" style="background-color:#ffffff" >
                            <a href="index.html" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">jamia jalaliyya</h1>
                            </a>
                            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            
                            
                            <div class="navbar-nav mr-auto py-0">
                            <a href="http://jamiajalaliyya.com/index.html" class="nav-item nav-link active">Home</a>
                            
                        
                            
                            
                            <?php
                          
                            if(isset($this->session->userdata['logged_in']))
                            {
                            
                            if(empty($fee_details))
                            {
                            ?>
                            
                           <!-- <a href="<?php  echo site_url('entrance/entranceexam/termsandcondition');    ?>" class="nav-item nav-link">Admission Form</a>-->
                            
                            <?php 
                            }  
                            else
                            { 
                            ?>
                            
                            
                            <a href="<?php echo site_url('entrance/home/checkstatus');    ?>" class="nav-item nav-link">Check Status</a>
                            
                            <a href="<?php echo site_url('entrance/home/paymentreceipt'); ?>" class="nav-item nav-link">Download Payment Receipt</a>
                            
                            <a href="<?php echo site_url('entrance/home/admitcard'); ?>"  target="_blank" class="nav-item nav-link">Download Hall Ticket</a>
                            
                            
                            <a href="<?php echo site_url('entrance/home/admission_form_pdf');    ?>"   target="_blank" class="nav-item nav-link">Print Application Form</a>
                            
                            <a href="<?php echo site_url('entrance/home/result'); ?>"  target="_blank" class="nav-item nav-link">Exam Result</a>
                            
                            <a href="<?php echo site_url('entrance/home/allotmentstatus'); ?>"  target="_blank" class="nav-item nav-link">Allotment Status</a>
                            
                            
                            
                            
                            <?php } ?>
                            
                            
                            <a href="<?php  echo site_url('entrance/entranceexam/logout');    ?>" class="nav-item nav-link">Logout</a>
                            <?php
                            }
                            
                            else
                            {
                            ?>
                            
                            <a href="<?php  echo site_url('entrance/entranceexam/register');    ?>" class="nav-item nav-link">Register</a>
                            
                            <a href="<?php  echo site_url('entrance/entranceexam/login');    ?>" class="nav-item nav-link">Login</a>
                            <?php } ?>

                            </div>
                            

                        </div>
                    </nav>
                    
                    <?php */ ?>
                    
                            <div class="topnav">
                            <a href="http://jamiajalaliyya.com/index.html" class="nav-item nav-link active tabstyle">Home</a>
                            
                            <?php
                          
                            if(isset($this->session->userdata['logged_in']))
                            {
                            
                            if(empty($fee_details))
                            {
                            ?>
                            
                           <!-- <a href="<?php  echo site_url('entrance/entranceexam/termsandcondition');    ?>" class="nav-item nav-link">Admission Form</a>-->
                            
                            <?php 
                            }  
                            else
                            { 
                            ?>
                            <a href="<?php echo site_url('entrance/home/checkstatus');    ?>" class="nav-item nav-link tabstyle">Check Status</a>
                            
                            <a href="<?php echo site_url('entrance/home/paymentreceipt'); ?>" class="nav-item nav-link tabstyle">Download Payment Receipt</a>
                            
                            <a href="<?php echo site_url('entrance/home/admitcard'); ?>"  target="_blank" class="nav-item nav-link tabstyle">Download Hall Ticket</a>
                            
                            
                            <a href="<?php echo site_url('entrance/home/admission_form_pdf');    ?>"   target="_blank" class="nav-item nav-link tabstyle">Print Application Form</a>
                            
                            <a href="<?php echo site_url('entrance/home/result'); ?>"  target="_blank" class="nav-item nav-link tabstyle">Exam Result</a>
                            
                            <a href="<?php echo site_url('entrance/home/allotmentstatus'); ?>"  target="_blank" class="nav-item nav-link tabstyle">Allotment Status</a>
                            <?php } ?>
                            <a href="<?php  echo site_url('entrance/entranceexam/logout');    ?>" class="nav-item nav-link tabstyle">Logout</a>
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            <a href="<?php  echo site_url('entrance/entranceexam/login');    ?>" class="nav-item nav-link tabstyle">Login</a>
                            <a href="<?php  echo site_url('entrance/entranceexam/register');    ?>" class="split">Apply Now</a>
                            
                            
                            <?php } ?>
                            
                            
                            
                            </div>
                    
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>   
     
<script type="text/javascript">

// $(document).on('click', 'printbtn', function (e) {
//     var admission_id =  <?php echo $adlist['admission_id']?>;
//         Popup(admission_id);
//     });

$(document).on('click', '#printbtn', function (e) 
{
    
  
        //var admission_application_registerid = $(this).data('admission_application_registerid');
       // var applied_course = $(this).data('applied_course');
        
       var admission_application_registerid = $('#iid').val();
       var applied_course = $('#course').val();
      
       
        //var admission_id =  <?php echo $adlist['admission_id']?>;
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: 'POST',
            url: base_url + "student/printadmitcard",
            
            //url: "<?php echo site_url('EntranceExam/printadmitcard');?>",
            data: {'admission_application_registerid': admission_application_registerid,'applied_course': applied_course}, 
            
             //data: {admission_application_registerid: admission_application_registerid,applied_course:applied_course}, 
            
          
            success: function (response)
            {
            Popup(response);
            },
        });
    });
    
    
    var base_url = '<?php echo base_url() ?>';
    function Popup(data)
    {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";

        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
//Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
// frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/idcard.css">');

        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);

        return true;
    }



</script>  

       
