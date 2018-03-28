<?php

namespace frontend\controllers;

use Yii;
use common\models\user;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\SignupForm;
use frontend\models\UpdateuserForm;

/**
 * UsuariosController implements the CRUD actions for user model.
 */
class UsuariosController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'view', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
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
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => user::find()->where(['borrado' => 0]),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single user model.
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
     * Creates a new user model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $auth = Yii::$app->authManager;
                switch ($user->type) {
                    case 1:
                        $authorRole = $auth->getRole('admin');
                        break;
                    case 2:
                        $authorRole = $auth->getRole('arsat');
                        break;
                    case 3:
                        $authorRole = $auth->getRole('ejesa');
                        break;
                }

                $auth->assign($authorRole, $user->getPrimaryKey());

                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $user = $this->findModel($id);
        $viejoRol = (string)$user->type;

        $model = new UpdateuserForm();

        $model->id = $user->id;
        $model->username = $user->username;
        $model->email = $user->email;
        $model->password = $user->password;
        $model->type = $user->type;

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->updateUser($id)) {
                if($viejoRol != $user['type']){
                    $auth = Yii::$app->authManager;
                    //Revocamos el permiso viejo
                    $authorRole = $auth->getRole($this->getRole($viejoRol));
                    $auth->revoke($authorRole, $id);
                    //Damos el nuevo permiso
                    $newauthorRole = $auth->getRole($this->getRole($user->type));
                    $auth->assign($newauthorRole, $id);
                }
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'id' => $id
        ]);
    }

    /**
     * Deletes an existing user model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        // $this->findModel($id)->delete();
        
        // Borramos logicamente el nodo para conservar la información en la BD
        $user = $this->findModel($id);
        $user['borrado'] = "1";
        $user->save();
        
        //Revocamos el rol que tiene el usuario
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole($this->getRole((string)$user->type));
        $auth->revoke($authorRole, $id);
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = user::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function getRole($type){
        switch ($type){
            case "1":
                return "admin";
            case "2":
                return "arsat";
            case "3":
                return "ejesa";
            default:
                return "no difinido";
        }
    }

}
