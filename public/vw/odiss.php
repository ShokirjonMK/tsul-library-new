<?php
echo vw_add(" : ", vw_v('502', 'A'));
echo vw_add(" : ", vw_v('502', 'N'));
echo vw_add(" : ".vw_word('B_ZASH_DATA')." ", tep_html_date(vw_v('502', 'C'), "."));
echo vw_add(" : ".vw_word('B_TASD_DATA')." ", tep_html_date(vw_v('502', 'D'), "."));