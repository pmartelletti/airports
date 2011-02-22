<?php
/**
 * Table Definition for metar
 */
require_once 'DB/DataObject.php';

class DataObjects_Metar extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'metar';               // table name
    public $me_id;                           // int(4)  primary_key not_null
    public $me_ae_id;                        // int(4)   unsigned
    public $me_report;                       // varchar(300)  
    public $me_fecha_actualizacion;          // timestamp   default_CURRENT_TIMESTAMP
    public $me_fecha_metar;                  // varchar(45)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Metar',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
