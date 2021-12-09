<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once("../../config/db.php");
include_once("../../model/admin/account.php");

$db = new db();
$connect = $db->connect();


$employeeAccount = new Account($connect);
$viewAccount = $employeeAccount->viewAccount();

$num = $viewAccount->rowCount();
if ($num > 0) {
    $employeeAccount_array = [];
    $employeeAccount_array["data"] = [];

    while ($row = $viewAccount->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $employeeAccount_item = array(
            "account_id" => $account_id,
            "user_name" => $user_name,
            "avatar" => $avatar,
            "role_id" => ($role_id == 1) ? "manager" : "employee",
            "fullname" => $fullname,
            "phone_number" => $phone_number,
            "address" => $address,
            "email" => $email,
            "createDate"=>$createDate,
        );
        array_push($employeeAccount_array["data"], $employeeAccount_item);
    }
    echo json_encode($employeeAccount_array);
}
