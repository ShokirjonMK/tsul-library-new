<?php
if(vw_p('022')){
 for($i = 0; $i < vw_cnt('022'); $i++):
 echo vw_add(". - <b>ISSN</b> ", substr(vw_v('022', 'A', $i), 0, 4));
 if(strpos(vw_v('022', 'A', $i), "-") !== false)
   echo substr(vw_v('022', 'A', $i), 4, 5);
 else
   echo vw_add("-", substr(vw_v('022', 'A', $i), 4, 4));
 endfor;   
} 
if(vw_v('020', 'A', 1) != '' && vw_v('020', 'C') > 1){
  for($i = 0; $i < vw_cnt('020'); $i++):
    if(vw_v('020', 'A', $i) == "")
      continue;
    echo vw_add(". - <b>ISBN</b> ",vw_v('020', 'A', $i));
    echo vw_add(". - <b>ISBN</b> ",vw_v('020', 'Z', $i), " (хато)");
    echo vw_add(" : ",vw_v('020', 'C', $i));
  endfor;
} else {
  if(vw_v('020', 'A') != '' || vw_v('773', 'P') != ''):
    for($i = 0; $i < vw_cnt('020'); $i++){
	 if(vw_v('020', 'A', $i) != "")
	 { echo vw_add(". - <b>ISBN</b> ", vw_v('020', 'A', $i));
	   echo vw_add(". - <b>ISBN</b> ",vw_v('020', 'Z', $i), " (хато)"); }
	}
	if(vw_v('020', 'A') == "" && vw_v('773', 'P') != '')
  	   echo vw_add(". - <b>ISBN</b> ", vw_v('773', 'P', $i));
        echo vw_add(" : ",vw_v('020', 'C'));
  endif;
}

if (!vw_p('020', 'A') && vw_p('020', 'C') != ''){
    echo vw_add(" ", vw_v('020', 'C'));
}