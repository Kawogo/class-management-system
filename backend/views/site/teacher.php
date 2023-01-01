<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use backend\models\Assets;
use common\models\User;
use backend\models\Assignment;

/** @var yii\web\View $this */

$this->title = 'SMS';
?>
<div class="">                      
                        <div class="row">
                            <div class="col-xl-3 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <i class='mdi mdi-file-multiple-outline mdi-36px float-end text-success'></i>
                                        <h6 class="text-uppercase mt-0">Assignments</h6>
                                        <h2 class="my-2" id="active-users-count"><?= Html::encode($ass_count) ?></h2>
                                        <a href="<?= Url::to(['/assignment/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-success me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all assignments</span>  
                                        </a>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <div class="col-xl-3 col-lg-3">                                
                                <div class="card">
                                    <div class="card-body">
                                     <i class='mdi mdi-widgets mdi-36px float-end text-warning'></i>
                                        <h6 class="text-uppercase mt-0">Assignment Categories</h6>
                                        <h2 class="my-2" id="active-users-count"><?= Html::encode('') ?>3</h2>
                                        <a href="<?= Url::to(['/ass-cat/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-warning me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all categories</span>  
                                        </a>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <div class="col-xl-3 col-lg-3">                                
                                <div class="card">
                                    <div class="card-body">
                                     <i class='mdi mdi-account-group mdi-36px float-end text-primary'></i>
                                        <h6 class="text-uppercase mt-0">Attendance</h6>
                                        <h2 class="my-2" id="active-users-count"><?= Html::encode('') ?>...</h2>
                                        <a href="<?= Url::to(['/attendance/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-primary me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all attendance</span>  
                                        </a>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div>

                            <div class="col-xl-3 col-lg-3">                                
                                <div class="card">
                                    <div class="card-body">
                                     <i class='mdi mdi-book-open-variant mdi-36px float-end text-success'></i>
                                        <h6 class="text-uppercase mt-0">Books Readings</h6>
                                        <h2 class="my-2" id="active-users-count"><?= Html::encode('') ?>...</h2>
                                        <a href="<?= Url::to(['/book-list/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-primary me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all books</span>  
                                        </a>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div>

                            <div class="col-xl-3 col-lg-3">                                
                                <div class="card">
                                    <div class="card-body">
                                     <i class='mdi mdi-account-group mdi-36px float-end text-primary'></i>
                                        <h6 class="text-uppercase mt-0">Projects</h6>
                                        <h2 class="my-2" id="active-users-count"><?= Html::encode('') ?>...</h2>
                                        <a href="<?= Url::to(['/project/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-primary me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all projects</span>  
                                        </a>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div>
                            <div class="col-xl-3 col-lg-3">                                
                                <div class="card">
                                    <div class="card-body">
                                     <i class='mdi mdi-account-group mdi-36px float-end text-primary'></i>
                                        <h6 class="text-uppercase mt-0">Project Attendances</h6>
                                        <h2 class="my-2" id="active-users-count"><?= Html::encode('') ?>...</h2>
                                        <a href="<?= Url::to(['/project/view-attendances'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-primary me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all attendance</span>  
                                        </a>
                                    </div> <!-- end card-body-->
                                </div>
                                <!--end card-->
                            </div>

                        </div>
                        <!-- end row-->

</div>
