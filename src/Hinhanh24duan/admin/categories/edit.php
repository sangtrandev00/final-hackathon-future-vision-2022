<?php
// Start the session
session_start();
if (!isset($_SESSION['login'])) {
    echo "<meta http-equiv='refresh' content='0;url=../../pages/login.php'>";
    exit;
}
if (isset($_SESSION['login']) && $_SESSION['login']['roleid'] == 0) {
    echo "<meta http-equiv='refresh' content='0;url=../../pages/login.php'>";
    exit;
}

if (isset($_SESSION['login']) && ($_SESSION['login']['roleid'] == 1)) {
    include_once "../Database.php";
    $db = new Database;
    $id = $_GET['id'];
    $sql = "select * from category where id=" . $id;
    $db->query($sql);
    $row = $db->fetch_assoc();
?>
    <form action="" method="post">
        <input type="text" name="txtName" value="<?php echo $row['name'] ?>"> <button>Sửa</button>
    </form>
<?php
    $name = isset($_POST['txtName']) ? $_POST['txtName'] : "";
    if ($name <> "") {
        $name = htmlspecialchars(addslashes(trim($name)));
        $sql = "update category set name='$name' where id=" . $id;
        //echo $sql;
        $db->query($sql);
        header("location: index.php");
    }
} else {
    echo 'Bạn không đủ quyền hạn';
}
?>