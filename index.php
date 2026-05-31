<?php
$endMonth = date('Y-m');
$startMonth = date('Y-m',strtotime('-11 months'));
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="assets/css/style.css">
		<script src="assets/js/chart.js"></script>
	</head>

	<body>
	<h1>BurauenBiblio Analytics</h1>

		<form id="dashboardFilters">
			<label>Start </label>
			<input	type="month" 	id="start_month"	value="<?= $startMonth ?>">
			<label>End </label>
			<input	type="month"	id="end_month"	value="<?= $endMonth ?>"><button type="submit"> Update Dashboard</button>
			<label><input	type="checkbox"	id="students_only"	value="1"	> Students Only</label>
		</form>

		<div class="grid">
			<div class="card">
				<canvas id="collectionChart"></canvas>
			</div>
			<div class="card">
				<canvas id="circulationChart"></canvas>
			</div>

			<div class="card card-wide">
				<canvas id="attendanceChart"></canvas>
			</div>

			<div class="card card-wide" >
				<canvas id="ddcChart"></canvas>
			</div>
			<div id="ddcLegend" class="legend-section"></div>
		</div>
		
		<script src="assets/js/dashboard.js"></script>
		
	</body>
</html>