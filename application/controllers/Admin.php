<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(['m_auth', 'm_notif', 'm_flashdata', 'm_user', 'm_resetpw', 'm_charts', 'm_datatables']);
		setWIB();
		is_logged_in();
		session_timeout();
		click_notification();
	}

	public function index() {
		$data['title'] = 'Dashboard Admin';
		$data['profile'] = $this->m_auth->get_session();
		
		//notifikasi 
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();

		//data user per tahun
		$data['user_tahun'] = $this->m_user->groupby_tahun();
		//total user
	    $data['total'] = $this->m_user->count_all();

		$this->load->view('templates/v_user_header', $data);
		$this->load->view('templates/v_user_sidebar', $data);
		$this->load->view('templates/v_user_topbar', $data);
		$this->load->view('admin/v_admin_dashboard', $data);
		$this->load->view('templates/v_user_footer', $data);
		$this->load->view('js/v_js_admin_charts', $data);
	}

	public function role() {
		$data['title'] = 'Role';
		$data['profile'] = $this->m_auth->get_session();

		//notifikasi 
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();
		
		$data['role'] = $this->m_user->get_all_role();

		$this->load->view('templates/v_user_header', $data);
		$this->load->view('templates/v_user_sidebar', $data);
		$this->load->view('templates/v_user_topbar', $data);
		$this->load->view('admin/v_user_role', $data);
		$this->load->view('templates/v_user_footer');
	}

	public function roleAccess($role_id) {
		$data['title'] = 'Role Access';
		$data['profile'] = $this->m_auth->get_session();
		$data['role'] = $this->m_user->get_role($role_id);
		$data['menu'] = $this->m_user->get_all_user_menu();

		//notifikasi 
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();

		$this->load->view('templates/v_user_header', $data);
		$this->load->view('templates/v_user_sidebar', $data);
		$this->load->view('templates/v_user_topbar', $data);
		$this->load->view('admin/v_user_role_access', $data);
		$this->load->view('templates/v_user_footer');
		$this->load->view('js/v_js_user_change_activation');
	}

	public function changeAccess() {
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');
		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];
		$result = $this->m_user->get_access_menu($data);
		if($result->num_rows() < 1) {
			$this->m_user->add_access_menu($data);
		} else {
			$this->m_user->delete_access_menu($data);
		}
		$this->m_flashdata->set('warning', 'Akses menu berhasil diubah!');
	}

	public function manage() {
		$data['title'] = 'Manage Employee Data';
		$data['profile'] = $this->m_auth->get_session();
		$data['divisi'] = $this->m_user->get_divisi();
		
		//active status
		$this->m_user->set_active_status();

		//notifikasi 
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();
		
		//fitur untuk sort, filter, dan search
		$data['user'] = $this->m_user->show_user();

		$this->load->view('templates/v_user_header', $data);
		$this->load->view('templates/v_user_sidebar', $data);
		$this->load->view('templates/v_user_topbar', $data);
		$this->load->view('admin/v_employee_manage', $data);
		
		$this->load->view('templates/v_user_footer');
		$this->load->view('admin/v_employee_edit_modal');
		$this->load->view('admin/v_employee_delete_modal');
		$this->load->view('js/v_js_user_toast');
		$this->load->view('js/v_js_admin_tooltip');
		$this->load->view('js/v_js_employee_edit');
		$this->load->view('js/v_js_employee_delete');

	}

	public function resetphoto($id_user) {
		$user = $this->m_user->get($id_user);
		$this->m_user->set_ava($id_user, 'logo.jpg');
		$this->m_flashdata->set('success', 'Foto profil berhasil disetel ulang! (username : '.$user['username'].')');
		redirect('admin/manage?search='.$user['username'].'&filter=username');
	}

	public function resetpassword($id_user) {
		$data['title'] = 'Account Recovery URL Generator';
		$data['profile'] = $this->m_auth->get_session();

		//notifikasi 
		$data['notification'] = $this->m_notif->get();
		$data['count'] = $this->m_notif->count_unread();

		//random string generator
		$randomString = $this->m_resetpw->randomStr();
		//user
		$user = $this->m_user->get($id_user);
		//status
		$status = $this->m_resetpw->get($id_user);
		if(sizeof($status) == 0) {
			$data2 = array(
				'id_user' => $id_user,
				'role_id' => $user['role_id'],
				'divisi' => $user['divisi'],
				'link' => $randomString,
				'date_created' => time(),
				'is_clicked' => 0
			);
			$this->m_resetpw->add($data2);
			$this->m_flashdata->set('success', 'URL untuk atur ulang password berhasil dibuat (username : '.$user['username'].')');
			$data['link_reset'] = base_url('auth/reset/').$randomString;
		} else {
			$this->m_resetpw->update_ld($id_user, $randomString);
			$this->m_flashdata->set('success', 'URL untuk atur ulang password berhasil dibuat (username : '.$user['username'].', date created : '.date('d F Y H:i:s' , time()).')');
			$data['link_reset'] = base_url('auth/reset/').$randomString;
		}
		$this->load->view('templates/v_user_header', $data);
		$this->load->view('templates/v_user_sidebar', $data);
		$this->load->view('templates/v_user_topbar', $data);
		$this->load->view('admin/v_employee_reset_password_modal', $data);
		$this->load->view('templates/v_user_footer', $data);
		$this->load->view('js/v_js_user_reset_password');
		$this->load->view('js/v_js_admin_tooltip');
	}

	public function changeActivation($id_user) {
		$user = $this->m_user->get($id_user);
		$is_active = $user['is_active'];
		$username = $user['username'];
		if($is_active == 1) {
			$this->m_user->set_activation(0, $id_user);
			$this->m_flashdata->set('warning', 'Akun '.$username.' telah berhasil dinonaktifkan');
		} else {
			$this->m_user->set_activation(1, $id_user);
			$this->m_flashdata->set('warning', 'Akun '.$username.' telah berhasil diaktifkan');
		}
		//update notifikasi Activation
		$count = $this->m_user->count_nonactive();
		$this->m_notif->update('Activation', 'Ada '.$count.' akun yang tidak aktif.');
		redirect('admin/manage?search='.$user['username'].'&filter=username');
	}

	public function employee_edit() {
		$id_user = $this->input->post('id_user');
		$name = $this->input->post('name');
		$username = $this->input->post('username1');
		$divisi = $this->input->post('divisi');

		$profile = $this->m_user->get($id_user);
		$alluser = $this->m_user->get_all();

		$foto_nama = $_FILES['foto']['name'];
		$foto_file = $_FILES['foto']; 
		$config['upload_path'] = './assets/uploads/foto_profil/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']  = '200000';
		$config['file_name'] = $foto_nama;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('foto')) {
			if($foto_nama != '') {
				$this->m_user->set_ava($profile['id'], $foto_nama);
			}
		} else {
			if($foto_nama != '') {
				$this->m_flashdata->set('danger', 'Format file tidak sesuai! Gagal mengupload foto. Gagal mengubah data employee');
					redirect("admin/manage?search=".$profile['username']."&filter=username");
			}
		}
		if($username != $profile['username']) {
			foreach ($alluser as $au) {
				if($username == $au['username']) {
					$this->m_flashdata->set('danger', 'Username ini telah terdaftar di sistem! ('.$username.')');
					redirect("admin/manage?search=".$profile['username']."&filter=username");
				}
			}
		}
		$this->m_user->update_und($id_user, $username, $name, $divisi);
		$this->m_flashdata->set('success', '1 Data Employee sukses diubah ('.$username.')');
		redirect("admin/manage?search=".$username."&filter=username");
	}

	public function employee_data($id) {
	    $data = $this->m_user->get($id);
	    echo json_encode($data);
	}

	public function employee_delete($id) {
		$emp_data = $this->m_user->get($id);
		$this->m_user->delete($id);
		$this->m_flashdata->set('success', '1 Data Employee berhasil dihapus ('.$emp_data['username'].')');
		redirect('admin/manage');
	}

	public function clear_notification($uri) {
		$this->m_notif->clear();
		$this->m_flashdata->set('warning', 'Semua pemberitahuan telah dibersihkan');
		$uri = str_replace("_", "/", $uri);
		redirect($uri);
	}

	public function get_admin_datatables() {
		$response = $this->m_datatables->show_efs_admin();
		echo json_encode($response);
	}

	public function get_user_divisi() {
	    $div = $this->m_charts->show_user_divisi();
	    echo json_encode($div);
	}

	public function get_user_activation() {
	    $div = $this->m_charts->show_user_activation();
	    echo json_encode($div);
	}
}
?>
