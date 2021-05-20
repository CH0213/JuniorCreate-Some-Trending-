$(window).on('load',function(){
  webpageAjax();
  setInterval(()=>{
    webpageAjax();
  },10000);
})

function go_link(event){
  var a = $(event.target).prev('td').prev('td').prev('td').text();
  $("#ifr").attr('src',`http://www.cgv.co.kr/search/?query=${a}`);
}

var data = getTodayType();

function webpageAjax(){
  var a = getTodayType();

  // POST 방식으로 서버에 HTTP 요청을 보냄.
  $.post("./webCrawling.php",
  // 서버가 필요한 정보를 같이 보냄.
  {
    id:a,
  },
    function(data)
    {
      $("#contents").html(data);
    }
    )
  }

function getTodayType(){
  var date = new Date();
  return date.getFullYear() + ("0" +(date.getMonth()+1)).slice(-2) + ("0"+(date.getDate()-1)).slice(-2);
}
