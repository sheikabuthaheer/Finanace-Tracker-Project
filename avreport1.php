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
if(!isset($_POST['sub1'])) {
    $result = mysqli_query($link, "select distinct(substr(dt,1,7)) from expenses order by dt");
?>
<form name="f" action="avreport1.php" method="post">
    <table class="center_tab">
	<thead>
	    <tr>
                <th colspan="2" class="center">VIEW BUDGET VARIANCE</th>
	    </tr>
	</thead>
	<tbody>            
	    <tr>
		<th>Select Month</th>
		<td>
                    <select name="mth" required>
                        <?php
                        while($row = mysqli_fetch_row($result)) {
                            echo "<option value='$row[0]'>$row[0]</option>";
                        }
                        mysqli_free_result($result);
                        ?>
                    </select>
                </td>
	    </tr>
	</tbody>
	<tfoot>
	    <tr>
		<td colspan="2" class="center">
		    <input type="submit" name="sub1" value="Submit">
		</td>
	    </tr>
	</tfoot>
    </table>
</form>
<?php
} else {
    extract($_POST);

$result = mysqli_query($link, "select e.expname,budget,sum(e.amt) as countt from expenses e,expname n where e.expname=n.ename and e.dt like '$mth%' group by e.expname");
if(mysqli_num_rows($result)) {
?>
<script type="text/javascript">
 google.load("visualization", "1", {packages:["corechart"]});
 google.setOnLoadCallback(drawChart);
 function drawChart() {
 var data = google.visualization.arrayToDataTable([
 ['Expense','Budget','Actual'],
 <?php 
	while($row = mysqli_fetch_array($result)){
	echo "['".$row['expname']."',".$row['budget'].",".$row['countt']."],";
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
var chart = new google.visualization.ColumnChart(document.getElementById("columnchart12"));
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
}
include './footer.php';
?>
