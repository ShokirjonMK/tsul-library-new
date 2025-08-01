<?php
$parent_books = vw_garr('B_PARENT');
$parent_id    = vw_garr('B_PARENT_ID');
$main_book    = vw_get();
vw_change($parent_books);

if (count($parent_books) > 0):
  if(vw_rdr_v()) {
    echo "<br><b><i>".vw_word('VW_SOURCE')."</i></b> <br>";
    //echo "<a href='index.php?sub=tools&modal=yes&&noheader=yes&work=book_view_rdr&idobj=".sys_encode($parent_id)."'>";
    echo "<a href='index.php?sub=tools&work=book_view_rdr&idobj=".sys_encode($parent_id)."'>";
  }
    vw_vw('cptn');
    vw_vw('cptnc');
    vw_vw('oizd');
    vw_vw('oout');
    vw_vw('ofspar');
    vw_vw('oser');
    vw_vw('onts');
    vw_vw('oISBN');
 if(vw_rdr_v()) {
    echo "</a>";
 } 
endif;
vw_change($main_book);