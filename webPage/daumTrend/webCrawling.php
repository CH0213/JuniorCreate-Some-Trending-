<?php
include '../simple_html_dom.php'; //라이브러리 필요함 이 파일을 이 php 파일이 있는곳에 위치하게 해야됨
echo "<table class='table-fill'>";
$count = 1;
$rank = 1;
$page2 = file_get_html('https://www.daum.net/');
echo "<thead> <td colspan ='3'>한국 다음 실시간 검색어 </td> </thead>";
echo "<tbody class='table-hover'>";
foreach ($page2->find('ol.list_hotissue li span.txt_issue a.link_issue') as $value) {
  $value->target = "_blank";
  if($count % 2 == 1){
    $temp = $count/2 + 0.5;
    echo "<tr>";
    echo "<td class='rankcol'> ".$rank++."위</td>";
    echo  "<td class='daumvalue'>".$value."</td>"; //받아온거 출력
    echo "<td onclick='go_link(event)'>뉴스기사보기</td>";
    echo "</tr>";
  }
  $count++;
  if($count == 21){
    break;
  }
}
echo "</tbody>";
echo "</table>";
   ?>
