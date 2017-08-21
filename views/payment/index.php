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
		'groupFooter'=>function ($paymentmodel, $key, $index, $widget) { // Closure method
			$model = \app\model_extended\MY_RESERVATIONS_VIEW::findOne(['RESERVATION_ID' => $paymentmodel->RESERVATION_ID]);
			return [
				//'mergeColumns'=>[[2,2]], // columns to merge in summary
				'content'=>[             // content to show in each summary cell
					1=>'Summary',
					2=>GridView::F_SUM,
					4=>"Total Cost {$model->getBalance($total_cost = true)}",
					5=>"Balance Remaining {$model->getBalance()}",
					//4=>GridView::F_AVG,
					//4=>GridView::F_SUM,
				],
				'contentFormats'=>[      // content reformatting for each summary cell
					2=>['format'=>'number', 'decimals'=>2],
					3=>['format'=>'number', 'decimals'=>2],
					//4=>['format'=>'number', 'decimals'=>2],
					//6=>['format'=>'number', 'decimals'=>2],
				],
				'contentOptions'=>[      // content html attributes for each summary cell
					1=>['style'=>'font-variant:small-caps'],
					2=>['style'=>'text-align:right'],
					3=>['style'=>'text-align:right'],
					4=>['style'=>'font-variant:small-caps'],
					5=>['style'=>'font-variant:small-caps'],
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
	'PAYMENT_REF',
	'MPESA_REF',
	'DATE_PAID',
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
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Payment Grouping By Reservations</h3>',
			'type'=>'primary',
			//'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
			'before'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Refresh Grid', ['index'], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		//'showPageSummary'=>true,
	]); ?>
</div>
