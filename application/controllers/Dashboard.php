<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		$page = 'admin/v_dashboard';
		$data['title'] = 'Dashboard';
		$data['content'] = 'Ini Halaman Dashboard';

		$this->load->view($page, $data);
	}

	public function login()
	{
		$page = 'welcome_message';
		$data['title'] = 'Login';

		$this->load->view($page, $data);
	}

	public function auth()
	{
		$user = $this->input->post('username', true);
		$pass = $this->input->post('password', true);

		$get_user = $this->db->get_where('tbl_pengguna', ['pengguna_username' => $user, 'pengguna_password' => md5($pass)]);

		if ($get_user->num_rows() > 0) {

			$dt_user = $get_user->row_array();

			if ($dt_user['pengguna_level'] == 2) {
				$sess['nm_user'] = $dt_user['pengguna_nama'];
				$sess['username'] = $dt_user['pengguna_username'];
				$this->session->set_userdata($sess);
				redirect('dashboard/test');
			} elseif ($dt_user['pengguna_level'] == 3) {
				$sess['nm_user'] = $dt_user['pengguna_nama'];
				$sess['username'] = $dt_user['pengguna_username'];

				$this->session->set_userdata($sess);

				redirect('dashboard/guru');
			}
		} else {
			echo 'password salah';
		}
	}
}
