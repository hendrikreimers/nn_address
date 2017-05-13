<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_nnaddress_domain_model_phone'] = array(
	'ctrl' => $TCA['tx_nnaddress_domain_model_phone']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, number',
	),
	'types' => array(
		'1' => array('showitem' => 'l10n_parent, l10n_diffsource, hidden;;1, type, number, flexform'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_nnaddress_domain_model_phone',
				'foreign_table_where' => 'AND tx_nnaddress_domain_model_phone.pid=###CURRENT_PID### AND tx_nnaddress_domain_model_phone.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nn_address/Resources/Private/Language/locallang_db.xlf:tx_nnaddress_domain_model_phone.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_phone.xlf:type.0', 0),
					array('LLL:EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_phone.xlf:type.1', 1),
					array('LLL:EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_phone.xlf:type.2', 2),
					array('LLL:EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_phone.xlf:type.3', 3),
					array('LLL:EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_phone.xlf:type.4', 4),
					array('LLL:EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_phone.xlf:type.5', 5),
					array('LLL:EXT:nn_address/Resources/Private/Language/locallang_csh_tx_nnaddress_domain_model_phone.xlf:type.6', 6),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:nn_address/Resources/Private/Language/locallang_db.xlf:tx_nnaddress_domain_model_phone.number',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'person' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		'flexform' => array(
			'exclude' => 1,
			'label' => '',
			'config' => array(
				'type' => 'flex',
				'ds_pointerField' => 'uid',
				'ds' => array(
					'default' => ''
				),
			),
		)
	),
);

// Add Flexform if in extManager Conf is set or remove the sheet
\NN\NnAddress\Utility\Flexform::modifyFlexSheet($TCA, 'phone');

?>