<?php

namespace app\controllers;

use Yii;
use app\model_extended\USERS_MODEL;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for USERS_MODEL model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }


    /**
     * Lists all USERS_MODEL models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => USERS_MODEL::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUserStatus()
    {

        $editable = (bool)Yii::$app->request->post('hasEditable');
        $out = Json::encode(['output' => '', 'message' => '']);

        if ($editable) {
            $user_id = Yii::$app->request->post('editableKey');
            $model = $this->findModel($user_id);

            $services_arr = Yii::$app->request->post('USERS_MODEL');


            foreach ($services_arr as $services) {
                $model->ACCOUNT_STATUS = isset($services['ACCOUNT_STATUS']) ? $services['ACCOUNT_STATUS'] : $model->ACCOUNT_TYPE_ID;

                $model->ACCOUNT_TYPE_ID = isset($services['ACCOUNT_TYPE_ID']) ? $services['ACCOUNT_TYPE_ID'] : $model->ACCOUNT_TYPE_ID;


                if ($model->save()) {
                    $return_val = isset($services['ACCOUNT_TYPE_ID']) ? $model->aCCOUNTTYPE->ACCOUNT_NAME : $model->aCCOUNTSTATUS->STATUS_NAME;
                    $out = ['output' => $return_val, 'message' => ''];
                } else {
                    $out = ['output' => '', 'message' => 'Unable to save'];
                }
            }

        }

        echo Json::encode($out);
    }

    /**
     * Displays a single USERS_MODEL model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new USERS_MODEL model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new USERS_MODEL();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->USER_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing USERS_MODEL model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->USER_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing USERS_MODEL model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the USERS_MODEL model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return USERS_MODEL the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = USERS_MODEL::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
