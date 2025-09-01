<?php
include './header.php';
if(!isset($_POST['sub1'])) {
?>
<form name="f" action="login.php" method="post">
    <table class="center_tab">
	<thead>
	    <tr>
                <th colspan="2" class="center">LOGIN</th>
	    </tr>
	</thead>
	<tbody>
	    <tr>
		<th>UserId</th>
		<td><input type="text" name="userid" required autofocus></td>
	    </tr>
	    <tr>
		<th>Password</th>
		<td><input type="password" name="pwd" required></td>
	    </tr>
	</tbody>
	<tfoot>
	    <tr>
		<td colspan="2" class="center">
		    <input type="submit" name="sub1" value="Login">
		</td>
	    </tr>
	</tfoot>
    </table>
</form>
<?php
} else {
    extract($_POST);
        $result = mysqli_query($link, "select * from admin where userid='$userid' and 
pwd='$pwd'") or die(mysqli_error($link));
        if(mysqli_num_rows($result)>0) {
            $_SESSION['adminuserid'] = $userid;
            $_SESSION['userid']="ram@gmail.com";
            header("Location:userhome.php");
        } else {
            echo "<div class='center'>Invalid Userid/Password...!<br><a href='login.php'>Back</a></div>";
        }
        mysqli_free_result($result);
}
include './footer.php';
?>