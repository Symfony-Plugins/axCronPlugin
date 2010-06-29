<?php

class axCronException extends Exception {
	public function setLine($line) { 
		$this->line = $line;
	}
	
	public function setFile($file) {
		$this->file = $file;
	}
	
	public static function errorHandlerCallback($code, $string, $file, $line, $context) {
		$e = new self($string, $code);
		$e->line = $line;
		$e->file = $file;
		
		throw $e;
	}
}