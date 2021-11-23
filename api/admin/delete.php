<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods.Authorization,X-Requested-With');



include_once("../../config/db.php");
include_once("../../model/admin/account.php");

$db = new db();
$connect = $db->connect();

$deleteAccount = new Account($connect);
$data = json_decode(file_get_contents("php://input"));

$deleteAccount->account_id = $data->account_id;


if ($deleteAccount->deleteAccount()) {
    // echo json_encode(array("message", "Account Delete"));
} else {
    // echo json_encode(array("message", "Account not Delete"));
}
