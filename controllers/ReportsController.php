<?php

namespace app\controllers;

use app\model_extended\ALL_RESERVATIONS;
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

	public function actionIndexTest()
	{


		$fromDate = '2017-07-01'; //$request->input('from_date');
		$toDate = '2017-07-25';//$request->input('to_date');
		$sortBy = 'RESERVATION_DATE';//$request->input('sort_by');

		// Report title
		$title = 'Registered User Report';

		// For displaying filters description on header
		$meta = [
			'Registered on' => $fromDate . ' To ' . $toDate,
			'Sort By' => $sortBy
		];

		$queryBuilder = ALL_RESERVATIONS::find()
			->where(['between', 'RESERVATION_DATE', $fromDate, $toDate])
			//->groupBy(['SALON_NAME']
			->all();


		var_dump($queryBuilder);
		return 1;
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
		return $this->render('payments');
	}

	public function actionAllServices()
	{
		return $this->render('services');
	}
}
