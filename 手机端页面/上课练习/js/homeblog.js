var homeBlog = new Vue({
	el: "#box-content",
	data: {
       list:[],
       lista: [],
       banner: [],
       blog: [],
       blog: '登录',
       isBlog: true,
	},
	mounted:function(){
		this.getData();
	},
	methods:{
		clickcage:function(itema){
             var that = this;
             console.log(itema.classify_id)
			$.ajax({
				url: "http://blog.com/api/blog/lists",
			    type: "get",
	           	dataType: "json",
				data: {
                    classify_id:itema.classify_id,
				},
				success:function(res){
                that.lista = res.data;
		        }
			})
		},
		getData:function(){
		    var that = this;
			$.ajax({
				url: "http://blog.com/api/index/index",
			    type: "get",
	           	dataType: "json",
				data: {
				},
				success:function(res){
                that.list = res.data;
                that.lista =res.data;
	            that.banner = res.data.banner;
	            that.swiperBanner();
	            var userId = window.localStorage.getItem("user_id");
			    var name = window.localStorage.getItem("user_name");
			    var img = window.localStorage.getItem("user_img");
			    console.log(userId)
			    console.log(name)
                if(name == null){
                   that.isBlog = true;
                }else {
                    that.isBlog = false;
                    that.blog = name;
                }
		        }
			})
		},
		swiperBanner:function(){
	        var mySwiper = new Swiper ('.swiper-container', {
	          loop: true,
	          observer: true,
	          // 如果需要分页器
	          pagination: {
	            el: '.swiper-pagination',
	        },
        }) 
    }
	}
})