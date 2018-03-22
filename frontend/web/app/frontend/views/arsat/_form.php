<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nodos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nodos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'departamento')->textInput() ?>

    <?= $form->field($model, 'municipio')->textInput() ?>

    <?= $form->field($model, 'localidad')->textInput() ?>

    <?= $form->field($model, 'latitud')->textInput() ?>

    <?= $form->field($model, 'longitud')->textInput() ?>

    <?= $form->field($model, 'contratista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documentacion')->textInput() ?>

    <?= $form->field($model, 'fechaDocumentacion')->textInput() ?>

    <?= $form->field($model, 'poblacion')->textInput() ?>

    <?= $form->field($model, 'estadoSitio')->textInput() ?>

    <?= $form->field($model, 'situacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prioridad')->textInput() ?>

    <?= $form->field($model, 'estadoSitioContratista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estadoSitioEjesa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estadoSitioArsat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'borrado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
