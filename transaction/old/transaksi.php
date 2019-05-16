<?php
include_once("config.php");

$result = mysqli_query($mysqli, "SELECT * FROM transaksi");
?>
<html>
<head>
	<title>Transaksi</title>
</head>
<body>
	<ul>
		<li><a href="nasabah.php">Nasabah</a></li>
		<li><a href="transaksi.php">Transaksi</a></li>
		<li><a href="point.php">Point</a></li>
    	<li><a href="record.php">Record</a></li>
	</ul>
	<a href="addtransaksi.php">+ Tambah Transaksi</a>
	<table border=1>
		<tr>
			<th>Account ID</th>
			<th>Transaction Date</th>
			<th>Description</th>
			<th>Debit Credit</th>
			<th>Amount</th>
		</tr>
	<?php  
    while($user_data = mysqli_fetch_array($result)) {   
    	$amount = $user_data['amount'];      
        echo "<tr>";
        echo "<td>".$user_data['accountid']."</td>";
        echo "<td>".$user_data['transactiondate']."</td>";
        echo "<td>".$user_data['description']."</td>";
        echo "<td>".$user_data['debitcreditstatus']."</td>";
        echo "<td>".number_format($amount,0,",",".")."</td>";          
    }
    ?>
	</table>
</body>