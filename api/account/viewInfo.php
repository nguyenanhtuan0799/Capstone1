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

// decode 
function decrypt($message, $encryption_key)
{
  $key = hex2bin($encryption_key);
  $message = base64_decode($message);
  $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
  $nonce = mb_substr($message, 0, $nonceSize, '8bit');
  $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
  $plaintext = openssl_decrypt(
    $ciphertext,
    'aes-256-ctr',
    $key,
    OPENSSL_RAW_DATA,
    $nonce
  );
  return $plaintext;
}
$pass = $account->passEncode;
$signal = $account->electronic_signature;
$decode = decrypt($signal,$pass);

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
    "electronic_signature" => $decode,

);
print_r(json_encode($account_item));
