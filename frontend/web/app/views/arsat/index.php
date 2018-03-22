<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NodosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nodos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nodos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nodos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'departamento',
            'municipio',
            'localidad',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
