<?php
    include "data.php";
    $dbimg = $row['profile_picture'];
    $image = "/var/www/html/curd_img/". $dbimg;
    $filename = basename($image);
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false); // required for certain browsers 
    header('Content-Disposition: attachment; filename="'. $filename . '";');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($image));
    readfile($image); 
?>