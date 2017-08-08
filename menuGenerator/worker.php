<?php

$input = file_get_contents('input_for_menu.tsv');
$radek = explode("\n", $input);

foreach ($radek as &$value) {
	$value = preg_split("/[\t]/", $value);
}

$inputLang = file_get_contents('jazyky.tsv');
$radecek = explode("\n", $inputLang);

foreach ($radecek as &$value) {
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

	$content = '<!-- Start Navigation List -->
				<ul class="nav navbar-nav navbar-right">
					<li><a href="' . $url[0] . '">' . $title[0] . '</a></li>
					<li><a href="' . $url[1] . '">' . $title[1] . '</a></li>
					<li><a href="' . $url[2] . '">' . $title[2] . '</a>
						<ul class="dropdown">
							<li><a href="' . $url[3] . '">' . $title[3] . '</a></li>
							<li><a href="' . $url[4] . '">' . $title[4] . '</a></li>
							<li><a href="' . $url[5] . '">' . $title[5] . '</a></li>
						</ul>
					</li>
					<li><a href="' . $url[6] . '">' . $title[6] . '</a>
						<ul class="dropdown">
							<li><a href="' . $url[6] . '#cz">' .$radecek[22][$y]. '</a></li>
							<li><a href="' . $url[6] . '#us">' .$radecek[0][$y]. '</a></li>
							<li><a href="' . $url[6] . '#de">' .$radecek[13][$y]. '</a></li>
							<li><a href="' . $url[6] . '#fr">' .$radecek[6][$y]. '</a></li>
							<li><a href="' . $url[6] . '#es">' .$radecek[19][$y]. '</a></li>
							<li><a href="' . $url[6] . '#it">' .$radecek[10][$y]. '</a></li>
							<li><a href="' . $url[6] . '#ru">' .$radecek[17][$y]. '</a></li>
							<li><a href="' . $url[6] . '#hr">' .$radecek[9][$y]. '</a></li>
							<li><a href="' . $url[6] . '#pl">' .$radecek[15][$y]. '</a></li>
							<li><a href="' . $url[6] . '#hu">' .$radecek[12][$y]. '</a></li>
							<li><a href="' . $url[6] . '#gr">' .$radecek[18][$y]. '</a></li>
							<li><a href="' . $url[6] . '#nl">' .$radecek[8][$y]. '</a></li>
							<li><a href="' . $url[6] . '#tr">' .$radecek[21][$y]. '</a></li>
							<li><a href="' . $url[6] . '#pt">' .$radecek[16][$y]. '</a></li>
							<li><a href="' . $url[6] . '#dk">' .$radecek[4][$y]. '</a></li>
							<li><a href="' . $url[6] . '#fi">' .$radecek[5][$y]. '</a></li>
							<li><a href="' . $url[6] . '#no">' .$radecek[14][$y]. '</a></li>
							<li><a href="' . $url[6] . '#se">' .$radecek[20][$y]. '</a></li>
							<li><a href="' . $url[6] . '#bg">' .$radecek[2][$y]. '</a></li>
							<li><a href="' . $url[6] . '#sa">' .$radecek[1][$y]. '</a></li>
							<li><a href="' . $url[6] . '#jp">' .$radecek[11][$y]. '</a></li>
							<li><a href="' . $url[6] . '#cn">' .$radecek[3][$y]. '</a></li>
							<li><a href="' . $url[6] . '#il">' .$radecek[7][$y]. '</a></li>
						</ul>
					</li>
				</ul>
				<!-- End Navigation List -->';
	if(!is_dir('output/' . $getLang[$y] . '/snippets/')){
    	mkdir('output/' . $getLang[$y] . '/snippets/', 0777, true);
    }
	file_put_contents('output/' . $getLang[$y] . '/snippets/menu.html', $content);
}

?>

