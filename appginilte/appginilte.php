<?php
@include("{$currDir}/hooks/links-home.php");
if (!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
if (!defined('datalist_db_encoding')) define('datalist_db_encoding', 'UTF-8');
#Redirect guest users to login page
$currentuser = getLoggedMemberID();
if ($currentuser == "guest") {
	redirect("index.php?signIn=1");
}

#Variables that will be handy
$info = getMemberInfo();
$username = $info['username'];
$email = $info['email'];
$group = $info['group'];
$groupID = $info['groupID'];
$custom1 = $info['custom']['0'];
$custom2 = $info['custom']['1'];
$custom3 = $info['custom']['2'];
$custom4 = $info['custom']['3'];

function homeLinkInfoBox_1($title, $count, $link, $icon = "far fa-envelope", $color = "info", $sizeclass = "col-md-3 col-sm-6 col-12", $icontype = "default", $appginiIcon)
{
	$show_icon = ($icontype == 'default') ? '<i> <img src="' . $appginiIcon . '"></i>' : '<i class="' . $icon . '"></i>';
	$html = '<div class="' . $sizeclass . '">
	<div class="info-box">
	  <span class="info-box-icon bg-' . $color . '">' . $show_icon . '</span>
	  <div class="info-box-content">
		<span class="info-box-text"><a href="' . $link . '" style="text-decoration:none;color:black"><b>' . $title . '</b></a></span>
		<span class="info-box-number">' . number_format($count) . '</span>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	</div>';
	return $html;
}
function homeLinkInfoBox_2($title, $count, $link, $icon = "far fa-envelope", $color = "info", $sizeclass = "col-md-3 col-sm-6 col-12", $icontype = "default", $appginiIcon)
{
	$show_icon = ($icontype == 'default') ? '<i> <img src="' . $appginiIcon . '"></i>' : '<i class="' . $icon . '"></i>';
	$html = '<div class="' . $sizeclass . '">
	<div class="info-box bg-' . $color . '">
	  <span class="info-box-icon">' . $show_icon . '</span>
	  <div class="info-box-content">
		<span class="info-box-text"><a href="' . $link . '" style="text-decoration:none;color:black"><b>' . $title . '</b></a></span>
		<span class="info-box-number">' . number_format($count) . '</span>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	</div>';
	return $html;
}
function homeLinkInfoBox_3($title, $count, $link, $icon = "far fa-envelope", $color = "info", $sizeclass = "col-md-3 col-sm-6 col-12", $icontype = "default", $appginiIcon)
{
	$show_icon = ($icontype == 'default') ? '<i> <img src="' . $appginiIcon . '"></i>' : '<i class="' . $icon . '"></i>';
	$html = '<div class="' . $sizeclass . '">
	<!-- small card -->
	<div class="small-box bg-' . $color . '">
	  <div class="inner">
		<h3>' . number_format($count) . '</h3>
		<p>' . $title . '</p>
	  </div>
	  <div class="icon">
	  ' . $show_icon . '
	  </div>
	  <a href="' . $link . '" class="small-box-footer">
		More info <i class="fas fa-arrow-circle-right"></i>
	  </a>
	</div>
  </div>';
	return $html;
}
function responsiveTable($title="Table title", $dataquery, $sizeclass = "col-12")
{
	$th = '';
	$colnames = [];
	$coldata = [];
	$tr = '';
	foreach ($dataquery as $key => $value) {
		# code...get all column names in our query
		$colnames = array_keys($value);
		$coldata[] = array_values($value);
	}
	foreach ($colnames as $name) {
		# code...create our table headers
		$th .= '<th>' . $name . '</th>';
	}
	foreach ($coldata as $key => $data) {
		# code...create our table rows
		$td = '';
		foreach ($data as $key => $value) {
			# code...combine data for our rows
			$td .= '<td>' . $value . '</td>';
		}
		$tr .= '<tr>' . $td . '</tr>';
	}
	$html = '
	<div class="' . $sizeclass . '">
	  <div class="card">
		<div class="card-header">
		  <h3 class="card-title">' . $title . '</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body table-responsive p-0">
		  <table class="table table-hover text-nowrap table-bordered">
			<thead>
			  <tr>
				' . $th . '
			  </tr>
			</thead>
			<tbody>
			' . $tr . '
			</tbody>
		  </table>
		</div>
		<!-- /.card-body -->
	  </div>
	  <!-- /.card -->
	</div>';

	return $html;
}

function donutChart($chartTitle="Title of the donut chart", $chartData, $color = "primary", $chartSize = "col-md-12")
{
	$labels = '';
	$datasets = '';
	$backgroundColor = '';
	foreach ($chartData as $key => $data) {
		# code...
		$backgroundColor .= '"#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) . '",';
		$labels .= "'" . $data['label'] . "',";
		$datasets .= '' . $data['value'] . ',';
	}
	$chartID = uniqid();
	$html = '
	<div class="' . $chartSize . '">
	<div class="card card-' . $color . '">
		<div class="card-header">
			<h3 class="card-title">' . $chartTitle . '</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<canvas id="' . $chartID . '" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
		</div>
		<!-- /.card-body -->
	</div>
</div>
	';
	$js = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
		$(function() {
			var donutChartCanvas = $("#' . $chartID . '").get(0).getContext("2d");
			var donutData = {
	
				labels: [
					' . $labels . '
				],
				datasets: [{
					data: [' . $datasets . '],
					backgroundColor: [' . $backgroundColor . '],
				}]
			}
			var donutOptions = {
				maintainAspectRatio: false,
				responsive: true,
			}
			//Create douhnut chart
			new Chart(donutChartCanvas, {
				type: "doughnut",
				data: donutData,
				options: donutOptions
			})
		});
			</script>';
	return $html . $js;
}
function pieChart($chartTitle="Title of the pie chart", $chartData, $color = "primary", $chartSize = "col-md-12")
{
	$labels = '';
	$datasets = '';
	$backgroundColor = '';
	foreach ($chartData as $key => $data) {
		# code...
		$backgroundColor .= '"#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) . '",';
		$labels .= "'" . $data['label'] . "',";
		$datasets .= '' . $data['value'] . ',';
	}
	$chartID = uniqid();
	$html = '
	<div class="' . $chartSize . '">
	<div class="card card-' . $color . '">
		<div class="card-header">
			<h3 class="card-title">' . $chartTitle . '</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<canvas id="' . $chartID . '" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
		</div>
		<!-- /.card-body -->
	</div>
</div>
	';
	$js = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
		$(function() {
			var pieChartCanvas = $("#' . $chartID . '").get(0).getContext("2d");
			var pieData = {
	
				labels: [
					' . $labels . '
				],
				datasets: [{
					data: [' . $datasets . '],
					backgroundColor: [' . $backgroundColor . '],
				}]
			}
			var pieOptions = {
				maintainAspectRatio: false,
				responsive: true,
			}
			//Create pie chart
			new Chart(pieChartCanvas, {
				type: "pie",
				data: pieData,
				options: pieOptions
			})
		});
			</script>';
	return $html . $js;
}

function barChart($chartTitle="Title Of The Bar Chart",$chartData,$datasetLabel="Label Of data set",$color = "primary",$chartSize = "col-md-12")
{
	$labels = '';
	$datasets = '';
	$backgroundColor = '';
	foreach ($chartData as $key => $data) {
		# code...
		$backgroundColor .= '"#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) . '",';
		$labels .= "'" . $data['label'] . "',";
		$datasets .= '' . $data['value'] . ',';
	}
	$chartID = uniqid();
	$html = '
	<div class="' . $chartSize . '">
	<div class="card card-' . $color . '">
		<div class="card-header">
			<h3 class="card-title">' . $chartTitle . '</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse">
					<i class="fas fa-minus"></i>
				</button>
				<button type="button" class="btn btn-tool" data-card-widget="remove">
					<i class="fas fa-times"></i>
				</button>
			</div>
		</div>
		<div class="card-body">
			<canvas id="' . $chartID . '" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
		</div>
		<!-- /.card-body -->
	</div>
	</div>';
	$js = '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
		$(function() {
			// bar chart data
			var areaChartData = {
				labels: ['.$labels.'],
				datasets: [{
					label: "'.$datasetLabel.'",
					backgroundColor: ['.$backgroundColor.'],
					borderColor: "rgba(60,141,188,0.8)",
					pointRadius: false,
					pointColor: "#3b8bba",
					pointStrokeColor: "rgba(60,141,188,1)",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(60,141,188,1)",
					data: [ '.$datasets.']
				}, ]
			}
			//bar chart init
			var barChartCanvas = $("#'.$chartID.'").get(0).getContext("2d")
			var barChartData = $.extend(true, {}, areaChartData)
			var temp0 = areaChartData.datasets[0]
			barChartData.datasets[0] = temp0
	
			var barChartOptions = {
				responsive: true,
				maintainAspectRatio: false,
				datasetFill: false
			}
	
			new Chart(barChartCanvas, {
				type: "bar",
				data: barChartData,
				options: barChartOptions
			})
		})
	</script>';
	return $html . $js;

}
