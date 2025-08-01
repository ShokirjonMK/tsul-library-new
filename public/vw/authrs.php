<?php
$btype   = vw_garr('B_TYPE');

    
if(vw_v('100')!='' || vw_v('700') != '' || vw_v('245') != '')
 if($btype == "map" && vw_p('255', 'B'))
  echo '; ';
   else
  echo ' / ';
if(vw_p('100', '4') && !vw_p('700')){
  if(substr(vw_v('701', '4'), 4, 1) == "*") 
    echo substr(vw_v('701', '4'), 5);
  else
    echo strtolower(substr(vw_v('701', '4'), 4));
}

if (!vw_p('245', 'C')) {
    if (vw_v('100', 'Q') != "") {
      echo vw_v('100', 'Q');   
    } else {
      $f_o = vw_sb(vw_v('100', 'A'), " ", 1).vw_sb(vw_v('100', 'A'), " ", 2);
      if($f_o != "")
        if(strpos($f_o, '. ') !== false)  echo $f_o;  else echo str_replace('.', '. ', $f_o);
    }
}

if(vw_nvl($f_o, vw_v('100', 'Q')) != "") echo " ";
  echo vw_sb(vw_v('100', 'A'), " ", 0);
 echo vw_add(" ", vw_v('100', 'B'));
if(vw_p('100') && vw_p('700')) echo ", ";

$author_count = vw_get_authcount();

if($author_count > 3){  // more than 3 author
     $v700a = str_replace(". ", ".", vw_v('700', 'A', 0));
     $f_o   = vw_sb($v700a, " ", 1);
     if($f_o != "")
       if(strpos($f_o, '. ') !== false)  echo $f_o;  else echo str_replace('.', '. ', $f_o);
     else
       echo vw_v('700', 'Q', 0); 
     if(vw_nvl($f_o, vw_v('700', 'Q', 0)) != "") echo " ";  
     echo vw_sb($v700a, " ", 0);
     echo vw_add(" ", vw_v('700', 'B', 0));
     echo ' '.vw_word('O_AUTHRS');
$addVergul = false;
    for($i = 0; $i < vw_cnt('700'); $i++):
         if (vw_v('700', 'E', $i) == "" || vw_v('700', 'E', $i) == "070")
                 continue;
         if ($addVergul == false){
             echo "; ";
             $addVergul = true;
         }
         if(vw_v('700', 'A', $i) != "" && vw_v('700', '4', $i) != "" ) 
                 echo vw_v('700', '4', $i)." ";  
         
         if ($i == 0 || vw_v('700', 'E', $i) != vw_v('700', 'E', $i - 1))
         if (vw_v('700', 'E', $i) != "")
             echo vw_add(strtolower(vw_menu("Shrol", vw_v('700', 'E', $i), "")), " ");

         $v700a = str_replace(". ", ".", vw_v('700', 'A', $i));
         $f_o   = vw_sb($v700a, " ", 1);
	 if($f_o != "")
	   if(strpos($f_o, '. ') !== false)  echo $f_o;  else echo str_replace('.', '. ', $f_o);
	 else
	   echo vw_v('700', 'Q', $i); 
	 
         if(vw_nvl($f_o, vw_v('700', 'Q', $i)) != "") echo " ";  

         echo vw_sb($v700a, " ", 0);
	 echo vw_add(" ", vw_v('700', 'B', $i));
         if(vw_v('700', 'A', $i + 1) != '') {
	   if(vw_v('700', 'E', $i + 1) == vw_v('700', 'E', $i))
              echo ", ";
            else
             echo "; ";
         } else
	   echo " ";
    endfor;
     
} else { // <= 3 authors
 
    for($i = 0; $i < vw_cnt('700'); $i++):
	 if(vw_v('700', 'A', $i) != "" && vw_v('700', '4', $i) != "" ) echo vw_v('700', '4', $i)." ";  
         
         if ($i == 0 || vw_v('700', 'E', $i) != vw_v('700', 'E', $i - 1))
         if (vw_v('700', 'E', $i) != "" && vw_v('700', 'E', $i) != "070")
             echo vw_add(strtolower(vw_menu("Shrol", vw_v('700', 'E', $i), "")), " ");

         $v700a = str_replace(". ", ".", vw_v('700', 'A', $i));
         $f_o   = vw_sb($v700a, " ", 1);
	 if($f_o != "")
	   if(strpos($f_o, '. ') !== false)  echo $f_o;  else echo str_replace('.', '. ', $f_o);
	 else
	   echo vw_v('700', 'Q', $i); 
	 
         if(vw_nvl($f_o, vw_v('700', 'Q', $i)) != "") echo " ";  

         echo vw_sb($v700a, " ", 0);
	 echo vw_add(" ", vw_v('700', 'B', $i));
         if(vw_v('700', 'A', $i + 1) != '') {
	   if(vw_v('700', 'E', $i + 1) == vw_v('700', 'E', $i))
              echo ", ";
            else
             echo "; ";
         } else
	   echo " ";
    endfor;
}

if ($btype == "srnq" && (vw_p('100') || vw_p('700'))){
    echo "<br/>// ";
    echo vw_v('773', 'T');
} 
    echo vw_add(", ", vw_v('111', 'A'));
    echo vw_add(", ", vw_v('711', 'A'));
//PATENT PART
    echo vw_add("; ", vw_v('110', 'A'));
    echo vw_add("; ", vw_v('710', 'A'));
    echo vw_add(".- ¹ ", vw_v('013', 'A'));
    echo vw_add("; ", vw_v('013', 'D'));
    echo vw_add("; ", vw_v('013', 'E'));