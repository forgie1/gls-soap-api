<?php

/**
 * This file is part of ArtFocus ArtCMS.
 * Copyright © 2021 Ján Forgáč <forgac@artfocus.cz>
 */

namespace GlsSoapApi;

interface GlsLoggerI
{

	public function logg(string $message, mixed $context = null);

}
