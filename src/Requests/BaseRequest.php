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

	protected function generateHash(array $data): string
	{
		$hashBase = '';
		foreach($data as $key => $value) {
			if ($key != 'services'
				&& $key != 'hash'
				&& $key != 'timestamp'
				&& $key != 'printit'
				&& $key != 'printertemplate'
				&& $key != 'customlabel') {
				$hashBase .= $value;
			}
		}
		return sha1($hashBase);
	}

}
