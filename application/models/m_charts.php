<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_charts extends CI_Model {
	public function show_user_divisi() {
	    $this->db->select('divisi');
	    $this->db->select('count(id) AS num');
	    $this->db->group_by('divisi');
	    return $this->db->get('tbl_user')->result_array();
	}

	public function show_user_activation() {
	    $this->db->select('is_active');
	    $this->db->select('count(id) AS num');
	    $this->db->group_by('is_active');
	    return $this->db->get('tbl_user')->result_array();
	}

	public function show_efs_divisi() {
		$this->db->select('divisi');
	    $this->db->select('count(id_arsip) AS num');
	    $this->db->group_by('divisi');
	    return $this->db->get('tbl_arsip_masuk')->result_array();
	}

	public function show_efs_tahun() {
		$this->db->select('DATE_FORMAT(tgl_arsip, "%Y-%m") AS tahun');
	    $this->db->select('count(id_arsip) AS num');
	    $this->db->group_by('DATE_FORMAT(tgl_arsip, "%Y-%m")');
	    return $this->db->get('tbl_arsip_masuk')->result_array();
	}
}

?>