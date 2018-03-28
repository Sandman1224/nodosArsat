<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\user */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro de que desea eliminar el usuario?',
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
        ],
    ])
    ?>

</div>
