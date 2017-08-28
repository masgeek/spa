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
		'brandLabel' => 'Salon Management',
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			//'class' => 'navbar-fixed-top',
			'class' => 'navbar-inverse navbar-fixed-top',
		],
	]);
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		//'options' => ['class' =>'nav navbar-nav'],
		'items' => [
			[
				'label' => 'Manage Users',
				'visible'=>Yii::$app->user->identity->usertype===\app\components\CUSTOM_HELPER::ADMIN_ACCOUNT,
				'items' => [
                    ['label' => 'Pending Users', 'url' => ['/pending-users']],
                    '<li class="divider"></li>',
                    ['label' => 'Active Users', 'url' => ['/active-users']],
                    '<li class="divider"></li>',
                    ['label' => 'Suspended Users', 'url' => ['/suspended-users']],
                    '<li class="divider"></li>',
                    ['label' => 'Deactivated Users', 'url' => ['/deactivated-users']],
					'<li class="divider"></li>',
				],
			],
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
