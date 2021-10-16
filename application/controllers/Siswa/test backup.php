<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    // Catatan Dokumentasi
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

    /** ------------------------------------------
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

    /** ------------------------------------------
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

    /** ------------------------------------------
     * Format Penyusunan Lampiran Soal
     * ------------------------------------------
     * $arr = array(
     * 	'tipe' => 'video',
     * 	'link' => 'https://drive.google.com/file/d/1HJmcAcmVdiDp5WVx-XNroB5Fy82oTBrS/view?usp=sharing'
     * );
     */

    /**
     * ------------------------------------------
     * Format Shuffle Penyusunan data multiple
     * ------------------------------------------
     * foreach ($data['soal_multiple'] as $value) {
     * 	$rowfix[] = $value['column'];
     * }
     * shuffle($rowfix);
     * $data['rowfix'] = $rowfix;
     * var_dump($rowfix);
     */

    /**
     * ------------------------------------------
     * Format Shuffle Penyusunan Pilgan Bercabang
     * ------------------------------------------
     *$dt_dummy = array(
     *	array(
     *		'pilihan' => 'a',
     *		'ket' => 'Lorem ipsum dolor sit! a'
     *	),
     *  array(
     *		'pilihan' => 'b',
     *		'ket' => 'Lorem ipsum dolor sit! b'
     *	),
     *  array(
     *		'pilihan' => 'c',
     *		'ket' => 'Lorem ipsum dolor sit! c'
     *	),
     *	array(
     *		'pilihan' => 'd',
     *		'ket' => 'Lorem ipsum dolor sit! d'
     *	 )
     * );
     */


    public function index()
    {
        $page = 'siswa/v_test';
        $data['title'] = 'Testing';

        $this->load->view($page, $data);
    }

    public function check_log_soal()
    {
        $data = array();
        $id = input('id_modul');
        $batas_waktu = input('waktu_tes');
        $n_soal = 4; // jumlah soal yg ditampilkan tidak boleh melebihi jumlah bank soal

        $dateTime = new DateTime();
        $dateTime->modify("+{$batas_waktu} minutes");

        $bank_soal = $this->db->get_where('tbl_soal', ['soal_modul_id' => $id])->result_array();
        $cek_log_soal = $this->db->get_where('tbl_log_soal', ['nis_user' => $_SESSION['username'], 'kd_modul' => $id]);

        $data['nm_soal'] = $this->db->select('nm_mapel')->from('tbl_modul a')->join('tbl_pelajaran b', 'a.modul_pelajaran = b.id_pelajaran', 'left')->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')->get()->row_array();
        $data['id_modul'] = $id;

        // check kondisi tbl_log_soal
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

            $soal_acak = array();
            foreach ($acak_soal as $value) {
                $soal_dumy = $bank_soal[$value];
                array_push($soal_acak, $soal_dumy);
            }

            $data['soal_acak'] = $soal_acak;
        } else {
            $dturut_array = $cek_log_soal->row_array();
            $unser_urut = unserialize($dturut_array['id_log_soal']);
            $soal_acak = array();
            foreach ($unser_urut as $value) {
                $soal_dumy = $bank_soal[$value];
                array_push($soal_acak, $soal_dumy);
            }


            $data['soal_acak'] = $soal_acak;

            // $dt_dummy = array(
            // 	array(
            // 		'pernyataan' => 'Pernyataan pertama',
            // 		'jwb' => 'true'
            // 	),
            // 	array(
            // 		'pernyataan' => 'Pernyataan kedua',
            // 		'jwb' => 'false'
            // 	)
            // );
            // var_dump(serialize($dt_dummy));
            // var_dump($soal_acak);
            // die;
            $this->session->set_userdata('soal', $soal_acak);
        }

        return $data;
    }

    public function kerjakan()
    {
        $page = 'siswa/v_soal';
        $data['title'] = 'Testing';

        $log_soal = $this->check_log_soal();
        $id_log = $this->db->get_where('tbl_log_soal', ['nis_user' => $_SESSION['username'], 'kd_modul' => $log_soal['id_modul']])->row_array();

        $data['bts_waktu'] = date('F d Y H:i:s', strtotime($id_log['batas_waktu_tes']));
        $data['nm_soal'] = $log_soal['nm_soal'];
        $data['soal_acak'] = $log_soal['soal_acak'];
        $data['id_logsoal'] = $id_log['id_log'];
        $data['kd_modul'] = $log_soal['id_modul'];

        $this->load->view($page, $data);
    }

    function check_form()
    {
        //statmn data

        $nilai = 0;
        $essay = 0;
        $soal = $this->session->userdata('soal');
        $jawaban_siswa = $this->input->post();
        $jawaban = array_values($jawaban_siswa['answer']);

        // $soal1 = 'a:6:{i:0;i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;}';


        //end of statmn data

        // penghitungan nilai
        foreach ($jawaban  as $key1 => $value1) {
            if ($value1['tipe'] == 1) {
                //soal tipe jawaban Pilgan
                if (!empty($value1['jwb'])) {
                    if (($key2 = array_search($value1['id'], array_column($soal, 'soal_id'))) !== false) {
                        if ($value1['jwb'] === $soal[$key2]['soal_kunci']) {
                            $nilai++;
                        }
                    }
                }
            } elseif ($value1['tipe'] == 2) {
                //soal tipe true false
                if (!empty($value1['jwb'])) {
                    if (($key2 = array_search($value1['id'], array_column($soal, 'soal_id'))) !== false) {
                        $kuncijwbtf = array_column(unserialize($soal[$key2]['soal_kunci']), 'jwb');
                        if ($value1['jwb'] === $kuncijwbtf) {
                            $nilai++;
                        }
                    }
                }
            } elseif ($value1['tipe'] == 3) {
                //soal tipe esay
                // if (!empty($value1['jwb'])) {
                // 	if (($key2 = array_search($value1['id'], array_column($soal, 'soal_id'))) !== false) {
                // 		$essay = 1;
                // 	}
                // }
                $essay = 1;
            } elseif ($value1['tipe'] == 4) {
                //soal tipe jawaban singkat
                if (!empty($value1['jwb'])) {
                    if (($key2 = array_search($value1['id'], array_column($soal, 'soal_id'))) !== false) {
                        if ($value1['jwb'] === $soal[$key2]['soal_kunci']) {
                            $nilai++;
                        }
                    }
                }
            } elseif ($value1['tipe'] == 5) {
                // soal tipe mencocokan jawaban
                if (($key2 = array_search($value1['id'], array_column($soal, 'soal_id'))) !== false) {
                    $kncjawab = array_column(unserialize($soal[$key2]['soal_kunci']), 'column', 'row');
                    var_dump($kncjawab);
                    if ($kncjawab === $value1['jwb']) {
                        $nilai++;
                    }
                }
            } elseif ($value1['tipe'] == 6) {
                //soal tipe pilgan kompleks
                if (($key2 = array_search($value1['id'], array_column($soal, 'soal_id'))) !== false) {
                    if ($value1['jwb'] === unserialize($soal[$key2]['soal_kunci'])) {
                        $nilai++;
                    }
                }
            }
        }

        // //penghitungan nilai tipe 5
        // if (($key3 = array_search(5, array_column($jawaban, 'tipe'))) !== false) {

        // 	if (($key4 = array_search(5, array_column($soal, 'soal_tipe'))) !== false) {
        // 		$kunci = unserialize($soal[$key4]['soal_kunci']);
        // 		foreach ($kunci as $value) {
        // 			if ($jawaban[$key3]['jwb'][$value['row']] == $value['column']) {
        // 				$result++;
        // 			}
        // 			//membuat ulang struktur
        // 			$jawaban_reposisi[] =
        // 				array(
        // 					'row' => $value['row'],
        // 					'column' => $jawaban[$key3]['jwb'][$value['row']]
        // 				);
        // 		}
        // 		if ($result == 5) { //jika result sama dengan jumlah kunci jawaban, maka jawaban benar
        // 			$nilai++;
        // 		}
        // 	}
        // 	//mengganti array jawaban
        // 	$jawaban[$key3]['jwb'] = $jawaban_reposisi;
        // }
        // // end of tipe 5



        // die;

        $nilai_fix = ($nilai / count($soal)) * 100;
        // end of penghitungan nilai
        $waktuselesai = date('Y-m-d H:i:s');
        $where = array(
            'id_log' => input('id_log')
        );
        $nilai_bulat = round($nilai_fix, 2);

        $dt_update_siswa = array(
            'log_jawaban_user' => serialize($jawaban),
            'time_end' => $waktuselesai,
            'log_essay' => $essay,
            'nilai' => $nilai_bulat
        );
        // var_dump($nilai);
        // var_dump($nilai_bulat);
        // var_dump($essay);
        // var_dump($dt_update_siswa);
        die;
        // $this->db->update('tbl_log_soal', $dt_update_siswa, $where);
        redirect('siswa/dashboard/test', 'refresh');
    }


    public function get_nomor($no)
    {
        $soal = $_SESSION['soal'];

        $data = array();

        $data['soal_detail'] = $soal[$no - 1]['soal_detail'];
        $data['soal_tipe'] = $soal[$no - 1]['soal_tipe'];
        if ($soal[$no - 1]['soal_tipe'] == 1) {
            $kunci_jawaban    = unserialize($soal[$no - 1]['soal_pg']);
            shuffle($kunci_jawaban);
            $data['soal_jawaban'] = $kunci_jawaban;
        }

        echo json_encode($data);
        exit;
    }
}
