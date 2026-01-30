<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
$language = $this->customlib->getLanguage();
$language_name = $language["short_code"];
?>
<style type="text/css">

@media print {
.no-print {
 visibility: hidden !important;
  display:none !important;
}
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
<h1>
<i class="fa fa-usd"></i> <?php echo $this->lang->line('Institute'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<!-- <?php
if ($this->rbac->hasPrivilege('income', 'can_add')) {
?> -->
<div class="col-md-4">
    <!-- Horizontal Form -->
    <div class="box box-primary" style="padding-bottom: 100px">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo ('Edit Marks'); ?></h3>
        </div><!-- /.box-header -->

        <form id="form1" action="<?php echo site_url('entrance_allotment/Entranceexam_marks/updatemark'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="box-body">
                <?php
                $count = 0;
                foreach ($markedit as $mrkedit) 
                { 
                ?>
                                        
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('phase') ?><small class="req"> *</small></label>
                <select autofocus="" id="phase" name="phase" class="form-control select2" >
                <option value=""><?php echo $this->lang->line('select'); ?></option>
                <?php
                $count = 0;
                
                foreach ($get_phase as $phase) 
                {
                ?>
                <option value="<?php echo $phase['entrance_examgroup_id'] ?>" <?php if ($mrkedit->entranceexam_marks_phase == $phase['entrance_examgroup_id']) {
                echo "selected=selected";
                }
                ?>><?php echo $phase['entrance_examgroup_name'] ?></option>
                <?php
                $count++;
                }
                ?>
                </select>
                </div>                 
                                        
                                        
                                        
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo ('Select Course'); ?><small class="req"> *</small></label>
                    <select class="form-control" name="course_id" id="course_id">
                    <?php 
                    
                    foreach($courselist as $crslist)
                    {
                    ?>
                    <option value="<?php echo $crslist['entranceexam_course_id']; ?>" <?php if($crslist['entranceexam_course_id']==$mrkedit->entranceexam_marks_course_id)
                    {
                    echo "selected=selected";
                    }?>><?php echo $crslist['entranceexam_course_name']; ?></option>
                    <?php } ?>
                    </select>
                    </div>
                

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo ('Subject'); ?><small class="req"> *</small></label>
                    <select class="form-control" name="subject_id" id="subject_id" required>
                        <option value="<?php echo $mrkedit->entrance_subtype_id; ?>"><?php echo $mrkedit->entrance_subtype_name; ?></option>
                        
                        
                    <!-- <?php foreach($subjectlist as $sublist){ ?>
                    <option value="<?php echo $sublist['entranceexam_subject_id']; ?>" <?php if($sublist['entranceexam_subject_id']==$mrkedit->entranceexam_marks_subject_id)
                    {
                    echo "selected=selected";
                    }?>><?php echo $sublist['entranceexam_subject_name']; ?></option>
                    <?php } ?> -->
                    
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo ('Maximum Marks'); ?><small class="req"> *</small></label>
                    <input type="text" name="max_mark" placeholder="Maximum" class="form-control" value="<?php echo $mrkedit->entranceexam_marks_maximum_marks; ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo ('Minimum Marks'); ?><small class="req"> *</small></label>
                    <input type="text" name="min_mark" placeholder="Minimum" class="form-control" value="<?php echo $mrkedit->entranceexam_marks_minimum_marks; ?>" required>
                </div>
                
                
                <div class="form-group">
                <label><?php echo $this->lang->line('session') ?></label><small class="req"> *</small>
                <select  id="session" name="session" class="form-control select2"  >
                <!--<option value="<?php if(!empty($subject_marks)) { echo  $subject_marks['id'];} else { echo ""; } ?>"><?php if(!empty($subject_marks)) { echo $subject_marks['session']; } else { echo $this->lang->line('select'); } ?></option>-->
                <option value="<?php  echo $current_session['id']; ?>"><?php  echo $current_session['session']; ?></option>
                
                <?php
                foreach($sessionlist as $sess)
                {
                ?>
                <option value="<?php  echo $sess['id']; ?>"><?php  echo $sess['session']; ?></option>
                
                <?php } ?>
                </select>
                
                <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                </div>
                
                
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo ('Year'); ?><small class="req"> *</small></label>
                    <select class="form-control" name="year">
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                      <?php for ($i = 2000; $i <= 2050; $i++){ ?>
                        <option value="<?php echo $i; ?>" <?php if($i==$mrkedit->entranceexam_marks_year)
                    {
                    echo "selected=selected";
                    }?>><?php echo $i; ?></option>
                      <?php } ?>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo ('Active'); ?><small class="req"> *</small></label>
                    <select class="form-control" name="active" required>
                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                        <option value="1" <?php if($mrkedit->entranceexam_marks_active=='1')
                    {
                    echo "selected=selected";
                    }?>><?php echo "Yes"; ?></option>
                        <option value="0" <?php if($mrkedit->entranceexam_marks_active=='0')
                    {
                    echo "selected=selected";
                    }?>><?php echo "No"; ?></option>
                    </select>
                </div>
                 <input type="hidden" name="mark_id" placeholder="ID" class="form-control" value="<?php echo $mrkedit->entranceexam_marks_id; ?>" required>
                 <?php
                                        $count++;
                                        }
                                        ?> 
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
            </div>
        </form>
    </div>

</div><!--/.col (right) -->
<!-- left column -->
<!--  <?php } ?> -->
<div class="col-md-8">
<!-- general form elements -->
<div class="box box-primary">
    <div class="box-header ptbnull">
        <h3 class="box-title titlefix"> <?php echo ('Mark List'); ?></h3>
        <div class="box-tools pull-right">
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
       
        <div class="table-responsive mailbox-messages">
                 <table class="table table-striped table-bordered table-hover example" data-export-title="<?php echo ('Mark List'); ?>">
                <thead>
                    <tr>
                        <th><?php echo ('Phase'); ?>
                        </th> 
                        
                        <th><?php echo ('Course'); ?>
                        </th>
                         <th><?php echo ('Subject'); ?>
                        </th>
                        <th><?php echo ('Maximum'); ?>
                        </th>
                        <th><?php echo ('Minimum'); ?>
                        </th>
                        <th><?php echo ('Year'); ?>
                        </th>
                        <th><?php echo ('Active'); ?>
                        </th>
                        <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                       if(!empty($markslist))
                       {
                        $count = 0;
                        foreach ($markslist as $marks) { ?>
                            <tr> 
                            <td><?php echo $marks['entrance_examgroup_name'] ;?></td>
                            <td><?php echo $marks['entranceexam_course_name']; ?></td>
                            <td><?php echo $marks['entrance_subtype_name']; ?></td>
                            <td><?php echo $marks['entranceexam_marks_maximum_marks']; ?></td>
                            <td><?php echo $marks['entranceexam_marks_minimum_marks']; ?></td>
                            <td><?php echo $marks['entranceexam_marks_year']; ?></td>
                            <td><?php if($marks['entranceexam_marks_active']==1)
                        {
                            echo "Yes";
                        }
                        else {
                            echo "No";
                        } ?></td>
                             <td align="right">
                                 <a data-placement="left" href="<?php echo site_url('entrance_allotment/Entranceexam_marks/editmarks/' . $marks['entranceexam_marks_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil"></i></a>
                                <a data-placement="left" href="<?php echo site_url('entrance_allotment/Entranceexam_marks/deletemark/' . $marks['entranceexam_marks_id']); ?>" class="btn btn-default btn-xs"  data-toggle="tooltip"  onclick="return doconfirm();" title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-remove"></i></a> 
                            </td> 
                            </tr>                                                   
                            <?php
                        $count++;
                        }
                    }
                        ?>  
                </tbody>
            </table><!-- /.table -->
        </div><!-- /.mail-box-messages -->
    </div><!-- /.box-body -->
</div>
</div><!--/.col (left) -->
<!-- right column -->

</div>                           
</section><!-- /.content -->
</div><!-- /.content-wrapper -->        
<script type="text/javascript">


                function doconfirm()
                {
                var job=confirm("Do you want to delete");
                if(job == true)
                {
                return true;
                }
                else
                {
                return false;
                }
                }


    $(document).on('change', '#course_id', function (e) {
        $('#subject_id').html("");
        var course_id = $(this).val();
        getSubjectByCourse(course_id,subject_id);
    });

    function getSubjectByCourse(course_id,subject_id) 
    {
       // alert(course_id);
        var course_id = $('#course_id').val();
        if (course_id != "") {
            $('#subject_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: base_url + "entrance_allotment/Entranceexam_marks/selectSubject",
                data: {'course_id': course_id},
                dataType: "json",
                success: function (data) 
                {
                    $.each(data, function (i, obj)
                    {
                        
                        
                        
                        var select = "";
                                    if (<?php echo $mrkedit->entranceexam_marks_subject_id; ?> == obj.entrance_subtype_id) {
                                        var select = "selected=selected";
                                    }
                                    div_data += "<option value=" + obj.entrance_subtype_id + " " + select + ">" + obj.entrance_subtype_name + "</option>";
                    });
                    $('#subject_id').append(div_data);
                },
            });
        }
    }

</script>
