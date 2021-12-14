<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function add($data) {
		$this->db->insert('tbl_user', $data);
	}

	public function get($id) {
		return $this->db->get_where('tbl_user', ['id' => $id])->row_array();
	}

	public function delete($id) {
		$this->db->delete('tbl_user', ['id' => $id]);
	}

	public function get_u($username) {
		return $this->db->get_where('tbl_user', ['username' => $username])->row_array();
	}

	public function get_ud($username, $divisi) {
		$data = [
			'username' => $username,
			'divisi' => $divisi
		];
		return $this->db->get_where('tbl_user', $data)->row_array();
	}

	public function get_all() {
		return $this->db->get('tbl_user')->result_array();
	}

	public function count_all() {
	    return $this->db->get('tbl_user')->num_rows();
	}

	public function get_divisi() {
		$this->db->order_by('divisi', 'ASC');
		return $this->db->get('tbl_divisi')->result_array();
	}

	public function groupby_tahun() {
		$this->db->select('DATE_FORMAT(FROM_UNIXTIME(date_created),"%Y") AS tahun');
	    $this->db->select('count(id) AS num');
	    $this->db->group_by('DATE_FORMAT(FROM_UNIXTIME(date_created),"%Y")');
	    return $this->db->get('tbl_user')->result_array();
	}

	public function get_role($role_id) {
		return $this->db->get_where('user_role',['id' => $role_id])->row_array();
	}

	public function get_all_role() {
		return $this->db->get('user_role')->result_array();
	}

	public function get_all_user_menu() {
		$this->db->where('id !=', 1);
		return $this->db->get('user_menu')->result_array(); 
	}

	public function get_user_menu($menu) {
		return $this->db->get_where('user_menu', ['menu' => $menu])->row_array();
	}

	public function count_user_access_menu($role_id, $menu_id) {
		return $this->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id])->num_rows();
	}

	public function set_active_status() {
		$alluser = $this->db->get('tbl_user')->result_array();
		foreach ($alluser as $au) {
			$active_info = 'Online Now';
	    	if($au['online_status'] == 0) {
	    		$dif = time() - $au['active_time'];
	    		if($dif == time()) {
	    			$active_info = 'Never Online';
	    		} else if($dif < 60) {
	    			$active_info = 'Online '.$dif.' second(s) ago';
	    		} else if($dif >= 60 && $dif < 3600) {
	    			$dif = ($dif - $dif%60)/60;
	    			$active_info = 'Online '.$dif.' minute(s) ago';
	    		} else if($dif >= 3600 && $dif < 86400) {
	    			$dif = ($dif - $dif%3600)/3600;
	    			$active_info = 'Online '.$dif.' hour(s) ago';
	    		} else if($dif >= 86400 && $dif < 604800){
	    			$dif = ($dif - $dif%86400)/86400;
	    			$active_info = 'Online '.$dif.' day(s) ago';
	    		} else if($dif >= 604800 && $dif < 2592000){
	    			$dif = ($dif - $dif%604800)/604800;
	    			$active_info = 'Online '.$dif.' week(s) ago';
	    		} else if($dif >= 2592000 && $dif < 31536000){
	    			$dif = ($dif - $dif%2592000)/2592000;
	    			$active_info = 'Online '.$dif.' month(s) ago';
	    		} else {
	    			$dif = ($dif - $dif%31536000)/31536000;
	    			$active_info = 'Online '.$dif.' year(s) ago';
	    		}
	    	}
	    	if($active_info == 'Online Now') {
	    		$active_info = ' <i class="fas fa-circle text-success"></i> ('.$active_info.')';
	    	} else {
	    		$active_info = ' <i class="fas fa-circle text-danger"></i> ('.$active_info.')';
	    	}
	    	$this->db->set('active_status', $active_info);
	    	$this->db->where('id', $au['id']);
	    	$this->db->update('tbl_user');
		}
	}

	public function show_user() {
		$search = null;
		$filter = 'all';
		if(isset($_GET['search'])) {
			if($_GET['search'] == '') {
				$search = null;
			} else {
				$search = strval($_GET['search']);
			}	
		}
		if(isset($_GET['filter'])) {
			$filter = strval($_GET['filter']);
		}
		if(isset($search)) {
			if($filter == 'all') {
				$this->db->where('(name LIKE "%'.$search.'%"');
				$this->db->or_where('username LIKE "%'.$search.'%"');
				$this->db->or_where('divisi LIKE "%'.$search.'%")');
			} else if ($filter == 'name') {
				$this->db->where('(name LIKE "%'.$search.'%")');
			} else if ($filter == 'username') {
				$this->db->where('(username LIKE "%'.$search.'%")');
			} else if ($filter == 'divisi') {
				$this->db->where('(divisi LIKE "%'.$search.'%")');
			} else if ($filter == 'active') {
				$this->db->where('(name LIKE "%'.$search.'%" OR username LIKE "%'.$search.'%" OR divisi LIKE "%'.$search.'%") AND is_active=1');
			} else if ($filter == 'nonactive') {
				$this->db->where('(name LIKE "%'.$search.'%" OR username LIKE "%'.$search.'%" OR divisi LIKE "%'.$search.'%") AND is_active=0');
			} else if ($filter == 'online') {
				$this->db->where('(name LIKE "%'.$search.'%" OR username LIKE "%'.$search.'%" OR divisi LIKE "%'.$search.'%") AND online_status=1');
			} else if ($filter == 'offline') {
				$this->db->where('(name LIKE "%'.$search.'%" OR username LIKE "%'.$search.'%" OR divisi LIKE "%'.$search.'%") AND online_status=0');
			}
		} else {
			if ($filter == 'active') {
				$this->db->where('is_active', 1);
			} else if ($filter == 'nonactive') {
				$this->db->where('is_active', 0);
			} else if ($filter == 'online') {
				$this->db->where('online_status', 1);
			} else if ($filter == 'offline') {
				$this->db->where('online_status', 0);
			}
		}
		$orderby = "name";
		$sort = "ASC";
		if(isset($_GET['orderby'])) {
			$orderby = strval($_GET['orderby']);
		}
		if(isset($_GET['sort'])) {
			$sort = strval($_GET['sort']);
		}
		$orderby = $orderby.' '.$sort;
		$this->db->order_by($orderby);
		return $this->db->get_where('tbl_user', ['role_id !=' => 1])->result_array();
	}

	public function set_ava($id_user, $photo) {
		$this->db->set('foto', $photo);
		$this->db->where('id', $id_user);
		$this->db->update('tbl_user');
	}

	public function set_activation($num, $id_user) {
		$this->db->set('is_active', $num);
		$this->db->where('id', $id_user);
		$this->db->update('tbl_user');
	}

	public function count_nonactive() {
		$nonactive = $this->db->get_where('tbl_user', ['is_active' => 0]);
		return $nonactive->num_rows();
	}

	public function get_access_menu($data) {
		return $this->db->get_where('user_access_menu', $data);
	}

	public function add_access_menu($data) {
		$this->db->insert('user_access_menu', $data); 
	}

	public function delete_access_menu($data) {
		$this->db->delete('user_access_menu', $data);	
	}

	public function update_und($id_user, $username, $name, $divisi) {
		$this->db->set('username', $username);
		$this->db->set('name', $name);
		$this->db->set('divisi', $divisi);
		$this->db->where('id', $id_user);
		$this->db->update('tbl_user');
	}

	public function update_un($id_user, $username, $name) {
		$this->db->set('username', $username);
		$this->db->set('name', $name);
		$this->db->where('id', $id_user);
		$this->db->update('tbl_user');
	}

	public function update_password($id_user, $password) {
		$this->db->set('password', password_hash($password, PASSWORD_DEFAULT));
		$this->db->where('id', $id_user);
		$this->db->update('tbl_user');
	}

	public function update_photo($id_user, $photo) {
		$photo = str_replace(' ', '_', $photo);
		$this->db->set('foto', $photo);
		$this->db->where('id', $id_user);
		$this->db->update('tbl_user');
	}

	public function set_active_time($id_user) {
		$this->db->set('active_time', time());
		$this->db->where('username', $id_user);
		$this->db->update('tbl_user');
	}
}

?>