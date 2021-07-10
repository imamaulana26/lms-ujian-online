<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_soal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('tgl_indo');
    }
    public function lihat_jawaban()
    {
        $page = 'admin/v_lihat_jawaban';
        $data['title'] = 'Halaman Kelola Module';
        $data['breadcrumb'] = array(
            '<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
            '<li class="breadcrumb-item"><a href="' . site_url('kelola-module') . '"></a></li>',
            '<li class="breadcrumb-item active">Kelola Soal</li>'
        );
        $data['jawaban'] = $this->db->select('a.time_end,a.nilai,a.id_log, e.siswa_nama, b.modul_ub ')->from('tbl_log_soal a')
            ->join('tbl_modul b', 'a.kd_modul = b.id_modul', 'left')
            ->join('tbl_pelajaran c', 'b.modul_pelajaran = c.id_pelajaran', 'left')
            ->join('tbl_mapel d', 'c.kd_mapel = d.kd_mapel', 'left')
            ->join('tbl_siswa e', 'a.nis_user = e.siswa_nis', 'left')
            ->get()->result_array();
        $this->load->view($page, $data);
    }
    function jawaban_siswa($id)
    {
        $page = 'admin/v_jawaban_siswa';
        $data['title'] = 'Halaman Kelola Module';
        $data['breadcrumb'] = array(
            '<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
            '<li class="breadcrumb-item"><a href="' . site_url('kelola-module') . '"></a></li>',
            '<li class="breadcrumb-item active">Kelola Soal</li>'
        );
        $data['jawaban'] = $this->db->select('a.nilai,a.id_log, e.siswa_nama, b.modul_ub,a.id_log_soal,a.log_jawaban_user,d.nm_mapel,a.kd_modul')->from('tbl_log_soal a')
            ->join('tbl_modul b', 'a.kd_modul = b.id_modul', 'left')
            ->join('tbl_pelajaran c', 'b.modul_pelajaran = c.id_pelajaran', 'left')
            ->join('tbl_mapel d', 'c.kd_mapel = d.kd_mapel', 'left')
            ->join('tbl_siswa e', 'a.nis_user = e.siswa_nis', 'left')
            ->where('a.id_log', $id)
            ->get()->result_array();

        $bank_soal = $this->db->get_where('tbl_soal', ['soal_modul_id' => $data['jawaban'][0]['kd_modul']])->result_array();
        $unser_urut = unserialize($data['jawaban'][0]['log_jawaban_user']);
        foreach ($unser_urut as $value) {
            if (($key2 = array_search($value['id'], array_column($bank_soal, 'soal_id'))) !== false) {
                $soal_dumy[] = array(
                    'soal_detail' => $bank_soal[$key2]['soal_detail'],
                    'soal_tipe' => $bank_soal[$key2]['soal_tipe'],
                    'soal_lampiran' => $bank_soal[$key2]['soal_lampiran'],
                    'soal_pg' => $bank_soal[$key2]['soal_pg'],
                    'soal_kunci' => $bank_soal[$key2]['soal_kunci'],
                    'jwb_siswa' => $value['jwb']
                );
            }
        }

        $data['dt_jawaban'] = $soal_dumy;

        // var_dump($data['dt_jawaban']);
        // $test = unserialize($data['dt_jawaban'][3]['soal_kunci']);
        // var_dump($test);
        // die;
        // var_dump($unser_urut);
        // var_dump($unser_urut1);
        // var_dump($soal_dumy);
        // var_dump($data['jawaban'][0]['kd_modul']);
        // die;
        $this->load->view($page, $data);
    }

    function get_dtnilai($id)
    {
        $result = $this->db->select('d.nm_mapel,a.id_log,a.nilai,b.modul_ub')->from('tbl_log_soal a')
            ->join('tbl_modul b', 'a.kd_modul = b.id_modul', 'left')
            ->join('tbl_pelajaran c', 'b.modul_pelajaran = c.id_pelajaran', 'left')
            ->join('tbl_mapel d', 'c.kd_mapel = d.kd_mapel', 'left')
            ->where('a.id_log', $id)->get()->row_array();
        echo json_encode($result);
        // echo json_encode(['jenis' => 'submit', 'status' => false, 'msg' => 'Berhasil ditambahkan']);
        exit;
    }
    function update_nilai()
    {
        // $result = $this->db->update(
        //     'tbl_log_soal',
        //     ['nilai' => input('nilai_update')],
        //     ['id_log' => input('idlog_update')]
        // );

        $result = $this->input->post();

        // echo json_encode(['jenis' => 'update', 'msg' => 'Berhasil diupdate']);
        echo json_encode($result);
        exit;
    }
}
