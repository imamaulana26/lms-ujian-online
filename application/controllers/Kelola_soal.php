<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_soal extends CI_Controller
{
	public function index()
	{
		$page = 'admin/v_kelola_soal';
		$data['title'] = 'Halaman Kelola Soal';
		$data['breadcrumb'] = array(
			'<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
			'<li class="breadcrumb-item active">Kelola Soal</li>'
		);

		$data['dtkelas'] = $this->db->select('kelas_id,kelas_nama')->from('tbl_kelas')->where('kelas_id <', '16')
			->get()->result_array();

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
}
