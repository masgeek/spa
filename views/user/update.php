<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\model_extended\USERS_MODEL */

$this->title = 'Update Users  Model: ' . $model->USER_ID;
$this->params['breadcrumbs'][] = ['label' => 'Users  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->USER_ID, 'url' => ['view', 'id' => $model->USER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
