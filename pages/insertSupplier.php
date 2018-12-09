<?php
    $Supplier_name = $_POST['supplierName'];
    $Phone_number = $_POST['Phone'];
    $Address = $_POST['Address'];
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }

    $sqlInsertSupplier = "INSERT INTO Supplier (Supplier_ID, Phone_number, Address, Supplier_name)
                              VALUES (NULL, '$Phone_number', '$Address', '$Supplier_name')";
    $resultInsertSupplier = mysqli_query($db,$sqlInsertSupplier);

    if($resultInsertSupplier){
        echo '<h2><b>資料送出成功!</b></h2>';
        echo "<meta http-equiv=REFRESH CONTENT=2;url=supplier.php>";
    }else{
        $err = mysqli_error($db);
        mysqli_rollback($db);
        echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
        echo '<p>'. $err .'</p>';
        echo "<meta http-equiv=REFRESH CONTENT=2;url=supplier.php>";
        error_log($err,3);
    };   
    mysqli_close($db);
?>