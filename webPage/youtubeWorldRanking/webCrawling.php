<?php
echo "<table class='table-fill'>";
echo "<thead>";
echo " <td colspan ='6'>세계 유튜브 구독자 순위</td>";
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
$url = "https://www.youtube.com/watch?v=8EJ3zbKTWQ8";

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
   'UCq-Fj5jknLsUf-MWSy4_brA', // t-series
   'UC-lHJZR3Gqxm24_Vd_AJ5Yw', // 퓨디파이
   'UCbCmjCuTUZos6Inko4u57UQ', // 코코멜론
   'UC295-Dw_tDNtZXFeAPAW6Aw', // 5-minutes-craft
   'UCpEhnqL0y41EpW2TvWAHD7Q', // set-India
   'UCffDXn7ycAzwL2LDlbyWOTw', // canal kondZilla
   'UCJ5v_MCY6GNUBTO8-D3XoAg', // WWE
   'UCFFbwnve3yF62-tVXkTyHqg', // zee-music company
   'UCHkj014U2CQ2Nv0UZeYpE_A', // justinBieber
   'UCRijo3ddMTht_IHyNSNXpNQ', // Dude perfect
   'UCJplp5SjeGSdVdwsfb9Q7lQ', // Like Nastya Vlog
   'UCk8GzjMOrta8yxDcKfylJYw', // Kids Diana Show
   'UC0C-w0YjGpqDXGB8IHb662A', // ed sheeran
   'UCEdvpU2pFRCVqU6yIPyTpMQ', // mashmello
   'UCYWOjHweP2V-8kGKmmAmQJQ', // badabun
   'UC20vb-R_px4CguHzzBPhoyQ', // 에미넴
   'UCZJ7m7EnCNodqnu5SAtg8eQ', // 홀라소이 절맨
   'UCppHT7SZKKvar4Oc9J4oljQ', // zee tv
   'UC0VOyT2OCBKdQhF3BAbZ-1g', // 아리아나 그란데
   'UC3KQ5GWANYF8lChqjZpXsQw', //  whinderssonnunes
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
