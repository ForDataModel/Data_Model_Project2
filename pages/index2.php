<?php
    $db = mysqli_connect("localhost","root","root") or die("無法開啟MySQL伺服器連接!");
    $dbname = "Gastation";
    if (!mysqli_select_db($db,$dbname)) {
        die("無法開啟$dbname資料庫");
    }
    if($_POST['station_id6']!=''){
        $station_id6=$_POST['station_id6'];
        $result = mysqli_query($db,"SELECT Staff.Name, Staff.Gender, Staff.Personal_ID,Staff.Birthday,Fulltime.Salary,Station.Name,Staff.Staff_ID,Fulltime.Staff_ID
            FROM Staff 
            INNER JOIN Fulltime 
            ON Staff.Staff_ID=Fulltime.Staff_ID 
            LEFT JOIN Station 
            ON Staff.Station_ID=Station.Station_ID
            WHERE Staff.Station_ID='$station_id6'");
        $result2=mysqli_query($db,"SELECT Staff.Name, Staff.Gender, Staff.Personal_ID,Staff.Birthday,Parttime.Hourpay,Station.Name,Staff.Staff_ID
            FROM Staff 
            INNER JOIN Parttime 
            ON Staff.Staff_ID=Parttime.Staff_ID
            LEFT JOIN Station 
            ON Staff.Station_ID=Station.Station_ID
            WHERE Staff.Station_ID='$station_id6'");
    }else{
        $sql = "SELECT Staff.Name, Staff.Gender, Staff.Personal_ID,Staff.Birthday,Fulltime.Salary,Station.Name,Staff.Staff_ID,Fulltime.Staff_ID
            FROM Staff 
            INNER JOIN Fulltime 
            ON Staff.Staff_ID=Fulltime.Staff_ID 
            LEFT JOIN Station 
            ON Staff.Station_ID=Station.Station_ID";
        $result = mysqli_query($db,$sql);
        $sql2 ="SELECT Staff.Name, Staff.Gender, Staff.Personal_ID,Staff.Birthday,Parttime.Hourpay,Station.Name,Staff.Staff_ID
            FROM Staff 
            INNER JOIN Parttime 
            ON Staff.Staff_ID=Parttime.Staff_ID
            LEFT JOIN Station 
            ON Staff.Station_ID=Station.Station_ID"
            ;
        $result2 = mysqli_query($db,$sql2);
    }
    
    
    
    $sql3="SELECT Name, Station_ID FROM Station";
    $sql4="SELECT Name, Station_ID FROM Station";
    $sql5="SELECT Name, Station_ID FROM Station";
    $sql6="SELECT Name, Station_ID FROM Station";
    
    $result3 = mysqli_query($db,$sql3);
    $result4 = mysqli_query($db,$sql4);
    $result5 = mysqli_query($db,$sql5);
    $result6 = mysqli_query($db,$sql6);
    $resultarraycall=array();
    $resultarrayID=array();
    for($i=1;$i<=mysqli_num_rows($result4);$i++){
        $resultarrayName=mysqli_fetch_array($result4);
        
        array_push($resultarraycall, "$resultarrayName[0]");
        array_push($resultarrayID, "$resultarrayName[1]");
    }
    

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
    <link href="css/index.css" rel="stylesheet" type="text/css">

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
                    <h1 class="page-header">Employees</h1>
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="panel-body">
                        <div>
                        <h2>正職</h2>
                        <div class="search-container">
                            <div class="col-xs-8">
                            <button onclick="showDialog1()" class="add btn btn-default">新增</button>
                            </div>
                            
                        <form class="col-xs-4" action="index2.php" method="post">

                            
                        <select name="station_id6" >
                            <option></option>
                                    <?php
                                        for($i=1;$i<=mysqli_num_rows($result6);$i++){
                                            $rs6=mysqli_fetch_row($result6);
                                        ?>
                                    <option value="<?php echo $rs6[1]?>"><?php echo $rs6[0]?></option>
                             

                                    <?php
                                }
                                ?>
                            
                    </select>
                        <button type="submit" class="btn btn-default" style="text-align:right">搜尋站名</button>
                        </form>
                        </div>
                        </div>
                        <div class="row">
                            <div id="dialog1"></div>
                            <form method="post" action="indexaction.php">
                            <div id="msg1" class="col-xs-4 col-xs-offset-3">
                                <div>
                                    <i id="msgclose1" class="fa fa-times col-xs-1 col-xs-offset-10" aria-hidden="true" onclick="closeDialog1();"></i>
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">姓名</p>
                                    <input class="col-xs-7" type="text" name="Name">
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">性別</p>
                        
                        <input type="radio" class="col-xs-2" name="Gender" type="text" value="1">男</br>
                        <input type="radio" class="col-xs-2" name="Gender" type="text" value="0">女
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">身分證字號</p>
                                    <input class="col-xs-7" type="text" name="Personal_ID">
                                </div> <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">生日</p>
                                    <input class="col-xs-7" placeholder="yyyy-mm-dd" type="date" name="Birthday">
                                </div>
                                 <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">薪水</p>
                                    <input class="col-xs-7" type="text" name="Salary">
                                </div>
                                <div class="col-xs-12">
                                <p class="col-xs-5">加油站</p>   
                        
                                <select name="station_id">
                                    <?php
                                        for($i=1;$i<=mysqli_num_rows($result3);$i++){
                                            $rs3=mysqli_fetch_row($result3);
                                        ?>
                                    <option value="<?php echo $rs3[1]?>"><?php echo $rs3[0]?></option>
                             

                                    <?php
                                }
                                ?>
                            
                    </select>
                    
                    </div>
                                <div id="newconfirm1">
                                    <input type="submit" value="確認新增" name="save" onclick="closeDialog();" >
                                </div>
                                </form>
                            </div>
                        </div>
                        <form method="post" action="indexaction.php">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>姓名</th>
                                        <th>性別</th>
                                        <th>身份證</th>
                                        <th>生日</th>
                                        <th>薪水</th>
                                        <th>所屬加油站</th>
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
                                        <td><?php echo $rs[3]?></td>
                                        <td hidden><?php echo $rs[6]?></td>
                                        <td><?php echo $rs[4]?></td>
                                        <td><?php echo $rs[5]?></td>
                                        
                                        <td class="center"><a class="edit">修改 </a></td>
                                        
                                        <td class="center"><a href="indexaction.php?delete=1&Personal_ID=<?=$rs[2]?>">X</a></td>
                                        
                                        
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
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-body">
                        <h2>兼職</h2>
                        <div class="add">
                            <button onclick="showDialog2()" class="btn btn-default">新增</button>
                        </div>
                        <div class="row">
                            <div id="dialog2"></div>
                            <form method="post" action="indexaction.php">
                            <div id="msg2" class="col-xs-4 col-xs-offset-3">
                                <div>
                                    <i id="msgclose1" class="fa fa-times col-xs-1 col-xs-offset-10" aria-hidden="true" onclick="closeDialog2();"></i>
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">姓名</p>
                                    <input class="col-xs-7" type="text" name="Name2">
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">性別</p>
                        
                        <input type="radio" class="col-xs-2" name="Gender2" type="text" value="1">男</br>
                        <input type="radio" class="col-xs-2" name="Gender2" type="text" value="0">女
                                </div>
                                <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">身分證字號</p>
                                    <input class="col-xs-7" type="text" name="Personal_ID2">
                                </div> <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">生日</p>
                                    <input class="col-xs-7" placeholder="yyyy-mm-dd" type="date" name="Birthday2">
                                </div>
                                 <div class="col-xs-12 poptext">
                                    <p class="col-xs-5">薪水</p>
                                    <input class="col-xs-7" type="text" name="Salary2">
                                </div>
                                <div class="col-xs-12">
                                <p class="col-xs-5">加油站</p>   
                        
                                <select name="station_id2">
                                    <?php
                                        for($i=1;$i<=mysqli_num_rows($result5);$i++){
                                            $rs5=mysqli_fetch_row($result5);
                                        ?>
                                    <option value="<?php echo $rs5[1]?>"><?php echo $rs5[0]?></option>
                             

                                    <?php
                                }
                                ?>
                            
                    </select>
                    
                    </div>
                                <div id="newconfirm1">
                                    <input type="submit" value="確認新增" name="save2" onclick="closeDialog2();" >
                                </div>
                                </form>
                            </div>

                        </div>
                         <form method="post" action="indexaction.php">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>姓名</th>
                                        <th>性別</th>
                                        <th>身份證</th>
                                        <th>生日</th>
                                        <th>薪水</th>
                                        <th>所屬加油站</th>
                                        <th>修改</th>
                                        <th>刪除</th>
                                    </tr>
                                </thead>
                                <?php
                                    for($i=1;$i<=mysqli_num_rows($result2);$i++){
                                        $rs2=mysqli_fetch_row($result2);
                                ?>
                                <tbody>
                                    
                                    <tr class="odd gradeA">
                                        <td><?php echo $rs2[0]?></td>
                                        <td><?php 
                                        if ($rs2[1]=="1"){
                                            echo "男";
                                        }else
                                        echo "女"?></td>
                                        <td id ="Personal_ID"><?php echo $rs2[2]?></td>
                                        <td><?php echo $rs2[3]?></td>
                                        <td hidden><?php echo $rs2[6]?></td>
                                        <td><?php echo $rs2[4]?></td>
                                        <td><?php echo $rs2[5]?></td>
                                        <td class="center"><a class="edit2">修改</a></td>
                                        <td class="center"><a href="indexaction.php?delete=1&Personal_ID=<?=$rs2[2]?>">X</a></td>
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
    <!-- <script src="js/index.js"></script> -->
    <script type="text/javascript">
        $(".delete").on("click",function(){
  $(this).parent().parent().remove();
})
var num = <?php echo mysqli_num_rows($result3) ?>;
var arrayName = ["<?php echo join("\", \"",$resultarraycall); ?>"];
var arrayID = ["<?php echo join("\", \"",$resultarrayID); ?>"];
content = "";
content += "<select name='Station_id'>";
for(i=0; i<num; i++){
    content+="<option value='"+arrayID[i]+"' >"+arrayName[i]+"</option>";
}
content += "</select>";

var options = "<select name='station_id'> <?php for($i=1;$i<" +num + ";$i++) { 
    $rs3=mysqli_fetch_row($result3);?><option value='<?php echo $rs3[1]?>' name='Station_id'><?php echo $rs3[0]?></option> <?php } ?></select>";

//var station = $("#station").val();

var td1 = "";
var td2 = "";
var array=[1,2,3,4];
$(".edit").on("click",function(){
    td3 = $(this).parent().prev().prev().prev().text();
  $(this).parent().prev().prev().prev().text("");
  $(this).parent().prev().prev().prev().html("<input type='hidden' value='"+td3+"' name='id'>");
  td1 = $(this).parent().prev().prev().text();
  $(this).parent().prev().prev().text("");
  $(this).parent().prev().prev().html("<input value='"+td1+"' name='salary'>");
  td2 = $(this).parent().prev().text();

  $(this).parent().prev().text("");
  $(this).parent().prev().html(content);
  $(this).parent().html("<button type='submit' class='conform' name='edit'>確認</button>");
  
  $(".conform").on("click",function(){
    location.reload();
  })
})
$(".edit2").on("click",function(){
  td3 = $(this).parent().prev().prev().prev().text();
  $(this).parent().prev().prev().prev().text("");
  $(this).parent().prev().prev().prev().html("<input type='hidden' value='"+td3+"' name='id2'>");
  td1 = $(this).parent().prev().prev().text();
  $(this).parent().prev().prev().text("");
  $(this).parent().prev().prev().html("<input value='"+td1+"' name='salary2'>");
  td2 = $(this).parent().prev().text();

  $(this).parent().prev().text("");
  $(this).parent().prev().html(content);
  $(this).parent().html("<button type='submit' class='conform' name='edit2'>確認</button>");
  
  $(".conform").on("click",function(){
    location.reload();
  })
})

$("#dialog1").css("display","none");
$("#msg1").css("display","none");
$("#dialog1").css("opacity","0.5");

function closeDialog1(){
$("#dialog1").css("display","none");
$("#msg1").css("display","none");
}
function showDialog1(){
   /*秀出對話框*/
$("#dialog1").css("display","");
$("#msg1").css("display","");
        
var w=$("#msg1").width();
var h=$("#msg1").height();
var _top=_sh/2-h/2+$(document).scrollTop();//更好的方法 使用jQuery解決
var _left=_sw/2-w/2;
   /*設定視窗出現位置*/  
$("#msg1").css("top",_top+'px');
$("#msg1").css("left",_left+'px');
}

$("#dialog2").css("display","none");
$("#msg2").css("display","none");
$("#dialog2").css("opacity","0.5");

function closeDialog2(){
$("#dialog2").css("display","none");
$("#msg2").css("display","none");
}
function showDialog2(){
   /*秀出對話框*/
$("#dialog2").css("display","");
$("#msg2").css("display","");
        
var w=$("#msg2").width();
var h=$("#msg2").height();
var _top=_sh/2-h/2+$(document).scrollTop();//更好的方法 使用jQuery解決
var _left=_sw/2-w/2;
   /*設定視窗出現位置*/  
$("#msg2").css("top",_top+'px');
$("#msg2").css("left",_left+'px');
}
    </script>

</body>

</html>
