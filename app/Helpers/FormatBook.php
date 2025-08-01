<?php
//include_once(CLASSES."field.class.php");
namespace App\Helpers;

class FormatBook{
  var $_ID        = "";
  var $_D_SPRAV_A =  array();  // list of adding Spav values
  var $_D_SPRAV_D =  array();  // list of removing Sprav values
  var $_S_SPRAV_A =  array();  // list of adding Spav values
  var $_S_SPRAV_D =  array();  // list of removing Spav values

  //var $_S_SPRAV_D =  array();  // list of removing Sprav values
  var $_PARAMS    =  array();   // old parametrs
  var $_DESCR     =  "";//array();
  var $_BTYPE_ID  =  "";

  var $_CHLD_NUM  = "990";
  var $_FILE_NUM  = "900";
  var $_TYPE_NUM  = "002";
  var $_V001_NUM  = "001";
  var $_V005_NUM  = "005";
  
  var $_UPDATE_SPRAV = true;
//  var $_SHOW_FILE = false;
  function FormatBook($id = '', $params = ''){
    
    $this->_ID = $id;
    if(is_array($params)){
       $this->_PARAMS = array();
       $this->_PARAMS = $params;
    }
  }

  function getId(){
    return $this->_ID;    
  }
  
//   function isDublicate($_POST){
//     global $__CUR_BOOK;
// 	if(isset($_POST['f9'][0])){
// 	   $isbn = $_POST['f9'][0];

// 	   if(trim($isbn) != ""){
//          $isbn = trim(substr($isbn, 3));
// 		 if(strlen($isbn) > 0){
// 		          $arr = array("name" => $isbn, "key" => "isbn");
// 			      $obj = tep_db_obj("z".$__CUR_BOOK."_d_ss", $arr, "id");
// 				  if(is_array($obj))
// 				   return true;
// 		 }
// 	   }
// 	 }
// 	return false;
//   }

  function getParameters(){
    $this->_toarray();
    return $this->_PARAMS;
  }
  
  function getBTypeId(){
    global $__CUR_BOOK;
    if($this->_BTYPE_ID != "")
	 return $this->_BTYPE_ID;
	if($this->_ID != "")
	 {
       $arr = array("id" => $this->_ID);
	   $obj = tep_db_obj("z".$__CUR_BOOK, $arr, "btype_id");
     if(isset($obj['btype_id'])){
   	   $this->_BTYPE_ID  = $obj['btype_id'];
	   return $this->_BTYPE_ID;
	  } 
	 }
	 return "";
  }
  function getBTypeKey(){
    return $this->getBTypeId();
  }

  function getSetMaxCounts(){
    $sql = "select f_id, mcount from tags where `type` = 'SET'";
	$result = mysql_query($sql);
	$rows = array();
    while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	   $rows[$row['f_id']] = $row['mcount'];
	return $rows;
  }

  function getAllFieldList(){
   global $_SESSION;
     $sql = "select id, f_id, f_id_sub, f_id_unimarc, f_id_u_sub, name_".tep_get_lang()." name, mcount, type, sprav_name, recur, length(desc_".tep_get_lang().") descr from tags ".
    "where `type` <> 'SET' order by ord";
   $result = mysql_query($sql);
   //return mysql_fetch_array($result, MYSQL_ASSOC);
   $rows = array();
   while($row = mysql_fetch_array($result, MYSQL_ASSOC))
     $rows[] = $row;
   return $rows;
  }

  function getEmptyFieldByNum($num, $sub, $isSet){
      
      if ($isSet){
          $sql = " select id, f_id, f_id_sub, f_id_unimarc, f_id_u_sub, name_".tep_get_lang()." name, mcount, type, sprav_name, recur, ".
          " length(desc_".tep_get_lang().") descr, ud1, len, def_value, '' bt_def_value from tags ".
          " where `type` = 'SET' and f_id = '".$num."' ";
      } else {
          $sql = " select id, f_id, f_id_sub, f_id_unimarc, f_id_u_sub, name_".tep_get_lang()." name, mcount, type, sprav_name, recur, ".
          " length(desc_".tep_get_lang().") descr, ud1, len, def_value, '' bt_def_value from tags ".
          " where `f_id_sub` = '$sub' and f_id = '$num' ";
      }

     $result = mysql_query($sql);
     $rows = array();
     while($row = mysql_fetch_array($result, MYSQL_ASSOC))
       $rows[] = $row;

     return $rows;
  }

  function getEmptyFieldsList($id = ''){
  global $__CUR_BTYPE;
  if($id == ''){
   $sql = " select id, f_id, f_id_sub, f_id_unimarc, f_id_u_sub, name_".tep_get_lang()." name, mcount, type, sprav_name, recur, ".
          " length(desc_".tep_get_lang().") descr, ud1, len, def_value, bt_tags.default_value bt_def_value from tags, bt_tags ".
          " where (`type` = 'SET' OR `type` = 'UN_TYPE' OR f_id not in ".
          " (select f_id from tags where `type` = 'SET' or `type` = 'UN_TYPE')) ".
          " and tags.id = bt_tags.tag_id AND btype_id in ('$__CUR_BTYPE', '_gen_') order by ord ";
   
  } else {
   $sql = " select id, f_id, f_id_sub, f_id_unimarc, f_id_u_sub, name_".tep_get_lang()." name, mcount, type, sprav_name, recur, ".
          " length(desc_".tep_get_lang().") descr, ud1, len, def_value, bt_tags.default_value bt_def_value from tags, bt_tags ".
          " where id = $id AND (`type` = 'SET' OR `type` = 'UN_TYPE' OR f_id not in ".
          " (select f_id from tags where `type` = 'SET' or `type` = 'UN_TYPE')) ".
          " and tags.id = bt_tags.tag_id AND btype_id in ('$__CUR_BTYPE', '_gen_') order by ord ";
  }
   $result = mysql_query($sql);
   //return mysql_fetch_array($result, MYSQL_ASSOC);
   $rows = array();
   while($row = mysql_fetch_array($result, MYSQL_ASSOC))
     $rows[] = $row;
   return $rows;
  }
  
  function getField($id){
    $sql = "SELECT t.id, f_id, f_id_sub, f_id_unimarc, f_id_u_sub, t.name_".tep_get_lang()." name, mcount, ud1, ud2, recur, b.id btype_id FROM tags t left join btypes b on (b.key = t.ud1) WHERE t.id = ".$id;
   
   $result = mysql_query($sql);
   //return mysql_fetch_array($result, MYSQL_ASSOC);
   $rows = array();
   while($row = mysql_fetch_array($result, MYSQL_ASSOC))
     $rows[] = $row;
   return $rows;
  }
  function getEmptySubFieldsList($fid){
   global $__CUR_BTYPE;

   //$sql = "SELECT id, f_id, f_id_sub, f_id_u_sub, f_id_unimarc, name_".tep_get_lang()." name, mcount, type, sprav_name, recur, length(desc_".tep_get_lang().") descr, len, def_value FROM tags WHERE f_id = '$fid' and f_id_sub <> '' and f_id_sub <> '0' and id IN (SELECT tag_id FROM bt_tags WHERE btype_id = $__CUR_BTYPE) order by ord";
   if ($fid == '008') {
       $obj    = tep_db_obj("btypes", array("key" => $__CUR_BTYPE), "type");
       $b_type = $obj['type'];
       
       $sql   = "SELECT id, f_id, f_id_sub, f_id_u_sub, f_id_unimarc, name_".tep_get_lang()." name, mcount, type, sprav_name, recur, ".
            " length(desc_".tep_get_lang().") descr, len, def_value, def_value bt_def_value FROM tags WHERE f_id = '$fid' and f_id_sub <> '' and f_id_sub <> '0' and ".
            " f_id_unimarc in ('all', '$b_type') order by ord ";       
   } else
       $sql   = "SELECT id, f_id, f_id_sub, f_id_u_sub, f_id_unimarc, name_".tep_get_lang()." name, mcount, type, sprav_name, recur, ".
            " length(desc_".tep_get_lang().") descr, len, def_value, bt_tags.default_value bt_def_value FROM tags, bt_tags WHERE f_id = '$fid' and f_id_sub <> '' and f_id_sub <> '0' and ".
            " tags.id = bt_tags.tag_id and btype_id = '$__CUR_BTYPE' order by ord ";

   $result = mysql_query($sql);
   //return mysql_fetch_array($result, MYSQL_ASSOC);
   $rows = array();
   while($row = mysql_fetch_array($result, MYSQL_ASSOC))
     $rows[] = $row;
   return $rows;
  }
  function getMaxIdCountBooks(){
   global $__CUR_BOOK;
  	$qur = "select count(*) cnt from z".$__CUR_BOOK;
	$res = mysql_query($qur);
	$row = mysql_fetch_row($res);
    return $row[0];
  }
  
  function delete(){
    global $__DIN_SPRAV__, $__CUR_BOOK;
   // removing from SPRAV
   $arr = array("book_id" => $this->_ID);
	foreach($__DIN_SPRAV__ as $val){
	  $tn = "z".$__CUR_BOOK."_d_".$val; 
	  tep_db_delete($tn."x", $arr);
	}
	$tn = "z".$__CUR_BOOK."_d_ss"; 
    
    tep_db_delete($tn."x", $arr);
    $this->_refreshsprav();	
   // removing attachments
    $arr = array("book_id" => $this->_ID);
    $objs = tep_db_objects("z".$__CUR_BOOK."_att", $arr, "att_id");
    foreach($objs as $file){
        $this->deleteFile($file["att_id"]);
    }
   // removing relation
    $arr = array("child_id" => $this->_ID);
	tep_db_delete("z".$__CUR_BOOK."_relation", $arr);   	
   // removing book_desc
    $arr = array("id" => $this->_ID);
	tep_db_delete("z".$__CUR_BOOK, $arr);
   // removing copy
    $arr = array("book_id" => $this->_ID);
	tep_db_delete("z".$__CUR_BOOK."_inv", $arr);   	
  }
 
//   function update($_POST, $isByParam = false, $str=''){
//     global $__DIN_SPRAV__, $__CUR_BOOK;
//          $this->_getSprav ();  // building REMOVE section

//          $tn = "z".$__CUR_BOOK."_d_ss"; 
// 	 $arr = array("book_id" => $this->_ID);
// 	 tep_db_delete($tn."x", $arr);
	  
//          $tn = "z".$__CUR_BOOK."_d_ss"; 
// 	 $sql = "delete from ".$tn." where id not in (SELECT DISTINCT ss_id FROM ".$tn."x )";
	  
//         tep_db_query($sql);
	  
//         $this->_refreshsprav();	
//         if ($isByParam == true){
//             $this->_PARAMS = $str;
//             $str = $this->_getparamstring();
//             $arr = array("descr" => $str, "id" => $this->_ID); //, "cam_mod" => "1", "dat_mod" => date("d-m-Y"));
//             tep_db_update("z".$__CUR_BOOK, $arr);
//         }else{
//             $str = $this->_getstring($_POST);
//             $arr = array("descr" => $str, "id" => $this->_ID); //, "cam_mod" => "1", "dat_mod" => date("d-m-Y"));
//             tep_db_update("z".$__CUR_BOOK, $arr);
//         }
//         $this->_remove_changed_sprav();
//         $this->_updatesprav();
// 	//$this->addChildRealtions();
//   }


  
//   function add($_POST, $isByParam = false){
//    if($isByParam == true){
//       $str = $this->_getparamstring();
//       $this->_insert($str);
//    } else {
//       $str = $this->_getstring($_POST);
//       $this->_insert($str);
//    }
//    //$this->addChildRealtions();
//   }
  
  function deleteFile($id){
   global $__CUR_BOOK;
    $file = tep_db_obj("z".$__CUR_BOOK."_att", array("att_id" => $id));
    if ($file['place'] == "1"){
        $file_name = DATA_DIR.$this->getFileName($__CUR_BOOK, $id, $file['name']);
        @unlink($file_name);
    }
    tep_db_delete("z".$__CUR_BOOK."_att", array("att_id" => $id));
  }

  function addFile($_FILE, $toDB = false, $type = "", $size = ""){
    global $__CUR_BOOK;
    $str = "";
    
    if(is_array($_FILE)){
      foreach($_FILE as $key => $val){
	  if(!isset($val['tmp_name']) || $val['tmp_name'] == '')
	   continue;
	  $id = substr($key, 1);
	  $fields = $this->getEmptyFieldsList($id);
 	   $num  = $fields[0]['f_id'];
	   $sub  = $fields[0]['f_id_sub'];
	   //move_uploaded_file($_FILES["v950"]["tmp_name"], DB.RROOT."\\".$mfn."_".$_FILES["v950"]["name"]);
	   $fp   = fopen($val['tmp_name'], 'r');
       $content = fread($fp, $val['size']);
       //$content = addslashes($content);
       fclose($fp);
       $fileName = $val['name'];
       $arr = array();
	   $arr['book_id'] = $this->_ID; $arr['name'] = $fileName;
	   $arr['type'] = $val['type']; $arr['size'] = $val['size'];
	   $arr['file'] = $content;
	   
	  $ins = $this->storeFile($__CUR_BOOK, $arr, $toDB);//tep_db_insert("z".$__CUR_BOOK."_att", $arr);
	  $str .= _CH_.$num."^".$sub."^".$ins;
	}
   } else {
     $fn = $_FILE; //local file
     if(file_exists($fn)):
	   $arr['size'] = $size != "" ? $size : filesize($fn);
	   $arr['type'] = $type != "" ? $type : filetype($fn);
	   $arr['book_id'] = $this->_ID;
	   $arr['name'] = basename($fn);
	   
           $fp   = fopen($fn, 'r');
           $content = fread($fp, $arr['size']);
           fclose($fp);
	   $arr['file'] = $content;
  	   $ins = $this->storeFile($__CUR_BOOK, $arr, $toDB);//tep_db_insert("z".$__CUR_BOOK."_att", $arr);
	 endif;
   }
  }

  function getFileName($ek_name, $att_id, $file_name){
      return $ek_name."_".$att_id."_".$file_name;
  }

  private function storeFile($book, $params, $toDB = true){
      if ($toDB) {
          $params['place'] = '0';
          return tep_db_insert("z".$book."_att", $params);
      } else {
          $params['place'] = '1';
          $content = $params['file'];
          unset($params['file']);
          $att_id    = tep_db_insert("z".$book."_att", $params);
          $file_name = DATA_DIR.$this->getFileName($book, $att_id, $params['name']);
          if (!$handle = fopen($file_name, 'w')) {
             echo "Cannot open file ($file_name)";
            exit;
          }
         // Write $somecontent to our opened file.
          if (fwrite($handle, $content) === FALSE) {
             echo "Cannot write to file ($filename)";
             exit;
          }
          fclose($handle);
      }
  }

  function addCopy($arr, $warn = true){
    global $__CUR_BOOK;
	 if (!isset($arr['INVMODE'])) $arr['INVMODE'] = "U";
         if (!isset($arr['CNT']))     $arr['CNT'] = 1;
         if (!isset($arr['T090E']))   $arr['T090E'] = "";
         if (!isset($arr['T876P']))   $arr['T876P'] = "";
    
	 if($arr['INVMODE'] != "U" && $arr['CNT'] > 1){
	   $inv = $arr['T090E']; $sht = $arr['T876P']; $cnt = $arr['CNT'];
	   $arr['book_id'] = $this->_ID; $arr['CNT'] = 1;
	   tep_db_insert("z".$__CUR_BOOK."_inv", $arr, $warn);

	   for($i = 1; $i < $cnt; $i++){
	    if($inv != "")
	    { $inv = incNum($inv);
		  $arr['T090E'] = $inv;
		  $ch['T090E']  = $inv;
		  $obj = tep_db_obj("z".$__CUR_BOOK."_inv", $ch, "inv_id, T090E");
		  if(is_array($obj))
		   return $obj;
		  
		  }
		if($sht != "")
		{ $sht = incNum($sht);  $arr['T876P'] = $sht;
		  $ch['T876P']  = $sht;
		  $obj = tep_db_obj("z".$__CUR_BOOK."_inv", $ch, "inv_id, T876P");
		  if(is_array($obj))
		   return $obj;
		}
		 $arr['CNT'] = 1;
		 tep_db_insert("z".$__CUR_BOOK."_inv", $arr, $warn);
	   }
	 } else {
  	   $inv = $arr['T090E']; $sht = $arr['T876P']; $cnt = $arr['CNT'];
	   if($arr['T090E'] != ""){
	      $ch['T090E']  = $arr['T090E'];
		  $obj = tep_db_obj("z".$__CUR_BOOK."_inv", $ch, "inv_id, t090e");
		  if(is_array($obj))
		   return $obj;
	   } else if($arr['T876P'] != ""){
	      $ch['T876P']  = $arr['T876P'];
		  $obj = tep_db_obj("z".$__CUR_BOOK."_inv", $ch, "inv_id, T876P");
		  if(is_array($obj))
		   return $obj;
	   }
	   $arr['book_id'] = $this->_ID;
	   return tep_db_insert("z".$__CUR_BOOK."_inv", $arr, $warn);
	 } 
  }
  
  function getSqlCopies($is_rdr_view = false){
    global $__CUR_BOOK;
    if($is_rdr_view)
     return "select invmode, t090e, t876p, t990t, CUSTOM3, T876C, T020D, T990N, CNT from z".$__CUR_BOOK."_inv WHERE book_id = ".$this->_ID;   
        else
    return "select inv_id as id, invmode, t090e, t876p, t990t, CUSTOM3, T876C, T020D, T990N, CNT, rdr_id from z".$__CUR_BOOK."_inv WHERE book_id = ".$this->_ID." order by id";
  }
  
  function getCopies(){
    global $__CUR_BOOK;
    return tep_db_objects("z".$__CUR_BOOK."_inv", array('book_id' => $this->_ID), "inv_id as id, invmode, t090e, t876p, t990t, CUSTOM3, T876C, T020D, T990N, CNT, rdr_id");
  }
  
  function setGivedCopy($c_id, $rdr_id){
    global $__CUR_BOOK;
	$arr = array('inv_id' => $c_id, "rdr_id" => $rdr_id, "invmode" => "1");
	
	tep_db_update("z".$__CUR_BOOK."_inv", $arr, "inv_id");
  }
  
  function getInvCode($c_id){
    global $__CUR_BOOK;
    $arr = array('inv_id' => $c_id);
	
    return tep_db_obj("z".$__CUR_BOOK."_inv", $arr, "T876P, T090E");
  }
  
  function getDescArray($descr){
     
    $this->_toarray($descr);
    return $this->_PARAMS;
  }
  
  function getParentDescArray($id){

    $this->_ID = $id;
	
    return ($this->getBParentBooks());
  }
  
  function getDescr($includeChild = false, $includeFile = false){  // it is for ISO
    global $__CUR_BOOK;
    if($this->_DESCR != "")
     return $this->_DESCR;
    
    $this->_build_params ($includeChild);
    
    return $this->_DESCR; 	
  }
  
  function setGivedCopyByCode($sh, $in, $rdr_id){
    global $__CUR_BOOK;
	$arr = array('book_id' => $this->_ID);
    if($sh != "")
	 $arr['T876P'] = $sh;
    if($in != "")
	 $arr['T090E'] = $in;
	$c_id = tep_db_obj("z".$__CUR_BOOK."_inv", $arr, "inv_id");
	$this->setGivedCopy($c_id['inv_id'], $rdr_id);
	return $c_id['inv_id'];
  } 
  function backGivedCopy($c_id){
    global $__CUR_BOOK;
	$arr = array('inv_id' => $c_id, "rdr_id" => "0", "invmode" => "0");
	
	tep_db_update("z".$__CUR_BOOK."_inv", $arr, "inv_id");
  }

  function getFreeCount($for_order = false){
    global $__CUR_BOOK;
    
    if ($for_order)
      $sql = "select sum(cnt) cnt from z".$__CUR_BOOK."_inv where book_id = ".$this->_ID." and INVMODE = '0' and (rdr_id is null OR rdr_id = 0)";
    else
      $sql = "select sum(cnt) cnt from z".$__CUR_BOOK."_inv where book_id = ".$this->_ID." and INVMODE = '0'"; // and (rdr_id is null OR rdr_id = 0)";  
    $row = mysql_query($sql);
    
    return @mysql_result($row, 0, "cnt");
  }
  
  function getFreeShtrih(){
    global $__CUR_BOOK;
    $sql = "select inv_id, T876P val from z".$__CUR_BOOK."_inv where T876P <> '' and book_id = ".$this->_ID." and INVMODE = '0'"; //  and (rdr_id is null OR rdr_id = 0)";
  // echo $sql;
   $result = mysql_query($sql);
   //return mysql_fetch_array($result, MYSQL_ASSOC);
   $rows = array();
   while($row = mysql_fetch_array($result, MYSQL_ASSOC))
     $rows[$row['inv_id']] = $row['val'];
   return $rows;
  
  }
  function getFreeInv(){
    global $__CUR_BOOK;
    $sql = "select inv_id, T090E val from z".$__CUR_BOOK."_inv where T090E <> '' and book_id = ".$this->_ID." and INVMODE = '0'"; //  and (rdr_id is null OR rdr_id = 0)";
   $result = mysql_query($sql);
   //return mysql_fetch_array($result, MYSQL_ASSOC);
   $rows = array();
   while($row = mysql_fetch_array($result, MYSQL_ASSOC))
     $rows[$row['inv_id']] = $row['val'];
   return $rows;
  
  }

  function editCopy($arr){
	 global $__CUR_BOOK;
	 //echo $this->_ID;
	 
	 return tep_db_update("z".$__CUR_BOOK."_inv", $arr, "inv_id");
  }
  function removeCopy($id){
    global $__CUR_BOOK;
	$arr['inv_id'] = $id;
	tep_db_delete("z".$__CUR_BOOK."_inv", $arr);
  }
  function getCopy($id){
    global $__CUR_BOOK;
	$arr['inv_id'] = $id;
	$obj = tep_db_obj("z".$__CUR_BOOK."_inv", $arr);
	foreach($obj as $key => $val){
	  unset($obj[$key]); $obj[strtoupper($key)] = $val;
	}
	return $obj;
  }

  // --- HIDDEN functions
  
  function _get008subs($fid, $arr){
        
	$fields = $this->getEmptySubFieldsList('008');
        //print_r($fields);
        //exit;
	$subs   = array(); $ind = 0;
	for($i = 0; $i < count($fields); $i++){
	  $subs[$fields[$i]['f_id_sub']] = array($fields[$i]['type'], $fields[$i]['sprav_name'], $ind, 
              $fields[$i]['len'], $fields[$i]['def_value']);
          $ind += $fields[$i]['len'];
	}

        $str = $arr[0];
        foreach ($subs as $key => $item){
           $value = substr($str, $item[2], $item[3]);
           $value = str_replace("|", "", $value);
           
           if (trim($value) == "")
               continue;
           
           if($item[0] == "S_SPRAV"){
   	       //echo $item[1]."<-->".$value;
               $this->_add2sprav($item[1], $value);
           } else if($item[0] == "SPRAV") {
   	       //echo $item[1]."<-->".$value;
               $this->_add2ssprav($item[1], $value);
           }
        }

      return _CH_.'008^^'.$arr[0];
  }
  
  function _getsubstring($fid, $arr){

	$fields = $this->getEmptySubFieldsList($fid);
	$subs   = array();
	for($i = 0; $i < count($fields); $i++){
	  $subs[$fields[$i]['f_id_sub']] = array($fields[$i]['type'], $fields[$i]['sprav_name']);
	}

        $str = "";
	for($i = 0; $i < count($arr); $i++):
	  if(!isset($arr[$i]))
	    continue;
	  if(trim($arr[$i]) == "")
	     continue;
	  $txt = $arr[$i];
      $str .= _CH_.$fid.$txt;
	  $txt = explode("^", $txt);
	  for($j = 1; $j < count($txt); $j += 2){
	    //echo $txt[$j]." => ".$txt[$j + 1];
	    if($subs[$txt[$j]][0] == "S_SPRAV")
		 
	    $this->_add2sprav($subs[$txt[$j]][1], trim($txt[$j + 1]));
	    
		 
		 else if($subs[$txt[$j]][0] == "SPRAV" || (($subs[$txt[$j]][0] == "STRING" || $subs[$txt[$j]][0] == "INT") && $subs[$txt[$j]][1] != ""))
  	     $this->_add2ssprav($subs[$txt[$j]][1], trim($txt[$j + 1]));
 
	  }
	endfor;
    return $str;
  }
  function _getparamstring(){
    
     $fields   = $this->getAllFieldList();
     $sets     = $this->getSetMaxCounts();
     $pred_num = "";
    
     $_params  = array();
     
     for($i = 0; $i < count($fields); $i++):
	   $type = $fields[$i]['type'];
           $num  = $fields[$i]['f_id'];

            if($type == "FILE" || $type == "RLTN_DOC")
	    continue;
  	   //$id   = $fields[$i]['id'];
	   $num  = $fields[$i]['f_id'];

	   $sub  = $fields[$i]['f_id_sub'];
	   $cnt  = max($fields[$i]['mcount'], 1);
	   
           if(isset($sets[$num])){
	     $cnt  = max($cnt, $sets[$num]);
	   }
	   
           if(!isset($this->_PARAMS[$num][$sub]))
             continue;      
                   
           //$substr = "";
	   for($j = 0; $j < $cnt; $j++):
             
	     if(!isset($this->_PARAMS[$num][$sub][$j]))
		continue; //$this->_PARAMS[$num][$sub][$j] = "";
	  
             if($this->_PARAMS[$num][$sub][$j] != ""){
	        if($type == "S_SPRAV")
		   $this->_add2sprav($fields[$i]['sprav_name'], $this->_PARAMS[$num][$sub][$j]);
		else if($type == "SPRAV" || (($type == "STRING" || $type == "INT") && $fields[$i]['sprav_name'] != ""))
   	           $this->_add2ssprav($fields[$i]['sprav_name'], $this->_PARAMS[$num][$sub][$j]);
		 
                $_params[$num][$j][$sub] = $this->_PARAMS[$num][$sub][$j]; //$substr .= "^".$sub."^".$this->_PARAMS[$num][$sub][$j];
	     }
                   
           endfor;
		
     endfor;
    
     $str = ""; 
     foreach ($_params as $num => $values):
         
         foreach ($values as $ind => $subs):
            $substr = ""; 
            foreach ($subs as $sub => $value)
                $substr .= "^".$sub."^".$value;
         
            $str .= _CH_.$num.$substr;
         endforeach;
     endforeach;
     // $str - ni tayyorlash shu erda bo'
    return $str; 
  }
  
//   function _getstring($_POST){
//      $fields = $this->getEmptyFieldsList();
// 	 $str = ""; $pred_num = "";
// 	 for($i = 0; $i < count($fields); $i++):
//   	   $id   = $fields[$i]['id'];
// 	   $num  = $fields[$i]['f_id'];
// 	   $sub  = $fields[$i]['f_id_sub'];
// 	   $cnt  = max($fields[$i]['mcount'], 1);
// 	   $type = $fields[$i]['type'];
// 	   //echo $type;
// 	   $substr = "";
// 	   if($type == "FILE" || $type == "RLTN_DOC")
// 	    continue;
// 	  /* if($type == "FILE"){
//   	     $cnt = count($_POST['f'.$id]);
// 	     for($j = 0; $j < $cnt; $j++) 
// 		   $str .= _CH_.$num."^".$sub."^".$_POST['f'.$id][$j]; 
// 	   } else*/
//            if ($num == "008"){
//              $str .= $this->_get008subs($num, $_POST['f'.$id]);  
//            } else if($type == "SET"){
// 	     $str .= $this->_getsubstring($num, $_POST['f'.$id]);
// 	   } else {
// 	    //for($j = 0; $j < $cnt; $j++)
// 		$j = 0;
// 		while( ($cnt < _TAGS_UNLIM) ? ($j <= $cnt) : (isset($_POST['f'.$id][$j])))
// 	    {
// 		  if(isset($_POST['f'.$id][$j]))
// 			   if($_POST['f'.$id][$j] != ""){
// 			  		     if($type == "S_SPRAV"){
// 						   $this->_add2sprav($fields[$i]['sprav_name'], $_POST['f'.$id][$j]);
// 						 } else if($type == "SPRAV" || $type == "HIRER" || (($type == "STRING" || $type == "INT") && $fields[$i]['sprav_name'] != ""))
// 			  	   	       $this->_add2ssprav($fields[$i]['sprav_name'], $_POST['f'.$id][$j]); 
// 				 $substr .= "^".$sub."^".$_POST['f'.$id][$j];
// 			   }
// 		  $j++;
// 		}
		 
//         if($pred_num != $num && $substr != ""){
// 	     $str .= _CH_.$num.$substr; 
// 		 $pred_num = $num;
// 	    } else if($substr != ""){
//              $str .= $substr; 
// 	    }
// 	   }
// 	 endfor; // $i
// 	return $str;
//   }
 
  function _add2sprav($sprav_name, $valu){
    if($this->_UPDATE_SPRAV == false)
	  return;
    
    if($sprav_name == "keys")
	{
	  $arr = explode(",", $valu);
	  for($i = 0; $i < count($arr); $i++){
 	   $arr[$i] = substr($arr[$i], 0, 200);
	   
	   $stru = tep_db_clean_search_value($arr[$i], false);
	   
	   if (isset($this->_D_SPRAV_D[$sprav_name][strtoupper($stru)]))
	   {
	       $this->_D_SPRAV_D[$sprav_name][strtoupper($stru)] = '___USED___';
		   continue;
	   }
	   $this->_D_SPRAV_A[$sprav_name][] = $stru;
	   }
	} else {
   	  $valu = substr($valu, 0, 200);
	  $stru = tep_db_clean_search_value($valu, false);
	   
	  if (isset($this->_D_SPRAV_D[$sprav_name][strtoupper($stru)]))
	   {
	       $this->_D_SPRAV_D[$sprav_name][strtoupper($stru)] = '___USED___';;
		   return;
	   }
          
   	  $this->_D_SPRAV_A[$sprav_name][] = $stru; //trim($valu);
	}
  }
  function _add2ssprav($key, $valu){
    if($this->_UPDATE_SPRAV == false)
	  return;
    
	//if()
    $this->_S_SPRAV_A[$key][] = $valu;
  }
  
  function _getSprav (){
  
    global $__DIN_SPRAV__, $__CUR_BOOK;
  
    $this->_D_SPRAV_D = array();
	
    foreach($__DIN_SPRAV__ as $val){
  	  $tn = "z".$__CUR_BOOK."_d_".$val; 
	  $sql 	  = " SELECT z.id, z.name FROM $tn z, ".$tn."x x where z.id = x.".$val."_id and x.book_id = ".$this->_ID;
	  $result = tep_db_query($sql);
	  
          while ($row = mysql_fetch_assoc($result)) {
             $this->_D_SPRAV_D[$val][strtoupper($row['name'])] = $row['id'];
	  }
	}
	  
	  //$_S_SPRAV_D
      $tn = "z".$__CUR_BOOK."_d_ss"; 
	  $sql 	  = " SELECT z.id, z.name, `key` FROM $tn z, ".$tn."x x where z.id = x.ss_id and x.book_id = ".$this->_ID;
	  $result = tep_db_query($sql);
	  while ($row = mysql_fetch_assoc($result)) {
            $this->_S_SPRAV_D[$row['key']][strtoupper($row['name'])] = $row['id'];
	  }
  }
  
  function setUpdateSprav($bool){
    $this->_UPDATE_SPRAV = $bool;
  }
/*  function _removefromsprav($sprav_name, $valu){
    $this->_D_SPRAV_D[$sprav_name][] = $valu;
  }*/
  function _refreshsprav(){
    global $__DIN_SPRAV__, $__CUR_BOOK;
   // removing from SPRAV
	foreach($__DIN_SPRAV__ as $val){
	  $tn = "z".$__CUR_BOOK."_d_".$val; 
	  $sql = "delete from ".$tn." where id not in (SELECT DISTINCT ".$val."_id FROM ".$tn."x )";
	  tep_db_query($sql);
	}
        
        $tn = "z".$__CUR_BOOK."_d_ss"; 
	$sql = "delete from ".$tn." where id not in (SELECT DISTINCT ss_id FROM ".$tn."x )";
	tep_db_query($sql);

  }
  
   function _remove_changed_sprav(){
    global $__DIN_SPRAV__, $__CUR_BOOK;
   // removing from SPRAV

	foreach($__DIN_SPRAV__ as $val){
	  if(isset($this->_D_SPRAV_D[$val]) && count($this->_D_SPRAV_D[$val]) > 0){
	  	$_idx = "";
	  	foreach ($this->_D_SPRAV_D[$val] as $key){
	  	   
	  	   if (! is_numeric($key))
	  	    continue;
	  	   if($_idx !== "")
	  	    $_idx .= ",".$key;
	  	   else
	  	    $_idx  = $key;
	  	      	
	  	}
	  	
	   if($_idx !== "") {	
	     $tn = "z".$__CUR_BOOK."_d_".$val;
	     $sql = "delete from ".$tn."x where ".$val."_id in (".$_idx.") and book_id = ".$this->_ID;
	     tep_db_query($sql);

             $sql = "delete from ".$tn." where id in ($_idx) AND id not in (SELECT DISTINCT ".$val."_id FROM ".$tn."x )";
	     tep_db_query($sql);
	   }
	  } 
		 
	}

  }
  
  function _updatesprav(){
   //$sp = $this->_D_SPRAV_A[$sprav_name][] = $valu;
   // cuting duplicated values

   global $__CUR_BOOK;
   foreach($this->_D_SPRAV_A as $key => $row){
     if(is_array($row))
	   $row = array_unique($row);
	 else
	   continue;
	 $tn = "z".$__CUR_BOOK."_d_".$key;
	foreach($row as $val){
	   //$val = strtoupper($val);
	   $arr = array('name' => $val);
	   $obj = tep_db_obj($tn, $arr);
	   if($obj == ""){
	     // adding new record to sprav
	     $r_id = tep_db_insert($tn, $arr);
		 $arr  = array($key.'_id' => $r_id, 'book_id' => $this->_ID);
		 $r_id = tep_db_insert($tn."x", $arr, false);
	   } else {
	     // updating
 		 $arr  = array($key.'_id' => $obj["id"], 'book_id' => $this->_ID);
		 $r_id = tep_db_insert($tn."x", $arr, false);
	   }
	    
	 }
   }

   $tn = "z".$__CUR_BOOK."_d_ss";
   foreach($this->_S_SPRAV_A as $key => $row){
     if(is_array($row))
	   $row = array_unique($row);
	 else
	   continue;
     /*if(is_array($row))
	   $row = array_unique($row);
	 else
	   continue;*/
 	foreach($row as $val){
	   $arr = array('name' => $val, "key" => $key);
	   $obj = tep_db_obj($tn, $arr);
	   if($obj == ""){
	     // adding new record to sprav
	     $r_id = tep_db_insert($tn, $arr);
		 $arr  = array('ss_id' => $r_id, 'book_id' => $this->_ID);
		 $r_id = tep_db_insert($tn."x", $arr, false);
	   } else {
	     // updating
 		 $arr  = array('ss_id' => $obj["id"], 'book_id' => $this->_ID);
		 $r_id = tep_db_insert($tn."x", $arr, false);
	   }
	 }
   }
  }
  
  function _build_params ($includeChild = false){
    global $__CUR_BOOK;
    
        $arr = array("id" => $this->_ID);
        $obj = tep_db_obj("z".$__CUR_BOOK, $arr);

        $this->_DESCR     = $obj['descr'];
	$this->_BTYPE_ID  = $obj['btype_id'];
	
        $str  = _CH_.$this->_V001_NUM."^0^".$obj['v001'];
        $str .= _CH_.$this->_V005_NUM."^0^".$obj['dat_mod'];

        $arr = array("book_id" => $this->_ID);

        if ($includeChild):
            $objs = tep_db_objects("z".$__CUR_BOOK."_inv", $arr, "T876P, T990T, T090H, T090E, T090F, T090W, T876C, T020D, T020E, T990N, CNT, REGDATE, INVMODE, CUSTOM1");
            for($i = 0; $i < count($objs); $i++){
              $chld = "^0^";
              foreach ($objs[$i] as $key => $val)
                  $chld .= $key."=".$val.";";

              $str .= _CH_.$this->_CHLD_NUM.$chld;
            }
        endif;

        $objs = tep_db_objects("z".$__CUR_BOOK."_att", $arr, "att_id, name, size, type");
        for($i = 0; $i < count($objs); $i++)
          $str .= _CH_.$this->_FILE_NUM."^A^".$objs[$i]['att_id'].";".$objs[$i]['name'].";".$objs[$i]['size'].";".$objs[$i]['type'];

        $str .= _CH_.$this->_TYPE_NUM."^A^".$obj['btype_id'];
        
        $this->_DESCR.= $str;
        
  }
  
  function _toarray($descr = ''){
  global $__CUR_BOOK;
  $this->_PARAMS = array();
  
  if($descr == ''){
      $this->_build_params ();
  } else  $this->_DESCR = $descr;
	$rows = explode(_CH_, $this->_DESCR);
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
	  for($i = 1; $i < count($arr); $i += 2){
	    if(isset($this->_PARAMS[$key][$arr[$i]][$cntA[$key]]))
		          $cntA[$key]++;	    
            if (isset($arr[$i + 1]))
               $this->_PARAMS[$key][$arr[$i]][$cntA[$key]] = $arr[$i + 1];
	   }		
	}
  }
  
  function _insert($str){
    global $__CUR_BOOK, $__CUR_BTYPE;
	$arr = array("descr" => $str, "btype_id" => $__CUR_BTYPE, "v001" => " ", "cam_mod" => getUserID(), "cam_create" => getUserID(), 
            "branch_id" => getBranchID(), 
            "dat_mod" => array('DATE', "now()"));
	$this->_ID = tep_db_insert("z".$__CUR_BOOK, $arr);
        
        if (isset($this->_PARAMS['001']))
           $v001 = substr($this->_PARAMS['001'][0][0], 0, 40); // when import from ISO file     
        else
           $v001 = get_next_v001($__CUR_BOOK, $this->_ID);

        $update_params = array("id" => $this->_ID, "v001" => $v001);
        if (isset($this->_PARAMS[$this->_TYPE_NUM])){
            $update_params["btype_id"] = $this->_PARAMS[$this->_TYPE_NUM]['A'][0];
        }

        tep_db_update("z".$__CUR_BOOK, $update_params); 
	$this->_updatesprav();
  }
  
  /*
  function addChildRealtions(){
    global $_SESSION, $__CUR_BOOK, $__CUR_BTYPE;

    $_ORIG__CUR_BTYPE = $__CUR_BTYPE;

	$subBooks = tep_sess_getRelationValue();

	// before create new book we should clean ReleationSession
	
	tep_ses_cleanRelation();
	if(is_array($subBooks) == false)
	 return;

	$_fields = array();
	foreach($subBooks as $key => $valu){
	  // $valu[0] //_POST
	  // $valu[1] //_FILES
	  // id_f250[

	  $field_id = substr($key, 4, strpos($key, "[") - 4);

	  if(!isset($_fields[$field_id]))
        $_fields[$field_id] = $this->getField($field_id);

	  $field    = $_fields[$field_id];

	  $__CUR_BTYPE = $field[0]["btype_id"];

	  $book = new Book;
	  $book->add($valu[0]);
	  $book->addFile($valu[1]);

	  tep_db_insert("z".$__CUR_BOOK."_relation", array("parent_id" => $this->_ID, "child_id" => $book->_ID, "type" => $valu[0]['relation_id'], "record" => $field[0]['f_id'], "sub_record" => $field[0]['f_id_sub']));
	}

	$__CUR_BTYPE = $_ORIG__CUR_BTYPE;
  } */
 }
?>