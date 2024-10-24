<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "nn_address".
 *
 * Auto generated 09-12-2014 13:30
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'NN Address',
	'description' => 'Powerful Address extension. Fully based on Extbase/Fluid as an new alternative to tt_address. You can add multiple addresses,email address, etc. to a contact. No need to create multiple for one anymore. If more fields neededyou can simply extend them with flexforms.',
	'category' => 'plugin',
	'version' => '2.4.1',
	'state' => 'stable',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'Hendrik Reimers (neonaut.de, belnet.de)',
	'author_email' => 'info@neonaut.de, typo3@belnet.de',
	'author_company' => 'Neonaut GmbH, BEL NET GmbH',
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

