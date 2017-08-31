<?php

namespace app\controllers;

use app\model_extended\ALL_RESERVATIONS;
use app\models_search\PaymentSearch;
use app\models_search\ServicesSearch;
use kartik\mpdf\Pdf;
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

        $content =  $this->renderPartial('all-reservations', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        $pdf = Yii::$app->pdf;
        $pdf->content = $content;
        return $pdf->render();

       /* // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['Krajee Report Header'],
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();*/
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
