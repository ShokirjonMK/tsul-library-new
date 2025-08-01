<?php
if (vw_p('013', 'A') || vw_p('013', 'C') || vw_p('013', 'D') || vw_p('013', 'E') || vw_p('013', 'F')){
  $str = vw_v('013', 'A');

  if (vw_p('013', 'C'))
   $str .= vw_d(", ", $str).vw_v('013', 'C');

  if (vw_p('013', 'E'))
   $str .= vw_d(", ", $str).vw_v('013', 'E');
  
  if (vw_p('013', 'D'))
   $str .= vw_d(", ", $str).vw_v('013', 'D');
  
  if (vw_p('013', 'F'))
   $str .= vw_d(", ", $str).vw_v('013', 'F');

  echo "<tr><td><b>".VW_DOC_PTNT.":</b></td><td>".$str."</td></tr>";
}
