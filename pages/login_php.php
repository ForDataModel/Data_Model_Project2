<?php
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_query_login="SELECT * FROM staff where name='$username' AND Personal_ID='$password'";
    $result1=mysqli_query($db,$sql_query_login) or die("查詢失敗");
    if(mysqli_num_rows($result1)){
      header("Location: index2.php");
      exit;
    }else{
      echo "<script type='text/javascript'>";
      echo "$(function(){alert('Login Failed!')})";
      echo "</script>";
      header("Location: login.php");
      exit;
    }
?>
