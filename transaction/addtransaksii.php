<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Transkasi - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php include_once 'view/header.php'; ?>

  <div id="wrapper">

  <?php include_once 'view/sidebar.php'; ?>

    <div id="content-wrapper">

      <div class="container-fluid">

      

        <!-- DataTables Example -->
        <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Transaksi</div>
      <div class="card-body">
         <form action="addtransaksii.php" method="post" name="form1">
        <table>
            <tr> 
                <td>Account ID</td>
                <td>:</td>
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
                <td>Transaction Date</td>
                <td>:</td>
                <td><input type="date" name="transactiondate"></td>
            </tr> 
            <tr>
                <td>Description</td>
                <td>:</td>
                <td><input type="radio" name="description" value="Setor Tunai" > Setor Tunai
                <input type="radio" name="description" value="Tarik Tunai" > Tarik Tunai
                <input type="radio" name="description" value="Beli Pulsa" > Beli Pulsa
                <input type="radio" name="description" value="Bayar Listrik" > Bayar Listrik</td>
            </tr>
            <tr>
                <td>Debit Credit</td>
                <td>:</td>
                <td>
                <input type="radio" name="debitcreditstatus" value="D" > Debit
                <input type="radio" name="debitcreditstatus" value="C" > Kredit</td>
                
            </tr>
            <tr>
                <td>Amount</td>
                <td>:</td>
                <td><input type="text" name="amount"></td>
            </tr>           
            <tr> 
                <td></td>
                <td></td>
                <td><br><input class="btn btn-primary" type="submit" name="Submit" value="Tambah"></td>
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
                      $point = 0;
                  }
                  if ($input>$i && $input<=$j) {
                      $a = $input - $i;
                      $point = ($a / $kelipatan)*$p1;
                  }
                  if ($input>$j) {
                      $b = $input-$j;
                      $point = ($b / $kelipatan * $p2) + ($j-$i)/$kelipatan;
                   }
              } 

              elseif($opsi === 'Beli Pulsa') {
                  $i = 10000;
                  $j = 30000;
                  $kelipatan = 1000;
                  $p1 = 1;
                  $p2 = 2;
                  if ($input<=$i) {
                  $point = 0;
                  }
                  if ($input>$i && $input<=$j) {
                      $a = $input - $i;
                      $point = ($a / $kelipatan)*$p1;
                  }
                  if ($input>$j) {
                      $b = $input-$j;
                      $point = ($b / $kelipatan * $p2) + ($j-$i)/$kelipatan;
                   }
                  }
              else{
                      $point = 0;
                  
              }
              $result = mysqli_query($mysqli, "INSERT INTO transaction(accountid,transactiondate,description,debitcreditstatus,amount,point) VALUES('$accountid','$transactiondate','$description','$debitcreditstatus','$amount','$point')");

              echo "Transaksi added successfully. <a href='transaksi.php'>View Transaksi</a>";
          }
          ?>
      </div>
    </div>
  </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
     <?php include_once 'view/footer.php';?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
