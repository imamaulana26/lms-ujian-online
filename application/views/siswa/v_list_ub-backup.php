<?php $this->load->view('admin/layouts/v_header'); ?>

<body>
    <?php $this->load->view('siswa/layouts/navbar.php'); ?>
    <!-- <?php var_dump($_SESSION); ?> -->
    <div class="container my-3">
        <label>List Ujian Bulanan <?= $this->session->userdata('nama_mapel'); ?></label>
        <label style="float: right;">Pengajar : <?= $this->session->userdata('nama_pengajar'); ?></label>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Sisa Waktu</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_ub as $key => $val) : ?>

                    <?php

                    $dtmapel = $this->db->get_where('tbl_log_soal', ['kd_modul' => $val['id_modul'], 'nis_user' => $_SESSION['user']])->row_array();
                    // var_dump($dtmapel);
                    // $diff = date_diff($dtmapel['time_start'], $dtmapel['batas_waktu_tes']);
                    if (!empty($dtmapel)) {
                        $awal  = strtotime($dtmapel['time_start']); //waktu awal

                        $akhir = strtotime($dtmapel['batas_waktu_tes']); //waktu akhir
                        $diff  = $akhir - $awal;
                        $jam   = floor($diff / (60 * 60));

                        $menit = $diff - $jam * (60 * 60);
                    }
                    ?>
                    <tr>
                        <td class="text-center"><?= ($key + 1) ?></td>
                        <td><?= $this->session->userdata('nama_mapel') . ' Ub-' . $val['modul_ub']; ?></td>

                        <td><?= (!empty($dtmapel['nilai'])) ? $dtmapel['nilai'] : ''; ?></td>

                        <td><?= (!empty($dtmapel['time_start'])) ? $dtmapel['time_start'] : ''; ?></td>
                        <td><?= (!empty($dtmapel['time_end'])) ? $dtmapel['time_end'] : ''; ?></td>
                        <td><?= (!empty($dtmapel['time_end'])) ? $menit : ''; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= site_url('siswa/dashboard/detail_soal/' . $val['id_modul']) ?>" class="badge badge-primary">Kerjakan</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>