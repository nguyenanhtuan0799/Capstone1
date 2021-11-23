<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods.Authorization,X-Requested-With');



include_once("../../config/db.php");
include_once("../../model/admin/account.php");

$db = new db();
$connect = $db->connect();

$resetPassword = new Account($connect);

$data = json_decode(file_get_contents("php://input"));
$resetPassword->account_id = $data->account_id;
$resetPassword->password = $data->password;


if ($resetPassword->resetPassword()) {
    echo json_encode(array("message", "Account reset"));
} else {
    echo json_encode(array("message", "Account not reset"));
}
