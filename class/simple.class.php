<?php

if(!class_exists('SeedObject')) {
	define("INC_FROM_DOLIBARR",1);
	dol_include_once("/simple/config.php");
}

class TSimple208000 extends SeedObject {
	
	function __construct(&$db) {
		$this->db = $db;

		$this->table_element = 'contact_info_supp';

		$this->fields=array(
			'rowid'=>array('type'=>'integer','index'=>true)
			,'fk_contact'=>array('type'=>'integer','index'=>true)
			,'title'=>array('type'=>'string','index'=>true,'length'=>80)
			,'carrier'=>array('type'=>'string','index'=>true,'length'=>80)
			,'email'=>array('type'=>'string','index'=>true,'length'=>80)
			,'datec'=>array('type'=>'date')
			,'tms'=>array('type'=>'date')
		);

		$this->init();
	}

	function fetchContactInfo($fk_contact) {
		$res = $this->db->query("SELECT rowid FROM ".MAIN_DB_PREFIX.$this->table_element." 
			WHERE fk_contact=".(int)$fk_contact);

		if($obj = $this->db->fetch_object($res)) {
			return $this->fetchCommon($obj->rowid);
		}

		return false;
	}
}