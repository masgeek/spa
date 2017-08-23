<?php

//use yii\helpers\Html;
use  kartik\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models_search\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salons Revenue Reports';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
	['class' => 'kartik\grid\SerialColumn'],
	//'RESERVATION_DATE',


	[
		'attribute' => 'RESERVATION_ID',
		//'width' => '10%',
		'value' => function ($model, $key, $index, $widget) {
			///$data = \app\model_extended\ALL_SERVICES::findOne($model->SERVICE_ID)->SERVICE_NAME;
			//$data = $model->sERVICE->SERVICE_NAME;
			return $model->RESERVATION_ID;
		},
		'group' => true,  // enable grouping
		'groupedRow' => false,
		'pageSummaryFunc'=>GridView::F_COUNT,
		'pageSummary' => true,
		'groupFooter' => function ($model, $key, $index, $widget) { // Closure method

			return [
				//'mergeColumns'=>[[2,2]], // columns to merge in summary
				'content' => [             // content to show in each summary cell
					1 => "Summary for booking [{$model->RESERVATION_ID}]",
					3 => GridView::F_COUNT,
					//4 => "Total Cost",
					//5 => "Balance",
					//4=>GridView::F_AVG,
					//4=>GridView::F_SUM,
				],
				'contentFormats' => [      // content reformatting for each summary cell
					3 => ['format' => 'number', 'decimals' => 0],
					//4=>['format'=>'number', 'decimals'=>2],
					//6=>['format'=>'number', 'decimals'=>2],
				],
				'contentOptions' => [      // content html attributes for each summary cell
					1 => ['style' => 'font-variant:small-caps'],
					2 => ['style' => 'text-align:right'],
					3 => ['style' => 'text-align:right'],
					4 => ['style' => 'font-variant:small-caps'],
					5 => ['style' => 'font-variant:small-caps'],
					//6=>['style'=>'text-align:right'],
				],
				// html attributes for group summary row
				'options' => ['class' => 'success', 'style' => 'font-weight:bold;']
			];
		}

	],
	[
		'attribute' => 'SALON_NAME',

	],
	[
		'attribute' => 'DATE_PAID',
		'format' => 'date',
		'filter' => \kartik\daterange\DateRangePicker::widget([
			'model' => $searchModel,
			'attribute' => 'DATE_PAID',
			'convertFormat' => true,
			'startAttribute' => 'START_DATE',
			'endAttribute' => 'END_DATE',
			//'hideInput'=>true,
			'presetDropdown' => true,
			'pluginOptions' => [

				'locale' => [
					'format' => 'Y-m-d',
					'separator' => ' TO '
				],
			],
		]),
	],
	[
		'class' => '\kartik\grid\DataColumn',
		'attribute' => 'FINAL_AMOUNT',
		'format'=>'currency',
		'pageSummaryFunc'=>GridView::F_SUM,
		'pageSummary' => true,
	],
	'BALANCE',
	'PAYMENT_REF',
	'MPESA_REF',
    'PAYMENT_STATUS',
	[
		'class' => '\kartik\grid\DataColumn',
		'attribute' => 'BOOKING_AMOUNT',
		'format'=>'currency',
		'pageSummaryFunc'=>GridView::F_SUM,
		'pageSummary' => true,
	]
]
?>

<h1><?= Html::encode($this->title) ?></h1>
<?php //echo $this->render('_search', ['model' => $searchModel]); ?>


<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	//'export' => false,
	'autoXlFormat' => true,
	'export' => [
		'fontAwesome' => true,
		'showConfirmAlert' => false,
		'target' => GridView::TARGET_BLANK
	],
	'columns' => $gridColumns,
	'responsive' => true,
	'hover' => true,
	'toggleData' => true,
	'pjax' => false,
	'showPageSummary' => true,
	'panel' => [
		'type' => 'primary',
		//'heading'=>'Products'
	]
]); ?>
