<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods.Authorization,X-Requested-With');



include_once("../../config/db.php");
include_once("../../model/manager/timesheet.php");

$db = new db();
$connect = $db->connect();

$Timesheet = new Timesheet($connect);

$data = json_decode(file_get_contents("php://input"));
/// encode

$Timesheet->ts_id = $data->ts_id;
$Timesheet->status = $data->status;


if ($Timesheet->confirm()) {
    echo json_encode(array("message", "Account update"));
} else {
    echo json_encode(array("message", "Account update"));
}
