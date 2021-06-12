<?php $this->load->view('admin/layouts/v_header'); ?>

<body class="hold-transition sidebar-mini text-sm">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view('admin/layouts/v_navbar'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view('admin/layouts/v_sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Daftar Soal</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Soal</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg">
                            <div class="card">
                                <!-- <div class="card-header border-0">
									<div class="d-flex justify-content-between">
										<h3 class="card-title">Online Store Visitors</h3>
										<a href="javascript:void(0);">View Report</a>
									</div>
								</div> -->
                                <div class="card-body">
                                    <div class="pilih d-flex">
                                        <div class="col-md-6 d-flex">
                                            <div class="col-md-6">
                                                <!-- Default dropright button -->
                                                <select class="form-control" name="kelas" id="kelas">
                                                    <option value="" selected disabled>Pilih Kelas</option>
                                                    <?php foreach ($dtkelas as $kelas) {
                                                    ?>
                                                        <option value="<?= $kelas['kelas_id'] ?>"><?= $kelas['kelas_nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Default dropright button -->
                                                <select class="form-control" name="idmapel" id="mapel">
                                                    <option value="" selected>Pilih Mapel</option>
                                                </select>
                                                <div id="loading" style="margin-top: 15px;"> <img src=" <?= site_url('assets/images/loading.gif') ?>" width="18"> <small>Loading...</small> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary mb-2">Pilih</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">List UB</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table" id="table_id">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Siswa</th>
                                                <th scope="col">UB</th>
                                                <th scope="col">Nilai</th>
                                                <th scope="col">Tanggal Submit</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Merick Nugroho 1</td>
                                                <td>1</td>
                                                <td><?= rand(70, 80) ?></td>
                                                <td><?= date("Y/m/d H:i:s") ?></td>
                                                <td>
                                                    <div class="btn btn-warning">Lihat Jawaban</div>
                                                    <div class="btn btn-success">Update Nilai</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Merick Nugroho 2</td>
                                                <td>2</td>
                                                <td><?= rand(70, 80) ?></td>
                                                <td><?= date("Y/m/d H:i:s") ?></td>
                                                <td>
                                                    <div class="btn btn-warning">Lihat Jawaban</div>
                                                    <div class="btn btn-success">Update Nilai</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Merick Nugroho 3</td>
                                                <td>3</td>
                                                <td><?= rand(70, 80) ?></td>
                                                <td><?= date("Y/m/d H:i:s") ?></td>
                                                <td>
                                                    <div class="btn btn-warning">Lihat Jawaban</div>
                                                    <div class="btn btn-success">Update Nilai</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php $this->load->view('admin/layouts/v_footer'); ?>
    </div>
    <!-- ./wrapper -->
</body>

<script>
    // $(document).ready(function() {
    //     $('#table_id').DataTable();
    // });
    $(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)  // Kita sembunyikan dulu untuk loadingnya  
        $('#table_id').DataTable();
        $("#loading").hide();
        $("#kelas").change(function() { // Ketika user mengganti atau memilih data kelas    
            $("#mapel").hide(); // Sembunyikan dulu combobox mapel nya    
            $("#loading").show(); // Tampilkan loadingnya      
            $.ajax({
                type: "POST", // Method pengiriman data bisa dengan GET atau POST      
                url: "<?= site_url('dashboard/get_mapel') ?>", // Isi dengan url/path file php yang dituju      
                data: {
                    kelas: $("#kelas").val()
                }, // data yang akan dikirim ke file yang dituju      
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) { // Ketika proses pengiriman berhasil        
                    $("#loading").hide(); // Sembunyikan loadingnya        // set isi dari combobox mapel        // lalu munculkan kembali combobox mapelnya        
                    $("#mapel").html(response.data_mapel).show();
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error        
                    alert(thrownError); // Munculkan alert error      
                }
            });
        });

        CKEDITOR.replace('editorfr');
    });
</script>


</html>