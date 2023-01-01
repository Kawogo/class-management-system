<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Timetable */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="timetable-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="col mb-2">
    <?= $form->field($model, 'tittle')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'timetables')->fileInput(['autofocus' => true,'class'=>'form-control']) ?>


    <div class="form-group mt-2">
    <a href="<?= Url::to(['index']) ?>" class="btn btn-sm btn-primary float-start"><i class="mdi mdi-arrow-left-circle-outline text-light"></i> Back</a>
    <?= Html::submitButton('<i class="mdi mdi-check-all text-light"></i> Save', ['class' => 'btn btn-success btn-sm float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
