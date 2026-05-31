<?php
	/* This file is part of a copyrighted work; it is distributed with NO WARRANTY. --F.Tumulak
	 */
	 
require_once __DIR__.'/../autoload.php';

use DDC\DDCAnalytics;

header(
'Content-Type: application/json'
);

$db =
new DDCAnalytics();

$result =
$db->getTopDDC();

$labels=[];
$totals=[];
$classifications=[];

foreach(
$result as $row
){

$labels[]=
$row['ddc'];

$totals[]=
(int)$row['total'];

$classifications[]=
$row['classification'];

}

echo json_encode([

'labels'=>$labels,

'totals'=>$totals,

'classifications'=>$classifications

]);