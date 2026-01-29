        <style>
        .fontstyle {
        font-size: calc(0.8vw + 8px);
        font-family: 'meera';
        color:#ffffff;
        }
        
        .setdesign:hover {
        background-color: #2ba7ac !important;
        }
        @media only screen and (min-width: 320px) and (max-width: 449px)
        {
        .cardlist {
        min-height: 10px;
        }
        }
        
        .cardlist {
        float: left;
        min-height: 150px;
        padding-bottom: 25%;
        position: relative;
        text-align: center;
        width: 100%;
        }
        
        
        .column {
        float: left;
        width: 30.3%; 
        padding:  10px;
        text-align: center;
        border: 1px solid;
        /*padding: 10px;*/
        /*box-shadow: 0px 1px #888888;*/
        }
        
        .row { margin: 0 -5px; }
        
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
        
        @media screen and (max-width: 600px) {
        .column {
        width: 33.33%;
        display: block;
        margin-bottom: 20px;
        }
        }
        
        .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding: 16px;
        text-align: center;
        background-color: #f1f1f1;
        }
        
        .card-text 
        {
        font-size: 1vw; 
        }
        
        @media (max-width: 768px) 
        {
        .card-text {
        font-size: 12px;
        height:50px;
        }
        }
        
        .spanstyle
        {
        color:white;
        height:100px;
        font-size:80px;
        }
        </style>
        
        

        <div class="main-content">
        <section>
        <div class="container">
        <div class="row" style="margin:5px;" id="regst">
            
        <?php
        if($ui_tables['ui_primary']=="1")
        {
        $col="green";
        $icon="fa fa-lock";
        $link="#";
        }
        else
        {
        $col="#00C3CB";  
        $icon="fa fa-book";
        $link = site_url('entrance/Entranceexam/termsandcondition');
        }
        ?> 
       
       
        
                                <div class="text-center" >
                                <div style="display: flex; flex-wrap: wrap;">
                                <div  class="setdesign" style="border: 1px solid #5deeff; padding: 10px; border-radius:15px; margin-right: 10px; margin-bottom: 10px; width: calc(33.33% - 10px); background-color:<?php echo $col; ?>">
                                <a href="<?php echo $link; ?>">
                                <span class="spanstyle" ><i class="<?php echo $icon;  ?>" aria-hidden="true"></i></span> </a>
                                <p> <label  class="fontstyle" >Applications</label> </p>
                                </div>
                                
                                <?php
                                if($ui_tables['ui_primary']=="1" && $ui_tables['ui_payment']=="1")
                                {
                                $pcol="green";
                                $picon="fa fa-lock";
                                $plink="#";
                                }
                                else if($ui_tables['ui_primary']=="1" && $ui_tables['ui_payment']=="0")
                                {
                                $pcol="#00C3CB";  
                                $picon="fa fa-money";
                                $plink = site_url('entrance/home/paynow');
                                }  
                                else if($ui_tables['ui_primary']=="0" && $ui_tables['ui_payment']=="0" || $ui_tables['ui_primary']=="")
                                {
                                $pcol="#00C3CB";
                                $picon="fa fa-money";
                                $plink="#";
                                }
                                else
                                {
                                $pcol="green";
                                $picon="fa fa-lock";
                                $plink="#";
                                }
                                ?> 
                                <div class="setdesign" style="border: 1px solid #5deeff; padding: 10px; margin-right: 10px; border-radius:15px; margin-bottom: 10px; width: calc(33.33% - 10px); background-color:<?php echo $pcol; ?>">
                                <a href="<?php echo $plink; ?>" >
                                <span class="spanstyle" ><i class="<?php echo $picon;  ?>" aria-hidden="true"></i></span> </a>
                                <p> <label  class="fontstyle" >Fees Payment</label> </p>
                                </div>
                                
                                
                                <?php
                                if($ui_tables['ui_payment']=="1" && $ui_tables['ui_finalise']=="1")
                                {
                                $fcol="green";
                                $ficon="fa fa-lock";
                                $flink="#";
                                }
                                else if($ui_tables['ui_payment']=="1" && $ui_tables['ui_finalise']=="0")
                                {
                                $fcol="#00C3CB";  
                                $ficon="fa fa-file-text-o";
                                $flink = site_url('entrance/home/confirm_application');
                                }
                                else if($ui_tables['ui_payment']=="0" && $ui_tables['ui_finalise']=="0" || $ui_tables['ui_payment']=="")
                                {
                                $fcol="#00C3CB";  
                                $ficon="fa fa-file-text-o";
                                $flink="#";
                                }
                                ?>
                                
                                <div class="setdesign" style="border: 1px solid #5deeff; padding: 10px; margin-right: 10px;border-radius:15px;  margin-bottom: 10px; width: calc(33.33% - 10px); background-color:<?php echo $fcol; ?>">
                                <a href="<?php echo $flink; ?>">
                                <span class="spanstyle" ><i class="<?php echo $ficon;  ?>" aria-hidden="true"></i></span> </a>
                                <p> <label  class="fontstyle" >Finalise Application</label> </p>
                                </div>
                                
                                
                                <?php
                                if($ui_tables['ui_finalise']=="1" && $ui_tables['ui_printapplication']=="1")
                                {
                                $acol="green";
                                $aicon="fa fa-lock";
                                $alink="#";
                                }
                                else if($ui_tables['ui_finalise']=="1" && $ui_tables['ui_printapplication']=="0")
                                {
                                $acol="#00C3CB";  
                                $aicon="fa fa-file-text-o";
                                $alink = site_url('entrance/home/admission_form_pdf');
                                }
                                else
                                {
                                $acol="#00C3CB";  
                                $aicon="fa fa-file-text-o";    
                                }
                                ?>
                                
                                
                                <div  class="setdesign" style="border: 1px solid #5deeff; padding: 10px; border-radius:15px; margin-right: 10px; margin-bottom: 10px; width: calc(33.33% - 10px); background-color:<?php echo $acol; ?>">
                                <a href="<?php echo $alink; ?>">
                                <span class="spanstyle" ><i class="fa fa-print" aria-hidden="true"></i></span> </a>
                                <p> <label  class="fontstyle" >Print Applications</label> </p>
                                </div>
                                
                                <?php
                                $extracol="#a0a2a6";
                                $extralink="#";
                                ?>
                                <?php
                                if($ui_tables['ui_finalise']=="1" && $ui_tables['ui_admitcard']=="0")
                                {
                                $adcol  = "green";
                                $adicon = "fa fa-lock";
                                $adlink = "#";
                                }
                                else if($ui_tables['ui_finalise']=="1" && $ui_tables['ui_admitcard']=="1")
                                {
                                $adcol  = "#00C3CB";  
                                $adicon = "fa fa-file-text-o";
                                $adlink = site_url('entrance/home/admitcard');
                                }
                                else
                                {
                                $adcol  = "#00C3CB";  
                                $adicon = "fa fa-file-text-o";    
                                }
                                
                                
                                $current_date             =        date('Y-m-d H:i');
                                $examresult_publish_date  =        $entrance_ui_phaseresult['set_general_publishdate'];
                                $examresult_close_date    =        $entrance_ui_phaseresult['set_general_publishdate'];
                                $examresult_publish_date            =   str_replace('T', ' ', $entrance_ui_phaseresult['set_general_publishdate']);
                                $examresult_close_date              =   str_replace('T', ' ', $entrance_ui_phaseresult['set_general_closedate']);
                                
                                $college_pref_publish_date          =   str_replace('T', ' ', $entrance_ui_phase['set_general_publishdate']);
                                $college_pref_close_date            =   str_replace('T', ' ', $entrance_ui_phase['set_general_closedate']);
                                $college_allot_publish_date         =   str_replace('T', ' ', $entrance_ui_allotment['set_general_publishdate']);
                                $college_allot_close_date           =   str_replace('T', ' ', $entrance_ui_allotment['set_general_closedate']);
                                
                                
                                
                                // if ($ui_tables['ui_examresult'] == "1" && strtotime($current_date) >= strtotime($resultPublishDateTime)) 
                                // {
                                
                                
                                if ($ui_tables['ui_examresult'] == "1" && strtotime($current_date) >= strtotime($examresult_publish_date) &&  strtotime($current_date) <= strtotime($examresult_close_date)) 
                                {
                                $rescol  = "#00C3CB";
                                $rescon = "fa fa-graduation-cap";
                                $reslink = site_url('entrance/home/result');
                                }
                                
                                
                                
                                else if ($ui_tables['ui_examresult'] == "1" && strtotime($current_date) >= strtotime($examresult_publish_date) &&  strtotime($current_date) >= strtotime($examresult_close_date)) 
                                {
                                $rescol  = "green";
                                $rescon = "fa fa-lock";
                                $reslink = "#";
                                } 
                                else
                                {
                                $rescol  = "#a0a2a6";  
                                $rescon = "fa fa-graduation-cap";    
                                }
                                
                                
                                if ($ui_tables['ui_examresult'] == "1" && strtotime($current_date) >= strtotime($college_pref_publish_date) &&  strtotime($current_date) <= strtotime($college_pref_close_date)) 
                                {
                                $colecol  = "#00C3CB";  
                                $colecon = "fa fa-universal-access";
                                $colelink = site_url('entrance/home/get_institution');
                                }
                                elseif ($ui_tables['ui_examresult'] == "1" && strtotime($current_date) >= strtotime($college_pref_publish_date) &&  strtotime($current_date) >= strtotime($college_pref_close_date)) 
                                {
                                $colecol  = "green";  
                                $colecon = "fa fa-lock";
                                $colelink = "#";
                                }
                                else
                                {
                                $colecol  = "#a0a2a6";  
                                $colecon = "fa fa-universal-access";    
                                }
                                
                                
                                
                                
                                
                                if ($ui_tables['ui_examresult'] == "1" && strtotime($current_date) >= strtotime($college_allot_publish_date) &&  strtotime($current_date) <= strtotime($college_allot_close_date)) 
                                {
                                $allotcol  = "#00C3CB";  
                                $allotcon = "fa fa-check-circle";
                                $allotlink = site_url('entrance/home/allotmentstatus');
                                }
                                else if ($ui_tables['ui_examresult'] == "1" && strtotime($current_date) >= strtotime($college_allot_publish_date) &&  strtotime($current_date) >= strtotime($college_allot_close_date)) 
                                {
                                $allotcol  = "green";  
                                $allotcon = "fa fa-lock";
                                $allotlink = "#";
                                }
                                else
                                {
                                $allotcol  = "#a0a2a6";  
                                $allotcon = "fa fa-check-circle";    
                                }
                                ?>
                                
                                
                            <div class="setdesign" style="border: 1px solid #bbdadd; padding: 10px;border-radius:15px;  margin-right: 10px; margin-bottom: 10px; width: calc(33.33% - 10px); background-color:<?php echo $adcol; ?>">
                            <a href="<?php echo $adlink; ?>">
                            <span class="spanstyle" ><i class="fa fa-ticket " aria-hidden="true"></i></span> </a>
                            <p> <label  class="fontstyle" >Print Hall Ticket</label> </p>
                            </div>
                            
                            
                                
                            <div class="setdesign" style="border: 1px solid #bbdadd; padding: 10px;border-radius:15px;  margin-right: 10px; margin-bottom: 10px; width: calc(33.33% - 10px); background-color:<?php echo $rescol; ?>">
                            <a href="<?php echo $reslink; ?>">
                            <span class="spanstyle" ><i class="<?php echo $rescon; ?>" aria-hidden="true"></i></span> </a>
                            <p> <label  class="fontstyle" >Exam Result</label> </p>
                            </div>
                            
                            
                           <div class="setdesign" style="border: 1px solid #bbdadd; padding: 10px;border-radius:15px;  margin-right: 10px; margin-bottom: 10px; width: calc(33.33% - 10px); background-color:<?php echo $colecol; ?>">
                                 <a href="<?php echo $colelink; ?>">
    <span class="spanstyle" ><i class="<?php echo $colecon;  ?>" aria-hidden="true"></i></span> </a>
                             <p> <label  class="fontstyle" >Add College Preference</label> </p>
                            </div>
                            
                            
                            
                            
                            
                            <div class="setdesign" style="border: 1px solid #bbdadd; padding: 10px; border-radius:15px; margin-right: 10px; margin-bottom: 10px; width: calc(33.33% - 10px); background-color:<?php echo $allotcol; ?>">
                            <a href="<?php echo $allotlink; ?>">
                            <span class="spanstyle" ><i class="<?php echo $allotcon;  ?>" aria-hidden="true"></i></span> </a>
                            <p> <label  class="fontstyle" >Check Allotment</label> </p>
                            </div>
                            
                            
                            
                            
                            <div class="setdesign" style="border: 1px solid #bbdadd; padding: 10px;border-radius:15px;  margin-right: 10px; margin-bottom: 10px; width: calc(33.33% - 10px); background-color:<?php echo $extracol; ?>">
                                 <a href="<?php echo $extralink; ?>">
    <span class="spanstyle" ><i class="fa fa-upload" aria-hidden="true"></i></span> </a>
                             <p> <label  class="fontstyle" >Upload Document</label> </p>
                            </div>
                            
                            </div>
                            </div>
      
        
        
        
        </section>
        </div>
        
         <script>
            $(document).ready(function() {
            $('#regst').show();
            $('html, body').animate({
            scrollTop: $('#regst').offset().top
            }, 'slow');
            });
            </script> 
        