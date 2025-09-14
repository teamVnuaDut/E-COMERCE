<script>
    // Toggle sidebar on mobile
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });

    // Toggle user menu
    document.getElementById('userMenuButton').addEventListener('click', function() {
        document.getElementById('userMenu').classList.toggle('hidden');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        // Close sidebar when clicking outside
        if (window.innerWidth < 768 &&
            !sidebar.contains(event.target) &&
            !sidebarToggle.contains(event.target) &&
            sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
        }

        // Close user menu when clicking outside
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenu = document.getElementById('userMenu');

        if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.classList.add('hidden');
        }
    });

    // Close menus when pressing Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.querySelector('.sidebar').classList.remove('active');
            document.getElementById('userMenu').classList.add('hidden');
        }
    });

    // Adjust main content margin on resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            document.querySelector('.sidebar').classList.remove('active');
        }
    });

    // Listen for theme changes
    Livewire.on('themeChanged', (theme) => {
        document.documentElement.className = theme;
        localStorage.setItem('theme', theme);
    });

    // Load theme from localStorage on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.documentElement.className = savedTheme;
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('requiresShippingToggle');
        const shippingFields = document.getElementById('shippingFields');

        toggle.addEventListener('change', function() {
            if (toggle.checked) {
                shippingFields.classList.remove('hidden');
            } else {
                shippingFields.classList.add('hidden');
            }
        });
    });
</script>
<script>
    function toggleSection(id) {
        const el = document.getElementById(id);
        if (el.style.display === 'none' || !el.style.display) {
            el.style.display = 'block';
        } else {
            el.style.display = 'none';
        }
    }

    // Mặc định hiển thị tất cả
    document.addEventListener('DOMContentLoaded', () => {
        ['contact-info', 'address-info', 'payment-info', 'status-info'].forEach(id => {
            document.getElementById(id).style.display = 'block';
        });
    });
</script>
<!-- JS xác nhận xoá -->
<script>
    let supplierIdToDelete = null;

    function openDeleteModal(id) {
        supplierIdToDelete = id;
        document.getElementById('delete-modal').style.display = 'flex';
    }

    function closeDeleteModal() {
        supplierIdToDelete = null;
        document.getElementById('delete-modal').style.display = 'none';
    }

    function confirmDelete() {
        if (supplierIdToDelete) {
            window.livewire.emit('confirmSupplier', supplierIdToDelete);
            closeDeleteModal();
        }
    }
</script>
