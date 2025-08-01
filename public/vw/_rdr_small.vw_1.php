<?php
echo "<table style='background-color: inherit;' border=0 width='90%'><tr><td width='200px;'></td><td></td></tr>";
if (vw_p('901', 'T'))
   echo "<tr><td><b>".VW_DOC_TYPE.":</b></td><td>".vw_menu('t_doc', vw_v('901', 'T'))."</td></tr>"; 

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

if(vw_p('900')){
  $_files = "";
  global $__CUR_BOOK;
  for($i = 0; $i < 10; $i++):
	if(vw_v('900', 'A', $i) == '')
	 break;
        if (trim($_files) != "")
            $_files .= "&nbsp;";
	$subs = explode(";", vw_v('900', 'A', $i));
	$s_ = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];
	$s_ .= str_replace("index", "getfile", $_SERVER['PHP_SELF']);
	$_files .= " <a href='".$s_."?type=ek&cat=".$__CUR_BOOK."&attachment=".sys_encode($subs[0])."'>".$subs[1]."</a>";
  endfor;
  
  if ($_files != "")
    echo "<tr><td><b>".VW_DOC_ATCH.":</b></td><td>".$_files."</td></tr>";
}

if(vw_p('856', 'U')){
    $_urls = "<a href='".vw_v('856', 'U', 0)."' target='_blank'>";
    if (vw_p('856', 'A'))
       $_urls .= vw_v('856', 'A', 0);
    else
       $_urls .= vw_v('856', 'U', 0);
    $_urls .= "</a>";
    echo "<tr><td><b>".VW_DOC_URL.":</b></td><td>".$_urls."</td></tr>";
}

echo "</table>";
vw_vw('source');
vw_vw('childs');
vw_vw('copy');