<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "nn_address".
 *
 * Auto generated 03-04-2014 08:20
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'NN Address',
	'description' => 'Powerful Address extension. Fully based on Extbase/Fluid as an new alternative to tt_address. You can add multiple addresses,email address, etc. to a contact. No need to create multiple for one anymore. If more fields neededyou can simply extend them with flexforms.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '2.4.1',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => NULL,
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Hendrik Reimers (neonaut.de, belnet.de)',
	'author_email' => 'info@neonaut.de, typo3@belnet.de',
	'author_company' => 'Neonaut GmbH, BEL NET GmbH',
	'CGLcompliance' => NULL,
	'CGLcompliance_note' => NULL,
	'constraints' => 
	array (
		'depends' => 
		array (
			'extbase' => '6.0.0-6.2.99',
			'fluid' => '6.0.0-6.2.99',
			'typo3' => '6.0.0-6.2.99',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

?>