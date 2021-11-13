<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_ub extends CI_Controller
{
	public function index()
	{
		// var_dump($_POST);
		// die;
		$page = 'siswa/v_list_ub';
		$data['title'] = 'List UB';
		// model modul
		$data['list_ub'] = $this->db->get_where('tbl_modul', ['modul_pelajaran' => $_POST['id_pel']])->result_array();
		$sess = array(
			'nama_mapel' => $_POST['nama_mapel'],
			'nama_pengajar' => $_POST['nama_pengajar']
		);
		// var_dump($data['list_ub']);
		// die;
		$this->session->set_userdata($sess);

		$this->load->view($page, $data);
	}
}
