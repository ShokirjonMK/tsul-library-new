<?php
if (vw_p('260', 'A') || vw_p('260', 'B') || vw_p('260', 'C')){ 
  $publ = trim(vw_v('260', 'A'));
  
  if(trim(vw_v('260', 'B')) != ""){
      $publ .= ($publ != "")?"; ":"";
      $publ .= trim(vw_v('260', 'B'));
  }
  
  if(trim(vw_v('260', 'C')) != ""){
      $publ .= ($publ != "")?"; ":"";
      $publ .= trim(vw_v('260', 'C'));
  }
          
  echo "<tr><td><b>".VW_DOC_DOUT.":</b></td><td>".$publ."</td></tr>";
}