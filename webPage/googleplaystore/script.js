$(window).on('load',function(){
  webpageAjax();
})

function go_link(event){
    var a = $(event.target).prev('td').prev('td').find("a").attr('href');
    a = "https://play.google.com"+a;
    window.location = a;
}

function un_link(event){
  event.preventDefault();
}

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
