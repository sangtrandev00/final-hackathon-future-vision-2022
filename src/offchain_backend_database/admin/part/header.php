<?php
// Start the session
session_start();
if(!isset($_SESSION['login'])){
    echo "<meta http-equiv='refresh' content='0;url=../../pages/login.php'>";
    exit;
}
if(isset($_SESSION['login']) && $_SESSION['login']['roleid']==0) {
    echo "<meta http-equiv='refresh' content='0;url=../../pages/login.php'>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″/>
    <title>SB Admin 2 - Blank</title>
    <!-- Custom fonts for this template-->
    <link href="../../asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../../asset/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../asset/css/style.css" rel="stylesheet">
    <!-- Custom styles for this richEditor-->
    <link rel="stylesheet" href="../../lib/rickeditor/richtexteditor/rte_theme_default.css" />
    <script type="text/javascript" src="../../lib/rickeditor/richtexteditor/rte.js"></script>
    <script type="text/javascript" src="../../lib/rickeditor/richtexteditor/plugins/all_plugins.js"></script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include_once("sidebar.php") ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include_once("topbar.php") ?>