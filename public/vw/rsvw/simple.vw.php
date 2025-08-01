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

if (vw_p('245', 'A')) 
  echo "<tr><td><b>".VW_DOC_CAPT.":</b></td><td>".vw_v('245', 'A')."</td></tr>";

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

if (vw_p('020', 'A') && trim(vw_v('020', 'A')) != "")
    echo "<tr><td><b>".VW_DOC_ISBN.":</b></td><td>".trim(vw_v('020', 'A'))."</td></tr>";
elseif (vw_p('022', 'A') && trim(vw_v('022', 'A')) != "")
    echo "<tr><td><b>".VW_DOC_ISBN.":</b></td><td>".trim(vw_v('022', 'A'))."</td></tr>";

vw_vw("rsvw/_file");

if(vw_p('856', 'U')){
    $_urls = "<a href='".vw_v('856', 'U', 0)."' target='_blank'>";
    if (vw_p('856', 'A'))
       $_urls .= vw_v('856', 'A', 0);
    else
       $_urls .= vw_v('856', 'U', 0);
    $_urls .= "</a>";
    echo "<tr><td><b>".VW_DOC_URL.":</b></td><td>".$_urls."</td></tr>";
}