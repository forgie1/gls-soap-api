<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi;

use GlsSoapApi\Entities\Responses\BaseResponse;
use GlsSoapApi\Exceptions\GlsException;

class GlsClient
{

	const HU = 'https://online.gls-hungary.com/webservices/soap_server.php?wsdl&ver=18.09.12.01';
	const SK = 'https://online.gls-slovakia.sk/webservices/soap_server.php?wsdl&ver=18.09.12.01';
	const CZ = 'https://online.gls-czech.com/webservices/soap_server.php?wsdl&ver=18.09.12.01';
	const RO = 'https://online.gls-romania.com/webservices/soap_server.php?wsdl&ver=18.09.12.01';
	const SI = 'https://online.gls-slovenia.com/webservices/soap_server.php?wsdl&ver=18.09.12.01';
	const HR = 'https://online.gls-croatia.com/webservices/soap_server.php?wsdl&ver=18.09.12.01';

	const ALLOWED_COUNTRY_CODES = [
		'HU' => self::HU,
		'SK' => self::SK,
		'CZ' => self::CZ,
		'RO' => self::RO,
		'SI' => self::SI,
		'HR' =>self::HR,
	];

	/** @var string */
	private $userName;

	/** @var string */
	private $password;

	/** @var string */
	private $senderId;

	/** @var string */
	private $requestUrl;

	public function __construct(string $userName, string $password, string $senderId, string $countryCode)
	{
		if (array_key_exists($countryCode, self::ALLOWED_COUNTRY_CODES)) {
			throw new GlsException('Unsupported country code: ' . $countryCode);
		} else {
			$this->requestUrl = self::ALLOWED_COUNTRY_CODES[$countryCode];
		}

		$this->userName = $userName;
		$this->password = $password;
		$this->senderId = $senderId;
	}

	public function send(Requests\BaseRequest $request): BaseResponse
	{
		$soapClient = new \SoapClient(null, [
			'connection_timeout' => 15,
			'exceptions' => true,
		]);

		$soapClient->__setLocation($this->requestUrl);
		$responseArray = $soapClient->__soapCall($request->getSoapAction(), $this->getAuthArray() + $request->getArrayData());

		return new ($request->getResponseClass())($responseArray);
	}

	private function getAuthArray(): array
	{
		return [
			'username' => $this->userName,
			'password' => $this->password,
			'senderid' => $this->senderId
		];
	}

}
