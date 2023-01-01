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
                    <h4 class="page-title">Book List</h4>
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
                        <div class="table-responsive">
                            <table class="table table-centered table-striped dt-responsive nowrap w-100" id="products-datatable">
                                <thead>
                                    <tr>
                                        <th>Teampreneur</th>
                                        <th>Book Title</th>
                                        <th>Book Author</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($book_list as $data) {
                                    ?>
                                        <tr>
                                            <td class="table-user">
                                                <?= Html::encode(User::getUsername($data->student->id)) ?>
                                            </td>
                                            <td>
                                                <?= Html::encode($data->book_title) ?>
                                            </td>
                                            <td>
                                                <?= Html::encode($data->book_author) ?>
                                            </td>
                                            <td><?= Html::encode($data->status) ? '<span class="badge bg-success">Complete</span>' : '<span class="badge bg-warning">On progress</span>'  ?></td>
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