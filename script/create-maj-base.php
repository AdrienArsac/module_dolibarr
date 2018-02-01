<?php
/*
 * Script créant et vérifiant que les champs requis s'ajoutent bien
 */

if(!defined('INC_FROM_DOLIBARR')) {
	define('INC_FROM_CRON_SCRIPT', true);

	require('../config.php');
}

global $db;

dol_include_once('/simple/class/simple.class.php');

$o = new TSimple208000($db);
$o->init_db_by_vars($db);