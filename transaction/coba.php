 <?php
                  include_once("config.php");
                  $result = mysqli_query($mysqli, "SELECT nasabah.accountid, nasabah.name, SUM(transaksi.poin) AS poin FROM nasabah LEFT JOIN transaksi ON nasabah.accountid = transaksi.accountid "); 
                   
                  while($user_data = mysqli_fetch_array($result)) {
                      echo "<tr>";
                      echo "<td>".$user_data['accountid']."</td>";
                      echo "<td>".$user_data['name']."</td>"; 
                      echo "<td>".$user_data['poin']."</td>";
                      echo "<tr>";  
                  }
                  ?>