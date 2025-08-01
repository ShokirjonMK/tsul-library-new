<?php
//JW.PWT

if(vw_p('090', 'A')):
  echo "<b>".vw_word('VW_SHIFR').": ".vw_v('090', 'A')."</b>";
endif;

if(vw_008(22) != ""){
  echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>".vw_menu("prd_izd", vw_008(22))."</b><br>";
}
vw_vw('cptn');
for($i = 0; $i < vw_cnt('246', 'O'); $i++):
  // 330 
  echo vw_add(" =", vw_v(246, 'O', $i)) ;
  echo vw_add(" =", vw_v(938, 'A', $i), " ".vw_v(938, 'B', $i)) ;
endfor;

//if p(v200^e) or a(v905^2) and p(v200^a) and p(v900^c) and &unifor('K200ehd.mnu|'v900^c)<>''then ' : ' fi,
//         if s(v982^0,v982^9)<>'' then v200^e else 
//            if p(v905^2) then v200^e else &unifor('Q'v200^e.1),v200^e*1 
//         fi fi,.o200e.,

if(vw_p('245', 'B')){
   echo vw_d(" : ", vw_v('245', 'A'));
   echo vw_v('245', 'B');
}
vw_vw('o245b');
//(". "| ; |+v923^h,if v923^h:':' then else if p(v923^h)then |, |d923^i else |. |d923^i fi,fi,v923^i,| : |v923^e,
//|. |v923^k,if v923^k:':' then else if p(v923^k)then |, |d923^l else |. |d923^l fi fi,v923^l,| : |v923^s,
//|. |v923^m,if v923^m:':' then else if p(v923^m)then |, |d923^n else |. |d923^n fi fi,v923^n,| : |v923^v),

vw_vw('oout');

// if s(v215,&unifor('G2='v230^b),&unifor('G2='v230^c))<>''then'. - 'fi,v215^a," "d215^1,&unifor('G2='v215^1), 
// if a(v215^1)then" c."d215^a fi,if p(v215^a)then" : "d215^c fi,v215^c,if s(v215^a,v215^c)<>''then"; "d215^d fi,v215^d,
// (if s(&unifor('G2='v230^b),&unifor('G2='v230^c))<>''and p(v215)then'\b : 'fi,&unifor('G2='v230^b),
// if &unifor('G2='v230^c)<>''then if &unifor('G2='v230^b)<>''then', 'fi,&unifor('G2='v230^c)'\b0 'fi),

echo vw_add(".- ISSN ", vw_v('022', 'A')) ;

if(vw_008(20) != "" || vw_008(20) != 'x')
  echo vw_add(" .- ", vw_menu("regl", vw_008(19)));

  $y_b = vw_008(8, 9, 10, 11);
  $y_e = vw_008(12, 13, 14, 15);
  if( strpos($y_b, "|") === false || strpos($y_e, "|") === false ){
   echo " .- ";

   if(strpos($y_b, "|") === false)
    echo $y_b;

   if(strpos($y_e, "|") === false)
    echo "-".$y_e;
  }
 // 110110|20002010UZ br p
//VW_REG_RLTN_EN
$books = vw_garr(B_CHILDS);
if(is_array($books) && count($books) > 0):
  echo "<br><b>".vw_word('VW_REG_RLTN')."</b><br>";
  
  $copies = array();
  for($i = 0; $i < count($books); $i++){
     if(isset($books[$i]['951']['A']['0']) || isset($books[$i]['953']['A']['0'])){
	   $yrs = $books[$i]['951']['A']['0'];
	   $nmr = $books[$i]['953']['A']['0'];
	   
	   if(isset($copies[$yrs]))
	      $copies[$yrs] .= ", ".$nmr;
		else
		  $copies[$yrs] = $nmr;
	 }
  }

  foreach($copies as $key => $val)
    echo $key.vw_word('VW_YIL')." ".$val."<br>";

endif;
?>