<?php
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
    // $sql = "select * from project where id=" . $id;
    // $db->query($sql);
    // $row = $db->fetch_assoc();
    $confirm = 0;
    $disbursementdate = null;
    $user_id_conf = 0;
    // echo $id;
    $sql = "UPDATE disbursement SET `confirm` = $confirm , `disbursementdate` = '$disbursementdate' , `user_id_conf` = $user_id_conf where id=" . $id;
    // echo $sql;
    $db->query($sql);
    //echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    header("location: index_admin.php"); 
} else {
    echo 'Bạn không đủ quyền hạn';
}
