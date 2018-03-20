<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\typeahead\Typeahead;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nodos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Nodo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'hidden' => true,
            ],
            [
                'attribute' => 'nombre',
                'value' => 'nombre',
            ],
            [
                'attribute' => 'departamento',
                'value' => 'departamento0.nombre',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'data' => ArrayHelper::map($departamentos, 'id', 'nombre'),
                    'attribute' => 'departamento',
                    'options' => ['placeholder' => 'Seleccione Departamento'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute' => 'municipio',
                'value' => 'municipio0.nombre',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'data' => ArrayHelper::map($municipios, 'id', 'nombre'),
                    'attribute' => 'municipio',
                    'options' => ['placeholder' => 'Seleccione Municipio'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute' => 'localidad',
                'value' => 'localidad0.nombre',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'data' => ArrayHelper::map($localidades, 'id', 'nombre'),
                    'attribute' => 'localidad',
                    'options' => ['placeholder' => 'Seleccione Localidad'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            [
                'attribute' => 'documentacion',
                'value' => 'documentacion'
            ],
            [
                'attribute' => 'estadoSitio',
                'value' => 'estadoSitio'
            ],
            //'latitud',
            //'longitud',
            //'contratista',
            //'documentacion',
            //'fechaDocumentacion',
            //'poblacion',
            //'estadoSitio',
            //'situacion',
            //'prioridad',
            //'estadoSitioContratista',
            //'estadoSitioEjesa',
            //'estadoSitioArsat',
            //'borrado',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acción'
            ],
        ],
        'emptyText' => '¡No se encontraron nodos!',
    ]);
    ?>
</div>
