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
    $dir = 'images/' . $getLang[$i]. '/';

    if(file_exists($dir . '10.png')){
        rename($dir . '10.png', $dir . 'travelers_phrasebook_languages_ipad.png');
    }

    if(file_exists($dir . '11.png')){
        rename($dir . '11.png', $dir . 'travelers_phrasebook_sentence_ipad.png');
    }

    if(file_exists($dir . '12.png')){
        rename($dir . '12.png', $dir . 'travelers_phrasebook_settings_ipad.png');
    } 



    if(file_exists($dir . '20.png')){
        rename($dir . '20.png', $dir . 'travelers_phrasebook_languages_android.png');
    }
    if(file_exists($dir . '21.png')){
        rename($dir . '21.png', $dir . 'travelers_phrasebook_topics_android.png');
    } 
    if(file_exists($dir . '22.png')){
        rename($dir . '22.png', $dir . 'travelers_phrasebook_sentences_android.png');
    } 
    if(file_exists($dir . '23.png')){
        rename($dir . '23.png', $dir . 'travelers_phrasebook_sentence_android.png');
    } 
    if(file_exists($dir . '24.png')){
        rename($dir . '24.png', $dir . 'travelers_phrasebook_settings_android.png');
    } 
    
    
    if(file_exists($dir . '40.png')){
        rename($dir . '40.png', $dir . 'travelers_phrasebook_languages_iphone.png');
    }
    if(file_exists($dir . '41.png')){
        rename($dir . '41.png', $dir . 'travelers_phrasebook_sentence_iphone.png');
    }  
    if(file_exists($dir . '42.png')){
        rename($dir . '42.png', $dir . 'travelers_phrasebook_settings_iphone.png');
    }

    if(file_exists($dir . '30.jpg')){
        rename($dir . '30.jpg', $dir . 'travelers_phrasebook_languages_windows.jpg');
    }
    if(file_exists($dir . '31.jpg')){
        rename($dir . '31.jpg', $dir . 'travelers_phrasebook_sentence_windows.jpg');
    } 
    if(file_exists($dir . '32.jpg')){
        rename($dir . '32.jpg', $dir . 'travelers_phrasebook_settings_windows.jpg');
    } 
    if(file_exists($dir . '33.jpg')){
        rename($dir . '33.jpg', $dir . 'travelers_phrasebook_settings1_windows.jpg');
    }     
}
?>