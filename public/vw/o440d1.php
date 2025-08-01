<?php
if(vw_p('440')){
  echo "<br>";
  echo vw_add("&nbsp;&nbsp;&nbsp;<b>", vw_v('440', 'V'), "</b>");
  if(vw_v('440', 'P') != ""){
   echo vw_d(" : ", vw_v('440', 'V'));
   echo vw_v('440', 'P');
  } 
  if(vw_v('246', 'B') != ""){
   echo vw_d(" ; ", vw_v('440', 'V').vw_v('440', 'P'));
   echo vw_v('246', 'B');
  } 
  if(vw_v('260', 'F') != ""){
   echo vw_d(" .- ", vw_v('440', 'V').vw_v('440', 'P').vw_v('440', 'B'));
   echo vw_v('260', 'F');
  } 
  if(vw_v('260', 'C') != ""){
   echo vw_d(", ", vw_v('440', 'V').vw_v('440', 'P').vw_v('440', 'B'));
   echo vw_v('260', 'C');
  }   // NASHRIYOIT Haqida malumot

}