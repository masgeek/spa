<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace app\api\modules\v1\controllers;

use app\api\modules\v1\models\SALON_MODEL;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\rest\Controller;
use yii\web\Response;

class SalonController extends ActiveController
{
	/**
	 * @var object
	 */
	public $modelClass = 'app\api\modules\v1\models\SALON_MODEL';

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['rateLimiter']['enableRateLimitHeaders'] = true;
		return $behaviors;
	}

	public function actionIndex()
	{
		return new ActiveDataProvider([
			'query' => SALON_MODEL::findOne(4),
		]);
	}

	public function actionAll()
	{

	}
}