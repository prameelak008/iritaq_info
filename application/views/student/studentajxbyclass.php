<div class="mailbox-controls" id="clsId">
					
					
                           <table  class="table table-striped table-bordered table-hover student-list" data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">
                                    <thead>
						 <tr>
						 <th>sl.No</th>
						 <th>Admission No</th>
						 <th>Roll No</th>
						 <th>Name</th>
						 <th>Class</th>
						 <th>Section</th>
						 <th>Username</th>
						 <th>Password</th>
						 <th>Mobile</th>
						
						 </tr>
						 </thead>
						 
						 
						 <?php
						 $s=1;
						 foreach($logindetails as $login)
						 {
						 ?>
						 <tr>
						 <td><?php echo  $s;?></td>
						 <td><?php echo $login['admission_no'];?></td>
						 <td><?php echo $login['roll_no'];?></td>
						 <td><?php echo $login['firstname'].'&nbsp;'.$login['middlename'].''.$login['lastname'];?></td>
					     <td><?php echo $login['class'];?></td>
					     <td><?php echo $login['section'];?></td>
						 <td><?php echo $login['username'];?></td>
						 <td><?php echo $login['password'];?></td>
						 <td><?php echo $login['mobileno'];?></td>
						
							 
						
						  <td>
						  <?php
						
					
						 
						
						
						
						  
						  ?>
						 
						 
						 
						 
						  
						
						
						  
						  </td>
						 </tr>
						 
						 
						 
						 <?php $s++; } ?>

						 </table>						 
                          
						  
                        </div>