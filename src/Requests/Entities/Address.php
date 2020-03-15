<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Requests\Entities;

class Address
{

	/** @var string */
	private $name;

	/** @var string */
	private $address;

	/** @var string */
	private $city;

	/** @var string */
	private $zipCode;

	/** @var string */
	private $country;

	/** @var string|null */
	private $contact;

	/** @var string|null */
	private $phone;

	/** @var string|null */
	private $email;

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return $this
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAddress(): string
	{
		return $this->address;
	}

	/**
	 * @param string $address
	 * @return $this
	 */
	public function setAddress($address)
	{
		$this->address = $address;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCity(): string
	{
		return $this->city;
	}

	/**
	 * @param string $city
	 * @return $this
	 */
	public function setCity($city)
	{
		$this->city = $city;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getZipCode(): string
	{
		return $this->zipCode;
	}

	/**
	 * @param string $zipCode
	 * @return $this
	 */
	public function setZipCode($zipCode)
	{
		$this->zipCode = $zipCode;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCountry(): string
	{
		return $this->country;
	}

	/**
	 * @param string $country
	 * @return $this
	 */
	public function setCountry($country)
	{
		$this->country = $country;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getContact(): string
	{
		return $this->contact ?? '';
	}

	/**
	 * @param string|null $contact
	 * @return $this
	 */
	public function setContact($contact)
	{
		$this->contact = $contact;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPhone(): string
	{
		return $this->phone ?? '';
	}

	/**
	 * @param string|null $phone
	 * @return $this
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email ?? '';
	}

	/**
	 * @param string|null $email
	 * @return $this
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

}
