<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 01-Sep-17
 * Time: 12:47
 */

namespace app\api\modules\v1\models;


use app\model_extended\MY_RESERVATIONS_VIEW;
use app\models\Reports;
use yii\db\Expression;
use yii\helpers\Url;

class REPORTS_MODEL extends Reports
{

    const RESERVATIONS = 'RESERVATIONS';
    const RESERVATION = 'RESERVATION';
    const SERVICES = 'SERVICES';
    const PAYMENTS = 'PAYMENTS';

    public function fields()
    {
        $fields = parent::fields();

        $fields['REPORT_TYPE'] = function ($model) {
            $report_type = "{$model->REPORT_TYPE} Report";
            return ucfirst(strtolower($report_type));
        };
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
                'service_name' => $model->SERVICE_NAME,
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
        $html .= '<th>Reservation ID</th>';
        $html .= '<th>Customer Name</th>';
        $html .= '<th>Salon Name</th>';
        //$html .= '<th>Service Name</th>';
        $html .= '<th>Reservation Date</th>';
        $html .= '<th>Reservation Status</th>';
        $html .= '<th>Total Service Cost</th>';
        $html .= '<th>Booking Amount</th>';
        $html .= '<th>Payment Reference</th>';
        //$html .= '<th>Mpesa Reference</th>';
        $html .= '</tr>';
        foreach ($data as $service_name => $reservation) {
            //loop the arrays withing the service name
            foreach ($reservation as $key => $value) {
                $obj = (object)$value;
                $html .= '<tr>';
                $html .= '<td>' . $obj->reservation_id . '</td>';
                $html .= '<td>' . $obj->customer . '</td>';
                $html .= '<td>' . $obj->salon_name . '</td>';
                //$html .= '<td>' . $obj->service_name . '</td>';
                $html .= '<td>' . $obj->reservation_date . '</td>';
                $html .= '<td>' . $obj->reservation_status . '</td>';
                $html .= '<td>' . $obj->total_cost . '</td>';
                $html .= '<td>' . $obj->booking_amount . '</td>';
                $html .= '<td>' . $obj->payment_ref . '</td>';
                $html .= '</tr>';
            }
        }
        $html .= '</table>';


        return $html;
    }

    public static function BuildPaymentsTable($dataProvider)
    {
        $data = [];
        foreach ($dataProvider->models as $model) {
            /** @var $model SERVICE_PAYMENTS */
            $status = $model->STATUS == null ? 'PENDING' : $model->STATUS;
            $customer = USER_MODEL::findOne($model->USER_ID);


            $customer_names = "{$customer->SURNAME} {$customer->OTHER_NAMES}";
            $reservation_id = $model->RESERVATION_ID;


            $res = MY_RESERVATIONS_VIEW::findOne(['RESERVATION_ID' => $model->RESERVATION_ID]);


            $data[$reservation_id][] = [
                'customer' => $customer_names,
                'reservation_id' => $model->RESERVATION_ID,
                'payment_ref' => $model->PAYMENT_REF,
                'mpesa_ref' => $model->MPESA_REF,
                'booking_amount' => (float)$model->BOOKING_AMOUNT,
                'date_paid' => "{$model->DATE_PAID} {$model->TIME_PAID}",
                'total_cost' => $res->getBalance(true),
                'paid' => $res->getAmountPaid(),
                'balance' => $res->getBalance(),
                'payment_status' => $status,
            ];

        }

        //array_multisort($data, SORT_ASC);
        $html = '<table class="table table-bordered table-condensed">';
        $html .= '<tr>';
        //$html .= '<th>Reservation ID</th>';;
        $html .= '<th>Customer Names</th>';
        $html .= '<th>Payment Ref</th>';
        $html .= '<th>Mpesa Ref</th>';
        $html .= '<th>Total Cost</th>';
        $html .= '<th>Amount Paid</th>';
        $html .= '<th>Balance</th>';
        $html .= '<th>Date Paid</th>';
        $html .= '<th>Payment Status</th>';
        $html .= '</tr>';
        foreach ($data as $reservation_id => $reservation) {
            //loop the arrays withing the service name
            $html .= '<tr>';
            $html .= '<th>' . $reservation_id . '</th>';
            $html .= '</tr>';
            $total_amount = 0;
            $total_paid = 0;
            $balance = 0;
            foreach ($reservation as $key => $value) {

                $obj = (object)$value;
                $html .= '<tr>';
                //$html .= '<td>&nbsp;</td>';
                $html .= '<td>' . $obj->customer . '</td>';
                $html .= '<td>' . $obj->payment_ref . '</td>';
                $html .= '<td>' . $obj->mpesa_ref . '</td>';
                $html .= '<td>-</td>';
                $html .= '<td>' . $obj->booking_amount . '</td>';
                $html .= '<td>-</td>';
                $html .= '<td>' . $obj->date_paid . '</td>';
                $html .= '<td>' . $obj->payment_status . '</td>';
                $html .= '</tr>';

                $total_amount = $obj->total_cost;
                $total_paid = $obj->paid;
                $balance = $obj->balance;
            }
            //Totals Row
            $html .= '<tr>';
            //$html .= '<td>&nbsp;</td>';
            $html .= '<td>&nbsp;</td>';
            $html .= '<td>&nbsp;</td>';
            $html .= '<td>&nbsp;</td>';
            $html .= '<td>' . $total_amount . '</td>';
            $html .= '<td>' . $total_paid . '</td>';
            $html .= '<td>' . $balance . '</td>';
            $html .= '<td>&nbsp;</td>';
            $html .= '<td>&nbsp;</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';


        return $html;
    }

    public static function BuildServicesTable($dataProvider)
    {
        /** @var $model ALL_SERVICES_VIEW */
        $data = [];
        foreach ($dataProvider->models as $model) {

            $salon_name = $model->SALON_NAME;
            $service_name = $model->SERVICE_NAME;


            $data[$salon_name][$service_name] = [
                'offered_service_id' => $model->OFFERED_SERVICE_ID,
                'reservations' => RESERVED_SERVICE_MODEL::ServicesReservedCount($model->OFFERED_SERVICE_ID)/*$model->RESERVATIONS*/,
                'service_name' => $model->SERVICE_NAME,
                'salon_name' => $model->SALON_NAME,
                'owner' => $model->OWNER_ID,
                'reservation_date' => $model->RESERVATION_DATE,
            ];

        }

        //array_multisort($data, SORT_ASC);
        $html = '<table class="table table-bordered table-condensed" border="1">';
        foreach ($data as $salon_name => $reservation) {
            $html .= '<tr>';
            $html .= '<th>Service Name</th>';
            $html .= '<th>Salon Name</th>';
            $html .= '<th>No of Reservations</th>';
            $html .= '<th>Filter Date</th>';
            $html .= '</tr>';
            foreach ($reservation as $key => $value) {

                $obj = (object)$value;
                $html .= '<tr>';
                //$html .= '<td>&nbsp;</td>';
                $html .= '<td>' . $obj->service_name . '</td>';
                $html .= '<td>' . $obj->salon_name . '</td>';
                $html .= '<td>' . $obj->reservations . '</td>';
                $html .= '<td>' . $obj->reservation_date . '</td>';
            }
        }
        $html .= '</table>';


        return $html;
    }

    public static function SaveReport($user_id, $file_name, $report_type)
    {
        $resp = null;
        $model = new REPORTS_MODEL();
        $model->isNewRecord = true;

        $model->SALON_OWNER_ID = $user_id;
        $model->REPORT_URL = $file_name;
        $model->DATE_GENERATED = new Expression('NOW()');
        $model->EXPIRY_DATE = new Expression('NOW()');
        $model->REPORT_TYPE = $report_type;
        $model->STATUS = 'READY';


        if ($model->save() && $model->validate()) {
            $resp = REPORTS_MODEL::findOne($model->REPORT_ID);
        }
        return $resp;
    }
}