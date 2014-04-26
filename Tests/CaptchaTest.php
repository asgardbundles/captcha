<?php
class CaptchaTest extends PHPUnit_Framework_TestCase {
	public static function setUpBeforeClass() {
		if(!defined('_ENV_'))
			define('_ENV_', 'test');
		require_once _VENDOR_DIR_.'autoload.php';
		\Asgard\Core\App::instance(true)->config->set('bundles', array(
				__DIR__.'/..',
		))
		->set('bundlesdirs', array());
		\Asgard\Core\App::loadDefaultApp(false);
	}
	
	public function test1() {
		$img = Asgard\Captcha\Libs\Captcha::image();
		$this->assertTrue(is_resource($img));
		$this->assertEquals('gd', get_resource_type($img));

		$response = Asgard\Core\Controller::run('Asgard\Captcha\Controllers\CaptchaController', 'captcha');
		$this->assertEquals('image/jpeg', $response->getHeader('content-type'));
		$this->assertRegExp('/CREATOR: gd-jpeg v1.0/', $response->getContent());
	}
}