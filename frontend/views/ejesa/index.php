<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use frontend\assets\MapAsset;
use yii\helpers\Json;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NodosSearch */
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
        "var nodos = " . Json::htmlEncode($nodos) . ";" .
        "var tipoUsuario = " . Yii::$app->user->identity->type . ";", View::POS_HEAD
);
?>

<div class="nodos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'attribute' => 'estadoSitio',
                'filter' => Html::activeDropDownList($searchModel, 'estadoSitio', [
                    '1' => 'Definir Valor 1',
                    '2' => 'Obra',
                    '3' => 'Pendiente'
                        ], ['prompt' => 'Seleccione estado de sitio', 'class' => 'form-control']),
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
            [
                'attribute' => 'prioridad',
                'filter' => Html::activeDropDownList($searchModel, 'prioridad', [
                    '1' => 'Alta',
                    '2' => 'Media',
                    '3' => 'Baja'
                        ], ['prompt' => 'Seleccione prioridad', 'class' => 'form-control']),
                'value' => function ($data) {
                    $est = $data['prioridad'];
                    switch ($est) {
                        case 1:
                            $data['prioridad'] = 'Alta';
                            break;
                        case 2:
                            $data['prioridad'] = 'Media';
                            break;
                        case 3:
                            $data['prioridad'] = 'Baja';
                            break;
                        default:
                            $data['prioridad'] = null;
                            break;
                    }

                    return $data['prioridad'];
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
                'header' => 'Acción',
                'template' => '{view}{update}'
            ],
        ],
        'emptyText' => '¡No se encontraron nodos!',
    ]);
    ?>
</div>