<?php
include './adminheader.php';
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<h4 style="text-align:center;">EXPENSES REPORT</h4>
<div class="center">
    <a href="avreport.php">EXPENSE WISE REPORT</a> | 
    <a href="avreport1.php">BUDGET COMPARISION REPORT</a>
</div>
<?php
$result = mysqli_query($link, "select expname,sum(amt) as countt from expenses group by expname");
if(mysqli_num_rows($result)) {
?>
<script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([
 ['Expense','Expense Name'],
 <?php 
	while($row = mysqli_fetch_array($result)){
	echo "['".$row['expname']."',".$row['countt']."],";
	}
?> 
]);

var options = {
	title: 'Total Expenses',
	pieHole: 0.5,
	pieSliceTextStyle: {
	color: 'black',
	},
	legend: 'bottom'
};
var chart = new google.visualization.BarChart(document.getElementById("columnchart12"));
chart.draw(data,options);
}	
</script>
<?php
//while($row = mysqli_fetch_row($result))
//echo "<br>$row[0] - $row[1]";
} else {
echo "<center>No Expenses Record Found...!</center>";
}
mysqli_free_result($result);
?>
<div class="container-fluid">
<div id="columnchart12" style="width: 100%; height: 500px;"></div>
</div>
<?php
include './footer.php';
?>