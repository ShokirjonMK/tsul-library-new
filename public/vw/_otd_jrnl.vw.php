<?php
//JW.PWT
$old_vw_p = vw_get();
$prnt_arr = vw_garr('B_PARENT');

$cp   = vw_garr('COPY');

if(count($cp) < 1)
{ 
  echo "<center>(".vw_word('WITHOUT_COPY_INFO').")</center><br>";
} else {
  $free = false;
  for($i = 0; $i < count($cp); $i++)
   if($cp[$i]['invmode'] == '0' && ($cp[$i]['rdr_id'] === '0' || $cp[$i]['rdr_id'] === ''))
     $free = true;
  if(!$free)
  echo ("<center> (".vw_word('COPY_ISNOT_FREE').")</center><br>");
}

vw_merge($prnt_arr[0]);

vw_vw('_jrnl.vw');

vw_change($old_vw_p);

if(vw_p('951', 'A') && vw_p('953', 'A'))
  echo "<br><b>".vw_v('951', 'A').vw_word('VW_YIL')." ".vw_v('953', 'A')."</b><br>";

if(vw_p('939')):

  echo "<br><b>&nbsp;&nbsp;&nbsp;".vw_word('VW_INDEX')."</b>";

  for($i = 0; $i < vw_cnt('939'); $i++):
    echo "<br>";
    echo vw_add("<b>", vw_v('939', 'F', $i), "</b>");
	echo vw_add("&nbsp;<b>", vw_v('939', 'C', $i), "</b>");
	echo " / ";

	$f_o = vw_sb(vw_v('939', 'F', $i), " ", 1);
	if($f_o != "")
	   if(strpos($f_o, '. ') !== false)  echo $f_o;  else echo str_replace('.', '. ', $f_o);
	echo vw_sb(vw_v('939', 'F', $i), " ", 0);
    
	if( vw_v('939', '2', $i) != "" ||  vw_v('939', '3', $i) != "" ||  vw_v('939', 'W', $i) != "")
	  echo vw_add(' ', vw_word('O_AUTHRS'), ';');

    echo vw_add('.-', vw_v('939', '4', $i), vw_word('VW_PAGE'));

	if( vw_v('939', '2', $i) != "" ||  vw_v('939', '3', $i) != "" ||  vw_v('939', 'W', $i) != ""){
   	  echo vw_word('VW_OAUTH_EN')." ";
	  echo vw_v('939', '2', $i);
	  echo vw_add(", ", vw_v('939', '3', $i));
	  echo vw_add(", ", vw_v('939', 'W', $i));
	}
  endfor;

endif;
vw_vw('copy');
vw_vw('ofull');
?>