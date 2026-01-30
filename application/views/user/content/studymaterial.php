<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/lightbox.min.css">
<script src="//cdn.jsdelivr.net/npm/afterglowplayer@1.x"></script>
<meta http-equiv="imagetoolbar" content="no" />

<link rel="stylesheet" href="<?php echo base_url(); ?>backend/css/magnific-popup.css">
<style>

#lightbox
{
cursor:none !important;
}
.lightboxOverlay
{
cursor:none !important;
}
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>



<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-download"></i> <?php echo $this->lang->line('download_center'); ?>         </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('study_material_list'); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"><?php echo $this->lang->line('study_material_list'); ?></div>
                            <table class="table table-striped table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('type'); ?>
                                        </th>
                                        <th><?php echo $this->lang->line('date'); ?>
                                        </th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
								
                                    foreach ($list as $data)
									{
										
                                        ?>
                                        <tr>
										
										
                                            <td class="mailbox-name">
                                                <a href="#" data-toggle="popover" class="detail_popover"><?php echo $data['title'] ?></a>
                                                <div class="fee_detail_popover" style="display: none">
                                                    <?php
                                                    if ($data['note'] == "") {
                                                        ?>
                                                        <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <p class="text text-info"><?php echo $data['note']; ?></p>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td class="mailbox-name"><?php
                                                $type = $data['type'];
                                                echo $this->lang->line($type);
                                                ?></td>
                           <td class="mailbox-name"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($data['date'])) ?></td>
                           <td class="mailbox-date text-right">
						   <?php

							if($data['viewstatus']=='2') 
							{
							?>
							<a data-placement="left" href="<?php echo base_url(); ?>user/content/download/<?php echo $data['file'] ?>"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
							<i class="fa fa-download"></i>
							</a>
							<?php 
							}
							else {
							
							
									
							$extension = pathinfo($data['file'], PATHINFO_EXTENSION);
																								
							if($extension=='mp4' || $extension=='msvideo'|| $extension=='mpeg' || $extension=='x-msvideo' || $extension=='3gpp' || $extension=='webm'||  $extension=='avi' || $extension=='x-ms-wmv' || $extension=='x-ms-asf' || $extension=='quicktime' || $extension=='x-matroska')
							{								
							?>
							
				            <a class="afterglow" href="#myvideo<?php echo $count; ?>"><i style="font-size:20px;" class="fa fa-play-circle"></i>
							<video id="myvideo<?php echo $count; ?>" style="display:none;pointer-events: none;"  width="960" height="540"   >
							<source type="video/<?php echo $extension; ?>"  src="<?php echo base_url(); ?>user/content/download/<?php echo $data['file'];  ?>" />
							</video>
							</a>										
							<?php 
							}									
							elseif($extension=='jpg' || $extension=='png'|| $extension=='jpeg' || $extension=='svg' || $extension=='gif' || $extension=='bmp' || $extension=='JPG' || $extension=='PNG'|| $extension=='JPEG' || $extension=='SVG' || $extension=='GIF' || $extension=='BMP'   )
							{
							?>							
							<a href= 
							"<?php echo base_url(); ?>user/content/download/<?php echo $data['file'] ;  ?>"
							data-lightbox="mygallery" galleryimg="no"   class="services-imgs"  /> 
							<i class="fa fa-image"></i>
							
							</a>							
							<?php
							}
							
								elseif($extension=='txt'  )
							{
							?>
<a href="<?php echo base_url(); ?>user/content/viewtxt/<?php echo $data['id'] ?>" /><i class="fa fa-file-code-o"></i></a>
							
							<?php 
							} 
							
							
							
							
							elseif($extension=='pdf' ||   $extension=='Pdf' )
							{
							?>
					
					<!--<a data-placement="left" frameborder="0" href="<?php echo base_url(); ?>user/content/download/<?php echo $data['file'] ?>"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
							<i class="fa fa-download"></i>

 <iframe src="http://docs.google.com/gview?url=https://islamicelearning.com/uploads/school_content/material/44.pdf&embedded=true" style="width:100px; height:100px;" frameborder="0 id="iframe" style="border: none;" readonly="readonly">
</iframe>




<iframe id="ifrrame"   src="https://islamicelearning.com/uploads/school_content/material/44.pdf#toolbar=0" style="width:1000px; height:1000px;" frameborder="0 id="iframe" style="border: none;" readonly="readonly">
</iframe>



 
 <iframe    src="https://islamicelearning.com/uploads/school_content/material/44.pdf#toolbar=0&embedded=true" style="width:100%; height:100%;" frameborder="0 id="iframe" style="border: none;" readonly="readonly" allowfullscreen>


<a href="https://islamicelearning.com/uploads/school_content/material/44.pdf#toolbar=0" readonly="readonly" target="_blank"><button><i class="fa fa-book"></i></button></a>



-->



	<a href="<?php echo base_url(); ?>user/content/viewpdf/<?php echo $data['id'] ?>" /><i class="fa fa-book"></i></a>
								

<?php
							}
							
							elseif($extension=='docx' || $extension=='ppt' || $extension=='Doc' ||  $extension=='Docx' || $extension=='Ppt' || $extension=='pptx'|| $extension=='xls' || $extension=='xlsx')
							{
							?>

<a href="<?php echo base_url(); ?>user/content/viewdoc/<?php echo $data['id'] ?>" /><i class="fa fa-book"></i></a>



					
							<?php 
							}
							}							
							?>
							
							<?php
							/*
							if($data['viewstatus']=='2') 
							{
							?>
							<a data-placement="left" href="<?php echo base_url(); ?>user/content/download/<?php echo $data['file'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
							<i class="fa fa-download"></i>
							</a>
							<?php 
							}
							*/							
							?>
							</td>
							</tr>
							<?php
							$count++;
							}							
							?>
							</tbody>
								
								
                            </table>
							
							
							
                        </div>
                    </div>
                </div>
            </div>   
        </div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span id="update" onclick="getupdated()">Ok</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
       
       
      </div>
      <div class="modal-body">
         <div class="x_content" >
                 <div class="table-responsive">
       

                        </div>
                        <div class="modal-footer">
                        
                        
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
        <div class="row">
		
            <div class="col-md-12"><div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
  <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
            </div>
        </div>
    </section>
</div>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<script>
jQuery('#iframe').load(function(){
    jQuery('#iframe').contents().find("#toolbar").hide();
});

function getbyrole()
 {
 
$('#myModal').modal("show"); 
}


    $(document).ready(function () {



        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
	
	
	
	

</script> <script src="<?php echo base_url(); ?>backend/dist/js/lightbox-plus-jquery.min.js"></script>