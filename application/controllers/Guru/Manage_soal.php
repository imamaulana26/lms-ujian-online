<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_soal extends CI_Controller
{
	public function index()
	{
		$page = 'admin/v_lihat_jawaban';
		$data['title'] = 'Halaman Jawaban Siswa';
		$data['breadcrumb'] = array(
			'<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
			'<li class="breadcrumb-item active">Lihat Jawaban</li>'
		);

		$data['dt_kelas'] = $this->db->get_where('tbl_kelas', ['kelas_id <' => 16])->result_array();

		$this->load->view($page, $data);
	}

	function jawaban_siswa($id)
	{
		$page = 'admin/v_jawaban_siswa';
		$data['title'] = 'Halaman Kelola Module';
		$data['breadcrumb'] = array(
			'<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
			'<li class="breadcrumb-item"><a href="' . site_url('kelola-module') . '"></a></li>',
			'<li class="breadcrumb-item active">Kelola Soal</li>'
		);

		$data['jawaban'] = $this->db->select('a.nilai,a.id_log, e.siswa_nama, b.modul_ub,a.id_log_soal,a.log_jawaban_user,d.nm_mapel,a.kd_modul')->from('tbl_log_soal a')
			->join('tbl_modul b', 'a.kd_modul = b.id_modul', 'left')
			->join('tbl_pelajaran c', 'b.modul_pelajaran = c.id_pelajaran', 'left')
			->join('tbl_mapel d', 'c.kd_mapel = d.kd_mapel', 'left')
			->join('tbl_siswa e', 'a.nis_user = e.siswa_nis', 'left')
			->where('a.id_log', $id)
			->get()->result_array();

		$bank_soal = $this->db->get_where('tbl_soal', ['soal_modul_id' => $data['jawaban'][0]['kd_modul']])->result_array();
		$unser_urut = unserialize($data['jawaban'][0]['log_jawaban_user']);
		foreach ($unser_urut as $value) {
			if (($key2 = array_search($value['id'], array_column($bank_soal, 'soal_id'))) !== false) {
				$soal_dumy[] = array(
					'soal_detail' => $bank_soal[$key2]['soal_detail'],
					'soal_tipe' => $bank_soal[$key2]['soal_tipe'],
					'soal_lampiran' => $bank_soal[$key2]['soal_lampiran'],
					'soal_pg' => $bank_soal[$key2]['soal_pg'],
					'soal_kunci' => $bank_soal[$key2]['soal_kunci'],
					'jwb_siswa' => $value['jwb']
				);
			}
		}

		$data['dt_jawaban'] = $soal_dumy;

		// var_dump($data['dt_jawaban']);
		// $test = unserialize($data['dt_jawaban'][3]['soal_kunci']);
		// var_dump($test);
		// die;
		// var_dump($unser_urut);
		// var_dump($unser_urut1);
		// var_dump($soal_dumy);
		// var_dump($data['jawaban'][0]['kd_modul']);
		// die;
		$this->load->view($page, $data);
	}

	public function lihat_jawaban()
	{
		// $hasil = $_POST;

		$hasil = $this->db->select('a.time_end, a.nilai, a.id_log, e.siswa_nama, b.modul_ub ')->from('tbl_log_soal a')
			->join('tbl_modul b', 'a.kd_modul = b.id_modul', 'left')
			->join('tbl_pelajaran c', 'b.modul_pelajaran = c.id_pelajaran', 'left')
			->join('tbl_mapel d', 'c.kd_mapel = d.kd_mapel', 'left')
			->join('tbl_siswa e', 'a.nis_user = e.siswa_nis', 'left')
			->where(['b.modul_pelajaran' => input('modul_pelajaran'), 'a.log_jawaban_user !=' => null])
			->get()->result_array();

		$list = array();
		foreach ($hasil as $key => $val) {
			$row = array();
			$exp = explode(' ', $val['time_end']);

			$row[] = $key + 1;
			$row[] = $val['siswa_nama'];
			$row[] = 'UB Ke-' . $val['modul_ub'];
			$row[] = $val['nilai'];
			$row[] = longdate_indo($exp[0]) . ' - ' . date_format(date_create($exp[1]), 'h:i a');

			$action = "<a href='" . site_url('guru/manage_soal/jawaban_siswa/' . $val['id_log']) . "'><span class='badge badge-info'>Lihat Jawaban</span></a><span id='reset' class='badge badge-danger ml-1' style='cursor:pointer' data-reset='" . $val['id_log'] . "'>Reset</span>";

			$row[] = $action;

			$list[] = $row;
		}

		echo json_encode($list);
		exit;
	}

	//jika murid mendapatkan soal esay
	public function lihat_jawaban_essay()
	{
		$hasil = $this->db->select('a.time_end, a.nilai, a.id_log, e.siswa_nama, b.modul_ub ')->from('tbl_log_soal a')
			->join('tbl_modul b', 'a.kd_modul = b.id_modul', 'left')
			->join('tbl_pelajaran c', 'b.modul_pelajaran = c.id_pelajaran', 'left')
			->join('tbl_mapel d', 'c.kd_mapel = d.kd_mapel', 'left')
			->join('tbl_siswa e', 'a.nis_user = e.siswa_nis', 'left')
			->where(['a.log_essay' => 1, 'a.log_jawaban_user !=' => null])
			->get()->result_array();

		$list = array();
		foreach ($hasil as $key => $val) {
			$row = array();
			$exp = explode(' ', $val['time_end']);

			$row[] = $key + 1;
			$row[] = $val['siswa_nama'];
			$row[] = 'UB Ke-' . $val['modul_ub'];
			$row[] = $val['nilai'];
			$row[] = longdate_indo($exp[0]) . ' - ' . date_format(date_create($exp[1]), 'h:i a');

			$action = "<a href='" . site_url('guru/manage_soal/jawaban_siswa/' . $val['id_log']) . "'><span class='badge badge-info'>Lihat Jawaban</span></a>";

			$row[] = $action;

			$list[] = $row;
		}

		echo json_encode($list);
		exit;
	}

	//jika murid terkendala waktu ujian selesai
	public function lihat_jawaban_null()
	{
		$hasil = $this->db->select('a.time_end, a.nilai, a.id_log, e.siswa_nama, b.modul_ub ')->from('tbl_log_soal a')
			->join('tbl_modul b', 'a.kd_modul = b.id_modul', 'left')
			->join('tbl_pelajaran c', 'b.modul_pelajaran = c.id_pelajaran', 'left')
			->join('tbl_mapel d', 'c.kd_mapel = d.kd_mapel', 'left')
			->join('tbl_siswa e', 'a.nis_user = e.siswa_nis', 'left')
			->where(['a.log_jawaban_user' => null])
			->get()->result_array();

		$list = array();
		foreach ($hasil as $key => $val) {
			$row = array();
			$exp = explode(' ', $val['time_end']);

			$row[] = $key + 1;
			$row[] = $val['siswa_nama'];
			$row[] = 'UB Ke-' . $val['modul_ub'];
			$row[] = $val['nilai'];
			$row[] = longdate_indo($exp[0]) . ' - ' . date_format(date_create($exp[1]), 'h:i a');

			// $action = "<a href='" . site_url('guru/manage_soal/reset_jawaban/' . $val['id_log']) . "'><span class='badge badge-danger'>Reset</span></a>";
			$action = "<span class='badge badge-info'>Lihat Jawaban</span></a><span id='reset' class='badge badge-danger' style='cursor:pointer' data-reset='" . $val['id_log'] . "'>Reset</span>";

			$row[] = $action;

			$list[] = $row;
		}

		echo json_encode($list);
		exit;
	}

	//reset jawaban siswa
	public function reset_jawaban($id)
	{
		$this->db->delete('tbl_log_soal', ['id_log' => $id]);
		echo json_encode('success');
		exit;
	}

	function update_nilai()
	{
		$this->db->update(
			'tbl_log_soal',
			['nilai' => input('nilai')],
			['id_log' => input('id_log')]
		);
		echo json_encode('success');
		exit;
	}
	function get_dtnilai($id)
	{
		$result = $this->db->select('d.nm_mapel,a.id_log,a.nilai,b.modul_ub')->from('tbl_log_soal a')
			->join('tbl_modul b', 'a.kd_modul = b.id_modul', 'left')
			->join('tbl_pelajaran c', 'b.modul_pelajaran = c.id_pelajaran', 'left')
			->join('tbl_mapel d', 'c.kd_mapel = d.kd_mapel', 'left')
			->where('a.id_log', $id)->get()->row_array();
		echo json_encode($result);
		// echo json_encode(['jenis' => 'submit', 'status' => false, 'msg' => 'Berhasil ditambahkan']);
		exit;
	}

	// function update_nilai()
	// {
	// 	$this->db->update(
	// 		'tbl_log_soal',
	// 		['nilai' => input('nilai_update')],
	// 		['id_log' => input('idlog_update')]
	// 	);

	// 	echo json_encode(['jenis' => 'update', 'msg' => 'Berhasil diupdate']);
	// 	exit;
	// }
}
