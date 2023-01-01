<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \backend\models\ResetPasswordForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">                            
                            <div class="card-body p-4">                                
                                <div class="text-center w-100 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 fw-bold">
                                    <i class="mdi mdi-lock-reset text-success"></i>
                                        Choose Password
                                    </h4>
                                    <p class="text-muted mb-4">Make sure the passwords matches.</p>
                                </div>
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

    <div class='mb-3'>
    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
    </div>
    <div class="mb-3">
      <?= $form->field($model, 'password_verify')->passwordInput(['autofocus' => true]) ?>  
    </div>

                <div class="mb-3 mb-0 text-center d-grid">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-sm']) ?>
                </div>

               <?php ActiveForm::end(); ?>
</div></div></div></div></div></div></div>
