<?php
if (p_vw_v('901', 'T') == 'v' && vw_v('901', 'T') == 'n') // Ko`p tomlik nashrning alohida tomi
  vw_vw('_at_ktk.vw');             
elseif (vw_v('901', 'T') == 'v')
  vw_vw('_um_ktk.vw');       
elseif (vw_v('901', 'T') == 'c')
  vw_vw('_ch_third.vw');       
else
  vw_vw('_ok_simple.vw');