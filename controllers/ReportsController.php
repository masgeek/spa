<?php

namespace app\controllers;

class ReportsController extends \yii\web\Controller
{
    public function actionAllReservations()
    {
        return $this->render('all-reservations');
    }

    public function actionCustomers()
    {
        return $this->render('customers');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPayments()
    {
        return $this->render('payments');
    }

}
