<?php include_once("../part/header.php") ?>

<?php
include_once("../../lib/Database.php");
$db1 = new Database;
$id1 = $_GET['id'];
$sql1 = "select * from project where id=" . $id1;
$db1->query($sql1);
$row1 = $db1->fetch_assoc();

$db3 = new Database;
$sql3 = "select sum(money) from donate where project_id=".$id1." and status_pay=1";
$db3->query($sql3);
$row3 = $db3->fetch_assoc();
$total_donate=$row3['sum(money)'];
// echo $total_donate;

$db = new Database;
$sql = "select sum(money) from disbursement where project_id=".$id1." and confirm=1";
$db->query($sql);
$row = $db->fetch_assoc();
$total_disbursement=$row['sum(money)'];
// echo $total_disbursement;
if (isset($_SESSION['login']) && $_SESSION['login']['userid'] == $row1['userid']) {


    $db = new database();
    $money = isset($_POST["money"]) ? $_POST["money"] : "";
    $reason = isset($_POST["reason"]) ? $_POST["reason"] : "";
    $stk = isset($_POST["stk"]) ? $_POST["stk"] : "";
    $bank = isset($_POST["bank"]) ? $_POST["bank"] : "";
    $err = [];

    if (isset($_POST['money'])) {
        if($money>($total_donate-$total_disbursement)){
            array_push($err, 'Số tiền vượt quá số tiền còn lại của dự án');
        }
        if ($money == "") {
            array_push($err, 'Vui lòng nhập số tiền cần đóng góp');
        } else {
            if ($money <= 0) {
                array_push($err, 'Vui lòng nhập số tiền dương');
            }
        }
        if ($reason == "") {
            array_push($err, 'Vui lòng nhập lý do');
        }
        if ($stk == "") {
            array_push($err, 'Vui lòng nhập số tài khoản');
        }
        if ($bank == "") {
            array_push($err, 'Vui lòng nhập ngân hàng');
        }
    }

    if (count($err) == 0 && isset($_POST['money'])) {
        $userid = 1; //đặt tạm userid=1
        $project_id = $id1;
        $money = htmlspecialchars(addslashes(trim($money)));
        $reason = htmlspecialchars(addslashes(trim($reason)));
        $stk = htmlspecialchars(addslashes(trim($stk)));
        $bank = htmlspecialchars(addslashes(trim($bank)));
        $sql = "INSERT INTO `disbursement`(`project_id`, `money`, `userid`, `reason`, `stk`, `bank`) VALUES ('$project_id','$money','$userid','$reason','$stk','$bank')";
        $id = $db->insert_query($sql);
        //echo $id;
        echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">XIN GIẢI NGÂN</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="usr">Tên Dự án</label>
                <input type="text" class="form-control" id="usr" name="txtname" value="<?php echo $row1['name'] ?>" disabled>
            </div>
            <div class="form-group">
                <label for="usr">Loại dự án</label>
                <select name="cateid" class="custom-select" disabled>
                    <?php
                    $db2 = new database();
                    $sql2 = "select * from category";
                    $db2->query($sql2);
                    while ($row2 = $db2->fetch_assoc()) {
                    ?>
                        <option name="" value="<?php echo $row2['id'] ?>" <?php echo $row2['id'] == $row1['cateid'] ? "selected" : "" ?>><?php echo $row2['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="usr">Lý do</label>
                <input type="text" class="form-control" id="usr" name="reason" value="<?php echo $reason ?>">
            </div>
            <div class="form-group">
                <label for="usr">Số tiền cần giải ngân</label>
                <input type="text" class="form-control" id="usr" name="money" value="<?php echo $money ?>">
            </div>
            <div class="form-group">
                <label for="usr">Số tài khoản</label>
                <input type="text" class="form-control" id="usr" name="stk" value="<?php echo $stk ?>">
            </div>
            <div class="form-group">
                <label for="usr">Ngân hàng</label>
                <input type="text" class="form-control" id="usr" name="bank" value="<?php echo $bank ?>">
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
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
<?php } else { ?>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Bạn không đủ quyền hạn</h1>
    </div>
<?php } ?>
<!-- /.container-fluid -->
<?php include_once("../part/footer.php") ?>