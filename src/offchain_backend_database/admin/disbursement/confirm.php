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
    $confirm = 1;
    $seen = 1;
    date_default_timezone_set("Asia/Bangkok");
    $disbursementdate = date("Y-m-d H:i:s");
    $disbursementdate = htmlspecialchars(addslashes(trim($disbursementdate)));
    $user_id_conf = $_SESSION['login']['userid'];
    $sql = "UPDATE disbursement SET `confirm` = $confirm , `disbursementdate` = '$disbursementdate' , `seen` = $seen , `user_id_conf` = $user_id_conf where id=" . $id;
    $db->query($sql);

    //echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    //header("location: index_subadmin.php");
    header("location: http://localhost:8080/disbursement_".$id);
} else {
    echo 'Bạn không đủ quyền hạn';
}
