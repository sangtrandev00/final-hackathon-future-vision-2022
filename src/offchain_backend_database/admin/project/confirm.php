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
    // $sql = "select * from project where id=" . $id;
    // $db->query($sql);
    // $row = $db->fetch_assoc();
    $check = 1;
    $seen = 1;
    $user_id_conf = $_SESSION['login']['userid'];
    // echo $id;
    $sql = "UPDATE project SET `check`=$check,`seen`=$seen, `user_id_conf`=$user_id_conf where id=" . $id;
    // echo $sql;
    $db->query($sql);
    //echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    //header("location: index_subadmin.php");
    header("location: http://localhost:8080/project_".$id);
} else {
    echo 'Bạn không đủ quyền hạn';
}
