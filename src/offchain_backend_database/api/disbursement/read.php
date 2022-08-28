<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once("../../lib/Database.php");
$db = new Database;
$sql = "select * from disbursement where confirm=1";
$db->query($sql);
$disbursement = array();
$disbursement['list_disbursement'] = array();

while ($row = $db->fetch_assoc()) {
    $db2 = new Database;
    $sql2 = "select * from user where id=".$row['user_id_conf'];
    $db2->query($sql2);
    $row2 = $db2->fetch_assoc();
    $db3 = new Database;
    $sql3 = "select * from project where id=".$row['userid'];
    $db3->query($sql3);
    $row3 = $db3->fetch_assoc();
    $db1 = new Database;
    $sql1 = "select * from category where id=".$row3['cateid'];
    $db1->query($sql1);
    $row1 = $db1->fetch_assoc();
    extract($row);
    $e = array(
        "disbursementID" => $row['id'],
        "ProjectID" => $row['project_id'],
        "CateProject" => $row1['name'],
        "userRequest" => $row3['name'],
        "Money" => $row['money'],
        "DateRequest" => $row['createdate'],
        "DateConfirm" => $row['disbursementdate'],
        "Reason" => $row['reason'],
        "UserConfirm" => $row2['name'],
    );
    array_push($disbursement['list_disbursement'], $e);
}
echo json_encode($disbursement);

// while($row=$db->fetch_assoc()){
//     extract($row);
//     array_push($project, $row);
// }
// echo json_encode($project);