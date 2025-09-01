<?php
include './adminheader.php';
$result = mysqli_query($link, "select s.pname,sum(s.amt) as sales,sum(p.amt) as purchase  from sales s,purchase p where s.pname=p.pname group by s.pname");
    echo "<table class='report_tab'><thead><tr><th colspan='5'>SALES MARGIN REPORT<tr>";
    echo "<tr><th>Product Name<th>Purchase Price<th>Selling Price<th>Margin<th><tbody>";
    $tot=0;
    $tot1=0;
    while($row = mysqli_fetch_row($result)) {
	echo "<tr>";	
	echo "<td>$row[0]<td>$row[1]<td>$row[2]<td>";
        if(($row[1]-$row[2])>0)
            echo "(+) ";
        else
            echo "(-) ";
        echo abs($row[1]-$row[2])."<td class='center'>";
        $tot+=$row[1];
        $tot1+=$row[2];
	if($row[1]<$row[2]) {
            echo "<img src='images/reddot.png' style='width:20px;'>";
        } else {
            echo "<img src='images/greendot.png' style='width:20px;'>";
        }
    }
    echo "<tr><td>Total Amount<td>$tot<td>$tot1<td>";
    if(($tot-$tot1)>0)
            echo "(+) ";
        else
            echo "(-) ";
    echo ($tot-$tot1)."<td class='center'>";
        if($tot<$tot1) {
            echo "<img src='images/reddot.png' style='width:20px;'>";
        } else {
            echo "<img src='images/greendot.png' style='width:20px;'>";
        }
    echo "</tbody></table>";
mysqli_free_result($result);
include './footer.php';
?>