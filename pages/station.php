<?php
    $db = mysqli_connect("localhost","root","root","Gastation") or die("無法開啟MySQL伺服器連接!");
    if (mysqli_connect_errno()) {
        die("無法開啟$db資料庫");
    }

    $sqlStation = "SELECT s.Address, s.Name AS stationName, s.Phone_number, Staff.Name
                     FROM Station AS s, Staff
                    WHERE s.Manager_ID = Staff.Staff_ID";
    $resultStation = mysqli_query($db,$sqlStation);

    $sqlManager = "SELECT Staff.Staff_ID, Staff.NAME AS staffName
                    FROM Staff, Fulltime
                    WHERE staff.Staff_ID = Fulltime.Staff_ID";
    $resultManager = mysqli_query($db,$sqlManager);
    
    if(!$resultManager && !$resultStation){
        $err = mysqli_error($db);
        echo $err;
        error_log($err, 3,"/Applications/MAMP/htdocs/Data_Model_Project2/error_log");
    }

    mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>永錡加油站系統</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="css/station.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index2.php">Data Base Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index2.php">員工</a>
                        </li>
                        <li>
                            <a href="station.php">加油站</a>
                        </li>
                        <li>
                            <a href="supplier.php">供應商</a>
                        </li>
                        <li>
                            <a href="deal.php">交易</a>
                        </li>
                        <li>
                            <a href="member.php">會員</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Stations</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                <?php 
                    while ($rowStation = mysqli_fetch_array($resultStation)) {
                            $Address = $rowStation["Address"];
                            $stationName = $rowStation["stationName"];
                            $Phone_number = $rowStation["Phone_number"];
                            $Staff_Name = $rowStation["Name"];
                            echo "<div class='col-lg-3 box item'>";
                            echo "<div class='img'>";
                            echo "<a href='#'><img src='img/1.jpg' width='100%'></a>";
                            echo "</div>";
                            echo "<hr>";
                            echo "<div class='text'>";
                            echo "<a href='storage.php?stationName=$stationName'><p class = 'stationName'>$stationName</p></a>";
                            echo "<p>地址：$Address</p>";
                            echo "<p>電話：$Phone_number</p>";
                            echo "<p>負責人：$Staff_Name</p>";
                            echo "</div>";
                            echo "</div>";
                    }
                ?>   
                <div class="col-lg-3 box">
                        <div onclick="showDialog()" class="add">
                            <img src="img/add.png" width="50%" height="100%">
                        </div>
                 </div>
             <div id="dialog">

        </div>
        <form method="post" action="confirmNew.php">
        <div id="msg" class="col-xs-4 col-xs-offset-2">
            <div>
            <i class="fa fa-times col-xs-2 col-xs-offset-10" aria-hidden="true"onclick="closeDialog();"></i>
            </div>
            <div class="col-xs-12">
            <p class="col-xs-5">名子</p>            
            <input class="col-xs-7" type="text"  name="station_name"></div>
            
            <div class="col-xs-12">
            <p class="col-xs-5">地址</p>            
            <input class="col-xs-7" type="text" name="station_address">
            </div>
            <div class="col-xs-12">
            <p class="col-xs-5">電話</p>            
            <input class="col-xs-7" type="text" placeholder="(xx)xxxx-xxxx"  name="station_phone">
            </div>
            <div class="col-xs-12">
            <p class="col-xs-5">負責人</p>            
                <select name="Staff_ID">
                <option value="0">請選擇</option>
                    <?php 
	    			while ($rowManager = mysqli_fetch_array($resultManager)) {
	    				$Staff_ID = $rowManager["Staff_ID"];
                        $staffName = $rowManager["staffName"];
                        echo "<option value='$Staff_ID'>$staffName</option>";
				    }
				    ?>
				</select>
            </div>
          <!--  <div class="col-xs-12">
                <input accept="image/*" id="uploadImage" type="file">
                <img id="img" src="">
            </div>-->
            <div id="newconfirm">
                <input type="submit" value="確認新增" onclick="closeDialog();" ></div>
            </div>
        </div>
        </form>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script src="js/station.js"></script>

</body>

</html>
