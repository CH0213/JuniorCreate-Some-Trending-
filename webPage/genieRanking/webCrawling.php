<?php
       include '../simple_html_dom.php';
       echo "<table class='table-fill'>";
       $count = 1;
       $page7 = file_get_html('https://www.genie.co.kr/chart/top200');
       echo "<thead > <td colspan ='3'> 지니 차트 순위 </td> </thead>";
       echo "<tbody class='table-hover'>";
       echo "<tr>";
       echo "<td class='text-left'>순위</td>";
       echo "<td class='text-left'>노래</td>";
       echo "<td class='text-left'>가수</td>";
       echo "</tr>";

       $title = [];
       $artist = [];
       foreach ($page7->find('table.list-wrap tr.list td.info a.title.ellipsis') as $value) {
         $temp1 = explode(">",$value);
         $title[$count] = $temp1[1];

         $count++;
         if($count == 51){
           break;
         }
       }
       $count = 1;
       foreach ($page7->find('table.list-wrap tr.list td.info a.artist.ellipsis') as $value) {
         $temp1 = explode(">",$value);
         $artist[$count] = $temp1[1];

         $count++;
         if($count == 51){
           break;
         }
       }

       for($i = 1; $i < 51;$i ++ ){
         echo "<tr>";
         echo "<td class='text-left'>".$i."위</td>";
         echo "<td class='text-left'><a target = '_blank' href ='https://www.genie.co.kr/chart/top200'>".$title[$i]."</a></td>"; //받아온거 출력
         echo "<td class='text-left'><a target = '_blank' href ='https://www.genie.co.kr/chart/top200'>".$artist[$i]."</a></td>"; //받아온거 출력
         echo "</tr>";

       }
       echo "</tbody>";
       echo "</table>";
          ?>
