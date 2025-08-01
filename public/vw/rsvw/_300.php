<?php
$str  = vw_v('300', 'A');
$str .= vw_d(", ", $str).vw_v('300', 'B');
$str .= vw_d(", ", $str).vw_v('300', 'C');

if ($str != "")
  echo "<tr><td><b>".VW_DOC_WEID.":</b></td><td>$str</td></tr>";
