<?php

namespace frontend\controllers;

use Yii;
use app\models\Nodos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\NodosSearch;
use app\models\Contantes;
use app\models\Departamentos;
use app\models\Municipios;
use app\models\Localidades;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * NodosController implements the CRUD actions for Nodos model.
 */
class NodosController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Nodos models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new NodosSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        $nodosFormateados = $this->datosMarcador($dataProvider->query->all());

        $departamentos = Departamentos::find()
                ->where(['borrado' => 0])
                ->orderBy(['nombre' => SORT_ASC])
                ->all();
        $municipios = Municipios::find()
                ->where(['borrado' => 0])
                ->orderBy(['nombre' => SORT_ASC])
                ->all();
        $localidades = Localidades::find()
                ->andWhere(['borrado' => 0])
                ->orderBy(['nombre' => SORT_ASC])
                ->all();

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'departamentos' => $departamentos,
                    'municipios' => $municipios,
                    'localidades' => $localidades,
                    'nodos' => $nodosFormateados
        ]);
    }

    /**
     * Displays a single Nodos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Nodos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Nodos();
        $model->borrado = "0";

        $departamentos = ArrayHelper::map(Departamentos::find()
                                ->where(['borrado' => 0])
                                ->orderBy(['nombre' => SORT_ASC])
                                ->all(), 'id', 'nombre');
        $municipios = ArrayHelper::map(Municipios::find()
                                ->where(['borrado' => 0])
                                ->orderBy(['nombre' => SORT_ASC])
                                ->all(), 'id', 'nombre');
        $localidades = ArrayHelper::map(Localidades::find()
                                ->andWhere(['borrado' => 0])
                                ->orderBy(['nombre' => SORT_ASC])
                                ->all(), 'id', 'nombre');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
                    'departamentos' => $departamentos,
                    'municipios' => $municipios,
                    'localidades' => $localidades,
        ]);
    }

    /**
     * Updates an existing Nodos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->borrado = "0";

        $departamentos = ArrayHelper::map(Departamentos::find()
                                ->where(['borrado' => 0])
                                ->orderBy(['nombre' => SORT_ASC])
                                ->all(), 'id', 'nombre');
        $municipios = ArrayHelper::map(Municipios::find()
                                ->where(['borrado' => 0])
                                ->orderBy(['nombre' => SORT_ASC])
                                ->all(), 'id', 'nombre');
        $localidades = ArrayHelper::map(Localidades::find()
                                ->andWhere(['borrado' => 0])
                                ->orderBy(['nombre' => SORT_ASC])
                                ->all(), 'id', 'nombre');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
                    'departamentos' => $departamentos,
                    'municipios' => $municipios,
                    'localidades' => $localidades,
        ]);
    }

    /**
     * Deletes an existing Nodos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        //$this->findModel($id)->delete();
        //Borramos logicamente el nodo para conservar la información en la BD
        $nodo = $this->findModel($id);
        $nodo['borrado'] = "1";
        $nodo->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Nodos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nodos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Nodos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMunicipios() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $departamento = $parents[0];
                $out = Municipios::find()
                        ->select(['id as id', 'nombre as name'])
                        ->where(['departamento' => $departamento])
                        ->orderBy(['nombre' => SORT_ASC])
                        ->asArray()
                        ->all();
                $salida = Json::encode(['output' => $out, 'selected' => '']);
                echo $salida;
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionLocalidades() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $municipio = $parents[0];
                $out = Localidades::find()
                        ->select(['id as id', 'nombre as name'])
                        ->where(['municipio' => $municipio])
                        ->orderBy(['nombre' => SORT_ASC])
                        ->asArray()
                        ->all();
                $salida = Json::encode(['output' => $out, 'selected' => '']);
                echo $salida;
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    private function datosMarcador($nodos) {
        $salida = [];
        foreach ($nodos as $nodo) {
            $arreglo['id'] = $nodo['id'];
            $arreglo['nombre'] = $nodo['nombre'];
            $arreglo['departamento'] = $nodo['departamento0']->nombre;
            $arreglo['municipio'] = $nodo['municipio0']->nombre;
            $arreglo['localidad'] = $nodo['localidad0']->nombre;
            $arreglo['latitud'] = $nodo['latitud'];
            $arreglo['longitud'] = $nodo['longitud'];
            $arreglo['estadoSitio'] = $nodo['estadoSitio'];

            switch ($nodo['prioridad']) {
                case 1:
                    $arreglo['prioridad'] = 'Alta';
                    break;
                case 2:
                    $arreglo['prioridad'] = 'Media';
                    break;
                case 3:
                    $arreglo['prioridad'] = 'Baja';
                    break;
                default:
                    $data['prioridad'] = 'Sin Definir';
                    break;
            }


            $salida[] = $arreglo;
        }
        return $salida;
    }

}
