
        <?php
        include '../simple_html_dom.php'; //라이브러리 필요함 이 파일을 이 php 파일이 있는곳에 위치하게 해야됨
        echo "<table class='table-fill'>";
        $data = file_get_contents("https://trends.google.co.kr/trends/trendingsearches/daily/rss?geo=FR");
        $item_arr = explode("<item>",$data);
        $temp = [];
        $index = 0;
        $now_day = [];

        for($ii=1; $ii<25; $ii++) {

          $link_exp = explode("<link>",$item_arr[$ii]);
          $link = explode("</link>",$link_exp[1]);
          $temp[$ii] = $link[0];

          $pubdate_exp = explode("<pubDate>",$item_arr[$ii]);
          $pubdate = explode("</pubDate>",$pubdate_exp[1]);

          if($ii == 1){
            $tday = explode(" ",$pubdate[0]);
            $now_day[0] = $tday[0];
            $now_day[1] = $tday[1];
            $now_day[2] = $tday[2];
            $now_day[3] = $tday[3];
          }

          $tday = explode(" ",$pubdate[0]);
          if($now_day[0] != $tday[0] || $now_day[1] != $tday[1] || $now_day[2] != $tday[2] || $now_day[3] != $tday[3]){
            $index = $ii;
            break;
          }

        }

        $count = 1;
         $google = [];
         $google_link = [];
         $kkk = [];
         $page3 = file_get_html('https://trends.google.co.kr/trends/trendingsearches/daily/rss?geo=FR');
        echo "<thead> <td colspan ='2'> 프랑스 실시간 검색어 </td> </thead>";
        echo "<tbody class='table-hover'>";
         foreach ($page3->find('item title') as $value) {
           $str = "'".$value."'";
           $pattern = '#<title>(.*?)</title>#';
           preg_match($pattern, $str, $matches);

           $headers = array('Authorization: KakaoAK 425cb5774afde5b4051ac2ae240a5826');
           $host = 'https://kapi.kakao.com/v1/translation/translate';

           $src_lang = "fr";
           $target_lang = "kr";
           $post = $matches[1];
           $post_query = '&src_lang='.$src_lang.'&target_lang='.$target_lang.'&query='.urlencode($post);

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_URL, $host);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $post_query);
           $json = curl_exec($ch);
           $a = explode('["',$json);
           $a1 =  explode('"]',$a[1]);
           $kkk[$count] = $matches[1];
           $google[$count] = $a1[0];
           $count++;
           if($count == 21){
             break;
           }
         }

         $count = 1;
         $page3_1 = file_get_html('https://trends.google.co.kr/trends/trendingsearches/daily/rss?geo=FR');
         foreach ($page3_1->find('item ht:news_item_url') as $value) {
           $str = "'".$value."'";
           $pattern = '#<ht:news_item_url>(.*?)</ht:news_item_url>#';
           preg_match($pattern, $str, $matches);
           $google_link[$count] = $matches[1];
           $count++;
           if($count == 21){
             break;
           }
         }

         for($i = 1; $i < $index; $i++){
           echo "<tr>";
           echo "<td class='text-left'>".$i.'위'."<br></td>";
           echo "<td class='text-left'>".'<a target = "_blank" href = "'.$temp[$i].'">'.$google[$i].'('.$kkk[$i].')</a>'."<br></td>";
           echo "</tr>";
         }
         echo "</tbody>";
         echo "</table>";
         ?>
