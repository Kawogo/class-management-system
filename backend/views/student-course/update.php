<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentCourse */

$this->title = 'Update Student Course: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
