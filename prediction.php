<?php
include './adminheader.php';
$res = mysqli_query($link, "select distinct(substr(dt,1,7)) from expenses where userid='$_SESSION[userid]' order by dt");
while($r = mysqli_fetch_row($res)) {
    $mth[]=$r[0];
}
$result = mysqli_query($link, "select distinct expname from expenses where userid='$_SESSION[userid]'");
    echo "<table class='report_tab'><thead><tr><th colspan='6'>EXPENSES PREDICTION LIST<tr>";
    echo "<tr><th>Expense Name";
    foreach($mth as $m) {
        echo "<th>$m";
    }
    echo "<th>Prediction<th><tbody>";    
    while($row = mysqli_fetch_row($result)) {
        $tot=0;
        $e=0;
        $flg=true;
	echo "<tr><td>$row[0]";
        foreach($mth as $m) {
        $res1 = mysqli_query($link, "select ifnull(sum(amt),0) from expenses where userid='$_SESSION[userid]' and substr(dt,1,7)='$m' and expname='$row[0]'");
        if(mysqli_num_rows($res1)>0) {
        $r1 = mysqli_fetch_row($res1);
        echo "<td>$r1[0]";
        $tot+=$r1[0];
        //$e = ($e==0)?$r1[0]:$e-$r1[0];
            if($flg) {
                $exp=$r1[0];                
                $flg=false;
            } else {
                $e = $exp-$r1[0];
                $exp=$r1[0];
            }
        } else {
            echo "<td>0";
        }
        mysqli_free_result($res1);
        }
        $a = ceil($tot/count($mth));
            if($e==0) {
                echo "<td>$r1[0]";
                $p=$r1[0];
            } else if($e<0) {
                echo "<td>".($a+abs($e));
                $p=$a+abs($e);
            } else if($r1[0]==0) {
                echo "<td>".($a);
                $p=$a;
            } else {
                echo "<td>".($a-$e);
                $p=$a-$e;
            }
            $im = (($r1[0]-$p)>0)?"down.png":"up.png";
            if(($r1[0]-$p)>0)
                $im="down.png";
            else if(($r1[0]-$p)<0)
                $im="up.png";
            else
                $im="nil.png";
            echo "<th class='center'><img src='images/$im' style='width:30px;'>";
    }
    echo "</tbody></table>";
mysqli_free_result($result);
include './footer.php';
?>