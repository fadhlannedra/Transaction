<?php
include_once("config.php");

$result = mysqli_query($mysqli, "SELECT * FROM nasabah");
?>
<html>
<head>
	<title>Nasabah</title>
</head>
<body>
	<ul>
		<li><a href="nasabah.php">Nasabah</a></li>
		<li><a href="transaksi.php">Transaksi</a></li>
		<li><a href="point.php">Point</a></li>
    	<li><a href="record.php">Record</a></li>
	</ul>
	<a href="addnasabah.php">+ Tambah Nasabah</a>
	<table border=1>
		<tr>
			<th>Account ID</th>
			<th>Nama</th>
		</tr>
	<?php  
    while($user_data = mysqli_fetch_array($result)) {         
        echo "<tr>";
        echo "<td>".$user_data['accountid']."</td>";
        echo "<td>".$user_data['name']."</td>";          
    }
    ?>
	</table>
</body>