<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use backend\models\Course;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentCourse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-course-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col mb-3 mt-2">
    <?= $form->field($model, 'course_id')->dropDownList(ArrayHelper::map(Course::find()->all(), 'id', 'course_name'), ['prompt' => 'Select course', 'class' => 'form-control select2', 'data-toggle' => 'select2']) ?>
    </div>
    <?= $form->field($model, 'student_id')->dropDownList(ArrayHelper::map(User::find()->Where(['role'=>'teampreneur'])->all(), 'id', 'email'), ['prompt' => 'Select student(s)', 'class' => 'form-control select2', 'data-toggle' => 'select2','multiple'=>'multiple']) ?>
    <div class="form-group mt-2">
        <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-sm btn-primary float-start"><i class="mdi mdi-arrow-left-circle-outline text-light"></i> Back</a>
        <?= Html::submitButton('<i class="mdi mdi-check-all text-light"></i> Save', ['class' => 'btn btn-success btn-sm float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
