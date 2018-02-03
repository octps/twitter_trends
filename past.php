<?php
// require_once(dirname(__FILE__) . '/lib/checkDb.php');
require_once(dirname(__FILE__) . '/lib/getPast.php');

?>
<!doctype html>
<html lang="ja">
  <head>
    <? require_once(dirname(__FILE__) . '/parts/ga.php'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=0.5,user-scalable=yes,initial-scale=1.0" />
    <meta name="description" content="ワダツイはTwitter（ツイッター）で話題のトレンドワードをまとめています。<?= $date->format('Y年m月d日'); ?>の話題のまとめです。">
    <meta name="author" content="ワダツイ">
    <link rel="icon" href="/images/favicon.ico">

    <title>ワダツイ:<?= $date->format('Y年m月d日'); ?>のまとめ | Twitter（ツイッター）で話題のトレンドワードのまとめ</title>

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="ワダツイ:<?= $date->format('Y年m月d日'); ?>のまとめ | Twitter（ツイッター）で話題のトレンドワードのまとめ">
    <meta itemprop="description" content="ワダツイはTwitter（ツイッター）で話題のトレンドワードをまとめています。過去の話題のまとめです。">
    <meta itemprop="image" content="http://wadatw.com/images/logo_opg.png">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="http://wadatw.com/past.php<?= $query ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="ワダツイ:<?= $date->format('Y年m月d日'); ?>のまとめ | Twitter（ツイッター）で話題のトレンドワードのまとめ">
    <meta property="og:description" content="ワダツイはTwitter（ツイッター）で話題のトレンドワードをまとめています。過去の話題のまとめです。">
    <meta property="og:image" content="http://wadatw.com/images/logo_opg.png">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ワダツイ:<?= $date->format('Y年m月d日'); ?>のまとめ | Twitter（ツイッター）で話題のトレンドワードのまとめ">
    <meta name="twitter:description" content="ワダツイはTwitter（ツイッター）で話題のトレンドワードをまとめています。過去の話題のまとめです。">
    <meta name="twitter:image" content="http://wadatw.com/images/logo_opg.png">

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

        <!-- Jumbotron -->
        <div class="leads">
          <h1 class="pageH1"><br><?= $date->format('Y年m月d日'); ?>のまとめ</h1>
          <p class="lead">ワダツイでまとめたTwitter（ツイッター）のトレンドワードの過去のまとめです。</p>
          <!-- <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p> -->
        </div>
        <div class="select_day">
          <form action="/past.php" method="get">
            <select name="year" >
              <? foreach (range(2018,$currentYear) as $val): ?>
              <option <?= $date->format('Y') == $val ? "selected" : "" ?> value="<?= $val ?>"><?= $val ?></option>年
              <? endforeach; ?>
            </select>
            <select name="month">
              <? foreach (range(1,12) as $val): ?>
              <option <?= $date->format('m') == sprintf("%02d",$val) ? "selected" : "" ; ?> value="<?= sprintf("%02d",$val) ?>"><?= $val ?></option>月
              <? endforeach; ?>
            </select>
            <select name="day">
              <? foreach (range(1,31) as $val): ?>
              <option <?= $date->format('d') == sprintf("%02d",$val) ? "selected" : "" ?> value="<?= sprintf("%02d",$val) ?>"><?= $val ?></option>日
              <? endforeach; ?>
            </select>
            <input type="submit" value="表示する  ">
          </form>
        </div>
        <div class="sns">
          <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-lang="ja" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          <a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-label-counter" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
        </div>
       <div class="row">
       <? if (empty($contents)): ?>
        データがありません。
       <? else: ?>
       <? foreach ($contents as $contnet): ?>
          <div class="col-lg-12 item" >
          <? $url = str_replace("#", "%23", $contnet['name']); ?>
          <h2><a href="https://twitter.com/search?f=tweets&q=<?= $url ?>%20lang%3Aja%20until%3A<?= $date->format('Y-m-d') ?>"><?= $contnet['name'] ?></a></h2>
            登場回数<span><?= $contnet['c'] ?>回</span>
          </div>
        <? endforeach; ?>
        <? endif; ?>
        </div>
      </main>

      <!-- Site footer -->
    </div> <!-- /container -->
    <? require_once(dirname(__FILE__) . '/parts/footer.php'); ?>
  </body>
</html>
