<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_auth', 'm_notif', 'm_flashdata', 'm_efs', 'm_charts', 'm_datatables']);
		setWIB();
		is_logged_in();
		session_timeout();
	}

	public function index() {
		$data['title'] = 'Dashboard Employee';
		$data['profile'] = $this->m_auth->get_session();
		//notifikasi 
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();
		//data tahun
	    $data['tahun'] = $this->m_efs->groupby_tahun();
	    $data['total'] = $this->m_efs->count_all();
	    $data['usm'] = $this->m_notif->get_menu();
		$this->load->view('templates/v_user_header', $data);
		$this->load->view('templates/v_user_sidebar', $data);
		$this->load->view('templates/v_user_topbar', $data);
		$this->load->view('employee/v_employee_dashboard', $data);
		$this->load->view('templates/v_user_footer');
		$this->load->view('js/v_js_employee_charts');
	}

	public function get_employee_datatables() {
        $response = $this->m_datatables->show_efs_employee();
		echo json_encode($response);
	}

	public function manage() {
		$data['title'] = 'Manage EFS Data';
		$data['profile'] = $this->m_auth->get_session();
		//notifikasi 
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();
		//data tahun
	    $data['tahun'] = $this->m_efs->groupby_tahun();
	    $data['total'] = $this->m_efs->count_all();
	    //lokasi penyimpanan
		$data['lokasi'] = $this->m_efs->get_lokasi();
		//nama arsip
		$data['nama_arsip'] = $this->m_efs->get_nama_arsip();

		$this->load->view('templates/v_user_header', $data);
		$this->load->view('templates/v_user_sidebar', $data);
		$this->load->view('templates/v_user_topbar', $data);
		$this->load->view('employee/v_efs_manage', $data);
		$this->load->view('employee/v_efs_edit_modal', $data);
		if($data['profile']['role_id'] == 1) {
			$this->load->view('employee/v_efs_delete_modal', $data);
		}
		$this->load->view('templates/v_user_footer', $data);
		$this->load->view('js/v_js_efs_edit');
		if($data['profile']['role_id'] == 1) {
			$this->load->view('js/v_js_admin_datatables');
			$this->load->view('js/v_js_efs_delete');
		} else {
			$this->load->view('js/v_js_employee_datatables');	
		}
		
	}	

	public function add() {
		$data['title'] = 'Add EFS Data';
		$data['profile'] =  $this->m_auth->get_session();
		if($data['profile']['role_id'] == 2) {
			//lokasi penyimpanan
			$data['lokasi'] = $this->m_efs->get_lokasi();
			//nama arsip
			$data['nama_arsip'] = $this->m_efs->get_nama_arsip();

			$this->load->view('templates/v_user_header', $data);
			$this->load->view('templates/v_user_sidebar', $data);
			$this->load->view('templates/v_user_topbar', $data);
			$this->load->view('employee/v_efs_add', $data);
			$this->load->view('templates/v_user_footer', $data);
		} else {
			redirect('auth/blocked');
		}
	}

	public function proses_add() {
		//enkrip file
		$file_name = $_FILES['file_arsip']['name'];
		$explode_berkas = explode('.'.pathinfo($file_name, PATHINFO_EXTENSION), $file_name);
		$no_berkas = $explode_berkas[0];
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$enkrip_berkas = $this->m_efs->encrypt_file($no_berkas);
		//user
		$profile =  $this->m_auth->get_session();
		$id_user = $profile['id'];
		$divisi = $profile['divisi'];
		//all efs
		$efs_data = $this->m_efs->get_all();
		//input efs data
		$keterangan = $this->input->post('keterangan');
		$no_arsip = $this->input->post('no_arsip');
		$lokasi_penyimpanan = $this->input->post('lokasi_penyimpanan');
		$nama_arsip = $this->input->post('nama_arsip');
		$tgl_arsip = $this->input->post('tgl_arsip');
		//upload
		$config['upload_path'] = './assets/uploads/arsip_masuk/'.$divisi.'/';
		$config['allowed_types'] = 'pdf|jpg|png';
		$config['max_size']  = '200000';
		$config['file_name'] = $enkrip_berkas;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('file_arsip')) {
			$count = 0;
			foreach ($efs_data as $ed) {
				if($ed['no_berkas'] == $no_berkas) {
					$count++;
				}
			}
			if($count == 0) {
				$data = array(
					'id_user' => $id_user,
					'divisi' => $divisi,
					'no_berkas' => $no_berkas,
					'keterangan' => $keterangan,
					'no_arsip' => $no_arsip,
					'lokasi_penyimpanan' => $lokasi_penyimpanan,
					'nama_arsip' => $nama_arsip,
					'tgl_arsip' => $tgl_arsip,
					'file' => $enkrip_berkas.'.'.$ext
				);
				$this->m_efs->add($data);
				$this->m_flashdata->set('success', '1 Data EFS Sukses ditambahkan (No berkas : '.$no_berkas.')');
				redirect('employee/add');
			} else {
				$this->m_flashdata->set('danger', 'No Berkas tersebut sudah terdaftar dalam sistem!');
				redirect('employee/add');
			}	
		} else {
			$this->m_flashdata->set('danger', $this->upload->display_errors());
			redirect('employee/add');
		}
	}

	public function download($id_arsip) {
		$result = $this->m_efs->get($id_arsip);
		$file_name = $result['file'];
		$divisi = $result['divisi'];
		redirect('assets/uploads/arsip_masuk/'.$divisi.'/'.$file_name);
	}

	public function get_efs($id) {
	    $am = $this->m_efs->get($id);
	    echo json_encode($am);
	}

	public function edit() {
		$profile = $this->m_auth->get_session();
		$id_arsip = $this->input->post('id_arsip');
		$divisi = $this->input->post('divisi');
		if($profile['role_id'] == 1) {
			$no_berkas = $this->input->post('no_berkas');
			$this->m_efs->edit($no_berkas);
			$this->m_flashdata->set('success', '1 Data EFS berhasil diedit (No Berkas : '.$no_berkas.')');
			redirect('employee/manage');
		} else {
			if($divisi == $profile['divisi']) {
				$no_berkas = $this->input->post('no_berkas');
				$this->m_efs->edit($no_berkas);
				$this->m_flashdata->set('success', '1 Data EFS berhasil diedit (No Berkas : '.$no_berkas.')');
				redirect('employee/manage');
			} else {
				$this->m_flashdata->set('danger', 'Anda tidak diijinkan mengubah data EFS milik divisi lain');
				redirect('employee/manage');
			}
		}
	}

	public function delete($id_arsip) {
		$efs_data = $this->m_efs->get($id_arsip);
		$divisi = $efs_data['divisi'];
		$file = $efs_data['file'];
		$no_berkas = $efs_data['no_berkas'];
		shell_exec('cd '.substr($_SERVER['SCRIPT_FILENAME'],0,-10).'/assets/uploads/arsip_masuk/'.$divisi.' && del '.$file);
		$this->m_efs->delete($id_arsip);
		$this->m_flashdata->set('success', '1 Data EFS berhasil dihapus (No Berkas : '.$no_berkas.') ');
		redirect('employee/manage');
	}

	public function manage_lokasi() {
		$data['profile'] = $this->m_auth->get_session();
		if($data['profile']['role_id'] == 2) {
			$data['title'] = 'Kelola Lokasi Penyimpanan';
			//lokasi penyimpanan
			$data['lokasi'] = $this->m_efs->get_lokasi();

			$this->form_validation->set_rules('new_lokasi', 'Lokasi Penyimpanan yang baru', 'trim');
			$this->form_validation->set_rules('del_lokasi', 'Lokasi Penyimpanan yang dihapus', 'trim');
			if($this->form_validation->run() == false) {
				$this->load->view('templates/v_user_header', $data);
				$this->load->view('templates/v_user_sidebar', $data);
				$this->load->view('templates/v_user_topbar', $data);
				$this->load->view('employee/v_efs_manage_lokasi', $data);
				$this->load->view('templates/v_user_footer', $data);
				$this->load->view('js/v_js_force_closed');
				$this->load->view('js/v_js_efs_manage_atribut');
			} else {
				$del_lokasi = $this->input->post('del_lokasi');
				$new_lokasi = $this->input->post('new_lokasi');
				$force_closed = $this->input->post('force_closed');
				if($del_lokasi != '') {
					$this->m_efs->delete_lokasi($del_lokasi);
					$this->m_flashdata->set_custom('delete', '<div class="alert alert-success" role="alert">Lokasi "'.$del_lokasi.'" berhasil dihapus! <i class="fas fa-check-circle"></i></div>');
				}
				if($new_lokasi != '') {
					$all_lokasi = $this->m_efs->get_lokasi();
					$count = 0;
					foreach ($all_lokasi as $al) {
						if($al['lokasi'] == $new_lokasi) {
							$count++;
						}
					}
					if($count > 0) {
						$this->m_flashdata->set_custom('add', '<div class="alert alert-danger" role="alert">Lokasi "'.$new_lokasi.'" sudah ada! <i class="fas fa-exclamation-circle"></i></div>');
					} else {
						$this->m_efs->add_lokasi($new_lokasi);
						$this->m_flashdata->set_custom('add', '<div class="alert alert-success" role="alert">Lokasi baru berhasil ditambahkan ('.$new_lokasi.') <i class="fas fa-check-circle"></i></div>');
					}
				}
				if($force_closed == 1) {
					$this->m_flashdata->set_custom('force_closed', 1);
					redirect('employee/manage_lokasi?force_closed=on');
				} else {
					redirect('employee/manage_lokasi?force_closed=off');
				} 
			}
		} else {
			redirect('auth/blocked');
		}
	}

	public function manage_nama_arsip() {
		$data['profile'] = $this->m_auth->get_session();
		if($data['profile']['role_id'] == 2) {
			$data['title'] = 'Kelola Nama Arsip';
			//nama arsip
			$data['nama_arsip'] = $this->m_efs->get_nama_arsip();

			$this->form_validation->set_rules('new_nama_arsip', 'Nama Arsip yang baru', 'trim');
			$this->form_validation->set_rules('del_nama_arsip', 'Nama Arsip yang dihapus', 'trim');
			if($this->form_validation->run() == false) {
				$this->load->view('templates/v_user_header', $data);
				$this->load->view('templates/v_user_sidebar', $data);
				$this->load->view('templates/v_user_topbar', $data);
				$this->load->view('employee/v_efs_manage_nama_arsip', $data);
				$this->load->view('templates/v_user_footer', $data);
				$this->load->view('js/v_js_force_closed');
				$this->load->view('js/v_js_efs_manage_atribut');
			} else {
				$del_nama_arsip = $this->input->post('del_nama_arsip');
				$new_nama_arsip = $this->input->post('new_nama_arsip');
				$force_closed = $this->input->post('force_closed');
				if($del_nama_arsip != '') {
					$this->m_efs->delete_nama_arsip($del_nama_arsip);
					$this->m_flashdata->set_custom('delete', '<div class="alert alert-success" role="alert">Nama arsip "'.$del_nama_arsip.'" berhasil dihapus! <i class="fas fa-check-circle"></i></div>');
				}
				if($new_nama_arsip != '') {
					$all_nama_arsip = $this->m_efs->get_nama_arsip();
					$count = 0;
					foreach ($all_nama_arsip as $al) {
						if($al['nama_arsip'] == $new_nama_arsip) {
							$count++;
						}
					}
					if($count > 0) {
						$this->m_flashdata->set_custom('add', '<div class="alert alert-danger" role="alert">Nama arsip "'.$new_nama_arsip.'" sudah ada! <i class="fas fa-exclamation-circle"></i></div>');
					} else {
						$this->m_efs->add_nama_arsip($new_nama_arsip);
						$this->m_flashdata->set_custom('add', '<div class="alert alert-success" role="alert">Nama arsip baru berhasil ditambahkan ('.$new_nama_arsip.') <i class="fas fa-check-circle"></i></div>');
					}
				}
				if($force_closed == 1) {
					$this->m_flashdata->set_custom('force_closed', 1);
					redirect('employee/manage_nama_arsip?force_closed=on');
				} else {
					redirect('employee/manage_nama_arsip?force_closed=off');
				} 
			}
		} else {
			redirect('auth/blocked');
		}
	}

	public function multi_add() {
		$data['title'] = 'Add Multiple EFS Data';
		$data['profile'] = $this->m_auth->get_session();
		$this->load->view('templates/v_user_header', $data);
		$this->load->view('templates/v_user_sidebar', $data);
		$this->load->view('templates/v_user_topbar', $data);
		$this->load->view('employee/v_efs_multi_add', $data);
		$this->load->view('templates/v_user_footer', $data);
	}

	public function proses_multi_add() {
		$profile = $this->m_auth->get_session();
		$divisi = $profile['divisi'];
		$file_name = $_FILES['file_arsip_zip']['name'];
		$file_zip = $_FILES['file_arsip_zip'];
		//upload
		$config['upload_path'] = './assets/uploads/arsip_masuk/'.$divisi.'/';
		$config['allowed_types'] = 'zip|rar';
		$config['file_name'] = $file_name;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('file_arsip_zip')) {
			$result = [];
			$file_name = str_replace(' ', '_', $file_name);
			exec('cd '.substr($_SERVER['SCRIPT_FILENAME'],0,-10).'/assets/uploads/arsip_masuk/'.$divisi.' && 7z l "'.$file_name.'"', $result);
			$n = sizeof($result);
			$berkas = [];
			for($i = 15; $i < $n - 2; $i++) {
				$berkas[] = trim(substr($result[$i], 52, 50));  
			}
			shell_exec('cd '.substr($_SERVER['SCRIPT_FILENAME'],0,-10).'/assets/uploads/arsip_masuk/'.$divisi.' && 7z e "'.$file_name.'"');
			sleep(5);
			for($j = 0; $j < sizeof($berkas); $j++) {
				$explode_berkas = explode('.'.pathinfo($berkas[$j], PATHINFO_EXTENSION), $berkas[$j]);
				$no_berkas = $explode_berkas[0];
				$ext = pathinfo($berkas[$j], PATHINFO_EXTENSION);
				$enkrip_berkas = $this->m_efs->encrypt_file($no_berkas);
				shell_exec('cd '.substr($_SERVER['SCRIPT_FILENAME'],0,-10).'/assets/uploads/arsip_masuk/'.$divisi.' && ren "'.$berkas[$j].'" "'.$enkrip_berkas.'.'.$ext.'"');
				$data = [
					'no_berkas' => $no_berkas,
					'file' => $enkrip_berkas.'.'.$ext
				];
				$this->m_efs->add_zip_temp($data);
			}
			sleep(1);
			shell_exec('cd '.substr($_SERVER['SCRIPT_FILENAME'],0,-10).'/assets/uploads/arsip_masuk/'.$divisi.' && del "'.$file_name.'"');
			$this->m_flashdata->set('success', 'Pengunggahan berkas telah berhasil dilakukan ('.$file_name.')');
			redirect('employee/multi_add_confirmation');
		} else {
			$this->m_flashdata->set('danger', $this->upload->display_errors());
			redirect('employee/multi_add');
		}
	}

	public function multi_add_confirmation() {
		$data['title'] = 'Add Multiple EFS Data (Confirmation)';
		$data['profile'] = $this->m_auth->get_session();

		//no_berkas
		$data['file_zip'] = $this->m_efs->get_zip_temp();
		$count_data = $this->m_efs->count_zip_temp();
		//all efs
		$efs_data = $this->m_efs->get_all();

		//lokasi penyimpanan
		$data['lokasi'] = $this->m_efs->get_lokasi();
		//nama arsip
		$data['nama_arsip'] = $this->m_efs->get_nama_arsip();

		for($i = 0; $i < $count_data; $i++) {
			$j = $i + $data['file_zip'][0]['id'];
			$this->form_validation->set_rules('no_berkas_'.$j, 'No Berkas '.$j, 'required');
			$this->form_validation->set_rules('keterangan_'.$j, 'Keterangan '.$j, 'required');
			$this->form_validation->set_rules('file_'.$j, 'File '.$j, 'required');
			$this->form_validation->set_rules('no_arsip_'.$j, 'No Arsip '.$j, 'required');
			$this->form_validation->set_rules('lokasi_penyimpanan_'.$j, 'Lokasi Penyimpanan '.$j, 'required');
			$this->form_validation->set_rules('nama_arsip_'.$j, 'Nama Arsip '.$j, 'required');
			$this->form_validation->set_rules('tgl_arsip_'.$j, 'Tanggal Arsip '.$j, 'required');
		}
		if($this->form_validation->run() == FALSE) {
			$this->load->view('templates/v_user_header', $data);
			$this->load->view('templates/v_user_sidebar', $data);
			$this->load->view('templates/v_user_topbar', $data);
			$this->load->view('employee/v_efs_multi_add_confirmation', $data);
			$this->load->view('templates/v_user_footer', $data);
		} else {
			$count_fail = 0;
			$id_user = $data['profile']['id'];
			$divisi = $data['profile']['divisi'];
			for($i = 0; $i < $count_data; $i++) {
				$j = $i + $data['file_zip'][0]['id'];
				//input
				$no_berkas = $this->input->post('no_berkas_'.$j);
				$file = $this->input->post('file_'.$j);
				$keterangan = $this->input->post('keterangan_'.$j);
				$no_arsip = $this->input->post('no_arsip_'.$j);
				$lokasi_penyimpanan = $this->input->post('lokasi_penyimpanan_'.$j);
				$nama_arsip = $this->input->post('nama_arsip_'.$j);
				$tgl_arsip = $this->input->post('tgl_arsip_'.$j);

				$is_add = 1;
				foreach ($efs_data as $ed) {
					if($ed['no_berkas'] == $no_berkas) {
						$count_fail++;
						$is_add = 0;
					}
				}
				if($is_add == 1) {
					$data1 = array(
						'id_user' => $id_user,
						'divisi' => $divisi,
						'no_berkas' => $no_berkas,
						'keterangan' => $keterangan,
						'no_arsip' => $no_arsip,
						'lokasi_penyimpanan' => $lokasi_penyimpanan,
						'nama_arsip' => $nama_arsip,
						'tgl_arsip' => $tgl_arsip,
						'file' => $file
					);
					$this->m_efs->add($data1);
				}
			}
			sleep(4);
			$this->m_efs->clear_zip_temp();
			$count_success = $count_data - $count_fail;
			if($count_fail > 0) {
				if($count_success == 0) {
					$this->m_flashdata->set('danger', $count_fail.' Data EFS gagal ditambahkan!');
				} else {
					$this->m_flashdata->set('warning', $count_success.' dari '.$count_data.' Data EFS sukses ditambahkan!');
				}
			} else {
				$this->m_flashdata->set('success', $count_success.' Data EFS sukses ditambahkan');
			}
			redirect('employee/manage');
		}
 		
	}

	public function get_efs_divisi() {
	    $div = $this->m_charts->show_efs_divisi();
	    echo json_encode($div);
	}

	public function get_efs_tahun() {
	    $tahun = $this->m_charts->show_efs_tahun();
	    echo json_encode($tahun);
	}
}
?>
