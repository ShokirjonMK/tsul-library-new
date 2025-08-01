<?php
echo "<table style='background-color: inherit;' border=0 width='90%'><tr><td width='200px;'></td><td></td></tr>";
if (vw_p('901', 'T'))
   echo "<tr><td><b>".VW_DOC_TYPE.":</b></td><td>".vw_menu('t_doc', vw_v('901', 'T'))."</td></tr>"; 

$t901 = strtolower(trim(vw_v('901', 'T')));
if (isset_vw("rsvw/".$t901.".vw"))
  vw_vw("rsvw/".$t901.".vw");
else
  vw_vw("rsvw/simple.vw");

echo "</table>";
vw_vw('source');
vw_vw('childs');
vw_vw('copy');