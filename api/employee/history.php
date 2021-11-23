<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once("../../config/db.php");
include_once("../../model/employee/timesheet.php");

$db = new db();
$connect = $db->connect();

$timesheet = new Timesheet($connect);

$timesheet->account_id = isset($_GET['id']) ? $_GET['id'] : die();

$viewtimesheet=$timesheet->viewHistory();
$num = $viewtimesheet->rowCount();

if ($num > 0) {
    $timesheet_array = [];
    $timesheet_array["data"] = [];
    while ($row = $viewtimesheet->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $timesheet_item = array(
            "account_id" => $account_id,
            "date" => $date,
            "shift_name" => $shift_name,
            "shift_time" => $shift_time,
            "hours" => $hours,
            "overtime" => $overtime,
            "late_arrival" => $late_arrival,
            "status" => $status,
        
        );
        array_push($timesheet_array["data"], $timesheet_item);
    }
    echo json_encode($timesheet_array);
}