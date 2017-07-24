<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace app\api\modules\v1\controllers;

use app\api\modules\v1\models\OFFERED_SERVICE_MODEL;
use app\api\modules\v1\models\PAYMENT_MODEL;
use app\api\modules\v1\models\RESERVATION_MODEL;
use app\api\modules\v1\models\SERVICE_MODEL;
use function GuzzleHttp\Promise\all;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class PaymentController extends ActiveController
{
	/**
	 * @var object
	 */
	public $modelClass = 'app\api\modules\v1\models\PAYMENT_MODEL';


	public function actionPay($id)
	{
		$message = [];
		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}
		$request = Yii::$app->request->post();


		$account_ref = Yii::$app->request->post();

		$payment_post = [
			'PAYMENT_MODEL' => $request
		];
		$reservation = RESERVATION_MODEL::find()
			->where(['RESERVATION_ID' => $id, 'ACCOUNT_REF' => $account_ref])
			->one();


		if ($reservation == null) {
			$message[] = [
				'field' => "Not Found",
				'message' => "Reservation Not Found"
			];
		} else {
			$booking = (float)Yii::$app->request->post('BOOKING_AMOUNT', 0);
			$total = (float)$reservation->TOTAL_COST;
			$balance = ($total - $booking);


			$model = new PAYMENT_MODEL();
			//process the payment
			$model->RESERVATION_ID = $id;
			$model->DATE_PAID = new Expression('NOW()');
			$model->BALANCE = $balance;
			if ($model->load($payment_post)) {
				if ($model->validate() && $model->save()) {
					$message = [$model];
				} else {
					$errors = $model->getErrors();
					foreach ($errors as $key => $error) {
						$message[] = [
							'field' => $key,
							'message' => $error[0]
						];
					}
				}
			}
		}
		return $message;
	}
}