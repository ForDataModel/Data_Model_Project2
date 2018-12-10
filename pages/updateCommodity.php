<?php
    $db = mysqli_connect("localhost","root","root","Gastation") or die("無法開啟MySQL伺服器連接!");
    if (mysqli_connect_errno()) {
        die("無法開啟$db資料庫");
    }
    if(isset($_GET['Oil'])){

        $Oil_Name = $_POST['Oil_Name'];
        $Oil_cost = $_POST['Oil_cost'];
        $Oil_amount = $_POST['Oil_amount'];
        $station_ID = $_POST['station_ID'];


        $sqlInsertOil = "INSERT INTO Oil (Oil_ID, Name, Oil_cost, Oil_price, Oil_amount, Station_ID, Date) 
                              VALUES (NULL, '$Oil_Name', '$Oil_cost', NULL, '$Oil_amount', '$station_ID', CURRENT_TIMESTAMP)";
        $resultInsertOil = mysqli_query($db,$sqlInsertOil);

        if($resultInsertOil){
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

        $sqlInsertProduct = "INSERT INTO Product (Product_ID, Product_name, Price, Product_amount, Cost, Product_Date, Station_ID) 
                                  VALUES (NULL, '$Product_Name', NULL, '$Product_amount', '$Product_cost', CURRENT_TIMESTAMP, '$station_ID2')";
        $resultInsertProduct = mysqli_query($db,$sqlInsertProduct);
       
        if($resultInsertProduct ){
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