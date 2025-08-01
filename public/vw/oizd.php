echo vw_add(". -", vw_v('250', 'A'));
if(vw_p('250', 'A'))
 echo vw_add(", ", vw_v('250', 'B', '', ', '));
else
  echo vw_add(". -", vw_v('250', 'B', '', ', '));

//karta
echo vw_add(".- ", vw_v('255', 'A'));
echo vw_add("; ", vw_v('255', 'E'));