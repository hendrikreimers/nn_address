<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Single',
	'Address - Single'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'List',
	'Address - List'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'AbcList',
	'Address - ABC List'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/Default', 'NN Address');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/ContentDesigner', 'CD: Address in Page properties');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
	<INCLUDE_TYPOSCRIPT: source="FILE:EXT:nn_address/Configuration/TSconfig/default.txt">
');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nnaddress_domain_model_address', 'EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_address.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nnaddress_domain_model_address');
\NN\NnAddress\Utility\Flexform::modifyFlexSheet($GLOBALS['TCA'], 'address');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nnaddress_domain_model_group', 'EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_group.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nnaddress_domain_model_group');
\NN\NnAddress\Utility\Flexform::modifyFlexSheet($GLOBALS['TCA'], 'group');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nnaddress_domain_model_mail', 'EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_mail.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nnaddress_domain_model_mail');
\NN\NnAddress\Utility\Flexform::modifyFlexSheet($GLOBALS['TCA'], 'mail');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nnaddress_domain_model_person', 'EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_person.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nnaddress_domain_model_person');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
		'nn_address',
		'tx_nnaddress_domain_model_person'
);
\NN\NnAddress\Utility\Flexform::modifyFlexSheet($GLOBALS['TCA'], 'person');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nnaddress_domain_model_phone', 'EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_phone.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nnaddress_domain_model_phone');
\NN\NnAddress\Utility\Flexform::modifyFlexSheet($GLOBALS['TCA'], 'phone');

// Flexform autloader
//\NN\NnAddress\Utility\Flexform::flexFormAutoLoader();

$plugins = [
		'nnaddress_single' => 'FILE:EXT:nn_address/Configuration/FlexForms/Single.xml',
		'nnaddress_list' => 'FILE:EXT:nn_address/Configuration/FlexForms/List.xml',
		'nnaddress_abclist' => 'FILE:EXT:nn_address/Configuration/FlexForms/AbcList.xml'
];
foreach($plugins as $pluginSignature => $fileFlexForm){
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, $fileFlexForm);
}




?>