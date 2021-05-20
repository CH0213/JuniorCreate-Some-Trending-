<?php

   echo "<table class='table-fill'>";
   include '../simple_html_dom.php';
   $count = 1;
   $page5 = file_get_html('https://www.tiobe.com/tiobe-index/');
   echo "<thead> <td colspan ='2'> 프로그래밍 언어 순위 </td> </thead>";
   echo "<tbody class='table-hover'>";
   foreach ($page5->find('table#top20 tr') as $value) {
     $temp1 = explode("</td>",$value);
     $temp2 = explode("</td>",$temp1[3]);
     $temp3 = explode("<td>", $temp2[0]);
     echo "<tr>";
     echo "<td class='text-left'>".$count.'위'."<br></td>";
     echo "<td class='text-left'><a target = \"_blank\" href ='https://www.tiobe.com/tiobe-index/'>".$temp3[1]."</a></td>";
     echo "</tr>";

     $count++;
     if($count == 21){
       break;
     }
   }
   echo "</tbody>";
   echo "</table>";
  ?>
