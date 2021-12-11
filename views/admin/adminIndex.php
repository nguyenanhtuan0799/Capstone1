<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../../assets/css/admin/admin.css">
    <link rel="stylesheet" href="../../assets/css/admin/base.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php

    session_start();


    ?>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name">IWA</span>
        </div>
        <ul class="nav-links">
            <li class="nav-link active">
                <a href="../../views/admin/adminIndex.php">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li class="nav-link ">
                <a href=" ../../views/admin/manageManager.php">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Manager Account</span>
                </a>
            </li>
            <li class="nav-link ">
                <a href="../../views/admin/manageEmployee.php">
                    <i class="bx bx-pie-chart-alt-2"></i>
                    <span class="links_name">Employee Account</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="profile-details">
                <!--<img src="images/profile.jpg" alt="">-->
                <span class="admin_name"><?= $_SESSION["user_name"] ?></span>
                <a href="../../api/admin/logoutAdmin.php" class="admin_logout"> Logout</a>
            </div>
        </nav>

        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total account manager</div>
                        <div class="number manager_account"></div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-cart-alt cart'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total account employee</div>
                        <div class="number employee_account"></div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bxs-cart-add cart two'></i>
                </div>

                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total account</div>
                        <div class="number total_account"></div>
                        <div class="indicator">
                            <i class='bx bx-down-arrow-alt down'></i>
                            <span class="text">Down From Today</span>
                        </div>
                    </div>
                    <i class='bx bxs-cart-download cart four'></i>
                </div>
            </div>

            <div class="sales_boxes">

            </div>
        </div>
    </section>
    <script src="../../assets/js/admin/admin.js"></script>
    <script>
        const sales_boxes = document.querySelector('.sales_boxes')
        const urlApii = 'http://localhost/caps1/api/admin/viewemployee.php'
        const urlApi = 'http://localhost/caps1/api/admin/viewmanager.php'
        const manager_number = document.querySelector(".manager_account")
        const employee_number = document.querySelector(".employee_account")
        const total_number = document.querySelector(".total_account")

        let a, b;

        function managerAccount(callback) {
            fetch(urlApi)
                .then(function(res) {
                    console.log(res)
                    return res.json();
                })
                .then(callback)
        }

        function render({
            data
        }) {
            manager_number.innerHTML = data.length;
            console.log(manager_number.innerText);
        }
        managerAccount(render)

        function employeeAccount(callback) {
            fetch(urlApii)
                .then(function(res) {
                    return res.json();
                })
                .then(callback)
        }

        function renders({
            data
        }) {
            employee_number.innerHTML = data.length;
        }
        employeeAccount(renders)

        function totalAccount() {
            total_number.innerText = parseInt(manager_number.innerText) + parseInt(employee_number.innerText)
        }
        setTimeout(totalAccount, 1000);
    </script>

</body>

</html>