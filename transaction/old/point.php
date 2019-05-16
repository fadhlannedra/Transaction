<?php
include_once("config.php");

$result = mysqli_query($mysqli, "SELECT nasabah.accountid, nasabah.name, SUM(transaksi.poin) AS poin FROM nasabah INNER JOIN transaksi
ON transaksi.accountid = nasabah.accountid ");
?>
<html>
<head>
	<title>Point</title>
</head>
<body>
	<ul>
		<li><a href="nasabah.php">Nasabah</a></li>
		<li><a href="transaksi.php">Transaksi</a></li>
		<li><a href="point.php">Point</a></li>
    	<li><a href="record.php">Record</a></li>
	</ul>
	<table border=1>
		<tr>
			<th>Account ID</th>
			<th>Name</th>
			<th>Total Point</th>
		</tr>
		 <?php  
    while($user_data = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$user_data['accountid']."</td>";
        echo "<td>".$user_data['name']."</td>"; 
		echo "<td>".$user_data['poin']."</td>";
        echo "<tr>";  
    }
    ?>
	</table>
</body>