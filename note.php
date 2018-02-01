<?php

	require 'config.php';
	
	dol_include_once('/contact/class/contact.class.php');
	dol_include_once('/simple/class/simple.class.php');
	
	$object = new Contact($db);
	$object->fetch(GETPOST('fk_contact'));
	
	$action = GETPOST('action');
	
	$simple = new TSimple208000($db);
	$simple->fetchByContact($object->id);
	
	switch ($action) {
		case 'save':
			$simple->setValues($_POST);
			if($simple->id>0) $simple->update($user);
			else $simple->create($user);
			
			setEventMessage('Element simple sauvegardé');
			
			_card($object,$simple);
			break;
			
		default:
			_card($object,$simple);
			break;
	}
	
	
	
function _card(&$object,&$simple) {
	global $db,$conf,$langs;

	dol_include_once('/core/lib/contact.lib.php');
	
	llxHeader();
	$head = contact_prepare_head($object);
	dol_fiche_head($head, 'tab208000', '', 0, '');
	
	$formCore=new TFormCore('simple.php', 'formSimple');
	echo $formCore->hidden('fk_contact', $object->id);
	echo $formCore->hidden('action', 'save');
	
	echo '<h2>Ceci est une gestion d\'un objet simple lié a la société</h2>';
	
	echo $formCore->texte('Titre','title',$simple->title,80,255).'<br />';
	
	echo $formCore->btsubmit('Sauvegarder', 'bt_save');
	
	$formCore->end();
	
	dol_fiche_end();
	llxFooter();	 	
}