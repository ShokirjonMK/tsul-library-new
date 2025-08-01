if(vw_p('080') || vw_p('098') || vw_p('084')){
  echo '<br>&nbsp;&nbsp;';
  if(vw_p('080')):
    echo "&nbsp; <b>".vw_word('UDK')."</b> ";
    for($i = 0; $i < vw_cnt('080'); $i++)
      echo vw_add("<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", vw_v('080', 'A', $i));
  endif;

  if(vw_p('084')):
   if(vw_v('080') != "")
    echo "<br>&nbsp;&nbsp;";
    echo "&nbsp; <b>".vw_word('BBK')."</b> ";
    for($i = 0; $i < vw_cnt('084'); $i++)
      echo vw_add("<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", vw_v('084', 'A', $i));
  endif;

  if(vw_p('098')):
    if(vw_v('080') != "" || vw_v('084') != "")
	 echo "<br>&nbsp;&nbsp;";
	echo "&nbsp; <b>".vw_word('RUB')."</b> ";
    for($i = 0; $i < vw_cnt('098'); $i++)
      echo vw_add("<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", vw_v('098', 'A', $i));
  endif;
  
}