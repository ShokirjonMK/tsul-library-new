//$__vw_p - main info
$cp   = vw_garr('COPY');

if(count($cp) < 1)
{ 
  echo vw_d("<center>(".vw_word('WITHOUT_COPY_INFO').")</center>".vw_par, vw_v('245'));
} else {
  $free = false;
  for($i = 0; $i < count($cp); $i++)
   if($cp[$i]['invmode'] == '0' && ($cp[$i]['rdr_id'] === '0' || $cp[$i]['rdr_id'] === ''))
     $free = true;
  if(!$free)
  echo ("<center> (".vw_word('COPY_ISNOT_FREE').")</center>".vw_par);
}