<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datatables extends CI_Model {
	public function show_efs_admin() {
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
		        tgl_arsip like'%".$searchValue."%' or
		        keterangan like'%".$searchValue."%' or
		        divisi like'%".$searchValue."%'
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
			$result = explode('-', $row['tgl_arsip']);
			$date = $result[2];
			$month = $result[1];
			$year = $result[0];
			$tgl_arsip = $date.'-'.$month.'-'.$year;
		    $data[] = array(
		    		"id_arsip" => '<div class="text-center">'.$row['id_arsip'].'</div>',
		    		"no_berkas" => '<div class="text-center">'.$row['no_berkas'].'</div>',
		    		"keterangan" => '<div class="text-center">'.$row['keterangan'].'</div>',
		    		"lokasi_penyimpanan" => '<div class="text-center">'.$row['lokasi_penyimpanan'].'</div>',
		    		"no_arsip" => '<div class="text-center">'.$row['no_arsip'].'</div>',
		    		"nama_arsip" => '<div class="text-center">'.$row['nama_arsip'].'</div>',
		    		"tgl_arsip" => '<div class="text-center">'.$tgl_arsip.'</div>',
		    		"divisi" => '<div class="text-center">'.$row['divisi'].'</div>',
		    		"download" => '<div class="text-center"><a href="'.base_url('employee/download/').$row['id_arsip'].'" target="_blank"><button type="button" class="btn btn-success"><i class="fas fa-download"></i></button></a></div>',
		    		"edit" => '<div class="text-center"><a href="" data-toggle="modal" data-target="#editModal" onclick="showedit_efs('.$row['id_arsip'].')"><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button></a></div>',
		    		"delete" => '<div class="text-center"><a data-toggle="modal" data-target="#deleteModal" onclick="showdelete_efs('.$row['id_arsip'].')"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></a></div>'
		    	);
		}
		## Response
		$response = array(
		    "draw" => @$_POST['draw'],
		    "recordsTotal" => $totalRecords,
		    "recordsFiltered" => $totalRecordwithFilter,
		    "data" => $data,
		);
		return $response;
	}

	public function show_efs_employee() {
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
		        tgl_arsip like'%".$searchValue."%' or
		        keterangan like'%".$searchValue."%' or
		        divisi like'%".$searchValue."%'
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
			$result = explode('-', $row['tgl_arsip']);
			$date = $result[2];
			$month = $result[1];
			$year = $result[0];
			$tgl_arsip = $date.'-'.$month.'-'.$year;
		    $data[] = array(
		    		"id_arsip" => '<div class="text-center">'.$row['id_arsip'].'</div>',
		    		"no_berkas" => '<div class="text-center">'.$row['no_berkas'].'</div>',
		    		"keterangan" => '<div class="text-center">'.$row['keterangan'].'</div>',
		    		"lokasi_penyimpanan" => '<div class="text-center">'.$row['lokasi_penyimpanan'].'</div>',
		    		"no_arsip" => '<div class="text-center">'.$row['no_arsip'].'</div>',
		    		"nama_arsip" => '<div class="text-center">'.$row['nama_arsip'].'</div>',
		    		"tgl_arsip" => '<div class="text-center">'.$tgl_arsip.'</div>',
		    		"divisi" => '<div class="text-center">'.$row['divisi'].'</div>',
		    		"download" => '<div class="text-center"><a href="'.base_url('employee/download/').$row['id_arsip'].'" target="_blank"><button type="button" class="btn btn-success"><i class="fas fa-download"></i></button></a></div>',
		    		"edit" => '<div class="text-center"><a href="" data-toggle="modal" data-target="#editModal" onclick="showedit_efs('.$row['id_arsip'].')"><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button></a></div>'
		    	);
		}

		## Response
		$response = array(
		    "draw" => @$_POST['draw'],
		    "recordsTotal" => $totalRecords,
		    "recordsFiltered" => $totalRecordwithFilter,
		    "data" => $data,
		);
		return $response;
	}
}
?>