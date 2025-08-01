<?php
$btype   = vw_garr('B_TYPE');
if(vw_p('852', 'A'))
 echo vw_add('<b>', vw_v('852', 'A'), '</b><br>');
else 
 echo vw_add('<b>', vw_v('090', 'A'), '</b><br>');

if($btype == "pt")
  echo vw_add('<b>', vw_menu ("country", vw_v('013', 'B')), vw_add(", ", vw_v('013', 'F')).'</b><br>');

if(vw_p('852', 'I'))
 echo vw_add('<b>', vw_v('852', 'I'), '</b><br>');
else 
 echo vw_add('<b>', vw_v('090', 'X'), '</b><br>');
/*echo "<b>";
if(vw_p('099')){
 if(strpos(vw_v('099'), vw_v('852', 'A')) !== false):
   echo vw_v('852', 'A');
   echo vw_add("&nbsp;&nbsp;&nbsp;", vw_uk("0888_22", vw_008(22)));
     if(strpos(vw_v('852', 'A'), vw_v('852', 'I')) === false)
       echo vw_add(vw_par, vw_v('852', 'I'));
   echo vw_par;	   
 endif;
   
} else {

}*/