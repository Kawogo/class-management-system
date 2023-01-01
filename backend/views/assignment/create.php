<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Assignment */

$this->title = 'Student Dashboard';
$this->params['breadcrumbs'][] = ['label' => 'Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-create">
<div class="row mt-3">
        <div class="col-md-6 offset-md-4">
            <div class="card">
                <div class="card-body">
                    <h5><i class="mdi mdi-pencil-plus text-success"></i> Submit assignment</h5><hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div></div></div></div>
