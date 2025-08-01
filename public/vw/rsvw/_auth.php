<?php
if (vw_p('100', 'A') || vw_p('700', 'A')){
  $auth  = vw_v('100', 'A');
  $auth2 = vw_v('700', 'A', "", ",");
  if(trim($auth) != "" && trim($auth2) != "")
      $auth .= ", ".$auth2;
  elseif (trim($auth) == "" && trim($auth2) != "")
      $auth = $auth2;
  if (trim($auth) != "")
    echo "<tr><td><b>".VW_DOC_AUTH.":</b></td><td>".$auth."</td></tr>";
}