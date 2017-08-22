<?php

namespace app\controllers;

use app\model_extended\MY_RESERVATIONS;
use app\model_extended\MY_RESERVATIONS_VIEW;
use app\models\Reservations;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReservationController implements the CRUD actions for Reservations model.
 */
class ReservationController extends Controller
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
     * Lists all Reservations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $owner = Yii::$app->user->id;


        $dataProvider = new ActiveDataProvider([
            //'query' => Reservations::find(),
            'query' => MY_RESERVATIONS_VIEW::find()
                ->where(['OWNER_ID' => $owner]),
            'key' => function ($model) {
                return $model->RESERVATION_ID;
            }
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProcessReservation($id){
	    $model = $this->findModel($id);

	    if ($model->load(Yii::$app->request->post()) && $model->save()) {
		    //return $this->redirect(['view', 'id' => $model->RESERVATION_ID]);
		    return $this->redirect(['booked/assign-staff', 'reservation_id' => $model->RESERVATION_ID]);
	    } else {
		    return $this->render('update', [
			    'model' => $model,
		    ]);
	    }
    }
    /**
     * Displays a single Reservations model.
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
     * Creates a new Reservations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MY_RESERVATIONS();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->RESERVATION_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Reservations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->RESERVATION_ID]);
            return $this->redirect(['booked/assign-staff', 'reservation_id' => $model->RESERVATION_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionConfirmReservation()
    {

        $editable = (bool)Yii::$app->request->post('hasEditable');
        $out = Json::encode(['output' => '', 'message' => '']);
        
        if ($editable) {
            $reservation_id = Yii::$app->request->post('editableKey');
            $model = $this->findModel($reservation_id);

            $services_arr = Yii::$app->request->post('MY_RESERVATIONS_VIEW');
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

    /**
     * Deletes an existing Reservations model.
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
     * Finds the Reservations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reservations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MY_RESERVATIONS::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
