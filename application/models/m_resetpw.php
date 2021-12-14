<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_resetpw extends CI_Model {
	public function turnoff_link($str) {
		$this->db->set('is_clicked', 1);
		$this->db->where('link', $str);
		$this->db->update('tbl_reset');
	}

	public function randomStr() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 10; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	} 

	public function get($id_user) {
		return $this->db->get_where('tbl_reset', ['id_user' => $id_user])->row_array();
	}

	public function getv2($str) {
		$query = "
            SELECT tr.id_user, tr.date_created, tr.is_clicked, tu.username, tr.role_id
            FROM `tbl_reset` tr JOIN `tbl_user` tu 
            ON tr.`id_user` = tu.`id` 
            WHERE tr.`link` = '$str'
         ";
		return $this->db->query($query)->row_array();
	}

	public function add($data) {
		$this->db->insert('tbl_reset', $data);
	}

	public function update_ld($id_user, $str) {
		$this->db->set('link', $str);
		$this->db->set('date_created', time());
		$this->db->set('is_clicked', 0);
		$this->db->where('id_user', $id_user);
		$this->db->update('tbl_reset');
	}
}

?>