<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use common\models\User;
use yii\bootstrap4\Html;
use backend\models\Company;
use backend\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <style>
        .disclaimer { display: none; }
    </style>
    <?php $this->beginBody() ?>
    <!-- Begin page -->
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- LOGO -->
            <a href="<?= Url::to(['/site/index'])  ?>" class="logo text-center logo-light">
                <span class="logo-lg">
                    <!-- <img src="assets_ui/images/logo.png" alt="" height="16"> -->
                </span>
                <span class="logo-sm">
                    <img src="assets_ui/images/logo_sm.png" alt="" height="16">
                </span>
            </a>

            <!-- LOGO -->
            <a href="i<?= Url::to(['/site/index'])  ?>" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="assets_ui/images/logo-dark.png" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="assets_ui/images/logo_sm_dark.png" alt="" height="16">
                </span>
            </a>

            <div class="h-100" id="leftside-menu-container" data-simplebar="">

                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-title side-nav-item">Navigation</li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="" href="<?= Url::to(['/site/index'])  ?>" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                            <!-- <span class="badge bg-success float-end">4</span> -->
                            <span> Home </span>
                        </a>
                    </li>
                    <?php
                    if (Yii::$app->user->identity->role == 'teampreneur') {
                    ?>
                    <li class="side-nav-item">
                        <a data-bs-toggle="" href="<?= Url::to(['/department/index'])  ?>" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                            <i class="uil-sort-amount-up"></i>
                            <span> Manage Departments </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="" href="<?= Url::to(['/vendor/index'])  ?>" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                            <i class="uil-sitemap"></i>
                            <span> Manage Vendors </span>
                        </a>
                    </li>

                    <!-- REQUEST TYPES -->
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#requestManagement" aria-expanded="false" aria-controls="requestManagement" class="side-nav-link">
                            <i class="uil-copy"></i>
                            <span> Manage Requests </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="requestManagement">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="<?= Url::to(['/request-types/index'])  ?>">Request Types</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/request/index'])  ?>">Requests</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- PRODUCTS -->
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#productManagement" aria-expanded="false" aria-controls="productManagement" class="side-nav-link">
                            <i class="uil-tag-alt"></i>
                            <span> Manage Products </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="productManagement">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="<?= Url::to(['/product-categories/index'])  ?>">Categories</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/product/index'])  ?>">Products</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- USERS -->
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#usersManagement" aria-expanded="false" aria-controls="usersManagement" class="side-nav-link">
                            <i class="uil-users-alt"></i>
                            <span> Users Management </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="usersManagement">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a href="<?= Url::to(['/user/index'])  ?>">Manage Users</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/auth-item/index'])  ?>">Manage Permissions</a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/auth-assignment/index'])  ?>">Manage Assignments</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#systemConfiguration" aria-expanded="false" aria-controls="systemConfiguration" class="side-nav-link">
                            <i class="uil-cog"></i>
                            <span> Configurations </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="systemConfiguration">
                            <ul class="side-nav-second-level">
                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false" aria-controls="sidebarSecondLevel">
                                        <span> Company Profile </span>
                                        <span class="menu-arrow"></span>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </li>

<?php
   }
?>
                    <li class="side-nav-item">
                        <a data-method="post" href="<?= Url::to(['/site/logout']) ?>" class="side-nav-link">
                            <i class="uil-sign-out-alt"></i>
                            <span> Logout </span>
                        </a>
                        
                    </li>
                </ul>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom">
                    <ul class="list-unstyled topbar-menu float-end mb-0">
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-bell noti-icon"></i>
                                <span class="noti-icon-badge"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="m-0">
                                        <span class="float-end">
                                            <a href="javascript: void(0);" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>

                                <div style="max-height: 230px;" data-simplebar="">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">1 min ago</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-account-plus"></i>
                                        </div>
                                        <p class="notify-details">New user registered.
                                            <small class="text-muted">5 hours ago</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <img src="assets_ui/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="">
                                        </div>
                                        <p class="notify-details">Cristina Pride</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Hi, How are you? What about our next meeting</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary">
                                            <i class="mdi mdi-comment-account-outline"></i>
                                        </div>
                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                            <small class="text-muted">4 days ago</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <img src="assets_ui/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="">
                                        </div>
                                        <p class="notify-details">Karen Robinson</p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Wow ! this admin looks good and awesome design</small>
                                        </p>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info">
                                            <i class="mdi mdi-heart"></i>
                                        </div>
                                        <p class="notify-details">Carlos Crouch liked
                                            <b>Admin</b>
                                            <small class="text-muted">13 days ago</small>
                                        </p>
                                    </a>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="notification-list">
                            <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                                <i class="dripicons-gear noti-icon"></i>
                            </a>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src="<?= Url::base(true) . '/assets_ui/images/users/avatar-1.jpg' ?>" alt="user-image" class="rounded-circle">
                                </span>

                                <h5 class="account-user-name"><?= Html::encode(ucfirst(Yii::$app->user->identity->firstname))  ?></h5>
                                <!-- <span class="account-position">Founder</span> -->

                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                <!-- item-->
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="<?= Url::to(['/user/profile', 'id' => Yii::$app->user->identity->id])  ?>" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a data-method="post" href="<?= Url::to(['/site/logout']) ?>" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>

                    </ul>
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </div>
                <!-- end Topbar -->

                <!-- Start Content-->

                <div class="container-fluid">

                    <?= $content ?>

                </div> <!-- container -->

            </div> <!-- content -->
            <!-- Footer Start -->
            <!--<footer class="footer">-->
            <!--    <div class="container-fluid">-->
            <!--        <div class="row">-->
            <!--            <div class="col text-center">-->
            <!--                <script>-->
            <!--                    document.write(new Date().getFullYear())-->
            <!--                </script> @ ASMS-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</footer>-->
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
