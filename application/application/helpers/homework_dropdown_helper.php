<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('render_subject_dropdown_block')) {

    function render_subject_dropdown_block()
    {
        $html = '';

        // ---- Hidden fields for set_value ----
        $html .= '
        <input type="hidden" id="old_subject_group" value="'.set_value('subject_group').'">
        <input type="hidden" id="old_subject" value="'.set_value('subjects').'">';

        // ------ SUBJECT GROUP DROPDOWN ------
        $html .= '
        <div class="col-md-6">
            <div class="form-group">
                <label>Subject Group <small class="req">*</small></label>
                <select id="subject_group" name="subject_group" class="form-control">
                    <option value="">-- Select Subject Group --</option>
                </select>
            </div>
        </div>';

        // ------ SUBJECT DROPDOWN ------
        $html .= '
        <div class="col-md-6">
            <div class="form-group">
                <label>Subjects <small class="req">*</small></label>
                <select id="subjects" name="subjects" class="form-control">
                    <option value="">-- Select Subject --</option>
                </select>
            </div>
        </div>';

        // ------ JAVASCRIPT ------
        $html .= '
        <script>
        $(document).ready(function() {

            function loadSubjectGroups(sem_group_id) {

                $.ajax({
                    url: "'.base_url("student_nexus/homework/get_subject_groups").'",
                    method: "POST",
                    data: { sem_group_id: sem_group_id },
                    dataType: "json",
                    success: function(subjects){

                        var oldGroup = $("#old_subject_group").val();
                        var options = "<option value=\'\'>-- Select Subject Group --</option>";

                        if(subjects.length > 0){
                            $.each(subjects, function(i, sg){
                                var selected = (sg.id == oldGroup) ? "selected" : "";
                                options += "<option value=\'"+sg.id+"\' "+selected+">"+sg.name+"</option>";
                            });
                        }

                        $("#subject_group").html(options);

                        // auto load subjects if old value exists
                        if(oldGroup){
                            $("#subject_group").trigger("change");
                        }
                    }
                });
            }

            $("#semester").change(function() {

                var sem_value = $(this).val();

                if(!sem_value){
                    $("#subject_group").html("<option value=\'\'>-- Select Subject Group --</option>");
                    $("#subjects").html("<option value=\'\'>-- Select Subject --</option>");
                    return;
                }

                var parts = sem_value.split("|");
                var program_id = $("#program").val();

                if(!program_id){
                    alert("Please select a Program first.");
                    return;
                }

                $.ajax({
                    url: "'.base_url("student_nexus/homework/get_sem_group_id").'",
                    method: "POST",
                    data: {
                        program_id : program_id,
                        semester   : parts[0],
                        batch      : parts[1],
                        term       : parts[2]
                    },
                    dataType: "json",
                    success: function(response){
                        if(response.sem_group_id){
                            loadSubjectGroups(response.sem_group_id);
                        }
                    }
                });
            });

            $("#subject_group").change(function(){

                var subject_group_id = $(this).val();
                var oldSubject = $("#old_subject").val();

                if(!subject_group_id){
                    $("#subjects").html("<option value=\'\'>-- Select Subject --</option>");
                    return;
                }

                $.ajax({
                    url: "'.base_url("student_nexus/homework/get_subjects").'",
                    method: "POST",
                    data: { subject_group_id: subject_group_id },
                    dataType: "json",
                    success: function(subjects){

                        var options = "<option value=\'\'>-- Select Subject --</option>";

                        if(subjects.length > 0){
                            $.each(subjects, function(i, s){
                                var selected = (s.id == oldSubject) ? "selected" : "";
                                options += "<option value=\'"+s.id+"\' "+selected+">"+s.name+"</option>";
                            });
                        }

                        $("#subjects").html(options);
                    }
                });
            });

            // auto trigger on page reload (validation error)
            if($("#semester").val()){
                $("#semester").trigger("change");
            }

        });
        </script>';

        return $html;
    }
}
