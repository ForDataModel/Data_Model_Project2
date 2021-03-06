<?php
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    $sqlOilStorage = "SELECT MAX(Oil.Oil_ID) AS Oil_ID, Oil.Name AS Oil_Name, Oil.Station_ID, s.Name AS Station_Name
                        FROM Oil, Station AS s
                       WHERE s.Station_ID = Oil.Station_ID
                    GROUP BY Oil.Name, Oil.Station_ID
                      HAVING SUM(Oil.Oil_amount)>0";
    $resultOilStorage = mysqli_query($db,$sqlOilStorage);

    $sqlBuy = "SELECT Buy.Buy_ID, Buy.Buy_amount, Buy.Value, Buy.Date, Buy.Tax_id_number , Oil.Name AS Oil_Name 
                 FROM Buy, Oil 
                WHERE Oil.Oil_ID = Buy.Oil_ID";
    $resultBuy = mysqli_query($db,$sqlBuy);

    $sqlGoodsTotal = "SELECT MAX(p.Product_ID) AS Product_ID, p.Product_name , p.Station_ID, s.Name AS Station_Name
                        FROM Product AS p, Station AS s
                       WHERE s.Station_ID = p.Station_ID 
                    GROUP BY p.Product_name, p.Station_ID
                      HAVING SUM(p.Product_amount)>0";
    $resultGoodsTotal = mysqli_query($db,$sqlGoodsTotal);

    $sqlRequired = "SELECT r.Transaction_ID, r.Transaction_amount, r.Value , r.Date, r.Tax_id_number , p.Product_name 
                      FROM Required AS r, Product AS p 
                     WHERE r.Product_ID = p.Product_ID";
    $resultRequired = mysqli_query($db,$sqlRequired);

    $err = mysqli_error($db);
    echo $err;
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

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="css/deal.css" rel="stylesheet">

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
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
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
                    <h1 class="page-header">Deal</h1>
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
                            <form action="confirmTransaction.php?Oil=1" method="post">
                            <div id="msg1" class="col-xs-4 col-xs-offset-2">
                                <div>
                                    <i id="msgclose1" class="fa fa-times col-xs-1 col-xs-offset-10" aria-hidden="true" onclick="closeDialog1();"></i>
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">交易日期</p>            
                                    <input class="col-xs-7" type="date" name="Date">
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">統編</p>            
                                    <input class="col-xs-7" type="text" name="Tax_id_number">
                                </div>
                                <div class="col-xs-12 poptext">
                                        <p class="col-xs-5">交易數量</p>            
                                        <input class="col-xs-7" type="text" name="Buy_amount">
                                    </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">交易金額</p>            
                                    <input class="col-xs-7" type="text" name="value">
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">交易商品</p>            
                                    <select name="oil_IDNstation_IDNoil_Name" class="col-xs-7">
                                        <option value="0">請選擇</option>
                                        <?php 
	    			                        while ($rowOilStorage = mysqli_fetch_array($resultOilStorage)) {
                                                   $Oil_ID = $rowOilStorage["Oil_ID"];
                                                   $Oil_Name = $rowOilStorage["Oil_Name"];
	    				                           $Station_ID = $rowOilStorage["Station_ID"];
                                                   $Station_Name = $rowOilStorage["Station_Name"];
                                                   echo "<option value='$Oil_ID,$Station_ID,$Oil_Name'>$Oil_Name, $Station_Name</option>";
				                            }
				                        ?>
				                    </select>
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">消費者聯絡電話</p>            
                                    <input class="col-xs-7" type="text" name="phone_number">
                                </div>
                                <div id="newconfirm1">
                                    <input type="submit" value="確認新增" >
                                </div>         
                            </div>
                        </form>

                            </div>
                        </div>
                        <div class="items">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>交易序號</th>
                                        <th>交易日期</th>
                                        <th>統編</th>
                                        <th>交易數量</th>
                                        <th>交易金額</th>
                                        <th>交易商品</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                     while ($rowBuy = mysqli_fetch_array($resultBuy)) {
                                            $Buy_ID = $rowBuy["Buy_ID"];
                                            $Buy_amount = $rowBuy["Buy_amount"];
                                            $Value = $rowBuy["Value"];
                                            $Oil_Name = $rowBuy["Oil_Name"];
                                            $Date = $rowBuy["Date"];
                                            $Tax_id_number = $rowBuy["Tax_id_number"];
                                            echo "<tr class='odd gradeX'>";
                                            echo "<td>$Buy_ID</td>";
                                            echo "<td>$Date</td>";
                                            echo "<td>$Tax_id_number</td>";
                                            echo "<td>$Buy_amount</td>";
                                            echo "<td>$Value</td>";
                                            echo "<td>$Oil_Name</td>";
                                            echo "</tr>";
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                <div class="col-lg-12">
                    <div class="panel-body">
                        <h2>副產品</h2>
                        <div class="add">
                            <button onclick="showDialog2()" class="btn btn-default">新增</button>
                        </div>
                        <div class="row">
                            <div id="dialog2"></div>
                            <form action="confirmTransaction.php?Product=1" method="post">
                            <div id="msg2" class="col-xs-4 col-xs-offset-2">
                                <div>
                                    <i id="msgclose2" class="fa fa-times col-xs-1 col-xs-offset-10" aria-hidden="true" onclick="closeDialog2();"></i>
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">交易日期</p>            
                                    <input class="col-xs-7" type="date" name="tra_Date">
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">統編</p>            
                                    <input class="col-xs-7" type="text" name="tra_Tax_id_number">
                                </div>
                                <div class="col-xs-12 poptext">
                                        <p class="col-xs-5">交易數量</p>            
                                        <input class="col-xs-7" type="text" name="tra_Product_amount">
                                    </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">交易金額</p>            
                                    <input class="col-xs-7" type="text" name="tra_value">
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">交易商品</p>            
                                    <select name="product_IDNstation_IDNproduct_name" class="col-xs-7">
                                        <option value="0">請選擇</option>
                                        <?php 
	    			                        while ($rowGoods = mysqli_fetch_array($resultGoodsTotal)) {
                                                   $Product_ID = $rowGoods["Product_ID"];
                                                   $Product_name = $rowGoods["Product_name"];
	    				                           $Station_ID = $rowGoods["Station_ID"];
                                                   $Station_Name = $rowGoods["Station_Name"];
                                                   echo "<option value='$Product_ID,$Station_ID,$Product_name'>$Product_name, $Station_Name</option>";
				                            }
				                        ?>
				                    </select>
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">消費者聯絡電話</p>            
                                    <input class="col-xs-7" type="text" name="phone_number2">
                                </div>
                                <div id="newconfirm2">
                                    <input type="submit" value="確認新增" >
                                </div>         
                            </div>
                            </form>
                        </div>
                        <div class="items">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>交易序號</th>
                                        <th>交易日期</th>
                                        <th>統編</th>
                                        <th>交易數量</th>
                                        <th>交易金額</th>
                                        <th>交易商品</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                     while ($rowRequired = mysqli_fetch_array($resultRequired)) {
                                            $Transaction_ID = $rowRequired["Transaction_ID"];
                                            $Transaction_amount = $rowRequired["Transaction_amount"];
                                            $Value = $rowRequired["Value"];
                                            $Product_name = $rowRequired["Product_name"];
                                            $Date = $rowRequired["Date"];
                                            $Tax_id_number = $rowRequired["Tax_id_number"];
                                            echo "<tr class='odd gradeX'>";
                                            echo "<td>$Transaction_ID</td>";
                                            echo "<td>$Date</td>";
                                            echo "<td>$Tax_id_number</td>";
                                            echo "<td>$Transaction_amount</td>";
                                            echo "<td>$Value</td>";
                                            echo "<td>$Product_name</td>";
                                            echo "</tr>";
                                        }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            
            <!-- /.row -->
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

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script src="js/deal.js"></script>
</body>

</html>
