<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Entities\Responses;

class BaseResponse
{

	/** @var boolean */
	private $success; // if false, errcode and errdesc will be set

	/** @var int|null */
	private $errorCode; // numeric error code, please list in AppendixD

	/** @var string|null */
	private $errorDesc; // error description

	public function __construct(array $data)
	{
		$this->success = $data['successfull'];
		$this->errorCode = $data['errcode'] ?? null;
		$this->errorDesc = $data['errdesc'] ?? null;
	}

	/**
	 * @return bool
	 */
	public function isSuccess(): bool
	{
		return $this->success;
	}

	/**
	 * @return int|null
	 */
	public function getErrorCode(): ?int
	{
		return $this->errorCode;
	}

	/**
	 * @return string|null
	 */
	public function getErrorDesc(): ?string
	{
		return $this->errorDesc;
	}

}
