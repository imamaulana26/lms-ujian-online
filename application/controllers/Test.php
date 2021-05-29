<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$page = 'admin/v_test';
		$data['title'] = 'Testing';

		$this->load->view($page, $data);
	}

	public function kerjakan()
	{
		$id = input('id_modul');
		$batas_waktu = input('waktu_tes');
		// jumlah soal yg ditampilkan
		$n_soal = 4;

		$dateTime = new DateTime();
		$dateTime->modify("+{$batas_waktu} minutes");

		$bank_soal = $this->db->get_where('tbl_soal', ['soal_modul_id' => $id])->result_array();

		$cek_log_soal = $this->db->get_where('tbl_log_soal', ['nis_user' => $_SESSION['username'], 'kd_modul' => $id]);

		if ($cek_log_soal->num_rows() < 1) {
			$acak_soal = array_rand($bank_soal, $n_soal);

			$dt_insert = array(
				'nis_user' => $_SESSION['username'],
				'kd_modul' => $id,
				'id_log_soal' => serialize($acak_soal),
				'time_start' => date('Y-m-d H:i:s'),
				'batas_waktu_tes' => $dateTime->format('Y-m-d H:i:s')
			);
			$this->db->insert('tbl_log_soal', $dt_insert);

			echo 'langsung redirect ke view kejakan soal';
		} else {
			$page = 'admin/v_soal';
			$data['title'] = 'Testing';
			$dturut_array = $cek_log_soal->row_array();
			$unser_urut = unserialize($dturut_array['id_log_soal']);
			$soal_acak = array();
			foreach ($unser_urut as $key => $value) {
				$soal_dumy = $bank_soal[$value];
				array_push($soal_acak, $soal_dumy);
			}
			$data['soal_acak'] = $soal_acak;

			/**
			 * ------------------------------------------
			 * Format Penyusunan Jawaban
			 * ------------------------------------------
			 * $pg = array();
			 * $key = array(
			 *	 'Sekolah Menengah Atas',
			 *	 'Sekolah Menengah Bawah',
			 *	 'Sekolah Menengah Kiri',
			 *	 'Sekolah Menengah Kanan'
			 *	);
			 *	$n = range('a', 'd');
			 *	for ($i = 0; $i < count($key); $i++) {
			 *		$pg[$i]['kunci_jawaban'] = $n[$i];
			 *		$pg[$i]['jawaban'] = $key[$i];
			 * 
			 * var_dump(serialize($pg));
			 * die;
			 *	}
			 */
			/**
			 * ------------------------------------------
			 * Format Penyusunan Array untuk mix soal
			 * ------------------------------------------
			 *$arr = array(
			 *2, 3, 4
			 *);
			 * 
			 * var_dump(serialize($pg));
			 * die;
			 *	}
			 */

			/* ------------------------------------------
			 * Format Penyusunan Lampiran
			 * ------------------------------------------
			 * ---------------gambar---------------------
			 * $arr = array(
			 *'tipe' => 'gambar',
			 *'link' => 'https://drive.google.com/file/d/1-uOP0BEMy5exY44tNoeIEEcN2rv0gO2Y/view?usp=sharing'
			 * );
			 *---------------audio---------------------
			 * $arr = array(
			 *'tipe' => 'audio',
			 *'link' => 'https://drive.google.com/file/d/1-uOP0BEMy5exY44tNoeIEEcN2rv0gO2Y/view?usp=sharing'
			 * );
			 * var_dump(serialize($pg));
			 * die;
			 */

			/* ------------------------------------------
			 * Format Penyusunan soal multiple
			 * ------------------------------------------
			* $data['soal_multiple'] = array(
			* array(
			* 'row' => 'apple',
			* 'column' => 'fruit'
			* ),
			* array(
			* 'row' => 'truck',
			* 'column' => 'vehicle'
			* ),
			* array(
			* 'row' => 'computer',
			* 'column' => 'tech'
			* ),
			* array(
			* 'row' => 'teacher',
			* 'column' => 'helper'
			* ),
			* array(
			* 'row' => 'cake',
			* 'column' => 'desert'
			* )
			* );
			 */

			// $arr = array(
			// 	'tipe' => 'video',
			// 	'link' => 'https://drive.google.com/file/d/1HJmcAcmVdiDp5WVx-XNroB5Fy82oTBrS/view?usp=sharing'
			// );

			// var_dump(serialize($arr));
			// die;

			// foreach ($data['soal_multiple'] as $value) {
			// 	$rowfix[] = $value['column'];
			// }
			// shuffle($rowfix);
			// $data['rowfix'] = $rowfix;
			// var_dump($rowfix);
			// var_dump(serialize($data['soal_multiple']));
			// die;

			$this->session->set_userdata('soal', $soal_acak);
			$this->load->view($page, $data);
		}
	}

	function check_form()
	{
		//statmn data
		$result = 0;
		$nilai = 0;
		$soal = $this->session->userdata('soal');
		$jawaban_siswa = $this->input->post();
		$jawaban = array_values($jawaban_siswa['answer']);
		//end of statmn data

		// penghitungan nilai
		foreach ($jawaban  as $key1 => $value1) {
			if ($value1['tipe'] == 1) {
				//soal tipe jawaban Pilgan
				if (!empty($value1['jwb'])) {
					if (($key2 = array_search(1, array_column($soal, 'soal_tipe'))) !== false) {
						if ($value1['jwb'] === $soal[$key2]['soal_kunci']) {
							$nilai++;
						}
					}
				}
			} elseif ($value1['tipe'] == 2) {
				//soal tipe true-false
				if (!empty($value1['jwb'])) {
					if (($key2 = array_search(2, array_column($soal, 'soal_tipe'))) !== false) {
						if ($value1['jwb'] === $soal[$key2]['soal_kunci']) {
							$nilai++;
						}
					}
				}
			} elseif ($value1['tipe'] == 4) {
				//soal tipe jawaban singkat
				if (!empty($value1['jwb'])) {
					if (($key2 = array_search(4, array_column($soal, 'soal_tipe'))) !== false) {
						if ($value1['jwb'] === $soal[$key2]['soal_kunci']) {
							$nilai++;
						}
					}
				}
			}
		}

		//penghitungan nilai tipe 5
		if (($key3 = array_search(5, array_column($jawaban, 'tipe'))) !== false) {
			if (($key4 = array_search(5, array_column($soal, 'soal_tipe'))) !== false) {
				$kunci = unserialize($soal[$key4]['soal_kunci']);
				foreach ($kunci as $value) {
					if ($jawaban[$key3][$value['row']] == $value['column']) {
						$result++;
					}
				}
				if ($result == 5) {
					$nilai++;
				}
			}
		}
		// end of tipe 5

		$nilai_fix = ($nilai / count($soal)) * 100;
		// end of penghitungan nilai
		var_dump($nilai);
		var_dump($nilai_fix);
		die;
	}


	public function get_nomor($no)
	{
		$soal = $_SESSION['soal'];

		$data = array();

		$data['soal_detail'] = $soal[$no - 1]['soal_detail'];
		$data['soal_tipe'] = $soal[$no - 1]['soal_tipe'];
		if ($soal[$no - 1]['soal_tipe'] == 1) {
			$kunci_jawaban	= unserialize($soal[$no - 1]['soal_pg']);
			shuffle($kunci_jawaban);
			$data['soal_jawaban'] = $kunci_jawaban;
		}

		echo json_encode($data);
		exit;
	}
}
