<?php

namespace app\controllers;

use app\model_extended\ALL_RESERVATIONS;
use app\models_search\PaymentSearch;
use app\models_search\ServicesSearch;
use Yii;
use app\models_search\ReportSearch;
use yii\web\Controller;

/**
 * ReportsController implements the CRUD actions for MY_RESERVATIONS model.
 */
class ReportsController extends Controller
{

	/**
     * Lists all MY_RESERVATIONS models.
     * @return mixed
     */
    public function actionAllReservations()
    {

	    $title = 'Registered User Report';
	    
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	public function actionAllReservationsB()
	{
		return $this->render('all-reservations');
	}

	public function actionCustomers()
	{
		return $this->render('customers');
	}

	public function actionPayments()
	{
		$searchModel = new PaymentSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('payments', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionAllServices()
	{
        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('services', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}
}
