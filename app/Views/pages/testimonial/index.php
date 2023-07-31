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
            <h4 class="page-title"><?php echo $data['content_title']?></h4>
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
                    <a href="#"><?php echo $data['content_title']?></a>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3>Icon</h3>
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                        data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Icon</button>
                    <button class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-trash"></i> Tambah
                        Icon</button>
                    <div class="card-body mt-5">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>Nama Pendaftar</th>
                                        <th>Testimoni</th>
                                        <th>Gambar Pendaftar / Profile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new">

                                    <tr id="data">
                                        <td><input type="checkbox" class="checkbox_ids" name="ids" value=""></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="btn text-warning  edit_inline"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn text-primary  btnSave" style="display:none;"><i
                                                    class="fa fa-check"></i></button>
                                            <button class="btn text-danger  editCancel" style="display:none;"><i
                                                    class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Visi atau Misi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form  class="row" enctype='multipart/form-data' id="modal_form">
                        <div class="form-group col-sm-12">
                            <label for="kategori">Nama Pendaftar</label>
                            <input type="hidden" name="user_id" value="<?php  ?>">
                            <input type="hidden" name="submit" value="submit">
                            <input type="text" class="form-control" name="nama_pendaftar">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="kategori">Testimoni</label>
                            <textarea name="testimoni" rows="3" class="form-control"></textarea>
                        </div>
                        <div id="option2Content" class="form-group col-sm-12">
                            <label for="">Gambar Profile / Pendaftar</label>
                            <br>
                                <input type="file" name="gambar_pendaftar" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> 
                                <img src="https://thumbs.dreamstime.com/b/businessman-icon-vector-male-avatar-profile-image-profile-businessman-icon-vector-male-avatar-profile-image-182095609.jpg"
                                id="blah" width="100" alt=""  class="mb-5">
                                <br>
                                <small style="font-size:12px;">Berikut adalah contoh gambar kegiatan dari blk !</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </form>
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
    $("#form_profile").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = '<?php echo base_url(); ?>';

        $.ajax({
            type: 'POST',
            url: url + 'hero_store', // URL to the server-side script that handles file upload
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            dataType: 'json', // Specify the expected response type
            success: function (response) {


            },
        });
    });

    $("#add_new").on('click', '.edit_inline', function () {
        var btn = $(this);
        btn.closest("tr").find(".edit_inline").hide();

        $(this).closest("tr").find(".editSpan").hide();
        $(this).closest("tr").find(".editInput").show(250);
        $(this).closest("tr").find(".editCancel").show(250);
        $(this).closest("tr").find(".edit_inline").hide();
        $(this).closest("tr").find(".btnSave").show(250);
    });

    $("#add_new").on('click', '.editCancel', function (e) {
        e.preventDefault();

        $(this).closest("tr").find(".editSpan").show();
        $(this).closest("tr").find(".editInput").hide();

        $(this).closest("tr").find(".edit_inline").show(250);
        $(this).closest("tr").find(".editCancel").hide();

        $(this).closest("tr").find(".btnSave").hide();
    });

    $("#add_new").on("click", '.btnSave', function (e) {
        e.preventDefault();
        var trObj = $(this).closest("tr");
        var ID = $(this).closest("tr").attr('id');
        var inputData = $(this).closest("tr").find(".editInput").serialize();


        $.ajax({
            type: "POST",
            url: "http://localhost/blk/setting_profile/fetch.php",
            dataType: "json",
            data: 'action=edit&id=' + ID + '&' + inputData + '&' + 'user_id=<?php echo $data['id_user']?>',
            success: function (response) {
                if (response.status == 200) {
                    toastr.success(response.message);
                    trObj.find(".editSpan.social_media_name").text(response.data.social_media_name);
                    trObj.find(".editSpan.icon_id").text(response.data.icon_id);
                    trObj.find(".editSpan.link").text(response.data.link);

                    trObj.find(".editInput.social_media_name").val(response.data.social_media_name);
                    trObj.find(".editInput.icon_id").val(response.data.icon_id);
                    trObj.find(".editInput.link").val(response.data.link);

                    trObj.find(".editInput").hide();
                    trObj.find(".editSpan").show();
                    trObj.find(".btnSave").hide();
                    trObj.find(".editCancel").hide();
                    trObj.find(".edit_inline").show();
                    setTimeout(function () {
                        location = 'http://localhost/blk/setting_profile/setting.php';
                    }, 1500)
                }
            }
        });

    });

    $(document).ready(function () {
        $('#mySelect').change(function () {
            var selectedValue = $(this).val();
            // Hide all content divs
            $('[id$="Content"]').addClass('hidden');

            // Show the content div based on selected value
            $('#' + selectedValue + 'Content').removeClass('hidden');
        });
    });

    function addInput() {
        var html = '<div class="form-group">' +
            '<div class="input-group">' +
            '<input type="text" class="form-control" name="misi[]" placeholder="Enter a value">' +
            '<div class="input-group-append">' +
            '<button type="button" class="btn btn-danger remove-input" onclick="removeInput(this)"><i class="fas fa-times"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>';
        $('#inputContainer').append(html);
    }

    function removeInput(element) {
        var inputGroup = $(element).closest('.input-group');
        if (inputGroup.parent().is(':nth-child(1)')) {
            // Prevent removing the first input
            alert('Cannot remove the first input!');
        } else {
            inputGroup.parent().remove();
        }
    }
</script>
<?= $this->endSection(); ?>