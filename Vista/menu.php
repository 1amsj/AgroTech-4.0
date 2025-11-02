<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="d-flex">
    <nav class="sidebar d-flex flex-column flex-shrink-0 position-fixed">
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </button>

        <div class="p-4">
            <h4 class="logo-text fw-bold mb-0">AgroTech 4.0</h4>
            <p class="text-muted small hide-on-collapse">Menú</p>
        </div>

        <div class="nav flex-column">
            <a href="#" class="sidebar-link active text-decoration-none p-3">
                <i class="fas fa-home me-3"></i>
                <span class="hide-on-collapse">Inicio</span>
            </a>
            <a href="/AgroTech-4.0/Vista/inventario.php" class="sidebar-link text-decoration-none p-3">
                <i class="fas fa-chart-bar me-3"></i>
                <span class="hide-on-collapse">Inventario</span>
            </a>
            <a href="#" class="sidebar-link text-decoration-none p-3">
                <i class="fas fa-users me-3"></i>
                <span class="hide-on-collapse">Salida</span>
            </a>

            <a href="#" class="sidebar-link text-decoration-none p-3">
                <i class="fas fa-box me-3"></i>
                <span class="hide-on-collapse">Seguridad</span>
            </a>
            <a href="#" class="sidebar-link text-decoration-none p-3">
                <i class="fas fa-gear me-3"></i>
                <span class="hide-on-collapse">Reportes</span>
            </a>
        </div>

        <div class="profile-section mt-auto p-4">
            <div class="d-flex align-items-center">
                <img src="https://randomuser.me/api/portraits/women/70.jpg" style="height:60px" class="rounded-circle" alt="Profile">
                <div class="ms-3 profile-info">
                    <h6 class="text-white mb-0">Slilma Juárez</h6>
                    <small class="text-muted">Admin</small>
                </div>
            </div>
        </div>
    </nav>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
    
</div>

  <script src="Assets/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="Assets/js/p_bootstrap.min.js"></script>