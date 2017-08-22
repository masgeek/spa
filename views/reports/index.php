<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models_search\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My  Reservations';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
	['class' => 'yii\grid\SerialColumn'],
	//'RESERVATION_DATE',
	[
		'label' => Yii::t('app', "Date"),
		'attribute' => 'RESERVATION_DATE',
		//'value' => 'RESERVATION_DATE',
		'format' => 'date',
		'filter' => \kartik\daterange\DateRangePicker::widget([
			'model' => $searchModel,
			'attribute' => 'RESERVATION_DATE',
			'convertFormat' => true,
			'startAttribute' => 'START_DATE',
			'endAttribute' => 'END_DATE',
			//'hideInput'=>true,
			'presetDropdown'=>true,
			'pluginOptions' => [

				'locale' => [
					'format' => 'Y-m-d',
					'separator'=>' TO '
				],
			],
		]),
	],
	'TOTAL_COST',
	'STATUS_ID',
	'PAYMENT_REF',
	'MPESA_REF',
	'BOOKING_AMOUNT',
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
	'showPageSummary' => false,
	'panel' => [
		'type' => 'primary',
		//'heading'=>'Products'
	]
]); ?>
