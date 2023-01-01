<?php

use backend\models\AssCat;
use backend\models\Assignment;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assignments';
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
                    <h4 class="page-title">Assignments</h4>
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
                            <select class="form-control select2" data-toggle="select2" id="assignment-download-all-id">
                                <option>Select course</option>
                                <?php
                                $assignments_cat = AssCat::find(['id','cat_name'])->all();
                                foreach ($assignments_cat as $assignment_cat) {
                                ?>
                                <option value="<?= $assignment_cat->id ?>"><?= $assignment_cat->cat_name ?></option> 
                                <?php
                                }
                                ?>
                            </select>
                            </div>
                            <div class="col-md-4"><button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" id="assignment-download-all-btn"><i class="mdi mdi-download text-primary mdi-18px me-1"></i> Download all</button>
                                <button class="dropdown-item" id="assignment-mark-all-btn"><i class="mdi mdi-checkbox-marked-circle-outline text-warning mdi-18px me-1"></i> Mark as received</button>
                            </div>    
                        </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Student</th>
                                        <th>Tittle</th>
                                        <th>Assignment</th>
                                        <th>Submitted</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($assignments as $assignment) {
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td class="table-user">
                                                <?= Html::encode(User::getUsername($assignment->student_id)) ?>
                                            </td>
                                            <td>
                                                <?= Html::encode($assignment->assCat->cat_name) ?>
                                            </td>
                                            <td>
                                                <?= Html::encode($assignment->assignment) ?>
                                            </td>
                                            <td>
                                                <?= Html::encode(Assignment::getDate($assignment->sub_date)) ?>
                                            </td>
                                            <td>
                                            <?= Html::a('<i class="mdi mdi-download text-primary mdi-18px"></i>', ['download', 'id' => $assignment->id]) ?>
                                            <?php
                                            ($assignment->status) ? '' :
                                            Html::a('<i class="mdi mdi-checkbox-marked-circle-outline text-warning mdi-18px"></i>', ['received','class' => 'action-icon' ,'id' =>  $assignment->id], [
                                                            'data' => [
                                                                'confirm' => 'Mark as received?',
                                                                'method' => 'post',
                                                            ],
                                            ]) ?>
                                            </td>
                                        </tr>



                                    <?php
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