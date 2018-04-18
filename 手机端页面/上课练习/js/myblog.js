var come = new Vue({
	el: '#cont-info',
	data: {
        list: [],
	},
	mounted:function(){
        this.getData();
	},
	methods:{
		clickDel:function(item){
			var that = this;
	        var userId = window.localStorage.getItem("user_id");
			$.ajax({
				url: 'http://blog.com/api/blog/del',
				type: 'post',
				dataType:'json',
				data: {
                    user_id:userId,
                    blog_id:item.id,
				},
				success:function(res){
					if(res.error_code == 0){
						alert("删除成功");
						that.list.forEach(function(i,index){
							if(i.user_id == item.id){
								that.list.splice(index,1)
							}
						})
					}else {
						alert(res.message);
					}
				}
			})
		},
		clickWrite:function(item){
			var that = this;
	        var userId = window.localStorage.getItem("user_id");
			$.ajax({
				url: 'http://blog.com/api/blog/add',
				type: 'get',
				dataType:'json',
				data: {
                    user_id:userId,
                    blog_id:item.id,
				},
				success:function(res){
					if(res.error_code == 0){
						window.location.href="./doadd.html"
						// that.list = res.data;
					}else {
						alert(res.message);
					}
				}
			})
		},
		getData:function(){
			var that = this;
	        var userId = window.localStorage.getItem("user_id");
			$.ajax({
				url: 'http://blog.com/api/blog/myBlog',
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