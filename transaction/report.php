<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Report</title>

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
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Report</div>
          <div class="card-body">
             <form action="report.php" method="post" name="postform">
            <table>
                <tr>
                    <td>Account ID</td>
                    <td>:
                    <?php 
                    include_once("config.php");
                    $account = mysqli_query($mysqli, "SELECT * FROM nasabah");
                    ?>
                    <select name="accountid">
                        <?php while($data = mysqli_fetch_assoc($account) ){?>
                            <option value="<?php echo $data['accountid']; ?>"><?php echo $data['accountid']; ?></option>
                        <?php } ?>

                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Awal</td>
                    <td>: <input type="date" name="startdate" size="16" />
                </tr>
                <tr>
                    <td>Tanggal Akhir</td>
                    <td>: <input type="date" name="enddate" size="16" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <input class="btn btn-primary" type="submit" name="pencarian" value="Search">
                    <input class="btn btn-danger" type="reset" value="Reset" /></td>
                </tr>
            </table>
        </form><br />
         <p>
        <?php
            if(isset($_POST['pencarian'])){
            $accountid = $_POST['accountid'];
            $startdate=$_POST['startdate'];
            $enddate=$_POST['enddate'];
            if(empty($startdate) || empty($enddate) || empty($accountid)){
                echo "Pencarian Tidak Ditemukan";            
            }else{
        ?>
                Hasil Data dari Customer : <b><?php echo $_POST['accountid']?></b>,
                <br>Tanggal Awal Cetak <i><b><?php echo date('d F Y',strtotime($_POST['startdate']))?></b></i> sampai dengan Tanggal Akhir Cetak <i><b><?php echo date('d F Y',strtotime($_POST['enddate']))?></b></i>
        
        </p>

            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Transaction Date</th>
                    <th>Description</th>
                    <th>Credit</th>
                    <th>Debit</th>
                    <th>Balance</th>
                  </tr>
                </thead>
                <tbody>
                <?php  
                 $query= mysqli_query($mysqli, "SELECT * FROM transaction WHERE accountid like '%$accountid%'AND transactiondate BETWEEN '$startdate' AND '$enddate'");
                  $saldo=0;
                  while($user_data = mysqli_fetch_array($query)) {
                      echo "<tr>";
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
                      }
                    }
                  }
                  
                  ?>
                </tbody>
              </table>
            </div>
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
