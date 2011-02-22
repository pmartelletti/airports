<?php
/**
 * Table Definition for aeroports
 */
require_once 'DB/DataObject.php';

class DataObjects_Aeroports extends DB_DataObject 
{
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    public $__table = 'aeroports';           // table name
    public $ae_id;                           // int(4)  primary_key not_null unsigned
    public $ae_key;                          // varchar(4)  unique_key
    public $ae_full_name;                    // varchar(200)  
    public $ae_name;                         // varchar(150)  
    public $ae_state;                        // varchar(45)  
    public $ae_country;                      // varchar(45)  
    public $ae_latitude;                     // double  
    public $ae_longitude;                    // double  

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('DataObjects_Aeroports',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
}
