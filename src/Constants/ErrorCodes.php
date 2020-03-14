<?php

/**
 * This file is part of gls-api.
 * Copyright © 2020 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi\Constants;

class ErrorCodes
{

	const ERROR_CODES = [
		0 => "OK",
		1 => "Authentication failed",
		2 => "Invalid hash",
		3 => "Unable to store data please try again later",
		4 => "Invalid printer template please check documentation",
		5 => "Missing parameters:",
		6 => "Invalid timestamp",
		7 => "Invalid sender country",
		8 => "Invalid consignee country",
		9 => "Invalid sender zipcode",
		10 => "Invalid consignee zipcode",
		11 => "Invalid pickup date",
		12 => "Parcel count must be between 1 and 99",
		13 => "Missing contact person for export parcel",
		14 => "COD is not allowed to this export country",
		15 => "Max value for COD is:",
		16 => "Invalid COD rounding the smallest fraction is",
		17 => "Invalid service code(s):",
		18 => "Invalid service combination(s):",
		19 => "Service(s) not available in pickup country:",
		20 => "Service(s) not available between sender and consignee country:",
		21 => "Service(s) not available on consignee country/zipcode:",
		22 => "Invalid / missing parameters for service(s):",
		23 => "FSS service is valid only with ordered FDS service",
		24 => "For parcels to HR with zipcode 20xxx please use DPV parameter info to send declared parcel value for parcel",
		25 => "Same request sent 5 times within last 5 minutes!",
		26 => "Requested parcel not belongs to the user!",
		27 => "Wrong XML format!",
		28 => "One or more parcels is impossible to delete.",
		29 => "No parcels to deleting.",
		30 => "Parcel was deleted before this request.",
		31 => "Parcel number was not found.",
		32 => "You can send only one parcel with ADR service in order.",
		33 => "You can send only one parcel with ADR service in order.",
		34 => "You can't use the same parcel number more times.",
		35 => "Count of parcels and inserted numbers are different.",
		36 => "Parcel number has a bad format.",
		37 => "The parcel number isn't assigned to your sender ID.",
		38 => "The parcel number was already used.",
		39 => "You don't have necessary rights to use the following sender id:",
		40 => "Missing contact phone for consignee (%s service)",
		41 => "Invalid parcel number",
		42 => "Missing COD amount",
		43 => "COD amount is less than zero",
		44 => "COD amount is greater than maximum value",
		45 => "Invalid e-mail address",
		46 => "Process failed",
	];

}
