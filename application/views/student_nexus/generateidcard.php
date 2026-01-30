<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>


<div class="content-wrapper">  
    <section class="content-header">
        <h1><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('certificate'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">


                    <div class="col-md-12">
                    <?php
                    $this->load->view('layout/topbar_studentnexus'); ?>
                    </div>
                    &nbsp;
                    <?php
                            /* if ($this->session->flashdata('msg')) {?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php }
                            */
                            ?>

           

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form role="form" action="<?php echo site_url('student_nexus/generateidcard/search') ?>" method="post" class="class_search_form">
                <div class="promotion-grid">
                <!-- Selection Section -->
                <div class="section-card">
                <div class="section-title"><?php echo $this->lang->line('select_criteria'); ?></div>

                <div class="row">
                <div class="col-md-12">


                <div class="row">
                <?php echo $this->customlib->getCSRF(); ?>

                <div class="col-md-4">
                <div class="form-group">
                <label>Program Type / Program <small class="req">*</small></label>
                <?php echo render_program_dropdown($program_types, $programs, set_value('program')); ?>
                <span class="text-danger"><?php echo form_error('program'); ?></span>
                </div>
                </div>

                <div class="col-md-4">
                <div class="form-group">
                <label>Semester / Batch / Term <small class="req">*</small></label>

                <?php
                echo render_semester_dropdown($semesters_batches, set_value('semester'));
                ?>
                </div>
                </div>


                
                <div class="col-md-4">
                <div class="form-group">
                <label><?php echo $this->lang->line('template'); ?><small class="req">*</small></label>
                <select  id="id_card" name="id_card" class="form-control" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php
                if (isset($idcardlist)) {
                foreach ($idcardlist as $list) {
                ?>
                <option value="<?php echo $list->id ?>" <?php if (set_value('id_card') == $list->id) echo "selected=selected" ?>><?php echo $list->title ?></option>
                <?php
                }
                }
                ?>
                </select>
                </div>
                </div>
                </div>
                </div>

                <!--./col-md-6-->               

                </div>
                </div><!--./col-md-6-->
                </div>

                <div class="col-md-12">
                <div class="row">

                <div class="col-sm-12">
                <div class="form-group">
                <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle">
                <i class="fa fa-search"></i> &nbsp;<?php echo $this->lang->line('search'); ?>
                </button>
                </div>
                </div>


                </div>
                </div> 

                </div>
                </form>
                        </div>  
                    </div>

                    <?php
                    if (isset($resultlist)) 
                    {
                    ?>

                            <form method="post" action="<?php echo base_url('student_nexus/generateidcard/generatemultiple') ?>">
                            <div  class="" id="duefee">                               
                                <div class="box-header ptbnull">
                                    <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo $this->lang->line('student'); ?> <?php echo $this->lang->line('list'); ?></h3>
                                    <button class="btn btn-info btn-sm printSelected pull-right" type="button" name="generate" title="<?php echo $this->lang->line('generate') . " " . $this->lang->line('certificate'); ?>"><?php echo $this->lang->line('generate'); ?></button>
                                </div>

                                <div class="box-body table-responsive">
                                    <div class="download_label"><?php echo $title; ?></div>
                                    <div class="tab-pane active table-responsive no-padding" id="tab_1">
                                        <table class="table table-striped table-bordered table-hover example" cellspacing="0" width="100%">
                                            <thead>

                                                <tr> 
                                                    <th><input type="checkbox" id="select_all" /></th>
                                                    <?php if (!$adm_auto_insert) { ?>
                                                        <th><?php echo $this->lang->line('admission_no'); ?></th>
                                                    <?php } ?>
                                                    <th><?php echo $this->lang->line('student_name'); ?></th>
                                                    <th><?php echo $this->lang->line('class'); ?></th>
                                                    <?php if ($sch_setting->father_name) { ?>
                                                    <th><?php echo $this->lang->line('father_name'); ?></th>
                                                    <?php } ?>
                                                    <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                                    <th><?php echo $this->lang->line('gender'); ?></th>
                                                    <?php if ($sch_setting->category) { ?>
                                                    <th><?php echo $this->lang->line('category'); ?></th>
                                                    <?php } if ($sch_setting->mobile_no) { ?>
                                                    <th><?php echo $this->lang->line('mobile_no'); ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (empty($resultlist)) {
                                                    ?>

                                                    <?php
                                                } else {
                                                    $count = 1;
                                                    foreach ($resultlist as $student) {
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"><input type="checkbox" class="checkbox center-block" data-student_id="<?php echo $student['id'] ?>"  name="check" id="check" value="<?php echo $student['id'] ?>">
                                                                <!-- <input type="text" name="class_id" id="class_id" value="<?php echo $student['class_id'] ?>"> -->
                                                           <input type="hidden" name="id_card_id" id="id_card_id" value="<?php echo $idcardResult[0]->id ?>">
                                                           <input type="hidden" name="sem_group_id"  id="sem_group_id" value="<?php echo $sem_groups['sem_group_id']; ?>">
                                                           
                                                            </td>
                                                            <?php if (!$adm_auto_insert) { ?>
                                                                <td><?php echo $student['admission_no']; ?></td>
                                                            <?php } ?>
                                                            <td>
                                                                <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>"><?php echo $this->customlib->getFullName($student['firstname'],$student['middlename'],$student['lastname'],$sch_setting->middlename,$sch_setting->lastname); ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
                                                            <?php if ($sch_setting->father_name) { ?>
                                                                <td><?php echo $student['father_name']; ?></td>
                                                            <?php } ?>
                                                            <td><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); ?></td>
                                                            <td><?php echo $student['gender']; ?></td>
                                                            <?php if ($sch_setting->category) { ?>
                                                                <td><?php echo $student['category']; ?></td>
                                                            <?php } if ($sch_setting->mobile_no) { ?>
                                                                <td><?php echo $student['mobileno']; ?></td>
                                                            <?php } ?>
                                                        </tr>
                                                        <?php
                                                        $count++;
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>                                                                           
                                </div>                                                         
                            </div>
                        </form>
                        <?php
                    }
                    ?>
                </div>  
            </div>  
        </div> 
    </section>
</div>
<div class="response"> 
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#select_all').on('click', function () {
            if (this.checked) {
                $('.checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function () {
                    this.checked = false;
                });
            }
        });

        $('.checkbox').on('click', function () {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.printSelected', function () {        
            var array_to_print = [];
            var sem_group_id = $("#sem_group_id").val();
            var idCard       = $("#id_card_id").val();          

            $.each($("input[name='check']:checked"), function () {
                var studentId = $(this).data('student_id');
                item = {}
                item ["student_id"] = studentId;
                array_to_print.push(item);
            });
         
            if (array_to_print.length == 0)
            {
            alert("<?php echo $this->lang->line('no_record_selected'); ?>");
            } 
            else
            {
                $.ajax({
                    url: '<?php echo site_url("student_nexus/generateidcard/generatemultiple") ?>',
                    type: 'post',
                    dataType: 'JSON',
                    data: {'data': JSON.stringify(array_to_print), 'sem_group_id': sem_group_id, 'id_card': idCard, },
                    success: function (response)
                    {
                    Popup(response.page);
                    }
                });
            }
        });
    });



    var base_url = '<?php echo base_url() ?>';
    function Popup(data)
    {

        var frame1 = $('<iframe>', {
           id:  'printDiv',
           name:  'frame1'
        });

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
        document.getElementById('printDiv').contentWindow.focus();
        document.getElementById('printDiv').contentWindow.print();
            frame1.remove();
        }, 500);

    return true;
    }

</script>