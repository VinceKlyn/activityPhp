<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
$result = $dbConn->query(" select oNo,
oQuantity,
pName,
pPrice,
uUsername,
cName,
(pPrice * oQuantity) as 'subtotal'
from orders o
inner JOIN products p on o.oPid = p.pId 
inner JOIN users u on u.uId = o.oUid
inner JOIN customer c on c.cId = o.oCid

");
?>

<html>
<head>	
	<title>Homepage</title>
</head>

<body>
<a href="add.html">Add New Data</a><br/><br/>

	<table width='80%' border=0>                       

	<tr bgcolor='#CCCCCC'>
		<td>Order Number</td>
		<td>Product</td>
		<td>Price</td>
		<td>UserName</td>
		<td>Customer</td>
		<td>Sub Total</td>
		<td>Update/Delete Order</td>
	</tr>
	<?php 	
	while($row = $result->fetch(PDO::FETCH_ASSOC)) { 		
		echo "<tr>";
		echo "<td>".$row['oNo']."</td>";
		echo "<td>".$row['pName']."</td>";
		echo "<td>".$row['pPrice']."</td>";	
		echo "<td>".$row['uUsername']."</td>";
		echo "<td>".$row['cName']."</td>";
		echo "<td>".$row['subtotal']."</td>";
		echo "<td><a href=\"edit.php?id=$row[oNo]\">Edit</a> | <a href=\"delete.php?id=$row[oNo]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	}
	?>
	</table>
</body>
</html>
