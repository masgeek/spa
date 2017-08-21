<?php

use yii\helpers\Html;
use kartik\grid\GridView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
	['class' => 'yii\grid\SerialColumn'],

	/*[
		'header' => 'Client Name',
		'attribute' => 'RESERVATION_ID',
		'format' => 'raw',
		'value' => function ($paymentmodel, $key, $index) {
			$model = \app\model_extended\MY_RESERVATIONS_VIEW::findOne(['RESERVATION_ID' => $paymentmodel->RESERVATION_ID]);
			$names = "{$paymentmodel->rESERVATION->uSER->SURNAME} {$paymentmodel->rESERVATION->uSER->OTHER_NAMES}";

			$balance = $model->getAmountToPay();

			$data = "{$names} {$balance}";
			return $data;
		},
		'group'=>true,  // enable grouping,
		'groupedRow'=>true,                    // move grouped column to a single grouped row
		'groupOddCssClass'=>'kv-grouped-row',  // configure odd group cell css class
		'groupEvenCssClass'=>'kv-grouped-row', // configure even group cell css class
	],*/
	[
		'attribute'=>'RESERVATION_ID',
		//'width'=>'100%',
		'value'=>function ($paymentmodel, $key, $index, $widget) {
			$names = "{$paymentmodel->rESERVATION->uSER->SURNAME} {$paymentmodel->rESERVATION->uSER->OTHER_NAMES}";
			return $names;
		},
		'group'=>true,  // enable grouping
		'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
			return [
				//'mergeColumns'=>[[2,2]], // columns to merge in summary
				'content'=>[             // content to show in each summary cell
					1=>'Summary (' . $model->RESERVATION_ID . ')',
					2=>GridView::F_SUM,
					4=>GridView::F_AVG,
					//4=>GridView::F_SUM,
				],
				'contentFormats'=>[      // content reformatting for each summary cell
					2=>['format'=>'number', 'decimals'=>2],
					3=>['format'=>'number', 'decimals'=>2],
					4=>['format'=>'number', 'decimals'=>2],
					//6=>['format'=>'number', 'decimals'=>2],
				],
				'contentOptions'=>[      // content html attributes for each summary cell
					1=>['style'=>'font-variant:small-caps'],
					2=>['style'=>'text-align:right'],
					3=>['style'=>'text-align:right'],
					//6=>['style'=>'text-align:right'],
				],
				// html attributes for group summary row
				'options'=>['class'=>'danger','style'=>'font-weight:bold;']
			];
		}
	],
	//'PAYMENT_ID',
	//'RESERVATION_ID',
	'BOOKING_AMOUNT',
	//'FINAL_AMOUNT',
	//'BALANCE',
	[
		//'header' => 'Amount Paid',
		'attribute' => 'FINAL_AMOUNT',
		//'format' => 'currency',
		'visible' => false,
		'value' => function ($paymentmodel, $key, $index) {
			/* @var $model \app\model_extended\MY_RESERVATIONS_VIEW */
			$model = \app\model_extended\MY_RESERVATIONS_VIEW::findOne(['RESERVATION_ID' => $paymentmodel->RESERVATION_ID]);
			return $model->getAmountToPay();
		}
	],
	[
		'header' => 'Total Cost',
		'attribute' => 'BALANCE',
		//'format' => 'currency',
		'visible' => true,
		'value' => function ($paymentmodel, $key, $index) {
			/* @var $model \app\model_extended\MY_RESERVATIONS_VIEW */
			$model = \app\model_extended\MY_RESERVATIONS_VIEW::findOne(['RESERVATION_ID' => $paymentmodel->RESERVATION_ID]);
			return $model->getBalance($total_cost = true);
		}
	],
	'DATE_PAID',
	'PAYMENT_REF',
	'MPESA_REF',
	//'FINALIZED',

	//['class' => 'yii\grid\ActionColumn'],
];
?>
<div class="payments-index">

    <h3><?= Html::encode($this->title) ?></h3>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'export' => false,
		'columns' => $gridColumns,
		'responsive' => true,
		'hover' => true,
		'toggleData' => true,
	]); ?>
</div>
