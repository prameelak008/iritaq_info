            </div>
            </div>

            <footer class="main-footer">
            &copy;  <?php echo date('Y'); ?>
            <?php echo $this->customlib->getAppName(); ?>
            </footer>
            <div class="control-sidebar-bg"></div>
            </div>
            <script>
            // $.widget.bridge('uibutton', $.ui.button);
            </script>
            <?php
            $language      = $this->customlib->getLanguage();
            $language_name = $language["short_code"];
            ?>
            <link href="<?php echo base_url(); ?>backend/toast-alert/toastr.css" rel="stylesheet"/>
            <script src="<?php echo base_url(); ?>backend/toast-alert/toastr.js"></script>
            <script src="<?php echo base_url(); ?>backend/bootstrap/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/select2/select2.min.css">
            <script src="<?php echo base_url(); ?>backend/plugins/select2/select2.full.min.js"></script>
            <script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.js"></script>
            <script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
            <script src="<?php echo base_url(); ?>backend/plugins/input-mask/jquery.inputmask.extensions.js"></script>
            <script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
            <script src="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker.js"></script>
            <script src="<?php echo base_url(); ?>backend/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
            <script src="<?php echo base_url(); ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
            <script src="<?php echo base_url(); ?>backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
            <script src="<?php echo base_url(); ?>backend/dist/js/jquery.mCustomScrollbar.concat.min.js"></script>
            <script type="text/javascript">
            $('body').tooltip({
            selector: '[data-toggle]',
            trigger: 'click hover',
            placement: 'top',
            delay: {
            show: 50,
            hide: 400
            }
            })
            </script>
            <!--language js-->
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/bootstrap-select.min.js"></script>

            <script type="text/javascript">

            $('.select2').select2({});
            $(function () {
            $('.languageselectpicker').selectpicker();
            });
            </script>


            <script type="text/javascript">
            $(document).ready(function () {
            $(".studentsidebar").mCustomScrollbar({
            theme: "minimal"
            });

            $('.studentsideclose, .overlay').on('click', function () {
            $('.studentsidebar').removeClass('active');
            $('.overlay').fadeOut();
            });

            $('#sidebarCollapse').on('click', function () {
            $('.studentsidebar').addClass('active');
            $('.overlay').fadeIn();
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            });
            </script>


            <script src="<?php echo base_url(); ?>backend/plugins/iCheck/icheck.min.js"></script>
            <script src="<?php echo base_url(); ?>backend/plugins/datepicker/bootstrap-datepicker.js"></script>
            <?php
            if ($language_name != 'en') {
            ?>
            <script src="<?php echo base_url(); ?>backend/plugins/datepicker/locales/bootstrap-datepicker.<?php echo $language_name ?>.js"></script>

            <?php }?>
            <script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>

            <script src="<?php echo base_url(); ?>backend/plugins/chartjs/Chart.min.js"></script>
            <script src="<?php echo base_url(); ?>backend/plugins/fastclick/fastclick.min.js"></script>
            <script src="<?php echo base_url(); ?>backend/dist/js/app.min.js"></script>
            <!--nprogress-->
            <script src="<?php echo base_url(); ?>backend/dist/js/nprogress.js"></script>
            <!--file dropify-->
            <script src="<?php echo base_url(); ?>backend/dist/js/dropify.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/dataTables.buttons.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/jszip.min.js"></script>
            <!--<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/pdfmake.min.js"></script>-->
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/vfs_fonts.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.html5.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.print.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/buttons.colVis.min.js" ></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/dataTables.responsive.min.js" ></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/datatables/js/ss.custom.js" ></script>
            <script src="<?php echo base_url(); ?>backend/dist/datatables/js/datetime-moment.js"></script>







            <!-- your sidebar HTML here -->
            <!------------------Different From Other---------------------------------->
            <script>
            document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById('sibe-box');

            // Restore scroll
            const savedScroll = sessionStorage.getItem('sibeScroll');
            setTimeout(() => {
            if (savedScroll !== null && sidebar) {
            sidebar.scrollTop = parseInt(savedScroll, 10);
            console.log('Restored scroll:', savedScroll);
            }
            }, 100);

            // Save scroll on link click
            if (sidebar) {
            const links = sidebar.querySelectorAll('a');
            links.forEach(link => {
            link.addEventListener('click', () => {
            console.log('Saving scroll:', sidebar.scrollTop);
            sessionStorage.setItem('sibeScroll', sidebar.scrollTop);
            });
            });
            }
            });
            </script>











            <script src="<?php echo base_url() ?>backend/fullcalendar/dist/fullcalendar.min.js"></script>
            <script src="<?php echo base_url() ?>backend/fullcalendar/dist/locale-all.js"></script>
            <?php if ($language_name != 'en') {?>
            <script src="<?php echo base_url() ?>backend/fullcalendar/dist/locale/<?php echo $language_name ?>.js"></script>
            <?php }?>
            <script type="text/javascript">
            function complete_event(id, status) {
            $.ajax({
            url: "<?php echo site_url("admin/calendar/markcomplete/") ?>" + id,
            type: "POST",
            data: {id: id, active: status},
            dataType: 'json',
            success: function (res)
            {
            if (res.status == "fail") {
            var message = "";
            $.each(res.error, function (index, value) {

            message += value;
            });
            errorMsg(message);

            } else {
            successMsg(res.message);
            window.location.reload(true);
            }
            }
            });
            }

            function markc(id) {
            $('#newcheck' + id).change(function () {
            if (this.checked) {
            complete_event(id, 'yes');
            } else {
            complete_event(id, 'no');
            }
            });
            }

            </script>


            <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="row">
            <div class="modal fade" id="sessionModal" tabindex="-1" role="dialog" aria-labelledby="sessionModalLabel">
            <form action="<?php echo site_url('admin/admin/activeSession') ?>" id="form_modal_session" class="">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="sessionModalLabel"><?php echo $this->lang->line('session'); ?></h4>
            </div>
            <div class="modal-body sessionmodal_body pb0">
            </div>
            <div class="modal-footer">
            <div class="col-md-12">
            <button type="button" class="btn btn-primary submit_session" data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo $this->lang->line('please_wait'); ?>"><?php echo $this->lang->line('save'); ?></button>
            </div>
            </div>
            </div>
            </div>
            </form>
            </div>
            </div>


            <?php //$this->load->view('layout/routine_update');?>
            <?php // $this->load->view('layout/addon_update');?>

            <script type="text/javascript">
            var calendar_date_time_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'DD', 'm' => 'MM', 'M' => 'MMM', 'Y' => 'YYYY']) ?>';

            var datetime_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(true, true), ['d' => 'DD', 'm' => 'MM', 'Y' => 'YYYY', 'H' => 'hh', 'i' => 'mm']) ?>';

            var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy', 'M' => 'M']) ?>';


            function savedata(eventData) {
            var base_url = '<?php echo base_url() ?>';
            $.ajax({
            url: base_url + 'admin/calendar/saveevent',
            type: 'POST',
            data: eventData,
            dataType: "json",
            success: function (msg) {
            alert(msg);

            }
            });
            }

            $calendar = $('#calendar');
            var base_url = '<?php echo base_url() ?>';
            today = new Date();
            y = today.getFullYear();
            m = today.getMonth();
            d = today.getDate();
            var viewtitle = 'month';
            var pagetitle = "<?php
            if (isset($title)) {
            echo $title;
            }
            ?>";

            if (pagetitle == "Dashboard") {

            viewtitle = 'agendaWeek';
            }

            $calendar.fullCalendar({
            viewRender: function (view, element) {

            },

            header: {
            center: 'title',
            right: 'month,agendaWeek,agendaDay',
            left: 'prev,next,today'
            },
            firstDay: start_week,
            defaultDate: today,
            defaultView: viewtitle,
            selectable: true,
            selectHelper: true,
            views: {
            month: {// name of view
            titleFormat: 'MMMM YYYY'
            // other view-specific options here
            },
            week: {
            titleFormat: " MMMM D YYYY"
            },
            day: {
            titleFormat: 'D MMM, YYYY'
            }
            },
            timezone: 'UTC',
            draggable: false,
            lang: '<?php echo $language_name ?>',
            editable: false,
            eventLimit: false, // allow "more" link when too many events

            // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
            events: {
            url: base_url + 'admin/calendar/getevents'

            },

            eventRender: function (event, element) {
            element.attr('title', event.title);
            element.attr('onclick', event.onclick);
            element.attr('data-toggle', 'tooltip');
            if ((!event.url) && (event.event_type != 'task')) {
            element.attr('title', event.title + '-' + event.description);
            element.click(function () {
            view_event(event.id);
            });
            }
            },
            dayClick: function (date, jsEvent, view) {
            console.log('Clicked on the entire day: ' + date.format());


            <?php if ($this->rbac->hasPrivilege('calendar_to_do_list', 'can_add')) {?>
            var newEventModal= $('#newEventModal');
            $("#input-field").val('');
            $("#desc-field").text('');
            var event_start_from = new Date(date);
            console.log(event_start_from);
            $('.event_from',newEventModal).data("DateTimePicker").date(event_start_from);
            $('.event_to',newEventModal).data("DateTimePicker").date(event_start_from);
            $('#newEventModal').modal('show');

            <?php
            }?>
            return false;
            }

            });

            function view_event(id) {

            $('.selectevent').find('.cpicker-big').removeClass('cpicker-big').addClass('cpicker-small');
            var base_url = '<?php echo base_url() ?>';
            if (typeof (id) == 'undefined') {
            return;
            }
            $.ajax({
            url: base_url + 'admin/calendar/view_event/' + id,
            type: 'POST',
            //data: '',
            dataType: "json",
            success: function (msg) {


            $("#event_title").val(msg.event_title);
            $("#event_desc").text(msg.event_description);

            $("#event_holiday").text(msg.event_holiday);

            $('#eventid').val(id);




            if(msg.is_activeholiday==1)
            {
            $("#evischeckholiday").prop("checked", true);
            }


            if (msg.event_type == 'public') {

            $('input:radio[name=eventtype]')[0].checked = true;

            } else if (msg.event_type == 'private') {
            $('input:radio[name=eventtype]')[1].checked = true;

            } else if (msg.event_type == 'sameforall') {
            $('input:radio[name=eventtype]')[2].checked = true;

            } else if (msg.event_type == 'protected') {
            $('input:radio[name=eventtype]')[3].checked = true;

            }
            //===========

            var __viewModal=$('#viewEventModal');
            var event_start_from = new Date(msg.start_date);
            $('.event_from',__viewModal).data("DateTimePicker").date(event_start_from);

            var event_end_to = new Date(msg.end_date);
            $('.event_to',__viewModal).data("DateTimePicker").date(event_end_to);
            //============

            $("#event_color").val(msg.event_color);
            $("#delete_event").attr("onclick", "deleteevent(" + id + ",'Event')");
            $("#" + msg.colorid).removeClass('cpicker-small').addClass('cpicker-big');
            $('#viewEventModal').modal('show');
            }
            });

            }

            $(document).ready(function (e) {
            $("#addevent_form").on('submit', (function (e) {

            e.preventDefault();
            $.ajax({
            url: "<?php echo site_url("admin/calendar/saveevent") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (res)
            {

            if (res.status == "fail") {

            var message = "";
            $.each(res.error, function (index, value) {

            message += value;
            });
            errorMsg(message);

            } else {

            successMsg(res.message);

            window.location.reload(true);
            }
            }
            });
            }));


            });


            $(document).ready(function (e) {
            $("#updateevent_form").on('submit', (function (e) {

            e.preventDefault();
            $.ajax({
            url: "<?php echo site_url("admin/calendar/updateevent") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (res)
            {

            if (res.status == "fail") {

            var message = "";
            $.each(res.error, function (index, value) {

            message += value;
            });
            errorMsg(message);

            } else {

            successMsg(res.message);
            window.location.reload(true);
            }
            }
            });
            }));

            });

            function deleteevent(id, msg) {
            if (typeof (id) == 'undefined') {
            return;
            }
            if (confirm("<?php echo $this->lang->line('are_you_sure_to_delete_this'); ?> ")) {
            $.ajax({
            url: base_url + 'admin/calendar/delete_event/' + id,
            type: 'POST',
            dataType: "json",
            success: function (res) {
            if (res.status == "fail") {
            errorMsg(res.message);
            } else {
            successMsg(msg + " <?php echo $this->lang->line('delete_message'); ?>");
            window.location.reload(true);
            }
            }
            })
            }
            }

            $("body").on('click', '.cpicker', function () {
            var color = $(this).data('color');
            // Clicked on the same selected color
            if ($(this).hasClass('cpicker-big')) {
            return false;
            }

            $(this).parents('.cpicker-wrapper').find('.cpicker-big').removeClass('cpicker-big').addClass('cpicker-small');
            $(this).removeClass('cpicker-small', 'fast').addClass('cpicker-big', 'fast');
            if ($(this).hasClass('kanban-cpicker')) {
            $(this).parents('.panel-heading-bg').css('background', color);
            $(this).parents('.panel-heading-bg').css('border', '1px solid ' + color);
            } else if ($(this).hasClass('calendar-cpicker')) {
            $("body").find('input[name="eventcolor"]').val(color);
            }
            });

            $(document).ready(function () {
            moment.locale('en', {
            week: { dow: start_week }
            });

            $("body").delegate(".date", "focusin", function () {
            $(this).datepicker({
            todayHighlight: false,
            format: date_format,
            autoclose: true,
            weekStart : start_week,
            language: '<?php echo $language_name ?>'
            });
            });

            $("body").delegate(".datetime", "focusin", function () {
            $(this).datetimepicker({
            format: calendar_date_time_format + ' hh:mm a',
            locale:'<?php echo $language_name ?>',

            });
            });

            $('body').on('focus',".date_fee", function(){
            $(this).datepicker({
            format: date_format,
            autoclose: true,
            language: '<?php echo $language_name; ?>',
            endDate: '+0d',
            weekStart : start_week,
            todayHighlight: true
            });
            });

            $('.datetime_twelve_hour').datetimepicker({
            format:  calendar_date_time_format + ' hh:mm a'
            });


            $("#event_date").daterangepicker({
            timePickerIncrement: 5,
            locale: {
            format: calendar_date_time_format
            }
            });


            ///================

            $('.event_from').datetimepicker({
            format:  calendar_date_time_format + ' hh:mm a'
            });

            $('.event_to').datetimepicker({
            format:  calendar_date_time_format + ' hh:mm a'
            });
            //==============


            });

            function loadDate() {

            var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy']) ?>';

            $('.date').datetimepicker({
            format: datetime_format,
            locale:
            '<?php echo $language_name ?>',

            });
            }

            // showdate('this_year');

            function showdate(type) {

            <?php
            if (isset($_POST['date_from']) && $_POST['date_from'] != '' && isset($_POST['date_to']) && $_POST['date_to'] != '') {
            ?>
            var date_from = '<?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->datetostrtotime($_POST['date_from'])); ?>';
            var date_to = '<?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->datetostrtotime($_POST['date_to'])); ?>';


            <?php
            } else {
            ?>
            var date_from = '<?php echo date($this->customlib->getSchoolDateFormat()); ?>';
            var date_to = '<?php echo date($this->customlib->getSchoolDateFormat()); ?>';
            <?php
            }
            ?>

            if (type == 'period') {

            $.ajax({
            url: base_url + 'Report/get_betweendate/' + type,
            type: 'POST',
            data: {date_from: date_from, date_to: date_to},
            success: function (res) {

            $('#date_result').html(res);

            loadDate();
            }

            });

            } else {
            $('#date_result').html('');
            }

            }


            ////////////////////////Updation

            function doconfirm() 
            {
            var job = confirm('Do you want to delete?');
            if (job) {
            alert('Deleted successfully!');
            return true;
            } else {
            return false;
            }
            }


            function do_confirm() 
            {
            return confirm("Do you want to delete?");
            }


            function validatedate() 
            { 
            const fromDateInput = document.getElementsByClassName('date_betweenfrom')[0];
            const toDateInput   = document.getElementsByClassName('date_betweento')[0];
            const fromDateStr   = fromDateInput.value;
            const toDateStr     = toDateInput.value;

            const fromDate      = convertToDate(fromDateStr);
            const toDate        = convertToDate(toDateStr);

            // Reset disabled state each time
            toDateInput.disabled = false;

            if (!fromDate || !toDate)
            {
            return false;
            }

            if (toDate < fromDate) 
            {
            alert("To date should not be less than From date.");
            toDateInput.value = '';
            toDateInput.disabled = true;
            return false;
            }
            return true;
            }

            document.getElementsByClassName('date_betweenfrom')[0].addEventListener('change', function () {
            document.getElementsByClassName('date_betweento')[0].disabled = false;
            }); 


            function convertToDate(dateStr) {
            // Assumes format: dd-MMM-yyyy (e.g. 21-Jun-2025)
            const parts = dateStr.trim().split('-');
            if (parts.length !== 3) return null;

            const day = parseInt(parts[0], 10);
            const monthStr = parts[1].toLowerCase();
            const year = parseInt(parts[2], 10);

            const monthNames = {
            jan: 0, feb: 1, mar: 2, apr: 3, may: 4, jun: 5,
            jul: 6, aug: 7, sep: 8, oct: 9, nov: 10, dec: 11
            };

            const month = monthNames[monthStr];
            if (month === undefined || isNaN(day) || isNaN(year)) return null;

            return new Date(year, month, day);
            }

            </script>




            <script>
            $(document).ready(function () 
            {
            // Fix overflow issue on page load
            $('.studentsidebar').css('overflow', '').css('overflow-y', 'auto');
            // Optional: If the sidebar opens via button or menu
            $('#sidebarCollapse').on('click', function () {
            $('.studentsidebar').css('overflow', '').css('overflow-y', 'auto');
            });
            });


            $(document).ready(function () {
            var flashMsg = $('#footer-flash .alert');
            if (flashMsg.length > 0) {
            flashMsg.css({
            position: 'fixed',
            top: '20px',
            right: '-400px',
            zIndex: 9999,
            minWidth: '300px'
            }).animate({ right: '20px' }, 500);

            setTimeout(function () {
            flashMsg.animate({ right: '-400px' }, 500, function () {
            $(this).remove();
            });
            }, 3000);

            flashMsg.on('click', '.close', function () {
            $(this).closest('.alert').animate({ right: '-400px' }, 500, function () {
            $(this).remove();
            });
            });
            }
            });


            // $(document).ready(function () {
            // $('input, textarea, select').on('keyup change', function () {       
            // var fieldId = $(this).attr('id');
            // if (!fieldId) {
            // console.log("No ID found on this element:", this);
            // } else {
            // console.log("Changed field:", fieldId);
            // $('#form_error_' + fieldId).text('');
            // $('#' + fieldId + '_error').text('');
            // }
            // });
            // });



            /////Disappear message

            (function ($) {
            // Assign IDs to error spans based on input/select/textarea id/name
            function assignErrorIds(ctx) {
            $('input, textarea, select', ctx || document).each(function () {
            var $field = $(this);
            var key = getFieldKey($field);
            if (!key) return;

            var $err = $field.closest('.form-group').find('span.text-danger').first();
            if ($err.length && !$err.attr('id')) {
            $err.attr('id', 'form_error_' + key);
            }
            });
            }

            function getFieldKey($el) {
            var id = $el.attr('id');
            if (id && id.trim() !== '') return id;

            var name = $el.attr('name');
            if (!name) return null;

            // Extract last simple token: data[field] -> field, users[0][email] -> email
            var parts = name.match(/[A-Za-z0-9_]+(?=\]|\b)/g);
            return parts ? parts[parts.length - 1] : null;
            }

            // Clear/hide error messages for the active field
            function clearFieldError($el) {
            var key = getFieldKey($el);
            if (!key) return;

            $('#form_error_' + key).text('').hide();
            $('#' + key + '_error').text('').hide(); // if you use this pattern elsewhere
            // Fallback within the group
            $el.closest('.form-group').find('span.text-danger').text('').hide();
            }

            $(function () {
            // Initial pass on page load
            assignErrorIds(document);

            // Re-run after any AJAX completes (for dynamically injected forms)
            $(document).ajaxComplete(function (_e, _xhr, opts) {
            assignErrorIds(document);
            });

            // If you use Bootstrap modals or tabs to load forms, also hook those:
            $(document).on('shown.bs.modal shown.bs.tab', function (e) {
            var target = $(e.target);
            assignErrorIds(target);
            });

            // Clear on input/change
            $(document).on('input change', 'input, textarea, select', function () {
            clearFieldError($(this));
            });

            // Clear on Enter press (does not block submit)
            $(document).on('keydown', 'input, textarea, select', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
            clearFieldError($(this));
            }
            });
            });
            })(jQuery);




            $(document).ready(function() {
            $('#resetBtn').click(function () {  

            $('.common-reset-form')[0].reset();
            window.location.href = window.location.href; 
            });
            });


            $(document).ready(function () {
            $('#resetButton').click(function () 
            {             
            window.location.href = "<?php echo base_url(); ?>admin/enquiry";
            });
            }); 

            </script>


            <script>

            //Disable past Date
            $(document).ready(function () 
            {
            $('.valid-future-date').datepicker({
            format: 'dd-mm-yyyy', // match your format
            startDate: new Date(), // disable past
            autoclose: true,
            todayHighlight: true
            });
            });


            //Disable Future date

            $(document).ready(function () {
            $('.invalid-future-date').datepicker({
            format: 'dd-mm-yyyy', // match your format
            endDate: new Date(), // disable past
            autoclose: true,
            todayHighlight: true
            });
            });



            $(document).ready(function () {

            <?php
            if ($this->session->flashdata('success_msg')) {
            ?>
            successMsg("<?php echo $this->session->flashdata('success_msg'); ?>");
            <?php
            }

            else if ($this->session->flashdata('error_msg')) {
            ?>
            errorMsg("<?php echo $this->session->flashdata('error_msg'); ?>");
            <?php
            }
            else if ($this->session->flashdata('warning_msg')) {
            ?>
            infoMsg("<?php echo $this->session->flashdata('warning_msg'); ?>");
            <?php
            }

            else if ($this->session->flashdata('info_msg')) {
            ?>
            warningMsg("<?php echo $this->session->flashdata('info_msg'); ?>");
            <?php
            }

            ?>
            });



  
  
/////Get Batch like - Batch-2023, Batch-2024 without Type....
            $(document).on('change', '#progm_id', function () 
            { 
                                         
            const program_id = $(this).val();
            const $select = $('#batch_type');

            if (!program_id) {
            $select.html('<option value="">-- Select Batch --</option>');
            return;
            }

            $select.prop('disabled', true)
                .html('<option value="">Loading...</option>');

            $.post(
            "<?php echo site_url('semester/assignsubjects/get_batchtype'); ?>",
            { program_id: program_id },
            function (data) {

                let html = '<option value="">-- Select Batch --</option>';
                let currentMode = '';

                if (data && data.length > 0) {

                    data.forEach(row => {

                        // NEW MODE → NEW OPTGROUP
                        if (row.b_mode_name !== currentMode) {
                            if (currentMode !== '') html += '</optgroup>';
                            currentMode = row.b_mode_name || 'Others';
                            html += `<optgroup label="${currentMode}">`;
                        }

                        html += `
                            <option value="${row.b_id}">
                                ${row.batch_group_name}
                            </option>
                        `;
                    });

                    html += '</optgroup>';
                } else {
                    html += '<option value="">No batch found</option>';
                }

                $select.html(html).prop('disabled', false);

                // on edit display batch_type
                  if (typeof editBatchData !== 'undefined' && editBatchData && editBatchData.b_id) {
                $select.val(editBatchData.b_id).trigger('change');  
            }
            },
            'json'
            );
            }); 
            
            

            
            




        ///////////Get Batch & Semester
        // $('#program').on('change', function () 
        // {              
        // const program_id = $(this).val();
        // const $select    = $('#batchtype_id');

        // if (!program_id) {
        // $select.html('<option value="">-- Select Batch & Semester --</option>');
        // return;
        // }

        // $select.prop('disabled', true)
        // .html('<option value="">Loading...</option>');

        // $.post(
        // "<?php echo site_url('semester/assignsubjects/get_batch_semester_by_program'); ?>",
        // { program_id: program_id },
        // function (data) {

        // // if (!data || !data.length) {
        // // $select.html('<option value="">No data found</option>');
        // // return;
        // // }

        // let html = '<option value="">-- Select Batch & Semester --</option>';
        // let currentMode = '';

        // data.forEach(row => {

        // // Create new optgroup when mode changes
        // if (row.b_mode_name !== currentMode) {
        // if (currentMode !== '') html += '</optgroup>';
        // currentMode = row.b_mode_name || 'Others';
        // html += `<optgroup label="${currentMode}">`;
        // }

        // // html += `
        // // <option value="${row.bchsem_id}">
        // // ${row.stm_name} – ${row.batch_group_name} ${row.batch_group_year}
        // // </option>
        // // `;

        // html += `
        // <option 
        // value="${row.bchsem_id}" 
        // data-semterm-id="${row.semterm_id}">
        // ${row.stm_name} – ${row.batch_group_name} ${row.batch_group_year}
        // </option>
        // `;

        // });

        // html += '</optgroup>';

        // $select.html(html).prop('disabled', false);

        


        // },
        // 'json'
        // ).fail(function () {
        // $select.html('<option value="">Error loading data</option>');
        // });

        // });


       





            // $('#program').on('change', function () {
            // const program_id = $(this).val();
            // const $batchSelect = $('#batchtype_id');

            // // Reset
            // $batchSelect
            // .prop('disabled', true)
            // .html('<option value="">-- Select Program First --</option>');

            // if (!program_id) return;

            // $batchSelect.html('<option value="">Loading batches...</option>');

            // $.ajax({
            // url: "<?php echo site_url('semester/assignsubjects/get_batch_by_program'); ?>",
            // type: "POST",
            // data: { program_id },
            // dataType: "json",
            // success: function (data) {

            // if (!Array.isArray(data) || data.length === 0) {
            // $batchSelect.html('<option value="">No batches found</option>');
            // return;
            // }

            // let grouped = {};
            // let html = '<option value="">-- Select Batch --</option>';

            // // Group by mode
            // data.forEach(batch => {
            // const mode = batch.b_mode_name || 'Others';
            // grouped[mode] = grouped[mode] || [];
            // grouped[mode].push(batch);
            // });

            // // Build options
            // $.each(grouped, function (mode, batches) {
            // html += `<optgroup label="${mode}">`;
            // batches.forEach(batch => {
            // html += `
            // <option value="${batch.b_id}" data-bbid="${batch.b_bid}">
            // ${batch.batch_group_name} - ${batch.batch_group_year}
            // </option>`;
            // });
            // html += '</optgroup>';
            // });

            // $batchSelect.html(html).prop('disabled', false);
            // },
            // error: function () {
            // $batchSelect.html('<option value="">Error loading batches</option>');
            // }
            // });
            // });






            // $('#batchtype_id').on('change', function () 
            // {  

            // var batch_id       = $(this).val();
            // var semesterSelect = $('#semester_term');

            // var b_id  = $(this).val(); 
            // var b_bid = $(this).find(':selected').data('bbid'); 


            // $.ajax({
            // url: "<?php echo site_url('semester/assignsubjects/get_semester_by_batch'); ?>",
            // type: "POST",
            // data: { batch_id: batch_id, b_bid: b_bid },
            // dataType: "json",
            // success: function (data) {

            // let $semester = $('#semester_term');
            // $semester.empty(); // clear old options
            // $semester.append('<option value="">-- Select Semester Term --</option>');

            // if (data && data.length > 0) {
            // $.each(data, function (index, row) {
            // $semester.append(
            // '<option value="' + row.bchsem_id + '">' + row.stm_name + '</option>'
            // );
            // });
            // } else {
            // $semester.append('<option value="">No semester found</option>');
            // }
            // }
            // });
            // });            


            </script>

            <!-- <div id="footer-flash">
            <?php if ($this->session->flashdata('msg')): ?>
            <div class="alert alert-success custom-flash">
            <button type="button" class="close" aria-label="Close">&times;+</button>
            <strong></strong><?php echo  $this->session->flashdata('msg');?>
            </div>
            <?php endif; ?>
            </div>

            <div id="footer-flash">
            <?php if (isset($error_message)): ?>
            <div class="alert alert-danger custom-flash">
            <button type="button" class="close" aria-label="Close">&times;</button>
            <strong></strong> <?php echo $error_message; ?>
            </div>
            <?php endif; ?>
            </div>  -->
            

            </body>
            </html>



            



