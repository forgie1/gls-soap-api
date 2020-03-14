<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Constants;

class Services
{

	const EXPRESS_SERVICE = 'T12'; // Expresní balík. Službu je platná pro určitá PSČ. Toto PSČ lze ověřit z databáze routovacích tras. Prázdný parametr.
	const PICK_AND_SHIP_SERVICE = 'PSS'; // Vyzvedni a doruč jinam. Parametrem je datum vyzvednutí ve formátu yyyy-MM-dd.
	const PICK_AND_RETURN_SERVICE = 'PRS'; // Vyzvedni a doruč mně. Parametrem je datum vyzvednutí ve formátu yyyy-MM-dd.
	const EXCHANGE_SERVICE = 'XS'; // Výměna balíku, nutné vytisknout štítek na navrácení. Prázdný parametr.
	const DOCUMENT_RETURN_SERVICE = 'SZL'; // Dokumenty zpět. Parametru je číslo dodacího listu max. 15 znaků
	const DECLARED_VALUE_INSURANCE_SERVICE = 'INS'; // Připojištění balíku. Parametrem je hodnota připojištění. Pro CZ je to hodnota 6000 – 100 000 CZK.
	const ADDRESSEE_ONLY_SERVICE = 'AOS'; // Do vlastních rukou. Parametrem je jméno příjemce.
	const GUARANTEED_24_SERVICE = '24H'; // Garantované 24H doručení. Prázdný parametr.
	const SMS_SERVICE = 'SM1'; // SMS avízo o odeslání zásilky. Telefonní číslo a SMS text ve formátu ”číslo balíku v mezinárodním formátu|sms text”.
	const PRE_ADVICE_SERVICE = 'SM2'; // SMS avízo o doručení zásilky. Parametrem je telefonní číslo v mezinárodním formátu (+420777123456). V případě služby Pick&Ship, je odeslána avizační SMS na odesilatele a obsahuje informaci o vyzvednutí balíku.
	const THINK_GREEN_SERVICE = 'TGS'; // Služba ThinkGreen. Prázdný parametr.
	const FLEX_DELIVERY_SERVICE = 'FDS'; // Flexibilní doručení. Parametrem je emailová adresa příjemce.
	const FLEX_DEIVERY_SMS_Service = 'FSS'; // Flexibilní doručení. Parametrem je telefonní číslo v mezinárodním formátu. Tato služba je dostupná pouze se službou FDS.
	const SHOP_DELIVERY_SERVICE = 'PSD'; // Doručení na Parcel Shop. Parametrem je ID Parcel Shopu. Adresou příjemce je adresa ParcelShopu. Adresa ParcelShopu je umístěna jak na štítku, tak i v datech. Jméno skutečného příjemce je uvedeno pouze jako kontaktní osoba.
	const DECLARED_PARCEL_VALUE = 'DPV'; // Deklarovaná hodtnota balíku. V případě, že balík posíláte do HR a na PSČ začínající 20xxx je tato služba povinná. Parametrem je „hodnota zásilky v měně destinace #obsah zásilky“.
	const COD_SERVICE = 'COD'; // Služba dobírka – nastaví se automamaticky pokud je v zásilce vyplněno COD Amount větší než 0

}
