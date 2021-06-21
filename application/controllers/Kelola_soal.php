<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_soal extends CI_Controller
{
	public function soal($id)
	{
		$page = 'admin/v_kelola_soal';
		$data['title'] = 'Halaman Kelola Module';
		$data['breadcrumb'] = array(
			'<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
			'<li class="breadcrumb-item"><a href="' . site_url('kelola-module') . '"></a></li>',
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
		$data['list_module'] = $this->db->query($sql)->result_array();

		$this->load->view($page, $data);
	}
}
