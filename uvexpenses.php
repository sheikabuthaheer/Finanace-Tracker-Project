<?php
include './adminheader.php';
if(isset($_GET['eid'])) {
    $eid = $_GET['eid'];
    mysqli_query($link, "delete from expenses where id='$eid'");
}
if(!isset($_POST['sub1'])) {
    $result = mysqli_query($link, "select distinct(substr(dt,1,7)) from expenses order by dt");
?>
<form name="f" action="uvexpenses.php" method="post">
    <table class="center_tab">
	<thead>
	    <tr>
                <th colspan="2" class="center">VIEW EXPENSES</th>
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
    echo "<div class='center'><a href='uvexpenses.php'>Back</a></div>";
$result = mysqli_query($link, "select * from expenses where userid='$_SESSION[userid]' and dt like '$mth%'");
    echo "<table class='report_tab'><thead><tr><th colspan='4'>EXPENSES LIST FOR ($mth)<tr>";
    echo "<tr><th>Date<th>Expense Name<th>Amount<th>Task<tbody>";
    $tot=0;
    while($row = mysqli_fetch_row($result)) {
	echo "<tr>";	
	echo "<td>$row[2]<td>$row[3]<td>$row[4]";
        $tot+=$row[4];
	echo "<td><a href='uvexpenses.php?eid=$row[0]' onclick=\"javascript:return confirm('Are You Sure to Delete Expense ?')\">Delete</a>";
    }
    echo "<tr><td colspan='2'>Total Amount<td>$tot<td>";
    echo "</tbody></table>";
mysqli_free_result($result);
}
include './footer.php';
?>