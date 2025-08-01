if(vw_v('300', 'A', 1) ==  vw_v('300', '', 1)){
 echo vw_add(". - ", vw_v('300', 'A', 0));
 if(is_numeric(vw_v('300', 'A', 0)))
   echo " á";
 for($i = 1; $i < 4; $i++){
   echo vw_add(", ", vw_v('300', 'A', $i));
   if(is_numeric(vw_v('300', 'A', $i)))
     echo " á";
 }
 if (vw_p('300', 'A') == false)
      echo vw_add(". - ", vw_v('300', 'B'));   
  else
      echo vw_add(" : ", vw_v('300', 'B')); 
 echo vw_add(" ; ", vw_v('300', 'C')); 
} else {
 echo vw_add(". - ", vw_v('300', 'A', 0));
 if(is_numeric(vw_v('300', 'A', 0)))
   echo " á";
 if (vw_p('300', 'A') == false)
    echo vw_add(". - ", vw_v('300', 'B', 0)); 
  else
    echo vw_add(" : ", vw_v('300', 'B', 0));
  
  if (vw_p('300', 'A') == false && vw_p('300', 'B') == false)
      echo vw_add(". - ", vw_v('300', 'C', 0));
   else
      echo vw_add(" ; ", vw_v('300', 'C', 0)); 
 
 for($i = 1; $i < 4; $i++){
   echo vw_add(", ", vw_v('300', 'A', $i));
   if(is_numeric(vw_v('300', 'A', $i)))
     echo " á";
   echo vw_add(" : ", vw_v('300', 'B', $i)); 
   echo vw_add(" ; ", vw_v('300', 'C', $i)); 
 }
}
