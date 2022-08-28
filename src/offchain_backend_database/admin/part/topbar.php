<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <?php if (isset($_SESSION['login']) && ($_SESSION['login']['roleid'] == 1 || $_SESSION['login']['roleid'] == 2)) { ?>
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-check"></i>
                    <!-- Counter - Alerts -->
                    <?php
                    include_once "../../lib/Database.php";
                    $db = new Database;
                    $sql = "select count(seen) from user where seen=0";
                    $db->query($sql);
                    $row = $db->fetch_assoc();
                    if ($row['count(seen)'] != 0) {
                    ?>
                        <span class="badge badge-danger badge-counter"><?php echo $row['count(seen)'] > 99 ? "99+" : $row['count(seen)'] ?></span>
                    <?php } ?>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Alerts Center
                    </h6>
                    <?php
                    if ($row['count(seen)'] != 0) {
                        $db01 = new Database;
                        $sql01 = "select * from user where seen=0";
                        $db01->query($sql01);
                        $row01 = $db01->fetch_assoc(); ?>
                        <a class="dropdown-item d-flex align-items-center" href="../user/index_subadmin.php">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-user-check text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php echo date("d-m-Y", strtotime($row01['createdate'])) ?></div>
                                <span class="font-weight-bold">Có user mới chờ duyệt</span>
                            </div>
                        </a>
                    <?php } else { ?>
                        <div class="dropdown-item d-flex align-items-center justify-content-center">
                            <span class="font-weight-bold">Không có thông báo mới</span>
                        </div>
                    <?php } ?>
                    <a class="dropdown-item text-center small text-gray-500" href="../user/index_subadmin.php">Show All Alerts</a>
                </div>
            </li>





            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-exclamation"></i>
                    <!-- Counter - Alerts -->
                    <?php
                    include_once "../../lib/Database.php";
                    $db1 = new Database;
                    $sql1 = "select count(seen) from project where seen=0";
                    $db1->query($sql1);
                    $row1 = $db1->fetch_assoc();
                    if ($row1['count(seen)'] != 0) {
                    ?>
                        <span class="badge badge-danger badge-counter"><?php echo $row1['count(seen)'] > 99 ? "99+" : $row1['count(seen)'] ?></span>
                    <?php } ?>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Alerts Center
                    </h6>
                    <?php
                    if ($row1['count(seen)'] != 0) {
                        $db11 = new Database;
                        $sql11 = "select * from project where seen=0";
                        $db11->query($sql11);
                        $row11 = $db11->fetch_assoc(); ?>
                        <a class="dropdown-item d-flex align-items-center" href="../project/index_subadmin.php">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-exclamation text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php echo date("d-m-Y", strtotime($row11['createdate'])) ?></div>
                                <span class="font-weight-bold">Có dự án mới chờ duyệt</span>
                            </div>
                        </a>
                    <?php } else { ?>
                        <div class="dropdown-item d-flex align-items-center justify-content-center">
                            <span class="font-weight-bold">Không có thông báo mới</span>
                        </div>
                    <?php } ?>
                    <a class="dropdown-item text-center small text-gray-500" href="../project/index_subadmin.php">Show All Alerts</a>
                </div>
            </li>





            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-exclamation-circle"></i>
                    <!-- Counter - Alerts -->
                    <?php
                    include_once "../../lib/Database.php";
                    $db2 = new Database;
                    $sql2 = "select count(seen) from disbursement where seen=0";
                    $db2->query($sql2);
                    $row2 = $db2->fetch_assoc();
                    if ($row2['count(seen)'] != 0) {
                    ?>
                        <span class="badge badge-danger badge-counter"><?php echo $row2['count(seen)'] > 99 ? "99+" : $row2['count(seen)'] ?></span>
                    <?php } ?>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Alerts Center
                    </h6>
                    <?php
                    if ($row2['count(seen)'] != 0) {
                        $db22 = new Database;
                        $sql22 = "select * from disbursement where seen=0";
                        $db22->query($sql22);
                        $row22 = $db22->fetch_assoc(); ?>
                        <a class="dropdown-item d-flex align-items-center" href="../disbursement/index_subadmin.php">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-circle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php echo date("d-m-Y", strtotime($row22['createdate'])) ?></div>
                                <span class="font-weight-bold">Có đơn giải ngân cần duyệt</span>
                            </div>
                        </a>
                    <?php } else { ?>
                        <div class="dropdown-item d-flex align-items-center justify-content-center">
                            <span class="font-weight-bold">Không có thông báo mới</span>
                        </div>
                    <?php } ?>
                    <a class="dropdown-item text-center small text-gray-500" href="../disbursement/index_subadmin.php">Show All Alerts</a>
                </div>
            </li>

        <?php } ?>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="../../asset/img/undraw_profile_1.svg" alt="...">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                            problem I've been having.</div>
                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="../../asset/img/undraw_profile_2.svg" alt="...">
                        <div class="status-indicator"></div>
                    </div>
                    <div>
                        <div class="text-truncate">I have the photos that you ordered last month, how
                            would you like them sent to you?</div>
                        <div class="small text-gray-500">Jae Chun · 1d</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="../../asset/img/undraw_profile_3.svg" alt="...">
                        <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Last month's report looks great, I am very happy with
                            the progress so far, keep up the good work!</div>
                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                            told me that people say this to all dogs, even if they aren't good...</div>
                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['login']['username'] ?></span>
                <img class="img-profile rounded-circle" src="../../asset/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>

                <a type="submit" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>


            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->