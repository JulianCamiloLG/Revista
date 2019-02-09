<?php
/**
 * Created by PhpStorm.
 * User: Camilo
 * Date: 02/12/2016
 * Time: 9:10 PM
 */
$fichero=$_REQUEST["ruta"];
if (file_exists($fichero)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($fichero).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fichero));
    readfile($fichero);
    exit;
}