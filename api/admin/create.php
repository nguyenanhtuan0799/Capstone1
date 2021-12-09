<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods.Authorization,X-Requested-With');



include_once("../../config/db.php");
include_once("../../model/admin/account.php");

$db = new db();
$connect = $db->connect();

$createAccount = new Account($connect);

$data = json_decode(file_get_contents("php://input"));
$createAccount->user_name = $data->user_name;
$createAccount->password = $data->password;
$createAccount->role_id = $data->role_id;
$createAccount->createDate = $data->createDate;



if ($createAccount->createAccount()) {
    echo json_encode(array("message", "Account Create"));
} else {
    echo json_encode(array("message", "Account not Create"));
}
