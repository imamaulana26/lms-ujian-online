<?php $this->load->view('admin/layouts/v_header'); ?>

<style>
    .box label {
        display: flex;
        height: 53px;
        width: 100%;
        align-items: center;
        border: 1px solid lightgrey;
        border-radius: 5px;
        margin: 10px 0;
        padding-left: 11px;
        cursor: pointer;
        transition: all 0.3s ease
    }

    label:hover {
        background: #eee;
        cursor: pointer;
        border: 1px solid #aaa;
        padding: 4px;
    }

    .wrapper .box label {
        display: flex;
        height: 53px;
        width: 100%;
        align-items: center;
        border: 1px solid lightgrey;
        border-radius: 5px;
        margin: 10px 0;
        padding-left: 11px;
        cursor: pointer;
        transition: all 0.3s ease
    }

    .box input[type="radio"]:checked+label {
        background-color: #bbb;
    }

    /* #value-1:checked~.value-1,
    #value-2:checked~.value-2,
    #value-3:checked~.value-3,
    #value-4:checked~.value-4 {
        background: #9C27B0;
        border-color: #9C27B0
    } */

    .box label .text {
        color: #333;
        font-size: 18px;
        font-weight: 400;
        padding-left: 10px;
        transition: color 0.3s ease
    }


    .box input[type="radio"] {
        display: none
    }

    /* hilangkan semua konten */
    /* .tabcontent {
        display: none;
    }

    .tabcontent .active {
        display: block;
        display: show;
    } */
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="">Computer Basted-Test</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><?= $_SESSION['nm_user'] ?> <i class="fa fa-fw fa-user-circle"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-10 offset-1">
                <h2 class="mb-3">Mata Pelajaran : tulis nama mata pelajaran</h2>

                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold">
                                    Soal Nomor <span class="badge badge-primary" id="nomor"></span>
                                </h4>
                            </div>
                            <div class="card-body">

                                <div class="box">
                                    <!-- content  -->

                                    <!-- <div class="tabcontent bg-light" id="content1">

                                        <div class="soal mb-3">
                                            <?php var_dump($soal_acak); ?>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem optio incidunt eum vero soluta magni sed, temporibus nesciunt non, ipsam eaque natus quisquam nemo. Natus, repellat enim. Ex, quam? Est!
                                        </div>
                                        <div class="jawaban">
                                            <div class="box">
                                                <input type="radio" name="jawaban" id="value-1">
                                                <input type="radio" name="jawaban" id="value-2">
                                                <input type="radio" name="jawaban" id="value-3">
                                                <input type="radio" name="jawaban" id="value-4">
                                                <label for="value-1" class="value-1">
                                                    <div class="text" id="text-1">A.Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                                </label>
                                                <label for="value-2" class="value-2">
                                                    <div class="text" id="text-2">B.Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                                </label>
                                                <label for="value-3" class="value-3">
                                                    <div class="text" id="text-3">C.Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                                </label>
                                                <label for="value-4" class="value-4">
                                                    <div class="text" id="text-4">D.Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <?php var_dump($soal_acak); ?>
                                    <?php $id = 1;
                                    foreach ($soal_acak as $key => $value) {
                                        $pg = unserialize($value['soal_pg']);
                                    ?>
                                        <div class="tabcontent bg-light" id="content<?= $id ?>">
                                            <div class="soal mb-3">
                                                <?= $value['soal_detail'] ?>

                                            </div>
                                            <div class="jawaban">
                                                <?php if ($value['soal_tipe'] == 1) {
                                                    // var_dump($pg);
                                                    foreach ($pg as $key1 => $jwbn) {
                                                        $uid = $key1 + 1;
                                                        echo $value['soal_id'] . $uid;
                                                ?>
                                                        <div class="box">
                                                            <!-- <input type="radio" name="jawaban" id="value-<?= $uid ?>">
                                                            <label for="value-<?= $uid ?>" class="value-<?= $uid ?>">
                                                                <div class="text" id="text-<?= $uid ?>"><?= $jwbn['jawaban'] ?></div>
                                                            </label> -->
                                                            <input type="radio" id="radio<?= $value['soal_id'] . $uid ?>" name="radios" value="value-<?= $value['soal_id'] . $uid ?>">
                                                            <label for="radio<?= $value['soal_id'] . $uid ?>"><?= $jwbn['jawaban'] ?></label>
                                                        </div>
                                                <?php }
                                                } ?>
                                            </div>
                                            <?= $id ?>
                                        </div>
                                    <?php $id++;
                                    } ?>

                                    <!-- end of content -->
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between bd-highlight">
                                    <button class="btn btn-info btn-prev" onclick="prev()">Previous </button>
                                    <button class="btn btn-primary btn-next" onclick="next()">Next</button>
                                    <!-- <a href="#" class="btn btn-info btn-prev">Sebelumnya</a>
                                    <a href="#" class="btn btn-primary btn-next">Selanjutnya</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title font-weight-bold">Daftar Soal</h5>
                            </div>
                            <div class="card-body">
                                <nav class="multiTabs">
                                    <?php for ($i = 0; $i < count($soal_acak); $i++) {
                                    ?>
                                        <a class="btn btn-default m-1" href="javascript:void(0)" data-trigger='content<?= $i + 1 ?>' id="nav-content<?= $i + 1 ?>"><?= $i + 1 ?></a>
                                    <?php } ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>Data sementara</h2>
                    <?php

                    $datasementara = array(
                        "2" => "a",
                        "4" => "true",
                        "5" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis obcaecati nam quia incidunt nemo ullam eligendi debitis beatae suscipit sequi minus aut repudiandae magni non, at, praesentium quod nostrum quibusdam?"
                    );


                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">soal nomor</th>
                                <th scope="col">Jawaban Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($f = 0; $f < count($soal_acak); $f++) : ?>
                                <tr>
                                    <td><?= $f + 1 ?></td>
                                    <td>x</td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                echo '<pre>';
                var_dump($datasementara);
                echo '</pre>';
                ?>
            </div>
        </div>
        <?php
        $datajawabanserialize = array(
            "2" => "a",
            "4" => "true",
            "5" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reiciendis obcaecati nam quia incidunt nemo ullam eligendi debitis beatae suscipit sequi minus aut repudiandae magni non, at, praesentium quod nostrum quibusdam?"
        );

        //nama file
        $namaFile = 'dumyjawaban.txt';
        //lokasi penyimpanan
        $pathFile = "assets/filesiswa/" . $_SESSION['username'] . "/";
        //membuat file
        $file = fopen($pathFile . $namaFile, 'w');
        // isi konten file
        $konten = serialize($datajawabanserialize);
        //menulis file
        fwrite($file, $konten);
        fclose($file);

        //membaca file
        $data = file_get_contents($pathFile . $namaFile);

        // mengembalikan data serialize
        // var_dump(unserialize($data));

        ?>
    </div>
</body>

<script>
    var currentTab = 1;
    $('#nomor').text(1);
    $("#content1").show();
    $('#nav-content1').removeClass('btn-default').addClass('btn-primary');

    $(document).on('click', 'nav.multiTabs>a',
        function() {
            var TabId = $(this).attr('data-trigger');
            $('div#' + TabId + ' ').show();
            $('a.btn.m-1').removeClass('btn-primary').addClass('btn-default');
            $('#nav-' + TabId).removeClass('btn-default').addClass('btn-primary');
            console.log("nav-" + TabId);
            currentTab = parseInt(TabId.replace("content", ""));

            $('.tabcontent:not(#' + TabId + ')').hide()

        });

    function next() {
        if (currentTab < <?= count($soal_acak) ?>) {

            // console.log("Current Tab: " + currentTab);
            $(".tabcontent").hide();
            currentTab++;
            $('a.btn.m-1').removeClass('btn-primary').addClass('btn-default');
            $('#nav-content' + currentTab).removeClass('btn-default').addClass('btn-primary');
            $("#content" + (currentTab)).show();

        }
    }

    function prev() {
        if (currentTab > 1) {
            // $('a.btn.m-1').removeClass('btn-primary').addClass('btn-default');
            // $('#nav-content' + currentTab--).removeClass('btn-default').addClass('btn-primary');

            $(".tabcontent").hide();
            currentTab--;
            $('a.btn.m-1').removeClass('btn-primary').addClass('btn-default');
            $('#nav-content' + currentTab).removeClass('btn-default').addClass('btn-primary');
            $("#content" + (currentTab)).show();
            console.log("Current Tab: " + currentTab);
        }
    }
</script>

</html>