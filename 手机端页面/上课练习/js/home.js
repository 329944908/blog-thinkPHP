var homeVue = new Vue ({
  el: "#box",
  data:{
    list:[],
    banner:[],
  },
  mounted:function(){
    this.getData();
  },
  methods:{
    getData:function(){
      var that =this;
       $.ajax({
         url:"http://api.zhituteam.com/api/index",
         type:"get",
         dataType:"json",
         success:function(res){
          that.list = res.data;
          var newBannerList = [];
          for(var i = 0;i<5;i++){
            newBannerList = newBannerList.concat(res.data.banner)
          }
          that.banner = newBannerList;
          that.swiperBanner();
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
// $(function(){
// 	$.ajax({
// 		url: "http://api.zhituteam.com/api/index",
// 		type: "get",
// 		dataType: "json",
// 		success:function(res){
// 			var str="";
// 			var qstr=""; 
// 			var kstr="";
//             for(var i=0; i<res.data.teacher.length; i++){
//             	for(var j=0; j<res.data.teacher[i].subject.length; j++){
//            	    	var bgColor= res.data.teacher[i].subject[j].label;
//            		    qstr +='<a href="javascript:void(0)" class="a-chlid">'+bgColor+'</a>'      
//            	    }
//            	    for(var k=0; k<res.data.teacher[i].grade.length; k++){
// 	           		kstr +='<a href="javascript:void(0)" class="a-border">'+res.data.teacher[i].grade[k].label+'</a>'
//            		}
// 	            str +='<div class="new-teacher"><img src="'+res.data.teacher[i].image+'" alt=""><div class="teacher-text"><p><span>'+res.data.teacher[i].name+'</span><span class="subject">'+qstr+'</span><span class="grade">'+kstr+'</span><span class="span-last">已售200课时</span></p><p class="text-age">九年教龄</p><p><span><i></i>专职教师</span><span><i></i>已认证</span><span><i></i>明星教师</span></p></div></div>'
//                 qstr="";
//                 kstr="";
//             }
//             $(".teacher").html(str);
//             var lstr="";
//             for(var l=0; l<res.data.subjects.length; l++){
//             	lstr +='<a href="javascript:void(0)"><img src="'+res.data.subjects[l].icon+'" alt=""><span>'+res.data.subjects[l].name+'</span></a>';
//             }
//             $(".nav-number").html(lstr);
//             var mstr="";
//             for(var m=0; m<res.data.banner.length; m++){
//             	mstr +='<a href="javascript:void(0)" class="swiper-slide main-slide"><img src="'+res.data.banner[m].image+'" alt=""></a>'
//             }
//             $(".swiper-wrapper").html(mstr);
// 		},
// 		error:function(res){
//            alert(111);
// 		},
// 	})
// })