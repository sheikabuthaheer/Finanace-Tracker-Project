<?php
include './adminheader.php';
if(!isset($_POST['sub1'])) {
?>
<div class="right">
    <a href="uvnames.php">View Names</a>
</div>
<form name="f" action="expname.php" method="post">
    <table class="center_tab">
	<thead>
	    <tr>
                <th colspan="2" class="center">NEW EXPENSE NAME</th>
	    </tr>
	</thead>
	<tbody>            
	    <tr>
		<th>Expense Name</th>
                <td><input type="text" name="ename" required autofocus></td>
	    </tr>
            <tr>
		<th>Monthly Budget Amount</th>
                <td><input type="text" name="budget" required pattern="\d+" autofocus></td>
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
        $b = mysqli_query($link, "insert into expname(ename,budget) values('$ename','$budget')") or die(mysqli_error($link));
        if($b)
        echo "<div class='center'>Expense Name Stored...!<br><a href='expname.php'>Back</a></div>";
        else
        echo "<div class='center'>".mysqli_error($link)."...!<br><a href='expname.php'>Back</a></div>";
}
include './footer.php';
?>