<?php
include_once("config.php");


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
  <form action="record.php" method="post" name="postform">
            <table border="0">
                <tr>
                    <td width="125"><b>Account ID</b></td>
                    <td><?php 
                    $result = mysqli_query($mysqli, "SELECT * FROM nasabah");?>
                    <select name="accountid">
                        <?php while($data = mysqli_fetch_assoc($result) ){?>
                            <option value="<?php echo $data['accountid']; ?>"><?php echo $data['accountid']; ?></option>
                    <?php } ?>

                    </select>
                    </td>
                    <td width="125"><b>Dari Tanggal</b></td>
                    <td colspan="2" width="190">: <input type="date" name="tanggal_awal" size="16" />
                    <td width="125"><b>Sampai Tanggal</b></td>
                    <td colspan="2" width="190">: <input type="date" name="tanggal_akhir" size="16" />             
                    </td>
                    <td colspan="2" width="190"><input type="submit" value="Pencarian Data" name="pencarian"/></td>
                    <td colspan="2" width="70"><input type="reset" value="Reset" /></td>
                </tr>
            </table>
        </form><br />
         <p>
        <?php
            if(isset($_POST['pencarian'])){
            $accountid = $_POST['accountid'];
            $tanggal_awal=$_POST['tanggal_awal'];
            $tanggal_akhir=$_POST['tanggal_akhir'];
            if(empty($tanggal_awal) || empty($tanggal_akhir) || empty($accountid)){
                echo "Tidak ada data";            
            }else{
        ?>
                Data Account ID <b><?php echo $_POST['accountid']?></b>  periode Tanggal 
                <b><?php echo $_POST['tanggal_awal']?></b> s/d <b><?php echo $_POST['tanggal_akhir']?></b>
        <?php
                $query= mysqli_query($mysqli, "SELECT * FROM transaksi WHERE accountid AND transactiondate BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
            }
          }
        ?>
        </p>
  <table border=1>
    <tr>
      <th>No</th>
      <th>Transaction Date</th>
      <th>Descripton</th>
      <th>Credit </th>
      <th>Debit</th>
      <th>Balance</th>
    </tr>
     <?php  
    $count=1;
    while($user_data = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo"<td>$count</td>";
        echo "<td>".$user_data['transactiondate']."</td>"; 
        echo "<td>".$user_data['description']."</td>";
        
        $status=$user_data['debitcreditstatus'];
        $amount=$user_data['amount'];

        
        if ($status == 'D') {
          $debit = $amount;
        }else{
          $debit = 0;
        }
        if ($status == 'C') {
          $credit = $amount;
        }else{
          $credit = 0;
        }
       
            if ($debit==0) { 
            $saldo=$saldo-$debit+$credit ;
            echo "<td>".number_format($credit,0,",",".")."</td>";
            echo "<td>".number_format($debit,0,",",".")."</td>";
        
        
         
            echo"<td>".number_format($saldo,0,",",".")."</td>"; 
            echo "<tr>"; 
          } else{
            $saldo=$saldo-$debit;
            echo "<td>".number_format($credit,0,",",".")."</td>";
       
        echo "<td>".number_format($debit,0,",",".")."</td>";
        
        
         
            echo"<td>".number_format($saldo,0,",",".")."</td>"; 
            echo "<tr>"; 
          }
          $count++;
        }
    
    ?>
  </table>
</body>