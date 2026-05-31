<?php
	/* This file is part of a copyrighted work; 
	it is distributed with NO WARRANTY. --F.Tumulak
	 */
	 
require_once __DIR__.'/../autoload.php';

use LibraryAttendance\Attendance;

header('Content-Type: application/json');

$start = $_GET['start_month'] ?? date('Y-m',strtotime('-11 months'));

$end = $_GET['end_month'] ?? date('Y-m');

$students_only = ($_GET['students_only'] ?? '0') == '1';

function isValidMonthFormat($month){
    return preg_match(
        '/^\d{4}-(0[1-9]|1[0-2])$/',
        $month
    );
}

if(!isValidMonthFormat($start) || !isValidMonthFormat($end)){

    http_response_code(400);
    echo json_encode([
        'error'=>'Invalid month format'
    ]);
    exit;
}

$start_date = $start.'-01';

$end_date = date('Y-m-t',strtotime($end.'-01'));

$db = new Attendance();

$result = $db->getRangeAttendance($start_date,$end_date,$students_only);
$months=[];

$current = strtotime($start_date);
$end_ts = strtotime($end_date);

while($current <= $end_ts){
    $months[] = date('Y-m',$current);
    $current = strtotime('+1 month', $current);
}

$courses = $db->getListCourses();

$facultyVisitor = ['Faculty','Visitor'];

$labels = $students_only ? $courses : array_merge($courses, $facultyVisitor);

$data_map=[];

foreach($labels as $label){
	$data_map[$label] = array_fill(0,count($months),0);
}

foreach($result as $row){
	$month = $row['month'];
	$index = array_search($month, $months);

	if($index !== false){
	$key = ($row['user_type'] === 'Student') ? $row['course'] : $row['user_type'];

		if(isset($data_map[$key])){
			$data_map[$key][$index]+=(int)$row['total'];
		}
	}
}

$datasets=[];

foreach($data_map as $label=>$values){
	$datasets[]=['label'=>$label,'data'=>$values,'backgroundColor'=>'#'.substr(md5($label),0,6)];
}

echo json_encode(['labels'=>array_map(function($m){return date('F',strtotime($m.'-01'));},
	$months),'datasets'=>$datasets]);
