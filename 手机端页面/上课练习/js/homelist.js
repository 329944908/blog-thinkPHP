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
var homeList = new Vue({
	el: "#box-list",
	data: {
       lists:[],
       condition:null,
       list:[],
       sub:[],
       teacherType: [],
       subject:[],
       searchGrade :null,
       searchSub :null,
       searchType :null,
       isShowAllSelect:false,
       isSelected: false,
       isShowGrade: false,
       isShowSub: false,
       isShowType: false,
	     teacherType: '教师类型',
       grade: '年级',
       sub: getQueryStringArgs().subject ? getQueryStringArgs.subject : '学科',
	},
	mounted:function(){
		this.searchSub = getQueryStringArgs().id;
		this.sub = getQueryStringArgs().name;
		var data = {
            'subject': this.searchSub,
            'offset': 0,
            'limit': 20,
       	}
		this.getData(data);
	},
	methods:{
		//tab 切换
		blurGrade:function(){
            this.isShowAllSelect = true;
			this.isShowGrade = true;
			this.isShowType = false;
			this.isShowSub = false;
		},
		blurSub:function(){
            this.isShowAllSelect =true;
			this.isShowGrade = false;
			this.isShowType = false;
			this.isShowSub = true;
		},
		blurType:function(){
            this.isShowAllSelect =true;
			this.isShowGrade = false;
			this.isShowType = true;
			this.isShowSub = false;
		},
		clickIndex:function(itemp){
			    this.condition.grade.forEach(function(t){
	            t.isSelected = false;
	        })
	        this.condition.subject.forEach(function(t){
	            t.isSelected = false;
	        })
	        this.condition.type.forEach(function(t){
	            t.isSelected = false;
	        })
			      itemp.isSelected = true;
            this.isShowAllSelect = false;
			      if(this.isShowGrade){
                this.grade = itemp.label;
                this.searchGrade = itemp.id;
            }
            if(this.isShowSub){
                this.sub = itemp.label;
                this.searchSub = itemp.id;
            }
            if(this.isShowType){
                this.teacherType = itemp.label;
                this.searchType =itemp.id;
            }
            var data = {
            	'grade': this.searchGrade,
              'type': this.searchType,
              'subject': this.searchSub,
            	'limit':0,
            	'offset':20,
            }
            this.getData(data)
	    },
		getData:function(dataJson){
		    var that = this;
            $.ajax({
	           	url: "http://api.zhituteam.com/api/teacher/lists",
	           	type: "get",
	           	dataType: "json",
	           	data: dataJson,
	           	success:function(res){
	                that.lists = res.data;
	           		if(that.condition == null){
	           			 res.data.condition.grade.forEach(function(itemp){
	                        itemp.isSelected = false;
		           		})
		           		res.data.condition.subject.forEach(function(itemp){
	                        itemp.isSelected = false;
		           		})
		           		res.data.condition.type.forEach(function(itemp){
	                        itemp.isSelected = false;
		           		})
	                    that.condition = res.data.condition;
                        that.condition.subject.forEach(function(k){
                            if(that.searchSub == k.id){
                            	console.log(that.sub)
                            	that.sub = k.label;
                                that.isShowSub = true;
                                k.isSelected = true;
                                // that.isShowAllSelect = true;
                            }
                        })
	           		}
	           	}
           })
		}
	}
})