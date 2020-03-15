<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Requests;

use GlsSoapApi\Responses\DeleteLabelsResponse;

class DeleteLabelsRequest extends BaseRequest
{

	/**
	 * @var string[]
	 * array of id parcels for deletion
	 */
	private $pclids = [];

	/**
	 * @var string
	 * only HU: if it is exists and valid, the function is ready to use
	 */
	private $gapid;

	public function __construct(array $parcelIds, string $gapid = '')
	{
		$this->pclids = $parcelIds;
		$this->gapid = $gapid;
	}

	public function getSoapAction(): string
	{
		return 'deletelabels';
	}

	public function getArrayData(): array
	{
		return [
		'pclids' => $this->pclids,
		'gapid' => $this->gapid,
		];
	}

	public function getResponseClass(): string
	{
		return DeleteLabelsResponse::class;
	}

}
