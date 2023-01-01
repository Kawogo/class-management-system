<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Programme */

$this->title = 'Add Programme';
$this->params['breadcrumbs'][] = ['label' => 'Programmes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programme-create">

<h4><i class="mdi mdi-pencil-plus text-success"></i> <?= Html::encode($this->title) ?></h4>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
