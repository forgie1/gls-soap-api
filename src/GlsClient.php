<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi;

use GlsSoapApi\Responses\BaseResponse;
use GlsSoapApi\Exceptions\GlsException;

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

	const ALLOWED_ENDPOINTS = [
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

	/** @var GlsLoggerI|null */
	private $logger;

	public function __construct(string $endPoint, string $userName, string $password, string $senderId, bool $testMode = false)
	{
		if (!array_key_exists($endPoint, self::ALLOWED_ENDPOINTS)) {
			throw new GlsException('Unsupported endpoint: ' . $endPoint);
		} else {
			$this->requestUrl = self::ALLOWED_ENDPOINTS[$endPoint];
		}

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

	/**
	 * @param GlsLoggerI|null $logger
	 * @return $this
	 */
	public function setLogger(?GlsLoggerI $logger)
	{
		$this->logger = $logger;
		return $this;
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
			$this->logger?->logg('request data', $data);

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
				if ($this->logger) {
					trigger_error($e->getMessage() . ' -- for more see the log');
				} else {
					trigger_error($e->getMessage() . ' -- for more set the logger');
				}
			}
		}

		$this->logger?->logg('data', $data ?? []);
		$this->logger?->logg('last request', [$soapClient->__getLastRequest()]);
		$this->logger?->logg('last response', [$soapClient->__getLastResponse()]);
		$this->logger?->logg('response array', $responseArray ? (is_array($responseArray) ? $responseArray : [$responseArray]) : [null]);

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
