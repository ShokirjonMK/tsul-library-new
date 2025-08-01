echo "<b>";
 if(vw_p('099')):
   if(stripos(vw_v('099'), substr(vw_v('852', 'I'), 0, 15)) !== false){
     echo vw_v('852', 'A');	 //if(vw_p('008')) //echo "\t ".vw_p('008');
     if(stripos(vw_v('852', 'A'), vw_v('852', 'I'))){ echo "<br>".vw_v('852', 'I'); }
	 echo "<br>";
   } else { 
     if (vw_p('852', 'I') && (stripos(vw_v('099'), substr(vw_v('084', 'A', 0), 0, 15))
	                          || stripos(vw_v('099'), vw_g0(substr(vw_v('080', '', 0)), 0, 15))
							  || stripos(vw_v('099'), vw_g0(vw_v('084', 'A', 0)))))
		{
		 
		}
		
   }
 endif;
echo "</b>";