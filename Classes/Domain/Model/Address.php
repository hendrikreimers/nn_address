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
class Address extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * type
	 *
	 * @var \integer
	 */
	protected $type;

	/**
	 * street
	 *
	 * @var \string
	 */
	protected $street;

	/**
	 * streetNr
	 *
	 * @var \string
	 */
	protected $streetNr;

	/**
	 * building
	 *
	 * @var \string
	 */
	protected $building;

	/**
	 * room
	 *
	 * @var \string
	 */
	protected $room;

	/**
	 * zip
	 *
	 * @var \string
	 */
	protected $zip;

	/**
	 * city
	 *
	 * @var \string
	 */
	protected $city;

	/**
	 * country
	 *
	 * @var \string
	 */
	protected $country;

	/**
	 * region
	 *
	 * @var \string
	 */
	protected $region;

	/**
	 * website
	 *
	 * @var \string
	 */
	protected $website;
	
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
	 * Returns the street
	 *
	 * @return \string $street
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Sets the street
	 *
	 * @param \string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * Returns the streetNr
	 *
	 * @return \string $streetNr
	 */
	public function getStreetNr() {
		return $this->streetNr;
	}

	/**
	 * Sets the streetNr
	 *
	 * @param \string $streetNr
	 * @return void
	 */
	public function setStreetNr($streetNr) {
		$this->streetNr = $streetNr;
	}

	/**
	 * Returns the building
	 *
	 * @return \string $building
	 */
	public function getBuilding() {
		return $this->building;
	}

	/**
	 * Sets the building
	 *
	 * @param \string $building
	 * @return void
	 */
	public function setBuilding($building) {
		$this->building = $building;
	}

	/**
	 * Returns the room
	 *
	 * @return \string $room
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * Sets the room
	 *
	 * @param \string $room
	 * @return void
	 */
	public function setRoom($room) {
		$this->room = $room;
	}

	/**
	 * Returns the zip
	 *
	 * @return \string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param \string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return \string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param \string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the country
	 *
	 * @return \string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the region
	 *
	 * @return \string $region
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * Sets the region
	 *
	 * @param \string $region
	 * @return void
	 */
	public function setRegion($region) {
		$this->region = $region;
	}

	/**
	 * Returns the website
	 *
	 * @return \string $website
	 */
	public function getWebsite() {
		return $this->website;
	}

	/**
	 * Sets the website
	 *
	 * @param \string $website
	 * @return void
	 */
	public function setWebsite($website) {
		$this->website = $website;
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