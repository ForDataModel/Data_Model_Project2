<?php
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    $sqlSupplier = "SELECT * FROM Supplier";
    $resultSupplier = mysqli_query($db,$sqlSupplier);
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
    <link href="css/supplier.css" rel="stylesheet" type="text/css">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Suppliers</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-1">
                        <button onclick="showDialog()" class="btn btn-default">新增</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="dialog">
                </div>
                <form method="post" action="insertSupplier.php">
                <div id="msg" class="col-xs-4 col-xs-offset-2">
                    <div>
                        <i id="msgclose" class="fa fa-times col-xs-1 col-xs-offset-10" aria-hidden="true" onclick="closeDialog();"></i>
                    </div>
                    <div class="col-xs-12 poptext">
                        <p class="col-xs-5">供應商名</p>            
                        <input class="col-xs-7" name="supplierName" type="text">
                    </div>
                    <div class="col-xs-12 poptext">
                        <p class="col-xs-5">電話</p>            
                        <input class="col-xs-7" name="Phone" type="text">
                    </div>
                    <div class="col-xs-12">
                        <p class="col-xs-5 poptext">地址</p>            
                        <input class="col-xs-7" name="Address" type="text">
                    </div>
                    <div id="newconfirm">
                        <input type="submit" value="確認新增" >
                    </div> 
                </div>
                </form>        
            </div>
            <div class="row">
                <div class="col-lg-12">
                        <div class="panel-body">
                            <form method="post" action="updateSupplier.php">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>供應商名</th>
                                        <th>電話</th>
                                        <th>地址</th>
                                        <th>修改</th>
                                        <th>刪除</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                     while ($rowSupplier = mysqli_fetch_array($resultSupplier)) {
                                        $Address = $rowSupplier["Address"];
                                        $Supplier_name = $rowSupplier["Supplier_name"];
                                        $Phone_number = $rowSupplier["Phone_number"];
                                        $Supplier_ID = $rowSupplier["Supplier_ID"];
                                        echo "<tr class='odd gradeX'>";
                                        echo "<td style='display: none;'>$Supplier_ID</input></td>";
                                        echo "<td>$Supplier_name</td>";
                                        echo "<td>$Phone_number</td>";
                                        echo "<td>$Address</td>";
                                        echo "<td class='center'><a class='edit'>修改</a></td>";
                                        echo "<td class='center'><a href='updateSupplier.php?Delete=true&Supplier_ID=$Supplier_ID'>X</a></td>";
                                        echo "</tr>";
                                    }
                                ?>   
                                </tbody>
                            </table>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                <!-- /.col-lg-12 -->
            </div>
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

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- INDEX JavaScript -->
    <script src="js/supplier.js"></script>

</body>

</html>
