<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {

	public function __construct() {
		parent::__construct();
		setWIB();
	}

	public function index() {
		$this->load->view('test/example_1');
	}

	public function two() {
		$this->load->view('test/example_2');
	}

	public function three() {
		$this->load->view('test/example_3');
	}

	public function four() {
		$this->load->view('test/example_4');
	}

	public function five($id) {
		$data['id_ars'] = $id;
		$this->load->view('test/data1', $data);
	}

	public function proses_upload() {
		echo '<pre>';
		print_r($_FILES['file_zip']);
		echo '</pre>';
		$file_name = $_FILES['file_zip']['name'];
		$file_zip = $_FILES['file_zip'];
		if($file_zip == '') {
			echo 'Upload gagal';
		} else {
			$config['upload_path'] = './assets/uploads/zip_file/';
			$config['allowed_types'] = 'zip|rar';
			$config['max_size'] = '200000';
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			if($this->upload->do_upload('file_zip')) {
				sleep(5);
				$this->session->set_flashdata('message', 'upload berhasil');
				redirect('example/three');	
			} else {
				echo $this->upload->display_errors();
			}
		}

	}

	public function proses_extract() {
		// $arr1 = [];
		// exec('cd C:\xampp 5.6\htdocs\praktikum\_efs_pkl_2\assets\uploads\zip_file && 7z l test.zip', $arr1);

		// echo '<pre>';
		// print_r($arr1);
		// echo '</pre>';

		// $n = sizeof($arr1);
		// $x = substr($arr1[27], 50, 10);
		// echo $n;
		// $arr2 = [];
		// for($i = 15; $i < $n - 2; $i++) {
		// 	$arr2[] = trim(substr($arr1[$i], 52, 50));  
		// }
		// echo '<pre>';
		// print_r($arr2);
		// echo '</pre>';

		echo pathinfo('test1.jpg', PATHINFO_EXTENSION).'<br />';
		echo pathinfo('test1.ehdhdb028287.jpg', PATHINFO_EXTENSION).'<br />';
		$explode = explode('.'.pathinfo('test1.jpg', PATHINFO_EXTENSION), 'test.sgadg.234.jpg');
		echo '<pre>';
		print_r($explode);
		echo '</pre>';
	}

	public function get_ajax() {
        ## Read value
		$draw = @$_POST['draw'];
		$row = @$_POST['start'];
		$rowperpage = @$_POST['length']; // Rows display per page
		$columnIndex = @$_POST['order'][0]['column']; // Column index
		$columnName = @$_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = @$_POST['order'][0]['dir']; // asc or desc
		$searchValue = @$_POST['search']['value']; // Search value

		## Search 
		$searchQuery = "";
		if($searchValue != ''){
			$searchQuery = " and (
				id_arsip like '%".$searchValue."%' or 
		        no_berkas like '%".$searchValue."%' or 
		        lokasi_penyimpanan like'%".$searchValue."%' or
		        no_arsip like'%".$searchValue."%' or
		        nama_arsip like'%".$searchValue."%' or
		        tgl_diterima like'%".$searchValue."%' or
		        keterangan like'%".$searchValue."%'
		    ) ";
		    ## Total number of records without filtering
			$this->db->select('count(*) as allcount');
			$records = $this->db->get('tbl_arsip_masuk')->result_array();
			$totalRecords = $records['0']['allcount'];

			## Total number of records with filtering
			$this->db->flush_cache();
			$this->db->select('count(*) as allcount');
			$this->db->where('1 '.$searchQuery);
			$records = $this->db->get('tbl_arsip_masuk')->result_array();
			$totalRecordwithFilter = $records['0']['allcount'];

			## Fetch records
			$this->db->flush_cache();
			$this->db->select('*');
			$this->db->where('1 '.$searchQuery);
			$this->db->order_by($columnName, $columnSortOrder);
			$this->db->limit($rowperpage, $row);
			$efsRecords = $this->db->get('tbl_arsip_masuk');
		} else {
			## Total number of records without filtering
			$this->db->select('count(*) as allcount');
			$records = $this->db->get('tbl_arsip_masuk')->result_array();
			$totalRecords = $records['0']['allcount'];

			## Total number of records with filtering
			$this->db->flush_cache();
			$this->db->select('count(*) as allcount');
			$records = $this->db->get('tbl_arsip_masuk')->result_array();
			$totalRecordwithFilter = $records['0']['allcount'];

			## Fetch records
			$this->db->flush_cache();
			$this->db->select('*');
			$this->db->order_by($columnName, $columnSortOrder);
			$this->db->limit($rowperpage, $row);
			$efsRecords = $this->db->get('tbl_arsip_masuk');
		}
		
		$data = array();
		foreach ($efsRecords->result_array() as $row) {
			$result = explode('-', $row['tgl_diterima']);
			$date = $result[2];
			$month = $result[1];
			$year = $result[0];
			$tgl_diterima = $date.'-'.$month.'-'.$year;
		    $data[] = array(
		    		"id_arsip" => $row['id_arsip'],
		    		"no_berkas" => $row['no_berkas'],
		    		"lokasi_penyimpanan" => $row['lokasi_penyimpanan'],
		    		"no_arsip" => $row['no_arsip'],
		    		"nama_arsip" => $row['nama_arsip'],
		    		"tgl_diterima" => $tgl_diterima,
		    		"keterangan" => $row['keterangan']
		    	);
		}

		## Response
		$response = array(
		    "draw" => @$_POST['draw'],
		    "recordsTotal" => $totalRecords,
		    "recordsFiltered" => $totalRecordwithFilter,
		    "data" => $data,
		);

		// echo '<pre>';
		// print_r($response);
		// echo '</pre>';
		echo json_encode($response);
	}
}
?>
