<?php
/*
  Ko`p tomlik hujjatning alohida tomi
*/
$__main_book = vw_get();
$_a090       = vw_v("090", 'A');
$__parent    = vw_garr('B_PARENT');
if ($_a090 != "")
  $__parent['090'] = $__main_book['090']; //090 Faqat o'ziniki
vw_change($__parent);  // BYO ota-ona parametrlari aosiga quriladi.

vw_vw('ocpinf');
vw_vw('orshifr');
vw_vw('cptn');
vw_vw('cptnc');
vw_vw('oizd');
/*vw_vw('ospec');*/
vw_vw('oout');
vw_vw('ofspar');
vw_vw('oser');
vw_vw('onts');
vw_vw('oISBN');
/* Obl prim don't ready yet*/

vw_change($__main_book);

$cnt = vw_cnt(245, 'A');
if ($cnt > 1){
 $cptn = "";
 for ($j = 0; $j < $cnt; $j++){
   if ($cptn != "")
       $cptn .= "; ";
   $cptn .= vw_v(245, 'A', $j).vw_add(" : ", vw_v(245, 'B', $j));
 }
  echo "\n<br>&nbsp;&nbsp;&nbsp;".vw_add(vw_v(773, 'G'), " : ").$cptn.vw_add(".- ", vw_v(260, 'C')).
      vw_add(".- ", vw_v(300, 'A')).vw_add(" : ", vw_v(300, 'B')).vw_add(". - ISBN ", vw_v('020', 'A')) ;
} else       
  echo "\n<br>&nbsp;&nbsp;&nbsp;".vw_add(vw_v(773, 'G'), " : ").vw_v(245, 'A').vw_add(" : ", vw_v(245, 'B')).vw_add(".- ", vw_v(260, 'C')).
              vw_add(".- ", vw_v(300, 'A')).vw_add(" : ", vw_v(300, 'B')).vw_add(". - ISBN ", vw_v('020', 'A'));

vw_change($__parent);  // BYO ota-ona parametrlari aosiga quriladi.

vw_vw('ogrudk');
/* Obl rubrika don't ready yet
   obl Priplet so */
vw_vw('oantpl'); // don't ready yet

vw_change($__main_book);