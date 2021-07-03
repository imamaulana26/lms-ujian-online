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
	public function test()
	{
		$page = 'siswa/v_test';
		$data['title'] = 'Halaman Test';

		$data['list_ujian'] = $this->db->select('a.id_modul, c.nm_mapel, a.modul_ub, a.waktu_pengerjaan, d.batas_waktu_tes, d.time_start, d.time_end, d.nilai')->from('tbl_modul a')
			->join('tbl_pelajaran b', 'a.modul_pelajaran = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->join('tbl_log_soal d', 'd.kd_modul = a.id_modul', 'left')
			// ->where('nis_user', $this->session->userdata('username'))
			->get()->result_array();

		$this->load->view($page, $data);
	}

	public function guru()
	{
		$page = 'admin/v_dashboard';
		$data['title'] = 'Halaman Test';
		// $kls = $this->db->get_where('tbl_kelas', ['kelas_id <' => '16'])->result_array();
		$data['dtkelas'] = $this->db->select('kelas_id,kelas_nama')->from('tbl_kelas')->where('kelas_id<', '16')
			->get()->result_array();
		$this->load->view($page, $data);
	}

	public function get_mapel()
	{

		$dtmapel = $this->db->select('b.nm_mapel,a.id_pelajaran')->from('tbl_pelajaran a')->where('id_kelas', $this->input->post('kelas'))
			->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'left')
			->get()->result_array();
		$html = "<option value='' disabled>Pilih Mapel</option>";
		foreach ($dtmapel as $mapel) {
			$html .= "<option value='" . $mapel['id_pelajaran'] . "'>" . $mapel['nm_mapel'] . "</option>";
		}
		$data['data_mapel'] = $html;
		echo json_encode($data);
		exit;
	}

	public function testform()
	{
		var_dump(
			$this->input->post()
		);
		die;
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
