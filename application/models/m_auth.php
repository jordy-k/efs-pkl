<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function set_session($username, $roleid, $is_active, $divisi, $id) {
		$data = [
			'username' => $username,
			'role_id' => $roleid,
			'is_active' => $is_active,
			'divisi' => $divisi,
			'id_user' => $id,
			'last_login_timestamp' => time()
		];
		$this->session->set_userdata($data);
	}

	public function unset_all_sessions() {
		shell_exec('rmdir /s "'.APPPATH.'cache\session" /q');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('is_active');
		$this->session->unset_userdata('divisi');
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('last_login_timestamp');
	}

	public function get_session() {
		return $this->db->get_where('tbl_user', ['id' => $this->session->userdata('id_user')])->row_array();
	}

	// public function insert_user($data) {
	// 	$this->db->insert('tbl_user', $data);
	// }

	public function set_offline() {
		$this->db->set('online_status', 0);
		$this->db->where('id', $this->session->userdata('id_user'));
		$this->db->update('tbl_user');
	}

	public function set_online() {
		$this->db->set('online_status', 1);
		$this->db->where('id', $this->session->userdata('id_user'));
		$this->db->update('tbl_user');
	}
}

?>