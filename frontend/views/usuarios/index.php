<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'hidden' => true,
            ],
            'username',
            'email:email',
            [
                'attribute' => 'type',
                'label' => 'Tipo de Usuario',
                'value' => function ($data) {
                    $est = $data['type'];
                    switch ($est) {
                        case 1:
                            $data['type'] = 'Administrador';
                            break;
                        case 2:
                            $data['type'] = 'Arsat';
                            break;
                        case 3:
                            $data['type'] = 'Ejesa';
                            break;
                        default:
                            $data['type'] = null;
                            break;
                    }

                    return $data['type'];
                }
            ],
            //'status',
            //'created_at',
            //'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
