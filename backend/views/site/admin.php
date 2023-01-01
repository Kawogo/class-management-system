<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use backend\models\Assets;
use backend\models\Assignment;

/** @var yii\web\View $this */

$this->title = 'SMS';
?>
<div class="">                      
                        <div class="row">
                            <div class="col-xl-3 col-lg-3">
                                <div class="card">
                                    <div class="card-body pt-4 pb-4">
                                        <i class='mdi mdi-account-group mdi-36px float-end text-success'></i>
                                        <h4 class="text-uppercase mt-0">Users</h4>
                                        <!--<h4 class="my-2" id="active-users-count"><?= Html::encode($ass_count) ?></h4>-->
                                        <a href="<?= Url::to(['/user/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-success me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all users</span>  
                                        </a>
                                    </div> <!-- end card-body pt-4 pb-4-->
                                </div>
                                <!--end card-->
                            </div>
                            <div class="col-xl-3 col-lg-3">                                
                                <div class="card">
                                    <div class="card-body pt-4 pb-4">
                                     <i class='mdi mdi-widgets mdi-36px float-end text-warning'></i>
                                        <h4 class="text-uppercase mt-0">Courses</h4>
                                        <!--<h4 class="my-2" id="active-users-count"><?= Html::encode('') ?>3</h4>-->
                                        <a href="<?= Url::to(['/course/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-warning me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all courses</span>  
                                        </a>
                                    </div> <!-- end card-body pt-4 pb-4-->
                                </div>
                                <!--end card-->
                            </div>
                            <div class="col-xl-3 col-lg-3">                                
                                <div class="card">
                                    <div class="card-body pt-4 pb-4">
                                     <i class='mdi mdi-folder-clock-outline mdi-36px float-end text-dark'></i>
                                        <h4 class="text-uppercase mt-0">Programmes</h4>
                                        <!--<h4 class="my-2" id="active-users-count"><?= Html::encode('') ?>7</h4>-->
                                        <a href="<?= Url::to(['/programme/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-dark me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all programmes</span>  
                                        </a>
                                    </div> <!-- end card-body pt-4 pb-4-->
                                </div>
                                <!--end card-->
                            </div>
                            <div class="col-xl-3 col-lg-3">                                
                                <div class="card">
                                    <div class="card-body pt-4 pb-4">
                                     <i class='mdi mdi-calendar-month-outline mdi-36px float-end text-danger'></i>
                                        <h4 class="text-uppercase mt-0">Timetables</h4>
                                        <!--<h4 class="my-2" id="active-users-count"><?= Html::encode('') ?>...</h4>-->
                                        <a href="<?= Url::to(['/timetable/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-danger me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all timetables</span>  
                                        </a>
                                    </div> <!-- end card-body pt-4 pb-4-->
                                </div>
                                <!--end card-->
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-lg-3">
                                <div class="card">
                                    <div class="card-body pt-4 pb-4">
                                        <i class='mdi mdi-account-edit mdi-36px float-end text-primary'></i>
                                        <h4 class="text-uppercase mt-0">Teacher/Course</h4>
                                        <!--<h4 class="my-2" id="active-users-count"><?= Html::encode($ass_count) ?></h4>-->
                                        <a href="<?= Url::to(['/teacher-course/index'])  ?>" class="mb-0 text-muted" style="text-decoration: none;">
                                            <span class="text-primary me-2"><span class="mdi mdi-arrow-right-bold"></span></span>
                                            <span class="text-nowrap">See all teachers/course</span>  
                                        </a>
                                    </div> <!-- end card-body pt-4 pb-4-->
                                </div>
                                <!--end card-->
                            </div>
                        </div>

</div>
