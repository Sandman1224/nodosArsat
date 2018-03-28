<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\assets\MapAsset;
use yii\helpers\Json;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Nodos */

MapAsset::register($this);

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Nodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            [
                'label' => 'Departamento',
                'attribute' => 'departamento0.nombre',
            ],
            [
                'label' => 'Municipio',
                'attribute' => 'municipio0.nombre',
            ],
            [
                'label' => 'Localidad',
                'attribute' => 'localidad0.nombre',
            ],
            'latitud',
            'longitud',
            [
                'attribute' => 'estadoSitio',
                'value' => function ($data) {
                    $est = $data['estadoSitio'];
                    switch ($est) {
                        case 1:
                            $data['estadoSitio'] = 'Finalizado';
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
            'situacion',
            [
                'attribute' => 'prioridad',
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
            'estadoSitioArsat',
        //'borrado',
        ],
    ])
    ?>

    <div id="map"></div>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrsDVmkIyyAcqnMdH4QYCpVEDX5SvXNrw&callback=verNodo">
    </script>

    <?php
    $this->registerJs(
            "var nodo = " . Json::htmlEncode($model) . ";", View::POS_HEAD
    );
    ?>

</div>