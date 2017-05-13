<?php
namespace NN\NnAddress\ViewHelpers\Form;

/**
 * This view helper generates a <select> dropdown list for the use with a form.
 *
 * Same es the FLUID select view helper but enables the name attribute to be set
 * as array like <select name="example[]"> to render multiple selects as once
 */
class SelectViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\SelectViewHelper {

	/**
	 * Initialize arguments.
	 *
	 * @return void
	 * @api
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('nameAsArray', 'boolean', 'Makes the name attribute as array', FALSE, FALSE);
		$this->registerArgument('renderSubGroups', 'boolean', 'Render child groups as options', FALSE, FALSE);
	}

	/**
	 * Render the tag.
	 *
	 * @return string rendered tag.
	 * @api
	 */
	public function render() {
		$content = parent::render();
		
		if ( !$this->hasArgument('multiple') && $this->arguments['nameAsArray'] )
			$content = preg_replace('/(<select.*name=")(.*)(".*>)/siU', '$1$2[]$3', $content);
		
		return $content;
	}
	
	/**
	 * Render the option tags.
	 *
	 * @param $optionOverride added by nnaddress
	 * @return array an associative array of options, key will be the value of the option tag
	 */
	protected function getOptions($optionOverride = NULL) {
		if ( !$this->arguments['renderSubGroups'] ) return parent::getOptions();
		
		if (!is_array($this->arguments['options']) && !$this->arguments['options'] instanceof \Traversable) {
			return array();
		}
		$options = array();
		$optionsArgument = ( $optionOverride ) ? $optionOverride : $this->arguments['options'];
		foreach ($optionsArgument as $key => $value) {
			if (is_object($value)) {
				// Added by NN Address
				$childOptions = $this->getOptions($value->getChildGroups());
				
				if ($this->hasArgument('optionValueField')) {
					$key = \TYPO3\CMS\Extbase\Reflection\ObjectAccess::getPropertyPath($value, $this->arguments['optionValueField']);
					if (is_object($key)) {
						if (method_exists($key, '__toString')) {
							$key = (string) $key;
						} else {
							throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('Identifying value for object of class "' . get_class($value) . '" was an object.', 1247827428);
						}
					}
				// TODO: use $this->persistenceManager->isNewObject() once it is implemented
				} elseif ($this->persistenceManager->getIdentifierByObject($value) !== NULL) {
					$key = $this->persistenceManager->getIdentifierByObject($value);
				} elseif (method_exists($value, '__toString')) {
					$key = (string) $value;
				} else {
					throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('No identifying value for object of class "' . get_class($value) . '" found.', 1247826696);
				}
				if ($this->hasArgument('optionLabelField')) {
					$value = \TYPO3\CMS\Extbase\Reflection\ObjectAccess::getPropertyPath($value, $this->arguments['optionLabelField']);
					if (is_object($value)) {
						if (method_exists($value, '__toString')) {
							$value = (string) $value;
						} else {
							throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('Label value for object of class "' . get_class($value) . '" was an object without a __toString() method.', 1247827553);
						}
					}
				} elseif (method_exists($value, '__toString')) {
					$value = (string) $value;
				// TODO: use $this->persistenceManager->isNewObject() once it is implemented
				} elseif ($this->persistenceManager->getIdentifierByObject($value) !== NULL) {
					$value = $this->persistenceManager->getIdentifierByObject($value);
				}
			}
			$options[$key] = $value;
			
			// Added by NN Address
			if ( sizeof($childOptions) > 0 ) $options = $options + $childOptions;
		}
		if ($this->arguments['sortByOptionLabel']) {
			asort($options, SORT_LOCALE_STRING);
		}
		
		return $options;
	}
}
