<?
/* lottorobics.php

This script reads XML data containing lottery drawing results into
$logdata, a two-dimensional array that can be displayed on a web
page. It's an example of how the xml-simple.php script can be used
to parse XML.

Version 1.0
Web: http://www.cadenhead.org/workbench/xml-simple

Sample XML data:

<?xml version="1.0" encoding="UTF-8"?>
<log>
  <result>
    <plays>502543</plays>
    <win3>7696</win3>
    <win4>410</win4>
    <win5>6</win5>
    <win6>0</win6>
    <date>Wed Sep 21 02:40:00 EDT 2005</date>
  </result>
</log>

The $logdata[][] array contains two dimensions:

1. An index number, which holds one set of results (the <result> element)
2. Each element of the result, named 'plays', 'wins3', and so on.

Copyright (C) 2005 Rogers Cadenhead

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.

*/

require_once('xml-simple.php');

// read the XML data recursively, storing results in $logdata[][]
function parse_array($element) {
    global $logdata, $logindex;
    foreach ($element as $header => $value) {
    	echo "<pre>";
    	//print_r($header);
    	print_r($value["content"]);
    	echo "</pre>";
    	break;
        if (is_array($value)) {
            parse_array($value);
            $logindex++;
        } else {
            $logdata[$logindex][$header] = $value;
        }
    }
}

// load the lotto XML data into a string
$data = file_get_contents("http://api.wunderground.com/auto/wui/geo/WXCurrentObXML/index.xml?query=KSFO");
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
parse_array($parser->tree);
/* calculate the years and format array data for display, adding 
   historic results from before this PHP script was written */
$logdata[0]['years'] = number_format($logdata[0]['plays'] / 104);
$logdata[0]['plays'] = number_format($logdata[0]['plays'] + 4962762);
$logdata[0]['win3'] = number_format($logdata[0]['win3'] + 76433);
$logdata[0]['win4'] = number_format($logdata[0]['win4'] + 4038);
$logdata[0]['win5'] = number_format($logdata[0]['win5'] + 99);
$logdata[0]['win6'] = number_format($logdata[0]['win6'] + 1);
/* display the page -- all PHP-created content is contained within
Begin Dynamic Content and End Dynamic Content HTML comment tags */

?>
