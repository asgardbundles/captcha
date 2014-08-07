<?php
class CaptchaTest extends PHPUnit_Framework_TestCase {
	public function test1() {
		\Asgard\Container\Container::singleton()['request'] = new \Asgard\Http\Request;
		$img = Asgard\Captcha\Libs\Captcha::image();
		$this->assertTrue(is_resource($img));
		$this->assertEquals('gd', get_resource_type($img));

		$controller = new \Asgard\Captcha\Controllers\CaptchaController;
		$response = $controller->run('captcha');
		$this->assertEquals('image/jpeg', $response->getHeader('content-type'));
		$this->assertRegExp('/CREATOR: gd-jpeg v1.0/', $response->getContent());
	}
}