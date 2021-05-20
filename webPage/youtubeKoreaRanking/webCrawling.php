<?php
echo "<table class='table-fill'>";
echo "<thead>";
echo " <td colspan ='6'>한국 유튜브 구독자 순위</td>";
echo " </thead>";
echo " <tbody class='table-hover'>";
echo " <tr>";
echo " <td>순위</td> ";
echo " <td>채널명</td> ";
echo " <td>구독자수</td> ";
echo " <td>영상개수</td> ";
echo " <td>배너이미지</td> ";
echo " </tr>";

$youtube_api_key = "AIzaSyBIs4OpNFVelD8I3XJ9uDDlevcf8e3vw3g";

/*
$url = "https://www.youtube.com/watch?v=ZY5oov1_jbo";

	parse_str( parse_url( $url, PHP_URL_QUERY ), $u_id );

	$snippet_url = "https://www.googleapis.com/youtube/v3/videos?id=".$u_id['v']."&fields=items&key=".$youtube_api_key."&part=snippet"; //채널 ID 알아낼수있음 -> 구독자수
	$statistics_url = "https://www.googleapis.com/youtube/v3/videos?id=".$u_id['v']."&key=".$youtube_api_key."&part=statistics"; // 영상 좋아요 , 댓글 수 , 조회 수

	$snippet_json = file_get_contents($snippet_url);
	$snippet_ob = json_decode($snippet_json);

   	foreach ( $snippet_ob->items as $data ){
	    $channelId = $data->snippet->channelId;	   // 채널 ID
    }

    $sub_url = "https://www.googleapis.com/youtube/v3/channels?part=statistics&id=".$channelId."&fields=items/statistics&key=".$youtube_api_key; // 구독자 수
    $sub_json = file_get_contents($sub_url);
	$sub_ob = json_decode($sub_json);
*/


  $channelId = array(
   'UCOmHUn--16B90oW2L6FRR3A', // 블랙핑크
   'UC3IZKseVpdzPSBaWxBxundA', // Big Hit Labels
   'UCLkAepWjdylmXSltofFvsYQ', // 방탄tv
   'UCEf_Bc-KVd7onSeifS3py9g', // sm tv
   'UCw8ZhLPdQ0u_Y-TLKd61hGA', // 1 million dance studio
   'UCweOkPb1wVVH0Q0Tlj4a5Pw', // 1thek
   'UCaO6TYtlC8U5ttz62hTrZgg', // jyp
   'UClkRzsdvg7_RKVhwDwiDZOA', // 제이플라
   'UCU2zNeYhf9pi_wSqFbYE96w', // 보람튜브
   'UCrDkAvwZum-UTjHmzDI2iIw', // 싸이
   'UCbD8EppRX3ZwJSou-TVo90A', //엠넷
   'UCzw-C7fNfs018R1FzIKnlaA', // 빅뱅
   'UC5BMQOsAB8hKUyHu9KI6yig', //kbs world
   'UCS3VJQpFmLbBd5qsWci9KPA', //nao fun fun
   'UCByBXiL8TC7atFvIuNC95Hg', //두두팝토이
   'UCqXwKu6dKobXEQFhdKtiJLQ', //핑크퐁
   'UC_pwIXKXNm5KGhdEVzmY60A', // 스톤뮤직
   'UCe52oeb7Xv_KaJsEzcKXJJg', // mbc kpop
   'UCepUWUpH45hRTi-QePdq1Bg', // mnet official
   'UCph-WGR0oCbJDpaWmNHb5zg', // 라바 튜바
);


for($i = 1; $i < 21; $i++){

  echo "<tr>";
  echo "<td class='text-left'>".$i."위</td>";
  //echo "<td class='text-left'>".$channelId."</td>";
  $sub_ob = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=".$channelId[$i-1]."&fields=items/statistics&key=".$youtube_api_key));
  $sub_ob2 = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=brandingSettings&id=".$channelId[$i-1]."&fields=items/brandingSettings&key=".$youtube_api_key));

    foreach ($sub_ob2->items as $data ){
      $title = $data->brandingSettings->channel->title;
      $description = $data->brandingSettings->channel->description;
      echo "<td class='text-left'>".$title."</td>"; //채널타이틀
      $count++;
    }

    foreach ($sub_ob->items as $data ){
      $subscriberCount = $data->statistics->subscriberCount;//구독자수
      $videoCount = $data->statistics->videoCount;//영상 갯수
      echo "<td class='text-left'> ".$subscriberCount."</td>";
      echo "<td class='text-left'> ".$videoCount."</td>";
      $count++;
    }

    foreach ($sub_ob2->items as $data ){
      $image2 = $data->brandingSettings->image->bannerMobileLowImageUrl;//배너이미지
      echo "<td><img class='img' src=".$image2."></td>";
    }

  echo "</tr>";

}

echo "</tbody>";
echo "</table>";
?>
