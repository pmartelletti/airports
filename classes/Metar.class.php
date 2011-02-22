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



?>