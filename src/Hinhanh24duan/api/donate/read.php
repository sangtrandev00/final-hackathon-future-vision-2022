<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once("../../lib/Database.php");
$db = new Database;
$sql = "select * from donate where status_pay=1";
$db->query($sql);
$donate = array();
$donate['list_donate'] = array();

while ($row = $db->fetch_assoc()) {
    $db1 = new Database;
    $sql1 = "select * from project where id=" . $row['project_id'];
    $db1->query($sql1);
    $row1 = $db1->fetch_assoc();
    
    $db2 = new Database;
    $sql2 = "select * from category where id=" . $row1['cateid'];
    $db2->query($sql2);
    $row2 = $db2->fetch_assoc();
    extract($row);
    $e = array(
        "FundDonateId" => $row['id'],
        "NameDonor" => $row['username'],
        "Email" => $row['email'],
        "Phone" => $row['phone'],
        "NameProject" => $row1['name'],
        "FundProjectId" => $row['project_id'],
        "Money" => $row['money'],
        "Message" => $row['note'],
        "TimeDonate" => $row['donatedate'],
        "TypeProject" => $row1['name']
    );
    array_push($donate['list_donate'], $e);
}
echo json_encode($donate);

// while($row=$db->fetch_assoc()){
//     extract($row);
//     array_push($donate, $row);
// }
// echo json_encode($donate);