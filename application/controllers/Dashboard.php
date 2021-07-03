<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$page = 'admin/v_dashboard';
		$data['title'] = 'Dashboard';
		$data['content'] = 'Ini Halaman Dashboard';

		$this->load->view($page, $data);
	}
}
