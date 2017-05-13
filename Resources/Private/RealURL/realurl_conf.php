/**
 * Include this file in your realurl conf
 *
 * require_once(PATH_site.'typo3conf/ext/nn_address/Resources/Private/RealURL/realurl_conf.php');
 */

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['postVarSets']['_DEFAULT']['details'] = array(
	array(
		'GETvar' => 'tx_nnaddress_abclist[person]',
			'lookUpTable' => array(
			'table' => 'tx_nnaddress_domain_model_person',
			'id_field' => 'uid',
			'alias_field' => 'CONCAT(last_name,\'_\',organisation)',
			'addWhereClause' => ' AND NOT deleted',
			'useUniqueCache' => 1,
			'useUniqueCache_conf' => array(
				'strtolower' => 1,
				'spaceCharacter' => '-',
			),
		),
  )
);