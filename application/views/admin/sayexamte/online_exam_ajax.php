                <script type="text/javascript">
                $(document).ready(function()
                {
                $('#myForm').submit(function(event) 
                {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                
                Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Successfully updated!',
                });
                },
                error: function(xhr, status, error) {
                console.error(xhr.responseText);
                }
                });
                });
                });
                </script>
                
                
                
                
                <div style="width:100%;" id="mod">
                <div class="row">
                
                <div class="col-sm-12">
                
                
                <style>
                
                
                
                
                
                
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
                position: relative;
                z-index: 1;
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
                
                
                </style>
                
                <span style="text-align:center; font-weight:bold; font-size:18px;">Applied Subjects For Say Exam</span>
                
                
                <p>
                
                <?php
                
                echo $getgroup_name['name'];
                echo "<br>";
                echo $getgroup_name['exam'];
                
                
                
                
                ?>
                </p>
                <p>
                
                <form id="updateMarksForm" name="frm" id="myform" method="POST" action="<?php echo site_url('admin/sayexamte/update_marksentry');?>">
                
                
                
                <p style="text-align:right;">
                
                
                
                <input type="submit" class="btn btn-info "  value="Update Marks" >
                
                <?php 
                
                if($sayexam_approved_status['exam_group_exam_sayexam_approvedstatus']==2)
                {
                ?>
                <i class="fa fa-check" style="font-size:20px; color:green;"></i>
                <?php
                } 
                
                ?>
                
                
                </p>
                
                
                
                
                
                
                
                
                <div class="box-body">
                
                
                
                <div class="tab-pane active table-responsive no-padding" id="tab_1">
                <div class="download_label"> <?php echo $this->lang->line('sayexam') ; ?></div>
                
                <table class="table table-striped table-bordered table-hover denifittable" border="2" cellspacing="0" width="100%">
                <thead>
                <tr>
                
                <th colspan="2" class="headerclass" ><b>Subjects</b></th>
                <th colspan="2" class="headerclass"><b>TE</b></th>
                <!--<th colspan="2" class="headerclass"><b>CE</b></th>-->
                <th colspan="" class="headerclass"><b>Marks Obtained</b></th>
                <th rowspan="2" class="headerclass" ><b>Total</b>   </th>
                <th  class="headerclass" ><b>Grade</b>   </th>
                </tr>
                </thead>
                
                <tr>
                
                <td class="headerclass">Code</td>
                <td class="headerclass">Name</td>
                <td class="headerclass">Max</td>
                <td class="headerclass">Min</td>
                <!-- <td class="headerclass">Max</td>-->
                <!--<td class="headerclass">Min</td>-->
                <!--<td class="headerclass">CE</td>-->
                
                <td class="headerclass">TE</td>
                <td class="headerclass"></td>
                <td class="headerclass"></td>
                
                </tr>
                
                
                
                
                
                <?php
                
                
                $maxtotal=0;
                $singlepercentage=0;
                $obtainedtotal=0;
                
                foreach($sayexam as $sy)
                {
                ?>
                
                <tr>
                
                <td class="headerclass"><?php echo $sy['code']; ?></td>
                <td class="headerclass"><?php echo $sy['name']; ?></td>
                <td class="headerclass"><?php echo $sy['max_marks']; ?></td>
                <td class="headerclass"><?php echo $sy['min_marks']; ?></td>
                <!-- <td class="headerclass"><?php echo $sy['max_cmarks']; ?></td>-->
                <!--<td class="headerclass"><?php echo $sy['min_cmarks']; ?></td>-->
                
                
                <td class="headerclass">
                
                <input type="hidden" id="exam_group_exam_sayexam_id" name="exam_group_exam_sayexam_id[]" value="<?php echo $sy['exam_group_exam_sayexam_id']; ?>" >
                <input type="hidden" id="resultid" name="resultid[]" value="<?php echo $sy['resultid']; ?>" >
                
                <input type="text" id="get_marks" name="get_marks[]" class="form-control"  value="<?php echo $sy['get_marks']; ?>"></td>
                <!--<input type="number" id="get_cmarks" name="get_cmarks[]" value="<?php echo $sy['get_cmarks']; ?>" >-->
                </td>
                
                
                <!--
                <td class="headerclass">
                
                
                <input type="number" id="get_marks" name="get_marks[]" class="form-control"  value="<?php echo $sy['get_marks']; ?>"></td>
                -->
                
                
                
                <td class="headerclass">
                
                <?php 
                //   $obtainedtotal =$sy['get_cmarks']+ $sy['get_marks']; 
                //   echo number_format((float)$obtainedtotal, 2, '.', '');  
                
                // $maxtotal= $sy['max_cmarks']+$sy['max_marks'];
                
                
                $obtainedtotal =$sy['get_marks']; 
                echo number_format((float)$obtainedtotal, 2, '.', '');  
                
                $maxtotal= $sy['max_marks'];
                
                $singlepercentage=$obtainedtotal/$maxtotal*100;
                ?></td>
                
                
                
                
                <td>
                
                
                <?php
                
                if($singlepercentage<=100 && $singlepercentage>=90)
                {
                $fgde="A+" ;
                }
                elseif($singlepercentage<=89 && $singlepercentage>=80)
                {
                $fgde="A";
                }
                
                
                elseif($singlepercentage<=79 && $singlepercentage>=70)
                {
                $fgde="B+";
                }
                elseif($singlepercentage<=69 && $singlepercentage>=60)
                {
                $fgde="B";
                }
                
                elseif($singlepercentage<=59 && $singlepercentage>=50)
                {
                $fgde="C+";
                }
                elseif($singlepercentage<=49 && $singlepercentage>=40)
                {
                $fgde="C";
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
                
                echo $fgde;
                
                ?>
                
                
                
                </td>
                
                </tr>
                
                
                
                <?php 
                $sl++;
                } ?>
                
                </table>
                </div>
                </div>
                
                
                </form>
                </p>
                
                <script type="text/javascript">
                $(document).ready(function ()
                {
                $('#updateMarksForm').on('submit', function (e) {
                e.preventDefault(); // prevent default form submission
                var form = $(this);
                var formData = form.serialize(); // serialize all form data
                $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: formData,
                success: function (response)
                {
                alert("Marks updated successfully!");
                },
                error: function () {
                alert("An error occurred. Please try again.");
                }
                });
                });
                });
                </script>
                </div>
                </div>
                </div>