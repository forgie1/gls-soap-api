<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Requests;

abstract class BaseRequest
{

	abstract public function getSoapAction(): string;

	abstract public function getArrayData(): array;

	abstract public function getResponseClass(): string;

}
