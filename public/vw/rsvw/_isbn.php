<?php
if (vw_p('020', 'A') && trim(vw_v('020', 'A')) != "")
    echo "<tr><td><b>".VW_DOC_ISBN.":</b></td><td>".trim(vw_v('020', 'A'))."</td></tr>";
elseif (vw_p('022', 'A') && trim(vw_v('022', 'A')) != "")
    echo "<tr><td><b>".VW_DOC_ISBN.":</b></td><td>".trim(vw_v('022', 'A'))."</td></tr>";
