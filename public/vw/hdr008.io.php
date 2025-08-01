<?php
$s_ = "";
/*if(vw_p('907', 'A')):
  $n = vw_p_cnt('907', 'A');
  $mn = "30000101";
   for($i = 0; $i < $n; $i++)
     $mn = min($mn, vw_v('907', 'A', $i));

  $mn = substr($mn, -6);
  if(strlen($mn) != 6)
    $mn = "??????";
  $s_ = $mn;
else:
  $s_ = "??????";
endif; */
$s_  = date(`ymd`); // 00-05

if(vw_v('920') == 'J'){
  if(vw_p('210', 'E')){
    $s_ .= 'd'; // 06
	if(vw_v('210', 'D', 0) != "")
	  $s_ .= vw_pos_fixed(vw_v('210', 'D', 0), 4); // 07-10
	else
	  $s_ .= "||||"; // 07-10
	if(vw_v('210', 'E', 0) != "")
	  $s_ .= vw_pos_fixed(vw_v('210', 'E', 0), 4); // 11-14
	else
	  $s_ .= "||||";  // 11-14
  } else {
    $s_ .= 'c'; // 06
	if(vw_v('210', 'D', 0) != "")
	  $s_ .= vw_pos_fixed(vw_v('210', 'D', 0), 4);  // 07-10
	else
	  $s_ .= "||||"; // 07-10
	$s_ .= "9999";   // 11-14
  }
} else {
  if(vw_p('900', 'B') && strpos('05 03 ', vw_v('900', 'B')))
    $s_ .= "s"; //06
   else
    $s_ .= "u"; //06
  $s_ .= vw_pos_fixed(vw_v('210', 'D', 0), 4); // 07-10
  
  if(vw_v('210', 'D', 0) == '')
    $s_ .= "||||"; // 11-14
  elseif(vw_v('210', 'E', 0) != "")
    $s_ .= vw_pos_fixed(vw_v('210', 'E', 0), 4); // 11-14
  else
    $s_ .= "||||"; // 11-14
}

if(vw_p('102'))
 $s_ .= vw_pos_fixed(strtolower(vw_v('102')), 3, " ");// 15-17
else
 $s_ .= "uz ";// 15-17

$s_ .= "                "; // 16
$s1_ = vw_v('101', '', 0); $s_ .= ($s1_ != "")?$s1_:"uzb"; 
io_v('008', '0', $s_);
/*
 * Array
(
    [100] => Array
        (
            [A] => Array
                (
                    [0] => 20120419a19919999|||y0rusy02
                )

        )

    [101] => Array
        (
            [A] => Array
                (
                    [0] => rus
                )

        )

    [102] => Array
        (
            [A] => Array
                (
                    [0] => RU
                )

        )

    [200] => Array
        (
            [A] => Array
                (
                    [0] => alma mater
                )

            [F] => Array
                (
                    [0] => Atadjanov A
                )

        )

    [210] => Array
        (
            [A] => Array
                (
                    [0] => Berlin
                    [1] => ???????
                )

            [C] => Array
                (
                    [0] => Springer
                )

            [D] => Array
                (
                    [0] => 1991-
                )

        )

    [700] => Array
        (
            [A] => Array
                (
                    [0] => Atadjanov
                )

            [B] => Array
                (
                    [0] => A
                )

        )

    [801] => Array
        (
            [B] => Array
                (
                    [0] => ????? ??????
                )

            [A] => Array
                (
                    [0] => RU
                )

            [C] => Array
                (
                    [0] => 20120419
                )

        )

    [903] => Array
        (
            [0] => Array
                (
                    [0] => a072138
                )

        )

    [900] => Array
        (
            [B] => Array
                (
                    [0] => 05
                )

        )

)
 */