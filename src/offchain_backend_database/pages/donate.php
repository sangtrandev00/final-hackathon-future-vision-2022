<?php include_once("../part/header.php") ?>
<?php
include_once("../lib/Database.php");

$db1 = new Database;
$id1 = $_GET['id'];
$sql1 = "select * from project where id=" . $id1;
$db1->query($sql1);
$row1 = $db1->fetch_assoc();

?>
<section class="donors">
    <div class="container">
        <div class="col-md-12 col-xs-12 box">
            <div class="donors_input col-md-6 col-xs-12">
                <h1>Đóng góp</h1>
                <form action="../vnpay_php/vnpay_create_payment.php" id="create_form" method="post">
                    <div class="form-group">
                        <label for="txt_billing_fullname">Họ tên</label>
                        <input class="form-control" id="txt_billing_fullname" name="txt_billing_fullname" type="text" value="" required />
                    </div>
                    <div class="form-group">
                        <label for="txt_billing_mobile">Số điện thoại</label>
                        <input class="form-control" id="txt_billing_mobile" name="txt_billing_mobile" type="text" value="" required />
                    </div>
                    <div class="form-group">
                        <label for="txt_billing_email">Email</label>
                        <input class="form-control" id="txt_billing_email" name="txt_billing_email" type="text" value="" required />
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="order_id">Mã hóa đơn</label>
                        <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>" />
                    </div>
                    <div class="form-group">
                        <label for="cateid">Loại dự án</label>
                        <select name="cateid" id="cateid" class="custom-select" disabled>
                            <?php
                            $db2 = new database();
                            $sql2 = "select * from category";
                            $db2->query($sql2);
                            while ($row2 = $db2->fetch_assoc()) {
                            ?>
                                <option name="" value="<?php echo $row2['id'] ?>" <?php echo
                                                                                    $row2['id'] == $row1['cateid'] ? "selected" : "" ?>>
                                    <?php echo $row2['name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="project_id">Id Project</label>
                        <input class="form-control" id="project_id" name="project_id" type="text" value="<?php echo $id1 ?>" />
                    </div>
                    <div class="form-group">
                        <label for="project_name">Tên Dự án</label>
                        <input type="text" class="form-control" id="project_name" name="txtname" value="<?php echo $row1['name'] ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="amount">Số tiền cần quyên góp</label>
                        <input class="form-control" id="amount" name="amount" type="text" value="" required />
                    </div>

                    <div class="form-group">
                        <label for="bank_code">Ngân hàng</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Không chọn</option>
                            <option value="NCB"> Ngân hàng NCB</option>
                            <option value="AGRIBANK"> Ngân hàng Agribank</option>
                            <option value="SCB"> Ngân hàng SCB</option>
                            <option value="SACOMBANK">Ngân hàng SacomBank</option>
                            <option value="EXIMBANK"> Ngân hàng EximBank</option>
                            <option value="MSBANK"> Ngân hàng MSBANK</option>
                            <option value="NAMABANK"> Ngân hàng NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK">Ngân hàng Vietinbank</option>
                            <option value="VIETCOMBANK"> Ngân hàng VCB</option>
                            <option value="HDBANK">Ngân hàng HDBank</option>
                            <option value="DONGABANK"> Ngân hàng Dong A</option>
                            <option value="TPBANK"> Ngân hàng TPBank</option>
                            <option value="OJB"> Ngân hàng OceanBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                            <option value="VPBANK"> Ngân hàng VPBank</option>
                            <option value="MBBANK"> Ngân hàng MBBank</option>
                            <option value="ACB"> Ngân hàng ACB</option>
                            <option value="OCB"> Ngân hàng OCB</option>
                            <option value="IVB"> Ngân hàng IVB</option>
                            <option value="VISA"> Thanh toán qua VISA/MASTER</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Ghi chú</label>
                        <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="4"></textarea>
                    </div>
                    <div id="error">

                    </div>

                    <input type="submit" name="redirect" id="redirect" class="btn btn-primary" value="Đóng góp">
                </form>
                <div class="clear"></div>
            </div>

            <div class="donors-output col-md-6 col-xs-12">
                <h1>Lịch sử giao dịch thành công</h1>
                <table class="table table-striped" border="1">
                    <thead>
                        <tr>
                            <th>ID đóng góp</th>
                            <th>Thời gian đóng góp</th>
                            <th>Số tiền đóng góp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $db = new database();
                        $db->query("select * from donate where status_pay=1 order by id desc limit 17");
                        while ($row = $db->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><a href="">
                                        <?php echo $row['id'] ?>
                                    </a></td>
                                <td>
                                    <?php echo $row['createdate'] ?>
                                </td>
                                <td>
                                    <?php echo number_format($row['money'], 0, ",", ".") ?>đ
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</section>


<!-- /.container-fluid -->
<?php include_once("../part/footer.php") ?>