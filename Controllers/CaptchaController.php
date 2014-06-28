<?php
namespace Asgard\Captcha\Controllers;

class CaptchaController extends \Asgard\Http\Controller {
	/**
	 * @Route("captcha")
	 */
	public function captchaAction(\Asgard\Http\Request $request) {
		$width = $request->get->get('width', '151');
		$height = $request->get->get('height', '61');
		$characters = $request->get->get('characters', '6');
		 
		$captcha = new \Asgard\Captcha\Libs\Captcha($width, $height, $characters);
		$image = $captcha->image();
		imagejpeg($image);
		imagedestroy($image);
		$this->response->setHeader('Content-Type', 'image/jpeg');
	}
}