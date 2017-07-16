<?php
$I = new ApiTester($scenario);


$I->wantTo('Fetch all events');
$I->sendGET('/events');


$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
$I->seeResponseIsJson();