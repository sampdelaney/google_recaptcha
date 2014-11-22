CakePHP reCAPTCHA Plugin
========================

A Google reCAPTCHA plugin for CakePHP. Protect your CakePHP website from spam and abuse while letting real people pass through with ease.

## Requirements
- CakePHP 2.2.0 or greater
- PHP 5.5.12 or greater

## Installation
I don't know how to use Composer but I'm sure if you do, you can figure it out. To manually install, download the archive, unzip and then copy into the `app/Plugin/` folder.

## Enable the Plugin
- In your `app/Config/bootstrap.php` file and you're not using `CakePlugin::loadAll();` then add the following line:
```php
CakePlugin::load('GoogleRecaptcha');
```
- Configure the site and secret key in `app/Config/core.php` (available from the Google reCAPTCHA admin pages):
```php
Configure::write('GoogleRecaptcha', array(
	'siteKey' => '{your_site_key}',
	'secretKey' => '{your_private_key}'
));
```
- Include the component and helper in the controller you want to use it in:
```php
class AppController extends Controller {
         public $components = array('GoogleRecaptcha.GoogleRecaptcha');
         public $helpers = array('GoogleRecaptcha.GoogleRecaptcha');
}
```
## Usage
Typically you would use reCAPTCHA in something like a login page where you need to use the helper in the view so the it's displayed to the user, and use the component to validate the user gave the correct response.

`app/View/Users/login.ctp`:
```php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->GoogleRecaptcha->getRecaptcha();
echo $this->Form->submit('Login');
```

`app/Controller/UsersController.php`:
```php
class UsersController extends AppController
{
    public $components = array('GoogleRecaptcha.GoogleRecaptcha');
    public $helpers = array('GoogleRecaptcha.GoogleRecaptcha');
    public $uses = array('User');
    
    public function login() {
      if ($this->request->is('post')) {
        // check reCAPTCHA
        if (!$this->GoogleRecaptcha->checkRecaptcha()) {
          $this->Session->setFlash('Incorrect reCAPTCHA input, please try again.');
          return;
        }
        // Do login
        // ...
      }
    }
```

## Reporting Issues
If you have a problem with the Google reCAPTCHA plugin, please open an issue on [GitHub](https://github.com/sampdelaney/google_recaptcha/issues).

## Contributing
If you would like to contribute to Google reCAPTCHA plugin, you can fork the repository, add features, and send pull requests or open issues.
