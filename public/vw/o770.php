$n = vw_p_cnt('770', 'D');
$n = max(vw_p_cnt('770', 'R'), $n);
for ($i = 0; $i < $n; $i++):
 echo vw_add("<br />", vw_add(vw_v('770', 'D', $i), ", ", vw_v('770', 'R', $i)), ". - ".vw_v('770', 'N', $i));
endfor;