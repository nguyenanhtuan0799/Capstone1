
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once("../../config/db.php");
include_once("../../model/manager/timesheet.php");
$db = new db();
$connect = $db->connect();
$timesheet = new Timesheet($connect);
$timesheet->fullname = isset($_GET['fullname']) ? $_GET['fullname'] : die();

$viewReport = $timesheet->viewReport();
$num = $viewReport->rowCount();

if ($num > 0) {
    $timesheet_array = [];
    $timesheet_array["data"] = [];
    while ($row = $viewReport->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $timesheet_item = array(
            "fullname" => $fullname,
            "account_id" => $account_id,
            "role_id" => $role_id,
            "date" => $date,
            "start_time" => $start_time,
            "hours" => $hours,
            "overtime" => $overtime,
            "dayofweek" => $dayofweek,
            "late_arrival" => $late_arrival,
            "status" => $status,
            "shift_name" => $shift_name,
            "shift_time" => $shift_time,
            "avatar" => $avatar,
            "email" => $email,
            "phone_number" => $phone_number,
            "address" => $address,
            "headquerter" => $headquerter,
        );
        array_push($timesheet_array["data"], $timesheet_item);
    }
    echo json_encode($timesheet_array);
}
