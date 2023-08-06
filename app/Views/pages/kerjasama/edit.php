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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Partner</h5>
                    </div>
                    <div class="modal-body">
                            <form  class="row" enctype='multipart/form-data' id="modal_form">
                                <div class="form-group col-sm-12">
                                    <label for="kategori">Nama Pendaftar</label>
                                    <input type="hidden" name="user_id" value="<?php echo $id_user ?>">
                                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                    <input type="hidden" name="old_gambar" value="<?= $data['logo_perusahaan'] ?>">
                                    <input type="text" class="form-control" name="nama_perusahaan" value="<?= $data['nama_perusahaan'] ?>">
                                </div>
                                <div id="option2Content" class="form-group col-sm-12">
                                    <label for="">Logo Perusahaan</label>
                                    <br>
                                        <input type="file" name="logo_perusahaan" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> 
                                        <img src="/img/partner/<?= $data['logo_perusahaan']?>" id="blah" width="100" alt=""  class="mb-5">
                                        <br>
                                        <small style="font-size:12px;">Berikut adalah contoh gambar kegiatan dari blk !</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('partner')?>" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
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
    <script src="https://cdn.tiny.cloud/1/krcamgkrexa4e46g2kn9h8x80o7prt3skd1rmvtv4dal06hh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: '#mytextarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
    });

    var url = '<?php echo base_url(); ?>';
    $("#modal_form").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = '<?php echo base_url(); ?>';

        $.ajax({
            type: 'POST',
            url: url + 'partner_update', 
            data: formData,
            processData: false, 
            contentType: false, 
            dataType: 'json', 
            success: function (response) {
                if(response.status == 'success') {
                    toastr.success(response.message);
                    setTimeout(function(){
                                location = url +'partner';
                    },1500)
                }else if(response.status == 'error_data'){
                    toastr.error(response.errors);
                }else if(response.status == 'error_length'){
                    toastr.error(response.errors);
                }
                else if(response.errors.nama_perusahaan){
                    toastr.error(response.errors.nama_perusahaan);
                }else{
                    toastr.error(response.errors.logo_perusahaan);
                }

            },
        });
    });

</script>
<?= $this->endSection(); ?>