<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends MY_Controller {

	public function index(){
		$data['data']['meta_title'] = 'Liên hệ - '.$this->system['meta_title'];
		$data['data']['meta_keywords'] = $this->system['meta_keywords'];
		$data['data']['meta_description'] = 'Liên hệ - '.$this->system['meta_description'];
		$data['data']['canonical'] = CMS_URL.'lien-he'.CMS_SUFFIX;
		$data['data']['sidebar'] = 1;
		$data['data']['google_authorship'] = $this->system['google_authorship'];
		if($this->input->post('sent')){
			$post_data = $this->input->post('data');
			$data['post_data'] = $post_data;
			$this->form_validation->set_rules('data[fullname]', 'Tên đầy đủ', 'trim|required');
			$this->form_validation->set_rules('data[phone]', 'Số điện thoại', 'trim|required');
			$this->form_validation->set_rules('data[address]', 'Địa chỉ', 'trim|required');
			$this->form_validation->set_rules('data[email]', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('data[notes]', 'Nội dung liên hệ', 'trim|required');
			$this->form_validation->set_rules('txtCaptcha', 'Captcha', 'trim|required|callback__check_captcha');
			$this->form_validation->set_error_delimiters('<li>', '</li>');
			if($this->form_validation->run() == TRUE){
				$post_data['publish'] = 1;
				$post_data['created'] = gmdate('Y-m-d H:i:s', time() + 7*3600);
				$this->db->insert('contacts', $post_data);
				die($this->lib_common->js_redirect(CMS_URL, 'Gửi liên hệ thành công.'));
			}
		}
		$data['template'] = 'frontend/contact/index';
		$this->load->view('frontend/layouts/detail', $data);
	}
	
	public function captcha(){
		$arr_calculations = array(0 => '+', 1 => '-');
		$arr_numbers[1] = array(0 => 'không', 1 => 'một', 2 => 'hai', 3 => 'ba', 4 => 'bốn', 5 => 'năm', 6 => 'sáu', 7 => 'bảy', 8 => 'tám', 9 => 'chín', );
		$arr_numbers[2] = array(0 => 'không', 1 => 'một', 2 => 'hai', 3 => 'ba', 4 => 'bốn', 5 => 'năm', 6 => 'sáu', 7 => 'bảy', 8 => 'tám', 9 => 'chín', );
		$numbers[1] = rand(0, 9);
		$numbers[2] = rand(0, 9);
		$calculations = rand(0, 1);
		$result = 0;
		if($calculations == 1 && $numbers[1] <= $numbers[2]){
			$calculations = 0;
			$result = $numbers[1] + $numbers[2];
		}
		else if($calculations == 1){
			$result = $numbers[1] - $numbers[2];
		}
		else if($calculations == 0){
			$result = $numbers[1] + $numbers[2];
		}
		$this->session->set_userdata('captcha_result', array('captcha_result_value' => $result,));
		$string = $numbers[1].' '.$arr_calculations[$calculations].' '.$numbers[2].' =';
		$font = 'template/captcha/fonts/Action Man Bold.ttf';
		$image = imagecreatetruecolor(95, 28);
		$color = imagecolorallocate($image, 0, 0, 0); // text color
		$white = imagecolorallocate($image, 255, 255, 255); // background color
		imagefilledrectangle($image, 0, 0, 399 ,99, $white);
		$srcimg = imagecreatefrompng('template/captcha/'.rand(1, 10).'.png');
		imagecopy($image, $srcimg, 0, 0, 0, 0, imagesx($srcimg), imagesy($srcimg));	
		imagettftext ($image, 20, 0, 5, 23, $color, $font, $string);// size, chéo, left, top
		header("Content-type: image/png");
		imagepng($image);
		ob_end_flush();
		imagedestroy($image);
	}

	public function _check_captcha($captcha = NULL){
		$captcha_result = $this->session->userdata('captcha_result');
		if(isset($captcha_result) && !empty($captcha_result)){
			if($captcha != $captcha_result['captcha_result_value']){
				$this->form_validation->set_message('_check_captcha', 'Mã Capcha không đúng.');
				return FALSE;
			}
		}
		else{
			$this->form_validation->set_message('_check_captcha', 'Mã Capcha không tồn tại.');
			return FALSE;
		}
		return TRUE;
	}

}