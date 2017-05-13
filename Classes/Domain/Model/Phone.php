<?php
namespace NN\NnAddress\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Hendrik Reimers <h.reimers@neonaut.de>, Neonaut GmbH
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package nn_address
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Phone extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * type
	 *
	 * @var \integer
	 */
	protected $type;

	/**
	 * number
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $number;
	
	/**
	 * flexform
	 *
	 * @var \string
	 */
	protected $flexform;

	/**
	 * Returns the type
	 *
	 * @return \integer $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param \integer $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the number
	 *
	 * @return \string $number
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * Sets the number
	 *
	 * @param \string $number
	 * @return void
	 */
	public function setNumber($number) {
		$this->number = $number;
	}
	
	/**
	 * Returns the flexform
	 *
	 * @return \array $flexform
	 */
	public function getFlexform() {
		if ( !empty($this->flexform) ) {
			$ffh       = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Service\\FlexFormService');
			$flexArray = $ffh->convertFlexFormContentToArray($this->flexform);
			
			return $flexArray;
		} else return array();
	}

}
?>