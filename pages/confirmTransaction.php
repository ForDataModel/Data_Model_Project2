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
        $oil_IDNstation_ID = $_POST['oil_IDNstation_ID'];
        $oil_ID= explode(',',$oil_IDNstation_ID)[0];
        $station_ID= explode(',',$oil_IDNstation_ID)[1];
        $phone_number = $_POST['phone_number'];

        $sqlCheckCustomerIsExist = "SELECT Customer_ID FROM Customer WHERE Phone_number='$phone_number'";
        $resultCheckCustomerIsExist = mysqli_query($db,$sqlCheckCustomerIsExist);
        if(mysqli_num_rows($resultCheckCustomerIsExist)>0){

            $rowCustomerID = mysqli_fetch_array($resultCheckCustomerIsExist);
            $Customer_ID = $rowCustomerID["Customer_ID"];
            $sqlInsertBuy = "INSERT INTO Buy (Buy_ID, Buy_amount, Oil_ID, Customer_ID, Value, Date, Tax_id_number) 
                                  VALUES (NULL, '$Buy_amount', '$oil_ID', '$Customer_ID', '$value ', '$Date', '$Tax_id_number')";
            $resultInsertBuy = mysqli_query($db,$sqlInsertBuy);

            if($resultInsertBuy){
                echo '<h2><b>資料送出成功!</b></h2>';
                echo "<meta http-equiv=REFRESH CONTENT=2;url=deal.php>";
            }else{
                $err = mysqli_error($db);
                mysqli_rollback($db);
                echo '<h2 style="color:red;"><b>資料送出失敗!<br/></b></h2>';
                echo '<p>'. $err .'</p>';
                echo "<meta http-equiv=REFRESH CONTENT=2;url=deal.php>";
                error_log($err,3);
            }

        }else{

            echo '<script language="javascript">';
            echo 'alert("查無此消費者，請先進行新增！")';
            echo '</script>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=member.php>";
        }
    }

    if(isset($_GET['Product'])){ 

        $tra_Date = $_POST['tra_Date'];
        $tra_Tax_id_number = $_POST['tra_Tax_id_number'];
        $tra_Product_amount = $_POST['tra_Product_amount'];
        $tra_value = $_POST['tra_value'];
        $product_IDNstation_ID = $_POST['product_IDNstation_ID'];
        $product_ID= explode(',',$product_IDNstation_ID)[0];
        $station_ID= explode(',',$product_IDNstation_ID)[1];
        $phone_number = $_POST['phone_number2'];

        $sqlCheckCustomerIsExist = "SELECT Customer_ID FROM Customer WHERE Phone_number='$phone_number'";
        $resultCheckCustomerIsExist = mysqli_query($db,$sqlCheckCustomerIsExist);

        if(mysqli_num_rows($resultCheckCustomerIsExist)>0){

            $sqlInsertRequired = "INSERT INTO Required (Transaction_ID, Transaction_amount, Product_ID, Customer_ID, Date, Value, Tax_id_number) 
                                       VALUES (NULL, '$tra_Product_amount', '$product_ID', $Customer_ID, '$tra_Date', '$tra_value ', '$tra_Tax_id_number')";
            $resultInsertRequired = mysqli_query($db,$sqlInsertRequired);
    
            if($resultInsertRequired){
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
        }else{

            echo '<script language="javascript">';
            echo 'alert("查無此消費者，請先進行新增！")';
            echo '</script>';
            echo "<meta http-equiv=REFRESH CONTENT=2;url=member.php>";
        }        
    }

    mysqli_close($db);
?>