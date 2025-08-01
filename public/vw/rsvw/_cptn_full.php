<?php
$cptn  = vw_v('245', 'A');

$cptn .= vw_d(", ", $str).vw_v('250', 'A');
$cptn .= vw_d(", ", $str).vw_v('250', 'B');
$cptn .= vw_d(", ", $str).vw_v('250', 'C');
$cptn .= vw_d(", ", $str).vw_v('250', 'H');

if ($cptn != "") 
  echo "<tr><td><b>".VW_DOC_CAPT.":</b></td><td>$cptn</td></tr>";