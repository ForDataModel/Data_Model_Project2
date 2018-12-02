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
