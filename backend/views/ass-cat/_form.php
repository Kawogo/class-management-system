<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AssCat */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="ass-cat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group d-grid mt-2">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
