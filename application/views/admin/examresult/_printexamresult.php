                    <style type="text/css">
                    @media print {
                        .pagebreak1 { page-break-before: always; } /* page-break-after works, as well */
                    }
                    
                    .pagebreak {
                    page-break-after: always;
                    display: block;
                    clear: both;
                     }
                                 
                    @page{padding: 0; margin:0;}

                    body{
                    padding: 0; margin:3mm 3mm 3mm 3mm; font-family: arial; color: #000; font-size: 8px; line-height: normal;}
                    .tableone{}
                    .tableone td{border:1px solid #000; padding:3px 0}
                    .denifittable th{}
                    .denifittable th,
                    .denifittable td {border: 1px solid #000;
                                      border-collapse: collapse;border-left: 1px solid #999;}
                                      
                    .denifittable tr th {padding: 8px 0px;  font-size: 12px}

                    .denifittable tr td {padding: 8px 0px; font-weight: normal; font-size: 12px}

                    .tcmybg {
                    background:top center;
                    background-size: 100% 100%;
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    z-index: 1;
                    width: 100%;height: 100%;
                    }

                    .tablemain1
                    {
                    /*position: relative;*/
                    /*z-index: 1;*/
                    border:1px solid #000; 
                    padding: 3px;
                    min-height: 940px;
                   
                    }

                    .trstyle
                    {
                    height:3mm;
                    }
                    .tdstylelabel
                    {
                    width:45%;
                    padding-left: 12px;
                    font-size:14px;
                    }
                    
                    .tdstyledot
                    {
                    width:5%;
                    text-transform: uppercase;
                    }
                    .tdstyle
                    {
                    width:50%; 
                    font-size:14px;
                    }
                    
                    .headerclass
                    {
                    font-weight: 500;
                    }
                    .footerclass
                    {
                    font-weight: bold;
                    } 
                    }

</style>


<?php

//if($template->is_preprint='1')
///{ 



if (empty($marksheet)) 
{
?>
<div class="alert alter-info">
<?php echo $this->lang->line('no_record_found'); ?>
</div>
<?php
}
else
{
?>
 <div style="margin: 0 auto; padding: 5px 5px 5px;position: relative; z-index: 0;"> 
 
    <?php
    if ($marksheet['exam_connection'] == 0) 
    {
        if (!empty($marksheet['students'])) {
            foreach ($marksheet['students'] as $student_key => $student_value)
             {
                 
                $result_status = 1;
                $absent_status = false;
                $percentage_total = 0;
                ?>


                    <?php 
                    /*if ($template->background_img != "") 
                    {
                        ?> 
                        <img src="<?php echo base_url('uploads/marksheet/' . $template->background_img); ?>" class="tcmybg" width="100%" height="100%" />
                        <?php
                    }*/
                    ?>

                    <div class="tablemain1">
                    
                    <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                    <td valign="top" align="center" width="100">
                    <img src="<?php echo base_url('backend/default_format/exam_result_logo.jpg'); ?>" width="650" height="120">
                    </td>
                    </tr>
                    </table>

                    <div style="width:100%">
                    <span>
                    <h1 style="text-align:center">Exam Result</h1>
                    <h1 style="text-align:center"><?php //echo $marksheet_Newexamgroup; ?></h1><br>
                    </div>



                            <table cellpadding="0" cellspacing="0" width="100%"  class="tablemain">
                            <tr>
                                <td valign="top">

                                    <table cellpadding="0" cellspacing="0" width="100%" class="">
                                       
                                        <tr>
                                            <td valign="top">

                                                <table cellpadding="0" cellspacing="0" width="100%" class="">

                   

              
                <tr><td colspan="3" style="text-align:center;">
                 <?php 
  
  
  
  echo $marksheet_Newexambatch;  ?><br>
                <b>(Faculty of Islamic & Contemporary Studies)</b>
            </td></tr>
                                    <tr class="trstyle">                           

                                    <td class="tdstylelabel">Institution Id
                                    </td>
                                    <td  class="tdstyledot" >:</td>
                                    <td class="tdstyle" ><span> <?php echo $student_value['admission_no']; ?></span>
                                    </td>

                                    </tr>


                                     <tr class="trstyle">                                       

                                    <td class="tdstylelabel">Name of the applicant(in block letters)
                                    </td>
                                    <td  class="tdstyledot" >:</td>
                                    <td class="tdstyle" ><span ><?php echo $this->customlib->getFullName($student_value['firstname'],$student_value['middlename'],$student_value['lastname'],$sch_setting->middlename,$sch_setting->lastname);  ?></span>
                                    </td>

                                    </tr>



                                    
                                    <tr class="trstyle">                                       

                                    <td class="tdstylelabel"><?php echo $this->lang->line('roll_no'); ?>
                                    </td>
                                    <td  class="tdstyledot" >:</td>
                                    <td class="tdstyle" ><span >

                                        <?php 
                                        //$roll_no=($exam->use_exam_roll_no) ? $student_value['exam_roll_no']:$student_value['student_roll_no'];
                                        echo $student_value['student_roll_no']; ?></span>
                                    </td>

                                    </tr>


                                    <tr class="trstyle">
                                    <td class="tdstylelabel" > <?php echo $this->lang->line('date_of_birth'); ?>
                                    </td>
                                    <td class="tdstyledot" >:</td>
                                    <td class="tdstyle" ><span ><?php echo $student_value['dob']; ?></span>
                                    </td>
                                    </tr>


                          

                                   


                                    <tr class="trstyle">
                                    <td class="tdstylelabel" >Name of the Guardian
                                    </td>
                                    <td class="tdstyledot" >:</td>
                                    <td class="tdstyle"><span ><?php echo $student_value['father_name']; ?></span>
                                    </td>
                                    </tr>


                                    <tr class="trstyle">
                                    <td class="tdstylelabel" > <?php echo $this->lang->line('address'); ?>
                                    </td>
                                    <td class="tdstyledot" >:</td>
                                    <td class="tdstyle" ><span ><?php echo $student_value['current_address']; ?></span>
                                    </td>


                                        </tr>
                                                </table>
                                            </td>
                                            <?php
                                            if ($template->is_photo) {
                                                ?>
                                                <td valign="top" align="center"><?php if ($student_value['image'] != '') { ?><img src="<?php echo base_url() . $student_value['image']; ?>" width="150" height="180" >
                                                    <?php } ?>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                           
                        
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td valign="top">
                                
                                <?php
                                if (!empty($student_value['exam_result']))
                                {
                                ?>


<div style="min-height:105mm;">

<table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
 <thead>                                         

  <tr>
  <th colspan="2" class="headerclass"><b>Subjects</b></th>
  <th colspan="2" class="headerclass"><b>CE</b></th>
  <th colspan="2" class="headerclass"><b>TE</b></th>
  <th colspan="2"><b>Marks Obtained</b></th>
  <th rowspan="2" class="headerclass" ><b>Total</b>   </th>
 
  <th  class="headerclass" ><b>Grade</b>   </th>
  <th  class="headerclass" ><b>Result</b>   </th>
</tr>
</thead>

<tr>
<td>Code</td>
<td>Name</td>
<td>Max</td>
<td>Min</td>
 <td>Max</td>
<td>Min</td>
<td>CE</td>
<td>TE</td>
<td></td>
<td></td>
<td></td>
</tr>

                                    <?php
                                    $total_max_marks = 0;
                                    $total_obtain_marks = 0;
                                    $total_points = 0;
                                    $total_hours = 0;
                                    $total_quality_point = 0;
                                    $grandtotal=0;
                                    $obtainedtotal=0;
                                    $maxtotal=0;
                                    $grandmaxtotal=0;
                                    $singlepercentage=0;
                                    $grandobtainedtotal=0;
                                    $percentage=0;
                                    $perc=0;                                    
                                    $total_min_marks=0;
                                    $clas="";
                                    $res="";
                                    $fgde="";
                                    $mincmarks=0;
                                    $minmarks=0;
                                    $get_cmarks=0;
                                    $get_marks=0;
                                    $array_push=array();
                                    
                                   
                                    
                                    
                                    
                                    foreach ($student_value['exam_result'] as $exam_result_key => $exam_result_value) 
                                    {
                                    $total_min_marks    = $total_min_marks + $exam_result_value->min_marks;
                                    $total_max_marks    = $total_max_marks + $exam_result_value->max_marks;
                                    $total_obtain_marks = $total_obtain_marks + $exam_result_value->get_marks+ $exam_result_value->get_cmarks;
                                    ?>

                                    <tr>
                                    <td>
                                        
                                        
        
        <?php
        
        $obtainedtotal= $exam_result_value->get_cmarks+$exam_result_value->get_marks;
        $maxtotal= $exam_result_value->max_cmarks+$exam_result_value->max_marks;
        $singlepercentage=$obtainedtotal/$maxtotal*100;
        
        $grandobtainedtotal+=$obtainedtotal;
        $grandmaxtotal+=$maxtotal;
        
        $getcmark= $exam_result_value->get_cmarks;
        $mincmark =$exam_result_value->min_cmarks;
        $getmark = $exam_result_value->get_marks;
        $minmark = $exam_result_value->min_marks;
        $totalmax= $exam_result_value->max_cmarks+$exam_result_value->max_marks ;
        $gettotal_maxMarks+=$totalmax;
        
        
        if($singlepercentage<=100 && $singlepercentage>=90)
        {
        if($getcmark < $mincmark || $getmark < $minmark)
        {
        $fgde="D+";    
        } 
        else
        {
        $fgde="A+" ;
        }
        }
        
        
        elseif($singlepercentage<=89 && $singlepercentage>=80)
        {
        if($getcmark < $mincmark || $getmark < $minmark)
        {
        $fgde="D+";    
        } 
        else
        {
        $fgde="A";
        }
        }
        
        
        elseif($singlepercentage<=79 && $singlepercentage>=70)
        {
        
        if($getcmark < $mincmark || $getmark < $minmark)
        {
        $fgde="D+";    
        } 
        else
        {
        $fgde="B+";
        }
        }
        elseif($singlepercentage<=69 && $singlepercentage>=60)
        {
        
        if($getcmark < $mincmark || $getmark < $minmark)
        {
        $fgde="D+";    
        } 
        else
        {
        $fgde="B";
        }
        }
        
        elseif($singlepercentage<=59 && $singlepercentage>=50)
        {
        
        if($getcmark < $mincmark || $getmark < $minmark)
        {
        $fgde="D+";    
        } 
        else
        { 
        
        $fgde="C+";
        }
        }
        elseif($singlepercentage<=49 && $singlepercentage>=40)
        {
        if($getcmark < $mincmark || $getmark < $minmark)
        {
        $fgde="D+";    
        } 
        else
        {
        $fgde="C";    
        }
        }
        elseif($singlepercentage<=39 && $singlepercentage>=30)
        {
        
        $fgde="D+";
        }
        elseif($singlepercentage<=29 && $singlepercentage>=20)
        {
        $fgde="D";
        }
        
        elseif($singlepercentage<=19 && $singlepercentage>=10)
        {
        $fgde="E+";
        }
        
        
        
        elseif($singlepercentage<=9)
        {
        $fgde="E";
        }
        
        
        
        if($fgde=="D+" || $fgde=="D" || $fgde=="E" || $fgde=="E+")
        {
        $stylebackground="yellow";
        }
        else
        {
        $stylebackground="";
        }
    
                echo $exam_result_value->code ;
                ?>
                </td>
                <td><?php echo $exam_result_value->name ; ?> </td>
                <td><?php echo $exam_result_value->max_cmarks ; ?></td>
                <td><?php echo $exam_result_value->min_cmarks ; ?></td>
                
                <td><?php echo $exam_result_value->max_marks ; ?></td>
                <td><?php echo $exam_result_value->min_marks ; ?></td>
                
                <td style="background-color:<?php echo $stylebackground;  ?>"><?php echo $exam_result_value->get_cmarks ; ?></td>
                <td style="background-color:<?php echo $stylebackground;  ?>"><?php echo $exam_result_value->get_marks ; ?></td>
                <td style="background-color:<?php echo $stylebackground;  ?>">
                    
                <?php
                echo number_format((float)$obtainedtotal, 2, '.', '');
                ?>
                </td>
                <td style="background-color:<?php echo $stylebackground;  ?>">
                    
                <?php
                
                echo $fgde;
                $mincmarks=$exam_result_value->min_cmarks ;
                $minmarks=$exam_result_value->min_marks ;
                $get_cmarks=$exam_result_value->get_cmarks ;
                $get_marks=$exam_result_value->get_marks ; 
                
                if($get_cmarks<$mincmarks)
                {
                $checkc_result="0";
                }
                else
                {
                $checkc_result="1";
                }
                if($get_marks<$minmarks)
                {
                $check_result="0";
                }
                else
                {
                $check_result="1";
                }
                
                if($checkc_result=='1' && $check_result=='1')
                {
                $ret="Pass";
                }
                else
                {
                $ret="Fail";
                }
                
                $array_push[]= $ret;
                ?>
                
               
                                        

                <td style="text-align:center;">
                    
                <?php
                if($get_cmarks < $mincmarks|| $get_marks < $minmarks)
                {
                echo "F";
                }
                else
                {
                echo "P";
                }
                ?>
                </td>
                
                
           
       </td>

        
     </tr>

<?php 
                                        
 } 

?>

</table>

</div>
<br>
<div>
<table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
 <thead>
<tr>

        <?php
        $percentage=$grandobtainedtotal/$grandmaxtotal*100;
        $perc= number_format((float)$percentage, 2, '.', '');
        if($perc>=80)
        {
        $clas="First";
        }
        elseif($perc>=50 && $perc<=79)
        {
        $clas="Second ";
        }
        
        elseif($perc>=35 && $perc<=50)
        {
        $clas="Third ";
        }
        
        else
        {
        $clas="";
        }
        ?>

<td>Result:
<?php
if(in_array('Fail', $array_push))
{
   
$result_status="Fail";

}
else
{
   
$result_status="Pass";
}

echo $result_status;
?>
</td>

    <td>Total(Max):
    <?php 
    echo $gettotal_maxMarks;
    ?>
    </td>

    <td>Division:<?php echo $clas; ?></td>
    <td>Percentage:
        <?php
         echo number_format((float)$percentage, 2, '.', '');
?>%</td>
    <td>Total:<?php     echo number_format((float)$grandobtainedtotal, 2, '.', ''); ?></td>


</tr>
</thead>
</table>
    </div>
<br>

    <div>
<table cellpadding="0" cellspacing="0" width="100%" class="denifittable" style="text-align: center;">
 <thead>
<tr>
    <td class="headerclass">A+:90% & Above</td>
    <td class="headerclass">A:80% -89%</td>
     <td class="headerclass">B+:70% -79%</td>
      <td class="headerclass">B:60% -69%</td>
       <td class="headerclass">C+:50% -59%</td>
</tr>
</thead>

<tr>
    <td>C:40% - 49%</td>
    <td>D+:30% -39%</td>
     <td>D:20% -29%</td>
       <td>E+:10% -19%</td>
       <td>E:0%-9%</td>
</tr>
</table>


<p>Division:80% & above=First Class with distinction,50%-79%=Second Class,35%-50%=Third Class</p>
<p><b>Abbreviations:CE-Contionus Evaluation,TE-Terminal Evaluation</b></p>

<table width="100%">
    <tr>
        <td width="50%" style="text-align:left; font-style: italic; ">Published Date:&nbsp;&nbsp;<?php echo $instruction['online_examination_publishdate']; ?></td><td width="50%" style="text-align:right;font-style: italic; ">Printed Date:&nbsp;<?php  echo date('d-m-Y'); ?></td>
    </tr>
</table>

    </div>                               
                                 
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td valign="top" height="20"></td>
                        </tr>
                    </table>
                </div>

                <div class="pagebreak"> </div>
                
                <?php
            }
        }
    }
    ?>
    </div>
    <?php
     }





//}

?>


 <?php

function findGrade($exam_grades, $percentage) {

    if (!empty($exam_grades)) {
        foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {

            if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                return $exam_grade_value->name;
            }
        }
    }

    return "-";
}

function findGradePoints($exam_grades, $percentage) {

    if (!empty($exam_grades)) {
        foreach ($exam_grades as $exam_grade_key => $exam_grade_value) {

            if ($exam_grade_value->mark_from >= $percentage && $exam_grade_value->mark_upto <= $percentage) {
                return $exam_grade_value->point;
            }
        }
    }

    return 0;
}

// function examTotalResult($array) 
// {
//     $return_array = array('max_marks' => 0, 'min_marks' => 0, 'credit_hours' => 0, 'get_marks' => 0, 'exam_result' => true);
//     if (!empty($array)) {
//         $max_marks = 0;
//         $min_marks = 0;
//         $credit_hours = 0;
//         $get_marks = 0;
//         $exam_result = true;
//         foreach ($array as $array_key => $array_value) {
//             if ($array_value->attendence == "absent") {
//                 $exam_result = false;
//             }
//             $max_marks = $max_marks + $array_value->max_marks;
//             $min_marks = $min_marks + $array_value->min_marks;
//             $credit_hours = $credit_hours + $array_value->credit_hours;
//             $get_marks = $get_marks + $array_value->get_marks;
//         }
//         $return_array = array('max_marks' => $max_marks, 'min_marks' => $min_marks, 'credit_hours' => $credit_hours, 'get_marks' => $get_marks, 'exam_result' => $exam_result);
//     }
//     return json_encode($return_array);
// }



function getWeightageExam($exam_connection_list, $examid, $get_marks) {

    foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {
        if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
            return ($get_marks * $exam_connection_value->exam_weightage) / 100;
        }
    }
    return "";
}
?>