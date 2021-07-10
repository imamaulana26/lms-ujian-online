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
	function hapus_soal($id)
	{
		$this->db->delete('tbl_soal', ['soal_id' => $id]);
		echo json_encode([
			'msg' => 'Soal berhasil dihapus!'
		]);
		exit;
	}

	public function submit_soal()
	{
		// var_dump(
		// 	$this->input->post()
		// );
		$dt_temp_lamp = array();
		$dt_soal = array(
			'soal_modul_id' => input('modul'),
			'soal_detail' => input('soal_ujian'),
		);

		//lampiran
		if (!empty(input('lampiran_soal'))) {
			$dt_lamp = array(
				'tipe' => input('jns_lampiran'),
				'link' => input('lampiran_soal')
			);
			$dt_temp_lamp = array(
				'soal_lampiran' => serialize($dt_lamp)
			);
		}
		// end of lampiran

		// soal 
		if (input('jns_soal') == 1) {
			//true false
			$dt_jenis = array(
				'soal_tipe' => '2',
				'soal_kunci' => input('tf'),
			);
		} elseif (input('jns_soal') == 0) {
			//soal pg
			$pg = array();
			$key = array(
				input('pilihan_a'),
				input('pilihan_b'),
				input('pilihan_c'),
				input('pilihan_d')
			);
			$n = range('a', 'd');
			for ($i = 0; $i < count($key); $i++) {
				$pg[$i]['kunci_jawaban'] = $n[$i];
				$pg[$i]['jawaban'] = $key[$i];
			}

			$dt_jenis = array(
				'soal_tipe' => '1',
				'soal_pg' => serialize($pg),
				'soal_kunci' => 'a'
			);
		} elseif (input('jns_soal') == 2) {
			//esay
			$dt_jenis = array(
				'soal_tipe' => '3',
				'soal_kunci' => input('tf'),
			);
		} elseif (input('jns_soal') == 3) {
			//jawaban singkat
			$dt_jenis = array(
				'soal_tipe' => '4',
				'soal_kunci' => input('jawaban_singkat'),
			);
		} elseif (input('jns_soal') == 4) {
			//dt jawaban mencocokan

			for ($i = 0; $i < count($this->input->post('row')); $i++) {
				$dt_jawaban[] = array(
					'row' => $this->input->post('row')[$i],
					'column' => $this->input->post('cols')[$i]
				);
			}
			//end of dt

			//jawaban mencocokan jawaban
			$dt_jenis = array(
				'soal_tipe' => '5',
				'soal_kunci' => serialize($dt_jawaban),
			);
		}
		// end of soal
		$dt_fix = array_merge($dt_soal, $dt_jenis, $dt_temp_lamp);
		$this->db->insert('tbl_soal', $dt_fix);
		$this->session->set_flashdata('msg', 'success');
		echo "<script language=\"javascript\">window.history.back();</script>";
	}
}
