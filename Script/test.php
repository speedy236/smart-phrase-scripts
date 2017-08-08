<?php

$action = $argv[1]; //Prepinac

$pages = array(
    "A1" => "index.asp",
    "A2" => "features.asp",
    "A3" => "preview.asp",
    "A31" => "previewwindows8.asp",
    "A32" => "previewandroid.asp",
    "A33" => "previewios.asp",
    "A4" => "support.asp",
    "A41" => "supportwindows8.asp",
    "A42" => "supportandroid.asp",
    "A43" => "supportios.asp",
    "A5" => "use.asp",
    "A8" => "contact.asp",
    "A10" => "sitemap.asp",
    "A11" => "cookies.asp",
    "A12" => "trademarks.asp",
    "A13" => "service.asp"

);



function utf8_fopen_read($fileName) { // Čtení UTF8 
    $fc = iconv('utf-8', 'utf-8', file_get_contents($fileName)); 
    $handle=fopen("php://memory", "rw"); 
    fwrite($handle, $fc); 
    fseek($handle, 0); 
    return $handle; 
} 

function lowerCase($string){ // Velká na malá
    return strtolower($string);
}

function stripSlash($string){ // Odstranění lomítka na začátku
    return substr($string, 1);
}

function removeExtension($string){ //Odstranění přípony
    return substr($string, 0, -4);
}

function getLangShortcode($string){ // Získání ISO kódu jazyka
    return substr($string, 0, -3);  
}

function getLangShortcodeI($string){ // Získání ISO kódu jazyka
    return substr($string, 3);  
}

function getNoticeCode($notice, $type){ //$type 0: Číslo notice, 1: Obsah notice
    $values = explode(':', $notice);
    if($type == 0){
        return preg_replace('/\s+/', '', $values[0]);
    }elseif($type == 1){
        return substr($values[1], 1);
    }  
}


function delDia($string){ //Odstranění diakritiky
return iconv('UTF-8', 'ASCII//TRANSLIT', $string);
}

$path = 'input.tsv';
$fh = utf8_fopen_read($path);

switch ($action){
    case 1: //Sestaveni redirect pravidel
        /*
        <rule name="Home CS">
            <match url="^cestovni-konverzace$" />
            <action type="Rewrite" url="/lang/cs/index.asp" />
        </rule>
        */

        /*
        <rule name="Language CS redirect" stopProcessing="true">
            <match url="^/?$" />
            <action type="Redirect" url="/cestovni-konverzace" />
               <conditions>
                  <add input="{HTTP_ACCEPT_LANGUAGE}" pattern="^cs" />
               </conditions>
        </rule>
        */

        $kontrolniSoucet = 0;
        $langRedirectCount = 0;

        echo 'Generovani Web.config' . PHP_EOL . '[';

        while ($line = fgets($fh)) {
            $lajna = preg_split("/[\t]/", $line);
            
            if(getNoticeCode($lajna[6], 0) == 'A1'){
                $langRedir[0] = '<rule name="Language ' . getLangShortcode($lajna[0]) . ' redirect" stopProcessing="true">' . PHP_EOL;
                $langRedir[1] = "\t" . '<match url="^/?$" />' . PHP_EOL;
                $langRedir[2] = "\t" . '<action type="Redirect" url="' . $lajna[2] . '" />' . PHP_EOL;
                $langRedir[3] = "\t" . '<conditions>' . PHP_EOL;
                $langRedir[4] = "\t\t" . '<add input="{HTTP_ACCEPT_LANGUAGE}" pattern="^' . getLangShortcode($lajna[0]) . '" />' . PHP_EOL;
                $langRedir[5] = "\t" . '</conditions>' . PHP_EOL;
                $langRedir[6] = '</rule>' . PHP_EOL;
                $output = implode('', $langRedir);
                file_put_contents('rules.txt', $output, FILE_APPEND | LOCK_EX);
                $langRedirectCount++;
            }
            
            $rule[0] = '<rule name="' . delDia(getNoticeCode($lajna[6], 1)) . ' ' . getLangShortcode($lajna[0]) .'">' . PHP_EOL;
            $rule[1] = "\t" . '<match url="^' . stripSlash($lajna[2]) . '$" />' . PHP_EOL;
            $rule[2] = "\t" . '<action type="Rewrite" url="/lang/' . lowerCase(getLangShortcode($lajna[0])) . '/' . $pages[getNoticeCode($lajna[6], 0)] . '" />' . PHP_EOL;
            $rule[3] = '</rule>' . PHP_EOL;

            $output = implode('', $rule);

            if(!is_dir('output/config/')){
                mkdir('output/config/', 0777, true);
            }

            if(file_put_contents('output/config/rules.txt', $output, FILE_APPEND | LOCK_EX)){
                $kontrolniSoucet++;
            }

            if($kontrolniSoucet % 5 == 0){
            echo '#';
            }

        }

        echo '] 100%' . PHP_EOL;
        echo 'Celkovy pocet: ' . $kontrolniSoucet . PHP_EOL;
        echo 'Pocet narodnich redirectu: ' . $langRedirectCount . PHP_EOL;
        break;

    case 2: //Sestaveni hlavicky
        $kontrolniSoucet = 0;

        echo 'Generovani hlavicek' . PHP_EOL . '[';

        while ($line = fgets($fh)) {
            $lajna = preg_split("/[\t]/", $line);

            $html[0] = '<!-- Title -->' . PHP_EOL . PHP_EOL;
            $html[1] = '<title>' . $lajna[3] . '</title>'. PHP_EOL . PHP_EOL;
            
            $meta[0] = '<!-- Meta tags -->' . PHP_EOL . PHP_EOL;
            $meta[1] = '<meta charset="utf-8">';
            $meta[2] = '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'. PHP_EOL;
            $meta[3] = '<meta name="description" content="' . $lajna[5] . '">'. PHP_EOL;
            $meta[4] = '<meta name="keywords" content="' . $lajna[4] . '">'. PHP_EOL;
            $meta[5] = '<meta name="author" content="Euvit, s.r.o.">'. PHP_EOL . PHP_EOL;
            
            $og[0] = '<!-- OpenGraph tags -->' . PHP_EOL . PHP_EOL;
            $og[1] = '<meta property="og:url" content="http://www.smart-phrase.com'. $lajna[2] .'" />'. PHP_EOL;
            $og[2] = '<meta property="og:type" content="website" />'. PHP_EOL;
            $og[3] = '<meta property="og:title" content="' . $lajna[3] . '" />'. PHP_EOL;
            $og[4] = '<meta property="og:description" content="' . $lajna[5] . '" />'. PHP_EOL;
            $og[5] = '<meta property="og:image" content="http://www.smart-phrase.com/images/og.jpg" />'. PHP_EOL . PHP_EOL;
            
            $twitter[0] = '<!-- Twitter tags -->' . PHP_EOL . PHP_EOL;
            $twitter[1] = '<meta name="twitter:card" content="summary" />'. PHP_EOL;
            $twitter[2] = '<meta name="twitter:description" content="' . $lajna[5] . '" />'. PHP_EOL;
            $twitter[3] = '<meta name="twitter:image" content="http://www.smart-phrase.com/images/og.jpg" />'. PHP_EOL;
            $twitter[4] = '<meta name="twitter:title" content="' . $lajna[3] . '" />'. PHP_EOL . PHP_EOL;
            
            $other[0] = '<!-- Other -->' . PHP_EOL . PHP_EOL;
            $other[1] = '<meta itemprop="name" content="' . $lajna[3] . '">'. PHP_EOL;
            $other[2] = '<meta itemprop="description" content="' . $lajna[5] . '" />'. PHP_EOL;
            $other[3] = '<meta itemprop="image" content="http://www.smart-phrase.com/images/og.jpg">'. PHP_EOL . PHP_EOL;

            $output = implode("", $html) . implode("", $meta) . implode("", $og) . implode("", $twitter) . implode("", $other);
            
            if(!is_dir('output/heads/' . lowerCase(getLangShortcode($lajna[0])) . '/')){
                mkdir('output/heads/' . lowerCase(getLangShortcode($lajna[0])) . '/', 0777, true);
            }

            if(file_put_contents('output/heads/' . lowerCase(getLangShortcode($lajna[0])) . '/' . removeExtension($pages[getNoticeCode($lajna[6], 0)]) . '.txt', $output)){
            $kontrolniSoucet++;
            }

            if($kontrolniSoucet % 5 == 0){
            echo '#';
            }
        }
        
        echo '] 100%' . PHP_EOL;
        echo 'Celkovy pocet: ' . $kontrolniSoucet . PHP_EOL;

        break;

    case 3: //Sestaveni lang dropboxu
        
        $kontrolniSoucet = 0;
        
        echo 'Generovani lang dropdownu DESKTOP' . PHP_EOL . '[';

        while ($line = fgets($fh)) {
            $lajna = preg_split("/[\t]/", $line);
            $noticeCode = getNoticeCode($lajna[6], 0);
            
            /*
            <!-- Start Contact Info -->
                            <div class="dropdown" id="language-switch">
                                <button class="btn btn-default btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                      <i class="flag-icon flag-icon-cz"></i> Česky
                                    </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            */

            $row[0] = '<div class="dropdown" id="language-switch">' . PHP_EOL;
            $row[1] = "\t" . '<button class="btn btn-default btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' . PHP_EOL;
            $row[2] = "\t\t" . '<i class="flag-icon flag-icon-'. lowerCase(getLangShortcodeI($lajna[0])) .'"></i> ' . $lajna[1] . PHP_EOL;
            $row[3] = "\t" . '</button>' . PHP_EOL;
            $row[4] = "\t" . '<ul class="dropdown-menu" aria-labelledby="drwnopdoMenu1">' . PHP_EOL;

            $input = file_get_contents('input.tsv');
            $radek = explode("\n", $input);
    
            foreach ($radek as &$value) {
                $value = preg_split("/[\t]/", $value);
            }


            for($i = 0; $i < count($radek); $i++){
                if(getNoticeCode($radek[$i][6], 0) === $noticeCode && $radek[$i][2] != $lajna[2]){
                    array_push($row, "\t\t" . '<li><a href="' . $radek[$i][2] . '"><i class="flag-icon flag-icon-' . lowerCase(getLangShortcodeI($radek[$i][0])) . '"></i> ' . $radek[$i][1] . '</a></li>' . PHP_EOL);
                }
            }

            array_push($row, "\t" . '</ul>' . PHP_EOL);
            array_push($row, '</div>');

            $output = implode('', $row);

            if(!is_dir('output/drop/desktop/' . lowerCase(getLangShortcode($lajna[0])) . '/')){
                mkdir('output/drop/desktop/' . lowerCase(getLangShortcode($lajna[0])) . '/', 0777, true);
            }

            if(file_put_contents('output/drop/desktop/' . lowerCase(getLangShortcode($lajna[0])) . '/' . removeExtension($pages[getNoticeCode($lajna[6], 0)]) . '.txt', $output)){
            $kontrolniSoucet++;
            }
          
            unset($output);
            unset($row);

            if($kontrolniSoucet % 5 == 0){
            echo '#';
            }
        }

        echo '] 100%' . PHP_EOL;
        echo 'Celkovy pocet: ' . $kontrolniSoucet . PHP_EOL; 
        
        break;

    case 4: //Sestaveni lang dropboxu mobil

        $kontrolniSoucet = 0;
        
        echo 'Generovani lang dropdownu MOBIL' . PHP_EOL . '[';

        while ($line = fgets($fh)) {
            $lajna = preg_split("/[\t]/", $line);
            $noticeCode = getNoticeCode($lajna[6], 0);
            
            /*
            <!-- Start Contact Info -->
                            <div class="dropdown" id="language-switch-mobile">
                            <button class="btn btn-default btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                  <i class="flag-icon flag-icon-cz"></i> Česky
                                </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="z-index: 1001;">
                       
                            </ul>
                        </div>

            */

            $row[0] = '<div class="dropdown" id="language-switch-mobile">' . PHP_EOL;
            $row[1] = "\t" . '<button class="btn btn-default btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">' . PHP_EOL;
            $row[2] = "\t\t" . '<i class="flag-icon flag-icon-'. lowerCase(getLangShortcodeI($lajna[0])) .'"></i> ' . $lajna[1] . PHP_EOL;
            $row[3] = "\t" . '</button>' . PHP_EOL;
            $row[4] = "\t" . '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="z-index: 1001;">' . PHP_EOL;

            $input = file_get_contents('input.tsv');
            $radek = explode("\n", $input);
    
            foreach ($radek as &$value) {
                $value = preg_split("/[\t]/", $value);
            }


            for($i = 0; $i < count($radek); $i++){
                if(getNoticeCode($radek[$i][6], 0) === $noticeCode && $radek[$i][2] != $lajna[2]){
                    array_push($row, "\t\t" . '<li><a href="' . $radek[$i][2] . '"><i class="flag-icon flag-icon-' . lowerCase(getLangShortcodeI($radek[$i][0])) . '"></i> ' . $radek[$i][1] . '</a></li>' . PHP_EOL);
                }
            }

            array_push($row, "\t" . '</ul>' . PHP_EOL);
            array_push($row, '</div>');

            $output = implode('', $row);

            if(!is_dir('output/drop/mobile/' . lowerCase(getLangShortcode($lajna[0])) . '/')){
                mkdir('output/drop/mobile/' . lowerCase(getLangShortcode($lajna[0])) . '/', 0777, true);
            }

            if(file_put_contents('output/drop/mobile/' . lowerCase(getLangShortcode($lajna[0])) . '/' . removeExtension($pages[getNoticeCode($lajna[6], 0)]) . '.txt', $output)){
            $kontrolniSoucet++;
            }
          
            unset($output);
            unset($row);

            if($kontrolniSoucet % 5 == 0){
            echo '#';
            }
        }

        echo '] 100%' . PHP_EOL;
        echo 'Celkovy pocet: ' . $kontrolniSoucet . PHP_EOL; 
        break;

    case 5: //Sestaveni breadcrumbs
        $kontrolniSoucet = 0;

        echo 'Generovani breadcrumbs' . PHP_EOL . '[';

        while ($line = fgets($fh)) {
            $lajna = preg_split("/[\t]/", $line);
        
            //Obecne
            /* 
            <div class="page-banner" style="padding:40px 0; background: url(../../images/travelers-phrasebook-banner.jpg) center #f9f9f9;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Vlastnosti aplikace</h1>
                            <p>Co aplikace obsahuje</p>
                        </div>
                        <div class="col-md-6">
                            <ul class="breadcrumbs">
                                <li><a href="/cestovni-konverzace">Úvod</a></li>
                                <li>Vlastnosti</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            */
            $input = file_get_contents('input.tsv');
            $radek = explode("\n", $input);
    
            foreach ($radek as &$value) {
                $value = preg_split("/[\t]/", $value);
            }

            $lang = $lajna[0];
            $hpURL = '';
            $hpTitle = '';
            $suppURL = '';
            $suppTitle = '';
            $prevURL = '';
            $prevTitle = '';

            for($i = 0; $i < count($radek); $i++){
                if($lang == $radek[$i][0] && getNoticeCode($radek[$i][6], 0) == 'A1'){
                    $hpURL = $radek[$i][2];
                    $hpTitle = $radek[$i][7];
                }
                if($lang == $radek[$i][0] && getNoticeCode($radek[$i][6], 0) == 'A3'){
                    $prevURL = $radek[$i][2];
                    $prevTitle = $radek[$i][7];
                }
                if($lang == $radek[$i][0] && getNoticeCode($radek[$i][6], 0) == 'A4'){
                    $suppURL = $radek[$i][2];
                    $suppTitle = $radek[$i][7];
                }
            }
            
            $row[0] = '<div class="page-banner" style="padding:40px 0; background: url(../../images/travelers-phrasebook-banner.jpg) center #f9f9f9;">' . PHP_EOL;
            $row[1] = "\t" . '<div class="container">' . PHP_EOL;
            $row[2] = "\t\t" . '<div class="row">' . PHP_EOL;
            $row[3] = "\t\t\t" . '<div class="col-md-4">' . PHP_EOL;
            $row[4] = "\t\t\t\t" . '<h1>' . $lajna[3] . '</h1>' . PHP_EOL;
            $row[5] = "\t\t\t\t" . '<p></p>' . PHP_EOL;
            $row[6] = "\t\t\t" . '</div>' . PHP_EOL;
            $row[7] = "\t\t\t" . '<div class="col-md-8">' . PHP_EOL;
            $row[8] = "\t\t\t\t\t" . '<ul class="breadcrumbs">' . PHP_EOL;
            $row[9] = "\t\t\t\t\t\t" . '<li><a href="' . $hpURL . '">' . $hpTitle . '</a></li>' . PHP_EOL;
            
            if(getNoticeCode($lajna[6], 0) == 'A31' || getNoticeCode($lajna[6], 0) == 'A32' || getNoticeCode($lajna[6], 0) == 'A33'){
                $row[10] = "\t\t\t\t\t\t" . '<li><a href="' . $prevURL . '">' . $prevTitle . '</a></li>' . PHP_EOL;
            } elseif(getNoticeCode($lajna[6], 0) == 'A41' || getNoticeCode($lajna[6], 0) == 'A42' || getNoticeCode($lajna[6], 0) == 'A43') {
                $row[10] = "\t\t\t\t\t\t" . '<li><a href="' . $suppURL . '">' . $suppTitle . '</a></li>' . PHP_EOL;
            }

            if($lajna[7] == 'x'){
                array_push($row, "\t\t\t\t\t\t" . '<li>' . $lajna[6] . '</li>' . PHP_EOL);
            }elseif($lajna[7] != 'x'){
                array_push($row, "\t\t\t\t\t\t" . '<li>' . $lajna[3] . '</li>' . PHP_EOL);
            }
            
            array_push($row, "\t\t\t\t\t" . '</ul>' . PHP_EOL);
            array_push($row, "\t\t\t" . '</div>' . PHP_EOL);
            array_push($row, "\t\t" . '</div>' . PHP_EOL);
            array_push($row, "\t" . '</div>' . PHP_EOL);
            array_push($row, '</div>');

            $output = implode('', $row);

            if(!is_dir('output/breadcrumbs/' . lowerCase(getLangShortcode($lajna[0])) . '/')){
                mkdir('output/breadcrumbs/' . lowerCase(getLangShortcode($lajna[0])) . '/', 0777, true);
            }

            if(file_put_contents('output/breadcrumbs/' . lowerCase(getLangShortcode($lajna[0])) . '/' . removeExtension($pages[getNoticeCode($lajna[6], 0)]) . '.txt', $output)){
            $kontrolniSoucet++;
            }

            unset($row);
            unset($output);

            if($kontrolniSoucet % 5 == 0){
            echo '#';
            }

        }

        echo '] 100%' . PHP_EOL;
        echo 'Celkovy pocet: ' . $kontrolniSoucet . PHP_EOL; 

        break;

}
?>