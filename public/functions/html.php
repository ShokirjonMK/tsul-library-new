<?php
$_ADMIN__ROLE = array("m_conf_cfg", "tags", "c_tags", "m_conf_out", "btypes", "m_branch", "dssprav", "dbases", "m_sprav", "users", "stypes", "m_avt", "m_conf_in", "m_books", "m_rdrs", "m_branch_sprav", "m_fix");
$_CATAL__ROLE = array("m_avt", "m_conf_in", "m_books", "m_rdrs", "m_branch_sprav", "m_fix");
$_BIBL__ROLE  = array("b_orders", "b_gbook", "b_debts", "b_debitors", "b_books", "b_stat", "b_sord");
$_RDR__ROLE   = array("rdr_personal", "r_books", "r_mydbts", "r_sord");
$_CMPL__ROLE  = array("m_cmpl_db", "m_books", "m_cmpl_ord", "m_cmpl_mno", "m_cmpl_get", "m_cmpl_rpt");
$_ALL_ROLE    = array("forgot", "r_search", "r_big_search", "tools", "m_rdrs");

$_TEMP___BRANCH___ID = 0;

function canAccess(){
global $_RDR__ROLE, $_ADMIN__ROLE, $_CATAL__ROLE, $_BIBL__ROLE, $_ALL_ROLE, $_CMPL__ROLE, $sub;
  if(in_array($sub, $_ALL_ROLE))
   return true;
  if(isRdr() && in_array($sub, $_RDR__ROLE))
    return true;
  if(isAdmin() && in_array($sub, $_ADMIN__ROLE))
    return true;
  if(isCatal() && in_array($sub, $_CATAL__ROLE))
    return true;
  if(isBibl() && in_array($sub, $_BIBL__ROLE))
    return true;
  if(isCmpl() && in_array($sub, $_CMPL__ROLE))
    return true;
 return false;
}
function isRdr(){
  if(isset($_SESSION['USER']))
   return true;
  else
   return false;
}
function isAdmin(){
  if(isset($_SESSION['EMPL']))
   {
     if($_SESSION['EMPL']['type'] == 'admin')
	   return true;
   }
   return false;
}

function isCatal(){
  if(isset($_SESSION['EMPL']))
   {
     if($_SESSION['EMPL']['type'] == 'catalog' || $_SESSION['EMPL']['type'] == 'super_cat')
	   return true;
   }
   return false;
}

function isMainCatal(){
  if(isset($_SESSION['EMPL']))
   {
     if($_SESSION['EMPL']['type'] == 'super_cat')
	   return true;
   }
   return false;
}

function isCmpl(){
  if(isset($_SESSION['EMPL']))
   {
     if($_SESSION['EMPL']['type'] == 'cmpl')
	   return true;
   }
   return false;
}
function isBibl(){
  if(isset($_SESSION['EMPL']))
   {
     if($_SESSION['EMPL']['type'] == 'bibl')
	   return true;
   }
   return false;
}
function isAuth(){
 if(isset($_SESSION['EMPL']) || isset($_SESSION['USER']))
   return true;
 return false;  
}

function getUserID(){
  if(isset($_SESSION['EMPL']))
    return $_SESSION['EMPL']['id'];
  if(isset($_SESSION['USER']))
    return $_SESSION['USER']['ID'];
 return 0;
}

function getUserName(){
  if(isset($_SESSION['EMPL']))
    return $_SESSION['EMPL']['name'];

  return "";
}

function setTempBranchID($tempId){
   global $_TEMP___BRANCH___ID;
   
   $_TEMP___BRANCH___ID = $tempId;
}

function getBranchID(){
  global $_TEMP___BRANCH___ID;
  
  if ($_TEMP___BRANCH___ID > 0)
      return $_TEMP___BRANCH___ID;
  
  if(isset($_SESSION['EMPL']))
    return $_SESSION['EMPL']['branch_id'];
  if(isset($_SESSION['USER']))
    return $_SESSION['USER']['branch_id'];

  return 0;
}
function incNum($val){
  $i = strlen($val);
  $i--;
  $sub = "";
  while($val{$i} >="0" && $val{$i} <= "9" && $i > -1)
  { 
  $sub = $val{$i}.$sub; $i--;
  }
  if($sub == "")
   return $val."1";
  $val = substr($val, 0, strlen($val) - strlen($sub));
  $sub = intval($sub) + 1;
  return $val.$sub;
}
function tep_href($url, $query, $desc = '', $echo = 1){
  if($echo == 0)
   return "<a " .$desc." href='".$url."?".$query."'>";//."&".session_name()."=".session_id()."'>";
  else
  echo "<a " .$desc." href='".$url."?".$query."'>"; //"&".session_name()."=".session_id()."'>";
 }
 function tep_form($name, $url, $query, $desc = '', $method = 'post'){
  return "<form name='$name' action='".$url."?".$query."' method='$method' $desc>";
 }
 function tep_left_box($title = '', $posi = 'CENTER'){
   $str = '<table border="0" width="185" cellspacing="0" cellpadding="0">
<tr><td style="border-top: 1px solid #BDBDBD; width: 100%" width="178px"><img src="'.IMAGES.'/spacer.gif"></td><td><img border="0" src="'.IMAGES.'/9.gif" width="7" height="7"></td></tr>
<tr>
<td colspan="2">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tr><td bgcolor="#DFDFDF"><img border="0" src="'.IMAGES.'/4.gif" width="7" height="18"></td>
<td width="100%" bgcolor="#51B5E9" class="tdmar" style="color:#FFFFFF;"><b>'.$title.'</b></td>
<td bgcolor="#51B5E9"><img border="0" src="'.IMAGES.'/6.gif" width="18" height="18"></td></tr>
</table>
</td>
</tr>
<tr>
<td width="100%" colspan="2" style="border-right: 1px solid #BDBDBD;padding:5px;" align="'.$posi.'">';
 return $str;
}
 function tep_left_box_bottom(){
   $str = '</td></tr><tr><td style="border-bottom: 1px solid #BDBDBD;" width="178px;"><img src="'.IMAGES.'/spacer.gif"></td><td><img border="0" src="'.IMAGES.'/11.gif" width="7" height="7"></td></tr></table>';
  return $str;
 }
  function tep_right_box($title = ''){
   $str = '<table border="0" width="185" cellspacing="0" cellpadding="0">
<tr><td><img border="0" src="'.IMAGES.'/8.gif" width="7" height="7"></td>
<td style="border-top: 1px solid #BDBDBD;" width="100%"><img src="'.IMAGES.'/spacer.gif"></td></tr>
<tr><td colspan="2">
<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td bgcolor="#DFDFDF"><img border="0" src="'.IMAGES.'/13.gif" width="18" height="18"></td><td width="100%" bgcolor="#51B5E9"  style="color:#FFFFFF;">&nbsp;<b>'.$title.'</b></td>
<td bgcolor="#DFDFDF"><img border="0" src="'.IMAGES.'/4.gif" width="7" height="18"></td></tr></table></td></tr><tr><td width="100%" colspan="2" style="border-left: 1px solid #BDBDBD;padding:5px;" align="left">';
 return $str;
}
function tep_right_box_bottom(){
   $str = '</td></tr><tr><td><img border="0" src="'.IMAGES.'/10.gif" width="7" height="7"></td><td style="border-bottom: 1px solid #BDBDBD;" width="100%"><img src="'.IMAGES.'/spacer.gif"></td></tr></table>';
  return $str;
 }
function tep_center_box(){
  $str = '<table height="100%" border="0" width="100%" cellspacing="0" cellpadding="0">
<tr><td align="right"><img border="0" src="'.IMAGES.'/8.gif" width="7" height="7"></td>
<td style="border-top: 1px solid #BDBDBD;" width="100%"><img src="'.IMAGES.'/spacer.gif"></td><td><img border="0" src="'.IMAGES.'/9.gif" width="7" height="7"></td></tr><tr><td style="border-left:1px solid #BDBDBD;"><img src="'.IMAGES.'/spacer.gif" width="1"></td><td height="100%" valign="top" align="center">';
 return $str;
}
function tep_center_bottom_box(){
 $str = '</td><td style="border-right:1px solid #BDBDBD;"><img src="'.IMAGES.'/spacer.gif" width="1"></td></tr><tr><td align="right"><img border="0" src="'.IMAGES.'/10.gif" width="7" height="7"></td>
<td style="border-bottom: 1px solid #BDBDBD;" width="100%"><img src="'.IMAGES.'/spacer.gif"></td><td><img border="0" src="'.IMAGES.'/11.gif" width="7" height="7"></td></tr></table>';
 return $str;
}
function showDelete($link){
 return "<a href='#' onclick='isDelete(\"".$link."\");'>".BTN_A_DEL."</a>";
}
function showDone($link){
 return "<a href='#' onclick='isDone(\"".$link."\");'>".BTN_A_DONE."</a>";
}

function display_value($key, $val, $after = ""){
 if(trim($val) != "" )
  return $key." ".$val.$after;
 else return "";
}

function tep_select($arr, $sel = ''){
  $str = ""; $sel = trim($sel);
if(is_array($arr)){
  foreach($arr as $key => $val) {
   $key = str_replace("'", "`", $key);
   if(trim($key) == $sel)
   	 $str .= "<option value='$key' selected>$val</option>";
    else
	 $str .= "<option value='$key'>$val</option>";
  } 
} else if($arr != ""){ // sql
   $result = mysql_query($arr);
   while($row = mysql_fetch_array($result, MYSQL_NUM))
   { 
    $row[0] = str_replace("'", "`", $row[0]);
	$row[1] = str_replace("'", "`", $row[1]);
	if(trim($row[0]) == $sel)
   	 $str .= "<option value='".$row[0]."' selected>".$row[1]."</option>";
      else
	 $str .= "<option value='".$row[0]."'>".$row[1]."</option>";
	} 
  mysql_free_result($result);
}	 
  return $str;
}

function tep_multi_select($arr, $sel = ''){
  $str = ""; $sel = trim($sel);
if(is_array($arr)){
  foreach($arr as $key => $val) {
   $key = str_replace("'", "`", $key);

   if(strpos($sel, $key) === false)
   	 $str .= "<option value='$key'>$val</option>";
    else
	 $str .= "<option value='$key' selected>$val</option>";
  } 
} else if($arr != ""){ // sql
   $result = mysql_query($arr);
   while($row = mysql_fetch_array($result, MYSQL_NUM))
   { 
    $row[0] = str_replace("'", "`", $row[0]);
	$row[1] = str_replace("'", "`", $row[1]);
	if(strpos($sel, $row[0]) === false)
   	 $str .= "<option value='".$row[0]."'>".$row[1]."</option>";
      else
	 $str .= "<option value='".$row[0]."' selected>".$row[1]."</option>";
	} 
  mysql_free_result($result);
}	 
  return $str;
}

function tep_redirect($sub){
 if($sub != '')
 header('Location: index.php?sub='.$sub);
 else
 header('Location: index.php'); 
 exit;
}
function tep_refreshparent(){
 echo "<script language='JavaScript'>\n";
 echo "window.opener.location.href = window.opener.location.href;\n";
 echo " if (window.opener.progressWindow) \n";
 echo " { ";
 echo "    window.opener.progressWindow.close(); } \n"; 
 echo " window.close(); \n";
 echo " </script>";
 exit;
}
function showValue($val){
 return str_replace("'", "&rsquo;", $val);
}
function showPlusBtn($shDId){
  return "<input type='button' class='plusBtn' value='+' onclick='showPBTN(this ,\"".$shDId."\");'>";
}
function showEtcBtn($shDId, $sName){
  return "<input type='button' class='plusBtn' value='&#8595;' onclick='showSpravWind(this ,\"".$shDId."\", \"".$sName."\");'>";
}
function showTreeBtn($shDId, $sName){
  return "<input type='button' class='plusBtn' value='&#8595;' onclick='showTreeWind(this ,\"".$shDId."\", \"".$sName."\");'>";
}
function showParentBtn($shDId, $sName){
  global $sub, $__CUR_BTYPE;
  return "<input type='button' class='plusBtn' value='...' onclick='showChildFields(this, \"".$sub."\", this ,\"".$shDId."\", \"".$sName."\", \"".$__CUR_BTYPE."\");'>";
}
function showIntBox($name, $val = '', $style = ''){
  if(strpos($style, "maxlength") === false)
    return "<input name='$name' id='id_$name' maxlength='150' value='".showValue($val)."' $style onkeydown='return check(event);'>";
  else
    return "<input name='$name' id='id_$name' value='".showValue($val)."' $style onkeydown='return check(event);'>";
  
}
function showTextBox($name, $val = '', $style = ''){
  if(strpos($style, "maxlength") === false)
    return "<input name='$name' id = 'id_$name' maxlength='190' value='".showValue($val)."' $style>";
  else
    return "<input name='$name' id = 'id_$name' value='".showValue($val)."' $style>";
}
function showTextAreaBox($name, $val = '', $style = ''){
  $val = str_replace('\r\n', chr(13), $val);
  return "<textarea name='$name' id='id_$name' $style>$val</textarea>";
}
function showSpravBox($name, $sName, $val = '', $style = ''){
  if(strpos($style, "maxlength") === false)
     return "<nobr><input name='$name' id='id_$name' maxlength='190' value='".showValue($val)."' $style>".showEtcBtn("id_$name", $sName)."</nobr>";
  else
     return "<nobr><input name='$name' id='id_$name' value='".showValue($val)."' $style>".showEtcBtn("id_$name", $sName)."</nobr>";
}
function showTreeBox($name, $sName, $val = '', $style = ''){
  return "<nobr><input name='$name' id='id_$name' readonly='readonly' value='".showValue($val)."' $style>".showTreeBtn("id_$name", $sName)."</nobr>";
}

function getStaticSpravSQL($sprav_name) {
   global $_SESSION;
   $lang = $_SESSION['LANGS'];
   if( $lang == "ru")
     $sql = " SELECT code as `key`, IFNULL(name_ru, name) as `val` FROM s_sprav WHERE `type` = '".$sprav_name."' ORDER BY order_, name ";
   else
     $sql = " SELECT code as `key`, name as `val` FROM s_sprav WHERE `type` = '".$sprav_name."' ORDER BY order_, name ";
   return $sql;
}

function getBranchStaticSpravSQL($sprav_name) {
   global $_SESSION;
   $lang = $_SESSION['LANGS'];
   if( $lang == "ru")
     $sql = " SELECT code as `key`, IFNULL(name_ru, name) as `val` FROM b_sprav WHERE branch_id = ". getBranchID()." and `type` = '".$sprav_name."' ORDER BY order_, name ";
   else
     $sql = " SELECT code as `key`, name as `val` FROM b_sprav WHERE branch_id = ".getBranchID()." and `type` = '".$sprav_name."' ORDER BY order_, name ";
   return $sql;
}

function getBranchSQL($isName = true) {
   global $_SESSION;
   //$ru_col = "IFNULL(name_ru, name)";
   $lang = $_SESSION['LANGS'];
   if( $lang == "ru")
     $sql = " SELECT id as `key`, IFNULL(desc_ru, `desc`) as `val`, IFNULL(desc_ru, IFNULL(`desc`, name)) as `descr` FROM branch ORDER BY IFNULL(name_ru, `name`) ";
   else
     $sql = " SELECT id as `key`, `desc` as `val`, IFNULL(`desc`, name) as `descr` FROM branch ORDER BY name ";
   return $sql;
}
function showSetBox($name, $sName, $val = '', $style = ''){
  return "<nobr><input name='$name' id='id_$name' value='".showValue($val)."' $style>".showParentBtn("id_$name", $sName)."</nobr>";
}
function showUnTypeBox($name, $sName, $val = '', $style = ''){
  global $sub;
  return "<nobr><input readonly='readonly' ondblclick='showChildFieldsOfUnType(\"".$sub."\", this.id , \"".$sName."\");' name='$name' id='id_$name' value='".showValue($val)."' $style><input type='button' class='plusBtn' value='...' onclick='showChildFieldsOfUnType(\"".$sub."\", \"id_$name\", \"".$sName."\");'></nobr>";
}
function showAllRelation($field){
  global $sub;
  $url = "sub=".$sub."&fid=".$field['f_id']."&fsid=".$field['f_id_sub'];
  
  return " &nbsp;<a href='javascript:showAllRelation(\"".$url."\");'>".B_ALL_RELATION."</a>";
}

function showRelationBox($name, $field, $val = '', $style = ''){
  global $sub;
  $sName = $field['f_id'];
  $sId   = $field['id'];
  
  return "<nobr><input readonly='readonly' ondblclick='showRelationBox(\"".$sub."\", this.id , \"".$sName."\" , \"".sys_encode($sId)."\");' name='$name' id='id_$name' value='".showValue($val)."' $style><input type='button' class='plusBtn' value='...' onclick='showRelationBox(\"".$sub."\", \"id_$name\", \"".$sName."\" , \"".sys_encode($sId)."\");'></nobr>";
}
function showDateBox($name, $val = '', $style = ''){
  return "<input name='$name' id='id_$name' value='".showValue($val)."' $style>";
}
function showFileBox($name, $id,  $params, $style = ''){
  $str = "";
  if(is_array($params)){
    for($i = 0; $i < count($params); $i++)
	 $str.= showFiles($params[$i]);
  if($str != "")
    $str = "<table>".$str."</table>";
  }
  return "<input type='File' name='$name' id='id_$name' $style> ".FT_MAX_SIZE.$str;
}
function showFiles($val, $vw = true){
if(trim($val) == "") return ;
 global $__CUR_BOOK, $work, $sub;
  @list($id, $name) = explode(";", $val);
  if($id == "" || $name == '')
   return;
   $id = sys_encode($id);
 if($vw)
  return "<tr><td><a href='getfile.php?type=ek&cat=".$__CUR_BOOK."&attachment=".$id."'>$name</a></td><td><a href='javascript:isDelete(\"index.php?sub=$sub&action=delete_att&att_id=".$id."\");'>".B_DELETEA."</a></td></tr>";
 else
  return "<a href='getfile.php?type=ek&cat=".$__CUR_BOOK."&attachment=".$id."'>$name</a>";
}

function showSelectBox($name, $val, $sel_val, $style){
  $str = "";
  if($val != "" || is_array($val)){
    return "<select name='$name' id = 'id_$name' $style><option value=''></option>".tep_select($val, $sel_val)."</select>";
  }
    else
  return "<select name='$name' id = 'id_$name' $style><option value=''></option></select>";
}

function showMultiSelectBox($name, $val, $sel_val, $style){
  $str = "";
  if($val != "" || is_array($val)){
    return "<select multiple='multiple' size='5' name='$name' id = 'id_$name' $style>".tep_multi_select($val, $sel_val)."</select>";
  }
    else
  return "<select multiple='multiple' size='5' name='$name' id = 'id_$name' $style><option value=''></option></select>";
}

function tep_table($style, $aCol, $aDat){
 $col = "";
  foreach($aCol as $val){
    if(is_array($val))
	  $col .= "<th ".$val[0]." >".$val[1]."</th>";
	 else
	  $col .= "<th>".$val."</th>";
	
  }
  
 $row = ""; 
 $i = 0;
 foreach($aDat as $aRow)
 { $row .= "<tr>";
   foreach($aRow as $val){
    if(is_array($val))
	  $row .= "<td ".$val[0]." >".$val[1]."</td>";
	 else
	  $row .= "<td>".$val."</td>";
    }
    $row .= "</tr>";
  }
 return "<table ".$style."><tr class=header>".$col."</tr>".$row."</table>";
}


function tep_table_sql($style, $aCol, $aSql, $dStyle, $showEdit = false, $showDelete = false, $showChild = false, $splitName = ''){
 global $sub, $work, $_GET;
 $col = "";
 $link = "sub=$sub";
 if(isset($work) && $work != "")
  $link .= "&work=$work";
 if(isset($_GET['parent_id']))
  $link .= "&parent_id=".$_GET['parent_id'];
  
  foreach($aCol as $val){
    if(is_array($val))
	  $col .= "<th ".$val[0]." >".$val[1]."</th>";
	 else
	  $col .= "<th>".$val."</th>";
	
  }
  
 $row = ""; 
 $i = 0;
 $result = mysql_query($aSql);
  if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
  }
if(function_exists("table_sql_render")){
$j = 0;
while ($rows = mysql_fetch_array($result, MYSQL_ASSOC)) 
 {
     if($j % 2 == 0)
	   $row .= "<tr class='hr1'>";
	    else
	   $row .= "<tr class='hr2'>";
  $j++;
   $i  = 0;
   //$id = "";
   foreach($rows as $key => $val)
    {  
	if( $key == "id" || strpos($key, "hidden_") !== false )
	 continue; 
	$i++;
	if(isset($dStyle[$i]))
	   { 
	  $str = str_replace("{val}", table_sql_render($key, $val, $rows['id'], $rows), $dStyle[$i]);
	  $str = str_replace("{key}", $rows['id'], $str);
	  $row .= "<td ".$str."</td>";  }
	    else
	  $row .= "<td>".table_sql_render($key, $val, $rows['id'], $rows)."</td>"; 
	}
    if($showChild){
	$_show_child = true;
        if(function_exists("table_sql_is_delete")){
	   $_show_child = table_sql_is_delete($rows['id'], $rows);
        }
      if(table_sql_render('__B_CHILD', true, $rows['id'], $rows) == true && $_show_child)
	   $row .= "<td align='center'><a href='index.php?sub=$sub&work=child&parent_id=".sys_encode($rows['id'])."'>".B_CHILDA."</a></td>";
      else
	   $row .= "<td align='center'>".B_CHILDD."</td>";
	}
	if($showEdit){
  	 if(function_exists("table_sql_is_delete")){
	   if (table_sql_is_delete($rows['id'], $rows))
	    $row .= "<td align='center'><a href='index.php?$link&work=edit&id=".sys_encode($rows['id'])."'>".B_EDITA."</a></td>";
	   else
	    $row .= "<td align='center'>".B_EDITD."</td>";
	 } else
	  $row .= "<td align='center'><a href='index.php?$link&work=edit&id=".sys_encode($rows['id'])."'>".B_EDITA."</a></td>";
    }
	if($showDelete) {
	if(function_exists("table_sql_is_delete")){
	 if (table_sql_is_delete($rows['id'], $rows))
	    $row .= "<td align='center'><a href='#' onclick='isDelete(\"index.php?$link&action=delete&id=".sys_encode($rows['id'])."\");'>".B_DELETEA."</a></td>";
	  else
	    $row .= "<td align='center'>".B_DELETED."</td>";
	} else
	  $row .= "<td align='center'><a href='javascript:isDelete(\"index.php?$link&action=delete&id=".sys_encode($rows['id'])."\");'>".B_DELETEA."</a></td>";
    }
	$row .= "</tr>";
  }
} else {
$j = 0;
while ($rows = mysql_fetch_array($result, MYSQL_NUM)) 
 { 
     if($j % 2 == 0)
	   $row .= "<tr class='hr1'>";
	    else
	   $row .= "<tr class='hr2'>";
  $j++;
   //foreach($aRow as $val){
   for($i = 1; $i < count($rows); $i++)
    {  
	 if(isset($dStyle[$i]))
	  { 
	  $str = str_replace("{val}", $rows[$i], $dStyle[$i]);
	  $str = str_replace("{key}", $rows[0], $str);
	  $row .= "<td ".$str."</td>";  }
	    else
	  $row .= "<td>".$rows[$i]."</td>"; }
    if($showChild)
	  $row .= "<td align='center'><a href='index.php?sub=$sub&work=child&parent_id=".sys_encode($rows[0])."'>".B_CHILDA."</a></td>";
    if($showEdit)
	  $row .= "<td align='center'><a href='index.php?$link&work=edit&id=".sys_encode($rows[0])."'>".B_EDITA."</a></td>";
    if($showDelete)
	  $row .= "<td align='center'><a href='javascript:isDelete(\"index.php?$link&action=delete&id=".sys_encode($rows[0])."\");'>".B_DELETEA."</a></td>";

	$row .= "</tr>";
  }
 }
 $sp = '';
 if($splitName != '')
  $sp = tep_table_split($splitName);
 return "<table ".$style."><thead><tr class=header>".$col."</tr></thead><tbody style1='height:500px;  overflow:scroll;'>".$row."</tbody></table>".$sp;
}
function tep_table_split($name){
  global $sub, $work;

  if($work != "")
   $link = "sub=".$sub."&work=".$work;
  else $link = "sub=".$sub;
  $link .= "&split_name=".$name;
  $filter = tep_ses_getfilter($name);
  $sbox = "<select name='app_split_pcount' onchange='goSplit(\"".$link."\", ".$filter->getBegin().", this.value)'>";
   for($i = 10; $i < 60; $i += 10)
    {
	  if($i == $filter->getCount())
	    $sbox .= "<option value='$i' selected>$i</option>"; 
	  else
	    $sbox .= "<option value='$i'>$i</option>"; 
	}
  $sbox .= "</select>";
  $curp = intval($filter->getBegin() / $filter->getCount()) + 1;
  $cntp = $filter->getMaxCount() % $filter->getCount();
  if($cntp == 0)
    $cntp = $filter->getMaxCount() / $filter->getCount();
  else 
    $cntp = intval($filter->getMaxCount() / $filter->getCount()) + 1;
	$pages = "";
  if($cntp <= 10){
	for($i = 1; $i < $curp; $i++){
	  $pages .= "&nbsp;<a href='javascript:goSplit(\"".$link."\", ".($i - 1) * $filter->getCount().", ".$filter->getCount().");'>".$i."</a>";
	}
	$pages .= "&nbsp;".$curp;
	for($i = $curp + 1; $i <= $cntp; $i++){
	  $pages .= "&nbsp;<a href='javascript:goSplit(\"".$link."\", ".($i - 1) * $filter->getCount().", ".$filter->getCount().");'>".$i."</a>";
	}
  } else {
    $beg = max(1, $curp - 4);
	$end = min($cntp, $curp + 4);
	for($i = $beg; $i < $curp; $i++){
	  $pages .= "&nbsp;<a href='javascript:goSplit(\"".$link."\", ".($i - 1) * $filter->getCount().", ".$filter->getCount().");'>".$i."</a>";
	}
	$pages .= "&nbsp;".$curp;
	for($i = $curp + 1; $i <= $end; $i++){
	  $pages .= "&nbsp;<a href='javascript:goSplit(\"".$link."\", ".($i - 1) * $filter->getCount().", ".$filter->getCount().");'>".$i."</a>";
	}
	if($beg > 1)
	  $pages = "<a href='javascript:goSplit(\"".$link."\", 0, ".$filter->getCount().");'>".SPLIT_BACK."</a> ... ".$pages;
	if($end < $cntp)
	  $pages = $pages." ... <a href='javascript:goSplit(\"".$link."\", ". ($cntp - 1) * $filter->getCount().", ".$filter->getCount().");'>".SPLIT_NEXT."</a>";
  }
  return "<table align='CENTER'><tr ><td><nobr>".SPLIT_COUNT_SS."</nobr></td><td>".$sbox."</td><td width='40%' align='right'>".SPLIT_ALL_S."</td><td><b>".$filter->getMaxCount()."</b></td><td>".SPLIT_COUNT_S."</td><td><b>".$filter->getCount()."</b></td><td width='30%'>".$pages."</td></tr></table>";
}
function tep_table_cols($aDat){
 $row = ""; 
 $i = 0;
 foreach($aDat as $aRow)
 { $row .= "<tr valign='top'>";
   foreach($aRow as $val){
    if(is_array($val))
	  $row .= "<td ".$val[0]." >".$val[1]."</td>";
	 else
	  $row .= "<td>".$val."</td>";
    }
    $row .= "</tr>\n";
  }
 return $row; 
}
function sys_encode($str){
  return  base64_encode($str);
}
function sys_decode($str){
  return base64_decode($str);
}
$old_num = "";
function setDefValues($def_val, $val){
  
  if(trim($val) == "" && $def_val != ""){

    $pos = strpos($def_val, "{php}");
    if($pos === false)
	  return $def_val;
	else {
	  global $__eval_val;
	  $str = str_replace(array("{php}", '\"'), array("", "'"), $def_val);
	  @eval("\$__eval_val = ".$str);
	  $str = $__eval_val;
	}
	return $str; //"9789943"; // Uzb ISBN
  }
  return $val; 
}

function tep_tools_parse($str, $parent){
    $fields       = explode("v", $str);
    $result       = "";
    $the_last_per = "";

    foreach($fields as $key => $item){
        if(trim($item) == "" || strpos($item, "^") === false)
            continue;
        
        $sub_fields   = explode("^", $item);
        $rel_id       = $sub_fields[0];
        $rel_sub      = strtoupper($sub_fields[1]{0});  

        if(isset($parent[$rel_id][$rel_sub][0])):
             if ( $result != "" )
                 $result .= $the_last_per.$parent[$rel_id][$rel_sub][0];
             else
                 $result = $parent[$rel_id][$rel_sub][0];
        endif;    

        if(strlen($sub_fields[1]) > 1) 
          $the_last_per = substr($sub_fields[1], 1);
        else
          $the_last_per = "";
    }
    return $result; 
}

function tep_set_fieldvalue($fields, $parent){
    $result = "";

    foreach($fields as $field){
        $rel_id  = $field['f_id_unimarc'];
        $rel_sub = $field['f_id_u_sub'];
        $bt_def  = $field['bt_def_value'];
        
        if (trim($bt_def) != "")
            $result .= "^".$field['f_id_sub']."^".tep_tools_parse($bt_def, $parent);
        else if (isset($parent[$rel_id][$rel_sub][0])){
            $result .= "^".$field['f_id_sub']."^".$parent[$rel_id][$rel_sub][0];
        }
    }
    
    return $result;
}

function tep_showfield($field, $parent = array(), $book){
 global $old_num ;

  $row = array();
  if($field['type'] == "RLTN_DOC")
   return "";
  
  $bt_def  = $field['bt_def_value'];
  $rel_id  = $field['f_id_unimarc'];
  $rel_sub = $field['f_id_u_sub'];
  if($field['type'] == 'SET') {
       $sub_fields = $book->getEmptySubFieldsList($field['f_id']);
       $val        = tep_set_fieldvalue($sub_fields, $parent);
  }  else if (trim($bt_def) != ""){
       $val        = tep_tools_parse($bt_def, $parent); //$parent[$rel_id][$rel_sub][0];
  }  else if (isset($parent[$rel_id][$rel_sub][0])){
       $val        = $parent[$rel_id][$rel_sub][0];
  }  else if (isset($field['def_value']) )
       $val        = setDefValues($field['def_value'], "");
  else
      $val = "";
  
  if($field['f_id'] == $old_num)
   $row[0] = array(" valign='top' width = '25px'", "&nbsp;");
  else
  {
   $old_num = $field['f_id'];
   $row[0] = array(" valign='top' width = '25px'", "<b>".$field['f_id']."</b>");
  } 
   $row[1] = array(" valign='top' width = '20px'", "<b>".$field['f_id_sub']."</b>");
  if($field['descr'] > 0) 
   $row[2] = array(" valign='top' width = '200px'", "<a class='menu' href=\"javascript:showSprav(".$field['id'].");\">".$field['name']."</a>");
  else
   $row[2] = array(" valign='top' width = '200px'", $field['name']);
  
  if($field['mcount'] == _TAGS_UNLIM)
     $row[3] = array(" valign='top' width = '10px'", "<input type='button'  param='0' class='plusBtn' onclick='showUnlimitedField(this, ".$field['id'].");' value=' + '>");
  elseif($field['mcount'] > 1)
     $row[3] = array(" valign='top' width = '10px'", "<input type='button'  param='0' class='plusBtn' onclick='showField(this, ".$field['id'].", ".$field['mcount'].");' value=' + '>");
  else
	 $row[3] = array(" valign='top' width = '10px'", "&nbsp;"); 
  
  switch ($field['type']) {
   case "STRING" : $row[4] = showTextBox('f'.$field['id'].'[0]', '', 'class="fText"');
       break;
   case "SPRAV"  : 
        $row[4] = showSelectBox('f'.$field['id'].'[0]', getStaticSpravSQL($field['sprav_name']), '', 'class="fText" ');
       break;
   case "B_SPRAV"  : 
        $row[4] = showSelectBox('f'.$field['id'].'[0]', getBranchStaticSpravSQL($field['sprav_name']), '', 'class="fText" ');
       break;
   case "M_SPRAV"  : 
        $row[4] = showMultiSelectBox('f'.$field['id'].'[0]', getStaticSpravSQL($field['sprav_name']), '', 'class="fText" ');
       break;   
   case "DATE" 		:  $row[4] = showIntBox('f'.$field['id'].'[0]', $val, ' size="8"  maxlength="4"'); break;
   case "S_SPRAV" 	:  $row[4] = showSpravBox('f'.$field['id'].'[0]', $field['sprav_name'], $val, 'class="fText"'); break;
   case "HIRER" 	:  $row[4] = showTreeBox('f'.$field['id'].'[0]', $field['sprav_name'], $val, 'class="fText"'); break;
   case "B_HIRER" 	:  $row[4] = showTreeBox('f'.$field['id'].'[0]', $field['sprav_name'], $val, 'class="fText"'); break;
   case "INT"  		:  $row[4] = showIntBox('f'.$field['id'].'[0]', $val, ' '); break;
   case "TEXT" 		:  $row[4] = showTextAreaBox('f'.$field['id'].'[0]', '', 'rows = 3 class="fText"'); break;
   case "SET"  		:  $row[4] = showSetBox('f'.$field['id'].'[0]', $field['f_id'], $val, 'class="fText"');  break;
   case "FILE" 		:  $row[4] = showFileBox('f'.$field['id'], '', '', 'class="fText"');  break;   
   case "UN_TYPE" 	:  $row[4] = showUnTypeBox('f'.$field['id'].'[0]', $field['f_id'], '', 'class="fText"');  break;
   case "RLTN_DOC"  :  $row[4] = showRelationBox('f'.$field['id'].'[0]', $field['f_id'], '', 'class="fText"');  break;
 }
 
 if($field['mcount'] < _TAGS_UNLIM){
   for($i = 1; $i < $field['mcount']; $i++){
    switch ($field['type']) {
  	 case "STRING" : $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='non_disp'>".showTextBox('f'.$field['id'].'['.$i.']', '', 'class="fText"')."</DIV>";
          break;
  	 case "SPRAV"  : 
          $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='non_disp'>". showSelectBox('f'.$field['id'].'['.$i.']', getStaticSpravSQL($field['sprav_name']), '', 'class="fText" ')."</DIV>";
          break;
         case "B_SPRAV"  : 
          $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='non_disp'>". showSelectBox('f'.$field['id'].'['.$i.']', getBranchStaticSpravSQL($field['sprav_name']), '', 'class="fText" ')."</DIV>";
          break;
         case "M_SPRAV"  : 
          $row[4] = "<DIV ID=d".$field['id']."_".$i." class='non_disp'>". showMultiSelectBox('f'.$field['id'].'['.$i.']', getStaticSpravSQL($field['sprav_name']),'', 'class="fText" ')."</DIV>";
          break;				
         case "DATE" 	  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='non_disp'>".showIntBox('f'.$field['id'].'['.$i.']', '', ' size="8"  maxlength="4"')."</DIV>";
	  break;
	 case "S_SPRAV"   :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='non_disp'>".showSpravBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], '', 'class="fText"')."</DIV>"; break;
				     case "HIRER" 	  :  $row[4] .=  "<DIV ID=d".$field['id']."_".$i." class='non_disp'>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
				     case "B_HIRER" 	  :  $row[4] .=  "<DIV ID=d".$field['id']."_".$i." class='non_disp'>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;    
                                     case "INT" 	  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='non_disp'>".showIntBox('f'.$field['id'].'['.$i.']', '', ' ')."</div>"; break;
				     case "TEXT" 	  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='non_disp'>".showTextAreaBox('f'.$field['id'].'['.$i.']', '', 'rows=3 class="fText"')."</div>"; break;
				     case "SET"  	  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='non_disp'>".showSetBox('f'.$field['id'].'['.$i.']', $field['f_id'], '', 'class="fText"')."</div>";  break;
					 case "RLTN_DOC"  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='non_disp'>".showRelationBox('f'.$field['id'].'['.$i.']', $field['f_id'], '', 'class="fText"')."</div>";  break;
		    }
		}
  }
  
   else {
        $row[4].= "<SPAN ID=d".$field['id']."_UNLIM_FIELDS></SPAN><SPAN class='non_disp' ID=d".$field['id']."_UNLIM_FIELDS_TMPL>";
        
		//  IMPORTANT
		
		$i = _TAGS_UNLIM_INDEX;

		switch ($field['type']) {
			  	 case "STRING"    : $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showTextBox('f'.$field['id'].'['.$i.']', '', 'class="fText"')."</DIV>";
			       break;
			  	 case "SPRAV"  	  : 
			          $arr = array('keyword' => $field['sprav_name']);
			          $obj = tep_db_obj("dslist", $arr);
			          $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>". showSelectBox('f'.$field['id'].'['.$i.']', $obj['sql'], '', 'class="fText" ')."</DIV>";
			       break;
			  	 case "B_SPRAV"  	  : 
			          $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>". showSelectBox('f'.$field['id'].'['.$i.']', getBranchStaticSpravSQL($field['sprav_name']), '', 'class="fText" ')."</DIV>";
			       break;
			  	 case "M_SPRAV"  	  : 
			          $arr = array('keyword' => $field['sprav_name']);
			          $obj = tep_db_obj("dslist", $arr);
			          $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>". showMultiSelectBox('f'.$field['id'].'['.$i.']', $obj['sql'], '', 'class="fText" ')."</DIV>";
			       break;
                           
			 	 case "DATE" 	  : $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showIntBox('f'.$field['id'].'['.$i.']', '', ' size="8"  maxlength="4"')."</DIV>";
			       break;
				 case "S_SPRAV"   :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showSpravBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], '', 'class="fText"')."</DIV>"; break;
		    case "HIRER" 	  :  $row[4] .=  "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
                    case "B_HIRER" 	  :  $row[4] .=  "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
                    case "INT" 	  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showIntBox('f'.$field['id'].'['.$i.']', '', ' ')."</div>"; break;
		    case "TEXT" 	  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showTextAreaBox('f'.$field['id'].'['.$i.']', '', 'rows=3 class="fText"')."</div>"; break;
		    case "SET" 	  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showSetBox('f'.$field['id'].'['.$i.']', $field['f_id'], '', 'class="fText"')."</div>";  break;
	            case "RLTN_DOC"  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." class='display : list-item;'>".showRelationBox('f'.$field['id'].'['.$i.']', $field['f_id'], '', 'class="fText"')."</div>";  break;
		}
		
		$row[4] .= "</SPAN>";
  }
 //row[4] = array(" width = '20px';", $row[4]);
 return $row;
}
$old_num = "";


/*Sub fields of un-type */
$_ut_v_c = 0;
function tep_showeditfielduntyped($field, $vals){
 global $_ut_v_c,  $old_num;
 
  $row = array(); $num = $field['f_id']; $sub = $field['f_id_sub'];
  if($field['f_id'] == $old_num)
   $row[0] = array(" valign='top' width = '25px';", "&nbsp;");
  else
  {
   $old_num = $field['f_id'];
   $row[0] = array(" valign='top' width = '25px'", "<b>".$num."</b>");
  } 
   $row[1] = array(" valign='top'", "<nobr><b>(".$_ut_v_c."-".($_ut_v_c + $field['len']).")</b></nobr>");
  if($field['descr'] > 0) 
   $row[2] = array(" valign='top' width = '200px';", "<a class='menu' href=\"javascript:showSprav(".$field['id'].");\">".$field['name']."</a>");
  else
   $row[2] = array(" valign='top' width = '200px'", $field['name']);

   $row[3] = "";

    $val = substr($vals, $_ut_v_c, $field['len']);//$params[$num][$sub][0];
    
    $val = setDefValues($field['def_value'], $val);
	$_ut_v_c += intval($field['len']);
	
  switch ($field['type']) {
   case "STRING" : $row[4] = showTextBox('f'.$field['id'].'[0]', $val, 'class="fText"  maxlength="'.$field['len'].'"');
       break;
   case "SPRAV"  : 
        $row[4] = showSelectBox('f'.$field['id'].'[0]', getStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ');
       break;
   case "B_SPRAV"  : 
        $row[4] = showSelectBox('f'.$field['id'].'[0]', getBranchStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ');
       break;
   case "M_SPRAV"  : 
        $row[4] = showMultiSelectBox('f'.$field['id'].'[0]', getStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ');
       break;
   case "DATE" : $row[4] = showIntBox('f'.$field['id'].'[0]', $val, ' size="8"  maxlength="'.$field['len'].'"');
       break;
   case "S_SPRAV" :  $row[4] = showSpravBox('f'.$field['id'].'[0]', $field['sprav_name'], $val, 'class="fText"'); break;
   case "HIRER" :  $row[4] = showTreeBox('f'.$field['id'].'[0]', $field['sprav_name'], $val, 'class="fText"'); break;
   case "B_HIRER" :  $row[4] = showTreeBox('f'.$field['id'].'[0]', $field['sprav_name'], $val, 'class="fText"'); break;
   case "INT"  :  $row[4] = showIntBox('f'.$field['id'].'[0]', $val, '   maxlength="'.$field['len'].'" '); break;
   case "TEXT" :  $row[4] = showTextAreaBox('f'.$field['id'].'[0]', $val, 'rows = 3 class="fText"'); break;
  
 }

	 $row[3] = array(" valign='top' width = '10px';", "&nbsp;"); 
	
 //row[4] = array(" width = '20px';", $row[4]);
 return $row;
}

function tep_control_v001($params){
   $row    = array(); 
   $row[0] = array(" valign='top' width = '25px';", "<b>001</b>");
   $row[1] = array(" valign='top' width = '20px';", "<b>0</b>");
   $row[2] = array(" valign='top' width = '200px';", B_V001);
   $row[3] = "";
   if(isset($params['001']['0']['0']))
    $row[4] = array(" ", $params['001']['0']['0']);
   else
    $row[4] = "";   
   return $row;
}

function tep_control_v005($params){
   $row    = array(); 
   $row[0] = array(" valign='top' width = '25px';", "<b>005</b>");
   $row[1] = array(" valign='top' width = '20px';", "<b>0</b>");
   $row[2] = array(" valign='top' width = '200px';", B_V005);
   $row[3] = "";
   if(isset($params['001']['0']['0']))
    $row[4] = array(" ", $params['005']['0']['0']);
   else
    $row[4] = "";   
   return $row;
}

function tep_showeditfield($field, $params, $isAll = true){
 global $old_num ;
  //$val = setDefValues($field['f_id'], $field['f_id_sub']);
  $row = array(); $num = $field['f_id']; $sub = $field['f_id_sub'];
  if($field['f_id'] == $old_num)
   $row[0] = array(" valign='top' width = '25px';", "&nbsp;");
  else
  {
   $old_num = $field['f_id'];
   $row[0] = array(" valign='top' width = '25px';", "<b>".$num."</b>");
  } 
   $row[1] = array(" valign='top' width = '20px';", "<b>".$sub."</b>");
  if($field['descr'] > 0) 
   $row[2] = array(" valign='top' width = '200px';", "<a class='menu' href=\"javascript:showSprav(".$field['id'].");\">".$field['name']."</a>");
  else
   $row[2] = array(" valign='top' width = '200px';", $field['name']);

   $row[3] = "";
  $val = "";
  
  if(isset($params[$num][$sub][0]))
    $val = $params[$num][$sub][0];
  
  switch ($field['type']) {
   case "STRING" : $row[4] = showTextBox('f'.$field['id'].'[0]', $val, 'class="fText"');
       break;
   case "SPRAV"  : 
        $row[4] = showSelectBox('f'.$field['id'].'[0]', getStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ');
       break;
   case "B_SPRAV"  : 
        $row[4] = showSelectBox('f'.$field['id'].'[0]', getBranchStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ');
       break;
   case "M_SPRAV"  : 
        $row[4] = showMultiSelectBox('f'.$field['id'].'[0]', getStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ');
       break;
   case "DATE" : $row[4] = showIntBox('f'.$field['id'].'[0]', $val, ' size="8"  maxlength="4"');
       break;
   case "S_SPRAV" :  $row[4] = showSpravBox('f'.$field['id'].'[0]', $field['sprav_name'], $val, 'class="fText"'); break;
   case "HIRER" :    $row[4] = showTreeBox('f'.$field['id'].'[0]', $field['sprav_name'], $val, 'class="fText"'); break;
   case "B_HIRER" :    $row[4] = showTreeBox('f'.$field['id'].'[0]', $field['sprav_name'], $val, 'class="fText"'); break;
   case "INT"  :  $row[4] = showIntBox('f'.$field['id'].'[0]', $val, ' '); break;
   case "TEXT"      :  $row[4] = showTextAreaBox('f'.$field['id'].'[0]', $val, 'rows = 3 class="fText"'); break;
   case "SET"       :  $row[4] = showSetBox('f'.$field['id'].'[0]', $field['f_id'], ((isset($params[$num]))?__arr2box($params[$num], 0):""), 'class="fText"'); break;
   case "FILE"      :  $row[4] = showFileBox('f'.$field['id'], 'f'.$field['id'], (isset($params[$num][$sub])?$params[$num][$sub]:""), 'class="fText"');  break;   
   case "UN_TYPE"   :  $row[4] = showUnTypeBox('f'.$field['id'].'[0]', $field['f_id'], $val, 'class="fText"');  break;   
   case "RLTN_DOC"  :  $row[4] = showRelationBox('f'.$field['id'].'[0]', $field, $val, 'class="fText"').showAllRelation($field);  break;
 }
if($isAll):
   $par = 0;
      if($field['mcount'] < _TAGS_UNLIM){
  		     for($i = 1; $i < $field['mcount']; $i++){
				   if(isset($params[$num][$sub][$i]))
				   { $val = $params[$num][$sub][$i]; $cl = ""; $par = $i;}
				   else
				   { $val = ""; $cl = "class='non_disp'";}
				   switch ($field['type']) {
				  	 case "STRING" : $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showTextBox('f'.$field['id'].'['.$i.']', $val, 'class="fText"')."</DIV>";
				       break;
       case "SPRAV"  : 
        $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>". showSelectBox('f'.$field['id'].'['.$i.']', getStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ')."</DIV>";
       break;
       case "B_SPRAV"  : 
        $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>". showSelectBox('f'.$field['id'].'['.$i.']', getBranchStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ')."</DIV>";
       break;
       case "M_SPRAV"  : 
        $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>". showMultiSelectBox('f'.$field['id'].'['.$i.']', getStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ')."</DIV>";
       break;

   
				 	 case "DATE" : $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showIntBox('f'.$field['id'].'['.$i.']', $val, ' size="8"  maxlength="4"')."</DIV>";
				       break;
					 case "S_SPRAV" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showSpravBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
				     case "HIRER" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
				     case "B_HIRER" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;    
                                     case "INT"  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showIntBox('f'.$field['id'].'['.$i.']', $val, ' ')."</div>"; break;
				     case "TEXT" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showTextAreaBox('f'.$field['id'].'[',$i.']', $val, 'rows=3 class="fText"')."</div>"; break;
				     case "SET"  :  $val = ((isset($params[$num]))?__arr2box($params[$num], $i):""); 
					                if($val != "")
									   $cl = ""; 
									  else
									   $cl = "class='non_disp'";
								    $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showSetBox('f'.$field['id'].'['.$i.']', $field['f_id'], $val, 'class="fText"')."</div>";  break;
				     case "RLTN_DOC"  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showRelationBox('f'.$field['id'].'['.$i.']', $field, $val, 'class="fText"')."</div>";  break;
				 }
			}
    } else {
  		     //for($i = 1; $i < $field['mcount']; $i++){
			 
			 //while(isset($params[$num][$sub][$i])){
            if(isset($params[$num]))
			 for($i = 1; $i < getArrayMaxCount($params, $num); $i++){
				   if(isset($params[$num][$sub][$i]))
				   { $val = $params[$num][$sub][$i]; $cl = ""; $par = $i;}
				   else
				   { $val = ""; $cl = "class='non_disp'";}
				   switch ($field['type']) {
				  	 case "STRING" : $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showTextBox('f'.$field['id'].'['.$i.']', $val, 'class="fText"')."</DIV>";
				           break;
				  	 case "SPRAV"  : 
				          $arr = array('keyword' => $field['sprav_name']);
				          $obj = tep_db_obj("dslist", $arr);
				          $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>". showSelectBox('f'.$field['id'].'['.$i.']', $obj['sql'], $val, 'class="fText" ')."</DIV>";
				          break;
				  	 case "B_SPRAV"  : 
				          $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>". showSelectBox('f'.$field['id'].'['.$i.']', getBranchStaticSpravSQL($field['sprav_name']), $val, 'class="fText" ')."</DIV>";
				          break;
				 	 case "DATE" : $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showIntBox('f'.$field['id'].'['.$i.']', $val, ' size="8"  maxlength="4"')."</DIV>";
				       break;
					 case "S_SPRAV" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showSpravBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
				     case "HIRER" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
				     case "B_HIRER" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
				     case "INT"  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showIntBox('f'.$field['id'].'['.$i.']', $val, ' ')."</div>"; break;
				     case "TEXT" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showTextAreaBox('f'.$field['id'].'[',$i.']', $val, 'rows=3 class="fText"')."</div>"; break;
				     case "SET"  :  $val = ((isset($params[$num]))?__arr2box($params[$num], $i):""); 
					                if($val != "")
									   $cl = ""; 
									  else
									   $cl = "class='non_disp'";
								    $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showSetBox('f'.$field['id'].'['.$i.']', $field['f_id'], $val, 'class="fText"')."</div>";  break;
				     case "RLTN_DOC"  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." $cl>".showRelationBox('f'.$field['id'].'['.$i.']', $field, $val, 'class="fText"')."</div>";  break;
				 }
			 
			}
        $row[4].= "<SPAN ID=d".$field['id']."_UNLIM_FIELDS></SPAN><SPAN class='non_disp' ID=d".$field['id']."_UNLIM_FIELDS_TMPL>";
        /**
		*  IMPORTANT
		*/
		$i = _TAGS_UNLIM_INDEX;

		switch ($field['type']) {
			  	 case "STRING" : $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showTextBox('f'.$field['id'].'['.$i.']', '', 'class="fText"')."</DIV>";
			       break;
			  	 case "SPRAV"  : 
			          $arr = array('keyword' => $field['sprav_name']);
			          $obj = tep_db_obj("dslist", $arr);
			          $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>". showSelectBox('f'.$field['id'].'['.$i.']', $obj['sql'], '', 'class="fText" ')."</DIV>";
			       break;
			  	 case "B_SPRAV"  : 
			          $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>". showSelectBox('f'.$field['id'].'['.$i.']', getBranchStaticSpravSQL($field['sprav_name']), '', 'class="fText" ')."</DIV>";
			       break;
			 	 case "DATE" : $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showIntBox('f'.$field['id'].'['.$i.']', '', ' size="8"  maxlength="4"')."</DIV>";
			       break;
				 case "S_SPRAV" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showSpravBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], '', 'class="fText"')."</DIV>"; break;
			     case "HIRER" :  $row[4] .=  "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
			     case "B_HIRER" :  $row[4] .=  "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showTreeBox('f'.$field['id'].'['.$i.']', $field['sprav_name'], $val, 'class="fText"')."</DIV>"; break;
			     case "INT" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showIntBox('f'.$field['id'].'['.$i.']', '', ' ')."</div>"; break;
			     case "TEXT" :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showTextAreaBox('f'.$field['id'].'['.$i.']', '', 'rows=3 class="fText"')."</div>"; break;
			     case "SET"  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showSetBox('f'.$field['id'].'['.$i.']', $field['f_id'], '', 'class="fText"')."</div>";  break;
				 case "RLTN_DOC"  :  $row[4] .= "<DIV ID=d".$field['id']."_".$i." style='display : list-item;'>".showRelationBox('f'.$field['id'].'['.$i.']', $field, $val, 'class="fText"')."</div>";  break;
	    }
		
		$row[4] .= "</SPAN>";
	 
	}
   /*if($field['mcount'] > 1)
     $row[3] = array(" valign='top' width = '10px';", "<input type='button'  param='$par' class='plusBtn' onclick='showField(this, ".$field['id'].", ".$field['mcount'].");' value=' + '>");
    else
	 $row[3] = array(" valign='top' width = '10px';", "&nbsp;"); */

  if($field['mcount'] == _TAGS_UNLIM){
     if(isset($params[$num][$sub]) == false){
	   $cnto = getArrayMaxCount($params, $num);
	 } else {
	   $cnto = count($params[$num][$sub]) - 1;
	 }
	 $row[3] = array(" valign='top' width = '10px'", "<input type='button'  param='".$cnto."' class='plusBtn' onclick='showUnlimitedField(this, ".$field['id'].");' value=' + '>");
  }elseif($field['mcount'] > 1)
     $row[3] = array(" valign='top' width = '10px'", "<input type='button'  param='0' class='plusBtn' onclick='showField(this, ".$field['id'].", ".$field['mcount'].");' value=' + '>");
  else
	 $row[3] = array(" valign='top' width = '10px'", "&nbsp;"); 	 
else:
  $row[3] = array(" valign='top' width = '10px';", "&nbsp;"); 
endif;
 //row[4] = array(" width = '20px';", $row[4]);
 return $row;
}
 function __arr2box($arr, $ind){
   $str = "";
   if(!is_array($arr) || !(count($arr) > 0))
     return "";
   foreach($arr as $key => $val){
     if(isset($val[$ind]))
  	   $str.="^".$key."^".$val[$ind];
   }
   return $str;
 }
 function  html2doc(){ // $text - have to be without <HTML><BODY>
    return "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\n
xmlns:w=\"urn:schemas-microsoft-com:office:word\"\n
xmlns=\"http://www.w3.org/TR/REC-html40\">\n
\n
<head>\n
<meta http-equiv=Content-Type content=\"text/html; charset=windows-1251\">
<meta name=ProgId content=Word.Document>
<meta name=Generator content=\"Microsoft Word 11\">
<meta name=Originator content=\"Microsoft Word 11\">
</head>
<body>";
  }
 function tep_decode_link($str){
  $chars = array("�`", "�`", "�`", "�`", "�`", "�`", "�`", "�`");
  $width = array("&#1179", "&#1178", "&#1118", "&#1038", "&#1171", "&#1170", "&#1203", "&#1202");
  //k - 1179 K - 1178, x - 1203, X - 1202, g - 1171, G - 1170, o` - 1118, O` - 1038
  return str_replace($chars, $width, $str);
 }
 function tep_remove_chars($str){
   $str = trim($str);
   $beg = substr($str, -1);
   if($beg == "=" || $beg == ":" || $beg == "/")
    $str = substr($str, 0, -1);
   $beg = $str{0};
   if($beg == "=" || $beg == ":" || $beg == "/")
    $str = substr($str, 1);
  return $str;
 }
 function tep_toarray($descr){
    $pars = array();
  	$rows = explode(_CH_, $descr);
	$cntA = array();
	foreach($rows as $row){
	  if($row == "")
	     continue;
	  
	  $arr = explode("^", $row);
	  $key = trim($arr[0]);
	  if(isset($cntA[$key]))
          $cntA[$key]++;
	   else
	      $cntA[$key] = 0;
	  for($i = 1; $i < count($arr); $i += 2)
	    $pars[$key][$arr[$i]][$cntA[$key]] = $arr[$i + 1];
	}
   return $pars;
  }
 function tep_tree_display($sprav, $id, $nodeInd, $code, $txt, $sbCnt, $isEnd = false, $isParentEnd = false){
   $btm_ = "";
   $obj_ = "j";
   if($isEnd)
     $btm_ = "bottom";
   echo "\n<div class='dTreeNode'>";
   if(!$isParentEnd) {
     for($i = 0; $i < $nodeInd; $i++)
       echo '<img src="images/line.gif" alt="">';
    } else {
     for($i = 0; $i < $nodeInd; $i++)
       echo '<img src="images/empty.gif" alt="">';
	}
   if($nodeInd > 0)	
     echo '<img src="images/join'.$btm_.'.gif" alt="">';
  
  if($sbCnt == 0)
      echo '<img id="'.$obj_.'img'.$id.'" src="images/page.gif" alt="">';
   else
      echo '<a href="#" onclick="showChildSprav(\''.$obj_.'\', \''.sys_encode($id).'\', '.$id.', '.($nodeInd + 1).', \''.$sprav.'\', '.(($isEnd)?"true":"false").');"><img border="0" id="'.$obj_.'img'.$id.'" closedsrc="images/plus'.$btm_.'.gif" openedsrc="images/minus'.$btm_.'.gif" src="images/plus'.$btm_.'.gif" alt=""></a><img id="'.$obj_.'id'.$id.'" src="images/folder.gif" alt="">';
    echo  "<a id=\"s".$obj_.$id."\" class=\"node\" href=\"#\" onclick=\"selectedItem('".sys_encode($id)."', '".$code."');\" >(".$code.") ".$txt."</a>";
  //echo '</div>';
   echo "\n<div id='".$obj_.$obj_.$id."' class='clip' style='display: none;'></div>";
  echo "</div>"; 
 }
 
 function tep_get_lang(){
   global $_SESSION;
   if($_SESSION['LANGS'] == 'uz' || $_SESSION['LANGS'] == 'ru')
    return $_SESSION['LANGS'];
   return 'uz';
 }
 
 function getArrayMaxCount($arr, $elem){
   if(!isset($arr[$elem]))
     return 0;

   if(!is_array($arr[$elem]))
     return 0;

   $max = 0;
   foreach ($arr[$elem] as $value){
     if(is_array($value) && $max < count($value))
	   $max = count($value);
   }
   return $max;
 }

 function get_next_v001($cat_id, $book_id){
     global $_SESSION;
     $id  = $_SESSION['CAT_LIST_IDS'][$cat_id];
     while(strlen($id) < 3) $id = "0".$id;
     while(strlen($book_id) < 8) $book_id = "0".$book_id;
     
     return "UZ/CR/".$id.$book_id;
 }
 
 function set_first_cat_list(){
     global $_SESSION, $__CUR_BTYPE;
       
     foreach($_SESSION['BTYPE_LIST_TYPE'] as $key_ => $val_){
         $_SESSION['CUR_BTYPE'] = $key_;
         $__CUR_BTYPE           = $_SESSION['CUR_BTYPE'];
     }
}

function tep_catlist_select(){
    global $_SESSION, $__CUR_BTYPE;
    
    foreach($_SESSION['BTYPE_LIST'] as $key => $val){
        echo "<option value='$key'";
        //if($_SESSION['BTYPE_LIST_TYPE'][$key] != 'book')
        //    echo " disabled='disabled' "; 
        if($__CUR_BTYPE == $key)
            echo " selected "; 
        echo "> $val";
        echo "</option>";
    }
}

function tep_refresh_book_type(){
   global $_SESSION, $__CUR_BTYPE;
   $_type = $_SESSION['BTYPE_LIST_TYPE'][$__CUR_BTYPE];
   if($_type != 'book')
       set_first_cat_list();
}

function tep_json_array($array){
    $str = "";
    foreach($array as $key => $val){
        if ($str != "")
          $str .= ', "'.$key.'" : "'.$val.'"';
        else
          $str .= '"'.$key.'" : "'.$val.'"';  
    } 
    
    return "{ ".$str." }";
}

function db_encrypt($str)
{
    return crypt($str, 'r1');
}
?>