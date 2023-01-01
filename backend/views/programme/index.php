<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programmes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
        <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index'])  ?>">Home</a></li>
            <li class="breadcrumb-item active page-title-right2">Programmes</li>
        </ol>
        </div>
            <h4 class="page-title">Programmes</h4>
        </div>
    </div>
</div> 
  <div class="row">
   <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                    <div id="show-programmes-form">
                    </div>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
                            </div><!-- end col-->

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <h4 class="">Programmes</h4>
                                            </div>
                                            <div class="col-md-6">
                                            <?= Html::button('Add new programme', ['value' => Url::to(['/programme/create']), 'class' => 'loadProgrammesCreateForm btn btn-success btn-sm float-end']); ?>
                                            </div>
                                        </div>

                                        <!-- // display success message -->
                                        <?php if (Yii::$app->session->hasFlash('success')): ?>
                                            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show mt-2" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            <strong><i class='mdi mdi-check-all'></i> </strong> <?= Yii::$app->session->getFlash('success') ?>
                                            </div>
                                        <?php endif; ?>
                                        <hr>
                                        <table class="table table-sm table-centered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Programme name</th>
                                                    <th>Year of Study</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                foreach ($programmes as $programme) {
                                                ?>
                                                <tr>
                                                    <td class="table-user">
                                                     <?= $i++ ?>
                                                    </td>
                                                    <td>
                                                         <?= Html::encode($programme->program_name) ?>
                                                    </td>
                                                    <td>
                                                         <?= Html::encode($programme->yos) ?>
                                                    </td>
                                                    <td class="table-action">
                                                        <?= Html::button('<i class="mdi mdi-pencil mdi-18px text-primary"></i>', ['value' => Url::to(['programme/update', 'id' => $programme->id]), 'class' => 'loadProgrammesEditForm btn action-icon']); ?>
                                                        <?= Html::a('<i class="mdi mdi-delete text-danger mdi-18px"></i>', ['delete','class' => 'action-icon' ,'id' =>  $programme->id], [
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this Programme?',
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

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
</div>
