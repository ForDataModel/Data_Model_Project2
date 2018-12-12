var addHover = function(){
	$(".add img").hover(function(){
		$(".add").animate({
			"padding-top": "40%",
		},200);
		var wValue=1.5 * $(this).width();
		var hValue=1.5 * $(this).height();		
		$(this).stop().animate({
			width: wValue,
			height: hValue,
			left:("-"+(0.5 * $(this).width())/2),
			top:("-"+(0.5 * $(this).height())/2)
		},200);
	},function(){
		$(".add").animate({
			"padding-top": "50%",
		},200);
		$(this).stop().animate({
			width: "50%",
			height: "100%",
			left:"0px",
			top:"0px"
		},200);
	});
}

$(function(){
	addHover();
});

var items = 6;
var addRow = "<div class='col-lg-12'></div>";
var addMark = "<div class='col-lg-3 box'><div class='add'><img src='img/add.png' width='50%' height='100%'></div></div>";
var addItem = "<div class='col-lg-3 box item'><div class='img'><a href='#'><img src='img/1.jpg' width='100%'></a></div><hr><div class='text'><p>泰山加油站</p><p>新北市泰山區泰林路二段424號</p><p>02-2909-7921</p></div></div>";
$(".add img").on("click",function(){
	items += 1;
	if(items%3 == 1){
		$(this).parent().parent().parent().parent().append(addRow);
		$(this).parent().parent().parent().next().html(addMark);
		$(this).parent().parent().parent().append(addItem);
		$(this).parent().parent().remove();
	}
	addHover();
})
/*
$(".item").on("click",function(){
	var stationName = $(".stationName").text();
	window.location.href="storage.php?stationName="+stationName;
})
*/
$(".delete").on("click",function(){
  $(this).parent().parent().remove();
})

var td1 = "";
var td2 = "";
$(".edit").on("click",function(){
  td1 = $(this).parent().prev().prev().text();
  $(this).parent().prev().prev().text("");
  $(this).parent().prev().prev().html("<input value='"+td1+"'>");
  td2 = $(this).parent().prev().text();
  $(this).parent().prev().text("");
  $(this).parent().prev().html("<input value='"+td2+"'>");
  $(this).parent().html("<button class='conform'>確認</button>");
  $(".conform").on("click",function(){
    location.reload();
  })
})

$(document).ready(function(){
	$("#dialog").css("display","none");
	$("#msg").css("display","none");
	$("#dialog").css("opacity","0.5");
});

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

$("#uploadImage").change(function(){
      readImage( this );
    });
 
    function readImage(input) {
      if ( input.files && input.files[0] ) {
        var FR= new FileReader();
        FR.onload = function(e) {
          //e.target.result = base64 format picture
          $('#img').attr( "src", e.target.result );
        };       
        FR.readAsDataURL( input.files[0] );
      }
    }