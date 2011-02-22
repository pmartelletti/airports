<?php

require_once 'classes/GMaps.class.php';

$map = new GMaps();
$map->setZoom("12");
$map->setMarkers(array("40.63999939,-73.77999878"));
$map->setMapType("roadmap");
$map->setSize("640x480");

echo $map->generateUrl();

?>