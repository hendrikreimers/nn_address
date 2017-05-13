<?php
namespace NN\NnAddress\Domain\Repository;

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
class GroupRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	protected $defaultOrderings = array(
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
	);
	
	public function findAll() {
		$query = $this->createQuery();
		$query->matching($query->equals('parentGroup', 0));
		
		$rootGroups = $query->execute();
		
		if ( $rootGroups->count() > 0 ) {
			for ( $i = 0; $i < $rootGroups->count(); $i++ ) {
				$group = &$rootGroups[$i];
				$group->setChildGroups(new \TYPO3\CMS\Extbase\Persistence\ObjectStorage());
				
				$group = $this->findChildGroups($group);
			}
		}
		
		return $rootGroups;
	}
	
	public function findOneByUid($uid) {
		$query = $this->createQuery();
		$query->setLimit(1);
		$query->matching($query->equals('uid', intval($uid)));
		
		$rootGroups = $query->execute();
		if ( $rootGroups->count() > 0 ) {
			for ( $i = 0; $i < $rootGroups->count(); $i++ ) {
				$group = &$rootGroups[$i];
				$group->setChildGroups(new \TYPO3\CMS\Extbase\Persistence\ObjectStorage());
				
				$group = $this->findChildGroups($group);
			}
		}
		
		return $rootGroups->getFirst();
	}
	
	private function findChildGroups(&$parentGroup) {
		$query = $this->createQuery();
		$query->matching($query->equals('parentGroup', $parentGroup->getUid()));
		
		$groups = $query->execute();
		
		if ( $groups->count() > 0 ) {
			for ( $i = 0; $i < $groups->count(); $i++ ) {
				$group = &$groups[$i];
				$group->setChildGroups(new \TYPO3\CMS\Extbase\Persistence\ObjectStorage());
				
				$group = $this->findChildGroups($group);
				
				$parentGroup->addChildGroup($group);
			}
		}
		
		return $parentGroup;
	}
}
?>