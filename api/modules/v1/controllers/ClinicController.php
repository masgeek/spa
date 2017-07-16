<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/31/2017
 * Time: 14:11
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\models\BOOTHMODEL;
use app\api\modules\v1\models\CLINIC_MODEL;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;

/**
 * Class BoothController
 * @package app\api\modules\v1\controllers
 */
class ClinicController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'app\api\modules\v1\models\CLINIC_MODEL';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'];
        unset($behaviors['authenticator']);

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];

        return $behaviors;
    }

    /**
     * Get all booths under a particular event
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionAll($id)
    {
        $data = CLINIC_MODEL::find()
            ->where(['CLINIC_ID' => $id])
            ->all();


        return $data;
    }
}