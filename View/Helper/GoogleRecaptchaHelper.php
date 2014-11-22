<?php
class GoogleRecaptchaHelper extends Helper {

	public $apiScriptUrl = 'https://www.google.com/recaptcha/api.js';

	public $helpers = array('Html');

	public function getRecaptcha() {
		
		// include script in head
		$this->Html->script($this->apiScriptUrl, array('inline' => false));

		// retrieve the site key from config
		$siteKey = Configure::read('GoogleRecaptcha.siteKey');

		// create the div element
		return $this->Html->div('g-recaptcha',
			'', array(
				'data-sitekey' => $siteKey
				));
	}
}