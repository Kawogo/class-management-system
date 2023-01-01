<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentCourse */

$this->title = 'Assign Student to Course';
$this->params['breadcrumbs'][] = ['label' => 'Student Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-course-create">
<div class="row mt-3">
        <div class="col-md-6 offset-md-4">
            <div class="card">
                <div class="card-body">
                    <h5><i class="mdi mdi-pencil-plus text-success"></i> Assign students</h5><hr>
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
</div></div></div></div></div>
