        <!doctype html>
        <html lang="en">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/png" href="assets/img/s-favican.png">
        <meta http-equiv="X-UA-Compatible" content="" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="theme-color" content="" />
        <?php echo $this->customlib->getCSRF(); ?>   
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
        <!--<link href="https://fonts.googleapis.com/css2?family=Akaya+Telivigala&family=Almarai:wght@300&display=swap" rel="stylesheet">-->
        
        <style>
        page[size="A4"] 
        {  
        width: 21cm;
        height: 29.7cm;
        font-size:10px;
        }
        
        
        page[size="A5"] 
        {
        font-size:5px;
        }
        
        
        .firsttable
        {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 2px;
        font-size:12px;
        }
        
        .heading
        {
       font-size:15px; 
        }
        
        
        </style>
        
        </head>
        <body class="body">
        <page >
        <div class="container">
        <div class="cont">    
        <div class="row">
        <div id="" style="width:100%; height:auto;" >
        <table style="width:100%; height:auto;">
        <tr>
        <td>
        <img src="<?php echo base_url();?>uploads/log/logo_pdf.png" width="100%" height="70" style="text-align:center; ">
        </td>
        </tr>
        </table>
        
        <hr style=" border: 1px solid black; width:100%;"></hr>
        <table style="width:100%;">
        <tr rowspan="2"><td class="heading" colspan="2" style="text-align:center; font-size:15px; font-weight:bold;">PAPER VALUATION CAMP</td></tr>
        <tr rowspan="2"><td colspan="2" style="text-align:center;"></td></tr>
        <tr rowspan="2"><td colspan="2" style="text-align:center;"></td></tr>
        <tr class="firsttable">
        <td style="width:50%">Slip No: <?php echo $assignsubjects['valuation_id'];  ?></td>
        <td style="width:50%;text-align:right;">Date:<?php  echo date('d-F-Y'); ?></td>
        </tr>
        </table>
        
        <table width="100%" >
        <tr class="firsttable">
        <td class="firsttable">Exam Group</td><td class="firsttable"><?php echo $assignsubjects['name'];  ?></td>
        </tr>
        <tr class="firsttable">
        <td class="firsttable">Exam</td><td class="firsttable"><?php echo $assignsubjects['exam'];  ?></td>
        </tr>
        
        <tr class="firsttable">
        <td class="firsttable">Session</td><td class="firsttable"><?php echo $assignsubjects['sessionname'];  ?></td>
        </tr>
        
        <tr class="firsttable">
        <td class="firsttable">Staff ID</td><td class="firsttable"><?php echo $assignsubjects['employee_id'];  ?></td>
        </tr>
        
        <tr class="firsttable">
        <td class="firsttable">Staff Name</td><td class="firsttable"><?php echo $assignsubjects['staffname'];  ?></td>
        </tr>
        
        <tr class="firsttable">
        <td class="firsttable">Address</td><td class="firsttable"><?php echo $assignsubjects['permanent_address'];  ?></td>
        </tr>
        
        <tr class="firsttable">
        <td class="firsttable">Date & Time Assigned</td>
        <td class="firsttable"><?php echo $assignsubjects['valuation_date'].''.$assignsubjects['valuation_time'];  ?></td>
        </tr>
        <tr class="firsttable">
        <td class="firsttable">Submission Date & Time</td>
        <td class="firsttable">
            
        <?php 
        
        $str=$assignsubjects['valuation_submissiondate'];
        $delimiter = 'T';
        $words_examgroup = explode($delimiter, $str);
        echo $words_examgroup[0].'&nbsp;&nbsp;'.$words_examgroup[1];
        ?>
        
        </td>
        </tr>
        </table>
        
       
        
        <table style="width:100%;padding-top:2px;" >
        <tr class="firsttable"><td class="firsttable">No</td><td class="firsttable">Subject Code</td><td class="firsttable">Subject Name</td><td class="firsttable">Bundle Code</td><td class="firsttable">Count Of Papers</td><td class="firsttable">Amount</td></tr>
        <tr class="firsttable"><td class="firsttable">1</td><td class="firsttable"><?php echo $assignsubjects['subjectcode'];  ?></td><td class="firsttable"><?php echo $assignsubjects['subjectname'];  ?></td><td class="firsttable"><?php echo $assignsubjects['valuation_bunblecode'];  ?></td>
        <td class="firsttable"><?php echo $assignsubjects['valuation_countofpaper'];  ?></td><td class="firsttable"><?php echo $assignsubjects['valuation_amount'];  ?></td>
        </tr>
        </table>
        <br>
        <br>
        <table style="width:100%; padding-left:20px;">
        <tr>
        <td style="width:50%"></td>
        <td style="width:50%;">Name:&nbsp;&nbsp;&nbsp;<?php echo $assignsubjects['staffname'];  ?></td>
        </tr>
        <tr style="padding-top:10px;">
        <td style="width:50% line-height:10px;"></td>
        <td style="width:50%;">Signature:</td>
        </tr>
        </table>
        <br>
        <br>
        
        <table style="width:100%; ">
        <tr>
        <td style="width:50%; text-align:center;"></td>
        <td style="width:50%;  text-align:center;"></td>
        </tr>
        </table>
        </div>
        </div>
        </div>
        </div>
        </page>
