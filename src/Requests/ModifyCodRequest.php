<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Requests;

use GlsSoapApi\Responses\ModifyCodResponse;

class ModifyCodRequest extends BaseRequest
{

	/**
	 * @var string[]
	 * id of the parcel to modify cod
	 */
	private $pclid = [];

	/**
	 * @var float
	 * use 0 for codamount if you would like to storno COD service and not collect COD for selected parcel at all
	 */
	private $codAmount;

	public function __construct(array $pclid, $codAmount)
	{
		$this->pclid = $pclid;
		$this->codAmount = $codAmount;
	}

	public function getSoapAction(): string
	{
		return 'modifycod';
	}

	public function getArrayData(): array
	{
		return [
		'pclid' => $this->pclid,
		'codamount' => $this->codAmount,
		];
	}

	public function getResponseClass(): string
	{
		return ModifyCodResponse::class;
	}

}
