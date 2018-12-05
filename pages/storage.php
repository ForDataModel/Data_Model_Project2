<?php
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    $sqlOil = "SELECT o.Name, MAX(o.Oil_cost), MAX(o.Oil_price), ROUND(SUM(o.Oil_amount),2), sup.Supplier_name
            FROM Oil AS o, Supplier AS sup, Station AS s
            WHERE sup.Supplier_ID = s.Oil_Supplier_ID AND o.Station_ID = s.Station_ID
            GROUP BY o.Name, o.Station_ID";
    $resultOil = mysqli_query($db,$sqlOil);

    $sqlProduct = "SELECT p.Product_name, MAX(p.Cost), MAX(p.Price), ROUND(SUM(p.Product_amount)), sup.Supplier_name
              FROM Product AS p, Supplier AS sup, Station AS s
             WHERE sup.Supplier_ID = s.Product_Supplier_ID AND p.Station_ID = s.Station_ID
             GROUP BY p.Product_name, p.Station_ID  
             ORDER BY p.Product_name  DESC";
    $resultProduct = mysqli_query($db,$sqlProduct);

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

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="css/storage.css" rel="stylesheet">

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
                            <a href="index.html">員工</a>
                        </li>
                        <li>
                            <a href="station.html">加油站</a>
                        </li>
                        <li>
                            <a href="supplier.html">供應商</a>
                        </li>
                        <li>
                            <a href="deal.html">交易</a>
                        </li>
                        <li>
                            <a href="member.html">會員</a>
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
                        	<h2>油品 <span> [</span><a href="#">新增</a><span>]</span></h2>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                         <th>品名</th>
                                         <th>存量(L)</th>
                                         <th>進貨價格</th>
                                         <th>出售價格</th>
                                         <th>供應商</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        while ($rowOil = mysqli_fetch_array($resultOil)) {
                                            $Name = $rowOil["Name"];
                                            $Oil_cost = $rowOil["MAX(o.Oil_cost)"];
                                            $Oil_price = $rowOil["MAX(o.Oil_price)"];
                                            $Oil_amount = $rowOil["ROUND(SUM(o.Oil_amount),2)"];
                                            $Supplier_name = $rowOil["Supplier_name"];
                                            echo "<tr>";
                                            echo "<td>$Name</td>";
                                            echo "<td>$Oil_amount</td>";
                                            echo "<td>$Oil_cost</td>";
                                            echo "<td>$Oil_price</td>";
                                            echo "<td>$Supplier_name</td>";
                                            //echo "<td><a href ='licenseUpdate.php?id=$license_file_no'>$license_file_no</td>";
                                            echo "</tr>";
                                        }
                                    ?>    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <div class="row">
                	<div class="col-lg-12">
                        <div class="panel-body">
                            <h2>副產品 <span> [</span><a href="#">新增</a><span>]</span></h2>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                         <th>品名</th>
                                         <th>存量</th>
                                         <th>買入價格</th>
                                         <th>出售價格</th>
                                         <th>供應商</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        while ($rowProduct = mysqli_fetch_array($resultProduct)) {
                                            $Product_name = $rowProduct["Product_name"];
                                            $Cost = $rowProduct["MAX(p.Cost)"];
                                            $Price = $rowProduct["MAX(p.Price)"];
                                            $Product_amount = $rowProduct["ROUND(SUM(p.Product_amount))"];
                                            $Supplier_nameProduct = $rowProduct["Supplier_name"];
                                            echo "<tr>";
                                            echo "<td>$Product_name</td>";
                                            echo "<td>$Product_amount</td>";
                                            echo "<td>$Cost</td>";
                                            echo "<td>$Price</td>";
                                            echo "<td>$Supplier_nameProduct</td>";
                                            //echo "<td><a href ='licenseUpdate.php?id=$license_file_no'>$license_file_no</td>";
                                            echo "</tr>";
                                        }
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
