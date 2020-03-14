<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Entities\Responses;

class ModifyCodResponse extends BaseResponse
{

	public function __construct(array $data)
	{
		parent::__construct($data);
	}

}
