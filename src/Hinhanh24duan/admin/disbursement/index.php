<?php include_once("../part/header.php") ?>
<?php
include_once("../../lib/Database.php");

$db = new database();    ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Giải ngân dự án của tôi</h1>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Danh mục</th>
        <th>Tên dự án</th>
        <th>Username</th>
        <th>Lý do</th>
        <th>Số tiền cần giải ngân</th>
        <th>Stk</th>
        <th>Ngân hàng</th>
        <th>Trạng thái</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $db->query("select * from disbursement where userid=" . $_SESSION['login']['userid'] . " order by id desc");
      while ($row = $db->fetch_assoc()) {
      ?>
        <tr>
          <td><?php echo $row['id'] ?></td>
          <td>
            <?php
            $db2 = new database();
            $db2->query("select name, cateid from project where id =" . $row['project_id']);
            $row2 = $db2->fetch_assoc();

            $db1 = new database();
            $db1->query("select name from category where id =" . $row2['cateid']);
            $row1 = $db1->fetch_assoc();
            echo $row1['name'];
            ?></td>
          <td>
            <a href="../project/project_details.php?id=<?php echo $row['project_id'] ?>">
              <?php echo $row2['name']; ?>
            </a>
          </td>
          <td>
            <?php
            $db3 = new database();
            $db3->query("select username from user where id =" . $row['userid']);
            $row3 = $db3->fetch_assoc();
            echo $row3['username'];
            ?>
          </td>
          <td><?php echo $row['reason'] ?></td>
          <td><?php echo number_format($row['money'], 0, ",", ".") ?>đ</td>
          <td><?php echo $row['stk'] ?></td>
          <td><?php echo $row['bank'] ?></td>
          <td><?php echo $row['confirm'] == 0 ? "Chờ duyệt" : "Đã được duyệt" ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

</div>

<!-- /.container-fluid -->
<?php include_once("../part/footer.php") ?>