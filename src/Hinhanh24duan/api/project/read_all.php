<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once("../../lib/Database.php");
$db = new Database;
$sql = "select * from project where `check`=1";
$db->query($sql);
$project = array();
$project['list_project'] = array();

while ($row = $db->fetch_assoc()) {
    extract($row);
    $e = array(
        "ProjectID" => $row['id'],
        "ProjectName" => $row['name'],
        "Location" => $row['location'],
        "DateStart" => $row['startdate'],
        "DateEnd" => $row['enddate'],
        "TargetMoney" => $row['total'],
        "Avatar" => "https://fpolytuthien.com/asset/img/upload/".$row['image'],
        "ShortDesc" => $row['description'],
    );
    array_push($project['list_project'], $e);
}
echo json_encode($project);

// while($row=$db->fetch_assoc()){
//     extract($row);
//     array_push($project, $row);
// }
// echo json_encode($project);