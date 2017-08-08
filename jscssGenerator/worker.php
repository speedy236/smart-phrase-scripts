<?php

$input = file_get_contents('store.csv');
$radek = explode("\n", $input);

foreach ($radek as &$value) {
	$value = explode(';', $value);
}

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

for($i = 0; $i < 23; $i++){
    $output = '<!-- Google Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<!-- Favicon -->
<link rel="shortcut icon" href="../../images/favicon.png">

<!-- Bootstrap CSS  -->
<link rel="stylesheet" href="../../css/bootstrap.css" type="text/css" media="screen">

<!-- Revolution Banner CSS -->
<link rel="stylesheet" type="text/css" href="../../css/settings.css" media="screen">

<!-- Vella CSS Styles  -->
<link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen">

<!-- Responsive CSS Styles  -->
<link rel="stylesheet" type="text/css" href="../../css/responsive.css" media="screen">

<!-- Css3 Transitions Styles  -->
<link rel="stylesheet" type="text/css" href="../../css/animate.css" media="screen">

<!-- Color CSS Styles  -->
<link rel="stylesheet" type="text/css" href="../../css/colors/blue.css" title="blue" media="screen">

<!-- Fontello Icons CSS Styles  -->
<link rel="stylesheet" type="text/css" href="../../css/fontello.css" media="screen">
<!--[if IE 7]><link rel="stylesheet" href="../../css/fontello-ie7.css"><![endif]-->

<!-- Flags  -->
<link rel="stylesheet" type="text/css" href="../../css/flag-icon.min.css" media="screen">
<!-- cookie notification  -->
<link rel="stylesheet" type="text/css" href="../../css/jquery.cookiebar.css">

<!-- Vella JS  -->
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.migrate.js"></script>
<script type="text/javascript" src="../../js/modernizrr.js"></script>
<script type="text/javascript" src="../../js/bootstrap.js"></script>
<script type="text/javascript" src="../../js/jquery.fitvids.js"></script>
<script type="text/javascript" src="../../js/owl.carousel.min.js"></script>
<script type="text/javascript" src="../../js/nivo-lightbox.min.js"></script>
<script type="text/javascript" src="../../js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="../../js/jquery.appear.js"></script>
<script type="text/javascript" src="../../js/count-to.js"></script>
<script type="text/javascript" src="../../js/jquery.textillate.js"></script>
<script type="text/javascript" src="../../js/jquery.lettering.js"></script>
<script type="text/javascript" src="../../js/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="../../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../../js/jquery.parallax.js"></script>
<script type="text/javascript" src="../../js/mediaelement-and-player.js"></script>
<script type="text/javascript" src="../../js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="../../js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="../../js/pgwbrowser.min.js"></script>
<script type="text/javascript" src="../../js/jquery.cookiebar.js"></script> 
<script type="text/javascript" src="../../js/script.js"></script>
<script type="text/javascript" src="/lang/' . $getLang[$i] . '/js/script.js"></script>
<!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<script>
  (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,"script","//www.google-analytics.com/analytics.js","ga");

  ga("create", "UA-30160244-1", "auto");
  ga("send", "pageview");

</script>

<!-- Promoting Apps with Smart App Banners -->
<meta name="apple-itunes-app" content="app-id=' . $radek[0][$i] . ', affiliate-data=1000lce3">
<meta name="google-play-app" content="' . $radek[1][$i] . '">
';

if(!is_dir('output/' . $getLang[$i] . '/snippets/')){
    	mkdir('output/' . $getLang[$i] . '/snippets/', 0777, true);
    }
	file_put_contents('output/' . $getLang[$i] . '/snippets/css_js.html', $output);

}


?>