var homeVue = new Vue ({
  el: "#box",
  data:{
    list:[],
  },
  mounted:function(){
    this.getData();
  },
  methods:{
    getData:function(){
      var that =this;
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
      var args = getQueryStringArgs();
      // var makeId = window.location.search.split("=")[1];
      $.ajax({
        url:"http://api.zhituteam.com/api/teacher/info/",
        type:"get",
        dataType:"json",
        data:{
          id: args["id"],
        },
        success:function(res){
          that.list = res.data;
          that.list.teacher.id = args["id"];
          // alert(args["id"])
        }  
      })
    },

  }
})