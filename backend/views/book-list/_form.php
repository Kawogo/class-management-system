<?php

use yii\helpers\Html;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\BookList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-list-form">

    <?php $form = ActiveForm::begin(['action'=>['/book-list/create']]); ?>
    <div class="col mb-2">
    <?= $form->field($model, 'book_title')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col mb-2">
    <?= $form->field($model, 'book_author')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col mb-2">
    <?php
    $users = User::find()->Where(['role'=>'coach'])->all();
    foreach($users as $user){
        $user->firstname = $user->firstname.' '.$user->surname;
    }
    echo $form->field($model, 'coach')->dropDownList(ArrayHelper::map($users,'id','firstname'), ['prompt' => 'Select coach','class' => 'form-control select2', 'data-toggle' => 'select2']) ?>
  
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
