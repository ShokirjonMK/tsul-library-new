<?php
if (vw_p('773', 'A') || vw_p('773', 'T') || vw_p('773', 'D') || vw_p('773', 'G')){
  $str = vw_v('773', 'A');

  if (vw_p('773', 'T'))
   $str .= vw_d(", ", $str).vw_v('773', 'T');

  if (vw_p('773', 'D'))
   $str .= vw_d(", ", $str).vw_v('773', 'D');
  
  if (vw_p('773', 'G'))
   $str .= vw_d(", ", $str).vw_v('773', 'G');

  echo "<tr><td><b>".VW_DOC_PARENT.":</b></td><td>".$str."</td></tr>";
}
