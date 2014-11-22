<?php
App::uses('HttpSocket', 'Network/Http');

class GoogleRecaptchaComponent extends Component {

	public $response = null;

	public $apiRequestUrl = 'https://www.google.com/recaptcha/api/siteverify';
	
	public function startup(Controller $controller) {
		// try and retrieve the recaptcha response
		if (array_key_exists('g-recaptcha-response', $controller->data)) {
			$this->response = $controller->data['g-recaptcha-response'];
		}
	}

	public function checkRecaptcha() {
		// check to see if the response has been assigned
		if(is_null($this->response)) {
			// checking for recaptcha when no response was obtained is an error
			throw new CakeException('No recaptcha response assigned');
		}
		// get secret key
		$secretKey = Configure::read('GoogleRecaptcha.secretKey');
		// verify the user response
		$socket = new HttpSocket();
		$response = $socket->get($this->apiRequestUrl, array(
				'secret' => $secretKey,
				'response' => $this->response
			));
		$apiResponse = json_decode($response->body);
		// just return the value of the success flag
		return $apiResponse->success;
	}
}