<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="../asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asset/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">TẠO TÀI KHOẢN!</h1>
                            </div>
                            <form class="user" method="post">
                                <?php
                                include_once("../lib/Database.php");
                                $db = new database();
                                $name = isset($_POST["txtname"]) ? $_POST["txtname"] : "";
                                $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
                                $username = isset($_POST["username"]) ? $_POST["username"] : "";
                                $email = isset($_POST["email"]) ? $_POST["email"] : "";
                                $password = isset($_POST["password"]) ? $_POST["password"] : "";
                                $conf_password = isset($_POST["conf_password"]) ? $_POST["conf_password"] : "";
                                $err = [];

                                $name = htmlspecialchars(addslashes(trim($name)));
                                $phone = htmlspecialchars(addslashes(trim($phone)));
                                $username = htmlspecialchars(addslashes(trim($username)));
                                $email = htmlspecialchars(addslashes(trim($email)));
                                $password = htmlspecialchars(addslashes(trim($password)));
                                $db1 = new database();
                                $sql1 = "select * from user where order_id = '$username' or email = '$email' or phone ='$phone'";
                                $db1->query($sql1);
                                $numrows = $db1->num_rows();

                                if (isset($_POST['txtname'])) {
                                    if ($name == "") {
                                        array_push($err, 'Vui lòng nhập họ tên');
                                    }
                                    if ($phone == "") {
                                        array_push($err, 'Vui lòng nhập số điện thoại');
                                    }
                                    if ($username == "") {
                                        array_push($err, 'Vui lòng nhập tên tài khoản');
                                    }
                                    if ($email == "") {
                                        array_push($err, 'Vui lòng nhập email');
                                    }
                                    if ($password == "") {
                                        array_push($err, 'Vui lòng nhập mật khẩu');
                                    }
                                    if ($conf_password == "") {
                                        array_push($err, 'Vui lòng nhập xác nhận mật khẩu');
                                    } else {
                                        if ($password != $conf_password) {
                                            array_push($err, 'Xác nhận mật khẩu chưa chính xác');
                                        }
                                    }
                                    if ($numrows > 0) {
                                        array_push($err, 'username hoặc email hoặc số điện thoại đã tồn tại');
                                    }
                                }


                                $thanhcong = 0;
                                if (count($err) == 0 && isset($_POST['txtname']) && $numrows == 0) {
                                    $password = md5($password);
                                    $sql = "insert into user(name, phone,username,email,password) values('$name','$phone','$username','$email','$password')";
                                    $id = $db->insert_query($sql);
                                    $thanhcong = 1;
                                    //echo $id;
                                    // header("location: index.php");
                                    //echo "<meta http-equiv='refresh' content='0;url=index.php'>";

                                }



                                ?>
                                <div class="form-group">
                                    <input type="text" name="username" value="" class="form-control form-control-user" id="" placeholder="Tên tài khoản">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="txtname" value="" class="form-control form-control-user" id="" placeholder="Họ và tên">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" value="" class="form-control form-control-user" id="" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="" class="form-control form-control-user" id="" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" value="" class="form-control form-control-user" id="" placeholder="Mật khẩu">
                                </div>
                                <div class="form-group" style="display: block;">
                                    <input type="password" name="conf_password" value="" class="form-control form-control-user" id="" placeholder="Xác nhận mật khẩu mật khẩu">
                                </div>
                                <?php if (count($err) > 0) { ?>
                                    <ul class="alert alert-danger">
                                        <?php
                                        foreach ($err as $value) {
                                        ?>
                                            <li><?php echo $value ?></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                                <?php if ($thanhcong == 1) { ?>
                                    <div class="alert alert-success">
                                        <strong>Bạn đã đăng ký thành công!</strong> Vui lòng chờ ban quản trị duyệt.
                                    </div>
                                <?php } ?>
                                <button type="submit" href="" class="btn btn-primary btn-user btn-block">Đăng ký</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Quên mật khẩu?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Đã có tài khoản? Đăng nhập!</a>
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