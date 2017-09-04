<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/24/2017
 * Time: 10:57 PM
 */

namespace app\components;

use app\api\modules\v1\models\REPORTS_MODEL;
use kartik\mpdf\Pdf;

class CUSTOM_HELPER
{
    const ADMIN_ACCOUNT = 'ADMIN';
    const SALON_ADMIN = 'BUSINESS DISABLED';


    const ACCOUNT_PENDING = 1;
    const ACCOUNT_ACTIVE = 2;
    const ACCOUNT_SUSPENDED = 3;
    const ACCOUNT_DEACTIVATED = 4;

    public static function GenerateRandomRef()
    {
        $rand = substr(md5(microtime()), rand(0, 26), 5);
        return strtoupper($rand);
    }

    /**
     * Generate pdf based
     * @param $user_id
     * @param $content
     * @param $file_name
     * @param $report_type
     * @return mixed
     */
    public static function GeneratePdf($user_id, $content, $file_name, $report_type)
    {
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'destination' => Pdf::DEST_FILE,
            'filename' => $file_name,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Reservations Report'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [Date('Y-m-d') . " {$report_type} Report"],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        $pdf->render();

        //next save to the reports table
        return REPORTS_MODEL::SaveReport($user_id, $file_name, $report_type);
    }

    public static function GetTimeStamp()
    {
        $date = new \DateTime();
        return $date->getTimestamp();
    }

}