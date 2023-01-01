<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

 

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index'])  ?>">Home</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Project Attendance</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- // display success message -->
        <?php if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong><i class='mdi mdi-check-all'></i> </strong> <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <!-- // display error message -->
        <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong><i class='mdi mdi-alert-outline'></i>Error! - </strong> <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <!-- end of messages display -->

        <div  class="row project_attendance_div" style="display: inline;">
        <div>
        </div>
            <div class="col">
                <input type="hidden" value="<?= $id ?>" id="project-attendance-id">
                <?php
                foreach ($members as $member) {
                ?>
          
               <div class="form-check form-check-inline mb-2">
                  <input type="checkbox" class="form-check-input" id="project_attendance_id" value="<?= Html::encode($member->member_id) ?>">
                  <label class="form-check-label" for="customCheck3"><?= Html::encode(User::getUsername($member->member_id)) ?></label>
                </div>  

                <?php
                }
                ?>
            </div>
            <div>
            <a href="<?= Url::to(['project/index']) ?>" class="btn btn-sm btn-success mt-5" id="">Back</a>
            <button class="btn btn-sm btn-primary mt-5" id="project-attendance-submit-btn">Submit</button>
            </div>
        </div>

        <div class="row mt-3">
            <h4 class="text-center mb-2"><strong class="project_attendance_loading-gif" style="display: none;">Submiting attendance...</strong></h4>
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-success project_attendance_loading-gif-spin" role="status" style="display: none;"></div>
            </div>
        </div>

        <div class="row project_attendance_success-msg" style="display: none;">
            <div class="col">
                <div class="text-center">
                    <h2 class="mt-0"><i class="mdi mdi-check-all text-success"></i></h2>
                    <h3 class="mt-0 text-primary">Thank you !</h3>

                    <p class="">Attendance sent sucessful.</p>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->




</div>




