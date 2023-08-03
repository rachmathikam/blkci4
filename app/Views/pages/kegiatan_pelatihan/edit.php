<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="col">
        <div class="row">
            <h2>TEST</h2>
        </div>
    </div>
</div>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title"><?php echo $content_title?></h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?php echo $content_title?></a>
                </li>
            </ul>
        </div>
        
            <div class="modal-dialog modal-lg ">
                <div class="modal-content card">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kegiatan Pelatihan / <?php echo ucwords($data['nama_pelatihan']) ?></h5>
                    </div>
                    <div class="modal-body">
                    <form  class="row" enctype='multipart/form-data' id="modal_form">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
                            <div class="form-group col-sm-12">
                                <label for="kategori">Nama Pelatihan</label>
                                <input type="hidden" name="submit" value="submit">
                                <?php
                                    $array = [
                                        [
                                            'nama_pelatihan' => 'junior_web_programming',
                                            'pelatihan' => 'Junior Web Programming'
                                        ],
                                        [
                                            'nama_pelatihan' => 'poa',
                                            'pelatihan' => 'Practical Office in Advance'
                                        ],
                                        [
                                            'nama_pelatihan' => 'tata_rias',
                                            'pelatihan' => 'Tata Rias'
                                        ],
                                        [
                                            'nama_pelatihan' => 'las_smaw',
                                            'pelatihan' => 'Las SMAW'
                                        ],
                                        [
                                            'nama_pelatihan' => 'listrik',
                                            'pelatihan' => 'listrik'
                                        ],
                                        [
                                            'nama_pelatihan' => 'ac',
                                            'pelatihan' => 'AC'
                                        ],
                                        [
                                            'nama_pelatihan' => 'menjahit',
                                            'pelatihan' => 'Menjahit'
                                        ],
                                        [
                                            'nama_pelatihan' => 'roti_kue',
                                            'pelatihan' => 'Roti Kue'
                                        ],
                                        [
                                            'nama_pelatihan' => 'sepeda_motor',
                                            'pelatihan' => 'Sepeda Motor'
                                        ],
                                        [
                                            'nama_pelatihan' => 'desain_grafis',
                                            'pelatihan' => 'Desain Grafis'
                                        ]
                                    ];
                                    ?>
                                
                                   
                                <input type="hidden" name="old_gambar" value="<?= $data['gambar'] ?>">
                                    <select name="kegiatan_pelatihan" id="mySelect" class="form-control">
                                        <option value="">-- Pilih Kegiatan Pelatihan --</option>
                                        <?php foreach($array as $value): ?>
                                                <?php $selected = '';?>
                                            <?php  if($data['nama_pelatihan'] == $value['nama_pelatihan']){ ?>
                                                <?php $selected = 'selected'; ?>
                                                <?php } ?>
                                        <option <?= $selected ?> value="<?= $value['nama_pelatihan']?>"><?php echo $value['pelatihan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div id="option2Content" class="form-group col-sm-8">
                                <label for="">Gambar Kegiatan</label>
                                <br>
                                    <input type="file" name="gambar" id="gambar" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> 
                                    <div class="invalid-feedback gambar">
                                        
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                <img src="/img/kegiatan_pelatihan/<?= $data['gambar'] ?>" id="blah" width="225" alt=""  class="mb-2">
                                    <br>
                                    <small style="font-size:12px;">Berikut adalah contoh gambar kegiatan dari blk !</small>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('kegiatan_pelatihan') ?>" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="container">
    <div class="row">
        <div class="col">
            <br><br><br>

        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>

<script>
    $("#modal_form").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = '<?php echo base_url(); ?>';

        $.ajax({
            type: 'POST',
            url: url + 'kegiatan_pelatihan_update', 
            data: formData,
            processData: false,
            contentType: false, 
            dataType: 'json', 
            success: function (response) {
                if(response.status == 'success'){
                    toastr.success(response.message);
                    setTimeout(function(){
                                location = url +'kegiatan_pelatihan';
                    },1500)
                }else{
                    if(response.errors.kegiatan_pelatihan){
                        $('#mySelect').addClass('is-invalid');
                        var text = document.querySelector(".invalid-feedback");
                         text.textContent  = response.errors.kegiatan_pelatihan;
                    }else{
                        $('#gambar').addClass('is-invalid');
                        var all = document.querySelector(".gambar");
                         all.textContent  = response.errors.gambar;
                        
                    }
                }
            },
        });
    });
    $('#mySelect').on('change', function() {
            $('#mySelect').removeClass('is-valid is-invalid');
        });
        $('#gambar').on('click', function() {
            $('#gambar').removeClass('is-valid is-invalid');
        });

</script>
<?= $this->endSection(); ?>