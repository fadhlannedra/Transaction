<html>
<head>
    <title>Tambah Nasabah</title>
</head>

<body>
    <a href="nasabah.php">Home</a>
    <br/><br/>

    <form action="addnasabah.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Account ID</td>
                <td><input type="text" name="accountid"></td>
            </tr>   
            <tr> 
                <td>Nama</td>
                <td><input type="text" name="name"></td>
            </tr>                       
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Tambah"></td>
            </tr>
        </table>
    </form>

    <?php

    if(isset($_POST['Submit'])) {
        $accountid = $_POST['accountid'];
        $name = $_POST['name'];

        include_once("config.php");

        $result = mysqli_query($mysqli, "INSERT INTO nasabah(accountid,name) VALUES('$accountid','$name')");

        echo "Nasabah added successfully. <a href='nasabah.php'>View Nasabah</a>";
    }
    ?>
</body>
</html>