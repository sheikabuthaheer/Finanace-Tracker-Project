<?php
include './adminheader.php';
if(!isset($_POST['sub1'])) {
?>
<div class="right">
    <a href="avproducts.php">View Products</a>
</div>
<form name="f" action="adminhome.php" method="post">
    <table class="center_tab">
	<thead>
	    <tr>
                <th colspan="2" class="center">NEW PRODUCT</th>
	    </tr>
	</thead>
	<tbody>
            <tr>
		<th>Product Category</th>
		<td><input type="text" name="cname" required autofocus></td>
	    </tr>
	    <tr>
		<th>Product Name</th>
		<td><input type="text" name="pname" required></td>
	    </tr>
	    <tr>
		<th>Units</th>
                <td><input type="text" name="units" required placeholder="nos,kg"></td>
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
        $b = mysqli_query($link, "insert into products(cname,pname,units) values('$cname','$pname','$units')") or die(mysqli_error($link));
        if($b)
        echo "<div class='center'>Product Record Stored...!<br><a href='adminhome.php'>Back</a></div>";
        else
        echo "<div class='center'>".mysqli_error($link)."...!<br><a href='adminhome.php'>Back</a></div>";
}
include './footer.php';
?>