var login = new Vue({
	el: '#box-login',
	data: {
       makePhone: null,
       makePassword: null,
       list: [],
       isHaha: false,
       mistake: null,
	},
	mounted:function(){
       // this.getData();
	},
	methods:{
		phoneToll:function(){
           this.makePhone = this.$refs.input1.value;
           this.makePassword = this.$refs.input2.value;
           var data = {
           	   'phone': this.makePhone,
           	   'password': this.makePassword,
           	   'format': "json",
           }
          var phone = this.makePhone ;
          var phoneLength = this.makePhone.length;
          var minWord = this.makePassword;
          var minWordLength = this.makePassword.length;
          var myreg=/^[1][3,4,5,7,8][0-9]{9}$/; //手机号
           var uPattern = /^[a-zA-Z0-9_-]{4,16}$/;//用户名4到16位（字母，数字，下划线，减号）
           var passWord=/^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/g;//密码用户名正则，4到16位（字母，数字，下划线，减号）
          if(phoneLength == 0 || minWordLength == 0){
            // this.isHaha = true;
              alert("手机密码为空")              
            return false;
          }
          if(!myreg.test(phone)){
            // this.isHaha = true;
              alert("手机格式错误")              
            return false;
          }
          if(!uPattern.test(minWord)){
            // this.isHaha = true;
              alert("密码格式错误")              
            return false;
          }
          this.getData(data);
          this.isHaha = false;
          console.log(this.isHaha);
          console.log(phoneLength);
		},
		getData:function(dataJson){
            var that = this;
            $.ajax({
            	url: "http://blog.com/api/user/doLogin",
            	type: "post",
            	dataType:"json",
            	data:dataJson,
            	success:function(res){
              alert(1111)
              console.log(res)
              console.log(res.data)
              window.localStorage.setItem("user_id",res.data.user.userid);
              window.localStorage.setItem("user_name",res.data.user.username);
              window.localStorage.setItem("user_img",res.data.user.userimg);
              window.history.back(-1);
            	}
            })
		}
	}
})