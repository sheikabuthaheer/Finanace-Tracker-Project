<?php
include './adminheader.php';
if(!isset($_POST['sub1'])) {
    $result = mysqli_query($link, "select ename from expname");
?>
<div class="right">
    <a href="uvexpenses.php">View Expenses</a>
</div>
<form name="f" action="userhome.php" method="post">
    <table class="center_tab">
	<thead>
	    <tr>
                <th colspan="2" class="center">NEW EXPENSES</th>
	    </tr>
	</thead>
	<tbody>            
	    <tr>
		<th>Expense Name</th>
		<td>
                    <select name="expname" required>
                        <?php
                        while($row = mysqli_fetch_row($result)) {
                            echo "<option value='$row[0]'>$row[0]</option>";
                        }
                        mysqli_free_result($result);
                        ?>
                    </select>
                </td>
	    </tr>
            <tr>
		<th>Date</th>
		<td><input type="date" name="dt" required></td>
	    </tr>
	    <tr>
		<th>Amount</th>
                <td><input type="text" name="amt" required></td>
	    </tr>
	</tbody>
	<tfoot>
	    <tr>
		<td colspan="2" class="center">
		    <input type="submit" name="sub1" value="Create">
		</td>
	    </tr>
	</tfoot>
    </table>
</form>
<?php
} else {
    extract($_POST);
        $b = mysqli_query($link, "insert into expenses(userid,dt,expname,amt) values('$_SESSION[userid]','$dt','$expname','$amt')") or die(mysqli_error($link));
        if($b)
        echo "<div class='center'>Expense Record Stored...!<br><a href='userhome.php'>Back</a></div>";
        else
        echo "<div class='center'>".mysqli_error($link)."...!<br><a href='userhome.php'>Back</a></div>";
}
include './footer.php';
?>