<?php
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    if(isset($_GET['Oil'])){

        $Date = $_POST['Date'];
        $Tax_id_number = $_POST['Tax_id_number'];
        $Buy_amount = $_POST['Buy_amount'];
        $value = $_POST['value'];
        $storage_IDNstation_ID = $_POST['storage_IDNstation_ID'];
        $storage_ID= explode(',',$storage_IDNstation_ID)[0];
        $station_ID= explode(',',$storage_IDNstation_ID)[1];
        $Customer_ID = $_POST['Customer_ID'];

        $sqlInsertBuy = "INSERT INTO Buy (Buy_ID, Buy_amount, storage_ID, Customer_ID, Value, Date, Tax_id_number) 
                              VALUES (NULL, '$Buy_amount', '$storage_ID', '$Customer_ID', '$value ', '$Date', '$Tax_id_number')";
        $resultInsertBuy = mysqli_query($db,$sqlInsertBuy);
        $sql = "SELECT oil_Total_Amount FROM storage WHERE storage_ID = '$storage_ID'";
        $rowAmount = mysqli_fetch_array(mysqli_query($db,$sql));
        $oil_Total_Amount  = $rowAmount['oil_Total_Amount']-$Buy_amount;
        $sqlUpdateStorage = "UPDATE storage SET oil_Total_Amount = '$oil_Total_Amount' WHERE storage_ID = '$storage_ID'";
        $resultUpdateStorage = mysqli_query($db,$sqlUpdateStorage);

        if($resultInsertBuy && $resultUpdateStorage){
            echo '<h2><b>資料送出成功!</b></h2>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=deal.php>";
        }else{
            $err = mysqli_error($db);
            mysqli_rollback($db);
            echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
            echo '<p>'. $err .'</p>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=deal.php>";
            error_log($err,3);
        };   
    }

    if(isset($_GET['Product'])){ 

        $tra_Date = $_POST['tra_Date'];
        $tra_Tax_id_number = $_POST['tra_Tax_id_number'];
        $tra_Product_amount = $_POST['tra_Product_amount'];
        $tra_value = $_POST['tra_value'];
        $goods_IDNstation_ID = $_POST['goods_IDNstation_ID'];
        $goods_ID= explode(',',$goods_IDNstation_ID)[0];
        $station= explode(',',$goods_IDNstation_ID)[1];
        $Customer_ID = $_POST['Customer_ID2'];
        
        $sqlInsertRequired = "INSERT INTO Required (Transaction_ID, Transaction_amount, Goods_ID, Customer_ID, Date, Value, Tax_id_number) 
                                    VALUES (NULL, '$tra_Product_amount', '$goods_ID', $Customer_ID, '$tra_Date', '$tra_value ', '$tra_Tax_id_number')";
        $resultInsertRequired = mysqli_query($db,$sqlInsertRequired);
        $sqlgoods = "SELECT Product_total_amount FROM Goods WHERE goods_ID = '$goods_ID'";
        $rowtotal = mysqli_fetch_array(mysqli_query($db,$sqlgoods));
        $product_Total_Amount  = $rowtotal['Product_total_amount']-$tra_Product_amount;
        $sqlUpdateGoods = "UPDATE Goods SET Product_total_amount = '$product_Total_Amount' WHERE goods_ID = '$goods_ID'";
        $resultUpdateGoods = mysqli_query($db,$sqlUpdateGoods);

        if($resultInsertRequired && $resultUpdateGoods){
            echo '<h2><b>資料送出成功!</b></h2>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=deal.php>";
        }else{
            $err = mysqli_error($db);
            mysqli_rollback($db);
            echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
            echo '<p>'. $err .'</p>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=deal.php>";
            error_log($err,3);
        };   
    }

    mysqli_close($db);
?>