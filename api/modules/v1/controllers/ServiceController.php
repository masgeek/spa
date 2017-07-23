<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace app\api\modules\v1\controllers;

use app\api\modules\v1\models\OFFERED_SERVICE_MODEL;
use app\api\modules\v1\models\SERVICE_MODEL;
use function GuzzleHttp\Promise\all;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\rest\Controller;
use yii\web\Response;

class ServiceController extends ActiveController
{
	/**
	 * @var object
	 */
	public $modelClass = 'app\api\modules\v1\models\SERVICE_MODEL';

	public function actionIndex()
	{
		return new ActiveDataProvider([
			'query' => SERVICE_MODEL::findOne(4),
		]);
	}

	public function actionAll()
	{
		$available_services = SERVICE_MODEL::find()
			->orderBy(['SERVICE_NAME' => SORT_ASC])
			->all();

		return $available_services;
	}

	public function actionServiceList($id, $all = 0)
	{
		//get already added services
		$salon_services = OFFERED_SERVICE_MODEL::find()
			->select(['SERVICE_ID'])
			->where(['SALON_ID' => $id])
			->asArray()
			->all();

		$available_services = SERVICE_MODEL::find()
			->where(['NOT IN', 'SERVICE_ID', $salon_services])
			->orderBy(['SERVICE_NAME' => SORT_ASC])
			->all();

		return $available_services;
	}
}