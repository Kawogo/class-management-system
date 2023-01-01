<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AssCat */

$this->title = 'Create Tittle';
$this->params['breadcrumbs'][] = ['label' => 'Ass Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ass-cat-create">

    <h4><i class="mdi mdi-pencil-plus text-success"></i> <?= Html::encode($this->title) ?></h4>
    <hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
