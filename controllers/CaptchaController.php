<?php
namespace Coxis\Captcha\Controllers;

class CaptchaController extends \Coxis\Core\Controller {
	/**
	@Route('captcha')
	*/
	public function captchaAction($request) {
		$width = \Coxis\Core\App::get('get')->get('width', '151');
		$height = \Coxis\Core\App::get('get')->get('height', '61');
		$characters = \Coxis\Core\App::get('get')->get('characters', '6');
		 
		$captcha = new \Coxis\Captcha\Libs\Captcha($width, $height, $characters);
		$image = $captcha->image();
		imagejpeg($image);
		imagedestroy($image);
		$this->response->setHeader('Content-Type', 'image/jpeg');
	}
}