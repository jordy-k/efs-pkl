<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_efs extends CI_Model {
	public function groupby_tahun() {
	    $this->db->select('year(tgl_arsip) AS tahun');
	    $this->db->select('count(id_arsip) AS num');
	    $this->db->group_by('year(tgl_arsip)');
	    return $this->db->get('tbl_arsip_masuk')->result_array();
	}

	public function count_efs_user($id_user) {
		return $this->db->get_where('tbl_arsip_masuk', ['id_user' => $id_user])->num_rows();
	}

	public function count_efs_divisi($divisi) {
		return $this->db->get_where('tbl_arsip_masuk', ['divisi' => $divisi])->num_rows();
	}

	public function count_all() {
	    return $this->db->get('tbl_arsip_masuk')->num_rows();
	}

	public function get_all() {
		return $this->db->get('tbl_arsip_masuk')->result_array();
	}

	public function get_lokasi() {
		$this->db->order_by('lokasi', 'ASC');
		return $this->db->get('tbl_lokasi_penyimpanan')->result_array();
	}

	public function add_lokasi($lokasi) {
		$this->db->insert('tbl_lokasi_penyimpanan', ['lokasi' => $lokasi]);
	}

	public function delete_lokasi($lokasi) {
		$this->db->delete('tbl_lokasi_penyimpanan', ['lokasi' => $lokasi]);
	}

	public function get_nama_arsip() {
		$this->db->order_by('nama_arsip', 'ASC');
		return $this->db->get('tbl_nama_arsip')->result_array();;
	}

	public function add_nama_arsip($nama_arsip) {
		$this->db->insert('tbl_nama_arsip', ['nama_arsip' => $nama_arsip]);
	}

	public function delete_nama_arsip($nama_arsip) {
		$this->db->delete('tbl_nama_arsip', ['nama_arsip' => $nama_arsip]);
	}

	public function add($data) {
		$this->db->insert('tbl_arsip_masuk', $data);
	}

	public function encrypt_file($no_berkas) {
		return md5($no_berkas);
	}

	public function get($id_arsip) {
		return $this->db->get_where('tbl_arsip_masuk', ['id_arsip' => $id_arsip])->row_array();
	}

	public function edit($no_berkas) {
		$id_arsip = $this->input->post('id_arsip');
		$keterangan = $this->input->post('keterangan');
		$no_arsip = $this->input->post('no_arsip');
		$lokasi_penyimpanan = $this->input->post('lokasi_penyimpanan');
		$nama_arsip = $this->input->post('nama_arsip');
		$tgl_arsip = $this->input->post('tgl_arsip');
		$this->db->set('no_berkas', $no_berkas);
		$this->db->set('keterangan', $keterangan);
		$this->db->set('no_arsip', $no_arsip);
		$this->db->set('lokasi_penyimpanan', $lokasi_penyimpanan);
		$this->db->set('nama_arsip', $nama_arsip);
		$this->db->set('tgl_arsip', $tgl_arsip);
		$this->db->where('id_arsip', $id_arsip);
		$this->db->update('tbl_arsip_masuk');
	}

	public function delete($id_arsip) {
		$this->db->delete('tbl_arsip_masuk', ['id_arsip' => $id_arsip]);
	}

	public function add_zip_temp($data) {
		$this->db->insert('tmp_arsip_zip', $data);
	}

	public function get_zip_temp() {
		return $this->db->get('tmp_arsip_zip')->result_array();
	}

	public function count_zip_temp() {
		return $this->db->get('tmp_arsip_zip')->num_rows();
	}

	public function clear_zip_temp() {
		$this->db->empty_table('tmp_arsip_zip');
	}
}

?>