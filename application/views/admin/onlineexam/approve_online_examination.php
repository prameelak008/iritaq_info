
<?php
$result    = $this->customlib->getUserData();
$role      = $result["user_type"];
?>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-map-o"></i> <?php echo $this->lang->line('onlineexaminations'); ?> 

             </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('onlineExamination'); ?></h3>
                    </div>
                    <div class="box-body">                    

                            <?php echo $this->customlib->getCSRF(); ?>


                             <div class="col-sm-4 col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label ><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
                                    <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control" >
                                        
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>

                                        <?php
                                           foreach ($examgrouplist as $ex_group_key => $ex_group_value) {
                                            ?>
                                            <option value="<?php echo $ex_group_value->id ?>" <?php
                                            if (set_value('exam_group_id') == $ex_group_value->id) {
                                                echo "selected=selected";
                                            }
                                            ?>><?php echo $ex_group_value->name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>


                                    <span class="text-danger"><?php echo form_error('exam_group_id'); ?></span>
                                </div>  
                            </div>



                            <div class="col-sm-4 col-lg-2 col-md-2">
                                <div class="form-group">  
                                    <label><?php echo $this->lang->line('exam'); ?><small class="req"> *</small></label>
                                    <select  id="exam_id" name="exam_id" class="form-control" onchange="getsubjectid()" >
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                                </div>  
                            </div>                         




                <div class="col-sm-4 col-lg-2 col-md-2">
                <div class="form-group">  
                <label><?php echo $this->lang->line('Status'); ?><small class="req"> *</small></label>
                <select  id="status_list" name="status_list" class="form-control"  >
               <option value=""><?php echo $this->lang->line('select'); ?></option>
                <option value="1"><?php echo $this->lang->line('pending'); ?></option>
                <option value="2"><?php echo $this->lang->line('approved'); ?></option>
                <option value="3"><?php echo $this->lang->line('reject'); ?></option>
                </select>


                </div>  
                </div> 




               <div class="col-sm-4 col-lg-2 col-md-2">
               <button type="button" name="search" onclick="getsub()" class="btn btn-primary pull-right btn-sm checkbox-toggle">Search</button>    
               </div> 
               </div>                       
                        

                                <div  class="" >
                                <div class="box-header ptbnull"></div> 
                                <div class="box-header ptbnull">
                                <h3 class="box-title titlefix"><i class="fa fa-users"></i>

                                </h3>
                                    
                                
                                </div>
                                <div class="box-body">

                                   

                                <div style="width:100%;" id="mod">

                                </div> 

                                </div>                                                         
                                </div>
                       
                  
                    </div>

                  
                    <?php
               //}
                ?>
            </div>

        </div>

    </section>
</div>



<script type="text/javascript">

    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';
    var class_id = '<?php echo set_value('class_id') ?>';
    var section_id = '<?php echo set_value('section_id') ?>';
    var session_id = '<?php echo set_value('session_id') ?>';
    var exam_group_id = '<?php echo set_value('exam_group_id') ?>';
    var exam_id = '<?php echo set_value('exam_id') ?>';
    getSectionByClass(class_id, section_id);
    getExamByExamgroup(exam_group_id, exam_id);

    $(document).on('change', '#exam_group_id', function (e)
     {

        //$('#mod').hide();
            
          

        $('#exam_id').html("");
        var exam_group_id = $(this).val();
        getExamByExamgroup(exam_group_id, 0);
    });

    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        getSectionByClass(class_id, 0);
    });

    
    
       function getSectionByClass(class_id, section_id)
        {           
           

        if (class_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            //var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';

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
                        if (section_id == obj.section_id) {
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
            

        if (exam_group_id != "")
         {
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
                        if (exam_id == obj.id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.exam + "</option>";
                    });
                    $('#exam_id').append(div_data);
                },
                complete: function () {
                    $('#exam_id').removeClass('dropdownloading');
                }
            });
        }
    }

</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>


/*

    function getsubjectid()
    {

    var counter=1; 
    var examid=$('#exam_id').val();
   // var subject_id=$('#subject_id').val(); 

    var exam_group_id=$('#exam_group_id').val();



      $.ajax({
      type: "POST",
      //dataType: "json",  
      data: {examid: examid,exam_group_id:exam_group_id},
      
      url: "<?php echo site_url('admin/onlineexam_list/online_examination_get_student');?>",
      success:function(result)
      {

      $('#mod').show();

      $('#mod').html(result);

    <!-- $('#subject_id').empty();      

      var jsondata= JSON.parse(result);
    
      $('#subject_id').html('<option value=""></option>');

      $.each(jsondata, function(key, value) 
      {


    var countval=$("#count").val();     
    var rowcount=parseInt(countval)+1;

    var items="<tr id='rowno"+rowcount+"'>"; 
    items+="<td><input type='text' name='idd[]' id='id"+rowcount+"' value=' "+ value.subjectid+"'  ></td>";   
    items+="<td><input type='checkbox' id='nom"+rowcount+"' value=' "+ value.subjectid+"'  ></td>";
    items+="<td><input type='text' readonly id='sub"+rowcount+"' name='subject[]' value=' "+ value.subject+"'></td>";
    items += "</tr>";


    $("#items").append(items);
    counter++;

      //$('select[name="subject_id"]').append('<option value="'+ value.subjectid +'">'+ value.subject +'</option>');

      });-->

      },
      }); 
      }

      */



    

</script>
<script>

       $(document).on('submit', 'form#printCard', function (e)
       {
        e.preventDefault();
        var form = $(this);
        var subsubmit_button = $(this).find(':submit');
        var formdata = form.serializeArray();
  
        //var list_selected =  $('form#printCard input[name="exam_group_class_batch_exam_student_id[]"]:checked').length;

      
      //if(list_selected > 0)
      //{         

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
                // $('.rrrrrr').html(response.page);



            },
            error: function (xhr) { // if error occured

                alert("Error occured.please try again");
                subsubmit_button.button('reset');
            },
            complete: function () {
                subsubmit_button.button('reset');
            }
        });
   // }
    //else
    //{
         //confirm("<?php echo $this->lang->line('please_select_student'); ?>");
   // }

    });
    /*$(document).on('click', '#select_all', function () {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });*/

</script>



<script type="text/javascript">

function getsub()
{                      
var exam_group_id     =   $('#exam_group_id').val();   
var exam_id           =   $('#exam_id').val();
var status_list       =   $('#status_list').val();
           
$.ajax({
type: "POST",   
data: {exam_group_id: exam_group_id,exam_id:exam_id,status_list:status_list}, 

url: "<?php echo site_url('admin/onlineexam_list/listonlinexam_approvedstatus');?>",
success:function(result)
{    

$('#mod').html(result);                        

}
});           

}




    var base_url = '<?php echo base_url() ?>';
    function Popup(data)
    {


    /*var idd = document.querySelector('.checkbox:checked').value;
    $.ajax({
        type : "POST",

        url: base_url + "admin/Examresult/getstudent",
       data: {'idd': idd},        
        datatype : 'JSON',      

        success:function(data)
        {

var json = JSON.parse(data);
var firstname=json['firstname'];
//alert(firstname);

document.cookie = "name = " + firstname;

document.title = "<?php echo $name= $_COOKIE['name']; ?> ";
   var json = JSON.parse(data);
    $.each(json, function (index, obj)
    { 
    var firstname=obj.firstname;
    document.cookie = "name = " + firstname;

    });

   

        },
        }); 
*/



//$_COOKIE['name']="";
 
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";

        $("body").append(frame1);

        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;

        frameDoc.document.open();

//Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title><?php  echo $this->customlib->getAppName(); ?>  </title>');
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

        window.location.reload(true);

    }   

</script>