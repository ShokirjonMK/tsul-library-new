<?php
$has_access = true;
if (vw_p('333', 'A')){
  if (!canAccess() && vw_v('333', 'A') == 'R')
    $has_access = false;    
}
global $__CUR_BOOK;
if(vw_p('900') && $has_access){
  echo "<br>&nbsp;&nbsp;&nbsp;".vw_word('SSILKA');
  for($i = 0; $i < 10; $i++):
	if(vw_v('900', 'A', $i) == '')
	 break;
	$subs = explode(";", vw_v('900', 'A', $i));
	$s_ = "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'];
	$s_ .= str_replace("index", "getfile", $_SERVER['PHP_SELF']);
        if (vw_v('333', 'A') == 'A')
          echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:needPay(\"".str_replace(array("\n", '"', "'"), '', vw_v('333', 'B'))."\");'>".$subs[1]."</a>";
        else if (vw_v('333', 'A') == 'R' && !isAuth())
          echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:needAuth();'>".$subs[1]."</a>";
        else
          echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".$s_."?type=ek&cat=".$__CUR_BOOK."&attachment=".sys_encode($subs[0])."'>".$subs[1]."</a>";
  endfor;
}

if(vw_p('856', 'U'))
	echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='".vw_v('856', 'U')."'>".vw_v('856', 'U')."</a>";
