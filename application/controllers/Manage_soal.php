<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_soal extends CI_Controller
{
    public function index()
    {
        $page = 'admin/v_jawaban';
        $data['title'] = 'Lihat Jawaban';
        $data['dtkelas'] = $this->db->select('kelas_id, kelas_nama')->from('tbl_kelas')->where('kelas_id <', '16')
            ->get()->result_array();
        $this->load->view($page, $data);
    }
}
