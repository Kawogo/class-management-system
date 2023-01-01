<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Course */

$this->title = 'Add Course';
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">
<h4><i class="mdi mdi-pencil-plus text-success"></i> <?= Html::encode($this->title) ?></h4>
    <hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
