<?php include_once("../part/header.php") ?>
<?php
include_once("../../lib/Database.php");
$db = new database();    ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Dự án của tôi</h1>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Danh mục</th>
        <th>Tên dự án</th>
        <th>Hình đại diện</th>
        <th>Người tạo dự án</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Số tiền cần quyên góp</th>
        <th>Trạng Thái</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $db->query("select * from project where userid=" . $_SESSION['login']['userid'] . " order by id desc");
      while ($row = $db->fetch_assoc()) {
      ?>

        <tr>
          <td><?php echo $row['id'] ?></td>
          <td>
            <?php
            $db1 = new database();
            $db1->query("select name from category where id =" . $row['cateid']);
            $row1 = $db1->fetch_assoc();
            echo $row1['name'];
            ?>
          </td>
          <td><a href="project_details.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></td>
          <td><img src="../../asset/img/upload/<?php echo $row['image'] ?>" alt="" width="150px"></td>
          <td>
            <?php
            $db2 = new database();
            $db2->query("select name from user where id =" . $row['userid']);
            $row2 = $db2->fetch_assoc();
            echo $row2['name'];
            ?>
          </td>
          <td><?php echo $row['startdate'] ?></td>
          <td><?php echo $row['enddate'] ?></td>
          <td><?php echo number_format($row['total'], 0, ",", ".") ?>đ</td>
          <td><?php echo $row['check'] == 0 ? "Chờ duyệt" : "Đã được duyệt" ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

</div>

<!-- /.container-fluid -->
<?php include_once("../part/footer.php") ?>