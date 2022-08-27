<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="../asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asset/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">ĐĂNG NHẬP!</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <?php
                                        include_once("../lib/Database.php");
                                        $numrows = -1;
                                        if (isset($_POST["username"])) {

                                            $password = isset($_POST["password"]) ? $_POST["password"] : "";
                                            $username = isset($_POST["username"]) ? $_POST["username"] : "";
                                            $username = htmlspecialchars(addslashes(trim($username)));
                                            $password = htmlspecialchars(addslashes(trim($password)));

                                            $password = md5($password);
                                            $db1 = new database();
                                            $sql1 = "select username, id, roleid from user where username = '$username' and password = '$password'";
                                            $db1->query($sql1);
                                            $row1 = $db1->fetch_assoc();
                                            $numrows = $db1->num_rows();
                                            if ($numrows == 1) {
                                                $_SESSION['login']['userid'] = $row1['id'];
                                                $_SESSION['login']['username'] = $row1['username'];
                                                $_SESSION['login']['roleid'] = $row1['roleid'];
                                                echo "<meta http-equiv='refresh' content='0;url=../admin/dashboard'>";
                                            }
                                        }
                                        ?>

                                        <div class="form-group">
                                            <input type="username" name="username" class="form-control form-control-user" id="" placeholder="Nhập tài khoản">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="" placeholder="Nhập mật khẩu">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <?php
                                        if ($numrows == 0) {
                                            // session_unset();
                                        ?>
                                            <div class="alert alert-danger">
                                                <strong>Mật khẩu hoặc tài khoản sai!</strong>
                                            </div>
                                        <?php } ?>
                                        <?php if (isset($_SESSION['login']) && $_SESSION['login']['roleid'] == 0) { ?>
                                            <div class="alert alert-danger">
                                                <strong>Tài khoản của bạn chưa được phê duyệt</strong>
                                            </div>
                                        <?php } ?>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Đặng nhập
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Quên mật khẩu?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Tạo tài khoản mới!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../asset/vendor/jquery/jquery.min.js"></script>
    <script src="../asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../asset/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../asset/js/sb-admin-2.min.js"></script>

</body>

</html>