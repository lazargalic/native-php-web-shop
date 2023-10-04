<?php

include "../../assets/config/connection.php";
include "../global/functions.php";

//export excel 

session_start();

header("Content-Type: application/x-msexcel");
header("Content-Disposition: attachment; filename=brands.xls");
    /**/ 

include "functions.php";
$brands = DohvatiSveBrendove();
$export_string = "Id\t Name\n";
foreach($brands as $brand) {
    $export_string .= $brand->id_brand . "\t" . $brand->name_brand
    ."\n";
}
echo $export_string;



/*
    header('Content-Type: application/vnd.ms-excel');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header("Pragma: no-cache");
 */ 