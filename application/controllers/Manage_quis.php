<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_quis extends CI_Controller
{
    public function index()
    {
        $page = 'admin/v_manage_quis';
        $data['title'] = 'Halaman Manage Quis';
        $data['breadcrumb'] = array(
            '<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
            '<li class="breadcrumb-item active">Manage Quis</li>'
        );

        $data['dt_program'] = $this->db->select('a.jns_program,a.id_program,a.peserta_program,a.waktu_pengerjaan,a.aktif,c.nm_mapel,d.kelas_nama')->from('tbl_modul_program a')
            ->join('tbl_pelajaran b', 'a.pelajaran_program = b.id_pelajaran', 'left')
            ->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
            ->join('tbl_kelas d', 'b.id_kelas = d.kelas_id', 'left')
            ->get()->result_array();
        $this->load->view($page, $data);
    }

    public function soal($id)
    {
        $page = 'admin/v_kelola_soal_program';
        $data['title'] = 'Halaman Kelola Soal Kelas';
        $data['breadcrumb'] = array(
            '<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
            '<li class="breadcrumb-item"><a href="' . site_url('kelola-module') . '">Module Soal</a></li>',
            '<li class="breadcrumb-item active">Kelola Soal</li>'
        );

        $sql = "SELECT a.id_program, e.kelas_nama,a.jns_program, d.nm_mapel, a.waktu_pengerjaan, COUNT(b.soal_program_id) as bank_soal FROM tbl_modul_program a
		LEFT JOIN tbl_soal_program b
		ON a.id_program = b.soal_program_id
		LEFT JOIN tbl_pelajaran c
		ON a.pelajaran_program = c.id_pelajaran
		LEFT JOIN tbl_mapel d
		ON c.kd_mapel = d.kd_mapel
		LEFT JOIN tbl_kelas e
		ON c.id_kelas = e.kelas_id
		WHERE a.id_program = '" . $id . "' GROUP BY a.id_program";
        $data['module'] = $this->db->query($sql)->row_array();
        // var_dump($data['module']);
        // die;

        $this->load->view($page, $data);
    }

    public function get_mapel()
    {
        $dtmapel = $this->db->select('b.nm_mapel, a.id_pelajaran')->from('tbl_pelajaran a')->where('id_kelas', input('id'))
            ->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'left')
            ->get()->result_array();
        $html = "";
        foreach ($dtmapel as $mapel) {
            $html .= "<option value='" . $mapel['id_pelajaran'] . "'>" . $mapel['nm_mapel'] . "</option>";
        }
        $data['data_mapel'] = $html;

        echo json_encode($data);
        exit;
    }


    public function get_module($id)
    {
        $sql = "SELECT a.id_modul, e.kelas_id, c.id_pelajaran, d.nm_mapel, a.modul_ub, a.waktu_pengerjaan, COUNT(b.soal_modul_id) as bank_soal FROM tbl_modul a
		LEFT JOIN tbl_soal b
		ON a.id_modul = b.soal_modul_id
		LEFT JOIN tbl_pelajaran c
		ON a.modul_pelajaran = c.id_pelajaran
		LEFT JOIN tbl_mapel d
		ON c.kd_mapel = d.kd_mapel
		LEFT JOIN tbl_kelas e
		ON c.id_kelas = e.kelas_id
		WHERE a.id_modul = '" . $id . "' GROUP BY a.id_modul";
        $result = $this->db->query($sql)->row_array();

        echo json_encode($result);
        exit;
    }

    public function submit_module()
    {
        $check = $this->db->get_where('tbl_modul', [
            'modul_pelajaran' => input('id_mapel'),
            'modul_ub' => input('id_ub'),
        ])->num_rows();
        if ($check > 0) {
            echo json_encode(['jenis' => 'submit', 'status' => true, 'msg' => 'Data Sudah Ada']);
        } else {
            $this->db->insert('tbl_modul', [
                'modul_pelajaran' => input('id_mapel'),
                'modul_ub' => input('id_ub'),
                'waktu_pengerjaan' => input('waktu_ujian')
            ]);
            echo json_encode(['jenis' => 'submit', 'status' => false, 'msg' => 'Berhasil ditambahkan']);
        }

        exit;
    }

    public function peserta($id, $tipe)
    {
        $page = 'admin/v_kelola_peserta';
        $data['title'] = 'Halaman Kelola Peserta';
        $data['breadcrumb'] = array(
            '<li class="breadcrumb-item"><a href="' . site_url('dashboard') . '"><i class="fa fa-fw fa-desktop"></i> Dashboard</a></li>',
            '<li class="breadcrumb-item"><a href="' . site_url('kelola-quis') . '">Module Peserta</a></li>',
            '<li class="breadcrumb-item active">Kelola Peserta</li>'
        );

        $data['dt_program'] = $this->db->select('a.jns_program,a.peserta_program,a.waktu_pengerjaan,c.nm_mapel,d.kelas_nama')->from('tbl_modul_program a')
            ->join('tbl_pelajaran b', 'a.pelajaran_program = b.id_pelajaran', 'left')
            ->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
            ->join('tbl_kelas d', 'b.id_kelas = d.kelas_id', 'left')
            ->where('id_program', $id)
            ->get()->result_array();

        // die;
        $dt_peserta = unserialize($data['dt_program'][0]['peserta_program']);
        $sql = $this->db->get_where('tbl_siswa', [$tipe => 1])->result_array();
        $siswa = array();
        foreach ($sql as $key => $val) {
            // buat format data
            $siswa = array(
                'nis' => $val['siswa_nis'],
                'nama' => $val['siswa_nama'],
            );
            if ((array_search($val['siswa_nis'], $dt_peserta)) !== false) {
                $select = array('selected' => 1);
            } else {
                $select = array('selected' => 0);
            }
            $result[] = array_merge($siswa, $select);
        }
        $data['peserta'] = $result;

        $this->load->view($page, $data);
    }
    public function save_peserta()
    {
        $peserta = serialize($this->input->post('peserta'));
        $this->db->update('tbl_modul_program', ['peserta_program' => $peserta], ['id_program' => input('id_modul')]);
        redirect('manage-quis', 'refresh');
    }
}
