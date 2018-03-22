<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nodos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nodos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estadoSitioArsat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>