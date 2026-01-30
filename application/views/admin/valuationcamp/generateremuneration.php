
<style >

.text-left
{
    text-align: left !important;
}
</style>


<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
    <i class="fa fa-map-o"></i> <?php echo $this->lang->line('valuation_Camp'); ?> <small><?php echo $this->lang->line('remuneration') ; ?></small>  
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('remuneration'); ?></h3>
                    </div>


                    <div class="box-body">
                        <form role="form" action="<?php echo site_url('admin/valuationmarkentry/generateremuneration') ?>" method="post" >
                            <?php echo $this->customlib->getCSRF(); ?>

                            <div class="row">
                                <div class="col-sm-6 col-lg-3 col-md-3 col20">
                                    
                                    
                                    <div class="form-group">
                                    <label ><?php echo $this->lang->line('title') ; ?><small class="req"> *</small></label>
                                    <select autofocus="" required="required" id="valuation_title" name="valuation_title" class="form-control" >
                                    
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    
                                    <?php
                                    foreach ($valuationcenter as $center ) {
                                    ?>
                                    <option value="<?php echo $center['valuation_centerid'] ?>" <?php
                                    if (set_value('valuation_title') == $center['valuation_centerid']) {
                                    echo "selected=selected";
                                    }
                                    ?>><?php echo $center['valuation_centername']; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('valuation_title'); ?></span>
                                    </div>
                                    </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit"  name="search" value="search_filter" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </form>
                    </div>

                <?php
                
                if (isset($assignedstaff)) 
                {
                ?>
                
                <form method="post" action="<?php echo base_url('admin/valuationmarkentry/printrenumeration') ?>" id="printrenumeration">
                <div class="" >
                
                <div class="box-header ptbnull">
                <h3 class="box-title titlefix"><i class="fa fa-users"></i> <?php echo $this->lang->line('remuneration'); ?></h3>
                <button  class="btn btn-info btn-sm printSelected pull-right" type="submit" name="generate" title="generate print"><?php echo $this->lang->line('remuneration'); ?></button>
                </div>
                
                
                <div class="box-body">
                <div class="tab-pane active table-responsive no-padding" id="tab_1">
                <div class="download_label"> <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?></div>
                
                <table class="table table-striped table-bordered table-hover example" border="2" cellspacing="0" width="100%">
                <thead>
                <tr>
                <th><input type="checkbox" id="select_all" /></th>   
                <th class="text-left"><?php echo $this->lang->line('slno'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('staff'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('shortname'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('examgroup'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('exam'); ?></th>
                <th class="text-left"><?php echo $this->lang->line('action'); ?></th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                $sl=1;
  
                foreach($assignedstaff as $assigned)
                {
                ?>
                
                <tr>
                <td class="text-center"><input type="checkbox" class="checkbox center-block"  name="staffid[]"  data-student_id="<?php echo $assigned['staffid']; ?>" value="<?php echo $assigned['staffid']; ?>">
                <input type="hidden" value="<?php echo $assigned['valuation_centerid']; ?> " id="centerid" name="centerid"/>
              
                </td>
                <td><?php echo  $sl;    ?></td>   
                <td><?php echo $assigned['staffname'].'&nbsp;'.$assigned['surname'];    ?></td>
                <td><?php echo $assigned['shortname'];    ?></td>
                <td><?php echo $assigned['examgroupname'];    ?></td>
                <td><?php echo $assigned['exam'];    ?></td>
            
                <td></td>
                </tr>
                
                <?php 
                $sl++;
                } ?>
                </tbody>
                </table>
                </div>
                </div>
                </div>
                </form>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
</div>




        <script type="text/javascript">

        $(document).on('submit', 'form#printrenumeration', function (e)
        {
        e.preventDefault();
        var form = $(this);
        var subsubmit_button = $(this).find(':submit');
        var formdata = form.serializeArray();
        var list_selected =  $('form#printrenumeration input[name="staffid[]"]:checked').length;
        
         if(list_selected > 0)
         {
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: formdata, // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
            beforeSend: function ()
            {
                subsubmit_button.button('loading');
            },
            success: function (response)
            {
            Popup(response.page);
            },
            
            error: function (xhr) { // if error occured

                alert("Error occured.please try again");
                subsubmit_button.button('reset');
            },
            complete: function () {
                subsubmit_button.button('reset');
            }
        });
    }else{
         confirm("<?php echo $this->lang->line('please_select_anyone'); ?>");
    }

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
 $(document).on('click', '#select_all', function () {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });

     $(document).ready(function () 
     {
        $('.select2').select2();

    });
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            searching: true,
            ordering: true,
            paging: false,
            retrieve: true,
            destroy: true,
            info: false
        });
    });

    var date_format    = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
    var class_id       = '<?php echo set_value('class_id') ?>';
    var section_id     = '<?php echo set_value('section_id') ?>';
    var exam_group_id  = '<?php echo set_value('exam_group_id') ?>';
    var exam_id        = '<?php echo set_value('exam_id') ?>';
    var subjectname    = '<?php echo set_value('subjectname') ?>';
    getSectionByClass(class_id, section_id);

    // getExamgroupByClassSectionSession(class_id, section_id, session_id);
    getExamByExamgroup(exam_group_id, exam_id);
    getSubjectByExamgroup(exam_id, subjectname);

    $(document).on('change', '#exam_group_id', function (e) 
    {
    $('#exam_id').html("");
    var exam_group_id = $(this).val();
    getExamByExamgroup(exam_group_id, 0);
    });
    
    $(document).on('change',"#valuation_title",function(e)
    {
    var  valuation_title  = $(this).val();
    $.ajax({
    type: "POST",   
    data: {valuation_title:valuation_title}, 
    
    url: "<?php echo site_url('admin/valuationmarkentry/getvaluation_title');?>",
    success:function(result)
    {
    }
    });
    }
    )

    $(document).on('change', '#exam_id', function (e) 
    {       
    $('#subjectname').html("");
    var exam_id = $(this).val();
    getSubjectByExamgroup(exam_id, 0);
    });

    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, 0);
    });


    function getSectionByClass(class_id, section_id) 
    {

        if (class_id !== "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                beforeSend: function () {
                    $('#section_id').addClass('dropdownloading');
                },
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id === obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                },
                complete: function () {
                    $('#section_id').removeClass('dropdownloading');
                }
            });
        }
    }


    function getExamByExamgroup(exam_group_id, exam_id) 
    {        

        if (exam_group_id !== "") {
            $('#exam_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


            $.ajax({
                type: "POST",
                url: base_url + "admin/examgroup/getExamByExamgroup",
                data: {'exam_group_id': exam_group_id},
                dataType: "json",
                beforeSend: function () {
                    $('#exam_id').addClass('dropdownloading');
                },
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (exam_id === obj.id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
                    });

                    $('#exam_id').append(div_data);
                    $('#exam_id').trigger('change');
                },
                complete: function () {
                    $('#exam_id').removeClass('dropdownloading');
                }
            });
        }
    }




           function getSubjectByExamgroup(exam_id, subjectname) 
           {  
              
            if (exam_id !== "") {
            $('#subjectname').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_dataa = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


            $.ajax({
                type: "POST",
                url: base_url + "admin/valuationmarkentry/getsubject",
                data: {'exam_id': exam_id},
                dataType: "json",
                beforeSend: function () {
                    $('#exam_id').addClass('dropdownloading');
                },
                success: function (data) 
                {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (subjectname === obj.subject_id) {
                            sel = "selected";
                            
                            var sub=obj.subject_id;
                            $('#subjectlist').val(sub);
                        
                        
                        }
                        div_dataa += "<option value=" + obj.subject_id + " " + sel + ">" + obj.subject_id +'-'+ obj.code +'-'+ obj.name + "</option>";
                    });

                    $('#subjectname').append(div_dataa);
                    $('#subjectname').trigger('change');
                },
                complete: function () {
                    $('#subjectname').removeClass('dropdownloading');
                }
            });
        }           

    }



    function gettsudentlist()
    {
    
    var exam_group_id =  $('#exam_group_id').val();
    var exam_id       =  $('#exam_id').val();
    
    
    var class_id      =  $('#class_id').val();
    var section_id  =   $('#section_id').val();
    var subjectname   = $('#subjectname').val();
    
    var exam_group_id =  $('#exam_group_id').val();
    
    
    var session_id       =  $('#session_id').val();
    
    $.ajax({
    type: "POST",   
    data: {exam_group_id:exam_group_id,exam_id:exam_id,class_id:class_id,session_id:session_id,section_id:section_id,subjectname:subjectname}, 
    
    url: "<?php echo site_url('admin/valuationmarkentry/getsubjecttet');?>",
    success:function(result)
    {
    
    //alert(result); 
    $('#pages').val(result);
    }
    });
                         
    }

</script>