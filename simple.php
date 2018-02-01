<?php
	require 'config.php';
	
	dol_include_once('/contact/class/contact.class.php');
	dol_include_once('/simple/class/simple.class.php');
	
	$object = new Contact($db);
	$object->fetch(GETPOST('fk_contact'));
	
	$action = GETPOST('action');

	$infos = new TSimple208000($db);
	$infos->fetchContactInfo($object->id);	

	switch ($action) {
		case 'save':
			$infos->setValues($_POST);

			if($infos->id > 0) {
				$infos->update($user);
			}
			else {
				$infos->create($user);
			}
			
			setEventMessage('Informations correctement sauvegardées');
			
			_card($object,$infos);
			break;
			
		default:
			_card($object,$infos);
			break;
	}


	
function _card(&$object,&$infos) {
	global $db,$conf,$langs;

	dol_include_once('/core/lib/contact.lib.php');
	
	llxHeader();
	$head = contact_prepare_head($object);
	dol_fiche_head($head, 'tab208000', '', 0, '');
	
	$formCore = new TFormCore('simple.php', 'formSimple');

	echo $formCore->hidden('fk_contact', $object->id);
	echo $formCore->hidden('action', 'save');
	
	echo '<h2>Page de gestion d\'informations complémentaires liées au contact</h2>';
	
	echo $formCore->texte('Titre','title',$infos->title, 99,255).'<br />';
	echo $formCore->texte('Plan de carriere','carrier',$infos->carrier, 91.5,255).'<br />';
	echo $formCore->texte('E-mail additionnel','email',$infos->email, 89.9,255).'<br /><br >';
	
	echo $formCore->btsubmit('Sauvegarder', 'bt_save');
	
	$formCore->end();
	
	dol_fiche_end();
	llxFooter(); 	
}