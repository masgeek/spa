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
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class OfferedserviceController extends ActiveController
{
    /**
     * @var object
     */
    public $modelClass = 'app\api\modules\v1\models\OFFERED_SERVICE_MODEL';


    public function actionSalons($id)
    {
        //get the services associated with a salon
        if (!Yii::$app->request->isGet) {
            throw new BadRequestHttpException('Please use GET');
        }
        /*$data = OFFERED_SERVICE_MODEL::findOne(['SERVICE_ID' => $id]);

        return $data;*/
        $query = OFFERED_SERVICE_MODEL::find()
            ->where(['SERVICE_ID' => $id])
            ->andWhere(['STATUS'=>1])
            ->all();

        return $query;
    }
}