<?php
/*
  IF journal
*/
echo vw_add(". -", vw_v('254', 'A'));

if(vw_v('260', 'A') == ''){
  if((vw_v('773') != '' || vw_v('774') != '' || vw_v('008') != '')){
    if(vw_v('260', 'B') != '') echo '. - [Á. ì.]';
  } else {
    if(vw_v('260', 'B') == '' && vw_v('773', 'D') == '')
	  echo '. - [Á. ì. : á. è.]';
    else if(vw_v('260', 'B') == '')
	  echo '. - [Á. ì.]';
  }	
}
if(vw_v('260', 'C', 1) != ''){
  if(vw_p('260', 'A')) echo ". -";
  for($i = 0; $i < 4; $i++){
   echo vw_add(" ; ", vw_v('260', 'A', $i));
   echo vw_add(" : ", vw_v('260', 'B', $i));
    if(vw_v('773', '', 0) != ''){
       //if(vw_v('260', 'A') != '' || vw_v('260', 'B') != '')
	echo vw_add(" : ", vw_v('260', 'C', $i));
	//   else
	//      echo vw_add(". - ", vw_v('260', 'C', $i)); 
    } else echo vw_add(", ", vw_v('260', 'C', $i)); 
  }
} else {
    echo vw_add(". - ", vw_v('260', 'A', 0));
    echo vw_add(" : ",  vw_v('260', 'B', 0));
  for($i = 1; $i < 4; $i++):
    echo vw_add(" ; ", vw_v('260', 'A', $i));
    echo vw_add(" : ", vw_v('260', 'B', $i));
  endfor;
  //if(vw_v('260', 'A') != '' && vw_v('260', 'B') == '')
  // echo " : ".vw_word('B_I'); //if v101=''or &unifor('Kjzk.mnu|'&unifor('Av101#1'))<>''then' : [á. è.]'else' : [s. n.]' 
  if(vw_v('260', 'C') != ''):
    if(vw_p('773') || vw_p('440')){
	  if(vw_v('260', 'A') != '' && vw_v('260', 'B') != '')
	    echo ", ";   else echo ". - ";
   	  if(vw_p('440', 'N') && vw_p('440', 'Z'))
	   echo vw_add(vw_v('440', 'N'), ' - ', vw_v('440', 'Z'));
	  else
	   echo vw_add(", ", vw_v('260', 'C'));
	} else echo vw_add(", ", vw_v('260', 'C'));
  endif;
}
if (vw_btype() == 'snan' || vw_btype() == 'srnq')
  echo vw_add(', ', vw_v('245', 'N'));

if (vw_btype() == 'srnq')
  echo vw_add('.- ', vw_v('245', 'F'));

if (vw_btype() == 'jurn')
  echo vw_add('.- ', vw_menu('insert_type', vw_008(18, 19), ''));