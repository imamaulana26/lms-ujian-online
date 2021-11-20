<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Module_soal extends CI_Controller
{
	private $url = 'http://localhost/lms-rest-server/api/ujian';

	public function http_request($url, $param)
	{
		// persiapan curl
		$ch = curl_init();

		// set url
		curl_setopt($ch, CURLOPT_URL, $url . $param);

		// return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec($ch);

		curl_close($ch);

		return json_decode($output, true);
	}

	public function index()
	{
		$page = 'admin/v_module_soal';
		$data['title'] = 'Halaman Module Soal';
		$data['breadcrumb'] = array(
			'<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
			'<li class="breadcrumb-item active">Module Soal</li>'
		);

		$param = '/modul?pengajar=' . $_SESSION['idPengajar'];
		$respon_api = $this->http_request($this->url, $param);

		$column = array_column($respon_api['data'], 'id_pelajaran');
		$list = $this->db->select('*')->from('tbl_modul')->where_in('modul_pelajaran', $column)->get()->result_array();

		$arr_find = array();
		foreach ($list as $li) {
			$soal = $this->db->select('count(*) as bank_soal')->from('tbl_soal')->where(['soal_modul_id' => $li['id_modul']])->get()->row_array();
			$row = array();
			foreach ($respon_api['data'] as $val) {
				if ($li['modul_pelajaran'] == $val['id_pelajaran']) {
					$row['id_modul'] = $li['id_modul'];
					$row['modul_pelajaran'] = $li['modul_pelajaran'];
					$row['kelas'] = $val['kelas_nama'];
					$row['mapel'] = $val['nm_mapel'];
					$row['modul_ub'] = $li['modul_ub'];
					$row['waktu'] = $li['waktu_pengerjaan'];
					$row['bank_soal'] = $soal['bank_soal'];

					$arr_find[] = $row;
				}
			}
		}

		$data['list_module'] = $arr_find;

		$this->load->view($page, $data);
	}

	public function soal($id)
	{
		$page = 'admin/v_kelola_soal';
		$data['title'] = 'Halaman Kelola Soal';
		$data['breadcrumb'] = array(
			'<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
			'<li class="breadcrumb-item"><a href="' . site_url('kelola-module') . '">Module Soal</a></li>',
			'<li class="breadcrumb-item active">Kelola Soal</li>'
		);

		$sql = "SELECT a.id_modul, e.kelas_nama, d.nm_mapel, a.modul_ub, a.waktu_pengerjaan, COUNT(b.soal_modul_id) as bank_soal FROM tbl_modul a
		LEFT JOIN tbl_soal b
		ON a.id_modul = b.soal_modul_id
		LEFT JOIN tbl_pelajaran c
		ON a.modul_pelajaran = c.id_pelajaran
		LEFT JOIN tbl_mapel d
		ON c.kd_mapel = d.kd_mapel
		LEFT JOIN tbl_kelas e
		ON c.id_kelas = e.kelas_id
		WHERE a.id_modul = '" . $id . "' GROUP BY a.id_modul";
		$data['module'] = $this->db->query($sql)->row_array();

		$data['bank_soal'] = $this->db->get_where('tbl_soal', ['soal_modul_id' => $id])->result_array();

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


	public function get_module($id)
	{
		$sql = "SELECT a.id_modul, e.kelas_id, c.id_pelajaran, d.nm_mapel, a.modul_ub, a.waktu_pengerjaan, COUNT(b.soal_modul_id) as bank_soal FROM tbl_modul a
		LEFT JOIN tbl_soal b
		ON a.id_modul = b.soal_modul_id
		LEFT JOIN tbl_pelajaran c
		ON a.modul_pelajaran = c.id_pelajaran
		LEFT JOIN tbl_mapel d
		ON c.kd_mapel = d.kd_mapel
		LEFT JOIN tbl_kelas e
		ON c.id_kelas = e.kelas_id
		WHERE a.id_modul = '" . $id . "' GROUP BY a.id_modul";
		$result = $this->db->query($sql)->row_array();

		echo json_encode($result);
		exit;
	}

	public function submit_module()
	{
		$check = $this->db->get_where('tbl_modul', [
			'modul_pelajaran' => input('id_mapel'),
			'modul_ub' => input('id_ub'),
		])->num_rows();
		if ($check > 0) {
			echo json_encode(['jenis' => 'submit', 'status' => true, 'msg' => 'Data Sudah Ada']);
		} else {
			$this->db->insert('tbl_modul', [
				'modul_pelajaran' => input('id_mapel'),
				'modul_ub' => input('id_ub'),
				'waktu_pengerjaan' => input('waktu_ujian')
			]);
			echo json_encode(['jenis' => 'submit', 'status' => false, 'msg' => 'Berhasil ditambahkan']);
		}

		exit;
	}

	public function edit_module()
	{
		// $this->db->insert('tbl_modul', [
		// 	'modul_pelajaran' => input('id_mapel'),
		// 	'modul_ub' => input('id_ub'),
		// 	'waktu_pengerjaan' => input('waktu_ujian')
		// ]);
		$this->db->update('tbl_modul', ['waktu_pengerjaan' => input('waktu_ujian')], ['id_modul' => input('idmodul_update')]);
		$this->db->update('tbl_log_soal', ['nilai' => 1], ['id_log' => 40]);

		echo json_encode(['jenis' => 'update', 'msg' => 'Berhasil diupdate']);
		exit;
	}
}
