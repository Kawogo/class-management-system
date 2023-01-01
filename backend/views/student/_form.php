<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use backend\models\Programme;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Student */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(['action'=>['/student/create']]); ?>

    <!--< ?= $form->field($model, 'programme')->textInput(['maxlength' => true]) ?>-->
     <?= $form->field($model, 'programme')->dropDownList(ArrayHelper::map(Programme::find()->all(), 'id', 'program_name'), ['prompt' => 'Select programme', 'class' => 'form-control select2', 'data-toggle' => 'select2']) ?>

    <div class="form-group mt-2 d-grid">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
