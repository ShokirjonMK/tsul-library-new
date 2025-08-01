if(vw_p('440')){
  echo vw_d(".- (", vw_v('440', 'A', 0));
  for($i = 0; $i < vw_cnt('440'); $i++):
      echo vw_v('440', 'A', $i);
      echo vw_add(", ISSN ", vw_v('440', 'X', $i));
      echo vw_add(" ; ", ucfirst(vw_v('440', 'V', $i)));
      echo vw_d(")", vw_v('440', 'A', $i));
  endfor;
}