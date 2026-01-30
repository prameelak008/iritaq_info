
<!-- FeeReceipt-formatthree -->


<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat();?>
<style type="text/css">


        .mydiv
	   {
		background-color:#000;
		text-align:center;	 
	   }

        .footer-section{
          
           padding: 10px 40px;
        }
		
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 20px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }

        .Nametitle{
            font-size: 15px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
		
        table{
            background-color: #000;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: left;
            padding-left: 10px !important;
        }

        table th, table td {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
        width: 20%;
        }

        .w-40{
        width: 40%;
        }
        .float-right{
         float: right;
        }

.text-black
{
color:#000;
font-size:18px;
/*text-align:center;*/
}

.text-heading
{
color:#000;
font-size:80px;
/*text-align:center;*/	
}

}
   
    /*@media print 
    {
        @page
        {
        height: 10.5cm;
        width: 14.8cm;  
        }
       
    }*/

    .page-break { display: block; page-break-before: always; }
    @media print {
        .page-break { display: block; page-break-before: always; }
        .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12 {
            float: left;
        }
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-11 {
            width: 91.66666667%;
        }
        .col-sm-10 {
            width: 83.33333333%;
        }
        .col-sm-9 {
            width: 75%;
        }
        .col-sm-8 {
            width: 66.66666667%;
        }
        .col-sm-7 {
            width: 58.33333333%;
        }
        .col-sm-6 {
            width: 50%;
        }
        .col-sm-5 {
            width: 41.66666667%;
        }
        .col-sm-4 {
            width: 33.33333333%;
        }
        .col-sm-3 {
            width: 25%;
        }
        .col-sm-2 {
            width: 16.66666667%;
        }
        .col-sm-1 {
            width: 8.33333333%;
        }
        .col-sm-pull-12 {
            right: 100%;
        }
        .col-sm-pull-11 {
            right: 91.66666667%;
        }
        .col-sm-pull-10 {
            right: 83.33333333%;
        }
        .col-sm-pull-9 {
            right: 75%;
        }
        .col-sm-pull-8 {
            right: 66.66666667%;
        }
        .col-sm-pull-7 {
            right: 58.33333333%;
        }
        .col-sm-pull-6 {
            right: 50%;
        }
        .col-sm-pull-5 {
            right: 41.66666667%;
        }
        .col-sm-pull-4 {
            right: 33.33333333%;
        }
        .col-sm-pull-3 {
            right: 25%;
        }
        .col-sm-pull-2 {
            right: 16.66666667%;
        }
        .col-sm-pull-1 {
            right: 8.33333333%;
        }
        .col-sm-pull-0 {
            right: auto;
        }
        .col-sm-push-12 {
            left: 100%;
        }
        .col-sm-push-11 {
            left: 91.66666667%;
        }
        .col-sm-push-10 {
            left: 83.33333333%;
        }
        .col-sm-push-9 {
            left: 75%;
        }
        .col-sm-push-8 {
            left: 66.66666667%;
        }
        .col-sm-push-7 {
            left: 58.33333333%;
        }
        .col-sm-push-6 {
            left: 50%;
        }
        .col-sm-push-5 {
            left: 41.66666667%;
        }
        .col-sm-push-4 {
            left: 33.33333333%;
        }
        .col-sm-push-3 {
            left: 25%;
        }
        .col-sm-push-2 {
            left: 16.66666667%;
        }
        .col-sm-push-1 {
            left: 8.33333333%;
        }
        .col-sm-push-0 {
            left: auto;
        }
        .col-sm-offset-12 {
            margin-left: 100%;
        }
        .col-sm-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-sm-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-sm-offset-9 {
            margin-left: 75%;
        }
        .col-sm-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-sm-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-sm-offset-6 {
            margin-left: 50%;
        }
        .col-sm-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-sm-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-sm-offset-3 {
            margin-left: 25%;
        }
        .col-sm-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-sm-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-sm-offset-0 {
            margin-left: 0%;
        }
        .visible-xs {
            display: none !important;
        }
        .hidden-xs {
            display: block !important;
        }
        table.hidden-xs {
            display: table;
        }
        tr.hidden-xs {
            display: table-row !important;
        }
        th.hidden-xs,
        td.hidden-xs {
            display: table-cell !important;
        }
        .hidden-xs.hidden-print {
            display: none !important;
        }
        .hidden-sm {
            display: none !important;
        }
        .visible-sm {
            display: block !important;
        }
        table.visible-sm {
            display: table;
        }
        tr.visible-sm {
            display: table-row !important;
        }
        th.visible-sm,
        td.visible-sm {
            display: table-cell !important;
        }
        .trbg{
            text-align: center !important;
            background-color: #008080 !important;
            border-color:white !important;
        }
        .tbg{
            text-align: center !important;
            background-color: #D1D0CE !important;
            border-color:white !important;
        }
        .trbody{
            border-color:white !important;
        }

    }
    
</style>
<html lang="en">
    <head>
        <title><?php echo $this->lang->line('fees_receipt'); ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/AdminLTE.min.css">
    </head>
    <body>
        <section class="content">
        <div class="row">
           <div class="col-sm-12">

                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div class="col-sm-12">
                            <img src="<?php echo base_url() ?>/uploads/log/logo3.jpg" style="height: 120px;width:100%" /><hr style="color: black;">
                        </div>

                        <?php
                                            $count=0;
                                            foreach ($admissionlist as $adlist) {
                                                if (empty($adlist["admission_photo"])) {
                                                $image = "uploads/student_images/default_male.jpg";
                                            } else {
                                                $image = "uploads/".$adlist['admission_photo'];
                                            }
                                             ?>
                                             <div class="col-sm-12">
                        <h5 class="text-center" style="text-transform: uppercase;"><b>ADMIT CARD</b></h5>
                        <h3 class="profile-username text-center" style="text-transform: uppercase;"><b>ENTRANCE EXAMINATION 2023-24</b></h3>
                    </div>
                        <div class="col-sm-12" align="center">
                        <div class="col-sm-9">
                            <table style="border:1px solid;" border="1">
                                <tr>
                                    <td width="25%" style="text-align: left;padding:1px;">APPLICATION NO</td>
                                    <td style="text-align: left;"><b><?php echo $adlist['admission_application_no']; ?></b></td>
                                </tr>
                                <tr>
                                    <td width="25%" style="text-align: left;padding:1px;">APPLIED DATE & TIME</td>
                                    <td style="text-align: left;"><?php echo $adlist['admission_datetime']; ?></td>
                                </tr>
                                <tr>
                                    <td width="25%" style="text-align: left;padding:1px;">CANDIDATE NAME</td>
                                    <td style="text-align: left;"><?php echo $adlist['admission_name']; ?></td>
                                </tr>
                                <tr>
                                    <td width="25%" style="text-align: left;padding:1px;">DATE OF BIRTH</td>
                                    <td style="text-align: left;"><?php echo $adlist['admission_dob']; ?></td>
                                </tr>
                                 <tr>
                                    <td width="25%" style="text-align: left;padding:1px;">NAME OF FATHER</td>
                                    <td style="text-align: left;"><?php echo $adlist['admission_fathername']; ?></td>
                                </tr>
                                <tr>
                                    <td width="25%" style="text-align: left;padding:1px;">ADDRESS</td>
                                    <td style="text-align: left;"><?php echo $adlist['admission_address']; ?></td>
                                </tr>
                                 <tr>
                                    <td width="25%" style="text-align: left;padding:1px;">APPLIED COURSE</td>
                                    <td style="text-align: left;"><b><?php echo $adlist['entranceexam_course_name']; ?></b></td>
                                </tr>
                                <tr>
                                    <td width="25%" style="text-align: left;padding:1px;">EXAM CENTER</td>
                                    <td style="text-align: left;"><b><?php echo $adlist['admission_institute_examcenter']; ?></b></td>
                                </tr>
                                <input type="hidden" id="applied_course" value="<?php echo $adlist['entranceexam_course_name']; ?>">
                            </table>
                        </div>
                        <div class="col-sm-3">
                            <img src="<?php echo base_url() . $image; ?>" alt="User profile picture" style="width: 150px;height:162px;"> <br> <br>
                            <img src="<?php echo base_url() . $image; ?>" alt="User profile picture" style="width: 150px;height:150px;">
                        </div>
                    </div>
                     <?php
                                                }
                                            $count++;
                                            ?>
                        <div class="col-sm-12">
                            <br>
                            <h4 class="text-left"><b>Examination Details: </b></h4>
                            <table style="border:1px solid;" border="1">
                                <tr>
                                    <th style="text-align: center;">SL. NO</th>
                                    <th style="text-align: center;">DATE & TIME</th>
                                    <th style="text-align: center;">DESCRIPTION</th>
                                    <th style="text-align: center;">SIGN OF INVIGILATOR</th>
                                </tr>
                                <?php
                                            $count=1;
                                            foreach ($examdetails as $exdetails) { ?>    
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $exdetails['date_time']; ?></td>
                                    <td><?php echo $exdetails['description']; ?></td>
                                    <td></td>
                                </tr>
                                <?php
                                                }
                                            $count++;
                                            ?>
                            </table>
                        </div>
                        <div class="col-sm-12" style="margin-top: 100px;">
                            <h5 class="text-left" ><b>Signature of the Candidate...................................</b></h5>
                        <h5 class="text-left" ><b>(To be signed in the Presence of Identifying Officer)</b></h5>
                        </div>
                        <div class="col-sm-12" style="margin-top: 100px;">
                            <div class="col-sm-6">
                                <p>Mundakkulam, Muthuparamba Post<br>
                                    Kondotty, Malappuram, Kerala, 673 638<br>
                                    www.shamsululama.org<br>
                                    smichrd@gmail.com</p>
                            </div>
                            <div class="col-sm-6">
                                <br>
                                <h4 class="text-right"><b>Controller of Examinations</b></h4>
                                <h5 class="text-right"><b>JAMIA JALALIYYA MUNDAKKULAM</b></h5>
                            </div>
                        </div> 
                        <div class="col-sm-12">
<h4 class="text-center"><b>*** COMMUNICATION DEVICES ARE STRICTLY PROHIBITED INSIDE EXAMINATION HALL ***</b></h4>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-5" style="border:1px solid;text-align: center;height:40px;">
                                <h5>Please read the instructions of examination at back side</h5>
                            </div>
                            <div class="col-sm-5" style="border:1px solid;height:40px;float:right;">
                                
                            </div>
                        </div>
                        <div class="page-break"></div>


                        <div class="row">
                        <div class="col-sm-12" style="margin-top: 30px">
                            <div class="col-sm-6">
                                <h4><b>പരീക്ഷാർത്ഥി പാലിക്കേണ്ട നിർദേശങ്ങൾ</b></h4>
                            <ul style="list-style-type:disc;font-size: 13px">
                                <li>നൽകപ്പെട്ട നിർദ്ദേശങ്ങൾ ശ്രദ്ധയോടെ വായിച്ചു മനസ്സിലാക്കുക.</li>
                                <li>നിങ്ങളുടെ വ്യക്തികൾ വിവരങ്ങൾ തെറ്റുകൂടാതെ കൃത്യതയോടെ നൽകുക.</li>
                                <li>സഹ പരീക്ഷാർത്ഥികളുമായി പരീക്ഷക്കിടയിൽ സംസാരിക്കു കയോ അംഗവിക്ഷേപണങ്ങൾ നടത്താതിരിക്കുകയോ ചെയ്യുക.</li>
                                <li>പരീക്ഷാഹാളിൽ അനുവദിക്കപ്പെടാത്ത ഒരു ഉപരകണവും പരി ക്ഷ ഹാളിൽ പ്രവേശിപ്പിക്കരുത്</li>
                                <li>എന്തെങ്കിലും സഹായം ആവശ്യമാകുന്ന പക്ഷം കൈ ഉയർത്തി ഇൻവിജിലേറ്ററോട് സഹാം അഭ്വാർത്ഥിക്കാവുന്നതാണ്. </li>
                                <li>നിർദ്ധിഷ്ട സമയത്തിനുള്ളിൽ തന്നെ പരീക്ഷ പൂർത്തികരിച്ച് ഉ
                                    ത്തരപ്പേപ്പർ ഇൻവിജിലേറ്ററെ ഏൽപിക്കേണ്ടതാണ്.</li>
                                <li>നിങ്ങൾ ചെല്ലുന്ന ഒരോ കൗണ്ടറിൽ നിന്നും വെരിഫിക്കേഷൻ സ്റ്റാഫിൽ നിന്നോ ഇൻചാർജ്ജുള്ള വ്യക്തിയിൽ നിന്നോ ഹാൾടിക്ക റിൽ ഒപ്പ് രേഖപ്പെടുത്തിയിട്ടുണ്ടോ എന്ന് ഉറപ്പു വരുത്തേണ്ടതാണ്.</li>
                            </ul>
                            </div>
                            <div class="col-sm-6">
                                <h4><b>INSTRUCTION TO CANDIDATE IN EXAMINATION HALL</b></h4>
                            <ul style="list-style-type:disc;font-size: 16px">
                                <li>Read the instructions carefully before starting the exam.</li>
                                <li>Listen carefully to any verbal instructions given by the invigilator.</li>
                                <li>Write your name, Application number and other details on the answer sheet before starting the exam.</li>
                                <li>Do not bring any electronic device or unauthorized material into the examination hall.</li>
                                <li>Do not communicate with other candidates during the exam.</li>
                                <li>Raise your hand and wait for the invigilator if you need any assistance.</li>
                                <li>Finish the exam within the alloted time.</li>
                                <li>Handover the answer sheet to the invigilator before leaving the exam hall.</li>
                            </ul>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            

            </div>
            
            </div>
    </section>
        <div class="clearfix"></div>
        <footer>
        </footer>
    </body>
    
</html>
