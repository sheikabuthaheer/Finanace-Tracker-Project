<?php
include './adminheader.php';
?>
<div class="center">
    <a href="tran1.php">PURCHASE BILL</a> | 
    <a href="tran2.php">SALES BILL</a>
</div>
<?php
if(isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    mysqli_query($link, "delete from purchase where id='$pid'");
}
$result = mysqli_query($link, "select * from purchase order by dt");
    echo "<table class='report_tab'><thead><tr><th colspan='7'>PURCHASE TRANSACTIONS<tr>";
    echo "<tr><th>Supplier Name<th>Product Name<th>Date<th>Qty<th>Rate<th>Amount<th width='150px' class='center'>Task<tbody>";
    while($row=mysqli_fetch_row($result)) {
	echo "<tr>";	
	    echo "<td>$row[1]<td>$row[2]<td>$row[3]<td>$row[4]<td>$row[5]<td>$row[6]";
            echo "<td class='center'><a href='uvpurchase.php?pid=$row[0]' onclick=\"javascript:return confirm('Are you sure to Delete ?')\">Delete</a>";
    }
    echo "</tbody></table>";
mysqli_free_result($result);
include './footer.php';
?>