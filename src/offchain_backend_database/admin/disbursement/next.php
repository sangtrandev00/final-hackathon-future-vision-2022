<?php
// Start the session
session_start();
if (!isset($_SESSION['login'])) {
    echo "<meta http-equiv='refresh' content='0;url=../../pages/login.php'>";
    exit;
}
if (isset($_SESSION['login']) && $_SESSION['login']['roleid'] == 0) {
    echo "<meta http-equiv='refresh' content='0;url=../../pages/login.php'>";
    exit;
}

if (isset($_SESSION['login']) && ($_SESSION['login']['roleid'] == 1 || $_SESSION['login']['roleid'] == 2)) {
    include_once "../../lib/Database.php";
    $db = new Database;
    $id = $_GET['id'];
    $seen = 1;
    $sql = "UPDATE disbursement SET `seen`=$seen where id=" . $id;
    $db->query($sql);
    //echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    header("location: index_subadmin.php");
} else {
    echo 'Bạn không đủ quyền hạn';
}
