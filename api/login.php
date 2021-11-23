
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
            $query = "SELECT * FROM account Where `user_name` =:user_name and `password` =:password";
            $stmt = $connect->prepare($query);
            $stmt->bindParam('user_name', $user_name, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count == 1 && !empty($row)) {
                /******************** Your code ***********************/
                $_SESSION['user_id']   = $row['account_id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['role_id'] = $row['role_id'];
                $type = $row['role_id'];

                switch ($type) {
                    case "2":
                        echo "<script>window.location.href='./views/employee/employeeIndex.php';</script>";
                    case "1":
                        echo "<script>window.location.href='./views/manager/managerIndex.php';</script>";
                    default:
                        break;
                }
            } else {
                echo '<script language="javascript">alert("Username or Password wrong"); window.location="sign.php";</script>';;
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    } else {
        echo '<script language="javascript">alert("userName or Password cannot be blank"); window.location="sign.php";</script>';
    }
}
