<?php

namespace app\controllers;

use app\models\VwAllReservations;
use function GuzzleHttp\Promise\all;

class ReportsController extends \yii\web\Controller
{
	public function actionIndex()
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

		$queryBuilder = VwAllReservations::find()
			->where(['between', 'RESERVATION_DATE', $fromDate, $toDate])
			//->groupBy(['SALON_NAME']
			->all();


		var_dump($queryBuilder);
		return 1;
	}

	public function actionIndex2()
	{
		$data = VwAllReservations::find()->all();

		var_dump($data);

		return 1;
		return $this->render('index');
	}

	public function actionAllReservations()
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
