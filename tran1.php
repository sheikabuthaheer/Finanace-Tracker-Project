<?php
include './adminheader.php';
?>
<div class="center">
    <a href="tran1.php">PURCHASE BILL</a> | 
    <a href="tran2.php">SALES BILL</a>
</div>
<?php
if(!isset($_POST['sub1'])) {
    $result = mysqli_query($link, "select pname from products");
?>
<div class="right">
    <a href="uvpurchase.php">View Purchase</a>
</div>
<form name="f" action="tran1.php" method="post" onsubmit="return chk()">
    <table class="center_tab">
	<thead>
	    <tr>
                <th colspan="2" class="center">PURCHASE</th>
	    </tr>
	</thead>
	<tbody>
            <tr>
		<th>Supplier Name</th>
                <td><input type="text" name="supplier" required autofocus></td>
	    </tr>
	    <tr>
		<th>Product Name</th>
		<td>
                    <select name="pname" required>
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
                <td><input type="date" name="dt" required value="<?php echo date('Y-m-d',time());?>"></td>
	    </tr>
            <tr>
		<th>Qty</th>
                <td><input type="text" name="qty" pattern="\d+" required></td>
	    </tr>
            <tr>
		<th>Rate</th>
                <td><input type="text" name="rate" pattern="\d+" required></td>
	    </tr>
	    <tr>
		<th>Bill Value</th>
                <td><input type="text" name="amt" required onfocus="call()" value="0"></td>
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
        $b = mysqli_query($link, "insert into purchase(supplier,pname,dt,qty,rate,amt) values('$supplier','$pname','$dt','$qty','$rate','$amt')") or die(mysqli_error($link));
        if($b)
        echo "<div class='center'>Purchase Record Stored...!<br><a href='tran1.php'>Back</a></div>";
        else
        echo "<div class='center'>".mysqli_error($link)."...!<br><a href='tran1.php'>Back</a></div>";
}
include './footer.php';
?>
<script>
    function chk() {
        if(f.amt.value==0) {
            alert("Invalid Bill Value...!")
            return false
        }
        return true
    }
    function call() {
        amt = parseInt(f.qty.value)*parseInt(f.rate.value)
        if(!isNaN(amt)) {
            f.amt.value=amt
        } else {
            f.amt.value=0
        }
    }
</script>