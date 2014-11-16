<?php
App::import('Vendor', 'GoogleRecaptcha.GoogleReCAPTCHA', array('file' => 'GoogleReCAPTCHA' . DS . 'recaptchalib.php'));

class GoogleRecaptchaHelper extends Helper {

	public function getRecaptcha() {
		$publicKey = Configure::read('GoogleRecaptcha.publicKey');
		return recaptcha_get_html($publicKey);
	}
}