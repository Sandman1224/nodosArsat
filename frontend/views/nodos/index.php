<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use frontend\assets\MapAsset;
use yii\helpers\Json;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

//Registramos el asset que contiene las referencias a los archivos script del 
//frontend (Mapa y funcionalidades de mapa)
MapAsset::register($this);

$this->title = 'Nodos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="map"></div>
<div id="legend"></div>

<script 
    async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrsDVmkIyyAcqnMdH4QYCpVEDX5SvXNrw&callback=ubicarNodos">
</script>

<?php
$this->registerJs(
        "var nodos = " . Json::htmlEncode($nodos) . ";", View::POS_HEAD
);
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
                'value' => function ($data) {
                    $est = $data['documentacion'];
                    switch ($est) {
                        case 1:
                            $data['documentacion'] = 'Definir Valor 1';
                            break;
                        case 2:
                            $data['documentacion'] = 'Definir Valor 2';
                            break;
                        case 3:
                            $data['documentacion'] = 'Definir Valor 3';
                            break;
                        default:
                            $data['documentacion'] = null;
                            break;
                    }

                    return $data['documentacion'];
                }
            ],
            [
                'attribute' => 'estadoSitio',
                'value' => function ($data) {
                    $est = $data['estadoSitio'];
                    switch ($est) {
                        case 1:
                            $data['estadoSitio'] = 'Definir Valor 1';
                            break;
                        case 2:
                            $data['estadoSitio'] = 'Obra';
                            break;
                        case 3:
                            $data['estadoSitio'] = 'Pendiente';
                            break;
                        default:
                            $data['estadoSitio'] = null;
                            break;
                    }

                    return $data['estadoSitio'];
                }
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
