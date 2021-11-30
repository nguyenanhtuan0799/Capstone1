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
/// encode
function encrypt($message, $encryption_key)
{
  $key = hex2bin($encryption_key);
  $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
  $nonce = openssl_random_pseudo_bytes($nonceSize);
  $ciphertext = openssl_encrypt(
    $message,
    'aes-256-ctr',
    $key,
    OPENSSL_RAW_DATA,
    $nonce
  );
  return base64_encode($nonce . $ciphertext);
}
function autoGenerate(){
  $string = "qwertyuiopasdfghjklzxcvbnm1234567890";
  return bin2hex(substr(str_shuffle($string),0,20));
}
$pass = autoGenerate();
$signature = $data->electronic_signature;
$encode = encrypt($signature,$pass);





$Profile->account_id = $data->account_id;
$Profile->avatar = $data->avatar;
$Profile->fullname = $data->fullname;
$Profile->phone_number = $data->phone_number;
$Profile->address = $data->address;
$Profile->email = $data->email;
$Profile->headquerter = $data->headquerter;
$Profile->electronic_signature = $encode;
$Profile->passEncode = $pass;


if ($Profile->editProfile()) {
    echo json_encode(array("message", "Account update"));
} else {
    echo json_encode(array("message", "Account update"));
}
