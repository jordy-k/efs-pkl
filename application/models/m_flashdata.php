<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_flashdata extends CI_Model {
	public function set($color, $description) {
		if($color == 'success') {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">'.$description.' <i class="fas fa-check-circle"></i></div>');
		} else if($color == 'warning') {
			$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">'.$description.' <i class="fas fa-exclamation-triangle"></i></div>');
		} else if ($color == 'danger') {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$description.' <i class="fas fa-exclamation-circle"></i></div>');
		}
		
	}

	public function set_custom($var, $value) {
		$this->session->set_flashdata($var, $value);
	}
}
?>