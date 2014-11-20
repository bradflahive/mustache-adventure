<?php

/**
 * Default View
 */
class LoginView extends View {
	public function __construct() {
		
		// Set Master Template for this View
		parent::__construct(ROOT . '/app/templates/login.php');
		
		// Make Sub Views
		$this->primary_header = new View(ROOT . '/app/templates/primary_header.php');
		
	}
}