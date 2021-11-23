<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods.Authorization,X-Requested-With');



include_once("../../config/db.php");
include_once("../../model/employee/timesheet.php");

$db = new db();
$connect = $db->connect();

$createTimesheet = new Timesheet($connect);

$data = json_decode(file_get_contents("php://input"));
$createTimesheet->account_id = $data->account_id;
$createTimesheet->date = $data->date;
$createTimesheet->start_time = $data->start_time;
$createTimesheet->hours = $data->hours;
$createTimesheet->overtime = $data->overtime;
$createTimesheet->dayofweek = $data->dayofweek;
$createTimesheet->late_arrival = $data->late_arrival;
$createTimesheet->status = $data->status;
$createTimesheet->shift_name = $data->shift_name;
$createTimesheet->shift_time = $data->shift_time;


if ($createTimesheet->CreateTimesheet()) {
    echo json_encode(array("message", "Account Create"));
} else {
    echo json_encode(array("message", "Account not Create"));
}
