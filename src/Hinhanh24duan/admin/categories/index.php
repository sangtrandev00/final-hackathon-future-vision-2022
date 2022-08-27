<?php include_once("../part/header.php") ?>
<?php
include_once("../../lib/Database.php");
$db = new database();
$name = isset($_POST["txtname"]) ? $_POST["txtname"] : "";
$err = [];
if (isset($_POST['txtname'])) {
    if ($name == "") {
        array_push($err, 'Vui lòng nhập danh mục dự án');
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Danh mục dự án</h1>
    <form method="post">
        <input type="text" name="txtname"><button type="submit">Thêm danh Mục</button>
        <?php
        if (count($err) == 0 && isset($_POST['txtname'])) {
            $name = htmlspecialchars(addslashes(trim($name)));
            $sql = "insert into category(name) values('$name')";
            $id = $db->insert_query($sql);
            echo "Thêm danh mục thành công";
        }else{
            echo "Thêm danh mục thất bại";
        }
        ?>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Danh mục</th>
                <th>Tên danh muc</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $db->query("select * from category");
            while ($row = $db->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><a href="#" class="btn btn-primary">Sửa</a></td>
                    <td><a href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Xóa</a></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

</div>

<!-- /.container-fluid -->
<?php include_once("../part/footer.php") ?>