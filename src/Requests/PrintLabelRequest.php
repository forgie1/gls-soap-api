<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Requests;

use GlsSoapApi\Entities\Responses\PrintLabelResponse;
use GlsSoapApi\Request\Entities;

class PrintLabelRequest extends BaseRequest
{

	/** @var Entities\RequestData*/
	private $data;

	public function __construct(Entities\RequestData $data)
	{
		$this->data = $data;
	}

	public function getSoapAction(): string
	{
		return 'printlabel';
	}

	public function getArrayData(): array
	{
		$sender = $this->data->getSender();
		$consignee = $this->data->getConsignee();

		$arrayData = [
			'sender_name' => $sender->getName(),
			'sender_address' => $sender->getAddress(),
			'sender_city' => $sender->getCity(),
			'sender_zipcode' => $sender->getZipCode(),
			'sender_country' => $sender->getCountry(),
			'sender_contact' => $sender->getContact(),
			'sender_phone' => $sender->getPhone(),
			'sender_email' => $sender->getEmail(),
			'consig_name' => $consignee->getName(),
			'consig_address' => $consignee->getAddress(),
			'consig_city' => $consignee->getCity(),
			'consig_zipcode' => $consignee->getZipCode(),
			'consig_country' => $consignee->getCountry(),
			'consig_contact' => $consignee->getContact(),
			'consig_phone' => $consignee->getPhone(),
			'consig_email' => $consignee->getEmail(),
			'pcount' => $this->data->getParcelCount(),
			'pickupdate' => $this->data->getPickupDate(),
			'content' => $this->data->getContentDescription(),
			'clientref' => $this->data->getClientReference(),
			'codamount' => $this->data->getCodAmount(),
			'codref' => $this->data->getCodReference(),
			'services' => $this->data->getServices(),
			'printertemplate' => $this->data->getPrinterTemplate(),
			'printit' => $this->data->isPrintIt(),
			'timestamp' => (new \DateTime())->format('YmdHis'), // yyyyMMddHHmmss
			'hash' => 'xsd:string',
			'customlabel' => $this->data->isCustomLabel(),
			'is_autoprint_pdfs' => $this->data->isAutoPrintPdfs(),
			'gapid' => $this->data->getGaPid()
		];

		$arrayData['hash'] = $this->generateHash($arrayData);
	}

	public function getResponseClass(): string
	{
		return PrintLabelResponse::class;
	}
}
