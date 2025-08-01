if(vw_p('765'))
  for($i = 0; $i < vw_cnt('765'); $i++){
     echo '. - <b> Пер. изд. :</b>';
	 echo vw_v('765', 'A', $i);
//	 if(vw_v('765', 'D', $i) != '') { echo " / ";
//	  vw_vw(''); }
	 echo vw_add(". - ", vw_v('765', 'T', $i));
	 echo vw_add(". - ", vw_v('765', 'W', $i));
  }
