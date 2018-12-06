<?php
    $address = $_POST['address'];
    $Supplier_ID = $_POST['Supplier_ID'];
    $phone = $_POST['phone'];
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    $sqlUpdateSupplier =  "UPDATE Supplier 
                              SET Address = '$address', Phone_number = '$phone' 
                            WHERE Supplier_ID = '$Supplier_ID'";
    $resultUpdateSupplier = mysqli_query($db,$sqlUpdateSupplier);

    if($resultUpdateSupplier){
        echo '<h2><b>資料送出成功!</b></h2>';
        echo "<meta http-equiv=REFRESH CONTENT=2;url=Supplier.php>";
    }else{
        $err = mysqli_error($db);
        mysqli_rollback($db);
        echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
        echo '<p>'. $err .'</p>';
        echo "<meta http-equiv=REFRESH CONTENT=2;url=Supplier.php>";
        error_log($err,3);
    };   

    if(isset($_GET['Delete'])) 
    {
        $ID = $_GET['Supplier_ID'];
        $result = mysqli_query($db, "DELETE FROM Supplier WHERE Supplier_ID='$ID'");
        if(!$result){
            $err = mysqli_error($db);
            mysqli_rollback($db);
            echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
            echo '<p>'. $err .'</p>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=Supplier.php>";
            error_log("刪除失敗，Supplier_ID有問題",3);
        }
            
    }

    mysqli_close($db);
?>