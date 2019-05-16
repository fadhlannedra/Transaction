<html>
<head>
    <title>Tambah Transaksi</title>
</head>

<body>
    <a href="transaksi.php">Home</a>
    <br/><br/>

    <form action="addtransaksi.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Account ID</td>
                <td><?php 
                include_once("config.php");
                $result = mysqli_query($mysqli, "SELECT * FROM nasabah");?>
                <select name="accountid">
                    <?php while($data = mysqli_fetch_assoc($result) ){?>
                        <option value="<?php echo $data['accountid']; ?>"><?php echo $data['accountid']; ?></option>
                <?php } ?>

                </select>
                </td>
            </tr>
            <tr> 
                <td>Transaction ID</td>
                <td><input type="date" name="transactiondate"></td>
            </tr> 
            <tr>
                <td>Description</td>
                <td><input type="radio" name="description" value="Setor Tunai" > Setor Tunai</td>
                <td><input type="radio" name="description" value="Tarik Tunai" > Tarik Tunai</td>
                <td><input type="radio" name="description" value="Beli Pulsa" > Beli Pulsa</td>
                <td><input type="radio" name="description" value="Bayar Listrik" > Bayar Listrik</td>
            </tr>
            <tr>
                <td>Debit Credit</td>
                <td><select name="debitcreditstatus">
                    <option value="D">D</option>
                    <option value="C">C</option></select></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td><input type="text" name="amount"></td>
            </tr>  


                            
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <?php

    if(isset($_POST['Submit'])) {
        $accountid = $_POST['accountid'];
        $transactiondate = $_POST['transactiondate'];
        $description = $_POST['description'];
        $debitcreditstatus = $_POST['debitcreditstatus'];
        $amount = $_POST['amount'];

        include_once("config.php");

        $input = $_POST['amount'];
        $opsi = $_POST['description'];


        if ($opsi === 'Bayar Listrik') {
            $i = 50000;
            $j = 100000;
            $kelipatan = 2000;
            $p1 = 1;
            $p2 = 2;
            if ($input<=$i) {
                $poin = 0;
            }
            if ($input>$i && $input<=$j) {
                $a = $input - $i;
                $poin = ($a / $kelipatan)*$p1;
            }
            if ($input>$j) {
                $b = $input-$j;
                $poin = ($b / $kelipatan * $p2) + ($j-$i)/$kelipatan;
             }
        } 

        elseif($opsi === 'Beli Pulsa') {
            $i = 10000;
            $j = 30000;
            $kelipatan = 1000;
            $p1 = 1;
            $p2 = 2;
            if ($input<=$i) {
            $poin = 0;
            }
            if ($input>$i && $input<=$j) {
                $a = $input - $i;
                $poin = ($a / $kelipatan)*$p1;
            }
            if ($input>$j) {
                $b = $input-$j;
                $poin = ($ba / $kelipatan * $p2) + ($j-$i)/$kelipatan;
             }
            }
        else{
                $poin = 0;
            
        }
        $result = mysqli_query($mysqli, "INSERT INTO transaksi(accountid,transactiondate,description,debitcreditstatus,amount,poin) VALUES('$accountid','$transactiondate','$description','$debitcreditstatus','$amount','$poin')");

        echo "Transaksi added successfully. <a href='transaksi.php'>View Transaksi</a>";
    }
    ?>
</body>
</html>