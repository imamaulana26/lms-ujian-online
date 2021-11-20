<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		// $get_user = $this->db->get_where('tbl_pengguna', ['pengguna_username' => $user]);

		// if ($get_user->num_rows() > 0) {
		// var_dump($_SESSION);
		// die;
		if (isset($_SESSION['username'])) {

			$dt_user = $_SESSION;

			if ($dt_user['pengguna_level'] == 2) {
				$sess['nm_user'] = $dt_user['nama'];
				$sess['username'] = $dt_user['username'];
				$sess['kelas'] = $dt_user['kelas'];
				$sess['online_class'] = $dt_user['oc'];
				$sess['komunitas_class'] = $dt_user['kc'];

				$this->session->set_userdata($sess);
				redirect('siswa/dashboard');
			} elseif ($dt_user['pengguna_level'] == 3) {
				$sess['nm_user'] = $dt_user['nama'];
				$sess['username'] = $dt_user['username'];

				$this->session->set_userdata($sess);
				redirect('guru/dashboard');
			}
		} else {
			redirect('http://localhost/bi-lms-merge');
		}
	}


	public function logout()
	{
		$this->session->sess_destroy();

		redirect(base_url());
	}
}
