<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Entities\Responses;

class PrintLabelResponse extends BaseResponse
{

	/** @var string[]|null */
	private $parcelNumbers;

	/** @var string[] */
	private $parcelNumbersWithCheckDigit; // return list of the parcel numbers with checkdigit

	/** @var string|null */
	private $pdfData; // pdf data to print or display pdf. Encoded with base64

	/** @var string|null */
	private $depo; // additional data for custom printing on client side

	/** @var string|null */
	private $driver; // additional data for custom printing on client side

	public function __construct(array $data)
	{
		parent::__construct($data);

		$this->parcelNumbers = $data['pcls'] ?? [];
		$this->parcelNumbersWithCheckDigit = $data['pcls_withcheckdigit'] ?? [];
		$this->pdfData = $data['pdfdata'] ?? null;
		$this->depo = $data['depo'] ?? null;
		$this->driver = $data['driver'] ?? null;
	}

	/**
	 * @return string[]|null
	 */
	public function getParcelNumbers(): ?array
	{
		return $this->parcelNumbers;
	}

	/**
	 * @return string[]
	 */
	public function getParcelNumbersWithCheckDigit(): array
	{
		return $this->parcelNumbersWithCheckDigit;
	}

	/**
	 * @return string|null
	 */
	public function getPdfData(): ?string
	{
		return $this->pdfData;
	}

	/**
	 * @return string|null
	 */
	public function getDepo(): ?string
	{
		return $this->depo;
	}

	/**
	 * @return string|null
	 */
	public function getDriver(): ?string
	{
		return $this->driver;
	}

}
