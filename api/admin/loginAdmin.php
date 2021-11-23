
<?php
session_start();
require_once("./config/db.php");
?>

<?php

$db = new db();
$connect = $db->connect();

if (isset($_POST["btn_submit"])) {
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    if ($user_name != "" && $password != "") {
        try {
            $query = "SELECT * FROM admin Where `user_name` =:user_name and `password` =:password";
            $stmt = $connect->prepare($query);
            $stmt->bindParam('user_name', $user_name, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count == 1 && !empty($row)) {
                /******************** Your code ***********************/
                $_SESSION['user_id']   = $row['admin_id'];
                $_SESSION['user_name'] = $row['user_name'];
                echo "<script>window.location.href='../../caps1/views/admin/adminIndex.php';</script>";
            } else {
                echo '<script language="javascript">alert("Username or Password không đúng"); window.location="signAdmin.php";</script>';;
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    } else {
        echo '<script language="javascript">alert("userName or Password không được để trống"); window.location="signAdmin.php";</script>';
    }
}
