<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(['m_efs','m_auth', 'm_notif', 'm_flashdata', 'm_user']);
		setWIB();
		is_logged_in();
		session_timeout();
		click_notification();
	}

	public function index() {
		$data['title'] = 'My Profile';
		$data['profile'] = $this->m_auth->get_session();
		
		//notifikasi 
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();

		$data['count_divisi'] = $this->m_efs->count_efs_divisi($data['profile']['divisi']);
		$data['count_user'] = $this->m_efs->count_efs_user($data['profile']['id']);

		$this->load->view('templates/v_user_header', $data);
		$this->load->view('templates/v_user_sidebar', $data);
		$this->load->view('templates/v_user_topbar', $data);
		$this->load->view('profile/v_user_profile', $data);
		$this->load->view('templates/v_user_footer');
	}

	public function edit() {
		$data['title'] = 'Edit Profile';
		$data['profile'] = $this->m_auth->get_session();
		//notifikasi 
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();
		//semua user
		$alluser = $this->m_user->get_all();
		$this->form_validation->set_rules('name', 'Full name', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[3]',[
			'min_length' => 'Username terlalu pendek!'
		]);
		if($this->form_validation->run() == false) {
			$this->load->view('templates/v_user_header', $data);
			$this->load->view('templates/v_user_sidebar', $data);
			$this->load->view('templates/v_user_topbar', $data);
			$this->load->view('profile/v_user_edit_profile', $data);
			$this->load->view('templates/v_user_footer');
		} else {
			$name = $this->input->post('name');
			$username = $this->input->post('username');
			$foto_nama = $_FILES['foto']['name'];
			$foto_file = $_FILES['foto'];
			$config['upload_path'] = './assets/uploads/foto_profil/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']  = '200000';
			$config['file_name'] = $foto_nama;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('foto')) {
				if($foto_nama != '') {
					$this->m_user->update_photo($data['profile']['id'], $foto_nama);
				}
			} else {
				if($foto_nama != '') {
					$this->m_flashdata->set('danger', 'Format file tidak sesuai! Gagal mengubah data profil.');
					redirect('profile/edit');
				}
			}
			if($username != $data['profile']['username']) {
				foreach ($alluser as $au) {
					if($username == $au['username']) {
						$this->m_flashdata->set('danger', 'Username ini telah terdaftar di sistem! ('.$username.')');
						redirect('profile/edit');
					}
				}
			}
			$this->m_user->update_un($data['profile']['id'], $username, $name);
			$this->m_flashdata->set('success', 'Profil Anda telah berhasil diubah!');
			$this->m_auth->set_session($username, $data['profile']['role_id'], $data['profile']['is_active'], $data['profile']['divisi'], $data['profile']['id']);
			redirect('profile');
		}	
	}

	public function resetphoto($id_user) {
		$profile = $this->m_auth->get_session();
		if($profile['id'] == $id_user) {
			$this->m_user->set_ava($id_user, 'logo.jpg');
			$this->m_flashdata->set('success', 'Foto profilmu telah berhasil disetel ulang!');
			redirect('profile');
		} else {
			redirect('auth/blocked');
		}
		
	}	

	public function changePassword() {
		$data['title'] = 'Change Password';
		$data['profile'] = $this->m_auth->get_session();

		//notifikasi
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();
		
		$this->form_validation->set_rules('current_password', 'Current Passsword', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Passsword', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Passsword', 'required|trim|min_length[3]|matches[new_password1]');
		if($this->form_validation->run() == false) {
			$this->load->view('templates/v_user_header', $data);
			$this->load->view('templates/v_user_sidebar', $data);
			$this->load->view('templates/v_user_topbar', $data);
			$this->load->view('profile/v_user_change_password', $data);
			$this->load->view('templates/v_user_footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if(!password_verify($current_password, $data['profile']['password'])) {
				$this->m_flashdata->set('danger', 'Password lama salah!');
				redirect('profile/changepassword');
			} else {
				if($current_password == $new_password) {
					$this->m_flashdata->set('danger', 'Password baru tidak boleh sama dengan password lama!');
					redirect('profile/changepassword');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
					$this->db->set('password', $password_hash);
					$this->db->where('username', $this->session->userdata('username'));
					$this->db->update('tbl_user');
					$this->m_flashdata->set('success', 'Password telah berhasil diubah');
					redirect('profile/changepassword');
				}
			}
		}
	}
}
?>
