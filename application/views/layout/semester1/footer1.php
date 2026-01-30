<!-- ========== FOOTER SECTION ========== -->
    <footer class="footer mt-auto py-4">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted small">
                        © 2025 Semester Portal. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-muted small">
                        Version 1.0.0 | 
                        <a href="#" class="text-decoration-none">Help</a> | 
                        <a href="#" class="text-decoration-none">Support</a> | 
                        <a href="#" class="text-decoration-none">Privacy Policy</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
    
    <!-- Custom Scripts -->
   <script>
        // Sidebar Toggle for Desktop and Mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const contentWrapper = document.querySelector('.content-wrapper');
            const footer = document.querySelector('.footer');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    // On mobile: hide/show full sidebar with text
                    if (window.innerWidth < 992) {
                        sidebar.classList.toggle('show');
                        // Remove minimized class on mobile
                        sidebar.classList.remove('minimized');
                    } 
                    // On desktop: minimize/maximize sidebar (show only icons)
                    else {
                        sidebar.classList.toggle('minimized');
                        
                        // Adjust content and footer margins
                        if (sidebar.classList.contains('minimized')) {
                            contentWrapper.style.marginLeft = '70px';
                            contentWrapper.style.width = 'calc(100% - 70px)';
                            footer.style.marginLeft = '70px';
                        } else {
                            contentWrapper.style.marginLeft = 'var(--sidebar-width)';
                            contentWrapper.style.width = 'calc(100% - var(--sidebar-width))';
                            footer.style.marginLeft = 'var(--sidebar-width)';
                        }
                    }
                });
            }

            // ========== SUBMENU TOGGLE FUNCTIONALITY ==========
            const menuItemsWithSubmenu = document.querySelectorAll('.sidebar-menu > li > a');
            
            menuItemsWithSubmenu.forEach(item => {
                item.addEventListener('click', function(e) {
                    const parentLi = this.parentElement;
                    const submenu = parentLi.querySelector('.submenu');
                    const chevron = this.querySelector('.fa-chevron-down');
                    
                    if (submenu) {
                        e.preventDefault(); // Prevent default link behavior
                        
                        // Close all other submenus
                        document.querySelectorAll('.sidebar-menu > li').forEach(li => {
                            if (li !== parentLi) {
                                li.classList.remove('active');
                                const otherChevron = li.querySelector('.fa-chevron-down');
                                if (otherChevron) {
                                    otherChevron.classList.remove('rot-180');
                                }
                            }
                        });
                        
                        // Toggle current submenu
                        parentLi.classList.toggle('active');
                        
                        // Toggle chevron rotation
                        if (chevron) {
                            chevron.classList.toggle('rot-180');
                        }
                    }
                });
            });
            
            // Close sidebar when clicking outside on mobile only
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 992) {
                    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('show');
                }
            });
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Confirm before logout
        document.querySelectorAll('a[href*="logout"]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to logout?')) {
                    e.preventDefault();
                }
            });
        });

        

                $(function () {
                $('.example').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthChange: true,
                pageLength: 10
                });
                });

    </script>
</body>
</html>