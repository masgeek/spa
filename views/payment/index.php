<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-index">

    <h3><?= Html::encode($this->title) ?></h3>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			[
				'header' => 'Client Name',
				'attribute' => 'RESERVATION_ID',
				'value' => function ($model, $key, $index) {
					$names = "{$model->rESERVATION->uSER->SURNAME} {$model->rESERVATION->uSER->OTHER_NAMES}";
					return $names;
				}
			],
			//'PAYMENT_ID',
			//'RESERVATION_ID',
			'BOOKING_AMOUNT',
			'FINAL_AMOUNT',
			'DATE_PAID',
			'PAYMENT_REF',
			'MPESA_REF',
			'FINALIZED',
			'BALANCE',

			//['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
