$(window).on('load',function(){
  webpageAjax();
});
/*
function go_link(event){
  var a = $(event.target).prev('td').find("a").text();
  $("#ifr").attr('src',`http://www.donga.com/news/search?query=${a}&x=0&y=0`);
}
*/
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
