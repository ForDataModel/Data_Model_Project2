<?php
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
if (isset($_POST['save'])){
        $name=$_POST['Name'];
        $Phone_number=$_POST['Phone_number'];
        $gender=$_POST['Gender'];
        $Member_address=$_POST['Member_address'];
        
        $Birthday=$_POST['Birthday'];
        $Card_name=$_POST['Card_name'];
        
        
        
        
        mysqli_query($db,"INSERT INTO Customer(Customer_ID, Phone_number) VALUES (NULL, '$Phone_number');");
        mysqli_query($db,"INSERT INTO Member(Customer_ID, Member_name, Member_gender, Member_address, Member_birthday,Card_name) VALUES (last_insert_id(), '$name', $gender, '$Member_address', '$Birthday',
            $Card_name);");
        
        echo "<meta http-equiv=REFRESH CONTENT=2;url=member.php>";
        
    }
  
 if(isset($_GET['delete'])){
 	mysqli_query($db,"DELETE FROM Customer WHERE Customer_ID = '$_GET[Customer_ID]'");
 	echo "<meta http-equiv=REFRESH CONTENT=2;url=member.php>";
 }

   //echo "<meta http-equiv=REFRESH CONTENT=2;url=index.php>";
if (isset($_POST['edit'])){
        
        $Phone_number=$_POST['phone'];
        $address=$_POST['address'];
        $id=$_POST['id'];
		// echo "<script type='text/javascript'>alert('$station_id');</script>";
         mysqli_query($db,"UPDATE Customer SET Phone_number = '$Phone_number' WHERE Customer.Customer_ID =$id;");
         mysqli_query($db,"UPDATE Member SET Member_address = '$address' WHERE Member.Customer_ID = $id;");
        echo "<meta http-equiv=REFRESH CONTENT=2;url=member.php>";
        // UPDATE `Staff` SET `Station_ID` = '1' WHERE `Staff`.`Staff_ID` = 32;
        
    }



?>