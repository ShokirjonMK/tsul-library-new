/* if &unifor('Av922#2')<>''then else  
   if &unifor('Av200^e#1')<>'' then' : '&unifor('Av200^e#1') fi fi */
echo vw_add(" : ",  vw_v('245', 'B'));
/*if s(&unifor('Av700#1'),&unifor('Av970#1'),&unifor('Av701#1'),&unifor('Av922^g#1'))<>'' 
            then ' / ',.osoa., 
               if s(&unifor('Av700#1'),&unifor('Av970#1'),&unifor('Av701#1'))<>''and 
                    &unifor('Av922^g#1')<>''then' ; ' fi,&unifor('Av922^g#1') 
         fi fi, */
if(vw_v('100', '', 0) != '' || vw_v('700', '', 0) != ''){
  echo " / "; vw_vw('authrs');
}
