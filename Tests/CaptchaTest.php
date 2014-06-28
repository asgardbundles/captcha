<?php
class CaptchaTest extends PHPUnit_Framework_TestCase {
	public static function setUpBeforeClass() {
		if(!defined('_ENV_'))
			define('_ENV_', 'test');
		\Asgard\Container\Container::instance(true)->config->set('bundles', array(
				__DIR__.'/..',
				new \Asgard\Http\Bundle
		))
		->set('bundlesdirs', []);
		\Asgard\Container\Container::loadDefaultApp(false);
	}
	
	public function test1() {
		$img = Asgard\Captcha\Libs\Captcha::image();
		$this->assertTrue(is_resource($img));
		$this->assertEquals('gd', get_resource_type($img));

		$response = Asgard\Http\Controller::run('Asgard\Captcha\Controllers\CaptchaController', 'captcha');
		$this->assertEquals('image/jpeg', $response->getHeader('content-type'));
		$this->assertRegExp('/CREATOR: gd-jpeg v1.0/', $response->getContent());
	}
}