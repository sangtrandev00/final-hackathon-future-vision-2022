<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    
    <?php if(isset($_SESSION['login']) && $_SESSION['login']['roleid']==1) { ?>
    <!-- Navadmin -->
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quản lý Admin</span>
        </a>
        <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="../user/index_admin.php">Danh sách User</a>
                <a class="collapse-item" href="../user/add.php">Thêm User</a>
                <a class="collapse-item" href="../categories/index.php">Danh mục Dự án</a>
                <a class="collapse-item" href="../project/index_admin.php">Danh sách Dự án</a>
                <a class="collapse-item" href="../disbursement/index_admin.php">Danh sách Giải ngân</a>
            </div>
        </div>
    </li>
    <?php } ?>

    <?php if(isset($_SESSION['login']) && ($_SESSION['login']['roleid']==2)) { ?>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
            <i class="fab fa-stack-overflow"></i>
            <span>Quản lý Dự án</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="../user/index_subadmin.php">Duyệt Mod</a>
                <a class="collapse-item" href="../project/index_subadmin.php">Duyệt Dự án</a>
                <a class="collapse-item" href="../disbursement/index_subadmin.php">Duyệt Giải ngân</a>
            </div>
        </div>
    </li>
    <?php } ?>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
            <i class="fas fa-file-alt"></i>
            <span>Dự án của tôi</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="../project/add.php">Thêm Dự Án</a>
                <a class="collapse-item" href="../project/index.php">Dự án của tôi</a>
                <a class="collapse-item" href="../disbursement/index.php">Giải ngân dự án của tôi</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
            <i class="far fa-address-card"></i>
            <span>Tài khoản</span>
        </a>
        <div id="collapse4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="#">Thông tin cá nhân</a>
                <a class="collapse-item" href="#">Đổi mật khẩu</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->