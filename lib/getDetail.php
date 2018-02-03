<?php
require_once(dirname(__FILE__) . "/./config.php");
require_once(dirname(__FILE__) . '/./checkDb.php');
require_once(dirname(__FILE__) . '/./crud.php');

$get = $_GET;
if (!isset($get['id'])
    || !is_numeric($get['id'])
    || is_null($get['id'])
) {
    header("location: /404.php");
}

$tweets = crud::getPageTweets($get['id']);
