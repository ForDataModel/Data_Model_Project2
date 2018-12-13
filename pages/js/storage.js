

$(function(){
    $("#dialog1").css("display","none");
    $("#dialog1").css("opacity","0.5");
    $("#msg1").css("display","none");
})

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

$(function(){
    $("#dialog2").css("display","none");
    $("#msg2").css("display","none");
    $("#dialog2").css("opacity","0.5");
})


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
