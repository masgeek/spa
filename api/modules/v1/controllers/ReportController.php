<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 01-Sep-17
 * Time: 12:47
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\models\ALL_RESERVATIONS;
use app\components\CUSTOM_HELPER;
use app\model_extended\MY_RESERVATIONS;
use app\models_search\ReportSearch;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class ReportController extends ActiveController
{
    /**
     * @var object
     */
    public $modelClass = 'app\api\modules\v1\models\REPORTS_MODEL';

    /**
     * @param $user_id
     * @return mixed
     */
    public function actionGenerate($user_id)
    {
        //generate the report file
        $query = ALL_RESERVATIONS::find()->orderBy(['SALON_NAME' => SORT_DESC]); //$searchModel->search(\Yii::$app->request->queryParams);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false /*[
                'pageSize' => 3,
            ],*/
        ]);

        $content = $this->BuildTable($dataProvider);
        //Yii::$app->getAlias('@app/runtime/mpdf').
        $file_ref = CUSTOM_HELPER::GenerateRandomRef();
        $file_name = "pdf/reports_{$file_ref}.pdf";
        // setup kartik\mpdf\Pdf component


        return CUSTOM_HELPER::GeneratePdf($user_id, $content, $file_name);

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

        //array_multisort($data, SORT_ASC);
        /*
         *         {
                    "customer": "Kimani Susan",
                    "salon_name": "Sammy Spa",
                    "reservation_id": 134,
                    "reservation_date": "2017-09-02",
                    "total_cost": 800,
                    "reservation_status": "Confirmed",
                    "payment_ref": "20FC0",
                    "mpesa_ref": "CH I chug 123",
                    "booking_amount": 400
                }
         */
        $html = '<table class="table table-bordered">';
        $html .= '<tr>';
        $html .= '<th>Service Name</th>';
        $html .= '<th>Customer Name</th>';
        $html .= '<th>Salon Name</th>';
        $html .= '<th>Reservation Date</th>';
        $html .= '<th>Reservation Status</th>';
        $html .= '<th>Total Service Cost</th>';
        $html .= '<th>Booking Amount</th>';
        $html .= '<th>Payment Reference</th>';
        $html .= '<th>Mpesa Reference</th>';
        $html .= '</tr>';
        foreach ($data as $service_name => $reservation) {
            //loop the arrays withing the service name
            $html .= '<tr>';
            $html .= '<th>' . $service_name . '</th>';
            $html .= '</tr>';
            foreach ($reservation as $key => $value) {
                $obj = (object)$value;
                $html .= '<tr>';
                $html .= '<td>&nbsp;</td>';
                $html .= '<td>' . $obj->customer . '</td>';
                $html .= '<td>' . $obj->salon_name . '</td>';
                $html .= '<td>' . $obj->reservation_date . '</td>';
                $html .= '<td>' . $obj->reservation_status . '</td>';
                $html .= '<td>' . $obj->total_cost . '</td>';
                $html .= '<td>' . $obj->booking_amount . '</td>';
                $html .= '<td>' . $obj->payment_ref . '</td>';
                $html .= '<td>' . $obj->mpesa_ref . '</td>';
                $html .= '</tr>';
            }
        }
        $html .= '</table>';

        return $html;

    }

    function build_table($array)
    {
        // start table
        $html = '<table>';
        // header row
        $html .= '<tr>';
        foreach ($array[0] as $key => $value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
        $html .= '</tr>';

        // data rows
        foreach ($array as $key => $value) {
            $html .= '<tr>';
            foreach ($value as $key2 => $value2) {
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
            $html .= '</tr>';
        }

        // finish table and return it

        $html .= '</table>';
        return $html;
    }
}