<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign</title>
    <link rel="icon" href="./assets/images/male-clothes.ico">
    <link href="./assets/css/sign.css" rel="stylesheet">
    <link href="./assets/css/common.css" rel="stylesheet">

</head>

<body>
    <?php
    require_once("./api/admin/loginAdmin.php");
    ?>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="signAdmin.php" method="POST">
                <h1>Sign in Admin</h1>
                <div class="social-container">
                </div>
                <span>Use your account</span>
                <input type="text" name="user_name" placeholder="User Name" />
                <input type="password" name="password" placeholder="Password" />
                <a href="#">Forgot your password?</a>
                <button name="btn_submit" type="submit">Sign In</button>
            </form>
            <div class="signAdmin"><a href="../../caps1/sign.php">Sign</a></div>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>