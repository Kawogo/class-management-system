<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/uibp/backend/web/assets_ui/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
    <link href="/uibp/backend/web/assets_ui/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        <style>
        .disclaimer { display: none; }
    </style>
<?php $this->beginBody() ?>

<?= $content ?>
   

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
