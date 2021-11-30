<!DOCTYPE html>
<html lang="en">

<head>
  <title>Timekeeping</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../../assets/css/common.css" />
  <link rel="stylesheet" href="../../assets/css/employee/footer.css" />
  <link rel="stylesheet" href="../../assets/css/gird.css" />
  <link rel="stylesheet" href="../../assets/css/header.css" />
  <link rel="stylesheet" href="../../assets/css/employee/timkeeping.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
  <?php
  require("../../views/header.php");
  ?>
  <div class="container-fluid">
    <?php
    require("../../views/employee/patial/timekeeping.php");
    ?>
  </div>
  <?php
  require("../../views/footer.php");
  ?>
 <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</body>

</html>