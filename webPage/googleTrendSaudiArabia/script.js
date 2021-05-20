$(window).on('load',function(){
  webpageAjax();
  setInterval(()=>{
    webpageAjax();
  },1000000);
})

function webpageAjax(){
  $.ajax({
    type:"GET",
    url:"./webCrawling.php",
    beforeSend:function(){
      $(".loading-modal").css('display','block');
    },
    success:function(result){
      $("#contents").html(result);
    },
    complete:function(){
      $(".loading-modal").css('display','none');
    },
  });
}
