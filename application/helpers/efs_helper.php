<?php
	function setWIB() {
		date_default_timezone_set("Asia/Jakarta");
	}

	function is_logged_in() {
		$ci = get_instance();
		$ci->load->model(['m_auth', 'm_user', 'm_flashdata']);
		if(!$ci->session->userdata('username')) {
			redirect('auth');
		} else {
			$user = $ci->m_auth->get_session();
			$ci->session->is_active = $user['is_active'];
			if($user['is_active'] == 1) {
				$role_id = $user['role_id'];
				$menu = $ci->uri->segment(1);
				$queryMenu = $ci->m_user->get_user_menu($menu);
				$menu_id = $queryMenu['id'];
				$count_user_access = $ci->m_user->count_user_access_menu($role_id, $menu_id);
				if($count_user_access == 0) {
					redirect('auth/blocked');
				}
			} else {
				$ci->m_auth->unset_all_sessions();
				$ci->m_flashdata->set('warning', 'Akun anda dinonaktifkan oleh admin');
				redirect('auth');
			}
		}
	}

	function session_timeout() {
		$ci = get_instance();
		$ci->load->model(['m_auth', 'm_user', 'm_flashdata']);
		if($ci->session->userdata('id_user')) {
			$ci->m_user->set_active_time($ci->session->userdata('id_user'));
			if((time() - $ci->session->last_login_timestamp) > 3600) {
				$ci->m_auth->set_offline();
				$ci->m_auth->unset_all_sessions();
				$ci->m_flashdata->set('warning', 'Sesi anda telah berakhir.');
				redirect('auth');
			} else {
				$ci->session->last_login_timestamp = time();
			}
		}
	}

	function check_access($role_id, $menu_id) {
		$ci = get_instance();
		$ci->load->model(['m_user']);
		$count_user_access = $ci->m_user->count_user_access_menu($role_id, $menu_id);
		if($count_user_access > 0) {
			return "checked";
		}
	}

	function clr_activation ($id, $is_active) {
		$ci = get_instance();
		$ci->load->model(['m_user']);
		$result = $ci->m_user->get($id);
		if($result['is_active'] == 1) {
			return "btn-success";
		} else {
			return "btn-secondary";
		}
	}

	function icon_activation ($id, $is_active) {
		$ci = get_instance();
		$ci->load->model(['m_user']);
		$result = $ci->m_user->get($id);
		if($result['is_active'] == 1) {
			return 'Account is activated <i class="fas fa-check-circle"></i>';
		} else {
			return 'Account is not activated <i class="fas fa-minus-circle"></i>';
		}
	}

	function click_notification() {
		$ci = get_instance();
		if ($ci->session->userdata('role_id') == 1) {
			$ci->load->model(['m_notif']);
			$notif_id = $ci->input->get('notif_id');
			$ci->m_notif->click($notif_id);
		}
	}

?>