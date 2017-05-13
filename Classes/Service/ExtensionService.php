<?php

namespace NN\NnAddress\Service;

class ExtensionService extends \TYPO3\CMS\Extbase\Service\ExtensionService implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * Checks if the given action is cacheable or not.
	 * In this case disables caching if option enableSearch is set. Useful for search forms in an action
	 * which is mostly cached but if you have an search field caching is a problem.
	 *
	 * @param string $extensionName Name of the target extension, without underscores
	 * @param string $pluginName Name of the target plugin
	 * @param string $controllerName Name of the target controller
	 * @param string $actionName Name of the action to be called
	 * @return boolean TRUE if the specified plugin action is cacheable, otherwise FALSE
	 */ 
    public function isActionCacheable($extensionName, $pluginName, $controllerName, $actionName) {
		$frameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, $extensionName, $pluginName);
		
		if ( $frameworkConfiguration['settings']['enableSearch'] == 1 ) {
			return false;
		} else return parent::isActionCacheable($extensionName, $pluginName, $controllerName, $actionName);
	}
	
}

?>