<?php
include './adminheader.php';
?>
<div class="center">
    <a href="budget.php">BUDGET REPORT</a> | 
    <a href="margin.php">MARGIN REPORT</a>
</div>
<?php
if(isset($_GET['eid'])) {
    $eid = $_GET['eid'];
    mysqli_query($link, "delete from expenses where id='$eid'");
}
if(!isset($_POST['sub1'])) {
    $result = mysqli_query($link, "select distinct(substr(dt,1,7)) from expenses order by dt");
?>
<form name="f" action="budget.php" method="post">
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
    echo "<div class='center'><a href='budget.php'>Back</a></div>";
$result = mysqli_query($link, "select expname,sum(amt),budget from expenses e,expname n where e.expname=n.ename and e.userid='$_SESSION[userid]' and e.dt like '$mth%' group by e.expname");
    echo "<table class='report_tab'><thead><tr><th colspan='4'>BUDGET VARIANCE LIST FOR ($mth)<tr>";
    echo "<tr><th>Expense Name<th>Actuals<th>Budget<th>Variance<tbody>";
    $tot=0;
    $tot1=0;
    while($row = mysqli_fetch_row($result)) {
	echo "<tr>";	
	echo "<td>$row[0]<td>$row[1]<td>$row[2]<td class='center'>";
        $tot+=$row[1];
        $tot1+=$row[2];
	if($row[1]>$row[2]) {
            echo "<img src='images/reddot.png' style='width:20px;'>";
        } else {
            echo "<img src='images/greendot.png' style='width:20px;'>";
        }
    }
    echo "<tr><td>Total Amount<td>$tot<td>$tot1<td>";
    echo "</tbody></table>";
mysqli_free_result($result);
}
include './footer.php';
?>