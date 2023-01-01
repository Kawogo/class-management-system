<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use backend\models\AssCat;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Assignment */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="assignment-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div class="row mb-3">
    <div class="col">
            
            <?= $form->field($model, 'teacher_id')->dropDownList(ArrayHelper::map(User::find()->Where(['role'=>'coach'])->all(), 'id', 'email'), ['prompt' => 'Select instructor', 'class' => 'form-control select2', 'data-toggle' => 'select2']) ?>
     
        </div> <!-- end col -->
    </div>

    <div class="row mb-3">
        <div class="col">
            
            <?= $form->field($model, 'ass_cat')->dropDownList(ArrayHelper::map(AssCat::find()->all(), 'id', 'cat_name'), ['prompt' => 'Select category', 'class' => 'form-control select2', 'data-toggle' => 'select2']) ?>
          
        </div>
    </div> <!-- end row -->
    <div class="row mb-3">
    <div class="col">
        <?= $form->field($model, 'assignments[]')->fileInput(['autofocus' => true,'class'=>'form-control','multiple'=>true]) ?>
    </div> <!-- end col -->
    </div>


    <div class="form-group mt-2">
        <a href="<?= Url::to(['/site/index']) ?>" class="btn btn-sm btn-primary float-start"><i class="mdi mdi-arrow-left-circle-outline text-light"></i> Back</a>
        <?= Html::submitButton('<i class="mdi mdi-check-all text-light"></i> Save', ['class' => 'btn btn-success btn-sm float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
