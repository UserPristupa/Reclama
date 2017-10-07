Отчёты
<div>
<button id="report_day">За день</button>
<button id="report_week">За неделю</button>
</div>
<div id="report_chart" style="width: 500px; height: 400px;"></div>
<script src="https://www.google.com/jsapi"></script>
<script>

   function drawChart(timeframe) {
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET","App/controllers/controllerReports.php?timeframe="+timeframe,false);
	xmlHttp.overrideMimeType("text/plain; charset=utf8");
	xmlHttp.send();
	var result=xmlHttp.responseText.split(',');
	result[1]=parseFloat(result[1]);
	result[2]=parseFloat(result[2]);
	var data=new google.visualization.DataTable();
	data.addColumn('string','Дата');
	data.addColumn('number','Чистая прибыль');
	data.addColumn('number','Доход');
	data.addRow(result);
	var options = {
     title: 'Финансы',
     hAxis: {title: 'День'},
     vAxis: {title: 'грн'}
    };
	var chart = new google.visualization.ColumnChart(document.getElementById('report_chart'));
    chart.draw(data, options);
   };

function initialize(){
	document.getElementById("report_day").onclick=function(){
		drawChart("day");
	};
	document.getElementById("report_week").onclick=function(){
		drawChart("week");
	};
}
google.setOnLoadCallback(initialize);
google.load("visualization", "1", {packages:["corechart"]});

</script>