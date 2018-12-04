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

$(".item").on("click",function(){
	window.location.href="storage.html";
})