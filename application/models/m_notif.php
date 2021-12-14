<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_notif extends CI_Model {
	public function add($data) {
		$this->db->insert('tbl_notification', $data);
		
		$this->db->select('MAX(id) AS last_id');
		$last_id = $this->db->get('tbl_notification')->row_array();
		$current_id = $last_id['last_id'];
		if (strpos($data['link'], '?') !== false) {
		    $data['link'] = $data['link'].'&notif_id='.$current_id;
		} else {
			$data['link'] = $data['link'].'?notif_id='.$current_id;
		}
		$this->db->set('link', $data['link']);
		$this->db->where('id', $current_id);
		$this->db->update('tbl_notification');
	}

	public function get() {
		$this->db->order_by('date_notified', 'DESC');
		return $this->db->get('tbl_notification')->result_array();
	}

	public function count_unread() {
		return $this->db->get_where('tbl_notification',['is_clicked' => 0])->num_rows();
	}

	public function update($type, $description) {
		$this->db->set('description', $description);
		$this->db->where('type', $type);
		$this->db->update('tbl_notification');
	}

	public function update_time($type) {
		$this->db->set('date_notified', time());
		$this->db->set('is_clicked', 0);
		$this->db->where('type', $type);
		$this->db->update('tbl_notification');
	}

	public function update_link($description, $link) {
		$this->db->select('MAX(id) AS last_id');
		$last_id = $this->db->get('tbl_notification')->row_array();
		$current_id = $last_id['last_id'];
		if (strpos($link, '?') !== false) {
		    $link = $link.'&notif_id='.$current_id;
		} else {
			$link = $link.'?notif_id='.$current_id;
		}
		$this->db->set('link', $link);
		$this->db->where('description', $description);
		$this->db->update('tbl_notification');
	}

	public function click($id) {
		$this->db->set('is_clicked', 1);
		$this->db->where('id', $id);
		$this->db->update('tbl_notification');
	}

	public function clear() {
		$this->db->empty_table('tbl_notification');
	}

	public function count_type($type) {
		return $this->db->get_where('tbl_notification', ['type' => $type])->num_rows();
	}

	public function get_menu() {
		return $this->db->query("SELECT COUNT(id) AS ct FROM user_access_menu WHERE id IN
			
		(SELECT id FROM user_access_menu WHERE menu_id IS NOT NULL)
		GROUP BY menu_id")->num_rows();
	}
}

?>