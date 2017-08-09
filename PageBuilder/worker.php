<?php

$getLang = array(
            0 => 'cs',
            1 => 'da',
            2 => 'de',
            3 => 'en',
            4 => 'es',
            5 => 'fr',
            6 => 'hr',
            7 => 'it',
            8 => 'hu',
            9 => 'nl',
            10 => 'nb',
            11 => 'pl',
            12 => 'pt',
            13 => 'fi',
            14 => 'sv',
            15 => 'tr',
            16 => 'el',
            17 => 'bg',
            18 => 'ru',
            19 => 'he',
            20 => 'ar',
            21 => 'zh',
            22 => 'ja');

$page = $argv[1];
$translatePath = $argv[2];

$obsahHandler = file_get_contents('input.tsv');
$obsah = explode("\n", $obsahHandler);

foreach ($obsah as &$value) {
    $value = preg_split("/[\t]/", $value);
}

$translateHandler = file_get_contents('translate/' . $translatePath);
$translate = explode("\n", $translateHandler);

foreach ($translate as &$value) {
    $value = preg_split("/[\t]/", $value);
}

function constructHead($page, $language){
    $path = 'output/heads/' . $language . '/' . $page . '.txt';
    return file_get_contents($path);
}

function constructSitemap($language){
    $path = 'output/sitemap/' . $language . '/preout.txt';
    return file_get_contents($path);
}

function constructDropMobile($page, $language){
    $path = 'output/drop/mobile/' . $language . '/' . $page . '.txt';
    return file_get_contents($path);
}

function constructDropDesktop($page, $language){
    $path = 'output/drop/desktop/' . $language . '/' . $page . '.txt';
    return file_get_contents($path);
}

function constructBreadCrumb($page, $language){
    $path = 'output/breadcrumbs/' . $language . '/' . $page . '.txt';
    return file_get_contents($path);
}

function getVlastnostiButton($language, $type){
    global $obsah;
    for($a = 0; $a < count($obsah); $a++){
        //todo
    }
}

function getNoticeCode($notice, $type){ //$type 0: Číslo notice, 1: Obsah notice
    $values = explode(':', $notice);
    if($type == 0){
        return preg_replace('/\s+/', '', $values[0]);
    }elseif($type == 1){
        return substr($values[1], 1);
    }  
}

function getLangShortcode($string){ // Získání ISO kódu jazyka
    return substr($string, 0, -3);  
}


function replace($from, $to){
    global $pageString;
    if(!str_replace($from, $to, $pageString)){
        echo $from . '   ' . $to . PHP_EOL;
    }
    $pageString = str_replace($from, $to, $pageString);
}

for($y = 0; $y < 23; $y++){
    $url[0] = '';
    $url[1] = '';

    $osurl[0] = '';
    $osurl[1] = '';
    $osurl[2] = '';

    for($i = 0; $i < count($obsah); $i++){
        if(getNoticeCode($obsah[$i][6], 0) == 'A3' && getLangShortcode($obsah[$i][0]) == $getLang[$y]){
            $url[0] = $obsah[$i][2];
        }
        if(getNoticeCode($obsah[$i][6], 0) == 'A2' && getLangShortcode($obsah[$i][0]) == $getLang[$y]){
            $url[1] = $obsah[$i][2];
        }

        if(getNoticeCode($obsah[$i][6], 0) == 'A31' && getLangShortcode($obsah[$i][0]) == $getLang[$y]){
            $osurl[0] = $obsah[$i][2];
        }
        if(getNoticeCode($obsah[$i][6], 0) == 'A32' && getLangShortcode($obsah[$i][0]) == $getLang[$y]){
            $osurl[1] = $obsah[$i][2];
        }
        if(getNoticeCode($obsah[$i][6], 0) == 'A33' && getLangShortcode($obsah[$i][0]) == $getLang[$y]){
            $osurl[2] = $obsah[$i][2];
        }
    }

    $pageString = '<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="cs"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="cs" class="no-js"> <![endif]-->
<html lang="cs">

<head>
  ' . constructHead($page, $getLang[$y]) . '
  <!-- #include file = "snippets/css_js.html" -->
</head>

<body>
  <!-- Container -->
  <div id="container">

    <!-- Start Header -->
    <div class="hidden-header"></div>
    <header class="clearfix">

      <!-- Start Top Bar -->
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <!-- Start Contact Info -->
              ' . constructDropDesktop($page, $getLang[$y]) . '
              <!-- End Contact Info -->
            </div>
          </div>
        </div>
      </div>
      <!-- End Top Bar -->

      <!-- Start Header ( Logo & Naviagtion ) -->
      <div class="navbar navbar-default navbar-top">
        <div class="container">
          <div class="navbar-header">
            <!-- Stat Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                          <i class="icon-menu-1"></i>
                      </button>
            <!-- End Toggle Nav Link For Mobiles -->
            <!-- #include file = "snippets/logo.html" -->
          </div>
          <div class="navbar-collapse collapse">
            ' . constructDropMobile($page, $getLang[$y]) . '
            <!-- #include file = "snippets/menu.html" -->
          </div>
        </div>
      </div>
      <!-- End Header ( Logo & Naviagtion ) -->
    </header>
    <!-- End Header -->

    <!-- Start Page Banner -->
    ' . constructBreadCrumb($page, $getLang[$y]) . '
    <!-- End Page Banner -->

    <!-- Start Content -->
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12" style="margin-bottom: 20px">
            <p>' . $translate[0][$y] . '</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 text-center"><img alt="Languages" src="/lang/' . $getLang[$y] . '/images/travelers_phrasebook_languages_iphone.png"
              width="310"></div>
          <div class="col-md-6 text-center"><img alt="Languages" src="../../lang/' . $getLang[$y] . '/images/travelers_phrasebook_languages_ipad.png"
              width="500"></div>
        </div>
        <div class="hr5" style="margin-top:30px; margin-bottom:30px;"></div>
        <div class="row">
          <div class="col-md-12" style="margin-bottom: 20px">
            <p>' . $translate[1][$y] . '</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 text-center"><img alt="Sentence" src="/lang/' . $getLang[$y] . '/images/travelers_phrasebook_sentence_iphone.png"
              width="310"></div>
          <div class="col-md-6 text-center"><img alt="Sentence" src="../../lang/' . $getLang[$y] . '/images/travelers_phrasebook_sentence_ipad.png"
              width="500"></div>
        </div>
        <div class="hr5" style="margin-top:30px; margin-bottom:30px;"></div>
        <div class="row">
          <div class="col-md-12" style="margin-bottom: 20px">
            <p>' . $translate[2][$y] . '</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 text-center"><img alt="Settings" src="/lang/' . $getLang[$y] . '/images/travelers_phrasebook_settings_iphone.png"
              width="310"></div>
          <div class="col-md-6 text-center"><img alt="Settings" src="../../lang/' . $getLang[$y] . '/images/travelers_phrasebook_settings_ipad.png"
              width="500"></div>
        </div>

        <!-- #include file = "snippets/offer.html" -->
        <!-- #include file = "snippets/badge.html" -->
      </div>
    </div>
    <!-- End Content -->

    <!-- #include file = "snippets/footer.html" -->
  </div>


  <!-- Go To Top Link -->
  <a href="#" class="back-to-top"><i class="icon-up-open-1"></i></a>

  <div id="loader">
    <div class="spinner">
      <div class="dot1"></div>
      <div class="dot2"></div>
    </div>
  </div>
</body>

</html>';
        
    if(!is_dir('pages/' . $getLang[$y] . '/')){
        mkdir('pages/' . $getLang[$y] . '/', 0777, true);
    }

    file_put_contents('pages/' . $getLang[$y] . '/' . $page . '.asp', $pageString);
}