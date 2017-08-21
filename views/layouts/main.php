<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
	NavBar::begin([
		'brandLabel' => 'SPA Admin',
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			'class' => 'navbar-inverse navbar-fixed-top',
		],
	]);
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'items' => [
			[
				'label' => 'My Salon',
				'visible' => Yii::$app->user->identity->usertype === \app\components\CUSTOM_HELPER::SALON_ADMIN,
				'items' => [
					//'<li class="divider"></li>',
					//'<li class="dropdown-header">Salon Management</li>',
					['label' => 'Manage Salons', 'url' => ['/my-salons'], 'visible' => Yii::$app->user->identity->usertype === \app\components\CUSTOM_HELPER::SALON_ADMIN],
					'<li class="divider"></li>',
					['label' => 'Manage Staff', 'url' => ['/my-staff'], 'visible' => Yii::$app->user->identity->usertype === \app\components\CUSTOM_HELPER::SALON_ADMIN],
				],
			],
			[
				'label' => 'Reports',
				//'visible'=>Yii::$app->user->identity->usertype===\app\components\CUSTOM_HELPER::ADMIN_ACCOUNT,
				'items' => [
					['label' => 'Revenue Reports', 'url' => ['/reports/payments'], 'visible' => Yii::$app->user->identity->usertype === \app\components\CUSTOM_HELPER::SALON_ADMIN],
					'<li class="divider"></li>',
					['label' => 'Reservation Report', 'url' => ['/reports/all-reservations'], 'visible' => Yii::$app->user->identity->usertype === \app\components\CUSTOM_HELPER::SALON_ADMIN],
				],
			],
			['label' => 'Reservations', 'url' => ['/my-bookings'], 'visible' => Yii::$app->user->identity->usertype === \app\components\CUSTOM_HELPER::SALON_ADMIN],
			['label' => 'Payments', 'url' => ['/my-payments'], 'visible' => Yii::$app->user->identity->usertype === \app\components\CUSTOM_HELPER::SALON_ADMIN],
			['label' => 'Manage Users', 'url' => ['/manage-users'], 'visible' => Yii::$app->user->identity->usertype === \app\components\CUSTOM_HELPER::ADMIN_ACCOUNT],
			['label' => 'Manage Services', 'url' => ['/services'], 'visible' => Yii::$app->user->identity->usertype === \app\components\CUSTOM_HELPER::ADMIN_ACCOUNT],
			Yii::$app->user->isGuest ? (
			['label' => 'Login', 'url' => ['/site/login']]
			) : (
				'<li>'
				. Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton(
					'Logout (' . Yii::$app->user->identity->username . ')',
					['class' => 'btn btn-link logout']
				)
				. Html::endForm()
				. '</li>'
			)
		],
	]);
	NavBar::end();
	?>

    <div class="col-md-10 col-md-offset-1" style="margin-top: 60px">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= $content ?>
    </div>
</div>
<!--
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy;  <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
