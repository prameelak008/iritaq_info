<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<<<<<<< HEAD




=======
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
<!-- jQuery -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->



<<<<<<< HEAD
            
            
            
                <script>
                $(document).on('change', '#prog_id', function() 
                {            
                const program_id    = $(this).val();
                const $select       = $('#sem_type');

                if (!program_id) {
                $select.html('<option value="">-- Select Batch & Semester --</option>');
                return;
                }

                $select.prop('disabled', true).html('<option>Loading...</option>');


                $.post(
                "<?= site_url('SemesterAuth/get_semester_batch_by_program'); ?>",
                {
                program_id: program_id
                },
                function(data) {
                let html = '<option value="">-- Select Batch & Semester --</option>';
                let currentMode = '';

                if (data.length > 0) {
                data.forEach(row => {
                if (row.b_mode_name !== currentMode) {
                if (currentMode !== '') html += '</optgroup>';
                currentMode = row.b_mode_name;
                html += `<optgroup label="${currentMode}">`;
                }

                html += `
                <option 
                value="${row.bchsem_id}" 
                data-semterm="${row.semterm_id}">
                ${row.semester_name} - ${row.batch_group_name} - ${row.batch_group_year}
                </option>
                `;
                });
                html += '</optgroup>';
                } else {
                html += '<option value="">No data found</option>';
                }

                $select.html(html).prop('disabled', false);
                },
                'json'
                );
                });
</script>

=======
>>>>>>> d118f7f6c5e54fefb367b87818d22f76b35a5956
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url(); ?>semester_documents/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>semester_documents/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>semester_documents/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>semester_documents/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>semester_documents/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>semester_documents/dist/js/pages/dashboard.js"></script>
</body>
</html>