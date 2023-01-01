<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                                <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index'])  ?>">Home</a></li>
                                </ol>
                                </div>
                    <h4 class="page-title">

                        Add new project</h4>
                </div>

            </div>
        </div>
        <!-- end page title -->
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="p-4">
                    <h4 class="mb-2 text-uppercase">Project Info</h4>
                    <hr>
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="mb-2 col">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="mb-2 col">
                    <?php 

                    $users = User::find()->Where(['role'=>'coach'])->all();
                    foreach($users as $user){
                        $user->firstname = $user->firstname.' '.$user->surname;
                    }
                    echo $form->field($model, 'coach')->dropDownList(ArrayHelper::map($users,'id','firstname'), ['prompt' => 'Select coach','class' => 'form-control select2', 'data-toggle' => 'select2']) 
                    
                    ?>


                    </div>
                    <div class="mb-2 col">
                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                    </div> 

                    <div class="mb-2 col">
                    <!-- Multiple Select -->
                    <label for="">Add members</label>
                    <select name="members[]" class="select2 form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose members...">                 
                    <?php
                    $members = User::find()->where(['role'=>'teampreneur'])->orWhere(['role'=>'team_leader'])->all();
                    foreach($members as $user){
                        $user->firstname = $user->firstname.' '.$user->surname;
                    ?>
                    <option value="<?= $user->id ?>"><?=  $user->firstname  ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    </div>
                    <div class="mb-2">
                    <?php
                    if ($team_members) {
                    ?>
                    <div class="row">
                        <label for="">Team members</label>
                        <?php
                        foreach ($team_members as $team_member) {
                        ?>
                        <div class="col-md-3">

                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= Html::encode(User::getUsername($team_member->member_id)) ?>
                                <a href="<?= Url::to(['/project-member/remove-member','id' => $team_member->member_id, 'project_id' => $team_member->project_id])  ?>" title="Remove" data-bs-toggle="tooltip" data-bs-placement="bottom" class="badge bg-danger rounded-pill"><i class="uil uil-multiply text-white"></i></a>
                                </li>
                            </ul>

                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    }
                    ?>
                    </div>
                    <div class="form-group">
                    <a style="text-decoration: none;" href="<?= Url::to(['index']) ?>" class="btn btn-sm btn-success"><i class="mdi mdi-arrow-left-circle-outline text-light"></i> Back</a>
                    <?= Html::submitButton('<i class="mdi mdi-check-all text-light"></i> Add', ['class' => 'btn btn-primary btn-sm float-end']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

</div></div></div></div>
