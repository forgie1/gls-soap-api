<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Request\Entities;

class Service
{

	/** @var string type of the printer – list in Appendix B */
	private $code;

	/** @var string parameter for service */
	private $info = '';

	/**
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @param string $code
	 * @return $this
	 */
	public function setCode($code)
	{
		$this->code = $code;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getInfo(): string
	{
		return $this->info;
	}

	/**
	 * @param string $info
	 * @return $this
	 */
	public function setInfo($info)
	{
		$this->info = $info;
		return $this;
	}

}