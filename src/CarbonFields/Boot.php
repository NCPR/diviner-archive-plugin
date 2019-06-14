<?php

namespace NCPR\DivinerArchivePlugin\CarbonFields;

use \Carbon_Fields\Carbon_Fields;

/**
 * Class Boot
 *
 * @package Diviner\CarbonFields
 */
class Boot {

	/**
	 * Boot carbon fields after theme setup
	 */
	public function boot_carbon_fields() {
		Carbon_Fields::boot();
	}

}
