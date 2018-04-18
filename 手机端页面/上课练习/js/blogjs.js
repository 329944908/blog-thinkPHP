$(function(){
	$(".login-name").blur(function(){
    	$(".login-name").focus(function(){
        	$(".mistake").addClass("hide")
        });
	})
	$(".login-user").blur(function(){
    	$(".login-user").focus(function(){
        	$(".mistake").addClass("hide")
        });
	})
	$(".login-password").blur(function(){
    	$(".login-password").focus(function(){
        	$(".mistake").addClass("hide")
        });
	})
	function loginAction(){
		var phone = $(".login-name").val();
		var phoneLength = $(".login-name").val().length;
		var user = $(".login-user").val();
		var userLength = $(".login-user").val().length;
		var minWord = $(".login-password").val();
		var minWordLength = $(".login-password").val().length;
		var myreg=/^[1][3,4,5,7,8][0-9]{9}$/; //手机号
		var uPattern = /^[a-zA-Z0-9_-]{4,16}$/;//用户名4到16位（字母，数字，下划线，减号）
		var passWord=/^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/g;//密码用户名正则，4到16位（字母，数字，下划线，减号）
		if(phoneLength == 0){
           $(".mistake").removeClass("hide");
           $(".mistake>span").text("请输入手机号");
           return false;
		}else if(myreg.test(phone)){

		}else if(uPattern.test(minWord)){

		}else if(passWord.test(minWord)){

		}else {
            $(".mistake").removeClass("hide");
			$(".mistake>span").text("请输入有效账号");
			return false;
		}
		console.log(phone)
		if(minWordLength == 0){
           $(".mistake").removeClass("hide");
           $(".mistake>span").text("请输入密码");
           return false;
		}else{
		}
		if(userLength == 0){
           $(".mistake").removeClass("hide");
           $(".mistake>span").text("请输入用户名");
           return false;
		}else{
		}
		if(!passWord.test(minWord)){
           $(".mistake").removeClass("hide");
           $(".mistake>span").text("请输入有效密码");
           return false;
		}else{
		}
		return true;
	}
	$(".btn-login>a").click(function(){
        loginAction();
        if(loginAction() ==true){
            alert("111111")
        }
	})
	

})