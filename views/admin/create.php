<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&amp;family=Roboto:wght@300;400;500;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../../assets/css/admin/admin.css">
    <link rel="stylesheet" href="../../assets/css/admin/base.css">
    <link rel="stylesheet" href="../../assets/css/admin/create.css">


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
            <li>
                <a href="../../views/admin/adminIndex.php" class="active">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="../../views/admin/manageManager.php">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Manager Account</span>
                </a>
            </li>
            <li>
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
                <input type="text" placeholder="Search..." />
                <i class="bx bx-search"></i>
            </div>
            <div class="profile-details">
                <!--<img src="images/profile.jpg" alt="">-->
                <span class="admin_name"><?= $_SESSION["user_name"] ?></span>
                <a href="../../api/admin/logoutAdmin.php" class="admin_logout"> Logout</a>
            </div>
        </nav>

        <div class="home-content">
            <div class="containerss">
                <h2>Create Account</h2>
                <form>
                    <div class="group">
                        <input type="text" name="username" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Username : </label>
                    </div>
                    <div class="group">
                        <input type="password" name="password" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Password : </label>
                    </div>
                    <div class="group-wrap">
                        <label for="type" class="group-label">Type : </label>
                        <select name="type" id="type">
                            <option>(Choose another Type)</option>
                            <option value="1">Manager</option>
                            <option value="2">Employee</option>
                        </select>
                    </div>
                </form>
                <button class="snip js-btn" onclick="handelCreate()"><a href="./create.html">Create</a></button>
            </div>
    </section>

    <script src="../../assets/js/admin/admin.js"></script>
    <script src="../../assets/js/admin/create.js"></script>

</body>

</html>