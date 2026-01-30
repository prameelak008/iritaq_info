
<?php
if(isset($this->session->userdata['logged_in']))
{
$session_studid  = $this->session->userdata['session_studid']; 
$username        = $this->session->userdata['username']; 
}                 
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="description" content="Jamia Jalaliyya - Shamsul Ulama Memorial Islamic Complex" />
<meta name="keywords" content="education,Islam,university,educational,learn,learning,teaching,Quran" />
<meta name="author" content="ThemeMascot" />


<title>JAMIA JALALIYYA </title>


<link href="<?php  echo base_url();  ?>entrance/entrancecss/images/favicon-16x16.png" rel="shortcut icon" type="image/png">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/images/apple-touch-icon.png" rel="apple-touch-icon">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/animate.css" rel="stylesheet" type="text/css">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/css-plugin-collections.css" rel="stylesheet"/>
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/menuzord-megamenu.css" rel="stylesheet"/>
<link id="menuzord-menu-skins" href="<?php  echo base_url();  ?>entrance/entrancecss/css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/style-main.css" rel="stylesheet" type="text/css">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/preloader.css" rel="stylesheet" type="text/css">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php  echo base_url();  ?>entrance/entrancecss/css/style.css" rel="stylesheet" type="text/css">
<link  href="<?php  echo base_url();  ?>entrance/entrancecss/js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
<link  href="<?php  echo base_url();  ?>entrance/entrancecss/js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
<link  href="<?php  echo base_url();  ?>entrance/entrancecss/js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>
<link href="<?php   echo base_url();  ?>entrance/entrancecss/css/colors/theme-skin-color-set6.css" rel="stylesheet" type="text/css">
<script src="<?php  echo base_url();  ?>entrance/entrancecss/js/jquery-2.2.4.min.js"></script>
<script src="<?php  echo base_url();  ?>entrance/entrancecss/js/jquery-ui.min.js"></script>
<script src="<?php  echo base_url();  ?>entrance/entrancecss/js/bootstrap.min.js"></script>
<script src="<?php  echo base_url();  ?>entrance/entrancecss/js/jquery-plugin-collection.js"></script>
<script src="<?php  echo base_url();  ?>entrance/entrancecss/js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php  echo base_url();  ?>entrance/entrancecss/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

    <style type="text/css">
    
    body
    {
    font-family:'meera !important';
    font-size:20px;
  
    }
    
    .fontstyle {
    font-size: calc(0.8vw + 10px) ;
    font-family: 'meera';
    /*font-family: 'Baloo Chettan';*/
    }
    
    
    .form-control
    {
     font-size: calc(0.8vw + 10px) ;
    font-family: 'meera'; 
    border:1px solid #eeeeee;
    }
    
</style>
<body class="">
<div id="wrapper" class="clearfix">
  <!-- preloader -->
 
  
  <!-- Header -->
  <header id="header" class="header">
    <div class="header-top bg-theme-colored2 sm-text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="widget text-white">
              <ul class="list-inline xs-text-center text-white">
                <li class="m-0 pl-10 pr-10"> <a href="#" class="text-white"><i class="fa fa-phone text-white"></i> +91 9847232786</a> </li>
                <li class="m-0 pl-10 pr-10"> 
                  <a href="#" class="text-white"><i class="fa fa-envelope-o text-white mr-5"></i> jamiajalaliyya@gmail.com</a> 
                </li>
                <li class="m-0 pl-10 pr-10"> 
                <a href="#" class="text-white"><i class="fa fa-language" aria-hidden="true text-white mr-5"></i> العربية</a> 
              </li>
              </ul>
            </div>
          </div>
          
          <div class="col-md-4 pr-0">
            <div class="widget">
              <ul class="styled-icons icon-sm pull-right flip sm-pull-none sm-text-center mt-5">
                <li><a href="https://www.facebook.com/jamiajalaliyya"><i class="fa fa-facebook text-white"></i></a></li>
                <li><a href="https://twitter.com/SMundakkulam"><i class="fa fa-twitter text-white"></i></a></li>
                <li><a href="https://www.youtube.com/@jamiajalaliyya"><i class="fa fa-youtube-play text-white"></i></a></li>
                <li><a href="https://www.instagram.com/jamiajalaliyya/"><i class="fa fa-instagram text-white"></i></a></li>
                <li><a href="https://t.me/jamiajalaliyyamundakkulam"><i class="fa fa-telegram text-white"></i></a></li>
              </ul>
            </div>
          </div>
            <div class="col-md-2">
            <?php
            if(isset($this->session->userdata['logged_in']))
            {
            ?>
            <ul class="list-inline sm-pull-none sm-text-center text-right text-white mb-sm-20 mt-10">
            <li class="m-0 pl-10"> <!--<i class="fa fa-user-o mr-5 text-white"></i>-->
            Welcome:<?php echo $username; ?></li>
            </ul>
            <?php
            }
            ?>
            </div>
        </div>
      </div>
    </div>
    <div class="header-middle p-0 bg-lightest xs-text-center">
      <div class="container pt-20 pb-20">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-4">
            <a class="menuzord-brand pull-left flip sm-pull-center mb-15" href="index.html"><img src="<?php  echo base_url();  ?>entrance/css/images/logo.png" alt=""></a>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-8">
            <div class="row">
              <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="widget no-border sm-text-center mt-10 mb-10 m-0">
                  <i class="pe-7s-headphones text-theme-colored2 font-30 mt-0 mr-15 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                  <a href="#" class="font-12 text-gray text-uppercase">Call us for more details</a>
                  <h5 class="font-13 text-black m-0"> 0483 2962786</h5>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="widget no-border sm-text-center mt-10 mb-10 m-0">
                  <i class="pe-7s-mail-open text-theme-colored2 font-30 mt-0 mr-15 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                  <a href="#" class="font-12 text-gray text-uppercase">Our Email</a>
                  <h5 class="font-13 text-black m-0" style="word-wrap: break-word;"> jamiajalaliyya@gmail.com</h5>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="widget no-border sm-text-center mt-10 mb-10 m-0">
                  <i class="pe-7s-map-marker text-theme-colored2 font-30 mt-0 mr-15 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                  <a href="#" class="font-12 text-gray text-uppercase">Our Location</a>
                  <h5 class="font-13 text-black m-0"> Mundakkulam, Kondotty Malappuram, Kerala</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
        <div class="container">
          <nav id="menuzord" class="menuzord default menuzord-responsive">
            <ul class="menuzord-menu">
                
              <li class="active"><a href="<?php  echo base_url();  ?>entrance/Entranceexam/">Home</a></li>
              <li class=""><a href="<?php echo base_url(); ?>entrance/payment_code/Prospectus_2024_25.pdf" target="_blank" rel="noopener noreferrer">Prospects</a></li>
              
             
          
            
            
            
                            <?php
                            if(isset($this->session->userdata['logged_in']))
                            {
                            if(empty($fee_details))
                            {
                            ?>
                            <!--<li><a href="<?php  echo site_url('entrance/entranceexam/termsandcondition');    ?>">Admission Form</a></li>-->
                            <?php 
                            }  
                            else
                            { 
                            ?>
                            
                            <?php } ?>
                            
                            <li><a href="<?php  echo site_url('entrance/Entranceexam/ui_tables'); ?>" >Application</a></li>
                            <li><a href="<?php  echo site_url('entrance/entranceexam/logout'); ?>" >Logout</a></li>
                           
                            <?php
                            }
                            else
                            {
                            ?>
                            
                            
                           
                            
                            <div class="pull-right sm-pull-none mb-sm-15" style="margin-left:5px;">
                            <a class="btn btn-colored btn-theme-colored2 mt-15 mt-sm-10 pt-10 pb-10" href="<?php  echo site_url('entrance/entranceexam/login');    ?>">Login</a>
                            
                            <a class="btn btn-colored btn-theme-colored2 mt-15 mt-sm-10 pt-10 pb-10" href="<?php  echo site_url('entrance/entranceexam/register');    ?>">Apply Now</a>
                            </div>
                            
                           
                            <?php } ?>
            
            
            
          </nav>
        </div>
      </div>
    </div>
  </header>
  

  
  
 