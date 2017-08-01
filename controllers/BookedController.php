<?php

namespace app\controllers;

use Yii;
use app\model_extended\RESERVED_SERVICES;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookedController implements the CRUD actions for RESERVED_SERVICES model.
 */
class BookedController extends Controller
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
     * Lists all RESERVED_SERVICES models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RESERVED_SERVICES::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAssignService()
    {

        $editable = (bool)Yii::$app->request->post('hasEditable');
        $out = Json::encode(['output' => '', 'message' => '']);

        if ($editable) {
            $reservation_id = Yii::$app->request->post('editableKey');
            $model = $this->findModel($reservation_id);

            $services_arr = Yii::$app->request->post('RESERVED_SERVICES');
            foreach ($services_arr as $services) {
                $model->STAFF_ID = $services['STAFF_ID'];

                if ($model->save()) {
                    $out = ['output' => $model->sTAFF->STAFF_NAME, 'message' => ''];
                } else {
                    $out = ['output' => '', 'message' => 'Unable to save'];
                }
            }

        }

        echo Json::encode($out);
    }

    public function actionConfirmService()
    {

        $editable = (bool)Yii::$app->request->post('hasEditable');
        $out = Json::encode(['output' => '', 'message' => '']);

        if ($editable) {
            $reserved_service_id = Yii::$app->request->post('editableKey');
            $model = $this->findModel($reserved_service_id);

            $services_arr = Yii::$app->request->post('RESERVED_SERVICES');
            foreach ($services_arr as $services) {
                $model->STATUS_ID = $services['STATUS_ID'];

                if ($model->save()) {
                    $out = ['output' => $model->sTATUS->STATUS_NAME, 'message' => ''];
                } else {
                    $out = ['output' => '', 'message' => 'Unable to save'];
                }
            }

        }

        echo Json::encode($out);
    }

    public function actionAssignStaff($reservation_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RESERVED_SERVICES::find()
                ->where(['RESERVATION_ID' => $reservation_id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RESERVED_SERVICES model.
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
     * Creates a new RESERVED_SERVICES model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RESERVED_SERVICES();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->RESERVED_SERVICE_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RESERVED_SERVICES model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->RESERVED_SERVICE_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RESERVED_SERVICES model.
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
     * Finds the RESERVED_SERVICES model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RESERVED_SERVICES the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RESERVED_SERVICES::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
