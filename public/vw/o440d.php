if(vw_p('440')){
  /* need reaserch 440^x otit461.pft */
  echo vw_add( "<b>", vw_v('440', 'X'), "</b> <br>");

  echo vw_add("&nbsp;&nbsp;&nbsp;", vw_v('245', 'A'));
 if(!vw_p(vw_v('245', 'H'))){
  if(vw_p('256') || vw_p('538')){ // 135 => 008 not found
   echo vw_word('EL_RES');//'[Электрон ресурc]'; //NEED Lang
  } else {
   echo vw_word('TEXT'); //NEED Lang
  }
 }
  if(vw_v('245', 'B') != ""){
   echo vw_d(" : ", vw_v('245', 'A'));
   echo vw_v('245', 'B');
  } 
  if(vw_v('245', 'C') != ""){
   echo vw_d(" / ", vw_v('245', 'A'));
   echo vw_v('245', 'C');
  } 
  // NASHRIYOIT Haqida malumot
  vw_vw('oout');
  // NASHRIYOIT Haqida malumot

}