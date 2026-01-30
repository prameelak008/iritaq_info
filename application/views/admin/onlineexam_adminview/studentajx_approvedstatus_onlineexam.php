        <div class="mailbox-controls" id="mod">
        
        <?php
        $result    = $this->customlib->getUserData();
        $role      = $result["user_type"];
        ?>
        
        
        <form method="post" action="<?php echo site_url('admin/Onlineexam_list/bulkdelete_student_online_exam'); ?>">	
        
        
        
        
        <table  class="table table-striped table-bordered table-hover" data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">
        <thead>
        <tr>
        <th>sl.No</th>
        <th>Student Details</th>
        
        <th>Class & Section</th>
        
        <th>Mobile</th>
        <th>Teacher Approved Status</th>
        <th>Admin Approved Status</th>
        
        <?php
        if($role =="Super Admin")
        {
        ?>
        <th>Update Status</th>
        <?php } ?>
        
        <th>View Pdf</th>
        
        
        
        
        
        
        <!--<th>
        
        <button type="submit" style="font-size:12px; background-color:red;" class="btn btn-success" name="save"><i class="fa fa-trash" title="Select & Delete"></i>
        </button>
        </th>-->
        
        
        <th>
        
        
        
        <!--<button  class="btn btn-info btn-sm printSelected pull-right" type="submit" name="generate" title="generate multiple certificate"><?php echo $this->lang->line('generate'); ?>-->
        
        
        </button>
        
        </th>
        
        </tr>
        </thead>
        
        
        
        
        <?php
        
        
        
        $sl=1;
        foreach($listexam as $login)
        {
        ?>
        <tr>
        <td><?php echo  $sl;?></td>
        <td>
        
        <?php  echo "Name:"; 
        ?><span><b><?php echo $login['firstname'].'&nbsp;'.$login['middlename'].''.$login['lastname']; ?></b></span>
        <?php 
        
        echo "<br>";
        echo "<br>";
        echo "Admission No:"; 
        echo $login['admission_no'];
        
        echo "<br>";
        echo "<br>";
        echo "Roll No:"; 
        echo $login['roll_no'];
        ?>
        
        <td>
        <?php
        
        echo "class:"; 
        echo $login['class'];
        
        echo "<br>";
        echo "<br>";
        echo "Section:"; 
        echo $login['section'];
        ?>
        
        </td>					
        
        
        <td>
        <?php echo $login['mobileno'];				 	
        
        $student			  = $login['student_id'];
        $class_id			= $login['class_id'];
        $section_id		= $login['section_id'];
        
        ?>
        <input type="hidden" name="studid" id="studid<?php echo $sl; ?>" value="<?php echo $login['student_id'];?>">
        <input type="hidden" name="group" id="group<?php echo $sl; ?>" value="<?php echo $login['online_examination_examgroup']; ?>">
        <input type="hidden" name="exambatchid" id="exambatchid<?php echo $sl; ?>" value="<?php echo $login['online_examination_exam']; ?>">
        </td>
        
        <td>
        <?php
        $status= $login['online_examination_subject_status'];
        
        if($status=='1')
        {
        
        $st="Waiting";
        $backgroundcolor="#9775b2";
        
        }
        elseif($status=='2')
        {
        $st="Accepted";
        $backgroundcolor="#27a562";
        
        }
        elseif($status=='3')
        {
        $st="Rejected";
        
        $backgroundcolor="#a52731";
        
        }
        else
        {
        $st=".........";
        $backgroundcolor="#2a2f26";
        }
        
        
        ?>
        
        
        <span style="background-color:<?php  echo $backgroundcolor;  ?>; color:white; padding:2px 2px 2px 2px; "><?php  echo $st; ?></span>           
        </td>
        
        <td>
        
        <?php
        $admin_st= $login['online_examination_admin_approve'];
        
        if($admin_st=='1')
        {            
        $adst="Waiting ";
        $adbackgroundcolor="#9775b2";
        
        }
        elseif($admin_st=='2')
        {
        $adst="Approved";
        $adbackgroundcolor="#27a562";
        
        }
        
        
        elseif($admin_st=='3')
        {
        $adst="Rejected";
        $adbackgroundcolor="#a52731";
        }           
        ?>
        
        <span style="background-color:<?php  echo $adbackgroundcolor;  ?>; color:white; padding:2px 2px 2px 2px; "><?php  echo $adst; ?></span>
        </td>	
        
        
        
        <?php
        if($role =="Super Admin")
        {
        ?>
        
        <td>
        <select name="approvedstatus" id="approvedstatus<?php echo $sl;  ?>" class="form-control" onchange="approvesta(<?php echo $sl; ?>);">
        <option value="">Select Status </option>
        <option value="2">Approve</option>
        <option value="3">Reject</option>
        </select>              
        
        </td>	
        <?php } ?>
        
        
        <td>
        <input type="button" value="View Pdf" id="btnPrint" onclick="getpdf(<?php echo $sl; ?>)"  />
        </td>
        
        
        <!--<td>
        <a  href="<?php echo site_url();?>/admin/onlineexam_list/delete_student_online_exam/<?php echo  $student; ?>/<?php echo  $class_id; ?>/<?php echo  $section_id; ?>" style="color:red; font-size:20px;"><i class="fa fa-trash"></i></a>
        </td>
        
        
        
        <td>
        <input type="checkbox" id="checkItem" name="check[]" value="<?php echo $student; ?>">
        </td>-->
        
        
        
        
        </tr>
        
        <?php $sl++; 
        } 
        ?>
        </table>
        </form>
        
        
        
        
        
        <script>      
        
        function getpdf(row)
        {
        var studid      = $("#studid"+row).val();
        var group     = $("#group"+row).val();
        var exambatchid = $("#exambatchid"+row).val();
        
        $.ajax({
        type : "POST",
        url: base_url + "admin/onlineexam/viewsubjectpdf_printer",
        
        data: {studid:studid,group:group,exambatchid:exambatchid},       
        datatype : 'JSON',      
        
        success:function(data)
        {
        var ht = $(window).height();
        var wt = $(window).width();
        
        var divContents = $("#print_content").html();
        var printWindow = window.open('', '', 'height=' + ht + 'px,width=' + wt + 'px');
        printWindow.document.write('<html><head><title><?php  echo $this->customlib->getAppName(); ?>  </title>');
        printWindow.document.write('<link href="#"');
        printWindow.document.write('</head><body>');
        printWindow.document.write(data);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print(); 
        },    
        });     
        
        }
        </script>	
        
        
        <script type="text/javascript">
        function approvesta(row)
        {
        var studid         =  $('#studid'+row).val();
        var group          =  $('#group'+row).val();
        var exambatchid    =  $('#exambatchid'+row).val();
        var approvedstatus =  $('#approvedstatus'+row).val();
        
        $.ajax({
        type: "POST",   
        data: {studid: studid,group:group,exambatchid:exambatchid,approvedstatus:approvedstatus}, 
        
        url: "<?php echo site_url('admin/onlineexam_list/update_approval');?>",
        success:function(result)
        {
        alert("Successfully Updated");
        }
        });
        }
        
        
        </script>
        </div>
        
        
        
        
        
        
        </div>