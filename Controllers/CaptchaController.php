<?php
namespace Asgard\Captcha\Controllers;

class CaptchaController extends \Asgard\Core\Controller {
	/**
	@Route('captcha')
	*/
	public function captchaAction($request) {
		$width = \Asgard\Core\App::get('get')->get('width', '151');
		$height = \Asgard\Core\App::get('get')->get('height', '61');
		$characters = \Asgard\Core\App::get('get')->get('characters', '6');
		 
		$captcha = new \Asgard\Captcha\Libs\Captcha($width, $height, $characters);
		$image = $captcha->image();
		imagejpeg($image);
		imagedestroy($image);
		$this->response->setHeader('Content-Type', 'image/jpeg');
	}
}