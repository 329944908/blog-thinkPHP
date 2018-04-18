window.onload = function(){
	var mySwiper = new Swiper('.swiper-container',{
		loop : true,
		autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        },
		// pagination: {
  //           el: '.swiper-pagination',
  //           clickable: true,
  //       },
        observer:true,
    	observeParents:true,
		})
}
