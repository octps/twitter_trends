<?php
require_once(dirname(__FILE__) . "/./twitteroauth/autoload.php");
require_once(dirname(__FILE__) . "/./config.php");
require_once(dirname(__FILE__) . '/./checkDb.php');
require_once(dirname(__FILE__) . '/./crud.php');

use Abraham\TwitterOAuth\TwitterOAuth;

if (checkDB::check(15) === false) {
    $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);//OAuth認証

    // トレンドを取得する
    function getTrend($twitter) {
        $request = $twitter->get("trends/place", array("id"=>"23424856",'count' => '10'));
        return $request;
    }
    $trends = getTrend($twitter);

    crud::postTrends($trends);

    // トレンドの上位3つを取得
    $trends_bests = crud::getTrends($trends);

    // $trendObjects = array();
    // $trendObjects[] = $trends[0]->trends[0];
    // $trendObjects[] = $trends[0]->trends[1];
    // $trendObjects[] = $trends[0]->trends[2];

    function searchTrend($twitter, $trends_best) {
        $query = $trends_best['query'];
        $result = $twitter->get(
                "search/tweets",
                array(
                    "q" => $query,
                    "result_type" => "mixed",
                    'count' => '10'
                )
        );
        return $result;
    }
    
    // $serachResults = array();
    foreach($trends_bests as $trends_best) {
        $serachResult = searchTrend($twitter, $trends_best);
        crud::postTweets($serachResult, $trends_best);
    }
}

$contnets = crud::getContents();