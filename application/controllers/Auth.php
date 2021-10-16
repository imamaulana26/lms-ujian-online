<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		$user = input('username');
		$pass = input('password');

		$get_user = $this->db->get_where('tbl_pengguna', ['pengguna_username' => $user, 'pengguna_password' => md5($pass)]);

		if ($get_user->num_rows() > 0) {

			$dt_user = $get_user->row_array();

			if ($dt_user['pengguna_level'] == 2) {
				$sess['nm_user'] = $dt_user['pengguna_nama'];
				$sess['username'] = $dt_user['pengguna_username'];
				$kelas = $this->db->select('siswa_kelas_id,oc,kc')->from('tbl_siswa')->where('siswa_nis', $user)->get()->row_array();
				$sess['kelas'] = $kelas['siswa_kelas_id'];
				$sess['online_class'] = $kelas['oc'];
				$sess['komunitas_class'] = $kelas['kc'];

				$this->session->set_userdata($sess);
				redirect('siswa/dashboard');
			} elseif ($dt_user['pengguna_level'] == 3) {
				$sess['nm_user'] = $dt_user['pengguna_nama'];
				$sess['username'] = $dt_user['pengguna_username'];

				$this->session->set_userdata($sess);
				redirect('guru/dashboard');
			}
		} else {
			echo 'password salah';
		}
	}


	public function logout()
	{
		$this->session->sess_destroy();

		redirect(base_url());
	}
}
