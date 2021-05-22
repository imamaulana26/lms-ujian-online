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
		$n_soal = 3;

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
			// echo "bank soal = ";
			// echo "<br>";
			// var_dump($bank_soal);
			// echo "soal sudah acak = ";
			// echo "<br>";
			// var_dump($soal_acak);
			// echo "sistem acak array = ";

			$this->session->set_userdata('soal', $soal_acak);
			$this->load->view($page, $data);
		}
	}


	public function get_nomor($no)
	{
		$soal = $_SESSION['soal'];

		$data = array();

		$data['soal_detail'] = $soal[$no - 1]['soal_detail'];
		$data['soal_tipe'] = $soal[$no - 1]['soal_tipe'];
		if ($soal[$no - 1]['soal_tipe'] == 1) {
			$data['soal_jawaban'] = unserialize($soal[$no - 1]['soal_pg']);
		}

		echo json_encode($data);
		exit;
	}
}
