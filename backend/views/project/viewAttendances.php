<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use backend\models\Course;
use yii\grid\ActionColumn;
use backend\models\Project;
use backend\models\timetable;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

 

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index'])  ?>">Home</a></li>
                        </ol>
                    </div>
                    <h4 class="page-title">Project Attendances</h4>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-3 mb-2">
                            <select class="form-control select2" data-toggle="select2" id="project-id-attendance-download">
                                <option>Select course</option>
                                <?php
                                $courses = Project::find()->all();
                                foreach ($courses as $course) {
                                ?>
                                <option value="<?= $course->id ?>"><?= $course->title ?></option> 
                                <?php
                                }
                                ?>
                            </select>
                            </div>
                            <div class="col-md-3 mb-2">
                            <div id="datepicker1" class="position-relative">
                            <input type="text" class="form-control" data-provide="datepicker" data-date-container="#datepicker1" placeholder="Select date" id="date-project-attendance-download">
                            </div>
                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-success bt-sm" id="project-attendance-download-btn" type="button"><i class="mdi mdi-file-download-outline me-1"></i> Get Atendance</button>
                            </div>                            
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>

                                        <th>Project Team</th>
                                        <th>Teampreneur</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($projects as $data) {
                                        foreach ($data->projectAttendances as $attendance) { 
                                    ?>
                                        <tr>
                                            <td class="table-user">
                                                <?= Html::encode($data->title) ?>
                                            </td>
                                            <td>
                                                <?= Html::encode(User::getUsername($attendance->member_id)) ?>
                                            </td>
                                            <td>
                                                <?= Html::encode(User::getTime($attendance->date)) ?>
                                            </td>
                                            <td>
                                                <?=
                                                ($attendance->status == 1) ? '<span class="badge badge-success-lighten">Present</span>' : '<span class="badge badge-danger-lighten">Absent</span>';
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->




</div>