<?php
    $db = mysqli_connect("localhost","root","root","Gastation") or die("無法開啟MySQL伺服器連接!");
    if (mysqli_connect_errno()) {
        die("無法開啟$dbname資料庫");
    }

    $sqlStation = "SELECT Station_ID, Name AS Station_Name FROM Station";
    $resultStation = mysqli_query($db,$sqlStation);

    $sqlStation2 = "SELECT Station_ID, Name AS Station_Name FROM Station";
    $resultStation2 = mysqli_query($db,$sqlStation2);

    $sqlOilName = "SELECT Name AS Oil_Name FROM Oil GROUP BY Name";
    $resultOilName = mysqli_query($db,$sqlOilName);

    $sqlProductName = "SELECT Product_name FROM Product GROUP BY Product_name";
    $resultProductName = mysqli_query($db,$sqlProductName);

    mysqli_commit($db);
    $err = mysqli_error($db);
    echo $err;
  //  mysqli_close($db);
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

    <link href="css/storage.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="js/storage.js"></script>
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
                <a class="navbar-brand" href="index.html">Data Base Admin</a>
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

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Storage</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                	<div class="col-lg-12">
                        <div class="panel-body">
                            <h2>油品</h2>
                            <div class="add">
                                <button onclick="showDialog1()" class="btn btn-default">新增</button>
                            </div>
                            <div class="row">
                                <div id="dialog1"></div>
                                <form action="updateCommodity.php?Oil=1" method="post">
                                <div id="msg1" class="col-xs-4 col-xs-offset-2">
                                    <div>
                                        <i id="msgclose1" class="fa fa-times col-xs-1 col-xs-offset-10" aria-hidden="true" onclick="closeDialog1();"></i>
                                    </div>
                                    <div class="col-xs-12 poptext">
                                        <p class="col-xs-5">油品名稱</p>
                                        <select name="Oil_Name" class="col-xs-7">
                                        <option value="0">請選擇</option>
                                        <?php 
	    			                        while ($rowOilName= mysqli_fetch_array($resultOilName)) {
                                                   $Oil_Name = $rowOilName["Oil_Name"];
                                                   echo "<option value='$Oil_Name'>$Oil_Name</option>";
				                            }
				                        ?>
				                    </select>
                                    </div>
                                    <div class="col-xs-12 poptext">
                                        <p class="col-xs-5" >成本價格</p>
                                        <input class="col-xs-7" type="text" name="Oil_cost">
                                    </div>
                                    <div class="col-xs-12 poptext">
                                        <p class="col-xs-5" >購買數量</p>
                                        <input class="col-xs-7" type="text" name="Oil_amount">
                                    </div>
                                    <div class="col-xs-12 poptext">
                                        <p class="col-xs-5">加油站名</p>
                                        <select name="station_ID" class="col-xs-7">
                                        <option value="0">請選擇</option>
                                        <?php 
	    			                        while ($rowStation= mysqli_fetch_array($resultStation)) {
                                                   $Station_ID = $rowStation["Station_ID"];
                                                   $Station_Name = $rowStation["Station_Name"];
                                                   echo "<option value='$Station_ID'>$Station_Name</option>";
				                            }
				                        ?>
				                    </select>
                                    </div>
                                    <div id="newconfirm1">
                                        <input type="submit" value="確認新增" onclick="closeDialog1();" >
                                    </div>
                                </div>
                            </form>
                            </div>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                         <th>品名</th>
                                         <th>存量(L)</th>
                                         <th>進貨價格</th>
                                         <th>出售價格</th>
                                         <th>加油站名</th>
                                         <th>供應商</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                      $sqlOil = "CALL Storage();";
                                      $resultOil = mysqli_query($db,$sqlOil);

                                        while ($rowOil = mysqli_fetch_array($resultOil)) {
                                            $Oil_Name = $rowOil["Name"];
                                            $Oil_Cost = $rowOil["Oil_Cost"];
                                            $Oil_price = $rowOil["Oil_Price"];
                                            $Total_amount = $rowOil["Total_Amount"];
                                            $Supplier_name = $rowOil["Supplier_name"];
                                            $Station_Name = $rowOil["Station_Name"];
                                            echo "<tr>";
                                            echo "<td>$Oil_Name</td>";
                                            echo "<td>$Total_amount</td>";
                                            echo "<td>$Oil_Cost</td>";
                                            echo "<td>$Oil_price</td>";
                                            echo "<td>$Station_Name</td>";
                                            echo "<td>$Supplier_name</td>";
                                            echo "</tr>";
                                        }
                                        $resultOil->close();
                                        $db->next_result();
                                    ?>   
                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>
                <div class="row">
                	<div class="col-lg-12">
                        <div class="panel-body">
                            <h2>副產品 </h2>
                            <div class="add">
                                <button onclick="showDialog2()" class="btn btn-default">新增</button>
                            </div>
                            <div class="row">
                                <div id="dialog2"></div>
                                <form action="updateCommodity.php?Product=1" method="post">
                                <div id="msg2" class="col-xs-4 col-xs-offset-2">
                                    <div>
                                        <i id="msgclose2" class="fa fa-times col-xs-1 col-xs-offset-10" aria-hidden="true" onclick="closeDialog2();"></i>
                                    </div>
                                    <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">副產品名稱</p>
                                        <select name="Product_Name" class="col-xs-7">
                                        <option value="0">請選擇</option>
                                        <?php 
	    			                        while ($rowProductName= mysqli_fetch_array($resultProductName)) {
                                                   $Product_Name = $rowProductName["Product_name"];
                                                   echo "<option value='$Product_Name'>$Product_Name</option>";
				                            }
				                        ?>
				                    </select>
                                    </div>
                                    <div class="col-xs-12 poptext">
                                        <p class="col-xs-5" >成本價格</p>
                                        <input class="col-xs-7" type="text" name="Product_cost">
                                    </div>
                                    <div class="col-xs-12 poptext">
                                        <p class="col-xs-5" >購買數量</p>
                                        <input class="col-xs-7" type="text" name="Product_amount">
                                    </div>
                                    <div class="col-xs-12 poptext">
                                        <p class="col-xs-5">加油站名</p>
                                        <select name="station_ID2" class="col-xs-7">
                                        <option value="0">請選擇</option>
                                        <?php 
	    			                        while ($rowStation2= mysqli_fetch_array($resultStation2)) {
                                                   $Station_ID2 = $rowStation2["Station_ID"];
                                                   $Station_Name2 = $rowStation2["Station_Name"];
                                                   echo "<option value='$Station_ID2'>$Station_Name2</option>";
				                            }
				                        ?>
				                    </select>
                                    </div>
                                    <div id="newconfirm2">
                                        <input type="submit" value="確認新增" onclick="closeDialog2();" >
                                    </div>
                                </div>
                                </form>
                            </div>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                         <th>品名</th>
                                         <th>存量</th>
                                         <th>買入價格</th>
                                         <th>出售價格</th>
                                         <th>加油站名</th>
                                         <th>供應商</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $sqlService = "CALL Service();";
                                    $resultService = mysqli_query($db,$sqlService);

                                        while ($rowService = mysqli_fetch_array($resultService)) {
                                            $Product_name = $rowService["Product_name"];
                                            $Total_Amount = $rowService["Total_Amount"];
                                            $Product_Cost = $rowService["Product_Cost"];
                                            $Product_Price = $rowService["Product_Price"];
                                            $Station_Name = $rowService["Station_Name"];
                                            $Supplier_name = $rowService["Supplier_name"];
                                            echo "<tr>";
                                            echo "<td>$Product_name</td>";
                                            echo "<td>$Total_Amount</td>";
                                            echo "<td>$Product_Cost</td>";
                                            echo "<td>$Product_Price</td>";
                                            echo "<td>$Station_Name</td>";
                                            echo "<td>$Supplier_name</td>";
                                            echo "</tr>";
                                        }
                                        $resultService->close();
                                        $db->next_result();
                                    ?>       
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <div class="row">
                	<div class="back">
                		<a href="station.html">
                			<button class="btn btn-default">上一頁</button>
                		</a>
                	</div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
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


</body>

</html>
