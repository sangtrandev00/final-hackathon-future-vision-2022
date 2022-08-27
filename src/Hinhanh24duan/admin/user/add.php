<?php include_once("../part/header.php") ?>


<?php
if (isset($_SESSION['login']) && ($_SESSION['login']['roleid'] == 1)) {
    include_once("../../lib/Database.php");
    $db = new database();
    $name = isset($_POST["txtname"]) ? $_POST["txtname"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $roleid = isset($_POST["roleid"]) ? $_POST["roleid"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $conf_password = isset($_POST["conf_password"]) ? $_POST["conf_password"] : "";
    $err = [];

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
    }

    if (count($err) == 0 && isset($_POST['txtname'])) {
        $seen = 1;
        $confirm = 1;
        $user_id_conf=$_SESSION['login']['userid'];
        $name = htmlspecialchars(addslashes(trim($name)));
        $phone = htmlspecialchars(addslashes(trim($phone)));
        $roleid = htmlspecialchars(addslashes(trim($roleid)));
        $username = htmlspecialchars(addslashes(trim($username)));
        $email = htmlspecialchars(addslashes(trim($email)));
        $password = htmlspecialchars(addslashes(trim($password)));
        $sql = "insert into user(name, phone,roleid,username,email,password,seen,confirm,user_id_conf) values('$name','$phone','$roleid','$username','$email','$password','$seen','$confirm','$user_id_conf')";
        $id = $db->insert_query($sql);
        //echo $id;
        // header("location: index.php");
        echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    }
?>


    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">THÊM USER</h1>
        <form method="post">
            <div class="form-group">
                <label for="usr">Tên tài khoản</label>
                <input type="text" class="form-control" id="usr" name="username" value="<?php echo $username ?>">
            </div>
            <div class="form-group">
                <label for="usr">Họ và tên</label>
                <input type="text" class="form-control" id="usr" name="txtname" value="<?php echo $name ?>">
            </div>
            <div class="form-group">
                <label for="usr">Chọn quyền hạng</label>
                <select name="roleid" class="custom-select">
                    <?php
                    $db1 = new database();
                    $sql1 = "select * from role";
                    $db1->query($sql1);
                    while ($row1 = $db1->fetch_assoc()) {
                    ?>
                        <option name="" value="<?php echo $row1['id'] ?>"><?php echo $row1['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="usr">Số điện thoại</label>
                <input type="text" class="form-control" id="usr" name="phone" value="<?php echo $phone ?>">
            </div>
            <div class="form-group">
                <label for="usr">Email</label>
                <input type="text" class="form-control" id="usr" name="email" value="<?php echo $email ?>">
            </div>
            <div class="form-group">
                <label for="usr">Mật khẩu</label>
                <input type="password" class="form-control" id="usr" name="password" value="<?php echo $password ?>">
            </div>
            <div class="form-group">
                <label for="usr">Xác nhận mật khẩu mật khẩu</label>
                <input type="password" class="form-control" id="usr" name="conf_password" value="<?php echo $conf_password ?>">
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
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>

    </div>
<?php } else { ?>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Bạn không đủ quyền hạn</h1>
    </div>
<?php } ?>
<!-- /.container-fluid -->
<?php include_once("../part/footer.php") ?>