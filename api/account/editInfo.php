<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods.Authorization,X-Requested-With');



include_once("../../config/db.php");
include_once("../../model/account/account.php");

$db = new db();
$connect = $db->connect();

$Profile = new Account($connect);

$data = json_decode(file_get_contents("php://input"));
$Profile->account_id = $data->account_id;
$Profile->avatar = $data->avatar;
$Profile->fullname = $data->fullname;
$Profile->phone_number = $data->phone_number;
$Profile->address = $data->address;
$Profile->email = $data->email;
$Profile->headquerter = $data->headquerter;
$Profile->electronic_signature = $data->electronic_signature;

if ($Profile->editProfile()) {
    echo json_encode(array("message", "Account update"));
} else {
    echo json_encode(array("message", "Account update"));
}
