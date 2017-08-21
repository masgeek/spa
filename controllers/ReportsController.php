<?php

namespace app\controllers;

use app\models\VwAllReservations;

class ReportsController extends \yii\web\Controller
{
	public function actionIndex(){


		$fromDate ='01/01/2017'; //$request->input('from_date');
		$toDate = '01/01/2018';//$request->input('to_date');
		$sortBy = 'RESERVATION_DATE';//$request->input('sort_by');

		// Report title
		$title = 'Registered User Report';

		// For displaying filters description on header
		$meta = [
			'Registered on' => $fromDate . ' To ' . $toDate,
			'Sort By' => $sortBy
		];

		$queryBuilder = VwAllReservations::select(['SALON_NAME', 'SERVICE_NAME', 'RESERVATION_DATE'])
			->whereBetween('RESERVATION_DATE', [$fromDate, $toDate])
			->orderBy($sortBy);

		// Set Column to be displayed
		$columns = [
			'Name' => 'SALON_NAME',
			'RESERVATION_DATE', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
			'Total Balance' => 'BALANCE',
			'Status' => function($result) { // You can do if statement or any action do you want inside this closure
				return ($result->BALANCE > 100000) ? 'Rich Man' : 'Normal Guy';
			}
		];

		/*
	Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).

	- of()         : Init the title, meta (filters description to show), query, column (to be shown)
	- editColumn() : To Change column class or manipulate its data for displaying to report
	- editColumns(): Mass edit column
	- showTotal()  : Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
	- groupBy()    : Show total of value on specific group. Used with showTotal() enabled.
	- limit()      : Limit record to be showed
	- make()       : Will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
*/
		$t =  PdfReport::of($title, $meta, $queryBuilder, $columns)
			->editColumn('Registered At', [
				'displayAs' => function($result) {
					return $result->RESERVATION_DATE;//->format('d M Y');
				}
			])
			->editColumn('Total Balance', [
				'displayAs' => function($result) {
					return $result->BALANCE;
				}
			])
			->editColumns(['Total Balance', 'Status'], [
				'class' => 'right bold'
			])
			->showTotal([
				'Total Balance' => 'point'
			])
			->limit(20)
			->stream(); // or download('filename here..') to download pdf

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

}
