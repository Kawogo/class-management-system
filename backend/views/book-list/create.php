<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BookList */

// $this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Book Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-list-create">

    <?= $this->render('_form', [
        'model' => $book_list_model,
    ]) ?>

</div>
