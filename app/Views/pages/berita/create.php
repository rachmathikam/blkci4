<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<style>
    .note-editor .dropdown-toggle::after {
            all: unset;
        }

        .note-editor .note-dropdown-menu {
            box-sizing: content-box;
        }

        .note-editor .note-modal-footer {
            box-sizing: content-box;
        }
</style>
<script src="<?php echo base_url('assets/css/summernote-image-list.min.css') ?>"></script>
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
            <h4 class="page-title"><?php echo $content_title ?></h4>
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
                    <a href="#"><?php echo $content_title ?></a>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Berita</h5>
                    </div>
                    <div class="modal-body">
                        <form  class="row" enctype='multipart/form-data' id="modal_form">
                            <div class="form-group col-sm-12">
                                <label for="kategori">Judul</label>
                                <input type="hidden" name="user_id" value="<?php echo $id_user ?>">
                                <input type="hidden" name="submit" value="submit">
                                <input type="hidden" class="form-control" name="id">
                                <input type="hidden" class="form-control" name="old_gambar">
                                <input type="text" class="form-control" name="slug" id="slug">
                                <div class="invalid-feedback">
                              
                               </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="kategori">Isi Berita</label>
                                <textarea name="isi_berita" class="isi_berita"  rows="3" id="summernote"></textarea>
                            </div>
                            <div id="option2Content" class="form-group col-sm-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label for="">Gambar Berita</label>
                                            <input type="file" name="gambar_berita" class="form-control" id="gambar_berita" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> 
                                    </div>
                                    <div class="col-md-4">
                                        <img src="data:image/png;base64,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"
                                         id="blah" width="100" alt=""  class="mb-5">
                                         <small style="font-size:12px; float:right;">Berikut adalah contoh gambar kegiatan dari blk !</small>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?php base_url()?>/berita" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script>

$(document).ready(function() {
    srcs = '';
    $('#summernote').summernote({
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                    },
                    onMediaDelete: function(target) {
                        $.delete(target[0].src);
                        $.update(target[0].src);
                        $.update(target[0].src);
                         srcs += target[0].src;
                         
                    }
                },
                height: 200,
                toolbar: [
                    ["style", ["bold", "italic", "underline", "clear"]],
                    ["fontname", ["fontname"]],
                    ["fontsize", ["fontsize"]],
                    ["color", ["color"]],
                    ["para", ["ul", "ol", "paragraph"]],
                    ["height", ["height"]],
                    ["insert", ["link", "picture", "imageList", "video", "hr"]],
                    ['view', ['fullscreen', 'codeview', 'help']]

                ],
                dialogsInBody: true,
                imageList: {
                    endpoint: "<?php echo site_url('berita/listGambar') ?>",
                    fullUrlPrefix: "<?php echo base_url('img/berita') ?>/",
                    thumbUrlPrefix: "<?php echo base_url('img/berita') ?>/"
                }
            });

            $.upload = function(file) {
                let out = new FormData();
                out.append('file', file, file.name);
                $.ajax({
                    method: 'POST',
                    url: '<?php echo base_url('berita_upload') ?>',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: out,
                    success: function(img) {
                        $('#summernote').summernote('insertImage', img);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            };
            $.delete = function(src) {
                $.ajax({
                    method: 'POST',
                    url: '<?php echo base_url('berita_gambar_delete') ?>',
                    cache: false,
                    data: {
                        src: src
                    },
                    success: function(response) {
                        console.log(response);
                        setTimeout(function(){
                                location = url +'berita_create';
                      },1500)
                    }

                });
            };
        });

    var url = '<?php echo base_url(); ?>';
    $("#modal_form").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log(srcs);
        $.ajax({
            type: 'POST',
            url: url + 'berita_store', 
            data: formData,
            processData: false, 
            contentType: false, 
            dataType: 'json', 
            success: function (response) {
            if(response.status == 'success'){
                toastr.success(response.message);
                setTimeout(function () {
                        location = url+'berita';
                    }, 1500)
              }else if(response.status == 'error'){
                   if(response.errors.slug){
                    $("#slug").addClass('is-invalid');
                    var text = document.querySelector(".invalid-feedback");
                    text.textContent  = response.errors.slug;
                    console.log(text.textContent);
                }else if(response.errors.gambar_berita){
                    $("#gambar_berita").addClass('is-invalid');
                    var text = document.querySelector(".invalid-feedback");
                    text.textContent  = response.errors.gambar_berita;
                    console.log(text.textContent);
                   }
              }
            },
        });
    });

    $('#slug').on('click', function() {
            $('#slug').removeClass('is-valid is-invalid');
        });
        $('#gambar_berita').on('click', function() {
            $('#gambar_berita').removeClass('is-valid is-invalid');
        });

 
</script>

<?= $this->endSection(); ?>