<?php
    $station_name = $_POST['station_name'];
    $station_address = $_POST['station_address'];
    $station_phone = $_POST['station_phone'];
    $ManagerID = $_POST["Staff_ID"];
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    $sqlInsertStation = "INSERT INTO Station (Station_ID, Address, Name, Manager_ID, Daily_revenue, Phone_number, Oil_Supplier_ID, Product_Supplier_ID) 
                              VALUES (NULL, '$station_address', '$station_name', '$ManagerID', NULL, '$station_phone', NULL, NULL)";
    $resultInsertStation = mysqli_query($db,$sqlInsertStation);
    $sqlStationID = "SELECT Station_ID FROM Station WHERE Name = $station_name AND Address = $station_address";
    $rowStationID = mysqli_fetch_array(mysqli_query($db,$sqlStationID));
    $StationID  = $rowStationID['Station_ID'];
     $sqlUpdateStaff =  "UPDATE Staff SET Station_ID	=  '$StationID' WHERE Staff_ID = '$ManagerID'";
    $resultUpdateStaff = mysqli_query($db,$sqlUpdateStaff);
    mysqli_commit($db);

    if($resultInsertStation){
        echo '<h2><b>資料送出成功!</b></h2>';
        echo "<meta http-equiv=REFRESH CONTENT=2;url=station.php>";
    }else{
        $err = mysqli_error($db);
        mysqli_rollback($db);
        echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
        echo '<p>'. $err .'</p>';
        echo "<meta http-equiv=REFRESH CONTENT=2;url=station.php>";
        error_log($err,3);
    };   
    mysqli_close($db);
?>