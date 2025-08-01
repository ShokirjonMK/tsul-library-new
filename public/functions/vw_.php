<?php
/*
   there are list of basic functions which are 
   used in the showing data in the Bibl format
*/
$__vw_p = array();
define('vw_par', '<br>&nbsp;&nbsp;&nbsp;');

if(!function_exists('stripos')){
 function stripos($s, $f){
   return strpos($s, $f);
 }
}

function p_vw_v($num, $sub = ''){
   global $__vw_p;
   
   if (!isset($__vw_p['B_PARENT']))
       return "";
   
   if(!isset($__vw_p['B_PARENT'][$num][$sub]))
	 return "";
   
   return is_array($__vw_p['B_PARENT'][$num][$sub])?$__vw_p['B_PARENT'][$num][$sub][0]:$__vw_p['B_PARENT'][$num][$sub];
}

function vw_v_cl($num, $sub = '', $cnt = '', $in = ''){
  global $__vw_p;
  if(!isset($__vw_p[$num]))
   return "";
  if($sub === ''){ 
    $s = "";
    foreach($__vw_p[$num] as $val){
	  if(is_array($val))
  	  $s .= implode($val);
     }
	 
    return str_replace(array(", ", ". ", ",", "."), " ", $s);
  }
  if(!isset($__vw_p[$num][$sub]))
	 return "";
  if(!is_array($__vw_p[$num][$sub]))
   return str_replace(array(", ", ". ", ",", "."), " ", $__vw_p[$num][$sub]);
  if($cnt === ''){
     $s = "";
	 for($i = 0; $i < count($__vw_p[$num][$sub]) - 1; $i++)
      $s .= $__vw_p[$num][$sub][$i].$in;
    return str_replace(array(", ", ". ", ",", "."), " ", $s.$__vw_p[$num][$sub][$i]);
   } 
   $s = (!isset($__vw_p[$num][$sub][$cnt]))?"":$__vw_p[$num][$sub][$cnt];
   return str_replace(array(", ", ". ", ",", "."), " ", $s);
}

function vw_v($num, $sub = '', $cnt = '', $in = ''){
  global $__vw_p;
  if(!isset($__vw_p[$num]))
   return "";
  if($sub === ''){ 
    $s = "";
    foreach($__vw_p[$num] as $val){
	  if(is_array($val))
  	  $s .= implode($val);
     }
    return $s;
  }
  if(!isset($__vw_p[$num][$sub]))
	 return "";
  if(!is_array($__vw_p[$num][$sub]))
   return $__vw_p[$num][$sub];
  if($cnt === ''){
     $s = "";
	 for($i = 0; $i < count($__vw_p[$num][$sub]) - 1; $i++)
      $s .= $__vw_p[$num][$sub][$i].$in;
    return $s.$__vw_p[$num][$sub][$i];
   } 
   return (!isset($__vw_p[$num][$sub][$cnt]))?"":$__vw_p[$num][$sub][$cnt];
}
/*
  s(a, b, c) = a.b.c;
*/
/*
  p(num, sub) = isset(par[num][sub])
*/
/*
  a() = !p();
*/
function vw_p($num, $sub = ''){
  global $__vw_p;
  if($sub == '')
   return isset($__vw_p[$num]);
  else
   return isset($__vw_p[$num][$sub]);
} 
function vw_g0($ch, $str){
  if($ch == "#"){
    $pattern = '/^[0-9]+/';
    preg_match($pattern, $str, $rss);
    return (isset($rss[0]))?$rss[0]:"";
  }elseif($ch == "$"){
    $pattern = '/^[a-zA-Zà-ÿÀ-ÿ]+/';
    preg_match($pattern, $str, $rss);
    return (isset($rss[0]))?$rss[0]:"";
  } else {
    $pos = stripos($str, $ch);
    if($pos === false)
	  return "";
	return substr($str, 0, $pos);
  }
}
function vw_g1($ch, $str){
  if($ch == "#"){
    $pattern = '/^[0-9]+/';
    return preg_replace($pattern, "", $str);
 }elseif($ch == "$"){
    $pattern = '/^[a-zA-Zà-ÿÀ-ÿ]+/';
	return preg_replace($pattern, "", $str);
 } else {
    $pos = stripos($str, $ch);
    if($pos === false)
	  return "";
	return substr($str, $pos);
  }
}
function vw_ue($str, $n){
  $i = 0;
  $pos = 0; 
  while($i < $n && $pos !== false){
    $pos = strpos($str, ' ', $pos + 1);
    $i++;
  }
  if($pos === false)
    return $str;
   else
    return substr($str, 0, $pos); 
}
function vw_uf($str, $n){
  $i = 0;
  $pos = 0; 
  while($i < $n && $pos !== false){
    $pos = strpos($str, ' ', $pos + 1);
    $i++;
  }
  if($pos === false)
    return "";
   else
    return substr($str, $pos + 1); 
}

function vw_uk($spr, $str){
  $arr = array("type" => $spr, "code" => $str);
  $obj = tep_db_obj("s_sprav", $arr, "name");
    if(isset($obj['name']))
      return $obj['name'];
     
  return $str;
}

function vw_sb($str, $prsr, $ind = 0){
 $str = str_replace($prsr.$prsr, $prsr, $str);
 $ar = explode($prsr, $str);
 if(count($ar) < $ind + 1)
  return "";
 return trim($ar[$ind]); 
}

function vw_get_authcount(){
  global $__vw_p;  
  $n = vw_p_cnt('700', 'A');
  $result = 0;
  if (vw_v('100', 'A') != "")
   $result++;       
  for($i = 0; $i < $n; $i++)  
    if(!isset($__vw_p['700']['E'][$i]) || $__vw_p['700']['E'][$i] == '' || $__vw_p['700']['E'][$i] == '070'){
        $result++;
    }
  return $result;
}

function vw_add($s1, $s2, $s3 = ''){
  if($s1 != "" && $s2 != "")
   return $s1.$s2.$s3;
  else return ""; 
}
function vw_d($s1, $s2){
  if($s2 != "")
   return $s1;
  else return ""; 
}
function vw_nvl($s1, $s2){
  if($s1 != "")
   return $s1;
 return $s2;
}

function vw_vw($fn){
 $html = implode('', file(VIEW.$fn.'.php'));
 $html = str_replace("<?php", "", $html);
 @eval($html);// or die ("<h1>$fn</h1>");
}

function isset_vw($fn){
   $fn = VIEW.$fn.'.php';
   return file_exists($fn);
}

function vw_008(){
  $str = "";
  $v8  = vw_v('008');
  if($v8 == '')
   return '';
  $numargs = func_num_args();
  $al = func_get_args();
  for ($i = 0; $i < $numargs; $i++) 
   if(strlen($v8) >= $al[$i])
    $str .= $v8{($al[$i] - 1)};
  return $str;
}
function vw_cnt($num){
  return vw_p_cnt($num, '0');
}
function vw_p_cnt($num, $sub){
 global $__vw_p;
 if($sub == '0' && vw_p($num)){
   $cnt = 0;
   foreach($__vw_p[$num] as $key => $val)
     $cnt = max($cnt, count($val)); 
   return $cnt; 
 }
 if($sub == '' && vw_p($num))
  return count($__vw_p[$num]);
 if(vw_p($num, $sub))
  return count($__vw_p[$num][$sub]);
 return 0;
}
function vw_word($str, $lng = ''){
 global $_SESSION;
  if($lng == '')
   $lng = vw_008(35, 36, 37);

   if($lng == 'uzb')
     $lng = "_UZ";
   else if($lng == 'rus')
     $lng = "_RU";
   else if($lng == 'eng')
     $lng = "_EN";
   else $lng = '_'.strtoupper($_SESSION['LANGS']);
   if(defined($str.$lng))
     return constant($str.$lng);
	else if(defined($str))
	 return constant($str);
  return $str;
}

function vw_rdr_v(){
  global $__vw_p_params;
  
  return isset($__vw_p_params['RDR_VER']);
}

function vw_garr($key){
 global $__vw_p;
 
 if (isset($__vw_p[$key]))
    return $__vw_p[$key];
 else 
    return array(); 
}

function vw_menu($mn_name, $key, $def_val){
  $names = tep_db_obj("s_sprav", array("type" => $mn_name, "code" => $key), "name");
  if(isset($names['name']))
    return $names['name'];
  return $def_val;
}

function vw_change($arr){
  global $__vw_p;
  $__vw_p = $arr;
}

function vw_merge($arr){
  global $__vw_p;

  foreach($arr as $key => $val)
    if( ! isset($__vw_p[$key]) )
	  $__vw_p[$key] = $val;
}

function vw_get(){
  global $__vw_p;
  return $__vw_p;
}

function vw_pos_fixed($val, $len, $emp = "|"){
  if (strlen($val) == $len)
      return $val;
  if (strlen($val) > $len)
      return substr($val, 0, $len);
  for($i = 0; $i < $len; $i++)
     $val .= $emp;
  return substr($val, 0, $len);
}

function vw_btype(){
    return vw_garr('B_TYPE');
}
?>