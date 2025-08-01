<?php
echo "<b>";
//$_100q = str_replace(vw_sb(vw_v_cl('100', 'A'), " "), "", vw_v('100', 'Q'));
//echo  vw_sb(vw_v_cl('100', 'A'), " ").vw_add(" ", vw_v_cl('100', 'B')).vw_add(", ", $_100q);
if(!vw_p('100', 'Q')){
  echo  vw_sb(vw_v_cl('100', 'A'), " ").vw_add(" ", vw_v_cl('100', 'B'));
  $f_o = vw_sb(vw_v_cl('100', 'A'), " ", 1);
  if($f_o != ""){
     echo ' ';
     if(stripos($f_o, '. ') !== false)
     { echo $f_o; }
	 else if(stripos($f_o, '.') === false){
  	   echo $f_o.(strlen(trim($f_o)) == 1 ? ". " : "");
	   $f_o = vw_sb(vw_v_cl('100', 'A'), " ", 2);
	   if($f_o != ""){
	     $f_o = str_replace(array('.', ','), "", $f_o);
		 echo vw_add(" ", trim($f_o), (strlen(trim($f_o)) == 1 ? ". " : ""));
	   }
	 } else  
	  echo str_replace('.', '. ', $f_o);
   }
} else {
    echo vw_v('100', 'A');
}
echo "</b>";
//971, 509 not found
if(vw_v('100') == "" && vw_v('110') == '' && vw_v('730') == ''){
 echo vw_add("<br>&nbsp;&nbsp;&nbsp; <b>", vw_ue(vw_v('245', 'A'), 3), "</b>");
 echo vw_add(" ", vw_uf(vw_v('245', 'A'), 3));
} else echo "<br>&nbsp;&nbsp;&nbsp;".vw_v('245', 'A');

echo vw_add(' [', vw_uk('Fiztash', vw_v('245', 'H')), '] ');

/// if a(v200^b) then &unifor('+1W1#'''), 
/// if p(v101)then &unifor('+1W1#'&unifor('Kjzk.mnu|'&unifor('Av101#1')))else &unifor('+1W1#0')  fi, 
if(!vw_p('245', 'H')){
  if(vw_p('256') || vw_p('538')){ // 135 => 008 not found
   echo vw_word('EL_RES');//'[Электрон ресурc]'; //NEED Lang
  } else {
   echo vw_word('TEXT'); //NEED Lang
  }
}

//if(vw_p('246', 'A'))
//    echo vw_add(" = ", vw_v('246', 'A'), "");

if(vw_p('246', 'O')){
  for($i = 0; $i < vw_cnt('246'); $i++):
      echo vw_add(" = ", vw_v('246', 'O', $i));
  endfor;
}

if(vw_p('245', 'N') && vw_garr('B_TYPE') <> 'snan' && vw_garr('B_TYPE') <> 'srnq')
    echo vw_add(" . ", vw_v('245', 'N'), " ");

if(vw_p('245', 'P') && (vw_btype() != 'jurn' && vw_btype() != 'snan'))
    echo vw_add(": ", vw_v('245', 'P'), "");