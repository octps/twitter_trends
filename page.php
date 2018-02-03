<?php
  require_once(dirname(__FILE__) . '/lib/getDetail.php');
?>
<!doctype html>
<html lang="ja">
  <head>
    <? require_once(dirname(__FILE__) . '/parts/ga.php'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=0.5,user-scalable=yes,initial-scale=1.0" />
    <meta name="description" content="Twitter（ツイッター）で話題の<?= $tweets['trend'][0]['name'] ?>」。<?= $tweets['contnets'][0]['created_at'] ?>現在のまとめです。">
    <meta name="author" content="ワダツイ">
    <link rel="icon" href="/images/favicon.ico">

    <title>ワダツイ:「<?= $tweets['trend'][0]['name'] ?>」のまとめ（<?= $tweets['contnets'][0]['created_at'] ?>） | Twitter（ツイッター）で話題のトレンドワードのまとめ</title>

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="ワダツイ:「<?= $tweets['trend'][0]['name'] ?>」のまとめ（<?= $tweets['contnets'][0]['created_at'] ?>） | Twitter（ツイッター）で話題のトレンドワードのまとめ">
    <meta itemprop="description" content="Twitter（ツイッター）で話題の<?= $tweets['trend'][0]['name'] ?>」。<?= $tweets['contnets'][0]['created_at'] ?>現在のまとめです。">
    <meta itemprop="image" content="http://wadatw.com/images/logo_opg.png">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="http://wadatw.com/page.php?id=<?= $_GET['id'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="ワダツイ:「<?= $tweets['trend'][0]['name'] ?>」のまとめ（<?= $tweets['contnets'][0]['created_at'] ?>） | Twitter（ツイッター）で話題のトレンドワードのまとめ">
    <meta property="og:description" content="Twitter（ツイッター）で話題の<?= $tweets['trend'][0]['name'] ?>」。<?= $tweets['contnets'][0]['created_at'] ?>現在のまとめです。">
    <meta property="og:image" content="http://wadatw.com/images/logo_opg.png">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ワダツイ:「<?= $tweets['trend'][0]['name'] ?>」のまとめ（<?= $tweets['contnets'][0]['created_at'] ?>） | Twitter（ツイッター）で話題のトレンドワードのまとめ">
    <meta name="twitter:description" content="Twitter（ツイッター）で話題の<?= $tweets['trend'][0]['name'] ?>」。<?= $tweets['contnets'][0]['created_at'] ?>現在のまとめです。">
    <meta name="twitter:image" content="http://wadatw.com/images/logo_opg.png">

    <!-- Meta Tags Generated via http://heymeta.com -->

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="css/custom.css" rel="stylesheet">

  </head>

  <body>
    <header class="masthead">
      <nav class="navbar navbar-expand-md navbar-light mb-4" >
        <div class="container">
        <a class="navbar-brand text-dark" href="/"><img src="/images/logo2.png" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="" href="/past.php">過去のまとめ</a>
            </li>
            <li class="nav-item">
              <a class="" href="/about.php">ワダツイについて</a>
            </li>
          </ul>
<!--           <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->
          </div>
        </div>
      </nav>
    </header>

    <div class="container">

      <main role="main">
        <div class="leads">
          <h1 class="pageH1">「<?= $tweets['trend'][0]['name'] ?>」のまとめ（<?= $tweets['contnets'][0]['created_at'] ?>）</h1>
          <p class="lead text-muted">更新時間 : <?= $tweets['contnets'][0]['created_at'] ?></p>
          <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> -->
        </div>
        <div class="sns">
          <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-lang="ja" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          <a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-label-counter" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
        </div>
       <div class="row">
        <h2><a href=""><?= $tweets['trend'][0]['name'] ?></a></h2>
       <? foreach ($tweets["contnets"] as $contnet): ?>
          <div class="col-lg-12 item">
          	<div class="names">
              <a  target="_balnk" href="https://twitter.com/<?= $contnet['user_screen_name'] ?>"><img src="<?= $contnet['profile_image_url'] ?>"></a>
          		<strong class="fullname show-popup-with-id "><a target="_balnk" href="https://twitter.com/<?= $contnet['user_screen_name'] ?>"><?= $contnet['user_name'] ?></a></strong><br>
          		<a target="_balnk" href="https://twitter.com/<?= $contnet['user_screen_name'] ?>"><b class="username u-dir">@<?= $contnet['user_screen_name'] ?></b></a>
      				<span class="timestamp"><?= $contnet['created_at'] ?></span>
          	</div>
            <?
              $contnet['texts'] = preg_replace("/\s#(w*[一-龠_ぁ-ん_ァ-ヴーａ-ｚＡ-Ｚa-zA-Z0-9]+|[a-zA-Z0-9_]+|[a-zA-Z0-9_]w*)/u", " <a href=\"https://twitter.com/search/%23\\1\" target=\"twitter\">#\\1</a>", $contnet['texts']);
              $contnet['texts'] = preg_replace("/^#(w*[一-龠_ぁ-ん_ァ-ヴーａ-ｚＡ-Ｚa-zA-Z0-9]+|[a-zA-Z0-9_]+|[a-zA-Z0-9_]w*)/u", " <a href=\"https://twitter.com/search/%23\\1\" target=\"twitter\">#\\1</a>", $contnet['texts']);
              $contnet['texts'] = preg_replace("/(@[A-Za-z0-9_]{1,15})/", " <a href=\"https://twitter.com/search/\\1\" target=\"twitter\">\\1</a>", $contnet['texts']);
              $contnet['texts'] = preg_replace("/(https?:\/\/t.co\/[a-zA-Z0-9]{10})/", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $contnet['texts']);
              $text = $contnet['texts'];
              // $pattern = '(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)';
              // $replacement = '<a href="\1" target="_blank">\1</a>';
              // $text = mb_ereg_replace($pattern, $replacement, htmlspecialchars($contnet['texts']));
            ?>
            <? if ($contnet['media_url'] !== ""): ?>
            <p class="TweetTextSize text w70"><?= $text ?><br><a target="_blank" class="toDetail" href="https://twitter.com/nogizaka46/status/<?= $contnet['tweet_id'] ?>">twitterで見る</a></p>
            <div class="image w30">
              <a href="https://twitter.com/nogizaka46/status/<?= $contnet['tweet_id'] ?>" target="_blank"><img class="col-lg-12" src="<?= $contnet["media_url"] ?>"></a>
            </div>
            <? else: ?>
            <p class="TweetTextSize text w100"><?= $text ?><br><a target="_blank" class="toDetail" href="https://twitter.com/nogizaka46/status/<?= $contnet['tweet_id'] ?>">twitterで見る</a></p>
            <? endif; ?>
          </div>
        <? endforeach; ?>
        </div>
      </main>

      <!-- Site footer -->
    </div> <!-- /container -->
    <? require_once(dirname(__FILE__) . '/parts/footer.php'); ?>
  </body>
</html>
