
<?php
if (!empty($subject_list)) {
    ?>
    <div class="table-responsive">    
        <table class="table table-striped table-bordered table-hover example1" id="example">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('subject'); ?></th>
                    <th><?php echo $this->lang->line('date'); ?></th>
                    <th><?php echo $this->lang->line('start') . " " . $this->lang->line('time'); ?></th>
                    <th><?php echo $this->lang->line('end') . " " . $this->lang->line('time'); ?></th>
                    <th><?php echo $this->lang->line('duration'); ?></th>
                    <th><?php echo $this->lang->line('credit') . " " . $this->lang->line('hours'); ?></th>
                    <th><?php echo $this->lang->line('room_no'); ?></th>
                    <th><?php echo $this->lang->line('marks') . " (" . $this->lang->line('max') . ")"; ?></th>
                    <th><?php echo $this->lang->line('marks') . " (" . $this->lang->line('min') . ")"; ?></th>
                    
                     <th><?php echo $this->lang->line('cmarks') . " (" . $this->lang->line('max') . ")"; ?></th>
                     <th><?php echo $this->lang->line('cmarks') . " (" . $this->lang->line('min') . ")"; ?></th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($subject_list as $subjet_key => $subjet_value) {
                    ?>
                    <tr>
                        <td> <?php
                            echo $subjet_value->subject_name;
                            if ($subjet_value->subject_code != '') {
                                echo " (" . $subjet_value->subject_code . ")";
                            }
                            ?></td>

                        <td> <?php echo $this->customlib->dateformat($subjet_value->date_from); ?></td>
                        <!--<td> <?php echo $subjet_value->time_from; ?></td>-->
                        
                        
                        
                        
                        
                        <td> <?php //echo $subjet_value->time_from; ?>
                            


                                                <?php 
                                                // echo $exam_subject_value->time_from; 
                                                
                                                $timefrom= $subjet_value->time_from;
                                                
                                                echo date("g:i a", strtotime($timefrom));
                                                
                                                
                                                ?>
                                                
                                                
                                                </td>
                                                
                                                          <td>
                                                          <?php
                                                   
                                                          $timefrom= $subjet_value->time_from;
                                                          $duration= $subjet_value->duration;
                                                          
                                                          $time = date("H:i:s", strtotime($timefrom));
                                                            
                                                          $time2 = date("H:i:s", strtotime($duration));
                                                            
                                                          $secs = strtotime($time2)-strtotime("00:00:00");
                                                          $result = date("H:i:s",strtotime($time)+$secs);
                                                          //echo $result;
                                                          
                                                          echo date("g:i a", strtotime($result));
                                                          
                                                          
                                                          
                        ?> 
                        </td>
                        <td> <?php echo $subjet_value->duration; ?></td>
                        <td> <?php echo $subjet_value->credit_hours; ?></td>
                        <td> <?php echo $subjet_value->room_no; ?></td>
                        <td> <?php echo $subjet_value->max_marks; ?></td>
                        <td> <?php echo $subjet_value->min_marks; ?></td>
                        <td> <?php echo $subjet_value->max_cmarks; ?></td>
                        <td> <?php echo $subjet_value->min_cmarks; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    }
    ?>
        <script>
        $(document).ready(function() 
        {
        $('#example').dataTable( {
        "aaSorting": [[ 1, "desc" ]]
        } );
        } );
        </script>
