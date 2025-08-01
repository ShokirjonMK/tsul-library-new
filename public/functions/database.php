<?php
$link = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$link) {
    die('Not connected : ' . mysql_error());
}
mysql_query ("SET NAMES cp1251");
mysql_query ("SET CHARACTER SET cp1251");
mysql_query ("SET CHARACTER_SET_CONNECTION = cp1251_general_ci");
mysql_query ("SET COLLATION_CONNECTION = cp1251_general_ci");

// make foo the current db
$db_selected = mysql_select_db(DB_NAME, $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}
function tep_db_query($query, $warn = true ){
  if($warn){
  $result = mysql_query($query);
  if (!$result) {
    echo $query ."<br>";
	die('Invalid query: ' . mysql_error());
  }
  return $result;
}  else  $result = @mysql_query($query);

}
function tep_db_insert($table, $obj, $warn = true){
  $cols = ""; $vals = "";
  foreach($obj as $key => $val){
    $cols .= " `".$key."`,";
	if(is_array($val)){
	 if($val[0] == 'DATE'){
	   if($val[1] == "now()")
	    $vals .= " now(),";
	   else
	    $vals .= " str_to_date('".mysql_escape_string($val[1])."', '%d-%m-%Y'),";
	 }
	} else	$vals .= " '".mysql_escape_string($val)."',";
  }
  $cols = substr($cols, 0, -1);
  $vals = substr($vals, 0, -1);
  $sql = "insert into ".$table."(".$cols.") values(".$vals.")";

  tep_db_query($sql, $warn);
  return mysql_insert_id();
}
function tep_db_delete($table, $obj){
  $where = "";
   foreach($obj as $key => $val)
    if($where != "")
	   $where .= " and `".$key."` = '".mysql_escape_string($val)."'";
	 else
       $where .= " `".$key."` = '".$val."'";
  tep_db_query("delete from ".$table." where ".$where);
}
function ___db_val($val){
	if(is_array($val)){
	 if($val[0] == 'DATE'){
	   return  " str_to_date('".mysql_escape_string($val[1])."', '%d-%m-%Y')";
	 }}
    return "'".mysql_escape_string($val)."'";
}
function tep_db_update($table, $obj, $key_id = 'id'){
  $where = "";
   foreach($obj as $key => $val)
   if($key != $key_id){
    if($where != "")
	   $where .= ", `".$key."` = ".___db_val($val);
	 else
       $where .= " `".$key."` = ".___db_val($val);
   }
  tep_db_query("update ".$table." set ".$where." where `".$key_id."`='".$obj[$key_id]."'");
}
function tep_db_obj($table, $obj, $fields = '*', $sub_where = ''){
  $where = "";
   foreach($obj as $key => $val)
    if($where != "")
	   $where .= " and `".$key."` = '".mysql_escape_string($val)."'";
	 else
       $where .= " `".$key."` = '".mysql_escape_string($val)."'";
  if ($where != "")
    $where = " where ".$where;
    
  // $result = mysql_query("select $fields from ".$table." ".$where.$sub_where);
  $result = mysql_query("select * from users  where  `login` = 'bibl'");
  // echo "<pre>";
// echo "select $fields from ".$table." ".$where.$sub_where;
//   print_r(mysql_fetch_array($result, MYSQL_ASSOC));
//   die();
  if($row = mysql_fetch_array($result, MYSQL_ASSOC))
  { foreach($row as $key => $val){
        
       $row[$key] = stripslashes($val);    } 
  return $row; }
  else
  return "";
}
function __tep_db_val($val){
  if(is_array($val)):
     //if($val[1] == 'LINK')
       switch($val[1]){
         case "LIKE" : 
		     if($val[2] == 'END')
			   return " like '".$val[0]."%'";
		   break;
        }
   else:
     return " = '".$val."'";
  endif;
}

function tep_db_query_array($sql){
  $result = mysql_query($sql); 

  $rows = array();
  while($row = mysql_fetch_array($result, MYSQL_ASSOC))
  { foreach($row as $key => $val){
       
	   $row[$key] = mysql_escape_string($val);    } 
  $rows[] = $row; }

  return $rows;  
}

function tep_db_objects($table, $obj, $fields = '*', $sub_where = ''){
  $where = "";
   foreach($obj as $key => $val)
    if($where != "")
	   $where .= " and `".$key."` ".__tep_db_val($val);
	 else
       $where .= " `".$key."` ".__tep_db_val($val);

  if($where != "") {
     $result = mysql_query("select $fields from ".$table." where ".$where.$sub_where);
  } else {
     $result = mysql_query("select $fields from ".$table.$sub_where);
  }

  $rows = array();
  while($row = mysql_fetch_array($result, MYSQL_ASSOC))
  { foreach($row as $key => $val){
       
	   $row[$key] = mysql_escape_string($val);    } 
  $rows[] = $row; }

  return $rows;
}

function tep_html_date($date, $sym = '-'){
  if(strlen($date) != 8)
   return $date;
   $y = substr($date, 0, 4);
   $m = substr($date, 4, 2);
   $d = substr($date, 6, 2);
   return $d.$sym.$m.$sym.$y;
}

function tep_db_clean_search_value($str, $isEscape = true){
   $str = trim($str);
      
   $str = str_replace("  ", " ", $str);  // We should use only one space
   $str = str_replace("  ", " ", $str);    
   
   return (($isEscape)?tep_db_escape($str):$str);
}
function tep_db_escape($str){
    return mysql_escape_string($str);
}

function tep_db_date($date){
  $s = explode("-", $date);
  if(strlen($s[1]) == 1)
    $s[1] = "0".$s[1];
  if(strlen($s[2]) == 1)
    $s[2] = "0".$s[2];

  return $s[2].$s[1].$s[0];
}
/*
mysql_query("insert into tst(hhh) values('�������� �������')");
$result = mysql_query("SELECT id, hhh FROM tst");

while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    printf("ID: %s  Name: %s", $row[0], $row[1]);  
}
*/

?>