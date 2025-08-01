<?php
$has_access = true;
if (vw_p('333', 'A')){
  if (!canAccess() && vw_v('333', 'A') == 'R')
    $has_access = false;    
}

if(vw_p('900') && $has_access){
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
	if (vw_v('333', 'A') == 'A')
          $_files .= " <a href='javascript:needPay(\"".str_replace(array("\n", '"', "'"), '', vw_v('333', 'B'))."\");'>".$subs[1]."</a>";
                else
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
