<?php
header('Content-Typpe: application/zip');
header('Content-length: 1000000');
header('Content-Disposition: attaxhment; filename="download.zop');

for ($i=0; $i < 10000; $i++) { 
    echo str_repeat(".",1000);
    usleep(50000);
}

?>
