<?php
$I = new ApiTester($scenario);

$event_info = [
    'event_name' => 'Test Event',
    'event_country' => 'kenya',
    'event_location' => 'Nairobi',
    'event_start_date' => '2017-04-03 00:00:07',
    'event_end_date' => '2017-04-26 00:00:07',
    'event_lat' => '1.6',
    'event_long' => '36'];

$I->wantTo('create an event via API');
//$I->amHttpAuthenticated('service_user', '123456');
$I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
$I->sendPOST('/events', $event_info);


$resp = $I->grabResponse(); //grab the response

$decoded = json_decode($resp);
$event_id = $decoded->event_id;


$I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 201
$I->seeResponseIsJson();
//$I->seeResponseContainsJson(['event_name' => 'Test Event']);
$I->seeResponseMatchesJsonType([
    'event_id'=>'integer',
    'event_name' => 'string',
    'event_country' => 'string',
    'event_location' => 'string',
    'event_start_date' => 'string',
    'event_end_date' => 'string',
    //'event_lat' => 'decimal',
    //'event_long' => 'int'
]);

//next create the booth
$event_booth_info = [
    'event_id' => $event_id,
    'event_booth_name' => 'Test booth',
    'booth_price' => '800',
    'booth_image' => 'http://lorempixel.com/400/200/business',
    'description' => 'Testing booth test'
];


$I->wantTo('create an event booth via API');
$I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
$I->sendPOST('/booths', $event_booth_info);

$resp = $I->grabResponse(); //grab the response

$I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 201
$I->seeResponseIsJson();
$I->seeResponseContainsJson(['event_id' => $event_id]);