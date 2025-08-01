<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function ui_branch_combo($name, $ui_id = "branch_combo"){
   $____sql = getBranchSQL();//"select id, name from branch order by id";
   $def_br = getBranchID();

   $ui_html  = "<select name='$name' id='$ui_id' ><option value='0'>---------</option>".
           tep_select($____sql, $def_br)."</select>";
   $ui_html .= "<script> branch_init('$ui_id'); </script>";

   return $ui_html;
}
?>
