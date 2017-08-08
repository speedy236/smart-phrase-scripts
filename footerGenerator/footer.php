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

$obsahPath = file_get_contents('obsah.tsv');
$obsah = explode("\n", $obsahPath);

foreach ($obsah as &$value) {
    $value = preg_split("/[\t]/", $value);
}

$translatePath = file_get_contents('translate.tsv');
$translate = explode("\n", $translatePath);

foreach ($translate as &$value) {
    $value = preg_split("/[\t]/", $value);
}

function getLangShortcode($string){ // Získání ISO kódu jazyka
    return substr($string, 0, -3);  
}

for($i = 0; $i < 23; $i++){
    
    $url[0] = '';
    $url[1] = '';
    $url[2] = '';
    $url[3] = '';
    $url[4] = '';
    $title[0] = '';
    $title[1] = '';
    $title[2] = '';
    $title[3] = '';
    $title[4] = '';
    
    for($y = 0; $y < count($obsah); $y++){
        if($obsah[$y][6] == 'A10: Mapa webu' && $getLang[$i] == getLangShortcode($obsah[$y][0])){
            $url[0] = $obsah[$y][2];
            $title[0] = $obsah[$y][3];
        }
        
        switch($getLang[$i]){
            case 'cs':
                $url[1] = "/ochranne-znamky";
                $title[1] = "Ochranné známky";
                $url[4] = "/servisni-stranka";
                $title[4] = "Servisní stránka";
                break;
            default:
                $url[1] = "/trademark";
                $title[1] = "Trademarks";
                $url[4] = "/service-page";
                $title[4] = "Service page";
        }

        /*if($getLang[$i] == 'cs'){
            
        }else ($getLang[$i] == "en"){
            
        }*/

        if($obsah[$y][6] == 'A4: Podpora' && $getLang[$i] == getLangShortcode($obsah[$y][0])){
            $url[2] = $obsah[$y][2];
            $title[2] = $obsah[$y][7];
        }

        if($obsah[$y][6] == 'A8: Kontakt' && $getLang[$i] == getLangShortcode($obsah[$y][0])){
            $url[3] = $obsah[$y][2];
            $title[3] = $obsah[$y][3];
        }
    }

    $pageString = '
    <!-- Start Footer -->
<footer>
    <div class="container">
        <!-- Footer Widget -->
        <div class="row footer-widgets">
            <!-- Social Links Widget -->
            <div class="col-md-4">
                <div class="footer-widget social-widget">
                    <h4>' . $translate[0][$i] . '<span class="head-line"></span></h4>                    
                    <ul class="social-icons">
                        <li>
			                     <a class="facebook sh-tooltip" data-placement="bottom" title="Facebook" data-original-title="Facebook" href="https://www.facebook.com/sharer/sharer.php?sdk=joey&u=http%3A%2F%2Fwww.smart-phrase.com%2F&display=popup&ref=plugin&src=share_button">
                              <i class="icon-facebook-2"></i>
                           </a>
                        </li>
                        <li>
                           <a class="twitter sh-tooltip" data-placement="bottom" title="Twitter" data-original-title="Twitter" href="https://twitter.com/intent/tweet?original_referer=http%3A%2F%2Fsmart-phrase.com&ref_src=twsrc%5Etfw&tw_p=tweetbutton&url=http%3A%2F%2Fwww.smart-phrase.com%2F">
                              <i class="icon-twitter-2"></i>
                           </a>
                        </li>
                        <li>
                           <a class="google sh-tooltip" data-placement="bottom" title="Google+" data-original-title="Google plus" href="https://plus.google.com/share?url=http://www.smart-phrase.com/">
                              <i class="icon-gplus-1"></i>
                           </a>
                        </li>
                        <li>
			                     <a class="linkdin sh-tooltip" data-placement="bottom" title="LinkedIn" data-original-title="Linkedin" href="https://www.linkedin.com/cws/share?url=http%3A%2F%2Fwww.smart-phrase.com%2F&original_referer=http%3A%2F%2Fwww.smart-phrase.com%2F%3Falign-class%3Dmiddle-center&token=&isFramed=true&lang=cs_CZ">
                              <i class="icon-linkedin-1"></i>
                           </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <!-- Facebook SDK for JavaScript -->
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/cs_CZ/sdk.js#xfbml=1&version=v2.8";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, "script", "facebook-jssdk"));</script>

                            <br>       
                            <!-- Like button code -->                    
                            <div class="fb-like" data-href="http://www.smart-phrase.com" data-layout="button" data-action="like" data-size="large"></div>
                        </li>                    
                    </ul>
                </div>
            </div>
            <!-- End Social Links Widget -->
            <!-- App Store Links -->
            <div class="col-md-4">
                <div class="footer-widget store-widget">
                    <h4>' . $translate[1][$i] . '<span class="head-line"></span></h4>                    
                    <ul class="store-icons">
                        <li>
			                     <a target="_blank" class="ios sh-tooltip" data-placement="bottom" title="Apple App Store" data-original-title="App Store" href="' . $translate[3][$i] . '">
                              <i class="icon-apple"></i>
                           </a>
                        </li>
                        <li>
                           <a  target="_blank" class="android sh-tooltip" data-placement="bottom" title="Google Play" data-original-title="Google Play" href="https://play.google.com/store/search?q=pub:Euvit">
                              <i class="icon-android"></i>
                           </a>
                        </li>
                        <li>
                           <a target="_blank" class="windows sh-tooltip" data-placement="bottom" title="Windows Store" data-original-title="Windows Store" href="' . $translate[4][$i] . '">
                              <i class="icon-windows"></i>
                           </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Store Links Widget -->
            <!-- QR code Widget -->            
            <div class="col-md-4">
		             <div class="footer-widget">
			                <h4>QR<span class="head-line"></span></h4>
              		    <img width="81" height="81" src="/images/www.smart-phrase.com_qr_code.jpg" alt="www.smart-phrase.com QR code">
                 </div>
            </div>           
            <!-- End QR Code Widget -->
        </div>
        <!-- End Footer Widget -->

        <!-- Start Copyright & links-->
        <div class="copyright-section">
            <div class="row">
                <div class="col-md-6">
                    <p>©2012-2017 Euvit s.r.o. ' . $translate[2][$i] . '</p>
                </div>
                <div class="col-md-6">
                    <ul class="footer-nav">
<!--                        <li><a href="' . $url[4] . '">' . $title[4] . '</a></li>
-->                        <li><a href="' . $url[0] . '">' . $title[0] . '</a></li>
                        <li><a href="' . $url[1] . '">' . $title[1] . '</a></li>
                        <li><a href="' . $url[2] . '">' . $title[2] . '</a></li>
                        <li><a href="' . $url[3] . '">' . $title[3] . '</a></li>
                    </ul>
                </div>						
            </div>
        </div>
        <!-- End Copyright & links-->     
    </div>
    <!-- Simple affiliate links for the website - all iTunes, App Store, iBookstore and Mac App Store links will be converted to affiliate links. -->
    <script type="text/javascript">var _merchantSettings=_merchantSettings || [];_merchantSettings.push(["AT", "1000lce3"]);(function(){var autolink=document.createElement("script");autolink.type="text/javascript";autolink.async=true; autolink.src= ("https:" == document.location.protocol) ? "https://autolinkmaker.itunes.apple.com/js/itunes_autolinkmaker.js" : "http://autolinkmaker.itunes.apple.com/js/itunes_autolinkmaker.js";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(autolink, s);})();</script>
</footer>
<!-- End Footer -->';

if(!is_dir('output/' . $getLang[$i] . '/snippets/')){
   	mkdir('output/' . $getLang[$i] . '/snippets/', 0777, true);
    }
    file_put_contents('output/' . $getLang[$i] . '/snippets/footer.html', $pageString);

}

?>

