var come = new Vue({
	el: '#cont-info',
	data: {
        list: [],
	},
	mounted:function(){
        this.getData();
	},
	methods:{
		getData:function(){
			var that = this;
	        var userId = window.localStorage.getItem("user_id");
			$.ajax({
				url: 'http://blog.com/api/collect/lists',
				type: 'post',
				dataType:'json',
				data: {
                    user_id:userId,
				},
				success:function(res){
                   that.list = res.data;
				}
			})
		}
	}
})