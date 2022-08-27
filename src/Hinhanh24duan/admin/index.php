<?php
// Start the session
session_start();
if (!isset($_SESSION['login'])) {
    echo "<meta http-equiv='refresh' content='0;url=../pages/login.php'>";
    exit;
}
if (isset($_SESSION['login']) && $_SESSION['login']['roleid'] == 0) {
    echo "<meta http-equiv='refresh' content='0;url=../pages/login.php'>";
    exit;
}
header("location: dashboard/index.php");
