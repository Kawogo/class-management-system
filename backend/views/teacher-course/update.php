<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TeacherCourse */

$this->title = 'Update Teacher Course: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teacher Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-course-update">
<div class="row mt-3">
        <div class="col-md-6 offset-md-4">
            <div class="card">
                <div class="card-body">
                    <h5><i class="mdi mdi-pencil-plus text-success"></i> Update teacher to course</h5><hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div></div></div></div>
