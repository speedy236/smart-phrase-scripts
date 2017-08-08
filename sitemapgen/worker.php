<?php 

$obsahHandler = file_get_contents('input.tsv');
$obsah = explode("\n", $obsahHandler);

foreach ($obsah as &$value) {
    $value = preg_split("/[\t]/", $value);
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

for($i = 0; $i < 23; $i++){
    $url[0] = '';
    $title[0] = '';

    $url[1] = '';
    $title[1] = '';

    $url[2] = '';
    $title[2] = '';

    $url[3] = '';
    $title[3] = '';

    $url[4] = '';
    $title[4] = '';

    $url[5] = '';
    $title[5] = '';

    $url[6] = '';
    $title[6] = '';

    $url[7] = '';
    $title[7] = '';

    $url[8] = '';
    $title[8] = '';

    $url[9] = '';
    $title[9] = '';

    $url[10] = '';
    $title[10] = '';

    $url[11] = '';
    $title[11] = '';

    for($y = 0; $y < count($obsah); $y++){
    if(getLangShortcode($obsah[$y][0]) == $getLang[$i]){
        switch(getNoticeCode($obsah[$y][6], 0)){
            case 'A1':
                $url[0] = $obsah[$y][2];
                $title[0] = $obsah[$y][7];    
                break;
            case 'A2':
                $url[1] = $obsah[$y][2];
                $title[1] = $obsah[$y][7];    
                break;
            case 'A3':
                $url[2] = $obsah[$y][2];
                $title[2] = $obsah[$y][7];    
                break;
            case 'A31':
                $url[3] = $obsah[$y][2];
                $title[3] = 'Windows 8';    
                break;
            case 'A32':
                $url[4] = $obsah[$y][2];
                $title[4] = 'Android';    
                break;
            case 'A33':
                $url[5] = $obsah[$y][2];
                $title[5] = 'iOS';    
                break;
            case 'A4':
                $url[6] = $obsah[$y][2];
                $title[6] = $obsah[$y][7];    
                break;
            case 'A41':
                $url[7] = $obsah[$y][2];
                $title[7] = 'Windows 8';    
                break;
            case 'A42':
                $url[8] = $obsah[$y][2];
                $title[8] = 'Android';    
                break;
            case 'A43':
                $url[9] = $obsah[$y][2];
                $title[9] = 'iOS';    
                break;
            case 'A5':
                $url[10] = $obsah[$y][2];
                $title[10] = $obsah[$y][7];    
                break;
            case 'A8':
                $url[11] = $obsah[$y][2];
                $title[11] = $obsah[$y][3];    
                break;
        }
    }
    }

    $pageStr = '<div class="sitemap-content col-md-12">
                        <ul class="icons-list">
                            <li><a href="' . $url[0] . '"><strong>' . $title[0] . '</strong></a></li>
                            <li><a href="' . $url[1] . '"><strong>' . $title[1] . '</strong></a>
                                <li><a href="' . $url[2] . '"><strong>' . $title[2] . '<strong></a></li>
                                <ul class="icons-list">
                                    <li>
                                        <i class="icon-angle-right"></i><a href="' . $url[5] . '">Apple<sup>&#174;</sup> (iOS)</a>
                                    </li>
                                    <li>
                                        <i class="icon-angle-right"></i><a href="' . $url[4] . '">Android&trade;</a>
                                    </li>
                                    <li>
                                        <i class="icon-angle-right"></i><a href="' . $url[3] . '">Windows<sup>&#174;</sup> 8</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="' . $url[10] . '"><strong>' . $title[10] . '</strong></a></li>
                            <li><a href="' . $url[6] . '"><strong>' . $title[6] . '</strong></a></li>
                            <ul class="icons-list">
                                    <li>
                                        <i class="icon-angle-right"></i><a href="' . $url[9] . '">Apple<sup>&#174;</sup> (iOS)</a>
                                    </li>
                                    <li>
                                        <i class="icon-angle-right"></i><a href="' . $url[8] . '">Android&trade;</a>
                                    </li>
                                    <li>
                                        <i class="icon-angle-right"></i><a href="' . $url[7] . '">Windows<sup>&#174;</sup> 8</a>
                                    </li>
                            </ul>
                            <li><a href="' . $url[11] . '"><strong>' . $title[11] . '</strong></a></li>
                        </ul>
                        </div>';
    
    if(!is_dir('output/' . $getLang[$i] . '/')){
        mkdir('output/' . $getLang[$i] . '/', 0777, true);
    }

    file_put_contents('output/' . $getLang[$i] . '/preout.txt', $pageStr);

}


?>