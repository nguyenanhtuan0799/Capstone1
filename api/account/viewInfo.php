<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once("../../config/db.php");
include_once("../../model/account/account.php");

$db = new db();
$connect = $db->connect();

$account = new Account($connect);

$account->account_id = isset($_GET['id']) ? $_GET['id'] : die();

$account->viewInfo();

$account_item = array(
    "account_id" => $account->account_id,
    "user_name" => $account->user_name,
    "avatar" => $account->avatar,
    "role_id" => $account->role_id == 1 ? "Manager" : "Employee",
    "fullname" => $account->fullname,
    "phone_number" => $account->phone_number,
    "address" => $account->address,
    "email" => $account->email,
    "headquerter" => $account->headquerter,
    "electronic_signature" => $account->electronic_signature,

);
print_r(json_encode($account_item));
