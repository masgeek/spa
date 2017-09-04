<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 01-Sep-17
 * Time: 12:47
 */

namespace app\api\modules\v1\models;


use app\models\Reports;
use yii\db\Expression;
use yii\helpers\Url;

class REPORTS_MODEL extends Reports
{

    public function fields()
    {
        $fields = parent::fields();

        $fields['FILE_LINK'] = function ($model) {
            $absoluteBaseUrl = Url::base(true);
            $file_link = "{$absoluteBaseUrl}/{$model->REPORT_URL}";
            return $file_link;
        };

        return $fields;
    }


    public static function BuildReservationsTable($dataProvider)
    {
        /** @var $model ALL_RESERVATIONS $data */

        $data = [];
        foreach ($dataProvider->models as $model) {
            $service_id = (int)$model->SERVICE_ID; //we will use this to group
            $status = $model->sTATUS == null ? 'PENDING' : $model->sTATUS->STATUS_NAME;
            $customer = \app\model_extended\MY_RESERVATIONS::GetCustomerInfo($model->RESERVATION_ID);
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

    public static function SaveReport($user_id, $file_name, $report_type)
    {
        $resp = [
            0
        ];
        $model = new REPORTS_MODEL();
        $model->isNewRecord = true;

        $model->SALON_OWNER_ID = $user_id;
        $model->REPORT_URL = $file_name;
        $model->DATE_GENERATED = new Expression('NOW()');
        $model->EXPIRY_DATE = new Expression('NOW()');
        $model->REPORT_TYPE = $report_type;
        $model->STATUS = 'ACTIVE';


        if ($model->save() && $model->validate()) {
            $resp = $model;
        } else {
            $model->getErrors();
        }
        return $resp;
    }
}