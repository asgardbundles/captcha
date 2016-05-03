<?php
class CaptchaTest extends PHPUnit_Framework_TestCase {
	public function test1() {
		$httpKernel = new \Asgard\Http\HttpKernel;
		$httpKernel->addRequest(new \Asgard\Http\Request);
		\Asgard\Container\Container::singleton()['httpKernel'] = $httpKernel;
		$img = Asgard\Captcha\Libs\Captcha::image();
		$this->assertTrue(is_resource($img));
		$this->assertEquals('gd', get_resource_type($img));

		$controller = new \Asgard\Captcha\Controller\CaptchaController;
		$response = $controller->run('captcha');
		$this->assertEquals('image/jpeg', $response->getHeader('content-type'));
		$this->assertRegExp('/CREATOR: gd-jpeg v1.0/', $response->getContent());
	}
}