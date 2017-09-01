<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 01-Sep-17
 * Time: 12:47
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\models\ALL_RESERVATIONS;
use app\model_extended\MY_RESERVATIONS;
use app\models_search\ReportSearch;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class ReportController extends ActiveController
{
    /**
     * @var object
     */
    public $modelClass = 'app\api\modules\v1\models\REPORTS_MODEL';

    public function actionGenerate($userid)
    {
        //generate the report file
        $searchModel = new ReportSearch();
        $query = ALL_RESERVATIONS::find()->orderBy(['SALON_NAME' => SORT_DESC]); //$searchModel->search(\Yii::$app->request->queryParams);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false /*[
                'pageSize' => 3,
            ],*/
        ]);

        return $this->BuildTable($dataProvider);
        //return $dataProvider;
        $content = $this->renderPartial('all-reservations', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        return $content;
        $pdf = \Yii::$app->pdf;
        $pdf->content = $content;
        return $pdf->render();

    }

    private function BuildTable($dataProvider)
    {
        /** @var $model ALL_RESERVATIONS $data */

        $data = [];
        foreach ($dataProvider->models as $model) {
            $service_id = (int)$model->SERVICE_ID; //we will use this to group
            $status = $model->sTATUS == null ? 'PENDING' : $model->sTATUS->STATUS_NAME;
            $customer = MY_RESERVATIONS::GetCustomerInfo($model->RESERVATION_ID);
            $customer_names = "{$customer->SURNAME} {$customer->OTHER_NAMES}";
            $service_name = strtoupper($model->SERVICE_NAME);

            $data[$service_name][] = [
                'customer' => $customer_names,
                'salon_name' => $model->SALON_NAME,
                'reservation_id' => $model->RESERVATION_ID,
                'reservation_date' => $model->RESERVATION_DATE,
                'total_cost' => (float)$model->TOTAL_COST,
                'reservation_status' => $status,
                'payment_ref' => $model->PAYMENT_REF,
                'mpesa_ref' => $model->MPESA_REF,
                'booking_amount' => (float)$model->BOOKING_AMOUNT
            ];
        }

        $html = '';
        $sharingGroup = $data;
        //now let us generate the table based on the array
        $transpose = array();
        if (count($sharingGroup) > 0) {
            $output = "<table>";
            foreach ($transpose as $groupNo => $group) {
                $output .= "<tr><td>$groupNo</td><td>";
                foreach ($group as $name) {
                    $output .= "$name<br />";
                }
                $output .= "</td></tr>";
            }
            $output .= "</table>";
        }
        return $output;
    }
}