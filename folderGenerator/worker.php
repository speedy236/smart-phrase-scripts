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

for($i = 0; $i < 23; $i++){
if(!is_dir('output/' . $getLang[$i] . '/snippets/')){
    	mkdir('output/' . $getLang[$i] . '/snippets/', 0777, true);
}

copy('contact_form.asp', 'output/' . $getLang[$i] . '/snippets/contact_form.asp');
}


?>