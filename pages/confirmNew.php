<?php
    $db = mysqli_connect("localhost","root","root","Gastation") or die("無法開啟MySQL伺服器連接!");
    if (mysqli_connect_errno()) {
        die("無法開啟$db資料庫");
    }

    mysqli_begin_transaction($db, MYSQLI_TRANS_START_READ_WRITE);

    $station_name = $_POST['station_name'];
    $station_address = $_POST['station_address'];
    $station_phone = $_POST['station_phone'];
    $ManagerID = $_POST["Staff_ID"];

    $sqlCheckStaffIsUnique = "SELECT Name FROM Station WHERE Station.Manager_ID = '$ManagerID'";
    $resultCheckStaffIsUnique = mysqli_query($db,$sqlCheckStaffIsUnique);
    if(mysqli_num_rows($resultCheckStaffIsUnique)==0){
        
        $sqlInsertStation = "INSERT INTO Station (Station_ID, Address, Name, Manager_ID, Phone_number, Oil_Supplier_ID, Product_Supplier_ID)
                                  VALUES (NULL, '$station_address', '$station_name', '$ManagerID', '$station_phone', 1, 2)";
        $resultInsertStation = mysqli_query($db,$sqlInsertStation);
        $sqlStationID = "SELECT Station_ID FROM Station WHERE Name = $station_name AND Address = $station_address";
        $rowStationID = mysqli_fetch_array(mysqli_query($db,$sqlStationID));
        $StationID  = $rowStationID['Station_ID'];
        $sqlUpdateStaff =  "UPDATE Staff SET Station_ID = '$StationID' WHERE Staff_ID = '$ManagerID'";
        $resultUpdateStaff = mysqli_query($db,$sqlUpdateStaff);

        if($resultInsertStation){
            mysqli_commit($db);
            echo '<h2><b>資料送出成功!</b></h2>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=station.php>";
        }else{
            $err = mysqli_error($db);
            mysqli_rollback($db);
            echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
            echo '<p>'. $err .'</p>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=station.php>";
            error_log($err,3);
        }
    }
    echo '<h2><b>管理者已經是其他加油站的負責人，請重新確認！</b></h2>';
    echo "<meta http-equiv=REFRESH CONTENT=2;url=station.php>";
   
    mysqli_close($db);
?>
