
<?php

$count = 1;
$rank = 1;

include '../simple_html_dom.php'; //라이브러리 필요함 이 파일을 이 php 파일이 있는곳에 위치하게 해야됨
$page = file_get_html('https://play.google.com/store/apps/collection/cluster?clp=0g4jCiEKG3RvcHNlbGxpbmdfZnJlZV9BUFBMSUNBVElPThAHGAM%3D:S:ANO1ljKs-KA&gsr=CibSDiMKIQobdG9wc2VsbGluZ19mcmVlX0FQUExJQ0FUSU9OEAcYAw%3D%3D:S:ANO1ljL40zU'); // 우리가 따오고 싶은 데이터가 있는 홈페이지 주소

$valuestar = array();
$countstar = 0;

foreach ($page->find('div.pf5lIe div[role]') as $gd) {
  $temp = explode("Rated ", $gd);
  $temp1 = explode(" stars", $temp[1]);
  $valuestar[$countstar++] = $temp1[0];

}
$countstar = 0;

echo "<table class='table-fill'>";
echo "<thead>";
echo " <td colspan ='2'> 구글 플레이 스토어 어플 순위 </td>";
echo " <td>평점</td> ";
echo " <td>링크</td> </thead>";
echo "<tbody class='table-hover'>";
foreach ($page->find('div.b8cIId.ReQCgd.Q9MA7b') as $value) {
  $temp = explode("\"", $value);
  echo "<tr>";
  echo "<td class='text-left'>".$rank++."위</td>";
  echo "<td onclick='un_link(event)' class='text-left'>".$value."</td>";
  echo "<td class='star'>".$valuestar[$countstar++]."</td>";
  echo "<td><a id = 'a' target = '_blank' href = https://play.google.com".$temp[3].">어플보기</a></td>";
  echo "</tr>";
  $count ++ ;
  if($count == 21){
    break;
  }
}
echo "</tbody>";
echo "</table>";

 ?>
