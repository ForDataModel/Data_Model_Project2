<?php
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    if($_POST['search']!=''){
        $search=$_POST['search'];
        $result = mysqli_query($db,"SELECT Member.Member_name, Member.Member_gender, Member.Member_birthday, Member.Card_name, Member.Member_start_time, Customer.Phone_number, Member.Member_address, Customer.Customer_ID
            FROM Customer 
            INNER JOIN Member 
            ON Customer.Customer_ID=Member.Customer_ID
            WHERE Member_name like '%$search%'");
        
    }else{
        $sql = "SELECT Member.Member_name, Member.Member_gender, Member.Member_birthday, Member.Card_name, Member.Member_start_time, Customer.Phone_number, Member.Member_address, Customer.Customer_ID
            FROM Customer 
            INNER JOIN Member 
            ON Customer.Customer_ID=Member.Customer_ID";
        $result = mysqli_query($db,$sql);
        
    }
    // $sql = "SELECT Member.Member_name, Member.Member_gender, Member.Member_birthday, Member.Card_name, Member.Member_start_time, Customer.Phone_number, Member.Member_address, Customer.Customer_ID
    //         FROM Customer 
    //         INNER JOIN Member 
    //         ON Customer.Customer_ID=Member.Customer_ID";
    // $result = mysqli_query($db,$sql);
    
    
    
    
    
    

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
    <link href="css/member.css" rel="stylesheet" type="text/css">

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

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Members</h1>
                    </div>
            <div class="search-container">
                            <div class="col-xs-8">
                            <button onclick="showDialog()" class="add btn btn-default">新增</button>
                            </div>
                            
                        <form class="col-xs-4" action="member.php" method="post">

                            
                        <input type="text" name="search">
                        <button type="submit" class="btn btn-default" style="text-align:right">搜尋姓名</button>
                        </form>
                        </div>
                        </div>

            <div class="row">
                <form method="post" action="memberaction.php">
                <div id="dialog">
                     
                </div>
                <div id="msg" class="col-xs-4 col-xs-offset-2">

                    <div class="col-xs-12 poptext">
                    <div>
                        <i id="msgclose" class="fa fa-times col-xs-1 col-xs-offset-10" aria-hidden="true" onclick="closeDialog();"></i>
                    </div>
                    <br>
                        <p class="col-xs-5">姓名</p>            
                        <input class="col-xs-7" type="text" name="Name" required>
                    </div>
                    <div class="col-xs-12 poptext">
                        <p class="col-xs-5">性別</p>            
                        <input type="radio" class="col-xs-2" name="Gender" type="text" value="1" required>男</br>
                        <input type="radio" class="col-xs-2" name="Gender" type="text" value="0" required>女
                    </div>
                    <div class="col-xs-12 poptext">
                        <p class="col-xs-5">生日</p>            
                        <input class="col-xs-7" type="date" name="Birthday" placeholder="yyyy-mm-dd">
                    </div>
                    <div class="col-xs-12 poptext">
                        <p class="col-xs-5">卡別</p>            
                        <input type="radio" class="col-xs-2" name="Card_name" type="text" value="1" required>車隊卡</br>
                        <input type="radio" class="col-xs-2" name="Card_name" type="text" value="0" required>捷利卡
                    </div>
                    <div class="col-xs-12 poptext">
                        <p class="col-xs-5">電話</p>            
                        <input class="col-xs-7" type="text" name="Phone_number" required>
                    </div>
                    <div class="col-xs-12 poptext">
                        <p class="col-xs-5">住家地址</p>            
                        <input class="col-xs-7" type="text" name="Member_address">
                    </div>
                    
                    
                    <div id="newconfirm">
                        <input type="submit" value="確認新增" name = "save" onclick="closeDialog();" >
                    </div>  
                         
                </div>
                </form>  
            </div>
                    <!-- /.col-lg-12 -->
                
                <div class="row">
                    <div class="col-lg-12">
                            <div class="panel-body">
                                <form method="post" action="memberaction.php">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            
                                            <th>姓名</th>
                                            <th>性別</th>
                                            <th>生日</th>
                                            <th>卡別</th>
                                            <th>起始時間</th>
                                            <th>電話</th>
                                            <th>住家地址</th>
                                            <th>修改</th>
                                            <th>刪除</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for($i=1;$i<=mysqli_num_rows($result);$i++){
                                        $rs=mysqli_fetch_row($result);
                                ?>
                                <tbody>
                                    
                                    <tr class="odd gradeA">
                                        
                                        <td><?php echo $rs[0]?></td>
                                        <td><?php 
                                        if ($rs[1]==1){
                                            echo "男";
                                        }else
                                        echo "女"?></td>
                                        <td id ="Personal_ID"><?php echo $rs[2]?></td>
                                        <td><?php 
                                        if ($rs[3]==1){
                                            echo "車隊卡";
                                        }else
                                        echo "捷利卡"?></td>
                                        <td><?php echo $rs[4]?></td>
                                        <td hidden><?php echo $rs[7]?></td>
                                        <td><?php echo $rs[5]?></td>
                                        <td><?php echo $rs[6]?></td>
                                       
                                        <td class="center"><a class="edit">修改 </a></td>
                                        
                                        <td class="center"><a href="memberaction.php?delete=1&Customer_ID=<?=$rs[7]?>">X</a></td>
                                        
                                        
                                    </tr>
                                </tbody>
                                <?php
                                }
                                ?>
                                </table>
                            </form>
                            </div>
                            <!-- /.panel-body -->
                        </div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
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

    <!-- <script src="js/member.js"></script> -->
    <script type="text/javascript">
        $(".delete").on("click",function(){
  $(this).parent().parent().remove();
})

var td1 = "";
var td2 = "";
$(".edit").on("click",function(){
    td3 = $(this).parent().prev().prev().prev().text();
  $(this).parent().prev().prev().prev().text("");
  $(this).parent().prev().prev().prev().html("<input type='hidden' name='id'value='"+td3+"'>");
  td1 = $(this).parent().prev().prev().text();
  $(this).parent().prev().prev().text("");
  $(this).parent().prev().prev().html("<input  name ='phone' value='"+td1+"'>");
  td2 = $(this).parent().prev().text();
  $(this).parent().prev().text("");
  $(this).parent().prev().html("<input  name ='address' value='"+td2+"'>");
  $(this).parent().html("<button type='submit' class='conform' name='edit'>確認</button>");
  $(".conform").on("click",function(){
    location.reload();
  })
})

$("#dialog").css("display","none");
$("#msg").css("display","none");
$("#dialog").css("opacity","0.5");

function closeDialog(){
$("#dialog").css("display","none");
$("#msg").css("display","none");
}
function showDialog(){
   /*秀出對話框*/
$("#dialog").css("display","");
$("#msg").css("display","");
        
var w=$("#msg").width();
var h=$("#msg").height();
var _top=_sh/2-h/2+$(document).scrollTop();//更好的方法 使用jQuery解決
var _left=_sw/2-w/2;
   /*設定視窗出現位置*/  
$("#msg").css("top",_top+'px');
$("#msg").css("left",_left+'px');
}
    </script>
    
</body>

</html>
