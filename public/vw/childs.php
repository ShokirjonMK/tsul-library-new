<?php
$btype     = vw_garr('B_TYPE');

$books     = vw_garr(B_CHILDS);
$childs_id = vw_garr('B_CHILDS_ID');

if(is_array($books) && count($books) > 0):
  global $__vw_p;
  $___main_arr = vw_get(); // $__vw_p;
  $copies = array();
  
  for($i = 0; $i < count($books); $i++){
      vw_change($books[$i]); //$__vw_p = $books[$i];
      
      $cnt = vw_cnt(245, 'A');
      if ($cnt > 1){
         $cptn = "";
         for ($j = 0; $j < $cnt; $j++){
           if ($cptn != "")
               $cptn .= "; ";
           $cptn .= vw_v(245, 'A', $j).vw_add(" : ", vw_v(245, 'B', $j));
         }
         if ($btype == "jurn")
            $copies[] = vw_add(vw_v(260, 'C'), ", ").vw_add(vw_v(245, 'N'), ".- ").vw_v(245, 'F').
              vw_add(".- ", vw_v(300, 'A')).vw_add(".- ", vw_v(500, 'A')).vw_add(". - ISBN ", vw_v('020', 'A')) ;
             else
            $copies[] = vw_add(vw_v(773, 'G'), " : ").$cptn.vw_add(".- ", vw_v(260, 'C')).
              vw_add(".- ", vw_v(300, 'A')).vw_add(" : ", vw_v(300, 'B')).vw_add(". - ISBN ", vw_v('020', 'A')) ;
      } else {
         if ($btype == "jurn")
           $copies[] = vw_add(vw_v(260, 'C'), ", ").vw_add(vw_v(245, 'N'), ".- ").vw_v(245, 'F').
              vw_add(".- ", vw_v(300, 'A')).vw_add(".- ", vw_v(500, 'A')).vw_add(". - ISBN ", vw_v('020', 'A')) ;
             else
           $copies[] = vw_add(vw_v(773, 'G'), " : ").vw_v(245, 'A').vw_add(" : ", vw_v(245, 'B')).vw_add(".- ", vw_v(260, 'C')).
              vw_add(".- ", vw_v(300, 'A')).vw_add(" : ", vw_v(300, 'B')).vw_add(". - ISBN ", vw_v('020', 'A')) ;
      }
    }

  vw_change($___main_arr); // $__vw_p = $___main_arr;
  
  echo "<br />";
  if(vw_rdr_v() && count($copies) > 0)
      echo '<b>'.vw_word ('VW_INDEX').'</b><br />';

  foreach($copies as $key => $val)
      if(trim($val) != "") {
        if (vw_rdr_v()) {
          echo "<br>&nbsp;&nbsp;&nbsp;";
          echo "<a href='index.php?sub=tools&work=book_view_rdr&idobj=".sys_encode($childs_id[$key])."'>";
          echo $val;  
          echo "</a>";
        }  else
          echo "<br>&nbsp;&nbsp;&nbsp;".$val;
      }
  
endif;
