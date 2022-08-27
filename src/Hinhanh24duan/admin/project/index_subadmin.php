<?php include_once("../part/header.php") ?>
<?php
if (isset($_SESSION['login']) && ($_SESSION['login']['roleid'] == 2)) {

  include_once("../../lib/Database.php");
  $db = new database();    ?>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Quản lí dự án thiện nguyện Fpoly</h1>
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
          <th>Duyệt</th>
          <th>Bỏ qua</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $db->query("select * from project order by id desc");
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
              $db2->query("select username from user where id =" . $row['userid']);
              $row2 = $db2->fetch_assoc();
              echo $row2['username'];
              ?>
            </td>
            <td><?php echo $row['startdate'] ?></td>
            <td><?php echo $row['enddate'] ?></td>
            <td><?php echo number_format($row['total'], 0, ",", ".") ?>đ</td>
            <td>
              <?php if ($row['check'] == 0) { ?>
                <a href="confirm.php?id=<?php echo $row['id'] ?>" class="btn btn-success">Duyệt</a>
              <?php } else { ?>
                <span>✅</span>
              <?php } ?>
            </td>
            <td>
              <?php if ($row['seen'] == 0) { ?>
                <a href="next.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-info">Bỏ</a>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php } elseif (isset($_SESSION['login']) && $_SESSION['login']['roleid'] == 1) { ?>
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Loading...<h1>
  </div>
<?php echo "<meta http-equiv='refresh' content='0;url=index_admin.php'>";
  //header("location: index_admin.php");
} else { ?>
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Bạn không đủ quyền hạn</h1>
  </div>
<?php } ?>
<!-- /.container-fluid -->
<?php include_once("../part/footer.php") ?>