<?php

/* 008 gacha tashlab getilgan */
// 20 chala
 //if(vw_v('10', 'A') != '')
 // io_v('020', 'A', str_replace('-', '', vw_v('10', 'A')));
 vw_vw('hdr008.io');
 if (vw_p('903', '0')){
     io_v ('001', '0', vw_v('903', '0'), false);
     io_v ('090', 'A', vw_v('903', '0'), false);
 }

 if (vw_p('908', '0')){
     io_v ('090', 'X', vw_v('908', '0'), false);
 }
 
 io_arr('020', 'A', '010', 'A');
 io_arr('020', 'C', '010', 'D');
// eof 20
// 22
 io_arr('022', 'A', '011', 'A');
 if(!vw_p('011') && strpos(vw_v('900', 'B'), '03') === false)
    io_arr('022', 'A', '461', 'J');
// eof 22
 io_arr('015', 'A', '020', 'A');

$s_ = vw_v('125', 'X'); $s_ = $s_{0}; $s1_ = vw_v('019', 'X'); $s1_ = $s1_{0}; $s2_ = vw_v('019', 'A'); $s2_ = $s2_{0};
if($s_ == '0' && $s1_ == '0' && strtoupper(s2_) == 'Z')
 io_arr('024', 'A', '019', 'B');
else 
if($s_ == '0' && $s1_ == '0' && strtoupper(s2_) != 'Z')
 io_arr('028', 'A', '019', 'B');
 
 $s_ = vw_v('123', 'X'); $s_ = $s_{0};
 if($s_ == '0'){
   io_arr('034', 'B', '123', 'D');   io_arr('034', 'C', '123', 'E');   io_arr('034', 'H', '123', 'F');
 }
 
 if(stripos(vw_v('907', 'C'), 'Z') !== false)
  io_arr('040', 'A', '907', 'B', '$res_ = substr($val_, 2);');
 io_arr('040', 'B', '919', 'A');

 io_arr('041', 'A', '101', 'A');
 io_arr('044', 'A', '102', 'A');
 
 if(vw_p('911') || vw_v('101', '0', 1) != ''){
    io_arr('041', 'A', '101', '0');
	io_arr('041', 'D', '911', '0');
 }

 if (vw_v('700', 'B') != '')
   io_arr2('100', 'A', '700', 'A', '700', 'B', ', ');
 else {
     if (strpos(trim(vw_v('700', 'A')), ' ') === false){
         $authr = vw_v('700', 'G');
         $authr = str_replace(vw_v('700', 'A'), '', $authr);
         
         if ($authr{0} == "," || $authr{0} == ".")
           $authr = substr($authr, 1);
         
         $authr = vw_v('700', 'A')." ".$authr;
         io_v('100', 'A', $authr);
     } else
         io_arr('100', 'A', '700', 'A');      
 }
 io_arr('100', 'C', '700', 'C');
 io_arr('100', 'D', '700', 'F');
 io_arr('100', 'Q', '700', 'G'); 
 io_arr('100', 'U', '700', 'P'); 
 
 io_v('100', '4', '700', '4');
 
 if(!vw_p('700'))
   io_arr('100', 'A', '461', 'X');

if(stripos(vw_v('920'), 'PVK') === false)
 {
    io_arr2('110', 'A', '710', 'A', '710', 'C', '(', ')'); 
    io_arr2('110', 'B', '710', 'B', '971', 'B', '.');
	$s = vw_v('971', 'E'); 
	$s .= vw_add("/", vw_v('971', 'H'));
	$s .= vw_add("/", vw_v('971', 'I'));
 if($s != '')
   io_v('110', 'C', $s);
  io_v('110', 'D', vw_v('971', 'F'));
 
 if(vw_v('971', 'E') != '' || vw_v('971', 'D') != '')
    io_v('110', 'N', vw_v('971', 'D'));
   else
    io_v('110', 'N', vw_add("(", vw_v('971', 'D'), ")"));
}

if(stripos(vw_v('920'), 'PVK') !== false)
 {
    io_v('111', 'A', vw_v('710', 'A'));
	$s = "(".vw_v('710', 'E'); 
	$s .= vw_add("/", vw_v('710', 'H'));
	$s .= vw_add("/", vw_v('710', 'I'));
	if(vw_v('710', 'E') != '' && strlen($s) > 1)
	 $s = ":";
 if($s != '')
   io_v('111', 'C', $s, false);
// if(vw_v('710', 'E') != '')
   io_v('110', 'D', vw_v('710', 'F'), false);
//  else
//   io_v('110', 'D', "(".vw_v('710', 'F'));
 if(vw_v('710', 'E') != '' || vw_v('710', 'D') != '')   
     io_v('110', 'N', vw_v('710', 'D'));
   else
    io_v('110', 'N', vw_add("(",vw_v('710', 'D'),")"));
}
io_v('130', 'A', vw_v('503', 'A'), false);

// ==========================CAPTION 
global $sA_, $sB_, $sC_;
 $sC_ = ''; $sB_ = "";
$sA_ = vw_v('461', 'C');
 if($sA_ != ''){  if(vw_p('046', '1')) $sA_ .= "=";   /*io_v('245', 'A', $s_, false);*/ }

 if(vw_p('046', '1'))      $sB_ = vw_v('046', '1', '', '=');
 if(vw_p('461', 'E'))     $sB_ = ($sB_ != '')?($sB_." : ".vw_v('461', 'E')):vw_v('461', 'E');
 /*io_v('245', 'B', $s_, false); */
 
 if(vw_v('461', 'X') != '' || vw_v('461', 'B') != '' || vw_v('461', 'F') != ''):
 
   if(stripos(vw_v('461', 'F'), vw_ue(vw_v('461', 'X'), 1)))
     $sC_ = vw_v('461', 'F', '', ';'); 
	else { $sC_ = vw_add("", vw_v('461', 'X', '', ';'), ";"); $sC_ .= vw_v('461', 'B'); }
   $sC_ .= vw_v('461', 'F').vw_d(".", vw_v('461'));
  /* io_v('245', 'C', $s_, false); */
 endif;

 if(vw_p('461')){
   if(!vw_p('200', 'A'))
     {  io_v('245', 'N', vw_v('200', 'V'), false);   io_v('245', 'P', vw_v('200', 'A'), false); }
	else 
	 io_v('245', 'P', vw_v('200', 'V'), false);
 } else {
  //io_v('245', 'A', vw_v('200', 'A'), false);
  $sA_ = vw_v('200', 'A', 0);
 }
 // 922 qism tashlab getildi
 // JACK245.pft  HERE
 vw_vw('cptn245_1.io');
 $sA_ = tep_remove_chars($sA_);
 $sB_ = tep_remove_chars($sB_);
 $sC_ = tep_remove_chars($sC_);
 
 io_v('245', 'A', $sA_, false);
 io_v('245', 'B', $sB_, false);
 io_v('245', 'C', $sC_, false);
 
 io_v('245', 'P', vw_v('200', 'I'), false);
 io_v('245', 'N', vw_v('200', 'H'), false); 
//io_v('245', 'C', );
// ==========================CAPTION 

 io_v('250', 'A', vw_v('205', 'A', 0), false);  $s_ = vw_v('205', 'B', 0); $s_ .= " ".vw_v('205', 'F', 0);
 if(vw_v('205', '', 1) != ''):
   $cnt = 0;  $cnt = vw_p_cnt('205', 'A');  $cnt = max($cnt, vw_p_cnt('205', 'B'));  $cnt = max($cnt, vw_p_cnt('205', 'F'));
    for($i = 1; $i < $cnt; $i++)
     $s_ .= " ".vw_v('205', 'A', $i)." / ".vw_v('205', 'B', $i)." ".vw_v('205', 'F', $i);
 endif;
 io_v('250', 'B', trim($s_), false);  if(!vw_p('205'))  io_v('250', 'B', vw_v('461', 'P'), false);

//if(substr(vw_v('920'), 0, 1) != 'A'):
if(vw_p('210')){
 $cnt = 0;  $cnt = vw_p_cnt('210', 'A');  $cnt = max($cnt, vw_p_cnt('210', 'X'));  $cnt = max($cnt, vw_p_cnt('210', 'Y'));  $cnt = max($cnt, vw_p_cnt('210', 'C'));
  for($i = 0; $i < $cnt; $i++)
  {
   io_v('260', 'A', vw_v('210', 'A', $i), false);
   //io_v('260', 'A', vw_v('210', 'X', $i), false);
   //io_v('260', 'A', vw_v('210', 'Y', $i), false);
   io_v('260', 'B', vw_v('210', 'C', $i), false);
   io_v('260', 'C', vw_v('210', 'D', $i), false);
  }
} else {
    $cnt = 0;  $cnt = vw_p_cnt('461', 'D');  $cnt = max($cnt, vw_p_cnt('461', 'G'));  $cnt = max($cnt, vw_p_cnt('461', 'H'));
  for($i = 0; $i < $cnt; $i++)
  {
   io_v('260', 'A', vw_v('461', 'D', $i));
   io_v('260', 'B', vw_v('461', 'G', $i));
   io_v('260', 'Ñ', vw_v('461', 'Ð', $i));
  }
} 
//endif;
  if (vw_p('215', 'A') && vw_p('215', '1'))
    io_arr2('300', 'A', '215', 'A', '215', '1');   
  else
    io_arr('300', 'A', '215', 'A');     
  
  io_arr('300', 'B', '215', 'C');   
  io_arr('300', 'C', '215', 'D'); //io_arr2('300', 'C', '215', 'E', '215', '2'); 

 if(vw_v('225') != ''){
    $cnt = 0;  $cnt = vw_p_cnt('225', 'A');  $cnt = max($cnt, vw_p_cnt('225', 'E'));  $cnt = max($cnt, vw_p_cnt('225', 'F'));  $cnt = max($cnt, vw_p_cnt('225', 'K'));  $cnt = max($cnt, vw_p_cnt('225', 'H'));  $cnt = max($cnt, vw_p_cnt('225', 'I'));  $cnt = max($cnt, vw_p_cnt('225', 'L'));  $cnt = max($cnt, vw_p_cnt('225', 'X'));  $cnt = max($cnt, vw_p_cnt('225', 'V'));
  for($i = 0; $i < $cnt; $i++):
  $s_ = vw_v('225', 'A', $i);  $s_ .= ($s_ != '' && vw_v('225', 'E', $i) != '')?" : ":"";
  $s_ .= vw_v('225', 'E', $i); $s_ .= ($s_ != '' && vw_v('225', 'F', $i) != '')?" / ":"";
  $s_ .= vw_v('225', 'F', $i);
  io_v('440', 'A', $s_);
  $s_ = vw_v('225', 'H', $i);$s_ .= ($s_ != '' && vw_v('225', 'K', $i) != '')?", ":"";
  $s_ .= vw_v('225', 'K', $i);
  io_v('440', 'N', $s_);
  $s_ = vw_v('225', 'I', $i)." ".vw_v('225', 'L', $i);
  io_v('440', 'P', trim($s_));
  io_v('440', 'X', vw_v('225', 'X', $i)); 
  io_v('440', 'V', vw_v('225', 'V', $i));  
  endfor;
 }
 if(vw_p('46')){
  $cnt = 0;  $cnt = vw_p_cnt('46', 'A');  $cnt = max($cnt, vw_p_cnt('46', 'V'));
  for($i = 0; $i < $cnt; $i++):
   io_v('440', 'A', vw_v('225', 'A', $i));
   io_v('440', 'V', vw_v('225', 'V', $i));
  endfor;
 }
 io_v('500', 'A', vw_v('300'));  
 io_v('500', 'A', vw_v('314'), false);
 io_v('504', 'A', vw_v('320', 'A'));
 io_v('502', 'A', vw_v('328', 'A'));
 io_v('502', 'N', vw_v('328', 'N'));
 io_v('502', 'E', vw_v('328', 'E'));
 io_v('502', 'B', vw_v('328', 'B'));
 io_v('502', 'C', vw_v('328', 'C'));
 io_v('502', 'D', vw_v('328', 'D'));

 if(vw_p('327')){
   io_v('505', 'A', vw_v('327'), false);
  $cnt = 0;  $cnt = vw_p_cnt('330', 'F');  $cnt = max($cnt, vw_p_cnt('330', 'C'));  $cnt = max($cnt, vw_p_cnt('330', '4'));
  for($i = 0; $i < $cnt; $i++):
   $s_ = vw_v('330', 'F', $i)." ".vw_v('330', 'C', $i)." ".vw_v('330', '4', $i);
   io_v('440', 'A', vw_v('225', 'A', $i));
  endfor;
 }
 
 if (vw_p('510')) {
     io_v('246', 'A', vw_v('510', 'A')); 
     io_v('246', 'B', vw_v('510', 'E')); 
     io_v('246', 'N', vw_v('510', 'H'));  
     io_v('246', 'P', vw_v('510', 'I'));
     io_v('246', 'J', vw_v('510', 'F'));
     io_v('246', 'G', vw_v('510', 'N'));
 }
 
 if (vw_p('512')) {
     io_v('246', 'A', vw_v('512', 'A')); 
     io_v('246', 'B', vw_v('512', 'E')); 
     io_v('246', 'N', vw_v('512', 'H'));  
     io_v('246', 'P', vw_v('512', 'I'));
     io_v('246', 'J', vw_v('512', 'F'));
     io_v('246', 'G', vw_v('512', 'N'));
 }
 
  if (vw_p('513')) {
     io_v('246', 'A', vw_v('513', 'A')); 
     io_v('246', 'B', vw_v('513', 'E')); 
     io_v('246', 'N', vw_v('513', 'H'));  
     io_v('246', 'P', vw_v('513', 'I'));
     io_v('246', 'J', vw_v('513', 'F'));
     io_v('246', 'G', vw_v('513', 'N'));
  }
 
 if(vw_p('330')) io_v('520', 'A', vw_v('330', 'A'));
 if(vw_p('331')) io_v('520', 'A', vw_v('331', 'A'));

 if(vw_p('135')){
  io_arr2('538', 'A', '135', 'B', '135', 'C', '; ');
  $cnt = 0;  $cnt = vw_p_cnt('135', 'B');  $cnt = max($cnt, vw_p_cnt('135', 'C'));  $cnt = max($cnt, vw_p_cnt('135', 'D'));
  for($i = 0; $i < $cnt; $i++)
    if(stripos(vw_v('135', 'X', $i), '0') !== false){
	  $s_  = vw_v('135', 'B', $i); $s_ .= ($s_ != '' && vw_v('135', 'C', $i) != '')?$s_."; ":"";
	  $s_ .= vw_v('135', 'C', $i); $s_ .= (vw_v('135', 'D', $i) != '' && vw_v('135', 'C', $i) != '')?$s_."; ":"";
	  $s_ .= vw_v('135', 'D', $i);
	}
 }
 io_v('546', 'A', vw_garr('912'));

 io_v('535', 'A', vw_garr('902'));
 
 if(vw_p('421')){
  $cnt = 0;  $cnt = vw_p_cnt('421', 'A');  $cnt = max($cnt, vw_p_cnt('421', 'X'));  $cnt = max($cnt, vw_p_cnt('421', 'I'));
  for($i = 0; $i < $cnt; $i++):
   io_v('770', 'T', vw_v('421', 'A', $i));
   io_v('770', 'X', vw_v('421', 'X', $i));
   io_v('770', 'Z', vw_v('421', 'I', $i));
  endfor;
 }

 if(vw_p('422')){
  $cnt = 0;  $cnt = vw_p_cnt('422', 'A');  $cnt = max($cnt, vw_p_cnt('422', 'X'));  $cnt = max($cnt, vw_p_cnt('422', 'I'));
  for($i = 0; $i < $cnt; $i++):
   io_v('772', 'T', vw_v('422', 'A', $i));
   io_v('772', 'X', vw_v('422', 'X', $i));
   io_v('772', 'Z', vw_v('422', 'I', $i));
  endfor;
 }

 if(vw_p('430')){
  $cnt = 0;  $cnt = vw_p_cnt('430', 'A');  $cnt = max($cnt, vw_p_cnt('430', 'X'));
  for($i = 0; $i < $cnt; $i++):
   io_v('780', 'T', vw_v('430', 'A', $i));
   io_v('780', 'X', vw_v('430', 'X', $i));
  endfor;
 }

 if(vw_p('440')){
  $cnt = 0;  $cnt = vw_p_cnt('440', 'A');  $cnt = max($cnt, vw_p_cnt('440', 'X'));
  for($i = 0; $i < $cnt; $i++):
   io_v('785', 'T', vw_v('440', 'A', $i));
   io_v('785', 'X', vw_v('440', 'X', $i));
  endfor;
 }

 if(vw_p('454')){
   io_v('765', 'T', vw_v('454', 'A'), false); 
   io_v('765', 'B', vw_v('454', 'B'), false); 
   io_v('765', 'A', vw_v('454', 'D'), false); 
   $s_ = vw_v('454', 'D');
   if($s_ != "" && vw_v('454', 'E') != "")
    $s_ .= ", ";
   $s_ .= vw_v('454', 'E');
   io_v('765', 'C', $s_, false); 
   $s_ = ""; $s_ = vw_v('454', 'G'); $s_ .= ($s_ != '' && vw_v('454', 'C', $i) != '')?" : ":"";
   $s_ .= vw_v('454', 'C'); $s_ .= ($s_ != '' && vw_v('454', 'H', $i) != '')?", ":"";
   $s_ .= vw_v('454', 'H'); 
   io_v('765', 'D', $s_, false); 
   io_v('765', 'X', vw_v('454', 'I'), false); 
 }

 if(vw_p('963') || vw_p('463')){
  $cnt = 0; 
  $cnt = vw_p_cnt('963', 'X');  $cnt = max($cnt, vw_p_cnt('963', 'Y'));  $cnt = max($cnt, vw_p_cnt('963', 'B'));
  $cnt = max($cnt, vw_p_cnt('963', 'E'));  $cnt = max($cnt, vw_p_cnt('963', 'F'));  $cnt = max($cnt, vw_p_cnt('963', 'P'));
  $cnt = max($cnt, vw_p_cnt('963', 'A'));  $cnt = max($cnt, vw_p_cnt('963', 'O'));  $cnt = max($cnt, vw_p_cnt('963', 'V'));
  $cnt = max($cnt, vw_p_cnt('963', 'I'));
  for($i = 0; $i < $cnt; $i++):
   $s_ = vw_v('963', 'X', $i);   if($s_ != "" && vw_v('963', 'Y', $i) != "") $s_ .= ", ";
   $s_ .= vw_v('963', 'Y', $i); $s_ .= " ".vw_v('963', 'B', $i);
   io_v('773', 'A', trim($s_), false);
   $s_ = vw_v('463', 'C', $i); if($s_ != "" && vw_v('963', 'E', $i) != "")  $s_ .= " : ";
   $s_ .= vw_v('963', 'E', $i);
   if($s_ != "" && vw_v('963', 'F', $i) != "") $s_ .= " / ";
   $s_ .= vw_v('963', 'F', $i);
   io_v('773', 'T', $s_, false);
   if(vw_p('463', 'D'))
     io_v('773', 'D', vw_p('463', 'D', $i), false);
    else
	 io_v('773', 'D', vw_p('463', 'J', $i), false);
   $s_ = vw_v('463', 'V', $i);   if($s_ != "" && vw_v('463', 'A', $i) != "") $s_ .= " : ";
   $s_ .= vw_v('463', 'A', $i); $s_ .= vw_add(" ", vw_v('463', 'H', $i));
   if($s_ != "" && vw_v('463', 'I', $i) != "") $s_ .= " : ";
   $s_ .= vw_v('463', 'I', $i);
   if($s_ != "" && vw_v('463', 'L', $i) != "") $s_ .= ".- ";
   $s_ .= vw_v('463', 'L', $i);
   if(vw_v('463', 'L', $i) == '')
    $s_ .= vw_add(' Ñ. ', vw_v('463', 'S', $i));
   else
    $s_ .= vw_add(' ', vw_v('463', 'S', $i));
   io_v('773', 'G', trim($s_), false);
   $s_ = vw_v('963', 'A', $i);   if($s_ != "" && vw_v('963', 'O', $i) != "") $s_ .= " / ";
   $s_ .= vw_v('963', 'O', $i);  if($s_ != "" && vw_v('963', 'V', $i) != "") $s_ .= "; ";
   $s_ .= vw_v('963', 'V', $i);
   io_v('773', 'K', trim($s_), false);
   io_v('773', 'X', vw_v('963', 'I', $i), false);
  endfor;
 }

 io_v('242', 'A', vw_v('541'), false);

 io_arr('246', 'A', '517', 'T');   io_arr('246', 'A', '046', 'T');

 io_v('210', 'A', vw_v('531', 'A'), false);

 io_v('212', 'A', vw_v('532', 'A'), false); 

 io_arr('600', 'A', '600', 'A');  

 io_arr('610', 'A', '601', 'A');  

 if(vw_p('606')):
  $cnt = 0; 
  $cnt = vw_p_cnt('606', 'A');  $cnt = max($cnt, vw_p_cnt('606', 'B'));  $cnt = max($cnt, vw_p_cnt('606', 'C'));
  $cnt = max($cnt, vw_p_cnt('606', 'D'));  $cnt = max($cnt, vw_p_cnt('606', 'G'));  $cnt = max($cnt, vw_p_cnt('606', 'E'));
  $cnt = max($cnt, vw_p_cnt('606', 'O'));  $cnt = max($cnt, vw_p_cnt('606', 'H'));
  for($i = 0; $i < $cnt; $i++){
    io_v('650', 'A', vw_v('606', 'A', $i), false);
    $s_ = vw_v('606', 'B', $i);  $s_ .= vw_add(" ", vw_v('606', 'C', $i));  $s_ .= vw_add(" ", vw_v('606', 'D', $i));
	io_v('650', 'X', trim($s_), false);
    $s_ = vw_v('606', 'G', $i);  $s_ .= vw_add(" ", vw_v('606', 'E', $i));  $s_ .= vw_add(" ", vw_v('606', 'O', $i));
	io_v('650', 'Z', trim($s_), false);
	io_v('650', 'Y', vw_v('606', 'H', $i), false);
  }
  endif;

 if(vw_p('607')):
  $cnt = 0; 
  $cnt = vw_p_cnt('607', 'A');  $cnt = max($cnt, vw_p_cnt('607', 'B'));  $cnt = max($cnt, vw_p_cnt('607', 'C'));
  $cnt = max($cnt, vw_p_cnt('607', 'D'));  $cnt = max($cnt, vw_p_cnt('607', 'G'));  $cnt = max($cnt, vw_p_cnt('607', 'E'));
  $cnt = max($cnt, vw_p_cnt('607', 'O'));  $cnt = max($cnt, vw_p_cnt('607', 'H'));
  for($i = 0; $i < $cnt; $i++){
    io_v('651', 'A', vw_v('607', 'A', $i));
    $s_ = vw_v('607', 'B', $i);  $s_ .= vw_add(" ", vw_v('607', 'C', $i));  $s_ .= vw_add(" ", vw_v('607', 'D', $i));
	io_v('651', 'X', trim($s_));
    $s_ = vw_v('607', 'G', $i);  $s_ .= vw_add(" ", vw_v('607', 'E', $i));  $s_ .= vw_add(" ", vw_v('607', 'O', $i));
	io_v('651', 'Z', trim($s_));
	io_v('651', 'Y', vw_v('607', 'H', $i));
  }
 endif;

  io_v('653', 'A', vw_v('610', 'A', 0)); 

/* 852 - we don't need COPIES*/

  io_v('080', 'A', vw_v('675', '', '', ', '), false); 

  if(vw_v('964') != ''){
   io_v('84', 'A', vw_v('964'));    io_v('084', '2', "rugasnti");
  } 

 io_arr('630', 'A', '905', 'U');   

 if(vw_p('970')){
 	$s_ = vw_v('970', 'A');  if($s_ != "" && vw_v('970', 'B') != "") $s_ .= ", ";
	$s_ .=  vw_v('970', 'B');
	 io_v('700', 'A', $s_);
	 io_v('700', 'B', vw_v('970', 'D'));
	 io_v('700', 'D', vw_v('970', 'F'));
	 io_v('700', 'Q', vw_v('970', 'G'));
	 io_v('700', '4', 'aut');
	 io_v('700', 'C', trim(vw_v('970', '1')." ".vw_v('970', 'C')));
 }
 if(vw_p('701')){
  
  $n = vw_p_cnt('701', '0');
  $n = max($n, vw_p_cnt('701', 'A'));
  
  for($i = 0; $i < $n; $i++):
 	$s_ = vw_v('701', 'A', $i);  if($s_ != "" && vw_v('701', 'B', $i)) $s_ .= ", ";
	$s_ .=  vw_v('701', 'B', $i);
	 io_v('700', 'A', $s_);
	 io_v('700', 'B', vw_v('701', 'D', $i));
	 io_v('700', 'D', vw_v('701', 'F', $i));
	 io_v('700', 'Q', vw_v('701', 'G', $i));
	 io_v('700', '4', vw_v('701', '4', $i));
	 io_v('700', 'C', trim(vw_v('701', '1', $i)." ".vw_v('701', 'C', $i)));
  endfor; 
  
  }
 if(vw_p('702')){
  $n = vw_p_cnt('702', '0');
  $n = max($n, vw_p_cnt('702', 'A'));
  
  for($i = 0; $i < $n; $i++):
	$s_ = vw_v('702', 'A', $i);  if($s_ != "" && vw_v('702', 'B', $i)) $s_ .= ", ";
	$s_ .=  vw_v('702', 'B', $i);
	 io_v('700', 'A', $s_);
	 io_v('700', 'B', vw_v('702', 'D', $i));
	 io_v('700', 'D', vw_v('702', 'F', $i));
	 io_v('700', 'Q', vw_v('702', 'G', $i));
	 io_v('700', '4', vw_v('702', '4', $i));
	 io_v('700', 'C', trim(vw_v('702', '1', $i)." ".vw_v('702', 'C', $i)));
  endfor; }
 
 io_arr2('710', 'A', '711', 'A', '711', 'C', '(', ')');io_arr('710', 'A', '711', 'B');

 if(stripos(vw_v('920'), 'PVK') !== false){
   $n = vw_p_cnt('971', '0');
   for($i = 0; $i < $n; $i++){
    io_v('711', 'A', vw_v('971', 'B', $i));
	 $s_  = vw_v('971', 'E', $i);  if($s_ != "" && vw_v('971', 'H', $i)) $s_ .= " / ";
	 $s_ .= vw_v('971', 'H', $i);  if($s_ != "" && vw_v('971', 'I', $i)) $s_ .= " / ";
	 $s_ .= vw_v('971', 'I', $i);
    io_v('711', 'C', $s_);
    io_v('711', 'D', vw_v('971', 'F', $i));
    io_v('711', 'N', vw_v('971', 'D', $i));
   }
 }
  $n = vw_p_cnt('972', '0');
   for($i = 0; $i < $n; $i++){
    io_v('711', 'A', vw_v('972', 'B', $i));
	 $s_  = vw_v('972', 'E', $i);  if($s_ != "" && vw_v('972', 'H', $i)) $s_ .= " / ";
	 $s_ .= vw_v('972', 'H', $i);  if($s_ != "" && vw_v('972', 'I', $i)) $s_ .= " / ";
	 $s_ .= vw_v('972', 'I', $i);
    io_v('711', 'C', $s_);
    io_v('711', 'D', vw_v('972', 'F', $i));
    io_v('711', 'N', vw_v('972', 'D', $i));
   }

 if(vw_p('922')){
  $n = vw_p_cnt('922', '0');
   for($i = 0; $i < $n; $i++){
    if(vw_v('922', 'C', $i) != ''){
	 $s_  = vw_v('922', 'C', $i);  if($s_ != "" && vw_v('922', 'F', $i)) $s_ .= " / ";
	 $s_ .= vw_v('922', 'F', $i);  if($s_ != "" && vw_v('922', '2', $i)) $s_ .= " / ";
	 $s_ .= vw_v('922', '2', $i);  if($s_ != "" && vw_v('922', '3', $i)) $s_ .= " / ";
	 $s_ .= vw_v('922', '3', $i);
    io_v('740', 'A', $s_, false);
	}
   }
 }
 
 if(vw_p('951', 'A')){
   global $__io_path;
   $s_ = vw_add($__io_path, vw_v('951', 'A'));
     io_v('900', 'A', $s_, false);
 }
 
 if(vw_p('933', 'A')){
     io_v('773', 'W', vw_v('933', 'A'));
 }
 
 io_v('920', '0', vw_v('920')); // work_list