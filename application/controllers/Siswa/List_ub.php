<?php
defined('BASEPATH') or exit('No direct script access allowed');

class List_ub extends CI_Controller
{	
	public function index()
	{
		// var_dump($_POST); die;
		$page = 'siswa/v_list_ub';
		// model modul
		$data['list_ub'] = $this->db->get_where('tbl_modul', ['modul_pelajaran' => $_POST['id_pel']])->result_array();
		$sess = array(
			'nama_mapel'=> $_POST['nama_mapel'],
			'nama_pengajar'=> $_POST['nama_pengajar'] 
		);
		$this->session->set_userdata($sess);

		$this->load->view($page, $data);
	}
}
