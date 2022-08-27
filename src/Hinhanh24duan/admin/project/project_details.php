<?php include_once("../part/header.php") ?>
<?php
include_once "../../lib/Database.php";
$db = new Database;
$id = $_GET['id'];
$sql = "select * from project where id=" . $id;
$db->query($sql);
$row = $db->fetch_assoc();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Chi tiết dự án</h1>
    <div class="container">
        <div class="jumbotron">
            <h1><?php echo $row['name'] ?></h1>
            <p class="lead"><?php echo $row['description'] ?></p>
            <?php if (isset($_SESSION['login']) && ($_SESSION['login']['roleid'] == 1 || $_SESSION['login']['roleid'] == 2)) { ?>
                <p><a href="confirm.php?id=<?php echo $row['id'] ?>" class="btn btn-success" <?php echo $row['check'] == 0 ? "" : 'style="display:none"' ?>>Duyệt</a></p>
            <?php } ?>
        </div>

        <div class="row marketing">
            <div class="col-lg-5">
                <img src="../../asset/img/upload/<?php echo $row['image'] ?>" alt="" width="100%">
                <br><br>
                <h4>Ảnh đại diện</h4>
                <?php if (isset($_SESSION['login']) && ($_SESSION['login']['userid'] == $row['userid']) && $row['check'] == 1) { ?>
                    <p><a class="btn btn-lg btn-success" href="../disbursement/register.php?id=<?php echo $row['id'] ?>" role="button">Xin giải ngân</a></p>
                <?php }
                if ($row['check'] == 1) {
                ?>
                    <p><a class="btn btn-lg btn-success" href="../../pages/donate.php?id=<?php echo $row['id'] ?>" role="button">Đóng góp</a></p>
                <?php } ?>
                <h4>Lịch sử giải ngân</h4>
                <?php
                $db1 = new database();
                $sql1 = "select * from disbursement where project_id=" . $row['id'];
                $db1->query($sql1);
                $count = 1;
                while ($row1 = $db1->fetch_assoc()) {
                ?>
                    <ul>
                        <h5>Lần <?php echo $count ?></h5>
                        <li>Người duyệt:
                            <?php
                            $db2 = new database();
                            $sql2 = "select * from user where id=" . $row1['user_id_conf'];
                            $db2->query($sql2);
                            $row2 = $db2->fetch_assoc();
                            if ($row1['confirm'] == 0) {
                                echo "Chưa có";
                            } else {
                                echo $row2['name'];
                            }
                            ?>
                        </li>
                        <li>Lý do: <?php echo $row1['reason'] ?></li>
                        <li>Số tiền: <?php echo number_format($row1['money'], 0, ",", ".") ?> VNĐ</li>
                        <li>Thời gian: <?php echo $row1['createdate'] ?></li>
                        <li>Trạng thái: <?php echo $row1['confirm'] == 0 ? "Chờ duyệt" : "Thành công" ?></li>
                    </ul>
                    <hr>
                <?php $count++;
                } ?>

                <?php
                $db4 = new database();
                $sql4 = "select sum(money) from disbursement where project_id=" . $row['id'] . " and confirm=1";
                $db4->query($sql4);
                $row4 = $db4->fetch_assoc();
                $total_disburment_money = $row4['sum(money)'] == "" ? 0 : $row4['sum(money)'];
                // echo $total_disburment_money;
                ?>
                <h4>Tổng tiền đã giải ngân thành công:</h4>
                <h4><?php echo number_format($total_disburment_money, 0, ",", ".") ?> VNĐ</h4>
            </div>

            <div class="col-lg-7">
                <h3>Số tiền cần quyên góp</h3>
                <h2><?php echo number_format($row['total'], 0, ",", ".") ?> VNĐ</h2>

                <h5>Địa điểm</h5>
                <p><?php echo $row['location']  ?></p>

                <h5>Thời gian bắt đầu đóng góp</h5>
                <p><?php echo date("d-m-Y", strtotime($row['startdate'])) ?></p>

                <h5>Thời gian kết thúc đóng góp</h5>
                <p><?php echo date("d-m-Y", strtotime($row['enddate'])) ?></p>

                <h4>Tiến độ đóng góp</h4>
                <br>
                <?php
                $db3 = new database();
                $sql3 = "select sum(money) from donate where project_id=" . $row['id'] . " and status_pay=1";
                $db3->query($sql3);
                $row3 = $db3->fetch_assoc();
                $progress = $row3['sum(money)'] / $row['total'] * 100;
                ?>
                <div style="display:flex;justify-content: center;">
                    <div class="progress" style="width:90%">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress ?>%">
                            <?php echo $progress ?>%
                        </div>
                    </div>
                </div>
                <br>
                <h4>Số tiền đã đóng góp: <?php echo number_format($row3['sum(money)'], 0, ",", ".") ?> VNĐ</h4>
                <br>
                <h4>Mô tả chi tiết dự án</h4>
                <p><?php echo $row['detail'] ?></p>
            </div>
        </div>
    </div> <!-- /container -->

</div>

<!-- /.container-fluid -->
<?php include_once("../part/footer.php") ?>