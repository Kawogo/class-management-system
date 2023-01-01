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
                    <h4 class="page-title">Projects</h4>
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

                                    <div class="row"> 
                                    <?php
                                    if (Yii::$app->user->identity->role == 'project_leader') {
                                    ?> 
                                        <div>
                                        <a href="<?= Url::to(['create']) ?>" class="btn btn-success btn-sm mb-2">Add new project</a>
                                        <a href="<?= Url::to(['view-attendances']) ?>" class="btn btn-sm btn-primary float-end">View Attendances</a>
                                        </div>   
                                        
                                    <?php
                                    }
                                    ?>
                                

                                    <div class="col-md-6">
                                    <div class="card">
                                            <div class="card-header bg-light">
                                            <h5 class="mt-0 task-header text-uppercase text-warning">ON PROGRESS (3)</h5><hr>
                                            </div>
                                            <div class="card-body bg-light">
                                                                                        
                                        <div>
                                            <?php
                                            if ($projects_progress) {
                                                foreach ($projects_progress as $project) {
                                            ?>
                                        <!-- Task Item -->
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted"><i>Created at <?= Html::encode(User::getTime($project->created_at)) ?></i></small>
                                                <h5 class="mt-2 mb-2">
                                                    <a href="<?=  Url::to(['view', 'id'=> $project->id]) ?>" class="text-body"><?= Html::encode($project->title) ?></a>
                                                </h5>

                                                <div class="dropdown float-end">
                                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <!-- item-->
                                                        <a href="<?= Url::to(['update', 'id'=> $project->id]) ?>" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                                        <!-- item-->
                                                        <a href="<?= Url::to(['delete', 'id'=> $project->id]) ?>" data-method = "POST" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                                        <button $(this).displayMyId(<?= Html::encode($project->id) ?>) class="dropdown-item"><i class="mdi mdi-map-marker-plus-outline me-1"></i>Add Location</button>
                                                        <a href="<?= Url::to(['attendance', 'id' => $project->id]) ?>" class="dropdown-item"><i class="mdi mdi-file-upload-outline me-1"></i>Take Attendance</a>
                                                        
                                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-file-upload-outline me-1"></i>Submit report</a>

                                                        <a href="<?= Url::to(['update-status', 'id'=>$project->id , 'stage' => 1]) ?>" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Update status</a>

                                                    </div>
                                                </div>

                                                <p class="mb-0">
                                                    <img src="assets_ui/images/users/avatar.jpg" alt="user-img" class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle"><?= Html::encode(User::getUsername($project->leader)) ?></span>
                                                </p>
                                            </div> <!-- end card-body -->
                                        </div>
                                         <!-- Task Item End -->
                                         <?php
                                                 }
                                                 }
                                         else{
                                       ?>
                                       <h5 class="text-danger">NO PROJECTS AVAILABLE.</h5>
                                       <?php
                                        } ?>
                                                        
                                            </div> <!-- end company-list-1-->
                                        </div>
                                     </div>

                                     

                                    </div>


                                    <div class="col-md-6">
                                    <div class="card">
                                            <div class="card-header bg-light">
                                            <h5 class="mt-0 task-header text-uppercase text-primary">COMPLETED (3)</h5><hr>
                                            </div>
                                            <div class="card-body bg-light">
                                                                                        
                                        <div>
                                            <?php
                                            if ($projects_completed) {
                                                foreach ($projects_completed as $project) {
                                            ?>
                                        <!-- Task Item -->
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted"><?= Html::encode(User::getTime($project->created_at)) ?></small>
                                                <h5 class="mt-2 mb-2">
                                                    <a href="<?=  Url::to(['view', 'id'=> $project->id]) ?>" class="text-body"><?= Html::encode($project->title) ?></a>
                                                </h5>

                                                <div class="dropdown float-end">
                                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <!-- item-->
                                                        <a href="<?= Url::to(['update', 'id'=> $project->id]) ?>" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                                        <!-- item-->
                                                        <a href="<?= Url::to(['delete', 'id'=> $project->id]) ?>" data-method = "POST" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>

                                                        <!-- <input type="hidden" value="< ?= Html::encode($project->id) ?>" id="add-project-location-to-db-id"> -->
                                                        <button onclick="$(this).displayMyId(<?= Html::encode($project->id) ?>)" class="dropdown-item"><i class="mdi mdi-map-marker-plus-outline me-1"></i>Add Location</button>
                                                        <!-- item-->
                                                        <a href="<?= Url::to(['attendance', 'id' => $project->id]) ?>" class="dropdown-item"><i class="mdi mdi-file-upload-outline me-1"></i>Take Attendance</a>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-file-upload-outline me-1"></i>Submit report</a>

                                                    </div>
                                                </div>

                                                <p class="mb-0">
                                                    <img src="assets_ui/images/users/avatar.jpg" alt="user-img" class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle"><?= Html::encode(User::getUsername($project->leader)) ?></span>
                                                </p>
                                            </div> <!-- end card-body -->
                                        </div>
                                         <!-- Task Item End -->
                                         <?php
                                                 }
                                                 }
                                         else{
                                       ?>
                                       <h5 class="text-danger">NO PROJECTS AVAILABLE.</h5>
                                       <?php
                                        } ?>
                                                        
                                            </div> <!-- end company-list-1-->
                                        </div>
                                     </div>

                                     

                                    </div>
                              
                        
</div>
                        <!-- end row-->




</div>




