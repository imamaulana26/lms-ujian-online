<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('M_ujian', 'm_ujian');
	}

	public function index()
	{
		unset(
			$_SESSION['nama_mapel'],
			$_SESSION['nama_pengajar']
		);
		// var_dump($_SESSION);
		// die;
		$param = '?kelas=' . $_SESSION['kelas'];
		$respon = $this->m_ujian->list_ujian($param);


		$page = 'siswa/v_test';
		$data['title'] = 'Ujian';
		$data['list_ujian'] = $respon['data'];

		// $data['list_ujian'] = $this->db->select('a.id_modul, c.nm_mapel, a.modul_ub, a.waktu_pengerjaan, d.*')->from('tbl_modul a')
		// 	->join('tbl_pelajaran b', 'a.modul_pelajaran = b.id_pelajaran', 'kelasleft')
		// 	->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
		// 	->join('tbl_log_soal d', 'd.kd_modul = a.id_modul', 'left')
		// 	->where('b.id_kelas', $_SESSION['kelas'])
		// 	->get()->result_array();

		// $data['list_quis'] = $this->db->select('*')->from('tbl_modul_program a')
		// 	->join('tbl_pelajaran b', 'a.pelajaran_program = b.id_pelajaran', 'left')
		// 	->join('tbl_mapel c', 'c.kd_mapel = b.kd_mapel', 'left')
		// 	->where('a.aktif', 1)->like('a.peserta_program', $_SESSION['username'])
		// 	->get()->result_array();

		$this->load->view($page, $data);
	}

	public function test()
	{
		$page = 'siswa/v_test';
		$data['title'] = 'Halaman Test';

		$data['list_ujian'] = $this->db->select('a.id_modul, c.nm_mapel, a.modul_ub, a.waktu_pengerjaan')->from('tbl_modul a')
			->join('tbl_pelajaran b', 'a.modul_pelajaran = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->where('b.id_kelas', $_SESSION['kelas'])
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
		$page = 'siswa/v_detail_soal';
		$data['title'] = 'Detail Soal';
		$data['soal'] = $this->db->select('a.id_modul, a.modul_ub, a.waktu_pengerjaan, e.batas_waktu_tes, e.time_start, e.time_end, e.nilai')
			->from('tbl_modul a')
			->join('tbl_log_soal e', 'e.kd_modul = a.id_modul', 'left')
			->where(['e.kd_modul' => $id, 'e.nis_user' => $_SESSION['user']])->get()->row_array();

		if (empty($data['soal'])) { //kondisi belum ada di DB / belum mengerjakan
			$data['soal'] = $this->db->select('*')
				->from('tbl_modul a')
				->where(['a.id_modul' => $id])->get()->row_array();
			$data['status_ujian'] = 1;
			$data['sisa_waktu'] = 0;
		} else { //kondisi sudah mengerjakan test online
			// hitung selisih waktu yang tersisa
			$date_now = new DateTime();
			$tgl = new DateTime($data['soal']['batas_waktu_tes']); //tanggal waktu setelah dikerjakan atau batas waktu dia
			$diff = $tgl->diff($date_now);

			$data['sisa_waktu'] = $diff->i;
			$data['format_sisa_waktu'] = $diff->h . ' jam ' . $diff->i . ' menit';
			$data['status_ujian'] = $diff->invert; // 0 artinya selesai, 1 artinya aktif

			if ($diff->invert == 0) {
				$this->db->update('tbl_log_soal', ['time_end' => $date_now->format('Y-m-d H:i:s'), 'nilai' => '0.00'], ['kd_modul' => $id]);
			}
			// $waktu = new Date($data['soal']['batas_waktu_tes']);
			// $myDateTime = DateTime::createFromFormat('Y-m-d', $dateString);
			$data['batas_waktu'] = $tgl->format('F d Y H:i:s');
		}




		$this->load->view($page, $data);
	}
	// public function detail_soal($id)
	// {
	// 	$page = 'siswa/v_detail_soal';
	// 	$data['title'] = 'Detail Soal';

	// 	$data['soal'] = $this->db->select('a.id_modul, c.nm_mapel, a.modul_ub, a.waktu_pengerjaan, e.batas_waktu_tes, e.time_start, e.time_end, e.nilai, d.nm_pengajar')
	// 		->from('tbl_modul a')
	// 		->join('tbl_pelajaran b', 'a.modul_pelajaran = b.id_pelajaran', 'left')
	// 		->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
	// 		->join('tbl_pengajar d', 'd.id_pengajar = b.kd_pengajar', 'left')
	// 		->join('tbl_log_soal e', 'e.kd_modul = a.id_modul', 'left')
	// 		->where(['a.id_modul' => $id])->get()->row_array();

	// 	// hitung selisih waktu yang tersisa
	// 	$date_now = new DateTime();
	// 	$tgl = new DateTime($data['soal']['batas_waktu_tes']);
	// 	$diff = $tgl->diff($date_now);

	// 	$data['sisa_waktu'] = $diff->i;
	// 	$data['format_sisa_waktu'] = $diff->h . ' jam ' . $diff->i . ' menit';
	// 	$data['status_ujian'] = $diff->invert; // 0 artinya selesai, 1 artinya aktif

	// 	if ($diff->invert == 0) {
	// 		$this->db->update('tbl_log_soal', ['time_end' => $date_now->format('Y-m-d H:i:s'), 'nilai' => '0.00'], ['kd_modul' => $id]);
	// 	}

	// 	// $waktu = new Date($data['soal']['batas_waktu_tes']);
	// 	// $myDateTime = DateTime::createFromFormat('Y-m-d', $dateString);
	// 	$data['batas_waktu'] = $tgl->format('F d Y H:i:s');
	// 	$this->load->view($page, $data);
	// }
}
