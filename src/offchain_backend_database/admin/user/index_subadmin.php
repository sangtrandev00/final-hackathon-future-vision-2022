<?php include_once("../part/header.php") ?>

<?php
if (isset($_SESSION['login']) && $_SESSION['login']['roleid'] == 2) {

  include_once("../../lib/Database.php");
  $db = new database();    ?>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Duyệt Mod</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Họ và tên</th>
          <th>Email</th>
          <th>Số điện thoại</th>
          <th>Duyệt</th>
          <th>Bỏ qua</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $db->query("select * from user where roleid=0 or roleid=3 order by id desc");
        while ($row = $db->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $row['id'] ?></td>
            <td><a href=""><?php echo $row['username'] ?></a></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['phone'] ?></td>
            <td>
              <?php if ($row['confirm'] == 0) { ?>
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
        <?php
        }
        ?>
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