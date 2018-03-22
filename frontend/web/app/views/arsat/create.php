<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Nodos */

$this->title = 'Create Nodos';
$this->params['breadcrumbs'][] = ['label' => 'Nodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
