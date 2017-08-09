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

function constructUse($page, $language){
    $path = 'output/use/' . $language . '.txt';
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
 
    <script type="text/javascript" src="../../js/use.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/use.css" media="screen">
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
                    <div class="col-md-12">
                        <h2 class="classic-title">' . $translate[0][$y] . '</h2>
                        <p>
                           ' . $translate[1][$y] . '
                        </p>
                    </div>
                    <br />                       
                    <div class="col-md-12">
                        <div class="dropdown">
                            <button class="btn btn-default btn-sm langselect" type="button" data-toggle="dropdown">' . $translate[2][$y] . ' <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".cz" class="">' . $translate[25][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".us" class="">' . $translate[3][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".de">' . $translate[16][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".fr">' . $translate[9][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".es">' . $translate[22][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".it">' . $translate[13][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".ru">' . $translate[20][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".hr">' . $translate[12][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".pl">' . $translate[18][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".hu">' . $translate[15][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".gr">' . $translate[21][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".nl">' . $translate[11][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".tr">' . $translate[24][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".pt">' . $translate[19][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".dk">' . $translate[7][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".fi">' . $translate[8][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".no">' . $translate[17][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".se">' . $translate[23][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".bg">' . $translate[5][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".sa">' . $translate[4][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".jp">' . $translate[14][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".cn">' . $translate[6][$y] . '</a></li>
                                <li><a onClick="a_onClick($(this).attr(\'data-filter\').substring(1), $(this).text())" href="#"
                                        data-filter=".il">' . $translate[10][$y] . '</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="hr5" style="margin-top:30px; margin-bottom:45px;"></div>
                <div class="center-block">
                    ' . constructUse($page, $getLang[$y]) . '
                    <div class="clearfix"></div>
                </div>
                <!-- #include file = "snippets/offer.html" -->
                <!-- #include file = "snippets/badge.html" -->
                <!-- End Content -->
            </div>
        </div>
        <!-- #include file = "snippets/footer.html" -->
    </div>
    <!-- End Container -->
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