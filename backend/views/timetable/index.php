<?php

use backend\models\timetable;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Timetables';
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
                    <h4 class="page-title">Timetables</h4>
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
                            <div class="col">
                            <div class="col-sm-4">                     
                                <a href="<?=  Url::to(['/timetable/create']) ?>" class="btn btn-sm btn-primary mb-2"><i class="mdi mdi-plus-circle-outline me-1"></i> Upload</a>
                            </div>
                            </div><!-- end col-->
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
                                        <th>Tittle</th>
                                        <th>Timetable</th>
                                        <th style="width: 75px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($timetables as $timetable) {
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td class="table-user">
                                                <?= Html::encode($timetable->tittle) ?>
                                            </td>
                                            <td>
                                                <?= Html::encode($timetable->timetable) ?>
                                            </td>
                                            <td>
                                            <?= Html::a('<i class="mdi mdi-delete text-danger mdi-18px"></i>', ['delete','class' => 'action-icon' ,'id' =>  $timetable->id], [
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this timetable?',
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