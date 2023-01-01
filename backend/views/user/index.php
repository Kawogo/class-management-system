<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\User;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */

$this->title = 'Users';
?>
                   <!-- Start Content-->

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="<?= Url::to(['/site/index'])  ?>">Home</a></li>
                                </ol>
                                </div>
                                    <h4 class="page-title">Users</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                    <!-- // display success message -->
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong><i class='mdi mdi-check-all'></i> </strong> <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                    <?php endif; ?>

                    <!-- // display error message -->
                    <?php if (Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong><i class='mdi mdi-alert-outline'></i>Error! - </strong> <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                    <?php endif; ?>
                    <!-- end of messages display -->
                        <div class="row">
                            <?php
        foreach ($thismonth as $user) {
            // echo User
          echo  $user['firstname'];
          }
                            ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">                     
                                              <a href="<?=  Url::to(['/user/signup']) ?>" class="btn btn-sm btn-primary mb-2"><i class="mdi mdi-plus-circle-outline me-1"></i> Add new user</a>
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
                                                        <th>Firstname</th>
                                                        <th>Surname</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Role</th>
                                                        <th>Status</th>
                                                        <th style="width: 75px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                       foreach ($users as $user) {
                                                       ?>                       
                                                       <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class="table-user">
                                                            <!-- <img src="assets_ui/images/users/avatar-5.jpg" alt="table-user" class="me-2 rounded-circle"> -->
                                                            <?=  Html::encode(ucfirst($user->firstname)) ?>
                                                        </td>
                                                        <td>
                                                            <?=  Html::encode(ucfirst($user->surname)) ?>
                                                        </td>
                                                        <td>
                                                            <?=  Html::encode($user->email) ?>
                                                        </td>
                                                        <td>
                                                            <?=  Html::encode($user->phone) ?>
                                                        </td>
                                                        <td>
                                                            <?=  Html::encode($user->role) ?>
                                                        </td>
                                                        <td>
                                                            <?=
                                                              ($user->status == 10) ? '<span class="badge badge-success-lighten">Active</span>' : '<span class="badge badge-danger-lighten">Not active</span>';
                                                            ?>
                                                            
                                                        </td>               
                                                        <td>
                                                        <?= Html::a('<i class="mdi mdi-square-edit-outline text-primary"></i>', ['update', 'id' => $user->id]) ?>
                                                        <?= Html::a('<i class="mdi mdi-eye-outline text-success"></i>', ['view', 'id' => $user->id]) ?>
                                                        <?= Html::a('<i class="mdi mdi-delete text-danger"></i>', ['delete', 'id' => $user->id], [
                                                                'data' => [
                                                                    'confirm' => 'Are you sure you want to delete this user?',
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
                        
         

