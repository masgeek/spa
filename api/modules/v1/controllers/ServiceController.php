<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace app\api\modules\v1\controllers;

use app\api\modules\v1\models\SERVICE_MODEL;
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

	public function actionSalonService($id){
        //get the services associated with a salon
        $message = [];
        if (!Yii::$app->request->isGet) {
            throw new BadRequestHttpException('Please use GET');
        }
    }
	public function actionAll()
	{

	}
}