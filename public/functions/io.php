<?php


 
$_IO_CH30 = chr(30); 
$_IO_CH29 = chr(29);
$_IO_CH31 = chr(31);
  function escape_injection($str){
      global $_IO_CH30, $_IO_CH29, $_IO_CH31;

      return str_replace(array("\n", $_IO_CH30, $_IO_CH29, $_IO_CH31, "".chr(10), "".chr(13)), "", $str);
  }

  function getIso($descr){
   global $_IO_CH30, $_IO_CH29, $_IO_CH31;
   // replace &#1178; to �
   //$descr = str_replace("&#1178;", "�", $descr);
   //$descr = _CH_."005^0^42534253". $descr;
   $rows = explode(_CH_, $descr);

   $beg = $end = 0;
   $iso_txt = "";
   $hed_txt = "";
   //unset($rows[0]);
   
   for($j = 1; $j < count($rows); $j++)	{ 
     
     $val = $rows[$j];
     $rc = explode("^", $val);
    
     if(count($rc) < 2)
	  continue;
	  
     $str = $_IO_CH30."  ";
     for($i = 1; $i < count($rc); $i+= 2)
       $str .= $_IO_CH31.strtolower($rc[$i]).escape_injection($rc[$i + 1]);

     if($j == count($rows) - 1)
	 $str .= $_IO_CH30;
	
	 $beg += $end;
	 $end = strlen($str);
	 
	 $hed_txt .= str_add($rc[0], "000", 3);
	 $hed_txt .= str_add($end, "0000", 4);
	 $hed_txt .= str_add($beg, "00000", 5); 
	 $iso_txt .= $str;
   }

 $body   = $hed_txt.$iso_txt.$_IO_CH29;
 $mhead  = str_add(strlen($body) + 24, "00000", 5); // 5 digit
 $mhead .= "nam  22"; // status(1), reserv(4), iden(1), iden(1);
 $mhead .= str_add(strlen($hed_txt) + 25, "00000", 5); // nachalo BODY(5)
 $mhead .= "00045  "; // reserv(3), 4,5 0, _

 return $mhead.$body;
}
   
function str_add($str, $def, $len){
 return substr($def.$str, -$len, $len);
}

function getFromIso($str){
  global $_IO_CH30, $_IO_CH29, $_IO_CH31;
  $str  = substr($str, 19); // 
  if($str{strlen($str) - 1} != $_IO_CH29)
   return false;
  $str = substr($str, 0, -1);
  $rows = explode($_IO_CH30, $str);
  $n = count($rows) ;
  
  if($n < 2)
   return false;
  $str = "";
  
  for($i = 1; $i < $n; $i++){
     $num  = substr($rows[0], 12 * ($i - 1), 3 );
	 $subs = explode($_IO_CH31, trim($rows[$i]));
         $str .= _CH_.$num;
	 $ss   = "";
	 for($j = 1; $j < count($subs); $j++){
            if (trim($subs[$j]) == "")
                continue;
	    $ss .= "^".strtoupper($subs[$j]{0})."^".substr($subs[$j], 1);
	 }
         
	 $str .= $ss;
  }
 return $str;
}

function getDFromIso($str){
  global $_IO_CH30, $_IO_CH29, $_IO_CH31;
  $str1  = substr($str, 19); // 
  echo $str1."<br/>";
  if($str{strlen($str) - 1} != $_IO_CH29){
   echo "<br/> 29 ga tang amas";
      return false;
  }
  $str = substr($str, 0, -1);
  $rows = explode($_IO_CH30, $str);
  $n = count($rows) ;
  echo "\n LENGTH:".$n;
  if($n < 2)
   return false;
  $str = "";
  
  for($i = 1; $i < $n; $i++){
     $num  = substr($rows[0], 12 * ($i - 1), 3 );
	 $subs = explode($_IO_CH31, trim($rows[$i]));
         $str .= _CH_.$num;
	 $ss   = "";
	 for($j = 1; $j < count($subs); $j++){
            if (trim($subs[$j]) == "")
                continue;
	    $ss .= "^".strtoupper($subs[$j]{0})."^".substr($subs[$j], 1);
	 }
         
	 $str .= $ss;
  }
 return $str;
}

function getArrayFromIso($str){
  global $_IO_CH30, $_IO_CH29, $_IO_CH31;
  $prms = array();
  $str  = substr($str, 19); // 
  if($str{strlen($str) - 1} != $_IO_CH29)
   return false;
  $str = substr($str, 0, -1);
  $rows = explode($_IO_CH30, $str);
  $n = count($rows) ;
  if($n < 2)
   return false;

  for($i = 1; $i < $n; $i++){
         $num  = substr($rows[0], 12 * ($i - 1), 3 );
	 $subs = explode($_IO_CH31, trim($rows[$i]));
	 //$str .= _CH_.$num;
	 $ss   = "";
	 for($j = 1; $j < count($subs); $j++){
	    //$ss .= "^".strtoupper($subs[$j]{0})."^".substr($subs[$j], 1);
            $prms[$num][strtoupper($subs[$j]{0})][] = substr($subs[$j], 1);
	 }
	 //$str .= $ss;
 } 
 
 return $prms;
}

function getArrFromIsis($str){
      $prms = array();

	preg_match_all("|<(.*)>(.*)</[^>]+>|U", 
    $str, 
    $out, PREG_PATTERN_ORDER);
	$key = $out[1]; $val = $out[2];
	unset($out);
	$prms = array();
    $nums = array();
	for($i = 0; $i < count($key); $i++):
	  $p    = strpos($val[$i], "^");
	  if($p === false)
	    $prms[$key[$i]][] = $val[$i];
	   else {
	    if(isset($nums[$key[$i]]))
		   $p = $nums[$key[$i]];
		 else
		   $p = -1;
		  $p++;
		  $nums[$key[$i]] = $p;
		$pars = explode("^", $val[$i]);
		for($j = 1; $j < count($pars);$j++):
		  $sub = strtoupper($pars[$j]{0});
		  $prms[$key[$i]][$sub][$p] = substr($pars[$j], 1);
		endfor;
	     
	   }
	endfor;
   return $prms;
 }
/*
   there are list of basic functions which are 
   used in the showing data in the Export Import
*/
$__vw_p = array(); // get
$__io_r = array(); // set
$__ev   = "";
function io_v($num, $sub = '', $val, $bool = true){
  global $__io_r;
  if(is_array($val)){
    for($i = 0; $i < count($val); $i++)
	  if($sub == '')
    	 $__io_r[$num][] = $val[$i];
	  else
	     $__io_r[$num][$sub][] = $val[$i];
   return;
  }
  if(!$bool && trim($val) == '')
    return;
  if($sub == '')
     $__io_r[$num][] = $val;
  else
     $__io_r[$num][$sub][] = $val;
}
$res_ = ''; $val_ = '';

function io_arr($num, $sub, $num1, $sub1, $ev_ = ''){
  global $__io_r, $__vw_p;
  
  if(vw_v($num1, $sub1) == '')
    return;
//  for($i = 0; $i < count($__vw_p[$num1][$sub1]); $i++)

 if($ev_ == '')
 {   for($i = 0; $i < vw_p_cnt($num1, $sub1); $i++)
     io_v($num, $sub, vw_v($num1, $sub1, $i));
 } else {
  global $res_, $val_;
   for($i = 0; $i < vw_p_cnt($num1, $sub1); $i++)
    {
	  $val_ = vw_v($num1, $sub1, $i); $res_ = '';
	  eval($ev_);
	  io_v($num, $sub, $res_);
    }
 }
}
function io_arr2($num, $sub, $num1, $sub1, $num2, $sub2,  $in = '', $ed = ''){
  
  if(vw_v($num1, $sub1) == '' || vw_v($num2, $sub2) == '')
    return;
//  for($i = 0; $i < count($__vw_p[$num1][$sub1]); $i++)
  $cnt = 0;
  $cnt = vw_p_cnt($num2, $sub2);
  $cnt = max($cnt, vw_p_cnt($num1, $sub1));
    for($i = 0; $i < $cnt; $i++)
     if(vw_v($num2, $sub2, $i) != '')
	 {
	  if(vw_v($num1, $sub1, $i) != '')
	   io_v($num, $sub, vw_v($num1, $sub1, $i).$in.vw_v($num2, $sub2, $i).$ed);
      else
  	   io_v($num, $sub, vw_v($num2, $sub2, $i));
     }
	 else
	   io_v($num, $sub, vw_v($num1, $sub1, $i));
}

function utf8_to_cp1251($utf8) {

    $windows1251 = "";
    $chars = preg_split("//",$utf8);

    for ($i=1; $i<count($chars)-1; $i++) {
        $prefix = ord($chars[$i]);
        $suffix = ord($chars[$i+1]);

        if ($prefix==215) {
            $windows1251 .= chr($suffix+80);
            $i++;
        } elseif ($prefix==214) {
            $windows1251 .= chr($suffix+16);
            $i++;
        } else {
            $windows1251 .= $chars[$i];
        }
    }

    return $windows1251;
}

function Utf8Win($str,$type="w")  {
    static $conv='';

    if (!is_array($conv))  {
        $conv = array();

        for($x=128;$x<=143;$x++)  {
            $conv['u'][]=chr(209).chr($x);
            $conv['w'][]=chr($x+112);

        }

        for($x=144;$x<=191;$x++)  {
            $conv['u'][]=chr(208).chr($x);
            $conv['w'][]=chr($x+48);
        }

        $conv['u'][]=chr(208).chr(129);
        $conv['w'][]=chr(168);
        $conv['u'][]=chr(209).chr(145);
        $conv['w'][]=chr(184);
        $conv['u'][]=chr(208).chr(135);
        $conv['w'][]=chr(175);
        $conv['u'][]=chr(209).chr(151);
        $conv['w'][]=chr(191);
        $conv['u'][]=chr(208).chr(134);
        $conv['w'][]=chr(178);
        $conv['u'][]=chr(209).chr(150);
        $conv['w'][]=chr(179);
        $conv['u'][]=chr(210).chr(144);
        $conv['w'][]=chr(165);
        $conv['u'][]=chr(210).chr(145);
        $conv['w'][]=chr(180);
        $conv['u'][]=chr(208).chr(132);
        $conv['w'][]=chr(170);
        $conv['u'][]=chr(209).chr(148);
        $conv['w'][]=chr(186);
        $conv['u'][]=chr(226).chr(132).chr(150);
        $conv['w'][]=chr(185);
    }

    if ($type == 'w') {
        return str_replace($conv['u'],$conv['w'],$str);
    } elseif ($type == 'u') {
        return str_replace($conv['w'], $conv['u'],$str);
    } else {
        return $str;
    }
}
?>
