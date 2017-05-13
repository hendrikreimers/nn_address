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
class PersonRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	protected $defaultOrderings = array(
		'lastName' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
	);
	
	/**
	 * Find all Persons by multiple UIDs
	 *
	 * @param \string $personList Comma seperated list of Person UIDs
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findByUids($personList) {
		$query = $this->createQuery();
		
		$personList = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(",",$personList);
		
		foreach ( $personList as $personUid ) {
			$constraints[] = $query->equals('uid', $personUid);
		}
		
		$query->matching(
				$query->logicalOr($constraints)
		);
		
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		
		return $query->execute();
	}
	
	/**
	 * Find all Persons by a Group
	 *
	 * @param \string $groupList Comma seperated list of Group IDs
	 * @param boolean $andSearch
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findByGroups($groupList, $andSearch = FALSE) {
		$query = $this->createQuery();
		
		$groupList = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(",",$groupList);
		
		foreach ( $groupList as $group ) {
			if ( $group > 0 )
				$constraints[] = $query->logicalAnd(
					$query->contains('groups', $group),
					$query->equals('groups.hidden',0),
					$query->equals('groups.deleted',0)
				);
		}
		
		if ( sizeof($constraints) > 0 ) {
			$query->matching(
					( ($andSearch) ? $query->logicalAnd($constraints) : $query->logicalOr($constraints)),
					$query->equals('pid', $this->storagePid)
			);
		}# else $query->matching($query->equals('pid', $this->storagePid));
		
		return $query->execute();
	}
	
	/**
	 * Find all Persons by search string
	 *
	 * @param \string $sterm
	 * @param \string $fieldList
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findBySword($sterm, $fieldList) {
		$query     = $this->createQuery();
		$fieldList = \TYPO3\CMS\Extbase\Utility\ArrayUtility::trimExplode(',', $fieldList, true);
		
		if ( sizeof($fieldList) <= 0 ) return false;
		
		foreach ( $fieldList as $field ) {
			$constraints[] = $query->like($field, '%'.$sterm.'%');
		}
		
		$query->matching(
				$query->logicalOr($constraints),
				$query->equals('pid', $this->storagePid)
		);
		
		return $query->execute();
	}
	
	/**
	 * Find all Persons by search string
	 *
	 * @param array $groupList
	 * @param \string $sterm
	 * @param \string $fieldList
	 * @param boolean $andSearch
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findByGroupsAndSword($groupList, $sterm, $fieldList, $andSearch = FALSE) {
		$query     = $this->createQuery();
		$fieldList = \TYPO3\CMS\Extbase\Utility\ArrayUtility::trimExplode(',', $fieldList, true);
		$groupList = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(",",$groupList);
		
		if ( sizeof($fieldList) <= 0 ) return false;
		
		foreach ( $groupList as $group ) {
			if ( $group > 0 )
				$groupConstraints[] = $query->logicalAnd(
					$query->contains('groups', $group),
					$query->equals('groups.hidden',0),
					$query->equals('groups.deleted',0)
				);
		}
		
		foreach ( $fieldList as $field ) {
			$constraints[] = $query->like($field, '%'.$sterm.'%');
		}
		
		if ( sizeof($groupConstraints) > 0 ) {
			$query->matching(
				$query->logicalAnd(
					$query->logicalOr($constraints),
					( ($andSearch) ? $query->logicalAnd($groupConstraints) : $query->logicalOr($groupConstraints))
				),
				$query->equals('pid', $this->storagePid)
			);
		} else {
			$query->matching(
					$query->logicalOr($constraints),
					$query->equals('pid', $this->storagePid)
			);
		}
		
		return $query->execute();
	}
	
	/**
	 * Find single contact by getSinglePersonViewHelper
	 *
	 * @param \integer $uid
	 * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function findSingleByViewHelper($uid) {
		$query = $this->createQuery();
		$constraints[] = $query->equals('uid', $uid);
		$query->matching($query->logicalOr($constraints));
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$person = $query->execute()->toArray();
		
		return $person[0];
	}
}
?>