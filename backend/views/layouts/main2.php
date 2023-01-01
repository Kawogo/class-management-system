<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\models\User;
use yii\bootstrap4\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
     integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
     crossorigin="">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="loading" data-layout="topnav" data-layout-config='{"layoutBoxed":false,"darkMode":false}'>
    <style>
        .disclaimer { display: none; }
    </style>
<?php $this->beginBody() ?>
        <!-- Begin page -->
        <div class="wrapper">

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom topnav-navbar">
                        <div class="container-fluid">

                            <!-- LOGO -->
                            <!-- <a href="< ?= Url::to(['/site/index']) ?>" class="topnav-logo">
                                <span class="topnav-logo-lg">
                                    <img src="assets_ui/images/uongozi_logo.png" alt="" height="60" width="100">
                                </span>
                                <span class="topnav-logo-sm">
                                    <img src="assets_ui/images/logo_sm_dark.png" alt="" height="16">
                                </span>
                            </a> -->

                            <ul class="list-unstyled topbar-menu float-end mb-0">   
                                <li class="dropdown notification-list">
                                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="account-user-avatar"> 
                                            <img src="assets_ui/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                                        </span>
                                        <span>
                                            <span class="account-user-name">
                                            <?= Html::encode(User::getUsername(Yii::$app->user->identity->id)) ?>
                                            </span>
                                            <span class="account-position">
                                            <?= ucfirst(Html::encode(Yii::$app->user->identity->role)) ?>
                                            </span>
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                                        <!-- item-->
                                        <a data-method="post" href="<?= Url::to(['/site/logout']) ?>" class="dropdown-item notify-item">
                                            <i class="mdi mdi-logout me-1"></i>
                                            <span>Logout</span>
                                        </a>
    
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- end Topbar -->

                    <!-- <div class="topnav">
                        <div class="container-fluid">
                            <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">     
                                <div class="collapse navbar-collapse push-right" id="topnav-menu-content">
                                    <ul class="navbar-nav">

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layouts" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="uil-window me-1"></i>Manage Assets <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-layouts">
                                                <a href="< ?= Url::to(['/categories/index']) ?>" class="dropdown-item">Categories</a>
                                                <a href="< ?= Url::to(['/assets/index']) ?>" class="dropdown-item">Assets</a>
                                                <a href="< ?= Url::to(['/owners/index']) ?>" class="dropdown-item">Owners</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div> -->

                    
                    <!-- Start Content-->
                    <div class="container-xxl">

                            <?=  $content ?>

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                <!--<footer class="footer">-->
                <!--    <div class="container-fluid">-->
                <!--        <div class="row">-->
                <!--            <div class="col-md-6">-->
                <!--                <center>-->
                <!--                <script>document.write(new Date().getFullYear())</script> © Uongozi Institute-->
                <!--                </center>-->
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
     <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
     integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
     crossorigin=""></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
