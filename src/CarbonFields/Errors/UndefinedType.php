<?php

namespace NCPR\DivinerArchivePlugin\CarbonFields\Errors;

class UndefinedType extends \Exception {

	public function errorMessage() {
		return 'Error on line ' . $this->getLine() . ' in ' . $this->getFile() .': <b>' . $this->getMessage() . '</b>';
	}

}
