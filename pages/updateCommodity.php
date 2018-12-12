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
        $Oil_price = $_POST['Oil_price'];

        $sqlInsertOil = "INSERT INTO Oil (Oil_ID, Name, Oil_cost, Oil_price, Oil_amount, Station_ID, Date) 
                              VALUES (NULL, '$Oil_Name', '$Oil_cost', '$Oil_price', '$Oil_amount', '$station_ID', CURRENT_TIMESTAMP)";
        $resultInsertOil = mysqli_query($db,$sqlInsertOil);

        $sqlStationName = "SELECT Station.Name AS Station_name FROM Station WHERE Station.Station_ID ='$station_ID '";
        $resultStationName = mysqli_query($db,$sqlStationName);
        $rowresult = mysqli_fetch_array($resultStationName);
        $Station_name = $rowresult['Station_name'];
        
        if($resultInsertOil){
            echo '<h2><b>資料送出成功!</b></h2>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=storage.php?stationName=$Station_name>";
        }else{
            $err = mysqli_error($db);
            mysqli_rollback($db);
            echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
            echo '<p>'. $err .'</p>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=storage.php?stationName=$Station_name>";
            error_log($err, 3,"/Applications/MAMP/htdocs/Data_Model_Project2/error_log");
        };   
    }

    if(isset($_GET['Product'])){ 

        $Product_Name = $_POST['Product_Name'];
        $Product_cost = $_POST['Product_cost'];
        $Product_amount = $_POST['Product_amount'];
        $station_ID2 = $_POST['station_ID2'];
        $Product_price = $_POST['Product_price'];

        $sqlInsertProduct = "INSERT INTO Product (Product_ID, Product_name, Price, Product_amount, Cost, Product_Date, Station_ID) 
                                  VALUES (NULL, '$Product_Name', '$Product_price', '$Product_amount', '$Product_cost', CURRENT_TIMESTAMP, '$station_ID2')";
        $resultInsertProduct = mysqli_query($db,$sqlInsertProduct);

        $sqlStationName2 = "SELECT Station.Name AS Station_name FROM Station WHERE Station.Station_ID ='$station_ID2'";
        $resultStationName2 = mysqli_query($db,$sqlStationName2);
        $rowresult2 = mysqli_fetch_array($resultStationName2);
        $Station_name = $rowresult2['Station_name'];
       
        if($resultInsertProduct ){
            echo '<h2><b>資料送出成功!</b></h2>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=storage.php?stationName=$Station_name>";
        }else{
            $err = mysqli_error($db);
            mysqli_rollback($db);
            echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
            echo '<p>'. $err .'</p>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=storage.php?stationName=$Station_name>";
            error_log($err, 3,"/Applications/MAMP/htdocs/Data_Model_Project2/error_log");
        };   
    }

    mysqli_close($db);
?>