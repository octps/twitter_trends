<?php
require_once(dirname(__FILE__) . '/db.php');

class crud {
    public static function postTrends($post) {
    	$created_at = $post[0]->as_of;
    	$locations_woeid = $post[0]->locations[0]->woeid;
    	$locations_name = $post[0]->locations[0]->name;

        $dbh = Db::getInstance();
        $stmt = $dbh -> prepare("insert into trends (
					name
					, rank
					, url
					, promoted_content
					, query
					, tweet_volume
					, locations_name
					, locations_woeid
					, created_at_string
					, created_at
					, updated_at
	        	) values (
					:name
	        		, :rank
					, :url
					, :promoted_content
					, :query
					, :tweet_volume
					, :locations_name
					, :locations_woeid
					, :created_at_string
					, :created_at
					, null
	        	)"
    	);
    	$i = 1;
    	foreach ($post[0]->trends as $trend) {
    		if ($i < 11) {
		        $stmt->bindParam(':name', $trend->name, PDO::PARAM_STR);
		        $stmt->bindParam(':rank', $i, PDO::PARAM_STR);
		        $stmt->bindParam(':url', $trend->url, PDO::PARAM_STR);
				$stmt->bindParam(':promoted_content', $trend->promoted_content, PDO::PARAM_STR);
				$stmt->bindParam(':query', $trend->query, PDO::PARAM_STR);
				$stmt->bindParam(':tweet_volume', $trend->tweet_volume, PDO::PARAM_INT);
				$stmt->bindParam(':locations_name', $locations_name, PDO::PARAM_STR);
				$stmt->bindParam(':locations_woeid', $locations_woeid, PDO::PARAM_INT);
				$stmt->bindParam(':created_at_string', $created_at, PDO::PARAM_STR);
				$stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
		        $stmt->execute();
		        $i = $i + 1;
	        }
    	}
    }

    public static function getTrends($post) {
    	$created_at = $post[0]->as_of;
    	// $created_at = $trends[0]->created_at;
    	$dbh = Db::getInstance();
    	$stmt = $dbh -> prepare ("select id,rank,name,query from trends where created_at_string = :created_at_string and rank < 11");
		$stmt->bindParam(':created_at_string', $created_at, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
    }

    public static function postTweets($serachResult, $trends_best) {
    	// print_r($trends_best);
    	// print_r($serachResult);
        $dbh = Db::getInstance();
        $stmt = $dbh -> prepare("insert into tweets (
					trend_id
					, tweet_id
					, texts
					, profile_image_url
					, profile_image_url_https
					, truncated
					, hashtags
					, urls_url
					, urls_expanded_url
					, urls_display_url
					, media_url
					, media_url_https
					, media_type
					, metadata_result_type
					, metadata_iso_language_code
					, user_id
					, user_name
					, user_screen_name
					, user_location
					, created_at
					, updated_at
	        	) values (
					:trend_id
					, :tweet_id
					, :texts
					, :profile_image_url
					, :profile_image_url_https
					, :truncated
					, :hashtags
					, :urls_url
					, :urls_expanded_url
					, :urls_display_url
					, :media_url
					, :media_url_https
					, :media_type
					, :metadata_result_type
					, :metadata_iso_language_code
					, :user_id
					, :user_name
					, :user_screen_name
					, :user_location
					, now()
					, null
	        	);");
        // print_r($serachResult);

        foreach ($serachResult->statuses as $status) {
	        $stmt->bindParam(':trend_id', $trends_best['id'], PDO::PARAM_INT);
	        $stmt->bindParam(':tweet_id', $status->id, PDO::PARAM_STR);
			$stmt->bindParam(':texts', $status->text, PDO::PARAM_STR);
			$stmt->bindParam(':profile_image_url', $status->user->profile_image_url, PDO::PARAM_STR);
			$stmt->bindParam(':profile_image_url_https', $status->user->profile_image_url_https, PDO::PARAM_STR);
			$stmt->bindParam(':truncated', $status->truncated, PDO::PARAM_STR);

			$hashtagText = "";
			foreach (@$status->entities->hashtags ?: array() as $hashtag) {
				$hashtagText .= $hashtag->text . ',';
			}
			if ($hashtagText !== "") {
				$hashtagText = substr($hashtagText, 0, -1);
			}
			$stmt->bindParam(':hashtags', $hashtagText, PDO::PARAM_STR);

			$urls_url = "";
			$expanded_url = "";
			$display_url = "";
			foreach (@$status->entities->urls ?: array() as $urlVal) {
				$urls_url .= $urlVal->url . ",";
				$expanded_url .= $urlVal->expanded_url . ",";
				$display_url .= $urlVal->display_url . ",";
			}
			if ($urls_url !== "") {
				$urls_url = substr($urls_url, 0, -1);
			}
			if ($expanded_url !== "") {
				$expanded_url = substr($expanded_url, 0, -1);
			}
			if ($display_url !== "") {
				$display_url = substr($display_url, 0, -1);
			}
			$stmt->bindParam(':urls_url', $urls_url, PDO::PARAM_STR);
			$stmt->bindParam(':urls_expanded_url', $expanded_url, PDO::PARAM_STR);
			$stmt->bindParam(':urls_display_url', $display_url, PDO::PARAM_STR);


			$media_url = "";
			$media_url_https = "";
			$media_type = "";
			foreach (@$status->entities->media ?: array() as $mediaVal) {
				$media_url = $mediaVal->media_url;
				$media_url_https = $mediaVal->media_url_https;
				$media_type = $mediaVal->type;
			}
			$stmt->bindParam(':media_url', $media_url, PDO::PARAM_STR);
			$stmt->bindParam(':media_url_https', $media_url_https, PDO::PARAM_STR);
			$stmt->bindParam(':media_type', $media_type, PDO::PARAM_STR);

			$stmt->bindParam(':metadata_result_type', $status->metadata->result_type, PDO::PARAM_STR);
			$stmt->bindParam(':metadata_iso_language_code', $status->metadata->iso_language_code, PDO::PARAM_STR);

			$stmt->bindParam(':user_id', $status->user->id, PDO::PARAM_INT);
			$stmt->bindParam(':user_name', $status->user->name, PDO::PARAM_STR);
			$stmt->bindParam(':user_screen_name', $status->user->screen_name, PDO::PARAM_STR);
			$stmt->bindParam(':user_location', $status->user->location, PDO::PARAM_STR);
	        $stmt->execute();
        }
    }
// Select Max(ID) From tableA
    public static function getContents() {

    	// get keywords
        $dbh = Db::getInstance();

		$stmt = $dbh -> prepare ("select * from trends order by id DESC limit 1");
		$stmt->execute();
		$result = $stmt->fetchAll();
		$created_at_string = $result[0]['created_at_string'];

		$stmt = $dbh -> prepare ("select * from trends where created_at_string = :created_at_string AND rank < 11");
		$stmt->bindParam(':created_at_string', $created_at_string, PDO::PARAM_STR);
		$stmt->execute();
		$keywords = $stmt->fetchAll();
		// print_r($keywords);

		// get tweet
		$tweets = array();
		foreach ($keywords as $keyword) {
			$stmt = $dbh -> prepare ("select * from tweets where trend_id = :trend_id order by id ASC limit 10");
			$stmt->bindParam(':trend_id', $keyword['id'], PDO::PARAM_STR);
			$stmt->execute();
			$tweet = $stmt->fetchAll();
			$tweets[$keyword['rank']]['keyword'] = $keyword;
			$tweets[$keyword['rank']]['tweet'] = $tweet;
		}
		return $tweets;
    }

    public static function getPageTweets($id) {
    	$tweets = array();
        
        $dbh = Db::getInstance();
		$stmt = $dbh -> prepare ("select * from tweets where trend_id = :trend_id order by id ASC limit 10");
		$stmt->bindParam(':trend_id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$contnets = $stmt->fetchAll();

		$stmt = $dbh -> prepare ("select * from trends where id = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		$trend = $stmt->fetchAll();

		$tweets['trend'] = $trend;
		$tweets['contnets'] = $contnets;

		return $tweets;
    }

// select id,name,count(name) as c from trends where DATE_FORMAT(updated_at,'%Y%m%d') = "20180110" group by name order by c DESC;
    public static function getPastTrend($date) {
        $dbh = Db::getInstance();
		$stmt = $dbh -> prepare ("select id,name,count(name) as c from trends where DATE_FORMAT(updated_at,'%Y%m%d') = :date group by name order by c DESC limit 100;");
		$stmt->bindParam(':date', $date, PDO::PARAM_STR);
		$stmt->execute();
		$contnets = $stmt->fetchAll();
		return $contnets;
    }

}
