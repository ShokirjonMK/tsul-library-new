<?php
if(vw_v('246', 'B') != ''){
   //if s(v982^0,v982^9)<>'' then v200^e
   echo vw_add(" : ", vw_v('245', 'B'));
}
echo vw_add(" : ", ucfirst(vw_v('246', 'B')));
if(!vw_p('246', 'B')){
  echo vw_add(" : ", vw_v('245', 'B'));
}

if(vw_p('245', 'P') && (vw_btype() == 'jurn' || vw_btype() == 'snan'))
    echo vw_add(": ", vw_v('245', 'P'), "");

vw_vw('odiss');
//karta
echo vw_add(' / ', vw_v('255', 'B'));

if(vw_v('246') == ''){
  if((vw_p('246') && vw_v('246', 'B') == '') || (!vw_p('246') && vw_p('245', 'B') != '')){
    echo vw_d(" / ", vw_v('245', 'C'));
  }
  // HATO
}
  
  if(vw_v('245', 'C') == '')
    vw_vw('authrs');
  vw_vw('o245cz');

//dissertasiya
echo vw_add("; ", vw_v('502', 'B'));