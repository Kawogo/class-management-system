<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AssCat */

$this->title = 'Update Tittle: ' . $model->cat_name;
$this->params['breadcrumbs'][] = ['label' => 'Ass Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ass-cat-update">
<h4><i class="mdi mdi-pencil-plus text-success"></i> <?= Html::encode($this->title) ?></h4><hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
