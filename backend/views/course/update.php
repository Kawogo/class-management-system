<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Course */

$this->title = 'Update Course: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-update">

<h4><i class="mdi mdi-pencil-plus text-success"></i> <?= Html::encode($this->title) ?></h4><hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
