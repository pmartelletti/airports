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
        if (is_array($value)) {
            parse_array($value);
            $logindex++;
        } else {
            $logdata[$logindex][$header] = $value;
        }
    }
}

// load the lotto XML data into a string
$data = file_get_contents("/var/www/www.cadenhead.org/html/projects/misc/java/lotto.log");
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
ECHO <<<END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Give Your Balls a Workout with Lottorobics</title>
</head>

<body link="#663399" vlink="#336666" text="#000000">
<!-- There is no header -->
<P><TABLE BORDER=0 BGCOLOR="#000000" WIDTH="100%">
   <TR>
      <TD ALIGN=center>
         <H2><FONT FACE="Garrison Light Sans" COLOR="#FFFFFF">are
         your lottery numbers not working out?</FONT></H2>
         
         <H2><FONT FACE="Garrison ExtraBold Sans" COLOR="#FFFFFF">maybe
         they need to </FONT><FONT FACE="Garrison ExtraBold Sans" COLOR="#00FF00">work
         out</FONT></H2>
      </TD>
   </TR>
</TABLE>

<div align="center">
<table border="0" cellpadding="5">
<tr valign="top">
<td width="60">
&nbsp;
</td>
<td>
<H2><FONT FACE="Arial"><B>Lottorobics: The Pick-6 Lotto Exercise
Plan</B></FONT></H2>

<P><A HREF="#Workout"><B>Skip right to the workout</B></A></P>

<P><a href="http://www.cadenhead.org/book/java24hours/"><IMG SRC="/book/java24hours/images/lilcover.gif" BORDER=0 ALIGN="Right" HSPACE="5" width="149" height="186"></a>If you're like me, your only real chance at financial prosperity
comes from frivolous workman's comp lawsuits and the Pick-6 Lotto.
However, even in my home state of Texas, the government eventually
figures out that once you've suffered permanently debilitating
injuries to both legs, both arms, neck and groin, there's no way you
can claim to injure them again on a new job.</P>

<P>Because
of this injustice, I've been forced to set aside some of my purely
religious use of peyote and put more money into the Lotto. After
years of little to no success (you can't get far on a single
3-out-of-6 $4 winner), I realized why my Lotto numbers never work
out.</P>

<P>The reason? I never tested them out.</P>

<P>How can you expect your Lotto numbers to come up a winner if you
haven't run them through some practice sessions? After meeting a Java
programmer at Lew Sterritt Correctional Center, I collaborated with
him on Lottorobics, the Pick-6 Lotto Exercise plan.</P>

<P>Enter your favorite six numbers below or click the Quick Pick
option to generate six numbers at random. Press <B>Play</B> to start
running Lotto drawings, <B>Stop</B> to stop them, and <B>Reset</B> to
reset your stats. Repeat as desired. -- <a href="http://www.cadenhead.org/workbench/">Rogers Cadenhead</a></P>
</td>
<td width="30">
&nbsp;
</td>
<td>
<script type="text/javascript">
<!--
google_ad_client = 'pub-8378161688790357';
google_ad_width = 120;
google_ad_height = 600;
google_ad_format = '120x600_as';
// -->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td>
</tr>
</table>
</div>
<CENTER><B><A NAME=Workout></A></B><TABLE BORDER=0 BGCOLOR="#000000" WIDTH=550 HEIGHT=30>
   <TR>
      <TD ALIGN=center>
         <P><FONT FACE="Garrison ExtraBold Sans" COLOR="#FFFFFF">L O
         T T O R O B I C S</FONT></P>
      </TD>
   </TR>
</TABLE>
<B><APPLET CODE="Lottorobics.class" CODEBASE="java/" ARCHIVE="xmlrpc-1.2-b1-applet.jar" WIDTH=550 HEIGHT=270 ALIGN=bottom>
</APPLET></B></CENTER>

<!-- Begin Dynamic Content -->
<P>Since this page went online, {$logdata[0]['plays']} drawings have been conducted with this applet ({$logdata[0]['years']} years of twice-weekly drawings). There have been {$logdata[0]['win3']} 3-out-of-6 winners, {$logdata[0]['win4']} 4-out-of-6 winners, {$logdata[0]['win5']} 5-out-of-6 winners, and {$logdata[0]['win6']} 6-out-of-6 winners.</P>
<!-- End Dynamic Content -->

<P>The first person to win this fictional lottery was Bill Teer on Aug. 14,
2000, more than four years after the applet went online. His numbers were 3, 7, 1, 15, 34,
and 43, and it only took him 241,225 drawings (2319.47 years) to win.</P>

<P>A version of the Lottorobics applet is featured in <a href="http://www.cadenhead.org/book/java24hours/">Teach Yourself Java 2 in 24
Hours, 3rd Edition</a> by Rogers Cadenhead. Readers learn how to program this
applet, animation, and dozens of other programs in 24 one-hour tutorials.</P>

<H3><CENTER><FONT FACE="Arial"><a href="http://www.cadenhead.org/book/java24hours/">Visit
the Book's Web Site</a> | <a href="java/Lottorobics.zip">Download the Source 
Code</a></FONT></CENTER></H3>

<P><TABLE BORDER=0 BGCOLOR="#000000" WIDTH="100%">
   <TR>
      <TD ALIGN=center>
         <H2><FONT FACE="Garrison Light Sans" COLOR="#FFFFFF">until
         next time, kids, remember:</FONT></H2>
         
         <H2><FONT FACE="Garrison Light Sans" COLOR="#FFFFFF">nobody
         ever says you have a </FONT><FONT FACE="Garrison Light Sans" COLOR="#AF0000">gambling
         problem</FONT></H2>
         
         <H2><FONT FACE="Garrison ExtraBold Sans" COLOR="#FFFFFF">when
         you're </FONT><FONT FACE="Garrison ExtraBold Sans" COLOR="#00AF00">winning</FONT></H2>
      </TD>
   </TR>
</TABLE>
<FONT SIZE="-1">"Still counting on a lottery win to set you up for
life? For a reality check, head over to the Lottorobics site, where
you can put your favorite numbers to the test. I tried a quick-pick
simulation and in 1,500 drawings, I hit three of six 22 times and
four of six once. Time to check out that 401(k)." -- </FONT><A HREF="http://www.sjmercury.com/minister/"><FONT SIZE="-1">John
Murrell</FONT></A><FONT SIZE="-1">, <I>San Jose Mercury News</I>,
June 11, 1997</FONT>
<p>
</body>
</html>
END;
?>
