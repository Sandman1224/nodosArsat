<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\user */
/* @var $form yii\widgets\ActiveForm */

if($banAccion == 1){
    $disabled = false;
}else{
    $disabled = true;
}
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'disabled' => $disabled]) ?>
    
    <?= $form->field($model, 'email')->textInput() ?>
    
    <?= $form->field($model, 'password')->passwordInput() ?>
    
    <?=
    $form->field($model, 'type')->dropDownList([
        1 => 'Administrador',
        2 => 'Arsat',
        3 => 'Ejesa',
            ], ['prompt' => 'Seleccione tipo de usuario']);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
