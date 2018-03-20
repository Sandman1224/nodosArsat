<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Nodos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nodos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-inline">
        <?=
        $form->field($model, 'departamento')->dropDownList($departamentos, [
            'prompt' => 'Seleccione departamento',
            'id' => 'ddlDepartamentos'
        ])
        ?>

        <?=
                $form->field($model, 'municipio')
                ->widget(DepDrop::className(), [
                    'options' => ['id' => 'ddlMunicipios'],
                    'data' => $municipios,
                    'pluginOptions' => [
                        'depends' => ['ddlDepartamentos'],
                        'placeholder' => 'Seleccione municipio',
                        'url' => Url::to(['nodos/municipios']),
                        'initialize' => true
                    ]
        ]);
        ?>

        <?=
                $form->field($model, 'localidad')
                ->widget(DepDrop::className(), [
                    'options' => ['id' => 'ddlLocalidades'],
                    'data' => $localidades,
                    'pluginOptions' => [
                        'depends' => ['ddlMunicipios'],
                        'placeholder' => 'Seleccione localidad',
                        'url' => Url::to(['nodos/localidades']),
                        'initialize' => true
                    ],
        ]);
        ?>
    </div>

    <div class="form-inline">
        <?= $form->field($model, 'latitud')->textInput() ?>

        <?= $form->field($model, 'longitud')->textInput() ?>
    </div>

    <?= $form->field($model, 'contratista')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'documentacion')->dropDownList([
        1 => 'Definir Valor 1',
        2 => 'Definir Valor 2',
        3 => 'Definir Valor 3',
            ], ['prompt' => 'Seleccione documentación presentada']);
    ?>

    <?=
    $form->field($model, 'fechaDocumentacion')->widget(DatePicker::className(), [
        'options' => [
            'placeholder' => 'Ingrese fecha',
        ],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?= $form->field($model, 'poblacion')->textInput() ?>

    <?=
    $form->field($model, 'estadoSitio')->dropDownList([
        1 => 'Definir Valor 1',
        2 => 'Definir Valor 2',
        3 => 'Definir Valor 3',
            ], ['prompt' => 'Seleccione estado del nodo']);
    ?>

    <?= $form->field($model, 'situacion')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'prioridad')->dropDownList([
        1 => 'Alta',
        2 => 'Media',
        3 => 'Baja',
            ], ['prompt' => 'Seleccione prioridad']);
    ?>

    <?= $form->field($model, 'estadoSitioContratista')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
