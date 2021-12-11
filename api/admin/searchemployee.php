<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once("../../config/db.php");
include_once("../../model/admin/employeeAccount.php");
$db = new db();
$connect = $db->connect();
$employeeAccount = new EmployeeAccount($connect);
$employeeAccount->fullname = isset($_GET['fullname']) ? $_GET['fullname'] : die();

$searchEmployeeAccount = $employeeAccount->search();
$num = $searchEmployeeAccount->rowCount();

if ($num > 0) {
    $timesheet_array = [];
    $timesheet_array["data"] = [];
    while ($row = $searchEmployeeAccount->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $timesheet_item = array(
            "fullname" => $fullname,
            "account_id" => $account_id,
            "role_id" => $role_id,
            "avatar" => $avatar,
            "user_name" => $user_name,
            "phone_number" => $phone_number,
            "address" => $address,
            "email" => $email,
        );
        array_push($timesheet_array["data"], $timesheet_item);
    }
    echo json_encode($timesheet_array);
}