<?php

 function a_create_new_db($_POST, $key_ = ''){
  global $__DIN_SPRAV__;
  $ch_cril  = " CHARACTER SET cp1251 COLLATE cp1251_general_ci ";
  $ch_latin = " CHARACTER SET latin1 COLLATE latin1_swedish_ci ";
  
  $ch       = $ch_cril;
  if ($key_ == ""){
      $db_fields = array('keyword' => $_POST['keyword'], 'name' => $_POST['name'], 
          'type' => $_POST['type'], 'branch_id' => $_POST['branch_id']);
      $key = $_POST['keyword'];
      if (strtolower($key) == _CAT_AVT){
          echo "Bunday nomdagi EK qo'shib bo`lmaydi....";
          exit;
      }
  } else {
      $key = $key_;
      $db_fields = array('keyword' => $_POST['keyword'], 'name' => $_POST['name'], 
          'type' => $_POST['type'], 'branch_id' => $_POST['branch_id']);
  }
  $qur = tep_db_insert("tdbases", $db_fields);
/* ----------------    CREATE main TABLE            ------------------------*/
  $sql = "DROP TABLE IF EXISTS `z".$key."`";
  tep_db_query($sql);

  $sql = "CREATE TABLE  `z".$key."` (`id` int(10) unsigned NOT NULL auto_increment, `btype_id` VARCHAR(10) NOT NULL, `v001` VARCHAR(255) ".$ch."NOT NULL, `descr` text ".$ch."NOT NULL,  `branch_id` int(5) unsigned, `cam_create` int(10) unsigned, `cam_mod` int(10) unsigned,  `dat_mod` DATETIME, PRIMARY KEY  (`id`))";
  tep_db_query($sql);
  
  $sql = "ALTER TABLE `z".$key."` ADD INDEX `name_v001_ndx`(`v001`)";
  tep_db_query($sql);
/* ----------------    CREATE main TABLE RELATION        ------------------------*/
  $sql = "DROP TABLE IF EXISTS `z".$key."_relation`";
  tep_db_query($sql);
  
  $sql = "CREATE TABLE `z".$key."_relation` (`id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT, `parent_id` INTEGER UNSIGNED NOT NULL,  `child_id` INTEGER UNSIGNED NOT NULL, `type` VARCHAR(15) NOT NULL,  `record` VARCHAR(4), `SUB_RECORD` CHAR(1), PRIMARY KEY(`id`))";
  tep_db_query($sql);
  
/* ----------------    CREATE ekzeplyar TABLE            ------------------------*/
$sql = "DROP TABLE IF EXISTS `z".$key."_inv`";
  tep_db_query($sql);
$sql = "CREATE TABLE  `z".$key."_inv` (".
"  `INV_ID` int(11) NOT NULL auto_increment,  `BOOK_ID` int(11) default NULL,  `T990t` varchar(255) ".$ch.",  `T090h` varchar(255) ".$ch.",  `T090e` varchar(255) ".$ch.",  `T090f` varchar(255) ".$ch.",  `T090w` varchar(255) ".$ch.",  `T876c` varchar(255) ".$ch.",  `T876p` varchar(255) ".$ch.",  `T020d` varchar(255) ".$ch.",  `T020e` varchar(255) ".$ch.",  `T990n` varchar(255) ".$ch.",  `CNT` int(11) ,  `REGDATE` float default NULL,  `INVMODE` varchar(1) default NULL,  `CUSTOM1` varchar(255) ".$ch.",  `CUSTOM2` varchar(255) ".$ch.",  `CUSTOM3` varchar(255) ".$ch.",  `CUSTOM4` varchar(255) ".$ch.", `CUSTOM5` varchar(255) ".$ch.", RDR_ID int(5) DEFAULT '0',  PRIMARY KEY  (`INV_ID`)) ";
  tep_db_query($sql);
  
 $sql = "ALTER TABLE `z".$key."_inv` ADD INDEX `inv_876p_ndx`(`T876p`),ADD INDEX `inv_090e_ndx`(`T090e`)";
  tep_db_query($sql);
/* ----------------    CREATE dinamic sprav TABLE            ------------------------*/
/* ----------------        CREATING ATTACHMENT               ------------------------*/
 $sql = "DROP TABLE IF EXISTS `z".$key."_att`";
   tep_db_query($sql);
 $sql = "CREATE TABLE `z".$key."_att` (".
 "  `att_id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT, ".
 "  `book_id` INTEGER(10) UNSIGNED NOT NULL, ".
 "  `name` VARCHAR(255) ".$ch.", `type` VARCHAR(255), `size` INTEGER UNSIGNED, `file` MEDIUMBLOB, `place` VARCHAR(1) DEFAULT '0', PRIMARY KEY(`att_id`))";
   tep_db_query($sql);
/* ----------------        CREATING ATTACHMENT               ------------------------*/

  foreach($__DIN_SPRAV__ as $tables){
    //if ($tables == "cont_num")  
    //    $ch = $ch_latin;
    //else
        $ch = $ch_cril;
    
    $sql = "DROP TABLE IF EXISTS `z".$key."_d_".$tables."`";
    tep_db_query($sql);
    $sql = "CREATE TABLE  `z".$key."_d_".$tables."` (`id` int(10) unsigned NOT NULL auto_increment,  `name` varchar(255) ".$ch." NOT NULL, `count` int(10) unsigned,  PRIMARY KEY  (`id`)) ";
    tep_db_query($sql);
	$sql = "ALTER TABLE `z".$key."_d_".$tables."` ADD INDEX `name_ndx`(`name`)";
	tep_db_query($sql);
    $sql = "DROP TABLE IF EXISTS `z".$key."_d_".$tables."x`";
    tep_db_query($sql);
    $sql = "CREATE TABLE `z".$key."_d_".$tables."x` (`".$tables."_id` int(10) unsigned NOT NULL, `book_id` int(10) unsigned NOT NULL,  UNIQUE KEY `".$key."_d_".$tables."_ind`   (`".$tables."_id`,`book_id`))"; 
   tep_db_query($sql);
  }
  $ch = $ch_cril;
  
  $tables = "ss";
    $sql = "DROP TABLE IF EXISTS `z".$key."_d_".$tables."`";
    tep_db_query($sql);
    $sql = "CREATE TABLE  `z".$key."_d_".$tables."` (`id` int(10) unsigned NOT NULL auto_increment,  `name` varchar(255) ".$ch." NOT NULL, `key` varchar(45),  PRIMARY KEY  (`id`)) ";
    tep_db_query($sql);
	$sql = "ALTER TABLE `z".$key."_d_".$tables."` ADD INDEX `name_ndx`(`name`)";
	tep_db_query($sql);
    $sql = "DROP TABLE IF EXISTS `z".$key."_d_".$tables."x`";
    tep_db_query($sql);
    $sql = "CREATE TABLE `z".$key."_d_".$tables."x` (`".$tables."_id` int(10) unsigned NOT NULL, `book_id` int(10) unsigned NOT NULL,  UNIQUE KEY `".$key."_d_".$tables."_ind`   (`".$tables."_id`,`book_id`))"; 
   tep_db_query($sql);
    
 }
 function a_delete_db($POST){
   global $__DIN_SPRAV__;
    $id = sys_decode($POST['id']);
    $arr = array('id' => $id);
    $obj = tep_db_obj("tdbases", $arr);
    $key = $obj['keyword'];
    $sql = "DROP TABLE IF EXISTS `z".$key."`";
    tep_db_query($sql);
	
 foreach($__DIN_SPRAV__ as $tables){
    $sql = "DROP TABLE IF EXISTS `z".$key."_d_".$tables."`";
    tep_db_query($sql);
    $sql = "DROP TABLE IF EXISTS `z".$key."_d_".$tables."x`";
    tep_db_query($sql);
  }
    $sql = "DROP TABLE IF EXISTS `z".$key."_d_ss`";
    tep_db_query($sql);
    $sql = "DROP TABLE IF EXISTS `z".$key."_d_ssx`";
    tep_db_query($sql);
    $sql = "DROP TABLE IF EXISTS `z".$key."_d_att`";
    tep_db_query($sql);
	  
    $sql = "DROP TABLE IF EXISTS `z".$key."_inv`";
    tep_db_query($sql);
	  
    $sql = "DROP TABLE IF EXISTS `z".$key."_relation`";
    tep_db_query($sql);

    $sql = "DROP TABLE IF EXISTS `z".$key."_att`";
    tep_db_query($sql);

    tep_db_delete("tdbases", $arr);
 }
?>