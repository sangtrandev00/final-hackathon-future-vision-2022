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
    include "../../lib/Database.php";
    $db = new Database;
    $id = $_GET['id'];
    $confirm = 1;
    $seen = 1;
    $roleid = 3;
    $user_id_conf = $_SESSION['login']['userid'];
    // echo $id;
    $sql = "UPDATE user SET `roleid`=$roleid ,`seen`=$seen ,`confirm`=$confirm,`user_id_conf`=$user_id_conf where id=" . $id;
    // echo $sql;
    $db->query($sql);
    header("location: index_subadmin.php");
} else {
    echo 'Bạn không đủ quyền hạn';
}
//echo "<meta http-equiv='refresh' content='0;url=index.php'>";
