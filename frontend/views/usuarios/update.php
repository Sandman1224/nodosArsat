<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\user */

$this->title = 'Actualizar usuario: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $id, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'banAccion' => false
    ]) ?>

</div>
