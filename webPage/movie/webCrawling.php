<?php
    $client_secret = "ff32a090cbc342f38a1ffdd2b6576e5e"; // 시크릿 키 저장
    $url = "http://www.kobis.or.kr/kobisopenapi/webservice/rest/boxoffice/searchDailyBoxOfficeList.json"; // REST 방식의 json url 따오기
    $today = $_POST['id'];
    $target_date=$today; // 타겟 날짜 설정

    $address = $url."?key=".$client_secret."&targetDt=".$target_date; // 응답 예시에서 본 양식 대로 정의
    $contents= file_get_contents($address); // 해당 url을 string으로 읽는 함수
    $obj = json_decode($contents,true); // json 객체로 변환

    echo "<table class='table-fill'>";
    echo "<thead>";
    echo " <td colspan ='2'> 박스 오피스 순위(".$today.")</td>";
    echo " <td>누적관객수</td> ";
    echo " <td>누적매출액</td> ";
    echo " <td>링크</td> ";
    echo "</thead>";
    echo "<tbody class='table-hover'>";

  for($i=1; $i<11; $i++){ // 먼저 var_dump로 구조를 읽고 차근차근 따라서 정의해 보면 됨
    echo "<tr>";
    echo "<td>".$i."위</td>";
    echo '<td class="text-left"><a target = "_blank" href = "http://www.cgv.co.kr/search/?query='.$obj["boxOfficeResult"]["dailyBoxOfficeList"][$i-1]["movieNm"].'">'.$obj["boxOfficeResult"]["dailyBoxOfficeList"][$i-1]["movieNm"].'</a></td>';
    echo "<td class='text-left'>".$obj["boxOfficeResult"]["dailyBoxOfficeList"][$i-1]["audiAcc"]."명</td>";
    echo "<td class='text-left'>".$obj["boxOfficeResult"]["dailyBoxOfficeList"][$i-1]["salesAcc"]."원</td>";
    echo "<td onclick='go_link(event)'>영화상세보기</td>";
    echo "</tr>";
  }

    echo "</tbody>";
    echo "</table>";

?>
