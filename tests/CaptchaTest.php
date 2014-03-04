<?php
class CaptchaTest extends PHPUnit_Framework_TestCase {
	public static function setUpBeforeClass() {
		if(!defined('_ENV_'))
			define('_ENV_', 'test');
		require_once(_CORE_DIR_.'core.php');
		\Coxis\Core\App::instance(true)->config->set('bundles', array(
				_COXIS_DIR_.'core',
				dirname(__FILE__.'/..'),
		));
		\Coxis\Core\App::loadDefaultApp();
	}
	
	public function test1() {
		$img = Coxis\Captcha\Libs\Captcha::image();
		$this->assertTrue(is_resource($img));
		$this->assertEquals('gd', get_resource_type($img));

		$response = Coxis\Core\Controller::run('Coxis\Captcha\Controllers\CaptchaController', 'captcha');
		$this->assertEquals('image/jpeg', $response->getHeader('content-type'));
		$this->assertRegExp('/CREATOR: gd-jpeg v1.0/', $response->getContent());
	}
}