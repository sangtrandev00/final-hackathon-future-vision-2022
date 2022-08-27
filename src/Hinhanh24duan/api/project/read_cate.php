<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once("../../lib/Database.php");

$db = new Database;
$sql = "select * from category";
$db->query($sql);
$category = array();
$project = array();

while ($row = $db->fetch_array()) {
    $project['category_' . $row['id']]= array();
    $db1 = new Database;
    $sql1 = "select * from project where cateid=" . $row['id']." and `check`=1";
    $db1->query($sql1);
    while ($row1 = $db1->fetch_assoc()) {
        extract($row1);
        $e = array(
            "ProjectID" => $row1['id'],
            "ProjectName" => $row1['name'],
            "Location" => $row1['location'],
            "DateStart" => $row1['startdate'],
            "DateEnd" => $row1['enddate'],
            "TargetMoney" => $row1['total'],
            "Avatar" => "https://fpolytuthien.com/asset/img/upload/".$row1['image'],
            "ShortDesc" => $row1['description'],
        );
        array_push($project['category_' . $row['id']], $e);
    }
    array_push($category, $project['category_' . $row['id']]);
}

echo json_encode($category);

// while($row=$db->fetch_assoc()){
//     extract($row);
//     array_push($project, $row);
// }
// echo json_encode($project);