<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Requests\Entities;

class RequestData
{

	/** @var Address */
	private $sender;

	/** @var Address */
	private $consignee;

	/** @var int count of the parcels / labels to print */
	private $parcelCount;

	/** @var \DateTime pickup date in format yyyy-MM-dd */
	private $pickupDate;

	/** @var string|null content of the parcel – info printed on label */
	private $contentDescription;

	/** @var string|null client reference -- nepovinná položka pro Vaši evidenci zákazníku*/
	private $clientReference = '';

	/** @var float|null COD amount in delivery destination country currency */
	private $codAmount;

	/** @var string|null COD reference – used if COD amount is set = variable symbol */
	private $codReference = '';

	/** @var Service[] */
	private $services = [];

	/** @var string type of the printer – list in Appendix B */
	private $printerTemplate = '';

	/** @var boolean true, if label has to be printed, false if stored in the list */
	private $printIt;

	/** @var boolean if true, client will handle label printing – no label data returned */
	private $customLabel = false;

	/** @var boolean if false then js print() command will be omitted from the label pdfs */
	private $autoPrintPdfs = false;

	/** @var string ONLY IN HU! if it is exists and valid, the function is ready to use */
	private $gaPid;

	/**
	 * @return Address
	 */
	public function getSender(): Address
	{
		return $this->sender;
	}

	/**
	 * @param Address $sender
	 * @return $this
	 */
	public function setSender(Address $sender)
	{
		$this->sender = $sender;
		return $this;
	}

	/**
	 * @return Address
	 */
	public function getConsignee(): Address
	{
		return $this->consignee;
	}

	/**
	 * @param Address $consignee
	 * @return $this
	 */
	public function setConsignee(Address $consignee)
	{
		$this->consignee = $consignee;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getParcelCount(): int
	{
		return $this->parcelCount;
	}

	/**
	 * @param int $parcelCount
	 * @return $this
	 */
	public function setParcelCount(int $parcelCount)
	{
		$this->parcelCount = $parcelCount;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPickupDate(): string
	{
		return $this->pickupDate->format('Y-m-d');
	}

	/**
	 * @param \DateTime $pickupDate
	 * @return $this
	 */
	public function setPickupDate(\DateTime $pickupDate)
	{
		$this->pickupDate = $pickupDate;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getContentDescription(): ?string
	{
		return $this->contentDescription;
	}

	/**
	 * @param string|null $contentDescription
	 * @return $this
	 */
	public function setContentDescription(?string $contentDescription)
	{
		$this->contentDescription = $contentDescription;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getClientReference(): ?string
	{
		return $this->clientReference;
	}

	/**
	 * @param string|null $clientReference
	 * @return $this
	 */
	public function setClientReference(?string $clientReference)
	{
		$this->clientReference = $clientReference;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getCodAmount(): ?float
	{
		return $this->codAmount;
	}

	/**
	 * @param float|null $codAmount
	 * @return $this
	 */
	public function setCodAmount(?float $codAmount)
	{
		$this->codAmount = $codAmount;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCodReference(): ?string
	{
		return $this->codReference;
	}

	/**
	 * @param string|null $codReference
	 * @return $this
	 */
	public function setCodReference(?string $codReference)
	{
		$this->codReference = $codReference;
		return $this;
	}

	/**
	 * @return string[]
	 */
	public function getServiceArray(): array
	{
		$array = [];
		foreach ($this->services as $service) {
			$array[] = [
				'code' => $service->getCode(),
				'info' => $service->getInfo(),
			];
		}

		return $array;
	}

	/**
	 * @return Service[]
	 */
	public function getServices(): array
	{
		return $this->services;
	}

	/**
	 * @param Service[] $services
	 * @return $this
	 */
	public function setServices(array $services)
	{
		$this->services = $services;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPrinterTemplate(): string
	{
		return $this->printerTemplate;
	}

	/**
	 * @param string $printerTemplate
	 * @return $this
	 */
	public function setPrinterTemplate(string $printerTemplate)
	{
		$this->printerTemplate = $printerTemplate;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isPrintIt(): bool
	{
		return $this->printIt;
	}

	/**
	 * @param bool $printIt
	 * @return $this
	 */
	public function setPrintIt(bool $printIt)
	{
		$this->printIt = $printIt;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isCustomLabel(): bool
	{
		return $this->customLabel;
	}

	/**
	 * @param bool $customLabel
	 * @return $this
	 */
	public function setCustomLabel(bool $customLabel)
	{
		$this->customLabel = $customLabel;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isAutoPrintPdfs(): bool
	{
		return $this->autoPrintPdfs;
	}

	/**
	 * @param bool $autoPrintPdfs
	 * @return $this
	 */
	public function setAutoPrintPdfs(bool $autoPrintPdfs)
	{
		$this->autoPrintPdfs = $autoPrintPdfs;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getGaPid(): string
	{
		return $this->gaPid ?? '';
	}

	/**
	 * @param string $gaPid
	 * @return $this
	 */
	public function setGaPid(string $gaPid)
	{
		$this->gaPid = $gaPid;
		return $this;
	}

}
