<?php
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
if (isset($_POST['save'])){
        $name=$_POST['Name'];
        $gender=$_POST['Gender'];
        $Personal_ID=$_POST['Personal_ID'];
        $Birthday=$_POST['Birthday'];
        $Salary=$_POST['Salary'];
        $Station_ID=$_POST['station_id'];
        
        
        
        mysqli_query($db,"INSERT INTO Staff(Name,Gender,Personal_ID,Birthday,Station_ID) VALUES ('$name', $gender, '$Personal_ID','$Birthday','$Station_ID');");
        mysqli_query($db,"INSERT INTO Fulltime VALUES(last_insert_id(),'$Salary');");
        echo "<meta http-equiv=REFRESH CONTENT=2;url=index2.php>";
        
    }
if (isset($_POST['save2'])){
        $name2=$_POST['Name2'];
        $gender2=$_POST['Gender2'];
        $Personal_ID2=$_POST['Personal_ID2'];
        $Birthday2=$_POST['Birthday2'];
        $Salary2=$_POST['Salary2'];
        $Station_ID2=$_POST['station_id2'];
        
        //echo "<script type='text/javascript'>alert('$Birthday2');</script>";
        
        mysqli_query($db,"INSERT INTO Staff(Name,Gender,Personal_ID,Birthday,Station_ID) VALUES ('$name2', $gender2, '$Personal_ID2','$Birthday2','$Station_ID2');");
        mysqli_query($db,"INSERT INTO Parttime VALUES(last_insert_id(),'$Salary2');");
        echo "<meta http-equiv=REFRESH CONTENT=2;url=index2.php>";
    }   
 if(isset($_GET['delete'])){
 	mysqli_query($db,"DELETE FROM Staff WHERE Personal_ID = '$_GET[Personal_ID]'");
 	echo "<meta http-equiv=REFRESH CONTENT=2;url=index2.php>";
 }

   //echo "<meta http-equiv=REFRESH CONTENT=2;url=index.php>";
if (isset($_POST['edit'])){
        $fullid = $_POST['fullid'];
        $salary=$_POST['salary'];
        $station_id=$_POST['Station_id'];
        $id=$_POST['id'];
		// echo "<script type='text/javascript'>alert('$station_id');</script>";
         mysqli_query($db,"UPDATE Fulltime SET Salary = '$salary' WHERE Staff_ID =$id;");
         mysqli_query($db,"UPDATE Staff SET Station_ID = '$station_id' WHERE Staff_ID = $id;");
        echo "<meta http-equiv=REFRESH CONTENT=2;url=index2.php>";
        // UPDATE `Staff` SET `Station_ID` = '1' WHERE `Staff`.`Staff_ID` = 32;
        
    }
if (isset($_POST['edit2'])){
        $fullid = $_POST['fullid'];
        $salary2=$_POST['salary2'];
        $station_id=$_POST['Station_id'];
        $id2=$_POST['id2'];
        // echo "<script type='text/javascript'>alert('$station_id');</script>";
         mysqli_query($db,"UPDATE Parttime SET Hourpay = '$salary2' WHERE Staff_ID =$id2;");
         mysqli_query($db,"UPDATE Staff SET Station_ID = '$station_id' WHERE Staff_ID = $id2;");
        echo "<meta http-equiv=REFRESH CONTENT=2;url=index2.php>";
        // UPDATE `Staff` SET `Station_ID` = '1' WHERE `Staff`.`Staff_ID` = 32;
        
    }


?>