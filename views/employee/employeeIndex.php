<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/gird.css" />
    <link rel="stylesheet" href="../../assets/css/common.css" />
    <link rel="stylesheet" href="../../assets/css/header.css" />
    <link rel="stylesheet" href="../../assets/css/footer.css" />
    <link rel="stylesheet" href="../../assets/css/employee/sidebar.css" />
    <link rel="stylesheet" href="../../assets/css/employee/timesheet.css" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
</head>

<body>
    <?php
    require("../header.php");
    ?>
    <div class="grid wide">
        <div class="row">
            <div class="col l-2-4">
                <?php
                require("../../views/employee/patial/sidebar.php");
                ?>
            </div>
            <div class="col l-2-8">
                <?php
                require("../../views/employee/patial/timesheets.php");
                ?>
            </div>
        </div>
    </div>
    <?php
    require("../footer.php");
    ?>
</body>

</html>