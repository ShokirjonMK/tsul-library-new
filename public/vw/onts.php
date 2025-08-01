if(!vw_p('773') && vw_p('538', 'A')){
  for($i = 0; $i < vw_cnt('538'); $i++):
      echo vw_add(". - ", vw_v('538', 'A', $i));
  endfor;
}
//ANIQLASHTIRISH Kerak 
/*
if(vw_p('246', 'A')){
  for($i = 0; $i < vw_cnt('246'); $i++):
      echo vw_add(". - ", vw_v('246', 'A', $i));
  endfor;
}*/
  
  echo vw_add(". - ", vw_v('510', 'A'));
  echo vw_add(". - ", vw_v('504', 'A'));
  echo vw_add(". - ", vw_v('521', 'A'));  
  echo vw_add(". - ", vw_v('500', 'A')); 
  echo vw_add(". - ", vw_v('505', 'A'));  
  vw_vw('on765');
  $btype   = vw_garr('B_TYPE');
  if ($btype == "jurn"):
      $reg_type = vw_008(19);
      if ($reg_type != ""){
          echo vw_add(". -", vw_menu("ser_period", $reg_type, ""));
      }
          
  endif;
  echo vw_add(". - ", vw_v('502', 'E'));
   