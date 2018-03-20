<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nodos */

$this->title = 'Actualizar: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Nodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="nodos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'departamentos' => $departamentos,
        'municipios' => $municipios,
        'localidades' => $localidades,
    ])
    ?>

</div>
