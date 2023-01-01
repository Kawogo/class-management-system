<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use backend\models\Course;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\TeacherCourse */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="teacher-course-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $users = User::find()->Where(['role'=>'coach'])->all();
    foreach($users as $user){
        $user->firstname = $user->firstname.' '.$user->surname;
    }
    echo $form->field($model, 'teacher_id')->dropDownList(ArrayHelper::map($users,'id','firstname'), ['prompt' => 'Select user','class' => 'form-control select2', 'data-toggle' => 'select2']) ?>
    </div>


    <?= $form->field($model, 'course_id')->dropDownList(ArrayHelper::map(Course::find()->all(), 'id', 'course_name'), ['prompt' => 'Select course', 'class' => 'form-control select2', 'data-toggle' => 'select2']) ?>


    <div class="form-group mt-2">
    <a href="<?= Url::to(['index']) ?>" class="btn btn-sm btn-primary float-start"><i class="mdi mdi-arrow-left-circle-outline text-light"></i> Back</a>
    <?= Html::submitButton('<i class="mdi mdi-check-all text-light"></i> Save', ['class' => 'btn btn-success btn-sm float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
