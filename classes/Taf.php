<?php
/**
 * Table Definition for taf
 */
require_once 'DB/DataObject.php';

class DataObjects_Taf extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'taf';                 // table name
    public $taf_id;                          // int(4)  primary_key not_null
    public $taf_ae_id;                       // int(4)   unsigned
    public $taf_report;                      // varchar(250)  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Taf',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
