<?php
// Ham mualliflar
echo "<br>";
$s_ = "";
if(vw_p('700'))
 for($i = 0; $i < vw_cnt('700'); $i++):
  if(vw_v('700', 'A', $i) == '' || vw_v('700', 'E', $i) == '070' || vw_v('700', 'E', $i) == '')
    continue;
	 $s_ .= "<br> ";
	 $s_ .= vw_sb(vw_v_cl('700', 'A', $i), " ", 0);
	 $s_ .= vw_add(", ", vw_sb(vw_v('700', 'A', $i), " ", 1));
	 $s_ .= vw_add(" ", vw_v('700', 'B', $i));
	 //$s_ .= vw_add(" ", vw_v('700', 'Q', $i)); 
  if(vw_v('700', 'A', $i) != "" && vw_v('700', 'E', $i) != "" ) 
     $s_ .= '/'.vw_menu('Shrol', vw_v('700', 'E', $i), vw_v('700', 'E', $i))."/";  
 endfor;
/*
if(vw_p('100')):
	 $s_ .= "<br> ";
	 $s_ .= vw_sb(vw_v_cl('100', 'A'), " ", 0);
	 $s_ .= vw_add(", ", vw_sb(vw_v('100', 'A'), " ", 1));
	 $s_ .= vw_add(" ", vw_v('100', 'B'));
	 //$s_ .= vw_add(" ", vw_v('100', 'Q')); 
endif; */
if($s_ != "")
 echo "<b>".vw_word('OTHR_AUTHS')."</b>";
 echo $s_;