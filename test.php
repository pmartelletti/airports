<?php

require_once 'classes/DbConfig.class.php';
require_once 'DB/DataObject.php';
require_once 'classes/xml-simple.php';

DbConfig::setup();

/*
$aeroports = DB_DataObject::factory("aeroports");
$aeroports->whereAdd("ae_full_name IS NULL");
$aeroports->find();

while( $aeroports->fetch() ){
	
	$key = $aeroports->ae_key;

	// load the lotto XML data into a string
	$data = file_get_contents("http://api.wunderground.com/auto/wui/geo/WXCurrentObXML/index.xml?query=$key");
	// create a parser and load the XML data into a tree
	$parser =& new xml_simple('UTF-8');
	$request = $parser->parse($data);
	// catch errors
	$error_code = 0;
	if (!$request) {
	    $error_code = 1;
	    echo($parser->error);
	    exit; 
	}
	// load the XML tree data into the $logdata[][] array
	$logdata = array();
	$logindex = 0;
	// parse_array($parser->tree);
	// echo "<pre>";
	$content = $parser->tree[0]["content"];
	$display_location = $content["display_location"];
	$observation_location = $content["observation_location"];
	//print_r($content);
	
	$aero = DB_DataObject::factory("aeroports");
	$aero->ae_key = $key;
	$aero->find(true);
	// seteo las opciones del aeropuerto
	$aero->ae_full_name = $display_location['full'];
	$aero->ae_name = $display_location['city'];
	$aero->ae_state = $display_location['state_name'];
	$aero->ae_country = $display_location['country'];
	$aero->ae_latitude = $observation_location['latitude'];
	$aero->ae_longitude = $observation_location['longitude'];
	
	$aero->update();
	
}

*/
// echo "</pre>";


/*
 * 
 * ACA OBTENGO TODOS LOS CODIGOS DE LOS AEROPUERTOS DEL MUNDO
 * 
$fp = fopen("http://weather.noaa.gov/pub/data/observations/metar/cycles/01Z.TXT", "r");

$linea = fgets($fp, 4096);

// nota: a las 11 de la noche, tengo que buscar el de la 1 de la maniana

$i=  1;
while ( $linea ){
	if( $i % 3 == 2 ) {
		
		$response = explode(" ", $linea);
		$code = $response[0];
		
		// DB_DataObject::debugLevel(5);
		
		$aero = DB_DataObject::factory("aeroports");
		$aero->ae_key = $code;
		$aero->insert();
		
		
	}
	
	
	$linea = fgets($fp, 4096);
	$i++;
}



fclose($fp);

*/

// archivo del TAF
$fp = fopen("http://weather.noaa.gov/pub/data/observations/metar/cycles/01Z.TXT", "r");

$linea = fgets($fp, 4096);

// nota: a las 11 de la noche, tengo que buscar el de la 1 de la maniana


// CONDICIONES PARA LEER
// cada TAF es un espacio en blanco
// dentro del espacio en blanco, el informe del TAF es el siguiente:
// SI ES AMMENDENT NO TENER EN CUENTA EL TAF (TERCER PARAMETRO DE LA PRIMERA LINEA)
// SEGUNDA PALABRA DE LA SEGUNDA LINEA, ES EL CODIGO DEL AEROPUERTO
// DE AHI SACO EL CODIGO DEL TAF

while ( $linea ){
	if( $i % 3 == 2 ) {
		
		$response = explode(" ", $linea);
		$code = $response[0];
		
		// DB_DataObject::debugLevel(5);
		
		$aero = DB_DataObject::factory("aeroports");
		$aero->ae_key = $code;
		$aero->insert();
		
		
	}
	
	
	$linea = fgets($fp, 4096);
	$i++;
}



fclose($fp);

?>