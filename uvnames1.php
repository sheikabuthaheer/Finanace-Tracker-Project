<?php
include './adminheader.php';
if(!isset($_POST['sub1'])) {
?>
<form name="f" action="uvnames1.php" method="post">
    <table class="center_tab">
	<thead>
	    <tr>
                <th colspan="2" class="center">EDIT EXPENSES</th>
	    </tr>
	</thead>
	<tbody>            
	    <tr>
		<th>Expense Name</th>
                <td><input type="text" name="ename" value="<?php echo $_GET['ename'];?>" readonly required></td>
	    </tr>
	    <tr>
		<th>Budget</th>
                <td><input type="text" name="amt" pattern="\d+" value="<?php echo $_GET['bamt'];?>" required autofocus></td>
	    </tr>
	</tbody>
	<tfoot>
	    <tr>
		<td colspan="2" class="center">
		    <input type="submit" name="sub1" value="Update">
		</td>
	    </tr>
	</tfoot>
    </table>
</form>
<?php
} else {
    extract($_POST);
        $b = mysqli_query($link, "update expname set budget='$amt' where ename='$ename'") or die(mysqli_error($link));
        if($b)
        echo "<div class='center'>Budget Modified...!<br><a href='uvnames.php'>Back</a></div>";
        else
        echo "<div class='center'>".mysqli_error($link)."...!<br><a href='uvnames.php'>Back</a></div>";
}
include './footer.php';
?>