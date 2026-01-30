<!-- Footer -->
    <footer class="footer" id="footer">
        <p class="mb-0">&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const footer = document.getElementById('footer');
            const overlay = document.getElementById('sidebarOverlay');
            const isMobile = window.innerWidth <= 768;
            
            if (isMobile) {
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('active');
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                footer.classList.toggle('expanded');
            }
        }

        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    toggleSidebar();
                }
            });
        });

        // Form submission handler
        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('User added successfully! (This is a demo - no actual data is saved)');
            this.reset();
        });


   
        $(document).on('click', '.menu-toggle', function (e) {
        e.preventDefault();

        let parent = $(this).closest('.menu-item');
        parent.toggleClass('open');
        parent.find('.submenu').slideToggle();
        });


        $('.menu-toggle').on('click', function (e) {           
        e.preventDefault();

        $('.menu-item').not($(this).parent()).removeClass('open').find('.submenu').slideUp();
        $(this).parent().toggleClass('open').find('.submenu').slideToggle();
        });


        </script>


    
</body>
</html>