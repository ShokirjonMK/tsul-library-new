vw_vw('ocnpar');
if(vw_p('007') || vw_p('034') || vw_p('008') || vw_p('256', 'A')){
 if(!vw_p('300')) echo ". -";
  vw_vw('ofspar0');
}
if(vw_p('300', 'E')){
	for($i = 0; $i < vw_cnt('300'); $i++):
	  echo vw_add(" + ", vw_v('300', 'E', $i));
	endfor;
 }
 if(vw_p('007') || vw_p('034') || vw_p('008') || vw_p('256', 'A'))
   vw_vw('ofspar1');
