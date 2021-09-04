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
		$dt_temp_lamp = array();
		$dt_soal = array(
			'soal_modul_id' => input('modul'),
			'soal_detail' => $this->input->post('soal_ujian'),
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
			$dt_tf = $this->input->post('truefalse');
			$datainput = array_values($dt_tf);
			$dt_jenis = array(
				'soal_tipe' => '2',
				'soal_kunci' => serialize($datainput),
			);
		} elseif (input('jns_soal') == 0) {


			//soal pg
			// $pg = array();
			// $key = array(
			// 	input('pilihan_a'),
			// 	input('pilihan_b'),
			// 	input('pilihan_c'),
			// 	input('pilihan_d')
			// );
			// var_dump($key);
			// $key = array(
			// 	array(
			// 		'pil' => input('pilihan_a'),
			// 		'pil' => input('pilihan_a'),
			// 	),
			// 	array(
			// 		'pil' => input('pilihan_b')
			// 	),
			// 	array(
			// 		'pil' => input('pilihan_c')
			// 	),
			// 	array(
			// 		'pil' => input('pilihan_d')
			// 	)
			// );
			// var_dump($key);
			// die;



			// $dt_test = 'a:4:{i:0;a:2:{s:13:"kunci_jawaban";s:1:"a";s:7:"jawaban";s:21:"Sekolah Menengah Ata1";}i:1;a:2:{s:13:"kunci_jawaban";s:1:"b";s:7:"jawaban";s:22:"Sekolah Menengah Bawa1";}i:2;a:2:{s:13:"kunci_jawaban";s:1:"c";s:7:"jawaban";s:21:"Sekolah Menengah Kir1";}i:3;a:2:{s:13:"kunci_jawaban";s:1:"d";s:7:"jawaban";s:22:"Sekolah Menengah Kana1";}}';
			// var_dump(unserialize($dt_test));
			// var_dump(
			// 	$this->input->post()
			// );

			$key1 = array(
				array(
					'kunci_jawaban' => 'a',
					'jawaban' => $this->input->post('detail_jawaban_a'),
					'tipe' => $this->input->post('list_jawaban_pg')
				),
				array(
					'kunci_jawaban' => 'b',
					'jawaban' => $this->input->post('detail_jawaban_b'),
					'tipe' => $this->input->post('list_jawaban_pg')
				),
				array(
					'kunci_jawaban' => 'c',
					'jawaban' => $this->input->post('detail_jawaban_c'),
					'tipe' => $this->input->post('list_jawaban_pg')
				),
				array(
					'kunci_jawaban' => 'd',
					'jawaban' => $this->input->post('detail_jawaban_d'),
					'tipe' => $this->input->post('list_jawaban_pg')
				)
			);
			// echo (serialize($key1) . '<br><br>');
			// $dtunser = $key1;
			// $dtunser = unserialize($dtserial);
			// $dtencode = json_encode($dtunser);
			// var_dump($key1);
			// $dt = '[{"kunci_jawaban":"a","jawaban":"test dengan soal <math xmlns=\"http:\/\/www.w3.org\/1998\/Math\/MathML\" class=\"wrs_chemistry\">C<\/math>","tipe":"teks"},{"kunci_jawaban":"b","jawaban":"\u00a0sadas <math xmlns=\"http:\/\/www.w3.org\/1998\/Math\/MathML\">1234<\/math>","tipe":"teks"},{"kunci_jawaban":"c","jawaban":"sa","tipe":"teks"},{"kunci_jawaban":"d","jawaban":"as","tipe":"teks"}]';
			// echo ($dt);
			// var_dump(json_decode($dt));
			// echo json_encode($dtunser);
			// var_dump(json_decode($dtencode));
			// print_r($this->input->post('detail_jawaban_b'));
			// var_dump();

			// var_dump(unserialize($dtserial));

			// var_dump();

			// var_dump($key1);
			// die;

			$dt_jenis = array(
				'soal_tipe' => '1',
				'soal_pg' => json_encode($key1),
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
		//your input string
		// $input_string = $this->input->post('soal_ujian');
		// $str = $this->input->post('soal_ujian');
		// echo htmlspecialchars_decode($str);
		// $str = $this->input->post('soal_ujian');

		// echo htmlspecialchars_decode($str);

		// // note that here the quotes aren't converted
		// echo htmlspecialchars_decode($str, ENT_NOQUOTES);
		// var_dump($str);
		// die;
		$this->db->insert('tbl_soal', $dt_fix);
		$this->session->set_flashdata('msg', 'success');
		echo "<script language=\"javascript\">window.history.back();</script>";
	}
}
