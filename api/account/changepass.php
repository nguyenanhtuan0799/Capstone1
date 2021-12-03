<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods.Authorization,X-Requested-With');



include_once("../../config/db.php");
include_once("../../model/account/account.php");

$db = new db();
$connect = $db->connect();

$changePass = new Account($connect);

$data = json_decode(file_get_contents("php://input"));
/// encode


$changePass->account_id = $data->account_id;
$changePass->password = $data->password;



if ($changePass->changePass()) {
    echo json_encode(array("message", "Account update"));
} else {
    echo json_encode(array("message", "Account update"));
}
