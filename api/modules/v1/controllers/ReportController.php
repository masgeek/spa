<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 01-Sep-17
 * Time: 12:47
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\models\ALL_SERVICES_VIEW;
use app\api\modules\v1\models\PAYMENT_MODEL;
use app\model_extended\MY_RESERVATIONS_VIEW;
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

    public function actionList($user_id)
    {
        $data = REPORTS_MODEL::find()
            ->where(['SALON_OWNER_ID' => $user_id])
            ->orderBy(['DATE_GENERATED' => SORT_DESC])
            ->all();

        return $data;
    }

    /**
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionGenerate()
    {
        $resp = '';
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }

        $user_id = Yii::$app->request->post('USER_ID');
        $report_type = Yii::$app->request->post('REPORT_TYPE');

        switch (strtoupper($report_type)) {
            case REPORTS_MODEL::RESERVATIONS:
                $resp = $this->Reservations($user_id, $report_type);
                break;
            case REPORTS_MODEL::SERVICES:
                $resp = $this->Services($user_id, $report_type);
                break;
            case REPORTS_MODEL::PAYMENTS:
                $resp = $this->Payments($user_id, $report_type);
                break;
        }

        return $resp;
    }

    public function Reservations($user_id, $report_type)
    {
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
            $file_ref = CUSTOM_HELPER::GetTimeStamp();
            $file_name = "pdf/{$report_type}_{$file_ref}_report.pdf";
            return CUSTOM_HELPER::GeneratePdf($user_id, $content, $file_name, $report_type);
        }

        return [''];
    }

    public function Payments($user_id, $report_type)
    {
        $myReservationsArr = MY_RESERVATIONS_VIEW::MyReservationsArr($user_id);


        $dataProvider = new ActiveDataProvider([
            'query' => PAYMENT_MODEL::find()
                ->where(['RESERVATION_ID' => $myReservationsArr])
                //->andWhere(['PAYMENT_STATUS' => 0]),
        ]);

        $content = REPORTS_MODEL::BuildPaymentsTable($dataProvider);

        if (strlen($content) > 0) {
            $file_ref = CUSTOM_HELPER::GetTimeStamp();
            $file_name = "pdf/{$report_type}_{$file_ref}_report.pdf";
            return CUSTOM_HELPER::GeneratePdf($user_id, $content, $file_name, $report_type);
        }

        return [''];
    }

    public function Services($user_id, $report_type)
    {


        $dataProvider = new ActiveDataProvider([
            'query' => ALL_SERVICES_VIEW::find()
            //->where(['OWNER_ID' => $user_id])
            //->andWhere(['PAYMENT_STATUS' => 0]),
        ]);


        $content = REPORTS_MODEL::BuildServicesTable($dataProvider);

        return$content;
        /*if (strlen($content) > 0) {
            $file_ref = CUSTOM_HELPER::GetTimeStamp();
            $file_name = "pdf/{$report_type}_{$file_ref}_report.pdf";
            return CUSTOM_HELPER::GeneratePdf($user_id, $content, $file_name, $report_type);
        }*/

        //return [''];
    }
}