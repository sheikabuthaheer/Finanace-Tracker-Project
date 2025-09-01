<?php
include './adminheader.php';
if(isset($_GET['pid'])) {
    $oid = $_GET['pid'];
    mysqli_query($link, "delete from products where pname='$oid'");
}
$result = mysqli_query($link, "select * from products order by cname");
    echo "<table class='report_tab'><thead><tr><th colspan='4'>PRODUCT LIST<tr>";
    echo "<tr><th>Category<th>Product Name<th>Units<th>Task<tbody>";
    while($row=mysqli_fetch_row($result)) {
	echo "<tr>";	
	    echo "<td>$row[0]<td>$row[1]<td>$row[2]";
	echo "<td><a href='avproducts.php?pid=$row[1]' onclick=\"javascript:return confirm('Are You Sure to Delete Product ?')\">Delete</a>";
    }
    echo "</tbody></table>";
mysqli_free_result($result);
include './footer.php';
?>