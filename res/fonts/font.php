<?php

$font = $_GET['font'];
$type = $_GET['type'];

$fontarray = array("PoliticsHead-Bold", "Roboto-Bold-webfont", "Roboto-BoldItalic-webfont", "Roboto-Italic-webfont", "Roboto-Light-webfont", "Roboto-LightItalic-webfont", "Roboto-Medium-webfont", "Roboto-MediumItalic-webfont", "Roboto-Regular-webfont");

$typearray = array("eot", "svg", "ttf", "woff");

if (!in_array($font, $fontarray) || !in_array($type, $typearray)) exit;

header('Content-type: application/octet-stream');
header("Access-Control-Allow-Origin: *");
header('Content-Disposition: attachment; filename="'.$font.'.'.$type.'"');
$content = file_get_contents($font.".".$type);
echo $content;
?>
