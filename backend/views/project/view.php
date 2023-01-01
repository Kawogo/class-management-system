<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">
<style>
    #map { height: 400px; }
</style>
<div class="mt-3">
        <h4><?= Html::encode($model->title) ?></h4>
    </div><hr>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:ntext',
            [
                'attribute' => 'leader',
                'value' => Html::encode(User::getUsername($model->leader))
            ],
            [
                'attribute' => 'coach',
                'value' => Html::encode(User::getUsername($model->coach))
            ],
        ],
    ]) ?>

<div class="row mb-5 mt-5">

        <h4 for="">Team Members</h4>
        <hr>
        <?php
        if ($team_members) {
            # code...
     
        foreach ($team_members as $team_member) {
        ?>
        <div class="col-md-2">
            <ul class="list-group">
                <li class="list-group-item bg-light">
                <?= Html::encode(User::getUsername($team_member->member_id)) ?>
                <!-- <a href="< ?= Url::to(['/project-member/remove-member','id' => $team_member->member_id, 'project_id' => $team_member->project_id])  ?>" title="Remove" data-bs-toggle="tooltip" data-bs-placement="bottom" class="badge bg-danger rounded-pill"><i class="uil uil-multiply text-white"></i></a> -->
                </li>
            </ul>
        </div>
        <?php
        }   }else {
        ?>
        <div>
        <strong><h5 class="text-danger">No members.</h5>
        </div>
        <?php
        }
        ?>

</div>


<div class="row">


<input type="hidden" value="<?= Html::encode($model->id) ?>" id="add-project-location-to-db-id">
<h4>Project Location <button id="view-project-location-from-db-btn" class="btn btn-sm btn-success float-end">View Location</button></h4>
<hr>
<div class="col" id="isShowMap">

<div class="spinner-border spinner-border-sm" id="location-loading" role="status"></div>
<strong class="mb-2"><span id="display-project-location"></span></strong>

    <div id="map">

    </div>
</div>
</div>

</div>
