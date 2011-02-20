<?php

class Metar {
	
	private $oaci;
	private $report;
	
	public function Metar() {
		
	}
	
	static function getActualMetar() {
		// obtengo la informacion de la base de datos
		$metar = new Metar();
		$db_Metar = DB_DataObject::factory("metar");
		
		$metar->oaci = $db_Metar->me_oaci;
		$metar->report = $db_Metar->me_report;
		
		return $metar;	
	}	
}

$fp = fopen("http://weather.noaa.gov/pub/data/observations/metar/cycles/01Z.TXT", "r");

$linea = fgets($fp, 4096);

// nota: a las 11 de la noche, tengo que buscar el de la 1 de la maniana

$time1 = time();
$i=  1;
while ( $linea ){
	//echo $linea . "<br><br>";
	
	
	// if( $i % 3 == 0 ) echo "esta es la linea: " . $linea . " - i = $i  <br>";
	if( $i % 3 == 2 ) {
		
		$response = explode(" ", $linea);
		$code = $response[0];
		if ( $code == "SADF") {
			echo "<pre>" ; print_r ($response) ; echo "</pre>";
			
			$xml = new XMLReader("http://api.wunderground.com/auto/wui/geo/WXCurrentObXML/index.xml?query=$code");
			$xml->moveToAttributeNo(0);
			echo "property: " . $xml->getAttributeNo(0);
			
			break;
		}
		
	}
	
	
	$linea = fgets($fp, 4096);
	$i++;
}

$time2 = time();

fclose($fp);

?>