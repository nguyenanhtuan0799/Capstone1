<?php
session_start();
?>
<header>
  <div class="app-header">
    <div class="grid wide">
      <div class="row">
        <div class="col l-8">
          <div class="header-nav">
            <ul class="header-nav__list">
              <li class="header-nav__item">
                <a href="
                <?php
                if ($_SESSION['role_id'] == 2) {
                  echo "../../views/employee/employeeIndex.php";
                } else {
                  if ($_SESSION['role_id'] == 1)
                    echo  "../../views/manager/managerIndex.php";
                }
                ?>
                " class="header-nav__item-link">
                  <img src="../../assets/img/logoWeb.png" alt="" />
                  IWA
                </a>
              </li>
              <li class="header-nav__item">
                <a href="
                <?php
                if ($_SESSION['role_id'] == 2) {
                  echo "../../views/employee/employeeIndex.php";
                } else {
                  if ($_SESSION['role_id'] == 1)
                    echo  "../../views/manager/managerIndex.php";
                }
                ?>
                " class="header-nav__item-link">HOME</a>

              </li>
              <li class="header-nav__item">
                <a href="" class="header-nav__item-link">EMPLOYEE</a>
              </li>
              <li class="header-nav__item">
                <a href="
                <?php
                if ($_SESSION['role_id'] == 2) {
                  echo "../../views/employee/timekeepingIndex.php";
                } else {
                  echo "";
                }
                ?>
                " class="header-nav__item-link">TIMEKEEPING</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col l-4">
          <div class="header-user">
            <ul class="header-user__list">
              <li class="header-user__item">
                <div class="header-user__item-nofi">
                  <i class="bx bxs-bell"></i>
                  <span class="header-user__item-nofi__count">2</span>
                  <div class="header-user__nofi">
                    <div class="header-user__nofi-heading">
                      <h1>Notifications</h1>
                    </div>
                    <div class="header-user__nofi-body">
                      <ul class="header-user__nofi-list">
                        <li class="header-user__nofi-item">
                          <a class="header-user__nofi-link" href="">
                            <span class="header-user__nofi-desc">
                              Nguyena has timekeeping needs your approval
                            </span>
                            <span class="header-user__nofi-date">
                              12/12/2021
                            </span>
                          </a>
                        </li>
                        <li class="header-user__nofi-item">
                          <a class="header-user__nofi-link" href="">
                            <span class="header-user__nofi-desc">
                              Nguyena has timekeeping needs your approval
                            </span>
                            <span class="header-user__nofi-date">
                              12/12/2021
                            </span>
                          </a>
                        </li>
                        <li class="header-user__nofi-item">
                          <a class="header-user__nofi-link" href="">
                            <span class="header-user__nofi-desc">
                              Nguyena has timekeeping needs your approval
                            </span>
                            <span class="header-user__nofi-date">
                              12/12/2021
                            </span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="header-user__nofi-footer">
                      <a href="">Views All....</a>
                    </div>
                  </div>
                </div>
              </li>
              <li class="header-user__item">
                <div class="header-user__item-info">
                  <img src="../../assets/img/noneUSer.png" alt="image-User" />
                  <span class="header-user__item-name">
                    <?= $_SESSION['user_name'] ?>
                  </span>
                  <span class="header-user__item-icon">
                    <i class="bx bxs-down-arrow"> </i>
                  </span>
                  <div class="header-user__info-select">
                    <ul class="header-user__info-list">
                      <li class="header-user__info-item">
                        <a href="
                         <?php
                          if ($_SESSION['role_id'] == 2) {
                            echo "../../views/employee/employeeProfile.php";
                          } else {
                            echo "../../views/manager/managerProfile.php";
                          }
                          ?>
                        " class="header-user__info-link1">
                          Profile
                        </a>
                      </li>
                      <li class="header-user__info-item">
                        <a href="<?php
                          if ($_SESSION['role_id'] == 2) {
                            echo "../../views/employee/changepass.php";
                          } else {
                            echo "../../views/manager/changepass.php";
                          }
                          ?>" class="header-user__info-link1">
                          Change Password
                        </a>
                      </li>
                      <li class="header-user__info-item">
                        <a href="../../api/logout.php" class="header-user__info-link1">
                          Logout
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="empty" data-index="<?= $_SESSION['user_id'] ?>"></div>

</header>