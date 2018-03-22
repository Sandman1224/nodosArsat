<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NodosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nodos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'departamento') ?>

    <?= $form->field($model, 'municipio') ?>

    <?= $form->field($model, 'localidad') ?>

    <?php // echo $form->field($model, 'latitud') ?>

    <?php // echo $form->field($model, 'longitud') ?>

    <?php // echo $form->field($model, 'contratista') ?>

    <?php // echo $form->field($model, 'documentacion') ?>

    <?php // echo $form->field($model, 'fechaDocumentacion') ?>

    <?php // echo $form->field($model, 'poblacion') ?>

    <?php // echo $form->field($model, 'estadoSitio') ?>

    <?php // echo $form->field($model, 'situacion') ?>

    <?php // echo $form->field($model, 'prioridad') ?>

    <?php // echo $form->field($model, 'estadoSitioContratista') ?>

    <?php // echo $form->field($model, 'estadoSitioEjesa') ?>

    <?php // echo $form->field($model, 'estadoSitioArsat') ?>

    <?php // echo $form->field($model, 'borrado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>