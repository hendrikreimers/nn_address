<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'NN.' . $_EXTKEY,
	'Single',
	array(
		'Person' => 'single',
		
	),
	// non-cacheable actions
	array(
		'Person' => '',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'NN.' . $_EXTKEY,
	'List',
	array(
		'Person' => 'list, show, grouplist',
		
	),
	// non-cacheable actions
	array(
		'Person' => 'grouplist',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'NN.' . $_EXTKEY,
	'AbcList',
	array(
		'Person' => 'abcList, show',
		
	),
	// non-cacheable actions
	array(
		'Person' => '',
		
	)
);

?>