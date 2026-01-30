    
    <style type="text/css">
    @media print
    {
    .no-print, .no-print *
    {
    display: none !important;
    }
    }
        
  .hr-text {
  line-height: 1em;
  position: relative;
  outline: 0;
  border: 0;
  color: black;
  text-align: center;
  height: 1.5em;
  opacity: .5;
  &:before {
    content: '';
    // use the linear-gradient for the fading effect
    // use a solid background color for a solid bar
    background: linear-gradient(to right, transparent, #818078, transparent);
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    height: 1px;
  }
  &:after {
    content: attr(data-content);
    position: relative;
    display: inline-block;
    color: black;

    padding: 0 .5em;
    line-height: 1.5em;
    // this is really the only tricky part, you need to specify the background color of the container element...
    color: #818078;
    background-color: #fcfcfa;
  }
        </style>
        
        <?php
        
        $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
        $result    = $this->customlib->getUserData();
        $role      = $result["user_type"];
        $id        = $result["id"];
        ?>
        <div class="content-wrapper">
        <section class="content-header">
        <h1>
        <i class="fa fa-bus"></i> <?php echo $this->lang->line('valuation_Camp'); ?></h1>
        </section>
        <section class="content">
        
        <div class="row">
        
        <?php if ($this->rbac->hasPrivilege('assign_subject', 'can_add')) 
        { 
        ?>
        <div class="col-md-3">
        <div class="box box-primary" >
        <div class="box-header with-border">
        <h3 class="box-title"><?php echo $this->lang->line('valuation_Camp'); ?></h3>
        </div>
        
        
        <form id="form1" action="<?php echo site_url('admin/Valuation/assign_subject') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
        <div class="box-body">
        <?php if ($this->session->flashdata('msg')) { ?>
        <?php echo $this->session->flashdata('msg') ?>
        <?php } ?>
        <?php
        if (isset($error_message)) {
        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
        }
        ?>      
        <?php echo $this->customlib->getCSRF(); ?>
        
        <div class="form-group">
        <label ><?php echo $this->lang->line('title'); ?><small class="req"> *</small></label>
        <select autofocus="" required="required" id="valuation_title" name="valuation_title" class="form-control select2" >
        
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
        
        
            
        
        <div class="form-group">
        <label ><?php echo $this->lang->line('exam') . " " . $this->lang->line('group'); ?><small class="req"> *</small></label>
        <select autofocus="" id="exam_group_id" name="exam_group_id" class="form-control select2" >
        
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
        
        
        
        
        <div class="form-group">  
        <label><?php echo $this->lang->line('exam'); ?><small class="req"> *</small></label>
        <select  id="exam_id" name="exam_id"  class="form-control select2" >
        <option value=""><?php echo $this->lang->line('select'); ?></option>
        </select>
        <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
        </div> 
       
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('staff'); ?></label><small class="req"> *</small>
        <select class="form-control select2" id="staff" name="staff"  >
        <option>Select Staff</option>
        <?php
        foreach($Stafflist as $staf) {
        ?>
        <option value="<?php  echo $staf['id'];  ?>"><?php  echo $staf['name'];  ?></option>
        <?php } ?>
        </select>
        <span class="text-danger"><?php echo form_error('staff'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label><?php echo $this->lang->line('select') . " " . $this->lang->line('subject'); ?></label><small class="req"> *</small>
        <select id="subject" name="subject" class="form-control select2"  >
        </select>
        <span class="text-danger"><?php echo form_error('subject'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('paper'); ?></label><small class="req"> *</small>
        <input type="text"  name="paper" id="paper" class="form-control"  value="<?php echo set_value('paper'); ?>"/>
        <span class="text-danger"><?php echo form_error('paper'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('Bundle_Code'); ?></label>
        <input id="bundle_Code" name="bundle_Code" placeholder="" type="text" class="form-control"  value="<?php echo set_value('bundle_Code'); ?>" />
        <span class="text-danger"><?php echo form_error('bundle_Code'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('assigned'); ?>&nbsp;<?php echo $this->lang->line('date'); ?><?php echo $this->lang->line('time'); ?></label>
        <input type="datetime-local"  name="date" id="date" class="form-control"  value="<?php echo set_value('date'); ?>"/>
        <span class="text-danger"><?php echo form_error('date'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('submission'); ?>&nbsp;<?php echo $this->lang->line('date'); ?><?php echo $this->lang->line('time'); ?></label>
        <input type="datetime-local"  name="submissiondate" id="submissiondate" class="form-control"  value="<?php echo set_value('submissiondate'); ?>"/>
        <span class="text-danger"><?php echo form_error('submissiondate'); ?></span>
        </div>
        
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('count').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('paper'); ?></label>
        <input id="countofpaper" readonly="readonly" name="countofpaper" placeholder="" type="text" class="form-control"  value="<?php echo set_value('countofpaper'); ?>" />
        <span class="text-danger"><?php echo form_error('countofpaper'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?> </label>
        <input id="amount" name="amount" readonly="readonly" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount'); ?>" />
        <span class="text-danger"><?php echo form_error('amount'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('total'); ?> </label>
        <input id="totalamount" name="totalamount" readonly="readonly" placeholder="" type="text" class="form-control"  value="<?php echo set_value('totalamount'); ?>" />
        <span class="text-danger"><?php echo form_error('totalamount'); ?></span>
        </div>
        
        <div class="form-group">
        <label for="exampleInputEmail1"><?php echo $this->lang->line('note'); ?></label>
        <textarea class="form-control" id="note" name="note" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('note'); ?></textarea>
        <span class="text-danger"><?php echo form_error('note'); ?></span>
        </div>
        
        </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
        </div>
        </form>
        </div>
        </div>     
        <?php } ?>    
        <div class="col-md-<?php
        if ($this->rbac->hasPrivilege('assign_subject', 'can_view')) {
        echo "9";
        } else {
        echo "12";
        }
        
        ?>">
            
        <div class="box box-primary" id="vehicle">
        <div class="box-header ptbnull">
        <h3 class="box-title titlefix"><?php echo $this->lang->line('valuation_Camp');  ?></h3>
        
        <div class="mailbox-messages table-responsive"> 
        <br>
        <br>
        <div class="panel panel-default" >
        <div class="panel-heading" role="tab" id="heading">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse" aria-expanded="false"> <label for="collapsible" class="lbl-toggle">Previous Session </label></a>
        </h4>
        </div>
        <div id="collapse" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading">
        <div class="panel-body">
        <table class="table table-striped table-bordered table-hover example">
        <thead>
        <tr>
        <th><?php echo $this->lang->line('session'); ?> </th>    
        <th><?php echo $this->lang->line('staff'); ?> </th>
        <th><?php echo $this->lang->line('code'); ?> </th>
        <th><?php echo $this->lang->line('subject'); ?></th>
        <th><?php echo $this->lang->line('Bundle_Code'); ?></th>
        <th><?php echo $this->lang->line('count').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('paper'); ?></th>
        <th><?php echo $this->lang->line('assigned').''.$this->lang->line('date'); ?></th>
        <th><?php echo $this->lang->line('submission').''.$this->lang->line('date'); ?></th>
        <th><?php echo $this->lang->line('submit').''.$this->lang->line('date'); ?></th>
        
       
        <?php
        if($role!="Teacher") 
        { 
        ?>
        <th><?php echo $this->lang->line('amt').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('remuneration'); ?></th>
        <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($valuation_list_previous)) 
        {
        ?>
        <?php
        } 
        else 
        {
        $count = 1;
        $tot=0;
        $amt=0;
        $grand_prevpapercount=0;
        foreach ($valuation_list_previous as $data_prev) 
        {
        ?>
        <tr>
        <td class="mailbox-name"> <?php echo $data_prev['session']; ?></td>    
        <td class="mailbox-name"> <?php echo $data_prev['staffname']; ?></td>
        <td class="mailbox-name"> <?php echo $data_prev['subjectcode']; ?></td>
        <td class="mailbox-name"><?php echo $data_prev['subjectname']; ?> </td>   
        <td class="mailbox-name"><?php echo $data_prev['valuation_bunblecode']; ?> </td>
        <td class="mailbox-name"><?php echo $data_prev['valuation_countofpaper']; ?></td>
        
        <td>
        <?php
        $str             =   $data_prev['valuation_date'];
        $delimiter       = 'T';
        $words           = explode($delimiter, $str);
        $valuation_date  = $words[0].'&nbsp;&nbsp;'.$words[1];
        echo $valuation_date;
        ?>
        </td>
        
        <td class="mailbox-name">
        <?php
        $str=$data_prev['valuation_submissiondate'];
        $delimiter = 'T';
        $words_prev = explode($delimiter, $str);
        $submissiondate_prev= $words_prev[0].''.$words_prev[1];
        echo $submissiondate_prev;
        ?>
        </td>
        
        

        <td class="mailbox-name">
        <?php
        $stb=$data_prev['valuation_submitted_date'];
        $delimiter = 'T';
        $words_prevsub = explode($delimiter, $stb);
        $submissiondate_prevsub= $words_prevsub[0].''.$words_prevsub[1];
        echo $submissiondate_prevsub;
        ?>
        </td>
        
        
        <?php
        if($role!="Teacher")  { 
        ?>
        <td class="mailbox-name"><?php echo $data_prev['valuation_countofpaper']*$data_prev['valuation_amount']; ?></td>
        <?php } ?>
        </tr>
        <?php
        $totprev+=$data_prev['valuation_countofpaper'];
        $amtprev+=$data_prev['valuation_amount'];
        $grand_prevpapercount+=$data_prev['valuation_countofpaper']*$data_prev['valuation_amount'];
        }
        $count++;
        }
        ?>
        
        
        
        <?php
        if($role!="Teacher")
        { 
        ?>
        <tr style="color:#d23131;font-size:16px;">
        <td class="mailbox-name" ></td>
        <td class="mailbox-name"style="font-weight:bold;"><b><?php echo $this->lang->line('total'); ?></b></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name" ></td>
        <td class="mailbox-name"><b><?php echo $totprev; ?></b></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name" ></td>
        <td class="mailbox-name" ></td>
        <td class="mailbox-name" style="text-align: right;"><i class="fa fa-rupee"></i>&nbsp;<b><?php echo $grand_prevpapercount; ?></td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
        <?php
        $i=1;
        foreach($examgroup_list as $examgroup)
        {
        ?>
        <div class="panel panel-default" >
        <div class="panel-heading" role="tab" id="examgroup<?php  echo $i; ?>">
        <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_exam<?php  echo $i; ?>" aria-expanded="false"> <label for="collapsible" class="lbl-toggle_val"><?php  echo $examgroup['name']; ?> </label></a>
        </h4>
        </div>
        <div id="collapse_exam<?php  echo $i; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="examgroup<?php  echo $i; ?>">
        <div class="panel-body">
        <div class="mailbox-messages table-responsive">                
        <table class="table table-striped table-bordered table-hover example">
        <thead>
        <tr>
        <th>Sl.No</th>   
        <th><?php echo $this->lang->line('exam'); ?> </th> 
        <th><?php echo $this->lang->line('session'); ?> </th>    
        <th><?php echo $this->lang->line('staff'); ?> </th>
        <th><?php echo $this->lang->line('code'); ?> </th>
        <th><?php echo $this->lang->line('subject'); ?></th>
        <th><?php echo $this->lang->line('Bundle_Code'); ?></th>
        <th><?php echo $this->lang->line('count').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('paper'); ?></th> 
        <th ><?php echo $this->lang->line('assigned').''.$this->lang->line('date'); ?></th>
        <th ><?php echo $this->lang->line('submission').''.$this->lang->line('date'); ?></th>
        <th><?php echo $this->lang->line('submit').''.$this->lang->line('date'); ?></th>
        <?php
        if($role!="Teacher") 
        { 
        ?>
        <th><?php echo $this->lang->line('amt').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('remuneration'); ?></th>
        <?php } ?>
        <th class="text-right no-print"><?php echo $this->lang->line('submission').'&nbsp;'.$this->lang->line('status'); ?></th>
        
        <?php
        if($role!="Teacher")  
        { 
        ?>
        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?>
        </th>
        <?php
        }
        ?>
        </tr>
        
        </thead>
        <tbody>
        <?php if (empty($valuation_list_examgroup)) 
        {
        ?>
        <?php
        } 
        else 
        {
        $count = 1;
        $totexamgroup=0;
        $amtexamgroup=0;
        $words_examgroup=0;
        $slno=1;
        $totval=0;
        $grandtotal_examgroup=0;
        foreach ($valuation_list_examgroup as $data_examgroup) 
        {
        if($examgroup['id']==$data_examgroup['valuation_examgroup'])
        {
        ?>
        <tr>
        <td class="mailbox-name"> <?php echo $slno; ?></td>    
        <td class="mailbox-name"> <?php echo $data_examgroup['exam']; ?></td>
        <td class="mailbox-name"> <?php echo $data_examgroup['session']; ?></td>    
        <td class="mailbox-name"> <?php echo $data_examgroup['staffname']; ?></td>
        <td class="mailbox-name"> <?php echo $data_examgroup['subjectcode']; ?></td>
        <td class="mailbox-name"><?php echo $data_examgroup['subjectname']; ?> </td>   
        <td class="mailbox-name"><?php echo $data_examgroup['valuation_bunblecode']; ?> </td>
        <td class="mailbox-name"><?php echo $data_examgroup['valuation_countofpaper']; ?></td>
        
        <td>
        <?php
        $str=$data_examgroup['valuation_date'];
        $delimiter = 'T';
        $words = explode($delimiter, $str);
        $valuation_date= $words[0].'&nbsp;&nbsp;'.$words[1];
        echo $valuation_date;
        ?>
        </td>
        
       
        <td class="mailbox-name">
        <?php
        $str=$data_examgroup['valuation_submissiondate'];
        $delimiter = 'T';
        $words_examgroup = explode($delimiter, $str);
        echo $words_examgroup[0].''.$words_examgroup[1];
        ?>
        </td>
        
        
        <td class="mailbox-name">
        <?php
        $stb=$data_examgroup['valuation_submitted_date'];
        $delimiter = 'T';
        $words_prevsub = explode($delimiter, $stb);
        $submissiondate_prevsub= $words_prevsub[0].''.$words_prevsub[1];
        echo $submissiondate_prevsub;
        ?>
        </td>
        
        
        
        <?php
        if($role!="Teacher") 
        {
        $totval= $data_examgroup['valuation_countofpaper']*$data_examgroup['valuation_amount'];
        ?>
        <td class="mailbox-name"><?php echo $totval; ?></td>
        <?php }
        ?>
        
        <td class="mailbox-name">
        <?php
        if($submissiondate_prevsub!="")
        {
        $sta="Submitted";
        $cls="btn btn-success btn-sm pull-right";
        }
        else
        {
            
        
        if($words_examgroup[0] < date('Y-m-d'))
        {
        $dat1=date_create(date($words_examgroup[0]));
        $dat2=date_create(date('Y-m-d'));
        $dif=date_diff($dat1,$dat2);
        $da= $dif->format("%R%a days");
        $sta=$da.'&nbsp;'."left";
        $cls="btn btn-warning btn-sm pull-right";
        }
        
        // if($words_examgroup[0] < date('Y-m-d'))
        // {
        // $sta="Submitted";
        // $cls="btn btn-success btn-sm pull-right";
        // }
        
        elseif($words_examgroup[0] >= date('Y-m-d'))
        {
        $sta="Over Due";
        $cls="btn btn-danger btn-sm pull-right";
        }
        
        }
        ?>
        
       
        <button type="button"  class="<?php  echo $cls; ?>" ><?php echo $sta;    ?></button>
        </td>
        
        <td class="mailbox-date pull-right no-print">
        
        <?php
        if ($this->rbac->hasPrivilege('assign_subject', 'can_edit')) {
        ?>
        
        <button type="button"  onclick="btnprint('<?php echo $data_examgroup['valuation_id']; ?>')" /><i class="fa fa-print"></i></button>
        <a data-placement="left" href="<?php echo base_url(); ?>admin/Valuation/edit/<?php echo $data_examgroup['valuation_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
        <i class="fa fa-pencil"></i>
        </a>
        <?php 
        } 
        
        if ($this->rbac->hasPrivilege('assign_subject', 'can_delete')) {
        ?>
        <a data-placement="left" href="<?php echo base_url(); ?>admin/Valuation/delete/<?php echo $data_examgroup['valuation_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
        <i class="fa fa-remove"></i>
        </a><?php } 
        ?>
        </td>
        </tr>
        <?php
        $totexamgroup+= $data_examgroup['valuation_countofpaper'];
        $amtexamgroup+= $data_examgroup['valuation_amount'];
        $grandtotal_examgroup+= $data_examgroup['valuation_countofpaper']*$data_examgroup['valuation_amount'];
        $slno++;
        }
       
        $count++;
        }
        ?>
        <?php
        if($role!="Teacher")  
        { 
        ?>
        <tr style="color:#d23131;font-size:16px;">
        <td class="mailbox-name"  ></td>
        <td class="mailbox-name"></td> 
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name" ></td>
        <td class="mailbox-name" style="font-weight:bold;"><b><?php echo $this->lang->line('total'); ?></b></td>
        <td class="mailbox-name"><b><?php echo $totexamgroup; ?></b></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
         <td class="mailbox-name"></td>
        <td class="mailbox-name"style="text-align: left;"><i class="fa fa-rupee"></i>&nbsp;<b><?php echo $grandtotal_examgroup; ?></b></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name" ></td>
        </tr>
        <?php
        } }
        
        ?>
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
        
        <?php
        $i++;
        } 
        ?>
        
        </div>
        
        <div class="box-body">
        <div class="mailbox-controls">                         
        <div class="pull-right">
        </div>
        </div>
        <div class="mailbox-messages table-responsive">
        <br>
        <!--
        <div class="download_label"><?php echo $this->lang->line('valuation_Camp'); ?></div>
        <table class="table table-striped table-bordered table-hover example">
        <thead>
        <tr>
        <th>sl.No </th>    
        <th><?php echo $this->lang->line('staff'); ?> </th>
        <th><?php echo $this->lang->line('code'); ?> </th>
        <th><?php echo $this->lang->line('subject'); ?>
        </th>
        <th><?php echo $this->lang->line('Bundle_Code'); ?></th>
        <th><?php echo $this->lang->line('count').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('paper'); ?>
        <th ><?php echo $this->lang->line('assigned').''.$this->lang->line('date'); ?></th>
        <th ><?php echo $this->lang->line('submission').''.$this->lang->line('date'); ?></th>
        <?php
        if($role!="Teacher")  { 
        ?>
        
        <th><?php echo $this->lang->line('amt').'&nbsp;'.$this->lang->line('of').'&nbsp;'.$this->lang->line('remuneration'); ?></th>
        <?php } ?>
        
        
        <th class="text-right no-print"><?php echo $this->lang->line('submission').'&nbsp;'.$this->lang->line('status'); ?></th>
        
        <?php
        if($role!="Teacher")  { 
        ?>
        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
        <?php } ?>
        
        
        </tr>
        </thead>
        <tbody>
        <?php if (empty($valuation_list)) 
        {
        ?>
        <?php
        } 
        else 
        {
        $count = 1;
        $tot=0;
        $amt=0;
        $grandtotal=0;
        
        $sl=1;
        foreach ($valuation_list as $data) 
        {
        ?>
        <tr>
            
        <td><?php echo $sl; ?></td>
        <td class="mailbox-name"> <?php echo $data['staffname']; ?></td>
        <td class="mailbox-name"> <?php echo $data['subjectcode']; ?></td>
        <td class="mailbox-name"><?php echo $data['subjectname']; ?> </td>   
        <td class="mailbox-name"><?php echo $data['valuation_bunblecode']; ?> </td>
        <td class="mailbox-name"><?php echo $data['valuation_countofpaper']; ?></td>
        <td>
             <?php
                    $str=$data['valuation_date'];
                    $delimiter = 'T';
                    $words = explode($delimiter, $str);
                    $valuation_date= $words[0].'&nbsp;&nbsp;'.$words[1];
                    echo $valuation_date;
                    ?>
        </td>
        <td class="mailbox-name">
        
        <?php
        $granddatatotal=$data['valuation_countofpaper']*$data['valuation_amount'];
        $str=$data['valuation_submissiondate'];
        $delimiter = 'T';
        $words = explode($delimiter, $str);
        
        $submissiondate= $words[0].''.$words[1];
        echo $submissiondate;
        ?>
        </td>
        <?php
        if($role!="Teacher")  { 
        ?>
        <td class="mailbox-name"><?php echo $data['valuation_countofpaper']*$data['valuation_amount']; ?></td>
        <?php } ?>
        
        <td class="mailbox-name">
        <?php
        
         
        
        if($words[0] < date('Y-m-d'))
        {
        $date1=date_create(date($words[0]));
        $date2=date_create(date('Y-m-d'));
        $diff=date_diff($date1,$date2);
        $days= $diff->format("%R%a days");
        $status=$days.'&nbsp;'."left";
        $class="btn btn-warning btn-sm pull-right";
        }
        
        
        
        
        if($words[0] == date('Y-m-d'))
        {
        $status="Submitted";
        $class="btn btn-success btn-sm pull-right";
        }
        elseif($words[0] >= date('Y-m-d'))
        {
           
        $status="Over Due";
        $class="btn btn-danger btn-sm pull-right";
        }
        ?>
        
        <button type="button"  class="<?php  echo $class; ?>" ><?php echo $status;    ?></button>
        </td>
        <td class="mailbox-date pull-right no-print">
        <?php
        if ($this->rbac->hasPrivilege('assign_subject', 'can_edit')) 
        {
        ?>
        <input type="hidden"   name="valuationid" id="valuationid<?php echo $sl; ?>" value="<?php echo $data['valuation_id']; ?>" >
        <button type="button"  onclick="btnprint('<?php echo $sl; ?>')" /><i class="fa fa-print"></i></button>
        <a data-placement="left" href="<?php echo base_url(); ?>admin/Valuation/edit/<?php echo $data['valuation_id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
        <i class="fa fa-pencil"></i>
        </a>
        <?php 
        } 
        if ($this->rbac->hasPrivilege('assign_subject', 'can_delete')) {
        
        ?>
        
        <a data-placement="left" href="<?php echo base_url(); ?>admin/Valuation/delete/<?php echo $data['valuation_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('<?php echo $this->lang->line('delete_confirm') ?>');">
        <i class="fa fa-remove"></i>
        </a>
        
        <?php } ?>
        
        </td>
        </tr>
        
        </tr>
        <?php
        
        $tot+=$data['valuation_countofpaper'];
        $amt+=$data['valuation_amount'];
        $grandtotal+= $data['valuation_countofpaper']*$data['valuation_amount'];
        $sl++;
        }
        $count++;
        }
        ?>
        <?php
        if($role!="Teacher")  
        { 
        ?>
        <tr style="color:#d23131;font-size:16px;">
        <td class="mailbox-name" colspan="4"></td>
     
        <td class="mailbox-name" style="font-weight:bold;"><b><?php echo $this->lang->line('total'); ?></b></td>
        <td class="mailbox-name"><b><?php echo $tot; ?></b></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name" style="text-align: left;"><i class="fa fa-rupee"></i>&nbsp;<b><?php echo $grandtotal; ?></b></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        <td class="mailbox-name"></td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
        -->
        
        </div>
        </div>
        </div>  
        
        </div>
        <div class="row">           
        <div class="col-md-12">
        </div>
        </div> 
        </section>
        </div>
        
        
        <script type="text/javascript">
        function  btnprint(valuationid) 
        {
     
        $.ajax({
        type : "POST",
        url: base_url + "admin/Valuation/printvalue",
        data: {valuationid:valuationid},       
        datatype : 'JSON',
        success:function(data)
        {
        // $("#print_content").html(data);
        var ht = $(window).height();
        var wt = $(window).width();
        var divContents = $("#print_content").html();
        var printWindow = window.open('', '', 'height=' + ht + 'px,width=' + wt + 'px');
        printWindow.document.write('<html><head><title><?php  echo $this->customlib->getAppName(); ?>  </title>');
        printWindow.document.write('<link href="<?=base_url()?>web_assets/css/bootstrap.css" rel="stylesheet" media="screen">  <link href="<?=base_url()?>web_assets/css/custom.css" rel="stylesheet" media="screen">');
        printWindow.document.write('</head><body>');
        printWindow.document.write(data);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print(); 
        },
        });
        }
        
        
        
        $(document).ready(function () {
        
        $("#btnreset").click(function () {
        $("#form1")[0].reset();
        });
        });
        
        var base_url = '<?php echo base_url() ?>';
        
        $(document).on('change', '#exam_group_id', function (e)
        {
        $('#exam_id').html("");
        var exam_group_id = $(this).val();
        getExamByExamgroup(exam_group_id, 0);
        });
        
        
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
        
        
        
            $(document).on('change', '#exam_id', function (e) 
            {
            var exam_id = $(this).val();
            getSubjectByExamgroup(exam_id, 0);
            });
            
            
            $(document).on('change', '#subject', function (e) 
            {
            var valuation_title = $('#valuation_title').val();
            var exam_id         = $('#exam_id').val();
            var subject         = $(this).val();
            tot=0;
            $.ajax({
                type: "POST",
                url: base_url + "admin/valuation/getvaluationtotal",
                data: {exam_id: exam_id,subject:subject,valuation_title:valuation_title},
                dataType: "json",
                success: function (data) 
                {
                $('#countofpaper').val(data.valuation_subject_list_papercount);
                $('#amount').val(data.valuation_subject_list_amount);
                var tot=data.valuation_subject_list_papercount*data.valuation_subject_list_amount
                
                $('#totalamount').val(tot);
                },
            });
            });
            
            
            
            
            
            $(document).on('change', '#subject', function (e) 
            {
            var subject         = $(this).val();
            $.ajax({
            type: "POST",
            url: base_url + "admin/valuation/getsubject_paper",
            data: {subject: subject},
            dataType: "json",
            success: function (data) 
            {
            $('#paper').val(data.subjectpaper_papername + ' ' + data.subjectpaper_papercode);
           
            },
            });
            });

            
            
        
            function getSubjectByExamgroup(exam_id, subject) 
            {
            if (exam_id !== "") {
            $('#subject').html("");
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
                        if (subject === obj.subjectid) {
                            sel = "selected";
                            
                            var sub=obj.subjectid;
                            $('#subjectlist').val(sub);
                        }
                        div_dataa += "<option value=" + obj.subjectid + " " + sel + ">" + obj.subjectid +'-'+ obj.code +'-'+ obj.name + "</option>";

                    });

                    $('#subject').append(div_dataa);
                    $('#subject').trigger('change');
                },
                complete: function () {
                    $('#subject').removeClass('dropdownloading');
                }
            });
            }
            }
            
        </script>