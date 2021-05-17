<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		$page = 'admin/v_dashboard';
		$data['title'] = 'Dashboard Admin';

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
			$sess['nm_user'] = $dt_user['pengguna_nama'];
			$sess['username'] = $dt_user['pengguna_username'];

			$this->session->set_userdata($sess);

			redirect('dashboard/test');
		}
	}

	public function test()
	{
		$page = 'v_test';
		$data['title'] = 'Halaman Test';

		$data['list_ujian'] = $this->db->select('a.id_modul, c.nm_mapel, a.modul_ub, a.waktu_pengerjaan, d.batas_waktu_tes, d.time_start, d.time_end, d.nilai')->from('tbl_modul a')
			->join('tbl_pelajaran b', 'a.modul_pelajaran = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->join('tbl_log_soal d', 'd.kd_modul = a.id_modul', 'left')
			->get()->result_array();

		$this->load->view($page, $data);
	}

	public function detail_soal($id)
	{
		$page = 'v_detail_soal';
		$data['title'] = 'Detail Soal';

		$data['soal'] = $this->db->select('a.id_modul, c.nm_mapel, a.modul_ub, a.waktu_pengerjaan, e.batas_waktu_tes, e.time_start, e.time_end, e.nilai, d.nm_pengajar')
			->from('tbl_modul a')
			->join('tbl_pelajaran b', 'a.modul_pelajaran = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->join('tbl_pengajar d', 'd.id_pengajar = b.kd_pengajar', 'left')
			->join('tbl_log_soal e', 'e.kd_modul = a.id_modul', 'left')
			->where(['a.id_modul' => $id])->get()->row_array();

		$date_now = new DateTime();
		$tgl = new DateTime($data['soal']['batas_waktu_tes']);
		$diff = $tgl->diff($date_now);
		$data['sisa_waktu'] = $diff->i;

		$this->load->view($page, $data);
	}
}
