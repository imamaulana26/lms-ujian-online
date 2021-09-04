<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_quis extends CI_Controller
{
	public function index()
	{
		$page = 'admin/v_manage_quis';
		$data['title'] = 'Halaman Manage Quis';
		$data['breadcrumb'] = array(
			'<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
			'<li class="breadcrumb-item active">Manage Quis</li>'
		);

		$data['dt_program'] = $this->db->select('a.jns_program,a.id_program,a.peserta_program,a.waktu_pengerjaan,a.aktif,c.nm_mapel,d.kelas_nama')->from('tbl_modul_program a')
			->join('tbl_pelajaran b', 'a.pelajaran_program = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->join('tbl_kelas d', 'b.id_kelas = d.kelas_id', 'left')
			->get()->result_array();

		$data['dtkelas'] = $this->db->select('kelas_id,kelas_nama')->from('tbl_kelas')->where('kelas_id <', '16')
			->get()->result_array();

		$this->load->view($page, $data);
	}

	public function soal($id)
	{
		$page = 'admin/v_kelola_soal_program';
		$data['title'] = 'Halaman Kelola Soal Kelas';
		$data['breadcrumb'] = array(
			'<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
			'<li class="breadcrumb-item"><a href="' . site_url('kelola-module') . '">Module Soal</a></li>',
			'<li class="breadcrumb-item active">Kelola Soal</li>'
		);

		$sql = "SELECT a.id_program, e.kelas_nama,a.jns_program, d.nm_mapel, a.waktu_pengerjaan, COUNT(b.soal_program_id) as bank_soal FROM tbl_modul_program a
		LEFT JOIN tbl_soal_program b
		ON a.id_program = b.soal_program_id
		LEFT JOIN tbl_pelajaran c
		ON a.pelajaran_program = c.id_pelajaran
		LEFT JOIN tbl_mapel d
		ON c.kd_mapel = d.kd_mapel
		LEFT JOIN tbl_kelas e
		ON c.id_kelas = e.kelas_id
		WHERE a.id_program = '" . $id . "' GROUP BY a.id_program";
		$data['module'] = $this->db->query($sql)->row_array();
		// var_dump($data['module']);
		// die;

		$this->load->view($page, $data);
	}

	public function get_mapel()
	{
		$dtmapel = $this->db->select('b.nm_mapel, a.id_pelajaran')->from('tbl_pelajaran a')->where('id_kelas', input('id'))
			->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'left')
			->get()->result_array();
		$html = "";
		foreach ($dtmapel as $mapel) {
			$html .= "<option value='" . $mapel['id_pelajaran'] . "'>" . $mapel['nm_mapel'] . "</option>";
		}
		$data['data_mapel'] = $html;

		echo json_encode($data);
		exit;
	}

	public function change_sts($id)
	{
		$check = $this->db->get_where('tbl_modul_program', ['id_program' => $id, 'aktif' => 0])->num_rows();
		if($check > 0){
			$this->db->update('tbl_modul_program', ['aktif' => 1], ['id_program' => $id]);
		} else {
			$this->db->update('tbl_modul_program', ['aktif' => 0], ['id_program' => $id]);
		}
		echo json_encode(['status' => true, 'msg' => 'Status program quis berhasil diubah']);
		exit;
	}

	public function get_quis($id)
	{
		$result = $this->db->select('*')
			->from('tbl_modul_program a')
			->join('tbl_pelajaran b', 'a.pelajaran_program = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->join('tbl_kelas d', 'b.id_kelas = d.kelas_id', 'left')
			->where(['a.id_program' => $id])->get()->row_array();

		echo json_encode($result);
		exit;
	}

	public function update_quis()
	{
		$data = array(
			'waktu_pengerjaan' => input('waktu_ujian'),
			'jns_program' => input('program')
		);
		$this->db->update('tbl_modul_program', $data, ['id_program' => input('id_program')]);
		echo json_encode(['status' => true, 'msg' => 'Program quis berhasil diubah']);
		exit;
	}

	public function submit_quis()
	{
		$dt_mapel = $this->db->select('c.kelas_nama, b.nm_mapel, a.id_pelajaran')->from('tbl_pelajaran a')->where('id_kelas', input('kelas'))
			->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'left')
			->join('tbl_kelas c', 'a.id_kelas = c.kelas_id', 'left')
			->get()->row_array();

		$check = $this->db->get_where(
			'tbl_modul_program',
			[
				'jns_program' => input('program'),
				'pelajaran_program' => input('id_mapel')
			]
		)->num_rows();

		if ($check > 0) {
			echo json_encode(['status' => false, 'msg' => 'Quis ' . ucfirst(input('program')) . ' untuk ' . $dt_mapel['kelas_nama'] . ' mata pelajaran ' . $dt_mapel['nm_mapel'] . ' sudah tersedia']);
			exit;
		} else {
			$data = array(
				'peserta_program' => null,
				'pelajaran_program' => input('id_mapel'),
				'waktu_pengerjaan' => input('waktu_ujian'),
				'jns_program' => input('program'),
				'aktif' => 0
			);
			$this->db->insert('tbl_modul_program', $data);
			echo json_encode(['status' => true, 'msg' => 'Program quis berhasil ditambahkan']);
			exit;
		}
	}

	public function peserta($id, $tipe)
	{
		$page = 'admin/v_kelola_peserta';
		$tipe = $tipe == 'online' ? 'oc' : 'kc';

		$data['title'] = 'Halaman Kelola Peserta';
		$data['breadcrumb'] = array(
			'<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
			'<li class="breadcrumb-item"><a href="' . site_url('kelola-quis') . '">Module Peserta</a></li>',
			'<li class="breadcrumb-item active">Kelola Peserta</li>'
		);

		$data['dt_program'] = $this->db->select('a.jns_program,a.peserta_program,a.waktu_pengerjaan,c.nm_mapel,d.kelas_nama')->from('tbl_modul_program a')
			->join('tbl_pelajaran b', 'a.pelajaran_program = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->join('tbl_kelas d', 'b.id_kelas = d.kelas_id', 'left')
			->where('id_program', $id)
			->get()->result_array();

		$sql = $this->db->select('siswa_nis,siswa_nama')->from('tbl_siswa')->where($tipe, 1)->get()->result_array();
		$search = array('siswa_nis', 'siswa_nama');
		$replace = array('nis', 'nama');

		$resArray = str_replace($search, $replace, json_encode($sql));
		$res = json_decode($resArray, true);

		if ($data['dt_program'][0]['peserta_program'] != null) {
			$dt_peserta = unserialize($data['dt_program'][0]['peserta_program']);
			foreach ($sql as $key => $val) {
				// buat format data
				$siswa = array(
					'nis' => $val['siswa_nis'],
					'nama' => $val['siswa_nama'],
				);

				if ((array_search($val['siswa_nis'], $dt_peserta)) !== false) {
					$select = array('selected' => 1);
				} else {
					$select = array('selected' => 0);
				}
				$result[] = array_merge($siswa, $select);
			}
			$data['peserta'] = $result;
		} else {
			$data['peserta'] = $res;
		}

		$this->load->view($page, $data);
	}

	public function save_peserta()
	{
		$peserta = serialize($this->input->post('peserta'));
		$this->db->update('tbl_modul_program', ['peserta_program' => $peserta], ['id_program' => input('id_modul')]);
		redirect('manage-quis', 'refresh');
	}
}
