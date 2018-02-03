<?php
require_once(dirname(__FILE__) . "/./config.php");
require_once(dirname(__FILE__) . '/./checkDb.php');
require_once(dirname(__FILE__) . '/./crud.php');

$get = $_GET;
$now = new DateTime();
$nowString = $now->format('Ymd');

$currentYear = $now->format('Y');
$currentMonth = $now->format('m');
$currentDay = $now->format('d');

if (!isset($get['year'])
    || !is_numeric($get['year'])
    || is_null($get['year'])
	|| $get['year'] < "2018" 
	|| $get['year'] > $currentYear
) {
	$get['year'] = $currentYear;
    $get['date'] = $nowString;
}

if (!isset($get['month'])
    || !is_numeric($get['month'])
    || is_null($get['month'])
	|| $get['month'] <= 0
	|| $get['month'] >= 13
) {
	$get['month'] = $currentMonth;
    $get['date'] = $nowString;
}

if (!isset($get['day'])
    || !is_numeric($get['day'])
    || is_null($get['day'])
	|| $get['day'] <= 0
	|| $get['day'] >= 31
) {
	$get['day'] = $currentDay;
    $get['date'] = $nowString;
}

$query_date = $get['year'] . $get['month'] . $get['day'];

$query = "?year=" . $get['year'] . "&month=" . $get['month'] . "&day=" . $get['day'];
$contents = crud::getPastTrend($query_date);

$date = new DateTime($query_date);