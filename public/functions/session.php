<?php
 function tep_ses_update_dbs(){
  $_SESSION['CAT_LIST'] = array();
  $result = mysql_query("select keyword, name from tdbases");
   while($row = mysql_fetch_array($result, MYSQL_NUM))
   { 
    if($row[1] == '') $row[1] = $row[0];
	$_SESSION['CAT_LIST'][$row[0]] = $row[1];
    }
 }
 function tep_ses_update_cdt($newbt){
    global $__CUR_BTYPE;
	$_SESSION['CUR_BTYPE'] = $newbt;
    $__CUR_BTYPE = $newbt;
 }
 function tep_ses_getfilter($f_name){
   global $_SESSION;
    if(isset($_SESSION[$f_name]))
    {
	    $arr = $_SESSION[$f_name];
	    return new Filter($arr); 
	}
	 else
	   //$res = array("count" => 10, "begin" => 0, "params" => array(), "order" => "");
	   $filter = new Filter();
	   tep_ses_setfilter($f_name, $filter);
	 return $filter;
 }
 
// 
// function tep_sess_getRelationValue($idObj = ''){
//   global $_SESSION;
//   
//   if(!isset($_SESSION['___BOOK_RLTN']))
//     return "";
//   
//   if($idObj == '')
//    return $_SESSION['___BOOK_RLTN'];
//   
//   if(!isset($_SESSION['___BOOK_RLTN'][$idObj]))
//     return "";
//   
//   return $_SESSION['___BOOK_RLTN'][$idObj][0];
// }
// 
// function tep_ses_setRelation($post, $files){
//   global $_SESSION;
//   
//   if(!isset($_SESSION['___BOOK_RLTN']))
//      session_register('___BOOK_RLTN');
//   
//   $_SESSION['___BOOK_RLTN'][$post['objName']] = array($post, $files);
// }
// 
// function tep_ses_cleanRelation(){
//   global $_SESSION;
//   
//   if(isset($_SESSION['___BOOK_RLTN']))
//      session_unregister('___BOOK_RLTN');
// }
 
 function tep_ses_setfilter($f_name, $filter){
    global $_SESSION;
     if(!isset($_SESSION[$f_name]))
     session_register($f_name);
	$_SESSION[$f_name] = $filter->toArray();
 }
?>