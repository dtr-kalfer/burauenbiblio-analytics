/* This file is part of a copyrighted work; 
it is distributed with NO WARRANTY. --F.Tumulak
 */

let collectionChart;

function renderCollectionChart(data){
	const ctx=document.getElementById('collectionChart');

	if(collectionChart){
		collectionChart.destroy();
	}

	collectionChart=new Chart(ctx,{
		type:'line',
		options:{
			responsive:true,
			//maintainAspectRatio: false,
			plugins:{
				legend:{
				position:'top'
				},

				title:{
				display:true,
				text:	'Collection Growth'
				}
			}
		},		
		
		data:{
			labels:data.labels,
			datasets:[
				{
				label: 'Bibliographic Records',
				data: data.bibliographic,
				borderColor: '#3498db',	tension:0.3
				},

				{
				label: 'Copies',
				data: data.copies,
				borderColor: '#2ecc71', tension:0.3
				}
			]
		}
	});
}

loadDashboard();

document
.getElementById('dashboardFilters')
	.addEventListener('submit',
		function(e){
			e.preventDefault();
			loadDashboard();
		}
	);

function loadDashboard(){

	loadCollectionChart();
	loadCirculationChart();
	loadAttendanceChart();
	loadDDCChart();

}

function loadCollectionChart(){
	const start =	document.getElementById('start_month').value;
	const end =	document.getElementById('end_month').value;

	fetch(`api/collection_api.php?start_month=${start}&end_month=${end}`)
	.then(r=>r.json())
	.then(data=>{renderCollectionChart(data);});
}

let circulationChart;

function renderCirculationChart(data){
	const ctx =	document.getElementById('circulationChart');

	if(circulationChart){
		circulationChart.destroy();
	}

	circulationChart = new Chart(ctx,{
		type:'bar',
		data:data,
		options:{
			responsive:true,
			//maintainAspectRatio: false,
			plugins:{
				legend:{
				position:'top'
				},

				title:{
				display:true,
				text:	'Monthly Circulation'
				}
			}
		}
	});
}

function loadCirculationChart(){
	const start =	document.getElementById('start_month').value;
	const end =	document.getElementById('end_month').value;
	
	fetch(`api/circulation_api.php?start_month=${start}&end_month=${end}`)
	.then(r=>r.json())
	.then(data=>{	renderCirculationChart(data);});
}

function loadAttendanceChart(){
	const start =	document.getElementById('start_month').value;
	const end =	document.getElementById('end_month').value;
	const studentsOnly = document.getElementById('students_only').checked	? 1	: 0;
	
	fetch(`api/attendance_api.php?start_month=${start}&end_month=${end}&students_only=${studentsOnly}`)
	.then(r=>r.json())
	.then(data=>{renderAttendanceChart(data);})
	.catch(error=>{console.error('Attendance Error:',error);});
}

let attendanceChart;

function renderAttendanceChart(data){
	
	const ctx =	document.getElementById('attendanceChart');
	
	if(attendanceChart){
		attendanceChart.destroy();
	}
	
	attendanceChart =	new Chart(ctx,
		{
		type:'bar',
		data:data,
		options:{
			responsive:true,
			maintainAspectRatio: false,
			plugins:{
				legend:{
					position:'top'
					},

				title:{
					display:true,
					text:'Library Attendance'
					}
				},

			scales:{
				y:{
					beginAtZero:true,
					title:{
						display:true,
						text:	'Number of Attendees'
						}
					}
				}
			}
		}
	);
}

function loadDDCChart(){
	fetch('api/ddc_api.php')
	.then(r=>r.json())
	.then(data=>{renderDDCChart(data);})
	.catch(error=>{console.error('DDC Error:',error);});
}

let ddcChart;

function renderDDCChart(data){

	const ctx = document.getElementById('ddcChart');

	if(ddcChart){
		ddcChart.destroy();
	}

	const categoryColors={
	"General Works":"#4CAF50","Philosophy and Psychology":"#2196F3","Religion":"#9C27B0",
	"Social Sciences":"#FF9800","Language":"#E91E63","Science":"#00BCD4","Technology":"#8BC34A",
	"Arts and Recreation":"#FFC107","Literature":"#3F51B5","History and Geography":"#F44336",
	"Unclassified":"#9E9E9E"
	};

	const sorted = data.labels.map(
		(ddc,i)=>({ddc,
			total:data.totals[i],
			classification:data.classifications[i]
		})
	)
	.sort(
	(a,b)=>parseFloat(a.ddc)-parseFloat(b.ddc)
	);

	const sortedLabels = sorted.map(x=>x.ddc);
	const sortedTotals = sorted.map(x=>x.total);
	const sortedColors = sorted.map(x=>categoryColors[x.classification]	|| '#999999');

	ddcChart = new Chart(ctx,
		{
		type:'bar',
		data:{
			labels:sortedLabels,
			datasets:[{
				label:
				'Top 30 DDC',
				data:sortedTotals,
				backgroundColor:
				sortedColors
			}]
		},
		options:{
			responsive:true,
			maintainAspectRatio:false,
			indexAxis:'x',
			plugins:{
				legend:{
				display:false
				},
				title:{
					display:true,
					text:'Top 80 DDC'
				}
			}
		}
	});
	renderDDCLegend(categoryColors);
}

function renderDDCLegend(
	colors
	){
	const container = document.getElementById('ddcLegend');

	container.innerHTML='';

	for(const[name,color]of Object.entries(colors)){

		container.innerHTML +=
		`
		<div class="legend-item">
			<span class="legend-color-box" style="background:${color}"></span>
			${name}
		</div>
		`;
	}
}


