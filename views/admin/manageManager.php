<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&amp;family=Roboto:wght@300;400;500;700&amp;display=swap"
        rel="stylesheet">
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
            <li class="nav-link">
                <a href="../../views/admin/adminIndex.php">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li class="nav-link active">
                <a href=" ../../views/admin/manageManager.php">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Manager Account</span>
                </a>
            </li>
            <li class="">
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
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input class="input-search" type="text" placeholder="Search..." />
                <i class="bx bx-search btn-search"></i>
            </div>
            <div class="profile-details">
                <!--<img src="images/profile.jpg" alt="">-->
                <span class="admin_name"><?= $_SESSION["user_name"] ?></span>
                <a href="../../api/admin/logoutAdmin.php" class="admin_logout"> Logout</a>
            </div>
        </nav>

        <div class="home-content-m">
            <div class="sales-boxes-m">
                <div class="recent-sales-m box-m">
                    <div class="title-m">Manager</div>
                    <div class="sales-details-m">
                        <table class="js-table-content">
                        </table>
                    </div>
                    <div class=" button">
                        <a href="../../views/admin/create.php">Create</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal js-modal">
            <div class="modal-container js-modal-container">
                <div class="modal-close js-modal-close">
                    <i class='bx bx-x'></i>
                </div>
                <header class="modal-header">
                    <i class="modal-icon-mr16 ti-bag"></i>
                    Reset Password
                </header>
                <div class="modal-body">
                    <div class="modal-body-wrap">
                        <div class="group-info">
                            <label>Username </label>
                            <input class="js-username" type="text" required disabled>
                        </div>

                        <div class="group-info">
                            <label>Password</label>
                            <input class="js-password" name="password" type="password" required>
                        </div>
                    </div>
                    <div class="btn-wraper"></div>
                </div>
            </div>
        </div>
    </section>

    <script src="../../assets/js/admin/admin.js"></script>
    <script src="../../assets/js/admin/viewManager.js"></script>




</body>

</html>