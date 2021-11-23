<!DOCTYPE html>
<html lang="en">

<head>
  <title>History TimeKeeping</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../../assets/css/gird.css" />
  <link rel="stylesheet" href="../../assets/css/common.css" />
  <link rel="stylesheet" href="../../assets/css/header.css" />
  <link rel="stylesheet" href="../../assets/css/footer.css" />
  <link rel="stylesheet" href="../../assets/css/employee/historytimekeeping.css" />
  <link rel="stylesheet" href="../../assets/css/employee/sidebar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />




</head>

<body>
  <?php
  require("../../views/header.php");
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
        require("../../views/employee/patial/historytimekeeping.php");
        ?>
      </div>
    </div>
  </div>
  <?php
  require("../../views/footer.php");
  ?>
  <script src="../../assets/js/employee/history.js"></script>
  <script src="../../assets/js/pagination.js"></script>

</body>

</html>