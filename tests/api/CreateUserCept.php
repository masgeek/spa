<?php
$I = new ApiTester($scenario);

$user_info = [
    'full_names' => 'Test Event',
    'email' => uniqid() . '@mail.com',];

$I->wantTo('create a user');
//$I->amHttpAuthenticated('service_user', '123456');
$I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
$I->sendPOST('/users', $user_info);
//$I->sendGET('/events');


$I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 201
$I->seeResponseIsJson();
$I->seeResponseContainsJson(['full_names' => 'Test Event']);