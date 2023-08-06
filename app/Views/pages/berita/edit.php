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
                        <h5 class="modal-title" id="exampleModalLabel">Edit Berita</h5>
                    </div>
                    <div class="modal-body">
                        <form  class="row" enctype='multipart/form-data' id="modal_form">
                            <div class="form-group col-sm-12">
                                <label for="kategori">Judul</label>
                                <input type="hidden" name="user_id" value="<?php echo $id_user ?>">
                                <input type="hidden" name="submit" value="submit">
                                <input type="hidden" class="form-control" name="id" value="<?= $data['id']?>">
                                <input type="hidden" class="form-control" name="old_gambar" value="<?= $data['gambar_berita']?>">
                                <input type="text" class="form-control" name="slug" value="<?= $data['slug']?>">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="kategori">Isi Berita</label>
                                <textarea name="isi_berita" rows="3" id="summernote"><?= $data['isi_berita']?></textarea>
                            </div>
                            <div id="option2Content" class="form-group col-sm-12">
                                <label for="">Gambar Berita</label>
                                <br>
                                    <input type="file" name="gambar_berita" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> 
                                    <img src="/img/berita/<?= $data['gambar_berita']?>"
                                    id="blah" width="100" alt=""  class="mb-5">
                                    <br>
                                    <small style="font-size:12px;">Berikut adalah contoh gambar kegiatan dari blk !</small>
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

    $('#summernote').summernote({
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                    },
                    onMediaDelete: function(target) {
                        $.delete(target[0].src);
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
                                location = url +'berita_edit/<?= $data['id']?>';
                      },1500)
                    }

                });
            };
        });

    var url = '<?php echo base_url(); ?>';
    $("#modal_form").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: url + 'berita_update', 
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
              }
            },
        });
    });

 

</script>
<?= $this->endSection(); ?>