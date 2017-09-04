<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 01-Sep-17
 * Time: 12:47
 */

namespace app\api\modules\v1\controllers;


use Yii;
use app\api\modules\v1\models\ALL_RESERVATIONS;
use app\api\modules\v1\models\REPORTS_MODEL;
use app\components\CUSTOM_HELPER;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

class ReportController extends ActiveController
{
    /**
     * @var object
     */
    public $modelClass = 'app\api\modules\v1\models\REPORTS_MODEL';

    /**
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionAllReservations()
    {
        $user_id = '';
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }

        $user_id = Yii::$app->request->post('USER_ID');

        //generate the report file
        $query = ALL_RESERVATIONS::find()
            ->where(['OWNER_ID' => $user_id])
            ->orderBy(['SALON_NAME' => SORT_DESC]); //$searchModel->search(\Yii::$app->request->queryParams);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        $content = REPORTS_MODEL::BuildReservationsTable($dataProvider);

        if (strlen($content) > 0) {
            $file_ref = CUSTOM_HELPER::GenerateRandomRef();
            $file_name = "pdf/reports_{$file_ref}.pdf";
            // setup kartik\mpdf\Pdf component

            return CUSTOM_HELPER::GeneratePdf($user_id, $content, $file_name,'ALL RESERVATIONS');
        }

        return [];
    }
}