<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once("../../config/db.php");
include_once("../../model/admin/managerAccount.php");

$db = new db();
$connect = $db->connect();


$ManagerAccount = new ManagerAccount($connect);
$viewAccount = $ManagerAccount->viewAccount();

$num = $viewAccount->rowCount();
if ($num > 0) {
    $managerAccount_array = [];
    $managerAccount_array["data"] = [];

    while ($row = $viewAccount->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $managerAccount_item = array(
            "account_id" => $account_id,
            "user_name" => $user_name,
            "avatar" => $avatar,
            "role_id" => $role_id = 1 ? "manager" : "employee",
            "fullname" => $fullname,
            "phone_number" => $phone_number,
            "address" => $address,
            "email" => $email,
        );
        array_push($managerAccount_array["data"], $managerAccount_item);
    }
    echo json_encode($managerAccount_array);
}
