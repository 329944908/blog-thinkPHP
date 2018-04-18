var people = new Vue({
	el: '#people',
	data: {
       isPeople: true,
       blog: [],
       name: '',
       img: '',
	},
	mounted:function(){
       this.getData();
	},
	methods:{
		peopleNo:function(){
          window.localStorage.clear();
		},
		getData:function(){
            var that = this;
            var userId = window.localStorage.getItem("user_id");
			var name = window.localStorage.getItem("user_name");
			var image = window.localStorage.getItem("user_img");
            console.log(userId)
            console.log(name)
			$.ajax({
				url:'http://blog.com/api/collect/lists',
				type:'post',
				dataType:'json',
				data:{
                   user_id:userId,
				},
				success:function(res){
                    that.isPeople = false;
                    that.isBlog = false;
                    that.name = name;
                    that.blog = name;
                    that.img = image;
                    if(name == null){
                        that.isBlog = true;
	                }else {
	                    that.isBlog = false;
	                    that.blog = name;
	                }
				}
			})
		}
	}
})