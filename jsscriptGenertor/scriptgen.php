<?php

$input = file_get_contents('input_for_menu.tsv');
$radek = explode("\n", $input);

foreach ($radek as &$value) {
	$value = preg_split("/[\t]/", $value);
}

function getLangShortcode($string){ // Získání ISO kódu jazyka
    return substr($string, 0, -3);  
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

for($y = 0; $y < 23; $y++){
	
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

    if($getLang[$y] == 'cs'){
        $message = 'message: "Při poskytování našich služeb nám pomáhají soubory cookie. Využíváním našich služeb s jejich používáním souhlasíte.",';
        $btn[0] = 'acceptText: "Rozumím",';
        $btn[1] = 'policyText: "Další informace",';
    }else{
        $message = 'message: "We use cookies to offer you the best experience online. By continuing to use our website, you agree to the use of cookies. If you would like to know more about cookies read more.",';
        $btn[0] = 'acceptText: "Accept",';
        $btn[1] = 'policyText: "More",';    
    }

	for($i = 0; $i < count($radek); $i++){
		if(getLangShortcode($radek[$i][0]) == $getLang[$y]){
			switch($radek[$i][6]){
				case 'A1: Start':
					$url[0] = $radek[$i][2];
					$title[0] = $radek[$i][7];
					break;
				case 'A2: Vlastnosti':
					$url[1] = $radek[$i][2];
					$title[1] = $radek[$i][7];
					break;
				case 'A3: Náhled':
					$url[2] = $radek[$i][2];
					$title[2] = $radek[$i][7];
					break;
				case 'A31: Náhled W8':
					$url[3] = $radek[$i][2];
					$title[3] = $radek[$i][7];
					break;
				case 'A32: Náhled Android':
					$url[4] = $radek[$i][2];
					$title[4] = $radek[$i][7];
					break;
				case 'A33: Náhled iOS':
					$url[5] = $radek[$i][2];
					$title[5] = $radek[$i][7];
					break;
				case 'A5: Uplatnění':
					$url[6] = $radek[$i][2];
					$title[6] = $radek[$i][7];
					break;
			}
		}
	}

    $output = '$(document).ready(function(){
    // cookie info
    $.cookieBar({
        ' . $message . '
        ' . $btn[0] . '
        append: true,
        fixed: true,
        bottom: true,
        policyButton: true,
        ' . $btn[1] . '
        policyURL: "/' . $getLang[$y] . '-cookies"
    }); 
    
    // Active menu settings
    var pathname = window.location.pathname;
    var navChildrens = $(".navbar-nav").children("li");
    
    switch (pathname) {
        case "' . $url[0] . '":
            navChildrens.eq(0).children("a").eq(0).addClass("active");
            break;       
        case "' . $url[1] . '":
            navChildrens.eq(1).children("a").eq(0).addClass("active");
            break;     
        case "' . $url[2] . '":
        case "' . $url[5] . '":
        case "' . $url[4] . '":
        case "' . $url[3] . '":
            navChildrens.eq(2).children("a").eq(0).addClass("active");
            break;   
        case "' . $url[6] . '":
            navChildrens.eq(3).children("a").eq(0).addClass("active");
            break;
    }
});';

if(!is_dir('output/' . $getLang[$y] . '/js/')){
    	mkdir('output/' . $getLang[$y] . '/js/', 0777, true);
    }
	file_put_contents('output/' . $getLang[$y] . '/js/script.js', $output);

}



?>