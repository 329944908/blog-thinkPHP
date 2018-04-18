$(function(){
	$(".box-example>a").click(function(){
		$(this).addClass("bg-color").siblings().removeClass("bg-color");
	})
	$.ajax({
		url: "/clinic/v4/%s/assist/detail/",
		type: "get",
		dataType: "json",
		success:function(res){
           
		},
		error:function(res){

		}
	})
})