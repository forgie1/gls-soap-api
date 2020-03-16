<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi;

use GlsSoapApi\Responses\BaseResponse;
use GlsSoapApi\Exceptions\GlsException;
use Tracy\Debugger;

class GlsClient
{

	const TEST_URL = 'http://test.online.gls-czech.com/webservices/soap_server.php?wsdl&ver=16.12.15.01';
	const TEST_USER = 'clientTest';
	const TEST_PASSWORD = 'testAcount0GLS';
	const TEST_USER_ID = '050000001';

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
		'HR' => self::HR,
	];

	/** @var string */
	private $userName;

	/** @var string */
	private $password;

	/** @var string */
	private $senderId;

	/** @var string */
	private $requestUrl;

	/** @var bool */
	private $testMode;

	public function __construct(string $userName, string $password, string $senderId, string $countryCode, bool $testMode = false)
	{
		if (!array_key_exists($countryCode, self::ALLOWED_COUNTRY_CODES)) {
			throw new GlsException('Unsupported country code: ' . $countryCode);
		} else {
			$this->requestUrl = self::ALLOWED_COUNTRY_CODES[$countryCode];
		}

		$this->testMode = $testMode;

		if ($testMode) {
			$this->requestUrl = self::TEST_URL;
			$this->userName = self::TEST_USER;
			$this->password = self::TEST_PASSWORD;
			$this->senderId = self::TEST_USER_ID;
		} else {
			$this->userName = $userName;
			$this->password = $password;
			$this->senderId = $senderId;
		}
	}

	public function send(Requests\BaseRequest $request): BaseResponse
	{
		$soapClient = new \SoapClient(null, [
			'trace' => true,
			'location' => $this->requestUrl,
			'uri' => $request->getSoapAction(),
			'connection_timeout' => 15,
			'exceptions' => true,
		]);

		try {
			$data = $this->getAuthArray() + $request->getArrayData();
			$data['hash'] = $this->generateHash($data);
			$responseArray = $soapClient->__soapCall($request->getSoapAction(), $data);
		} catch (\SoapFault $e) {
			if (
				$soapClient->__getLastResponse() === 'Database connection error!' ||
				$soapClient->__getLastResponse() === 'Unable to store data, please try again later'
			) {
				$responseArray['successfull'] = false;
				$responseArray['errcode'] = 1;
				$responseArray['errdesc'] = 'Chyba na straně GLS (' . $soapClient->__getLastResponse() . '). Zkuste to prosím znova';
			} else {
				Debugger::log($data ?? null);
				Debugger::log($soapClient->__getLastRequest());
				Debugger::log($soapClient->__getLastResponse());
				Debugger::barDump($data ?? null, 'data');
				Debugger::barDump($soapClient->__getLastRequest(), 'request', ['truncate' => 3500]);
				Debugger::barDump($soapClient->__getLastResponse(), 'response', ['truncate' => 3500]);

				trigger_error($e->getMessage() . ' -- for more see log');
			}
		}

		if ($this->testMode) {
			Debugger::barDump($data ?? null, 'data');
			Debugger::barDump($soapClient->__getLastRequest(), 'request', ['truncate' => 3500]);
			Debugger::barDump($responseArray ?? null, 'response');
			Debugger::barDump($soapClient->__getLastResponse(), 'response', ['truncate' => 3500]);
		}

		$class = $request->getResponseClass();
		return new $class((array)$responseArray);
	}

	private function getAuthArray(): array
	{
		return [
			'username' => $this->userName,
			'password' => $this->password,
			'senderid' => $this->senderId,
		];
	}

	private function generateHash(array $data): string
	{
		$hashBase = '';
		foreach ($data as $key => $value) {
			if ($key !== 'services'
				&& $key !== 'hash'
				&& $key !== 'timestamp'
				&& $key !== 'printit'
				&& $key !== 'printertemplate'
				&& $key !== 'customlabel'
				&& $key !== 'is_autoprint_pdfs') {
				$hashBase .= $value;
			}
		}

		$hashBase = preg_replace('~\r\n|\r|\n~', '', $hashBase);
		return sha1($hashBase);
	}

}
