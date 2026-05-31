<?php
	/* This file is part of a copyrighted work; 
	it is distributed with NO WARRANTY. --F.Tumulak
	 */

require_once __DIR__.'/../autoload.php';

use LibraryCollection\CollectionAnalytics;

header('Content-Type: application/json');

$start = $_GET['start_month'] ?? date('Y-01');
$end = $_GET['end_month'] ?? date('Y-m');

function isValidMonth($month){
    return preg_match(
        '/^\d{4}-(0[1-9]|1[0-2])$/',
        $month
    );
}

if(!isValidMonth($start) || !isValidMonth($end)){
    http_response_code(400);
    echo json_encode(['error'=>'Invalid month format']);
    exit;
}

$start_date=$start.'-01';
$end_date = date('Y-m-t',strtotime($end.'-01'));
$db = new CollectionAnalytics;
$result = $db->getWeeklyGrowthWithCopies($start_date, $end_date);

$labels=[];
$bib_data=[];
$copy_data=[];

foreach($result as $row){
	$labels[] = 'W'.str_pad($row['week_no'],2,'0',STR_PAD_LEFT).' '.$row['month_short'].' '.$row['year_added'];
	$bib_data[] = (int)$row['bib_total'];
	$copy_data[] = (int)$row['copy_total'];
}

echo json_encode(['labels'=>$labels, 'bibliographic'=>$bib_data, 'copies'=>$copy_data]);
