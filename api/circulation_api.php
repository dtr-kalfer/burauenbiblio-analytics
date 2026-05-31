<?php
	/* This file is part of a copyrighted work; 
	it is distributed with NO WARRANTY. --F.Tumulak
	 */
	 
require_once __DIR__.'/../autoload.php';

use Circ_Analytics\Circ_Analytics;

header('Content-Type: application/json');

$start = $_GET['start_month'] ?? date('Y-m',strtotime('-11 months'));

$end = $_GET['end_month'] ?? date('Y-m');

$analytics = new Circ_Analytics();

if(!$analytics->isValidMonthFormat($start) || !$analytics->isValidMonthFormat($end)){
	http_response_code(400);
	echo json_encode(['error'=>'Invalid month format']);
	exit;
}

echo $analytics->getChartDataJSON($start,$end);