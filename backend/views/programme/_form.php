<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Programme */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="programme-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col mb-2">
    <?= $form->field($model, 'program_name')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($model, 'yos')->textInput() ?>

    <div class="form-group d-grid mt-2">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
