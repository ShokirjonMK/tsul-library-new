<?php
global $sA_, $sB_, $sC_;
if(vw_v('922') != '' || vw_v('461', 'E') != '' || vw_v('46', '1') != ''){
   if(vw_p('510', 'F')){
      $sC_ .= vw_add(": ", vw_v('200', 'E'));
	  if(!vw_p('922')) { $sC_ .= vw_add("/ ", vw_v('200', 'F')); $sC_ .= vw_add("; ", vw_v('200', 'G')); }
      if(vw_p('510')):
	   $n = vw_p_cnt('510', '0');
	   for($i = 0; $i < $n; $i++){
	     if(vw_v('510', '', $i) == "" ) continue;
		 $sC_ .= vw_add(" = ", vw_v('510', 'D', $i)); $sC_ .= vw_add(": ", vw_v('510', 'E', $i)); $sC_ .= vw_add("/ ", vw_v('510', 'F', $i));
	   }
	  endif;
   } else { //if(vw_p('510', 'F'))
       if(vw_p('510', 'E')){
	      $sC_ .= vw_add(" : ", vw_v('200', 'E'));
    	  $n = vw_p_cnt('510', '0');
	      for($i = 0; $i < $n; $i++){
            if(vw_v('510', '', $i) == "" ) continue;
			$sC_ .= vw_add(" = ", vw_v('510', 'D', $i)); $sC_ .= vw_add(": ", vw_v('510', 'E', $i));
		  }
	   } else { //if(vw_p('510', 'E')){
    	  $n = vw_p_cnt('510', '0');
	      for($i = 0; $i < $n; $i++)
  	         $sC_ .= vw_add(" = ", vw_v('510', 'D', $i));
		  $sC_ .= vw_add(": ", vw_v('200', 'E'));
	   } // ELSE of if(vw_p('510', 'E')){
   } // ELSE of if(vw_p('510', 'F')){
   $sC_ .= vw_add(": ", vw_v('923', 'H'));
   $sC_ .= (!vw_p('923', 'H'))?vw_add('. ', vw_v('923', 'I')):vw_add(', ', vw_v('923', 'I'));
   $sC_ .= vw_add(". ", vw_v('923', 'K'));
   $sC_ .= (!vw_p('923', 'K'))?vw_add('. ', vw_v('923', 'L')):vw_add(', ', vw_v('923', 'L'));
   if(!(vw_p('510', 'F') && !vw_p('922'))) {  $sC_ .= vw_add("/ ", vw_v('200', 'F')); $sC_ .= vw_add("; ", vw_v('200', 'G')); }
} else {
   if(vw_p('510', 'F')){
     $sB_ .= vw_v('200', 'E');
	 if(!vw_p('922')){ $sB_ .= vw_d("/", vw_v('200', 'F'));  $sC_ .= vw_v('200',  'F');  $sC_ .= vw_add("; ", vw_v('200', 'G')); }
	 if(vw_v('200', 'E') != '' || vw_v('200', 'F') != ''){
	   if(vw_p('510')):
	     $n = vw_p_cnt('510', '0');
         for($i = 0; $i < $n; $i++):
  	         $sC_ .= vw_add(" = ", vw_v('510', 'D', $i));
			 $sC_ .= vw_add(": ", vw_v('510', 'E', $i));
			 $sC_ .= vw_add("/ ", vw_v('510', 'F', $i));
		 endfor; 
	   endif; 
	  } else {
	     $n = vw_p_cnt('510', '0');
         for($i = 0; $i < $n; $i++):
  	         $sB_ .= vw_add(" = ", vw_v('510', 'D', $i));
			 $sB_ .= vw_add(": ", vw_v('510', 'E', $i));
			 $sC_ .= vw_add("/ ", vw_v('510', 'F', $i));
		 endfor; 
	 }
   } else { //if(vw_p('510', 'F')){
     if(vw_p('510', 'E')):
        $sB_ .= vw_add(": ", vw_v('200', 'E'));
        $n = vw_p_cnt('510', '0');
        for($i = 0; $i < $n; $i++):
  	         $sB_ .= vw_add(" = ", vw_v('510', 'D', $i));
			 $sB_ .= vw_add(": ", vw_v('510', 'E', $i));
	    endfor; 
   	 else:
        $n = vw_p_cnt('510', '0');
        for($i = 0; $i < $n; $i++)
  	         $sB_ .= vw_add(" = ", vw_v('510', 'D', $i));
        if(!vw_p('510', 'D')) $sB_ .= vw_add(": ", vw_v('200', 'E'));
	 endif;
   } // end of if(vw_p('510', 'F')){
   if(!vw_p('461') && !vw_p('200', 'V')):
      $s_ = vw_v('923', 'H'); $s_ .= vw_add(". ", vw_v('923', 'K'));
	  io_v('245', 'N', $s_, false);
      $s_ = vw_v('923', 'I'); $s_ .= vw_add(". ", vw_v('923', 'L'));
	  io_v('245', 'P', $s_, false);
   else:
      $sB_ .= vw_add(". ", vw_v('923', 'H'));
      if(vw_p('923', 'H'))
	    $sB_ .= vw_add(", ", vw_v('923', 'I'));
       else
	    $sB_ .= vw_add(". ", vw_v('923', 'I'));
   endif;
   if(!(vw_p('510', 'F') && !vw_p('922'))){
     //$sC_ .= vw_v('200', 'F');
     if(trim($sC_) != "")
  	   $sC_ .= vw_add("; ", vw_v('200', 'F'));
	 else
	   $sC_ .= vw_v('200', 'F'); 
     
     if(trim($sC_) != "")
  	   $sC_ .= vw_add("; ", vw_v('200', 'G'));
	 else
	   $sC_ .= vw_v('200', 'G');          
    }
   if(!vw_p('200', 'F')){
     $sC_ .= vw_v('700', 'A');
     $sC_ .= vw_add(" ", vw_v('700', 'B'));
   }
}

if (vw_p_cnt('200', 'A') > 1){
    for ($i = 1; $i < vw_p_cnt('200', 'A'); $i++){
      if (trim($sB_) != "")
          $sB_ .= ";";
      $sB_ .= vw_add(" ", vw_v('200', 'A', $i));
    }
}

if (vw_p('423', 'F')){
    if (trim($sC_) != "")
      $sC_ = vw_add(vw_v('423', 'F'), "/", $sC_);
}
