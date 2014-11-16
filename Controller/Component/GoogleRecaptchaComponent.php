<?php
App::import('Vendor', 'GoogleRecaptcha.GoogleReCAPTCHA', array('file' => 'GoogleReCAPTCHA' . DS . 'recaptchalib.php'));

class GoogleRecaptchaComponent extends Component {
	
	public function checkRecaptcha() {
		
		$privateKey = Configure::read('GoogleRecaptcha.privateKey');
		$resp = recaptcha_check_answer($privateKey,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);

		return $resp->is_valid;
	}
}