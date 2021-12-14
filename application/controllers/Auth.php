<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		setWIB();
		$this->load->model(['m_auth', 'm_notif', 'm_flashdata', 'm_user', 'm_resetpw']);
	}

	public function goToDefaultPage() {
		if($this->session->userdata('role_id')) {
			if ($this->session->userdata('role_id') == 1) {
		   		redirect('admin');
		  	} else if ($this->session->userdata('role_id') == 2) {
		    	redirect('employee');
		  	}
		} 
	}
	
	public function index() {
		$this->goToDefaultPage();
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'EFS Kisel Login';
			$this->load->view('templates/v_auth_header', $data);
			$this->load->view('auth/v_user_login');
			$this->load->view('templates/v_auth_footer');
		} else {
			//validasi sukses
			$this->login();
		}
	}

	private function login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$profile = $this->m_user->get_u($username);

		if($profile) {
			//profile ada
			if($profile['is_active'] == 1) {
				//profile aktif
				if(password_verify($password, $profile['password'])) {
					//password benar
					$this->m_auth->set_session($profile['username'], $profile['role_id'], $profile['is_active'], $profile['divisi'], $profile['id']);
					$this->m_auth->set_online();
					if($profile['role_id'] == 1) {
						$count_nonactive = $this->m_user->count_nonactive();
						$notif = $this->m_notif->count_type('Activation');
						//cek notifikasi user yang akunnya belum teraktivasi
						if($count_nonactive > 0) {
							if($notif > 0) {
								$this->m_notif->update_time('Activation');
							} else {
								$data = [
									'type' => 'Activation',
									'description' => 'Ada '.$count_nonactive.' akun yang tidak aktif.',
									'link' => 'admin/manage',
									'icon' => 'fas fa-user-check text-primary',
									'date_notified' => time(),
									'is_clicked' => 0
								];
								$this->m_notif->add($data);
							}
							
						}
						redirect('admin');
					} else {
						redirect('employee');
					}
				} else {
					$this->m_flashdata->set('danger', 'Password salah!');
					redirect('auth');
				}
			} else {
				$this->m_flashdata->set('danger', 'Akun anda belum diaktifkan!');
				redirect('auth');
			}
		} else {
			$this->m_flashdata->set('danger', 'Username ini tidak terdaftar di sistem!');
			redirect('auth');
		}
	}

	public function registration() {
		$this->goToDefaultPage();
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|is_unique[tbl_user.username]', 
		[
			'is_unique' => 'Username ini telah terdaftar di sistem!',
			'min_length' => 'Username terlalu pendek!'
		]);
		$this->form_validation->set_rules('divisi', 'Divisi', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', 
		[
			'matches' => 'Password tidak cocok!',
			'min_length' => 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'EFS Kisel Registration';
			$data['divisi'] = $this->m_user->get_divisi();
			$this->load->view('templates/v_auth_header', $data);
			$this->load->view('auth/v_employee_registration');
			$this->load->view('templates/v_auth_footer');
		} else {
			$data1 = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'divisi' => htmlspecialchars($this->input->post('divisi', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'foto' => 'logo.jpg',
				'date_created' => time()
			];
			$this->m_user->add($data1);
			$this->m_flashdata->set('success', 'Selamat! Akun anda telah berhasil dibuat. Silahkan minta admin untuk mengaktifkannya!');
			$username = $this->input->post('username');
			$data2 = [
				'type' => 'Registration',
				'description' => $username.' telah berhasil membuat akunnya. Silahkan aktifkan akunnya segera!',
				'link' => 'admin/manage?search='.$username.'&filter=username',
				'icon' => 'fas fa-exclamation-triangle text-warning',
				'date_notified' => time(),
				'is_clicked' => 0
			];
			$this->m_notif->add($data2);
			redirect('auth');
		}
	} 

	public function logout() {
		$this->m_auth->set_offline();
		$this->m_auth->unset_all_sessions();
		$this->m_flashdata->set('warning', 'Anda telah berhasil logout!');
		redirect('auth');
	}

	public function blocked() {
		$this->load->view('auth/v_user_blocked');
	}

	public function reset($str) {
		$status = $this->m_resetpw->getv2($str);
		if($status == '') {
			$data1['title'] = 'URL Not Found';
				$this->load->view('templates/v_auth_header', $data1);
				$this->load->view('auth/v_link_not_found');
				$this->load->view('templates/v_auth_footer');
		} else {
			if($status['is_clicked'] == 1) {
				$data1['title'] = 'URL Expired';
				$this->load->view('templates/v_auth_header', $data1);
				$this->load->view('auth/v_link_expired');
				$this->load->view('templates/v_auth_footer');
			} else {
				if(time() - $status['date_created'] > 180) {
					$data1['title'] = 'URL Expired';
					$this->load->view('templates/v_auth_header', $data1);
					$this->load->view('auth/v_link_expired');
					$this->load->view('templates/v_auth_footer');

				} else {
					$this->form_validation->set_rules('username', 'Username', 'trim');
					$this->form_validation->set_rules('divisi', 'Divisi', 'trim');
					$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', 
					[
						'matches' => 'Password tidak cocok!',
						'min_length' => 'Password terlalu pendek!'
					]);
					$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
					if ($this->form_validation->run() == false) {
						$data1['title'] = 'Account Recovery';
						$data1['str'] = $str;
						//user
						$data1['user'] = $this->m_user->get($status['id_user']);
						$this->load->view('templates/v_auth_header', $data1);
						$this->load->view('auth/v_user_reset_password');
						$this->load->view('templates/v_auth_footer');
					} else {
						$this->m_resetpw->turnoff_link($str);
						$password = $this->input->post('password1');
						$this->m_user->update_password($status['id_user'], $password);
						$this->m_flashdata->set('success', 'Selamat! Akun telah berhasil dipulihkan! (Username : '.$status['username'].')');
						$username = $this->input->post('username');
						$data2 = [
							'type' => 'Update Password',
							'description' => $username.' telah berhasil mengubah password.',
							'link' => 'admin/manage?search='.$username.'&filter=username',
							'icon' => 'fas fa-unlock-alt text-success',
							'date_notified' => time(),
							'is_clicked' => 0
						];
						$this->m_notif->add($data2);
						if($this->session->userdata('role_id') == 1) {
							if($status['role_id'] == 1) {
								$this->m_notif->update_link($username.' telah berhasil mengubah password.', 'profile');
							}
							redirect('admin');
						} else if($this->session->userdata('role_id') == 2) {
							redirect('employee');
						} else {
							redirect('auth');
						}
					}
				}
			}
		}
	}

	public function forgot_password() {
		$this->form_validation->set_rules('username', 'Username', 'trim');
		$this->form_validation->set_rules('divisi', 'Divisi', 'trim');
		if ($this->form_validation->run() == false) {
			$data1['title'] = 'Forgot Password?';
			$data1['divisi'] = $this->m_user->get_divisi();
			$this->load->view('templates/v_auth_header', $data1);
			$this->load->view('auth/v_employee_forgot_password');
			$this->load->view('templates/v_auth_footer');
		} else {
			$username = $this->input->post('username');
			$divisi = $this->input->post('divisi');
			$user =	$this->m_user->get_ud($username, $divisi);
			if(sizeof($user) == 0) {
				$this->m_flashdata->set('danger', 'Data tidak ditemukan');
				redirect('auth/forgot_password');
			} else {
				$data3 = [
					'type' => 'Request Reset Password',
					'description' => $username.' memintamu untuk menyetel ulang passowordnya. Silahkan berikan tautannya segera!',
					'link' => 'admin/resetpassword/'.$user['id'],
					'icon' => 'fas fa-unlock-alt text-warning',
					'date_notified' => time(),
					'is_clicked' => 0
				];
				$this->m_notif->add($data3);
				$this->m_flashdata->set('warning', 'Silahkan tunggu sampai admin memberikan tautan pemulihan akun');
				if($this->session->userdata('role_id') == 1) {
					redirect('admin');
				} else if($this->session->userdata('role_id') == 2) {
					redirect('employee');
				} else {
					redirect('auth');
				}
			}
		}
	}
}
?>