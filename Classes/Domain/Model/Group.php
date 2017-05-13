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
class Group extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * description
	 *
	 * @var \string
	 */
	protected $description;
	
	/**
	 * flexform
	 *
	 * @var \string
	 */
	protected $flexform;
	
	/**
	 * __construct
	 *
	 * @return Person
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->parentGroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->childGroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}
	
	/**
	 * Returns the parentId
	 *
	 * @return \integer $parentId
	 */
	public function getParentId() {
		return $this->parentId;
	}

	/**
	 * Sets the parentId
	 *
	 * @param \integer $parentId
	 * @return void
	 */
	public function setParentId($parentId) {
		$this->parentId = $parentId;
	}

	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
	
	/**
	 * parentGroup
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NN\NnAddress\Domain\Model\Group>
	 * @lazy
	 */
	protected $parentGroup;
	
	/**
	 * childGroups
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NN\NnAddress\Domain\Model\Group>
	 * @lazy
	 */
	protected $childGroups;
	
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
	
	/**
	 * Adds a childGroup
	 *
	 * @param \NN\NnAddress\Domain\Model\Group $childGroup
	 * @return void
	 */
	public function addChildGroup(\NN\NnAddress\Domain\Model\Group $childGroup) {
		$this->childGroups->attach($childGroup);
	}
	
	/**
	 * Removes a childGroup
	 *
	 * @param \NN\NnAddress\Domain\Model\Group $groupToRemove The Address to be removed
	 * @return void
	 */
	public function removeChildGroup(\NN\NnAddress\Domain\Model\Group $groupToRemove) {
		$this->childGroups->detach($groupToRemove);
	}
	
	/**
	 * Returns the group
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NN\NnAddress\Domain\Model\Group> $childGroups
	 */
	public function getChildGroups() {
		return $this->childGroups;
	}
	
	/**
	 * Sets the group
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NN\NnAddress\Domain\Model\Group> $childGroups
	 * @return void
	 */
	public function setChildGroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $childGroups) {
		$this->childGroups = $childGroups;
	}
	
	/**
	 * Adds a group
	 *
	 * @param \NN\NnAddress\Domain\Model\Group $parentGroup
	 * @return void
	 */
	public function addParentGroup(\NN\NnAddress\Domain\Model\Group $parentGroup) {
		$this->parentGroup->attach($group);
	}
	
	/**
	 * Removes a parentGroup
	 *
	 * @param \NN\NnAddress\Domain\Model\Group $groupToRemove The Address to be removed
	 * @return void
	 */
	public function removeParentGroup(\NN\NnAddress\Domain\Model\Group $groupToRemove) {
		$this->parentGroup->detach($groupToRemove);
	}
	
	/**
	 * Returns the group
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NN\NnAddress\Domain\Model\Group> $parentGroup
	 */
	public function getParentGroups() {
		return $this->parentGroup;
	}
	
	/**
	 * Sets the group
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NN\NnAddress\Domain\Model\Group> $parentGroup
	 * @return void
	 */
	public function setParentGroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $parentGroup) {
		$this->parentGroup = $parentGroup;
	}

}
?>