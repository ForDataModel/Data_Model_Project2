<?php
    $db = mysqli_connect("localhost","root","root","Gastation") or die("無法開啟MySQL伺服器連接!");
    if (mysqli_connect_errno()) {
        die("無法開啟$dbname資料庫");
    }
    if(isset($_GET['Oil'])){

        $Oil_Name = $_POST['Oil_Name'];
        $Oil_cost = $_POST['Oil_cost'];
        $Oil_amount = $_POST['Oil_amount'];
        $station_ID = $_POST['station_ID'];

        mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

        $sqlInsertOil = "INSERT INTO Oil (Oil_ID, Name, Oil_cost, Oil_price, Oil_amount, Station_ID, Date) 
                              VALUES (NULL, '$Oil_Name', '$Oil_cost', NULL, '$Oil_amount', '$station_ID', CURRENT_TIMESTAMP)";
        $resultInsertOil = mysqli_query($db,$sqlInsertOil);

        $sql = "SELECT oil_Total_Amount 
                  FROM storage 
                 WHERE oil_Name = '$Oil_Name' AND station_ID = '$station_ID'";
        $rowAmount = mysqli_fetch_array(mysqli_query($db,$sql));
        $oil_Total_Amount  = $rowAmount['oil_Total_Amount']+$Oil_amount;
        $sqlUpdateStorage = "UPDATE storage SET oil_Total_Amount = '$oil_Total_Amount' WHERE oil_Name = '$Oil_Name' AND station_ID = '$station_ID'";
        $resultUpdateStorage = mysqli_query($db,$sqlUpdateStorage);

        if($resultInsertOil && $resultUpdateStorage){
            mysqli_commit($db);
            echo '<h2><b>資料送出成功!</b></h2>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=storage.php>";
        }else{
            $err = mysqli_error($db);
            mysqli_rollback($db);
            echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
            echo '<p>'. $err .'</p>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=storage.php>";
            error_log($err,3);
        };   
    }

    if(isset($_GET['Product'])){ 

        $Product_Name = $_POST['Product_Name'];
        $Product_cost = $_POST['Product_cost'];
        $Product_amount = $_POST['Product_amount'];
        $station_ID2 = $_POST['station_ID2'];

        mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

        $sqlInsertProduct = "INSERT INTO Product (Product_ID, Product_name, Price, Product_amount, Cost, Product_Date, Station_ID) 
                                  VALUES (NULL, '$Product_Name', NULL, '$Product_amount', '$Product_cost', CURRENT_TIMESTAMP, '$station_ID2')";
        $resultInsertProduct = mysqli_query($db,$sqlInsertProduct);
        $sqlgoods = "SELECT Product_total_amount 
                       FROM Goods  
                      WHERE Product_name = '$Product_Name' AND station_ID = '$station_ID2'";
        $rowtotal = mysqli_fetch_array(mysqli_query($db,$sqlgoods));
        $product_Total_Amount  = $rowtotal['Product_total_amount']+ $Product_amount;
        $sqlUpdateGoods = "UPDATE Goods 
                              SET Product_total_amount = '$product_Total_Amount' 
                            WHERE Product_name = '$Product_Name' AND station_ID = '$station_ID2'";
        $resultUpdateGoods = mysqli_query($db,$sqlUpdateGoods);

        if($resultInsertProduct && $resultUpdateGoods){
            mysqli_commit($db);
            echo '<h2><b>資料送出成功!</b></h2>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=storage.php>";
        }else{
            $err = mysqli_error($db);
            mysqli_rollback($db);
            echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
            echo '<p>'. $err .'</p>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=storage.php>";
            error_log($err,3);
        };   
    }

    mysqli_close($db);
?>