<?php
if (vw_p('502', 'A') || vw_p('502', 'Ò') || vw_p('502', 'C') || vw_p('502', 'D')
        || vw_p('502', 'E') || vw_p('502', 'B')){
  $str = vw_v('502', 'A');

  if (vw_p('502', 'T'))
   $str .= vw_d(", ", $str).vw_v('502', 'T');

  if (vw_p('502', 'C'))
   $str .= vw_d(", ", $str).vw_v('502', 'C');

  if (vw_p('502', 'D'))
   $str .= vw_d(", ", $str).vw_v('502', 'D');

  if (vw_p('502', 'E'))
   $str .= vw_d(", ", $str).vw_v('502', 'E');

  if (vw_p('502', 'B'))
   $str .= vw_d(", ", $str).vw_v('502', 'B');

  echo "<tr><td><b>".VW_DOC_DSRT.":</b></td><td>".$str."</td></tr>";
}
