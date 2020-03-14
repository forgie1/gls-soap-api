<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Entities\Responses;

class DeleteLabelsResponse extends BaseResponse
{

	/**
	 * @var string[]|null
	 *
	 * - when variable “successfull” is TRUE that variable “pcls” contains deleted parcels
	 * - when variable “successfull” is FALSE that variable “pcls” contains problematic parcels
	 * - if one of list parcels isn't possible to delete, none parcels will be deleted
	 */
	private $parcelNumbers;

	public function __construct(array $data)
	{
		parent::__construct($data);
		$this->parcelNumbers = $data['pcls'] ?? [];
	}

	/**
	 * @return string[]|null
	 */
	public function getParcelNumbers(): ?array
	{
		return $this->parcelNumbers;
	}

}
