<?php
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="'.$filename.'"');
readfile('data/instructor/cv/'.$filename);
?>