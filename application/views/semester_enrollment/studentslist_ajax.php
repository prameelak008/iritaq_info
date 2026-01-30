                <div class="mailbox-controls" id="clsId">


                <div class="tab-pane active table-responsive no-padding" >

                <table  class="table table-striped table-bordered table-hover student-list" data-export-title="<?php echo $this->lang->line('student') . " " . $this->lang->line('list'); ?>">
                <thead>
                <tr>
                <th>sl.No</th>
                <th>Admission No</th>
                <th>Roll No</th>
                <th>Name</th>

                <th>Username</th>
                <th>Password</th>
                <th>Mobile</th>

                </tr>
                </thead>


                <?php

                $s=1;
                foreach($studentslist as $login)
                {
                ?>
                <tr>
                <td><?php echo  $s;?></td>
                <td><?php echo $login['admission_no'];?></td>
                <td><?php echo $login['roll_no'];?></td>
                <td><?php echo $login['firstname'].'&nbsp;'.$login['middlename'].''.$login['lastname'];?></td>
                <td><?php echo $login['username'];?></td>
                <td><?php echo $login['password'];?></td>
                <td><?php echo $login['mobileno'];?></td>
                <td>		

                </td>
                </tr>
                <?php $s++; } ?>

                </table>			 

                </div>

                </div>