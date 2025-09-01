<?php
include './adminheader.php';
if(isset($_GET['dename'])) {
    $dename = $_GET['dename'];
    mysqli_query($link, "delete from expname where ename='$dename'");
}
$result = mysqli_query($link, "select * from expname");
    echo "<table class='report_tab'><thead><tr><th colspan='3'>EXPENSES NAMES<tr>";
    echo "<tr><th>Expense Name<th>Budget<th width='150px' class='center'>Task<tbody>";
    while($row=mysqli_fetch_row($result)) {
	echo "<tr>";	
	    echo "<td>$row[0]<td>$row[1]";
            echo "<td class='center'><a href='uvnames1.php?ename=$row[0]&bamt=$row[1]'>Edit</a> | <a href='uvnames.php?dename=$row[0]' onclick=\"javascript:return confirm('Are you sure to Delete ?')\">Delete</a>";
    }
    echo "</tbody></table>";
mysqli_free_result($result);
include './footer.php';
?>