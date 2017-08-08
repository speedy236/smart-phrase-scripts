<?php
$out = 'out.txt';
file_put_contents($out, 'mrska pes', FILE_APPEND | LOCK_EX);
?>