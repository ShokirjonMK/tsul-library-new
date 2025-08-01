$cp   = vw_garr('COPY');
if(count($cp) >= 1){
  echo "<br><b>".vw_word('COPY_CNT')."</b>&nbsp;".vw_word('COPY_CNT_SUM')."&nbsp;";
 $al_c = 0; $fr   = 0; $w_inv = 0;
  for($i = 0; $i < count($cp); $i++)
  { 
    $al_c += $cp[$i]['CNT'];
	if($cp[$i]['invmode'] == 'U')
	 $w_inv += $cp[$i]['CNT'];
	else if($cp[$i]['invmode'] == '0' && $cp[$i]['rdr_id'] == 0)
  	  $fr += 1;
  }	
 echo $al_c;
 if($fr > 0)
  echo ", ".vw_word('COPY_FREE')." ".$fr;
 if($w_inv > 0)
  echo ", ".vw_word('COPY_WITHOUT_INV')." ".$w_inv;
}