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

$in = file_get_contents('logo.tsv');
$hodnota = preg_split("/[\t]/", $in);

$obsahHandler = file_get_contents('input.tsv');
$obsah = explode("\n", $obsahHandler);

foreach ($obsah as &$value) {
    $value = preg_split("/[\t]/", $value);
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

for($i = 0; $i < 23; $i++){
    $url = '';
    for($y = 0; $y < count($obsah); $y++){
        if(getLangShortcode($obsah[$y][0]) == $getLang[$i] && getNoticeCode($obsah[$y][6], 0) == 'A1'){
            $url = $obsah[$y][2];
        }
    }
    $row = '<a class="navbar-brand" href="' . $url . '"><span class="accent-color">' . $hodnota[$i] . '</span></a>';
    if(!is_dir('output/' . $getLang[$i] . '/snippets/')){
   	mkdir('output/' . $getLang[$i] . '/snippets/', 0777, true);
    }
    file_put_contents('output/' . $getLang[$i] . '/snippets/logo.html', $row);
}

?>