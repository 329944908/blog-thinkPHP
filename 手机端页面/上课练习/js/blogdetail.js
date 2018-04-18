function getQueryStringArgs(){
    var qs=(location.search.length > 0 ? location.search.substring(1) : "");
    var args={};
    itemm = qs.length ? qs.split("&") : [],
    console.log(itemm)
    item=null,
    name=null,
    value=null,
    i=0;
    len=itemm.length;
    for(i=0;i<len;i++){
         item = itemm[i].split("=");
         name = decodeURIComponent(item[0]);
         value = decodeURIComponent(item[1]);
         if(name.length){
             args[name] = value;
         }
     }
    return args;
}
var blogDetail = new Vue({
	el: "#blogDetail",
	data:{
       isShow: false,
       isShowWords:false,
       list:[],
       blog: [],
       blog: '登录',
       show: '收藏',
       isBlog: true,
       isClick: true,
       isBg: false,
	},
	mounted:function(){
        this.getData();
	},
	methods:{
        makeCome:function(){
            
            // this.isClick = false;
            var blogId = window.location.search.split("=")[1];
            var userId = window.localStorage.getItem("user_id");
            var that = this;
            setTimeout(function(){
                that.isClick = true;
            },3000);
            $.ajax({
                url: 'http://blog.com/api/collect/add',
                type: 'post',
                dataType: 'json',
                data: {
                   user_id:userId,
                   blog_id:blogId,
                },
                success:function(res){
                    console.log(res.error_code)
                    if(res.error_code == 0){
                        that.isBg = true;
                        that.isClick = false;
                        that.show = '已收藏'
                        // alert("该文章已收藏")
                    }
                    else{
                        that.isBg = false;
                        that.isClick = false;
                        that.show = '收藏';
                    }
                }
            })
        },
		clickAll:function(){
            this.isShow = true;
		},
		clickAllWords:function(){
            this.isShowWords = true;
		},
        myBlogNew:function(){
            var userId = window.localStorage.getItem("user_id");
            var that = this;
            $.ajax({
                url: 'http://blog.com/api/blog/myBlog',
                type: 'post',
                dataType: 'json',
                data: {
                    user_id: userId,
                },
                success:function(res){
                    window.location.href="./blogpeople.html"
                    // console.log(that.list)
                }
            })
        },
		getData:function(){
			var infoId = getQueryStringArgs().id;
            var userId = window.localStorage.getItem("user_id");
            var name = window.localStorage.getItem("user_name");
            var img = window.localStorage.getItem("user_img");
			var that = this;
            $.ajax({
            	url: 'http://blog.com/api/blog/info',
            	type: 'get',
            	dataType: 'json',
            	data: {
                    id: infoId,
                    user_id: userId,
            	},
            	success:function(res){
                    if(res.data.blog_info.collect_status == 1){
                        that.isClick = false;
                        that.isBg = true;
                        that.show = '已收藏'
                    }
                    else if(res.data.blog_info.collect_status == -1){
                        that.isClick = false;
                        alert("请登录！")
                    }
                    if(name == null){
                       that.isBlog = true;
                    }else {
                        that.isBlog = false;
                        that.blog = name;
                    }
                    that.isBlog = false;
                    that.blog = name;
                    that.list = res.data.blog_info;
                    that.related = res.data.related_blog;
                    // console.log(that.list)
            	}
            })
		}
	}
})