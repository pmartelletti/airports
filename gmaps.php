<?php

require_once 'classes/GMaps.class.php';
require_once 'classes/DbConfig.class.php';
require_once 'DB/DataObject.php';

DbConfig::setup();

$action = $_POST['action'];
//$action = $_GET['action'];

switch ($action) {
	
	case "listCountries":
		echo listCountries();
		break;
		
	case "listStates":
		echo listStates();
		break;
		
	case "listAirports":
		echo listAeroports();
		break;
	
	case "generateMap":
		echo generateMapImage();
		break;
	default:
		break;
	
}

function listCountries() {
	/*
	$airplanes = DB_DataObject::factory("aeroports");
	$airplanes->groupBy("ae_country");
	$airplanes->orderBy("ae_country ASC");
	$airplanes->find();
	
	$countries = array();
	
	while( $airplanes->fetch() ) {
		$countries[] = $airplanes->ae_country;
	}
	*/
	$countries = array("AR", "US", "LI");
	
	return json_encode($countries);
	
}

function listStates() {
	
	/*
	$country = $_POST['ae_country'];
	$airplanes = DB_DataObject::factory("aeroports");
	$airplanes->whereAdd("ae_country = $country");
	$airplanes->groupBy("ae_state");
	$airplanes->orderBy("ae_state ASC");
	
	$states = array();
	
	while ( $airplanes->fetch() ) {
		$states[] = $airplanes->ae_state;
	}
	*/

	$states = array("CA", "FL", "MI", "MA", "NY", "WA");
	
	return json_encode($states);
}

function listAeroports() {
	/*
	$country = $_POST['ae_country'];
	$state = $_POST['ae_state'];
	
	$aeroports = DB_DataObject::factory("aeroports");
	$aeroports->ae_state = $state;
	$aeroports->ae_country = $country;
	$aeroports->find();
	
	$list = array();
	
	while( $aeroports->fetch() ) {
		$list[] = $aeroports->ae_name . $aeroports->ae_key;
	}
	*/
	$list = array( array("code"=> "KJFK", "name" => "Kennedy International (KJFK)"), array("code" => "KLAX", "name" => "Los Angeles International (KLAX)"));	

	return json_encode($list);
}

function generateMapImage() {
	// fetch the code IACI	

	$map = new GMaps();
	$map->setZoom("12");
	$map->setMarkers(array("33.9425222,-118.4071611"));
	$map->setMapType("roadmap");
	$map->setSize("640x480");
	
	echo "<img src='" . $map->generateUrl() . "'>";
}



?>