<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nodos */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Nodos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro de eliminar este nodo?',
                'method' => 'post',
            ],
        ])
        ?>
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
            'contratista',
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
            'fechaDocumentacion',
            'poblacion',
            [
                'attribute' => 'estadoSitio',
                'value' => function ($data) {
                    $est = $data['estadoSitio'];
                    switch ($est) {
                        case 1:
                            $data['estadoSitio'] = 'Definir Valor 1';
                            break;
                        case 2:
                            $data['estadoSitio'] = 'Definir Valor 2';
                            break;
                        case 3:
                            $data['estadoSitio'] = 'Definir Valor 3';
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
            'estadoSitioContratista',
            'estadoSitioEjesa',
            'estadoSitioArsat',
        //'borrado',
        ],
    ])
    ?>

</div>
