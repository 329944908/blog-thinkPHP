var regisr = new Vue({
	el: '#box-login',
	data: {
        regisrtPhone: null,
        regisrtUser: null,
        regisrtPassword: null,
	},
	mounted:function(){
       this.getData();
	},
	methods:{
		clickReist:function(){
           this.regisrtUser = this.$refs.inputName.value;
           this.regisrtPhone = this.$refs.inputPhone.value;
           this.regisrtPassword = this.$refs.inputPassword.value;
           var data = {
           	   'phone': this.regisrtPhone,
           	   'password':this.regisrtPassword,
           	   'uname': this.regisrtUser,
           	   'format':'json',
           }
           this.getData(data);
		},
		getData:function(dataJson){
			var that = this;
            $.ajax({
            	url: 'http://blog.com/api/user/doReg',
            	type: 'post',
            	data: dataJson,
            	success:function(res){
                    
            	}
            })
		}
	}
})