<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
<?php

function utf8_fopen_read($fileName) { 
    $fc = iconv('utf-8', 'utf-8', file_get_contents($fileName)); 
    $handle=fopen("php://memory", "rw"); 
    fwrite($handle, $fc); 
    fseek($handle, 0); 
    return $handle; 
} 



$path = $argv[1] . '.csv';
$out = $argv[1] . '.txt';

$fh = utf8_fopen_read($path);
$count = 0;
while ($line = fgets($fh)) {
$lajna = explode(',', $line);
  $langs = '';
  if($lajna[1] == 'x'){
    $langs = $langs . ' cz';
  }
  if($lajna[2] == 'x'){
      $langs = $langs . ' us';
  }
  if($lajna[3] == 'x'){
      $langs = $langs . ' de';
  }
  if($lajna[4] == 'x'){
      $langs = $langs . ' fr';
  }
  if($lajna[5] == 'x'){
      $langs = $langs . ' es';
  }
  if($lajna[6] == 'x'){
      $langs = $langs . ' it';
  }
  if($lajna[7] == 'x'){
      $langs = $langs . ' ru';
  }
  if($lajna[8] == 'x'){
      $langs = $langs . ' hr';
  }
  if($lajna[9] == 'x'){
      $langs = $langs . ' pl';
  }
  if($lajna[10] == 'x'){
      $langs = $langs . ' hu';
  }
  if($lajna[11] == 'x'){
      $langs = $langs . ' gr';
  }
  if($lajna[12] == 'x'){
      $langs = $langs . ' nl';
  }
  if($lajna[13] == 'x'){
      $langs = $langs . ' tr';
  }
  if($lajna[14] == 'x'){
      $langs = $langs . ' pt';
  }
  if($lajna[15] == 'x'){
      $langs = $langs . ' dk';
  }
  if($lajna[16] == 'x'){
      $langs = $langs . ' fi';
  }
  if($lajna[17] == 'x'){
      $langs = $langs . ' no';
  }
  if($lajna[18] == 'x'){
      $langs = $langs . ' se';
  }
  if($lajna[19] == 'x'){
      $langs = $langs . ' bg';
  }
  if($lajna[20] == 'x'){
      $langs = $langs . ' sa';
  }
  if($lajna[21] == 'x'){
      $langs = $langs . ' jp';
  }
  if($lajna[22] == 'x'){
      $langs = $langs . ' cn';
  }
  if($lajna[23] == 'x'){
      $langs = $langs . ' il';
  }

  $trimmed = ltrim($langs);

  /*
  <div class="row">
                    
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <div class="lang" style="padding: 10px; border: 1px solid #eee; -webkit-border-radius: 3px;">
                            <div class="flag text-center"><span style="font-size: 50pt;" class="flag-icon flag-icon-it"></span></div>
                            <div class="county text-center" style="padding: 10px;">Italie kokot jebat</div>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <div class="lang" style="padding: 10px; border: 1px solid #eee; -webkit-border-radius: 3px;">
                            <div class="flag text-center"><span style="font-size: 50pt;" class="flag-icon flag-icon-it"></span></div>
                            <div class="county text-center" style="padding: 10px;">Italie kokot jebat</div>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <div class="lang" style="padding: 10px; border: 1px solid #eee; -webkit-border-radius: 3px;">
                            <div class="flag text-center"><span style="font-size: 50pt;" class="flag-icon flag-icon-it"></span></div>
                            <div class="county text-center" style="padding: 10px;">Italie kokot jebat</div>
                        </div>
                    </div>
                    
                </div>

  */


    $row[0] = '<div class="' . $trimmed . ' flag pull-left text-center">' . PHP_EOL;
    $row[1] = "\t" . '<div style="font-size: 45pt;" class="flag-icon flag-icon-' . $lajna[25] . '"></div>' . PHP_EOL;
    $row[2] = "\t" . '<div>' . $lajna[0] . '</div>' . PHP_EOL;
    $row[3] = '</div>' . PHP_EOL;
     

$data = implode('', $row);
file_put_contents($out, $data, FILE_APPEND | LOCK_EX);
}
fclose($fh);
?>
<a href="index.html">Zpět a zadat další</a>
    </body>
</html>