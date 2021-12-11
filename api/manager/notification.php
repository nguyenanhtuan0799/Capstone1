
<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once("../../config/db.php");
include_once("../../model/manager/timesheet.php");
$db = new db();
$connect = $db->connect();
$timesheet = new Timesheet($connect);
$notification = $timesheet->notification();
$num = $notification->rowCount();

if ($num > 0) {
    $timesheet_array = [];
    $timesheet_array["data"] = [];
    while ($row = $notification->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $timesheet_item = array(
            "fullname" => $fullname,
            "status" => $status,
            "date"=> $date,
            "start_time"=>$start_time,
        );
        array_push($timesheet_array["data"], $timesheet_item);
    }
    echo json_encode($timesheet_array);
}
