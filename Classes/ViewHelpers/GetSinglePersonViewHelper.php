<?php
namespace NN\NnAddress\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Claus Due <claus@wildside.dk>, Wildside A/S
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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

/*

USAGE EXAMPLE:

<f:alias map="{externalContact:'{nn:getSinglePerson(uid:2)}'}">
  <f:debug>{externalContact}</f:debug>
</f:alias>

*/

/**
 * Returns a single contact based on the uid and storage pid inside the repository
 *
 *
 */
class GetSinglePersonViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper  {

	/**
	 * personRepository
	 *
	 * @var \NN\NnAddress\Domain\Repository\PersonRepository
	 * @inject
	 */
	protected $personRepository;

	/**
	 * Render method
	 *
	 * @param integer $uid
	 * @return mixed|NULL
	 */
	public function render($uid) {
		return $this->personRepository->findSingleByViewHelper($uid);
	}

}