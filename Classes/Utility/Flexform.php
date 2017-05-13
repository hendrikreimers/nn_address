<?php

namespace NN\NnAddress\Utility;

class Flexform {

    /**
     * Call this function at the end of your ext_tables.php to autoregister the flexforms
     * of the extension to the given plugins.
	 *
	 * @return void
     */
    public static function flexFormAutoLoader() {
        global $TCA, $_EXTKEY;
        $_extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['nn_address']);
				
        $FlexFormPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/FlexForms/';
        $extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
				
        $FlexForms = \TYPO3\CMS\Core\Utility\GeneralUtility::getFilesInDir($FlexFormPath, 'xml');
				
        foreach ($FlexForms as $FlexForm) {
			if ( preg_match("/^Model_(.*)$/",$FlexForm) ) continue;
			
            $fileKey = str_replace('.xml', '', $FlexForm);

            $pluginSignature = strtolower($extensionName . '_' . $fileKey);
			
            $TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
            $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

            $fileFlexForm = 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/' . $fileKey . '.xml';
            
            // Any flexform dir in extension config set?
            if ( $_extConfig['flexFormPlugin'] != '' ) {
              if ( is_dir(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($_extConfig['flexFormPlugin'])) ) {
              
                  // modify the relative path
                  $path = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($_extConfig['flexFormPlugin']);
                  $path = ( preg_match('/^(.*)\/$/', $path) ) ? $path : $path.'/';

                  $fileFlexForm = 'FILE:' . $path . $fileKey . '.xml';
                }            
              } 

              \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, $fileFlexForm);
        }
    }
	
	/**
	 * Modifies the TCA Configuration in Configuration/TCA/Person.php to add
	 * the Flexform file or remove the sheet of the field "flexform".
	 *
	 * @param array $TCA
	 * @param string $model
	 * @return void
	 */
	public static function modifyFlexSheet(&$TCA, $model = 'person') {
		$_extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['nn_address']);
		
		// Any flexform set?
		if ( $_extConfig['flexForm'] != '' ) {
			// If a directory set, multiple models could have a flexform file
			if ( is_dir(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($_extConfig['flexForm'])) ) {
				// modify the relative path
				$path = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($_extConfig['flexForm']);
				$path = ( preg_match('/^(.*)\/$/', $path) ) ? $path : $path.'/';
				
				// Check if file in any combination exists
				if ( file_exists($path.$model.'.xml') ) {
					$file = $model.'.xml';
				} elseif ( file_exists($path.$model.'.XML') ) {
					$file = $model.'.XML';
				} elseif ( file_exists($path.ucwords($model).'.xml') ) {
					$file = ucwords($model).'.xml';
				} elseif ( file_exists($path.ucwords($model).'.XML') ) {
					$file = ucwords($model).'.XML';
				} else {
					// Remove flexforms in TCA
					$TCA['tx_nnaddress_domain_model_'.$model]['types']['1']['showitem'] = str_replace('flexform', '', $TCA['tx_nnaddress_domain_model_'.$model]['types']['1']['showitem']);
				}
				
				$TCA['tx_nnaddress_domain_model_'.$model]['columns']['flexform']['config']['ds']['default'] = 'FILE:'.$path.$file;
			} else {
				if ( $model !== 'person' ) {
					// Remove flexforms in TCA
					$TCA['tx_nnaddress_domain_model_'.$model]['types']['1']['showitem'] = str_replace('flexform', '', $TCA['tx_nnaddress_domain_model_'.$model]['types']['1']['showitem']);
				} else {
					// Backwards compability to extend person model
					$TCA['tx_nnaddress_domain_model_person']['columns']['flexform']['config']['ds']['default'] = 'FILE:'.$_extConfig['flexForm'];
				}
			}
		} else {
			// If nothing available remove anywhere the flexform field view
			$TCA['tx_nnaddress_domain_model_'.$model]['types']['1']['showitem'] = str_replace('--div--;LLL:EXT:nn_address/Resources/Private/Language/locallang_db.xlf:tx_nnaddress_domain_model_'.$model.'.advanced, flexform,', '', $TCA['tx_nnaddress_domain_model_'.$model]['types']['1']['showitem']);
			$TCA['tx_nnaddress_domain_model_'.$model]['types']['1']['showitem'] = str_replace('flexform', '', $TCA['tx_nnaddress_domain_model_'.$model]['types']['1']['showitem']);
		}
		
		unset($_extConfig);
	}
}

?>