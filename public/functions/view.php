<?php
  function __addText($param, $b_char = "", $e_char = "", $w_null = "", $i_char = ', '){
    if(!isset($param))
	 return $w_null;
    
	if(is_array($param)){
	$str = "";
	  for($i = 0; $i < count($param) - 1; $i++) {
	      if(isset($param[$i]))
               $str .= $param[$i].$i_char;
          }  
	  
          return $b_char.$str.$param[count($param) - 1].$e_char;
	} else if(trim($param) != "")
	  return $b_char.$param.$e_char;
	return $w_null; 
  }
  function getISBNView($param){
	if(isset($params[10]['A'][0]))
	  return $params[10]['A'][0];
   
    return "";
  }
  function getSmallView($params, $cp = true){
    
	$str = "";
	if(isset($params[100]['A'][0]))
	  $str = $params[100]['A'][0].",";
	if(isset($params[700]['A']))
	{
	  for($i = 0; $i < count($params[700]['A']); $i++)
	    $str .= " ".$params[700]['A'][$i].",";
	}
	if(isset($params[245]['A'][0]))
	    $str .= " ".$params[245]['A'][0].",";
	if(isset($params[260]['C'][0]))
	    $str .= " ".$params[260]['C'][0].",";
	if(isset($params[260]['B'][0]))
	    $str .= " ".$params[260]['B'][0].",";
    
    $str = substr($str, 0, -1);
	if(isset($params[520]['A'][0]))
	  $str .= "<br>".$params[520]['A'][0];
  $str1 = "";
  if($cp)
  if(isset($params[900]['A']) && is_array($params[900]['A'])){
   for($i = 0; $i < count($params[900]['A']); $i++)
	 $str1 .= "<br>".showFiles($params[900]['A'][$i], false);
  }
	  return $str.$str1;
  }
  
  function getDescriptionView($params){
    if(isset($params[520]['A'][0]))
	  return __addText($params[520]['A'][0], "<div align='left' style='margin: 10 10 10 10; text-align:justify;'>", "</div>");
  }
  
  function getJournalView($parent, $params){

    $str = getBigView($parent);

	  if(isset($params['951']['A'][0]))
	   $str .= " <b>".$params['951']['A'][0] ."</b>";
    
	  if( isset($params['953']['A'][0]) )
	   $str .= " <b>".$params['953']['A'][0]."</b>";
	 return $str;
  }
  function getBigView($params){
        $str = "";
	if(isset($params['090']['A'][0]))
 	$str = __addText($params['090']['A'][0], "<div align='left' ><b>", "</b></div>");        
	if(isset($params[100]['A'][0]))
 	$str.= __addText($params[100]['A'][0], "<div align='left' ><b>", "</b></div>");
	
	// Caption
	$cap  = "";
	if(isset($params[245]['A'][0]))
	$cap  = __addText($params[245]['A'][0]);
	if(isset($params[245]['B'][0]))
	$cap .= __addText($params[245]['B'][0], " : ");
	// Caption
	// Author
	$auth = "";
	if(isset($params[100]['A'][0]))
	$auth  = __addText($params[100]['A'][0]);
  if(isset($params[700]['A'])){
	if(isset($params[100]['A']))
	  $auth .= __addText($params[700]['A'], ", ");
     else 
	  $auth = __addText($params[700]['A'], "");
  }
	$auth  = __addText(trim($auth), "", ".");
	// Author
	// Publisher
    $publ = "";
	if(isset($params[260]['A'][0]))
 	 $publ  = __addText($params[260]['A'][0]);
	if(isset($params[260]['B'][0]))
	 $publ .= __addText($params[260]['B'][0], " : ", ", ", ", ");
	else $publ .= ", ";
	if(trim($publ) == "," )
	 $publ = "";
	if(isset($params[260]['C'][0]))
  	 $publ .= __addText($params[260]['C'][0]);
  	$sub = "";
	if(isset($params[260]['E'][0]))
 	 $sub  = trim(__addText($params[260]['E'][0]));
    if(isset($params[260]['F'][0]))	 
     $sub  .= " : ".__addText($params[260]['F'][0]);
	   if($sub == ":")  $sub = "";
	$publ .= __addText($sub, "(", ")");
    if(trim($publ) != "")
 	 $publ  = __addText(trim($publ), "", ".");
	// Publisher
	// Page
	$page = "";
	if(isset($params[300]['A'][0]))	 
  	 $page  = __addText($params[300]['A'][0]);
	if(isset($params[300]['B'][0]))	 
	 {
	   if($page != "")
	     $page .= " : ".__addText($params[300]['B'][0]);
	   else
	     $page = __addText($params[300]['B'][0]);
	 }
	
    if(trim($page) == ":" || $page == "") 
	 { $page  = ""; } else { $page .= "; "; }
	if(isset($params[300]['C'][0]))	 
	   $page .= __addText($params[300]['C'][0]);
	if(trim($page) != "")
	  $page = __addText(trim($page), "", ".");
	// Page
	// ISBN
	$isbn = "";
	if(isset($params['020']['A'][0]))
  	 $isbn = trim(__addText($params['020']['A'][0], "ISBN "));
	if(isset($params['020']['C'][0]))
	 $isbn .= " : ".__addText($params['020']['C'][0]);
	if(trim($isbn) == ":")  $isbn = "";
	if($isbn != "")
	 $isbn  = __addText(trim($isbn), "", ".");

        $udk = "";
        if(isset($params['080']['A'][0]))
  	 $udk = trim(__addText($params['080']['A'][0], "UDK "));
	if($udk != "")
	 $udk  = __addText(trim($udk), "", ".");

        if(isset($params['084']['A'][0]))
  	 $udk .= " ". trim(__addText($params['084']['A'][0], "BBK "));

        // ISBN
	//------  ADDING Part
	$str .= "<div align = 'justify'>  "; // 2 probel need
	
	$sub  = trim($cap." / ".$auth);
	if($sub{0} == "/")
	 $sub = $auth;
	if($sub != ""){
	  if($sub{strlen($sub) - 1} == "/")
    	 $sub = $cap;
	  else $sub .= " - ";
	} 
    $str .= $sub;
	//if(trim($publ) != "")
    $str .= __addText(trim($publ), "", " - ");
    $str .= __addText(trim($page), "", " - ");
    $str .= __addText(trim($isbn), "", " - ");
    $str .= __addText(trim($udk), "", " - ");
	$str  = trim($str);

	  if(isset($params['951']['A'][0]))
	   $str .= " <b>".$params['951']['A'][0] ."</b>";
    
	  if( isset($params['953']['A'][0]) )
	   $str .= " <b>".$params['953']['A'][0]."</b>";
	   
	if($str{strlen($str) - 1} == "-")
	  $str = substr($str, 0, -1);
        $str1 = "";
        if(isset($params[900]['A']) && is_array($params[900]['A'])){
         for($i = 0; $i < count($params[900]['A']); $i++)
	  $str1 .= "<br>".showFiles($params[900]['A'][$i], false);
        }
	  return $str.$str1;	
        $str .= "</div>";
	$str = str_replace("..", ".", $str);
	
	
	return $str;
  }
  function getPrintView($params){
 	$pw = "";
	
	if(isset($params['080']['A'][0]))
	 $pw = __addText($params['080']['A'][0], "<b>".WD_UDK."&nbsp;&nbsp;", "&nbsp;</b>");
    
	if(isset($params['084']['A'][0]))
	{ if($pw != "") $pw .= "<br>";
	  $pw .= __addText($params['084']['A'][0], "<b>".WD_BBK."&nbsp;&nbsp;", "&nbsp;</b>"); }
    if($pw != "")
	 $pw = "<div align='right'>".$pw.'</div>';
    if(!isset($params['520']['A'][0]))
	  return getBigView($params).$pw;
	 else 
	  return getBigView($params).$pw."<br />".$params['520']['A'][0];	 
  }
  function getSpecOrdView($params){
    $s = "";
	if($params['v100_A'] != "")
	 $s = $params['v100_A'];
    if($params['v245_A'] != "")
	 $s = __addText($s, "", ", ").$params['v245_A'];
    if($params['v260_B'] != "")
	 $s = __addText($s, "", ", ").$params['v260_B'];
    if($params['v260_D'] != "")
	 $s = __addText($s, "", ", ").$params['v260_D'];
    if($params['v300_A'] != "")
	 $s = __addText($s, "", ", ").$params['v300_A'];
    if($params['v020_A'] != "")
	 $s = __addText($s, "", ", ")."ISBN: ".$params['v020_A'];
    return $s;
  }
?>