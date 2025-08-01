<?php
if (vw_p('245', 'A') || vw_p('245', 'B') || vw_p('245', 'C') || vw_p('245', 'H')) {
 
  $str = vw_v('245', 'A');
  $str .= vw_d(", ", $str).vw_v('245', 'B');
  $str .= vw_d(", ", $str).vw_v('245', 'C');
  $str .= vw_d(", ", $str).vw_v('245', 'H');
  
  echo "<tr><td><b>".VW_DOC_CAPT.":</b></td><td>$str</td></tr>";
}