<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
</head>

<body>
    <?php

    require_once("./config.php");
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    ?>
    <!--Begin display -->
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">VNPAY RESPONSE</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Mã đơn hàng:</label>

                <label><?php echo $_GET['vnp_TxnRef'] ?></label>
            </div>
            <div class="form-group">

                <label>Số tiền:</label>
                <label><?php echo $_GET['vnp_Amount'] ?></label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã phản hồi (vnp_ResponseCode):</label>
                <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label><?php echo $_GET['vnp_PayDate'] ?></label>
            </div>
            <div class="form-group">
                <label>Kết quả:</label>
                <label>
                    <?php
                    if ($secureHash == $vnp_SecureHash) {
                        if ($_GET['vnp_ResponseCode'] == '00') {
                            echo "<span style='color:blue'>GD Thanh cong</span>";
                            $status_pay = 1;
                        } else {
                            echo "<span style='color:red'>GD Khong thanh cong</span>";
                            $status_pay = 0;
                        }
                    } else {
                        echo "<span style='color:red'>Chu ky khong hop le</span>";
                        $status_pay = 0;
                    }
                    $code_trading_vnp = $_GET['vnp_TransactionNo'];
                    $code_order = $_GET['vnp_TxnRef'];
                    date_default_timezone_set("Asia/Bangkok");
                    $donatedate = date("Y-m-d H:i:s");
                    include_once("../lib/Database.php");
                    $db = new database();
                    $sql = "update donate set status_pay='$status_pay',code_trading_vnp='$code_trading_vnp', `donatedate` = '$donatedate' where code_order=" . $_GET['vnp_TxnRef'];
                    //echo $sql;
                    $db->query($sql);
                    ?>
                </label>
            </div>
            <?php
            $db1 = new Database;
            $sql1 = "select * from donate where code_order=" . $_GET['vnp_TxnRef'];
            $db1->query($sql1);
            $row1 = $db1->fetch_assoc();
            if ($status_pay == 0) {
            ?>
                <script>
                    alert("Giao dịch thất bại");
                </script>
            <?php
                header("location: http://fpolytuthien.com/pages/donate_default.php");
            }
            header("location: http://localhost:8080/donate_" . $row1['id']);
            ?>


            <!-- <a href="location: http://localhost:8080/donate_  class="btn btn-success">Trở về</a> -->

            <!-- <a href="../pages/donate_default.php" class="btn btn-success">Trở về</a> -->
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY <?php echo date('Y') ?></p>
        </footer>
    </div>
</body>

</html>